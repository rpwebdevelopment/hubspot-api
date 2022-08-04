<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use RpWebDevelopment\HubspotApi\Services\Api;

class ApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            Api::class,
            static function (): Api {
                return new Api(
                    config('hubspot-api.api.access_token')
                );
            }
        );
    }
}
