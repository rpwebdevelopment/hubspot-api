<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Contacts\Model\Filter;
use HubSpot\Client\Crm\Contacts\Model\FilterGroup;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest;
use HubSpot\Discovery\DiscoveryBase;

class Contact extends Api
{
    protected Filter $filter;
    protected DiscoveryBase $crm;
    protected FilterGroup $filterGroup;
    protected SimplePublicObjectInput $objectInput;
    protected PublicObjectSearchRequest $searchRequest;

    public function __construct(string $accessToken)
    {
        parent::__construct($accessToken);

        $this->filter = new Filter();
        $this->filterGroup = new FilterGroup();
        $this->objectInput = new SimplePublicObjectInput();
        $this->searchRequest = new PublicObjectSearchRequest();
        $this->crm = $this->hubspot->crm()->contacts();
    }
}
