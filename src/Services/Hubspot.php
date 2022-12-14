<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Properties\Model\CollectionResponseProperty;
use HubSpot\Discovery\Discovery;

class Hubspot
{
    protected string $objectType = '';
    protected Discovery $hubspot;

    public function __construct(protected Api $api)
    {
        $this->hubspot = $api->getHubspot();
    }

    public function get(int $id): array
    {
        return $this->crm->basicApi()->getById($id)->getProperties();
    }

    public function create(array $properties): mixed
    {
        $this->objectInput->setProperties($properties);

        return $this->crm->basicApi()->create($this->objectInput);
    }

    public function update(int $id, array $properties): void
    {
        $this->objectInput->setProperties($properties);

        $this->crm->basicApi()->update($id, $this->objectInput);
    }

    public function archive(int $id): void
    {
        $this->crm->basicApi()->archive($id);
    }

    public function getAssociation(int $id, string $associatedType): array
    {
        $results = $this->crm->associationsApi()
            ->getAll($id, $associatedType)
            ->getResults();

        $association = [];
        foreach ($results as $result) {
            $association[] = $result->getId();
        }

        return $association;
    }

    public function getProperties(): CollectionResponseProperty
    {
        return $this->hubspot->crm()->properties()->coreApi()->getAll($this->objectType);
    }

    public function setAssociation(int $id, string $associatedType, int $associatedId, string $linkType): void
    {
        $this->crm->associationsApi()->create($id, $associatedType, $associatedId, $linkType);
    }

    public function archiveAssociation(int $id, string $associatedType, int $associatedId, string $linkType): void
    {
        $this->crm->associationsApi()->archive($id, $associatedType, $associatedId, $linkType);
    }
}
