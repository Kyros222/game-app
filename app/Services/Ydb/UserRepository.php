<?php

namespace App\Services\Ydb;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function __construct(private readonly YdbTableClient $client)
    {
    }

    public function findByLogin(string $login): ?array
    {
        $rows = $this->client->query(<<<'YQL'
DECLARE $login AS Utf8;
SELECT * FROM users WHERE login = $login LIMIT 1;
YQL, ['$login' => $login]);

        return $rows[0] ?? null;
    }

    public function findByEmail(string $email): ?array
    {
        $rows = $this->client->query(<<<'YQL'
DECLARE $email AS Utf8;
SELECT * FROM users WHERE email = $email LIMIT 1;
YQL, ['$email' => $email]);

        return $rows[0] ?? null;
    }

    public function findById(int $id): ?array
    {
        $rows = $this->client->query(<<<'YQL'
DECLARE $id AS Uint64;
SELECT * FROM users WHERE user_id = $id LIMIT 1;
YQL, ['$id' => $id]);

        return $rows[0] ?? null;
    }

    public function create(array $data): array
    {
        $now = CarbonImmutable::now();
        $password = Hash::make($data['password']);

        $rows = $this->client->query(<<<'YQL'
DECLARE $login AS Utf8;
DECLARE $name AS Utf8;
DECLARE $email AS Utf8;
DECLARE $password AS Utf8;
DECLARE $created AS Datetime;
DECLARE $updated AS Datetime;

UPSERT INTO users(login, name, email, password, created_at, updated_at)
VALUES ($login, $name, $email, $password, $created, $updated)
RETURNING *;
YQL, [
            '$login' => $data['login'],
            '$name' => $data['name'],
            '$email' => $data['email'],
            '$password' => $password,
            '$created' => $now,
            '$updated' => $now,
        ]);

        return $rows[0] ?? [];
    }

    public function updateRememberToken(int $id, ?string $token): void
    {
        $this->client->statement(<<<'YQL'
DECLARE $id AS Uint64;
DECLARE $token AS Utf8?;

UPDATE users SET remember_token = $token WHERE user_id = $id;
YQL, [
            '$id' => $id,
            '$token' => $token,
        ]);
    }
}

