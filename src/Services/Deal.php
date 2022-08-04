<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Deals\Model\Filter;
use HubSpot\Client\Crm\Deals\Model\FilterGroup;
use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;
use HubSpot\Client\Crm\Deals\Model\PublicObjectSearchRequest;
use HubSpot\Discovery\DiscoveryBase;

class Deal extends Api
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
        $this->crm = $this->hubspot->crm()->deals();
    }
}
