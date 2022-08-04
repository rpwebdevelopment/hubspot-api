<?php

declare(strict_types=1);

namespace RpWebDevelopment\HubspotApi\Exceptions;

use Exception;

class ApiException extends Exception
{
    public static function invalidStage(): self
    {
        return new self('Invalid stage provided');
    }
}
