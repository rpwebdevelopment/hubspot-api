<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Traits;

trait Searchable
{
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
}
