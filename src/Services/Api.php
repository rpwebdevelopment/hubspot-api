<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use \HubSpot\Discovery\Discovery;
use HubSpot\Factory;

class Api
{
    protected Discovery $hubspot;

    public function __construct(string $accessToken)
    {
        $this->hubspot = Factory::createWithAccessToken($accessToken);
    }

    public function getHubspot(): Discovery
    {
        return $this->hubspot;
    }
}
