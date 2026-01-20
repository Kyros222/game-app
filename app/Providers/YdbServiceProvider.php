<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Psr\Log\NullLogger;
use YdbPlatform\Ydb\Auth\EnvironCredentials;
use YdbPlatform\Ydb\Grpc\GrpcTransport;
use YdbPlatform\Ydb\Ydb;
use App\Services\Ydb\YdbTableClient;
use App\Services\Ydb\UserRepository;
use App\Services\Ydb\TrendRepository;
use App\Services\Ydb\YdbSchema;

class YdbServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(Ydb::class, function () {
            $connectionString = config('ydb.connection_string');
            $credentialsFile = config('ydb.credentials_file');

            if (empty($connectionString) || empty($credentialsFile)) {
                throw new \RuntimeException('YDB connection is not configured. Проверьте .env');
            }

            // пробрасываем путь к ключу в переменную окружения, которую понимает EnvironCredentials
            putenv('YDB_SERVICE_ACCOUNT_KEY_FILE_CREDENTIALS='.$credentialsFile);

            $parsed = $this->parseConnectionString($connectionString);

            $transport = new GrpcTransport(
                new EnvironCredentials(),
                [
                    'endpoint' => $parsed['endpoint'],
                    'database' => $parsed['database'],
                ]
            );

            return new Ydb($transport, new NullLogger(), [
                'sessionPoolMaxSize' => config('ydb.session.max_sessions'),
                'connect_timeout' => config('ydb.session.connect_timeout'),
                'request_timeout' => config('ydb.session.request_timeout'),
            ]);
        });

        $this->app->alias(Ydb::class, 'ydb');

        $this->app->singleton(YdbTableClient::class, function ($app) {
            return new YdbTableClient($app->make(Ydb::class));
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository($app->make(YdbTableClient::class));
        });

        $this->app->singleton(TrendRepository::class, function ($app) {
            return new TrendRepository($app->make(YdbTableClient::class));
        });

        $this->app->singleton(YdbSchema::class, function ($app) {
            return new YdbSchema($app->make(YdbTableClient::class));
        });
    }

    public function boot(YdbSchema $schema): void
    {
        // Убедимся, что таблицы есть в YDB
        $schema->ensure();
    }

    /**
    * Разбирает строку подключения из .env на endpoint и database.
    */
    private function parseConnectionString(string $connectionString): array
    {
        $url = parse_url($connectionString);

        if ($url === false || !isset($url['scheme'], $url['host'])) {
            throw new \InvalidArgumentException('Некорректная строка подключения YDB');
        }

        $endpoint = $url['scheme'].'://'.$url['host'];
        if (isset($url['port'])) {
            $endpoint .= ':'.$url['port'];
        }

        $query = [];
        if (isset($url['query'])) {
            parse_str($url['query'], $query);
        }

        $database = $query['database'] ?? '';

        if (empty($database)) {
            throw new \InvalidArgumentException('В строке подключения YDB отсутствует параметр database');
        }

        return [
            'endpoint' => $endpoint,
            'database' => $database,
        ];
    }
}
