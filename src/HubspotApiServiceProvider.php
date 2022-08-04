<?php

namespace RpWebDevelopment\HubspotApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RpWebDevelopment\HubspotApi\Commands\HubspotApiCommand;

class HubspotApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('hubspot-api')
            ->hasConfigFile();
    }
}
