<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Interfaces;

interface ApiInterface
{
    public function search(string $property, string $value): array;

    public function create(array $properties): mixed;

    public function update(int $id, array $properties): void;

    public function archive(int $id): void;
}
