<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Contacts\Model\Filter as ContactFilter;
use HubSpot\Client\Crm\Contacts\Model\FilterGroup as ContactFilterGroup;
use HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest as ContactSearchRequest;
use Hubspot\Factory;
use HubSpot\Discovery\Discovery;
use HubSpot\Client\Crm\Deals\Model\Filter as DealFilter;
use HubSpot\Client\Crm\Deals\Model\FilterGroup as DealFilterGroup;
use HubSpot\Client\Crm\Deals\Model\PublicObjectSearchRequest as DealSearchRequest;

class Api
{
    private Discovery $hubspot;

    public function __construct(string $accessToken)
    {
        $this->hubspot = Factory::createWithAccessToken($accessToken);
    }

    public function contactSearch(string $property, string $value)
    {
        $filter = new ContactFilter();
        $filter
            ->setOperator('EQ')
            ->setPropertyName($property)
            ->setValue($value);

        $filterGroup = new ContactFilterGroup();
        $filterGroup->setFilters([$filter]);

        $searchRequest = new ContactSearchRequest();
        $searchRequest->setFilterGroups([$filterGroup]);

        $response = $this->hubspot
            ->crm()
            ->contacts()
            ->searchApi()
            ->doSearch($searchRequest);

        foreach($response->getResults() as $result) {
            $results[$result->getId()] = $result->getProperties();
        }

        return $results;
    }

    public function dealSearch(string $property, string $value): array
    {
        $filter = new DealFilter();
        $filter
            ->setOperator('EQ')
            ->setPropertyName($property)
            ->setValue($value);

        $filterGroup = new DealFilterGroup();
        $filterGroup->setFilters([$filter]);

        $searchRequest = new DealSearchRequest();
        $searchRequest->setFilterGroups([$filterGroup]);

        $response = $this->hubspot
            ->crm()
            ->deals()
            ->searchApi()
            ->doSearch($searchRequest);

        foreach($response->getResults() as $result) {
            $results[$result->getId()] = $result->getProperties();
        }

        return $results;
    }
}
