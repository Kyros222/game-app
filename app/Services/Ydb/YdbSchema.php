<?php

namespace App\Services\Ydb;

class YdbSchema
{
    public function __construct(private readonly YdbTableClient $client)
    {
    }

    /**
     * Создает необходимые таблицы, если их еще нет.
     */
    public function ensure(): void
    {
        $this->client->statement(<<<'YQL'
CREATE TABLE IF NOT EXISTS users (
    user_id Serial NOT NULL,
    login Utf8 NOT NULL,
    name Utf8 NOT NULL,
    email Utf8 NOT NULL,
    password Utf8 NOT NULL,
    remember_token Utf8,
    created_at Datetime,
    updated_at Datetime,
    PRIMARY KEY (user_id)
);
YQL);

        $this->client->statement(<<<'YQL'
CREATE TABLE IF NOT EXISTS trends (
    id Serial NOT NULL,
    title Utf8 NOT NULL,
    image Utf8 NOT NULL,
    followers Uint64 NOT NULL,
    created_at Datetime,
    updated_at Datetime,
    deleted_at Datetime,
    PRIMARY KEY (id)
);
YQL);
    }
}

