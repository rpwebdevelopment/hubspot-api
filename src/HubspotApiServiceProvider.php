<?php

namespace RpWebDevelopment\HubspotApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RpWebDevelopment\HubspotApi\Commands\HubspotApiCommand;

class HubspotApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('hubspot-api')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_hubspot-api_table')
            ->hasCommand(HubspotApiCommand::class);
    }
}
