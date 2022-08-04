<?php

namespace RpWebDevelopment\HubspotApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RpWebDevelopment\HubspotApi\HubspotApi
 */
class HubspotApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RpWebDevelopment\HubspotApi\HubspotApi::class;
    }
}
