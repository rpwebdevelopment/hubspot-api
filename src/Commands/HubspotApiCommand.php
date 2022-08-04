<?php

namespace RpWebDevelopment\HubspotApi\Commands;

use Illuminate\Console\Command;

class HubspotApiCommand extends Command
{
    public $signature = 'hubspot-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
