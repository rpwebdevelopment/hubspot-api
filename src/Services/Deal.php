<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Services;

use HubSpot\Client\Crm\Deals\Model\Filter;
use HubSpot\Client\Crm\Deals\Model\FilterGroup;
use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;
use HubSpot\Client\Crm\Deals\Model\PublicObjectSearchRequest;
use HubSpot\Discovery\DiscoveryBase;
use Illuminate\Support\Str;
use RpWebDevelopment\HubspotApi\Exceptions\ApiException;

final class Deal extends Api
{
    public array $dealPipelines = [];
    public array $dealStages = [];
    protected Filter $filter;
    protected DiscoveryBase $crm;
    protected FilterGroup $filterGroup;
    protected SimplePublicObjectInput $objectInput;
    protected PublicObjectSearchRequest $searchRequest;

    public function __construct(string $accessToken)
    {
        parent::__construct($accessToken);

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

    protected function getDealPipelines(): void
    {
        $results = $this->hubspot
            ->crm()
            ->pipelines()
            ->pipelinesApi()
            ->getAll('deals')
            ->getResults();

        foreach ($results as $result) {
            $key = Str::of($result->getLabel())->lower()->kebab()->toString();
            $this->dealPipelines[$key] = $result->getId();
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
                ->getAll('deals', $pipeline)
                ->getResults();

            foreach ($results as $result) {
                $key = Str::of($result->getLabel())->lower()->kebab()->toString();
                $this->dealStages[$key] = $result->getId();
            }
        }
    }
}
