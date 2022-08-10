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
use RpWebDevelopment\HubspotApi\Traits\Searchable;

final class Deal extends Hubspot
{
    use Searchable;

    protected array $dealPipelines = [];
    protected array $dealStages = [];
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
        $this->setDealStages();
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

    public function getLineItems(int $dealId): array
    {
        return $this->getAssociation($dealId, ObjectType::LINE_ITEMS);
    }

    public function associateContact(int $dealId, int $contactId): void
    {
        $this->setAssociation($dealId, ObjectType::CONTACTS, $contactId, 'deal_to_contact');
    }

    public function associateLineItem(int $dealId, int $lineItemId): void
    {
        $this->setAssociation($dealId, ObjectType::LINE_ITEMS, $lineItemId, 'deal_to_line_item');
    }

    public function removeContact(int $dealId, int $contactId): void
    {
        $this->archiveAssociation($dealId, ObjectType::CONTACTS, $contactId, 'deal_to_contact');
    }

    public function getDealPipelines(): array
    {
        return $this->dealPipelines;
    }

    public function getDealStages(): array
    {
        return $this->dealStages;
    }

    protected function setDealPipelines(): void
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

    protected function setDealStages(): void
    {
        $this->setDealPipelines();

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
