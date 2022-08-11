<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Objects;

class LineItemObject
{
    public const NAME = 'name';
    public const PRICE = 'price';
    public const QUANTITY = 'quantity';
    public const SKU = 'hs_sku';
    public const CURRENCY = 'hs_line_item_currency_code';
    public const FREQUENCY = 'recurringbillingfrequency';
    public const START_DATE = 'hs_recurring_billing_start_date';
    public const DESCRIPTION = 'description';
    public const TERM_MONTHS = 'hs_term_in_months';
    public const UNIT_DISCOUNT = 'discount';
}
