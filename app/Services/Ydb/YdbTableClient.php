<?php

namespace App\Services\Ydb;

use YdbPlatform\Ydb\Ydb;

class YdbTableClient
{
    private $table;

    public function __construct(private readonly Ydb $ydb)
    {
        $this->table = $ydb->table();
    }

    /**
     * Выполняет YQL-запрос и возвращает массив строк.
     *
     * @param  string  $query
     * @param  array<string, mixed>  $params
     */
    public function query(string $query, array $params = []): array
    {
        $result = $this->table->session(function ($session) use ($query, $params) {
            return $session->query($query, $params);
        });

        return $result->rows();
    }

    /**
     * Выполняет запрос без результата (create table / upsert).
     *
     * @param  string  $query
     * @param  array<string, mixed>  $params
     */
    public function statement(string $query, array $params = []): void
    {
        $this->table->session(function ($session) use ($query, $params) {
            $session->query($query, $params);
        });
    }
}

