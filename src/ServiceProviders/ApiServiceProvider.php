<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use RpWebDevelopment\HubspotApi\Interfaces\ApiInterface;
use RpWebDevelopment\HubspotApi\Services\Api;
use RpWebDevelopment\HubspotApi\Services\Contact;
use RpWebDevelopment\HubspotApi\Services\Deal;

class ApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ApiInterface::class, Api::class);
        $this->app->bind(
            Api::class,
            static function (): Api {
                return new Api(
                    config('hubspot-api.api.access_token')
                );
            }
        );

        $this->app->bind(
            Contact::class,
            static function (): Contact {
                return new Contact(
                    config('hubspot-api.api.access_token')
                );
            }
        );

        $this->app->bind(
            Deal::class,
            static function (): Deal {
                return new Deal(
                    config('hubspot-api.api.access_token')
                );
            }
        );
    }
}
