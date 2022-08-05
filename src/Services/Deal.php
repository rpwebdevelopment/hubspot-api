<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Deals\Model\Filter;
use HubSpot\Client\Crm\Deals\Model\FilterGroup;
use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;
use HubSpot\Client\Crm\Deals\Model\PublicObjectSearchRequest;
use HubSpot\Crm\ObjectType;
use HubSpot\Discovery\DiscoveryBase;
use RpWebDevelopment\HubspotApi\Exceptions\ApiException;

final class Deal extends Hubspot
{
    public array $dealPipelines = [];
    public array $dealStages = [];
    protected Filter $filter;
    protected DiscoveryBase $crm;
    protected FilterGroup $filterGroup;
    protected SimplePublicObjectInput $objectInput;
    protected PublicObjectSearchRequest $searchRequest;

    public function __construct(Api $api)
    {
        parent::__construct($api);

        $this->filter = new Filter();
        $this->filterGroup = new FilterGroup();
        $this->objectInput = new SimplePublicObjectInput();
        $this->searchRequest = new PublicObjectSearchRequest();
        $this->crm = $this->hubspot->crm()->deals();
        $this->getDealStages();
    }

    public function setDealStage(int $dealId, string $stageLabel): void
    {
        if (!isset($this->dealStages[$stageLabel])) {
            throw ApiException::invalidStage();
        }

        $properties = ['dealstage' => $this->dealStages[$stageLabel]];

        $this->update($dealId, $properties);
    }

    public function getContacts(int $dealId): array
    {
        return $this->getAssociation($dealId, ObjectType::CONTACTS);
    }

    public function addContact(int $dealId, int $contactId): void
    {
        $this->setAssociation($dealId, ObjectType::CONTACTS, $contactId, 'deal_to_contact');
    }

    public function removeContact(int $dealId, int $contactId): void
    {
        $this->archiveAssociation($dealId, ObjectType::CONTACTS, $contactId, 'deal_to_contact');
    }

    protected function getDealPipelines(): void
    {
        $results = $this->hubspot
            ->crm()
            ->pipelines()
            ->pipelinesApi()
            ->getAll(ObjectType::DEALS)
            ->getResults();

        foreach ($results as $result) {
            $this->dealPipelines[$result->getLabel()] = $result->getId();
        }
    }

    protected function getDealStages(): void
    {
        $this->getDealPipelines();

        foreach ($this->dealPipelines as $pipeline) {
            $results = $this->hubspot
                ->crm()
                ->pipelines()
                ->pipelineStagesApi()
                ->getAll(ObjectType::DEALS, $pipeline)
                ->getResults();

            foreach ($results as $result) {
                $this->dealStages[$result->getLabel()] = $result->getId();
            }
        }
    }
}
