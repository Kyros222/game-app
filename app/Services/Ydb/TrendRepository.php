<?php

namespace App\Services\Ydb;

use Carbon\CarbonImmutable;

class TrendRepository
{
    public function __construct(private readonly YdbTableClient $client)
    {
    }

    public function top(int $limit = 4): array
    {
        return $this->client->query(<<<'YQL'
DECLARE $limit AS Uint64;
SELECT * FROM trends
WHERE deleted_at IS NULL
ORDER BY followers DESC
LIMIT $limit;
YQL, ['$limit' => $limit]);
    }

    public function all(): array
    {
        return $this->client->query(<<<'YQL'
SELECT * FROM trends
WHERE deleted_at IS NULL
ORDER BY followers DESC;
YQL);
    }

    public function create(array $data): array
    {
        $now = CarbonImmutable::now();

        $rows = $this->client->query(<<<'YQL'
DECLARE $title AS Utf8;
DECLARE $image AS Utf8;
DECLARE $followers AS Uint64;
DECLARE $created AS Datetime;
DECLARE $updated AS Datetime;

UPSERT INTO trends(title, image, followers, created_at, updated_at)
VALUES ($title, $image, $followers, $created, $updated)
RETURNING *;
YQL, [
            '$title' => $data['title'] ?? 'Title',
            '$image' => $data['image'],
            '$followers' => (int) $data['followers'],
            '$created' => $now,
            '$updated' => $now,
        ]);

        return $rows[0] ?? [];
    }

    public function existsByImage(string $image): bool
    {
        $rows = $this->client->query(<<<'YQL'
DECLARE $image AS Utf8;
SELECT COUNT(*) AS cnt FROM trends WHERE image = $image;
YQL, ['$image' => $image]);

        return !empty($rows[0]['cnt'] ?? 0);
    }
}

