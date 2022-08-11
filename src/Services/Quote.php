<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Quotes\Model\Filter;
use HubSpot\Client\Crm\Quotes\Model\FilterGroup;
use HubSpot\Client\Crm\Quotes\Model\SimplePublicObjectInput;
use HubSpot\Client\Crm\Quotes\Model\PublicObjectSearchRequest;
use HubSpot\Crm\ObjectType;
use HubSpot\Discovery\DiscoveryBase;
use RpWebDevelopment\HubspotApi\Traits\Searchable;

final class Quote extends Hubspot
{
    use Searchable;

    protected Filter $filter;
    protected DiscoveryBase $crm;
    protected FilterGroup $filterGroup;
    protected SimplePublicObjectInput $objectInput;
    protected PublicObjectSearchRequest $searchRequest;

    public function __construct(Api $api)
    {
        parent::__construct($api);

        $this->objectType = ObjectType::QUOTES;
        $this->filter = new Filter();
        $this->filterGroup = new FilterGroup();
        $this->objectInput = new SimplePublicObjectInput();
        $this->searchRequest = new PublicObjectSearchRequest();
        $this->crm = $this->hubspot->crm()->companies();
    }
}
