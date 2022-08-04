<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use \HubSpot\Discovery\Discovery;

class Api
{
    protected Discovery $hubspot;

    public function __construct(string $accessToken)
    {
        $this->hubspot = \HubSpot\Factory::createWithAccessToken($accessToken);
    }

    public function search(string $property, string $value): mixed
    {
        $this->filter
            ->setOperator('EQ')
            ->setPropertyName($property)
            ->setValue($value);

        $this->filterGroup->setFilters([$this->filter]);
        $this->searchRequest->setFilterGroups([$this->filterGroup]);

        $response = $this->crm
            ->searchApi()
            ->doSearch($this->searchRequest);

        $results = [];
        foreach($response->getResults() as $result) {
            $results[$result->getId()] = $result->getProperties();
        }

        return $results;
    }

    public function get(int $id): array
    {
        return $this->crm->basicApi()->getById($id)->getProperties();
    }

    public function create(array $properties): mixed
    {
        $this->objectInput->setProperties($properties);

        return $this->crm->basicApi()->create($this->objectInput);
    }

    public function update(int $id, array $properties): void
    {
        $this->objectInput->setProperties($properties);

        $this->crm->basicApi()->update($id, $this->objectInput);
    }

    public function archive(int $id): void
    {
        $this->crm->basicApi()->archive($id);
    }
}
