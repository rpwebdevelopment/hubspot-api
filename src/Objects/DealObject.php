<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Objects;

class DealObject
{
    public const NAME = 'dealname';
    public const STAGE = 'dealstage';
    public const OWNER = 'hubspot_owner_id';
    public const TEAM = 'hubspot_team_id';
    public const TYPE = 'dealtype';
    public const AMOUNT = 'amount';
    public const CURRENCY = 'deal_currency_code';
    public const CURRENCY_AMOUNT = 'amount_in_home_currency';
    public const DESCRIPTION = 'description';
    public const PIPELINE = 'pipeline';
    public const CREATE_DATE = 'createdate';
    public const CLOSING_DATE = 'closedate';
    public const CLOSED_LOST_REASON = 'closed_lost_reason';
    public const CLOSED_WON_REASON = 'closed_won_reason';
}
