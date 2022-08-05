<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Owners\Model\PublicOwner;
use HubSpot\Discovery\DiscoveryBase;

final class Owner extends Hubspot
{
    protected DiscoveryBase $crm;

    public function __construct(Api $api)
    {
        parent::__construct($api);

        $this->crm = $this->hubspot->crm()->owners();
    }

    public function getByEmail(string $email): array
    {
        $result = ($this->crm->ownersApi()->getPage($email)->getResults())[0];

        return $this->formatObject($result);
    }

    public function get(int $ownerId): array
    {
        $result = $this->crm->ownersApi()->getById($ownerId);

        return $this->formatObject($result);
    }

    public function formatObject(PublicOwner $owner): array
    {
        return [
            'id' => $owner->getId(),
            'email' => $owner->getEmail(),
            'first_name' => $owner->getFirstName(),
            'last_name' => $owner->getLastName(),
        ];
    }
}
