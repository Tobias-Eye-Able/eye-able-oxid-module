<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Caller\Exception;

use Exception;

final class Caller extends Exception
{
    public static function byHttpResponseCode(int $code): self
    {
        return new self(sprintf('Did not get expected http response code 200, got %s', $code));
    }

    public static function byErrorMessage(string $message): self
    {
        return new self(sprintf('Error message in response: %s', $message));
    }

    public static function byContent(): self
    {
        return new self('Response is not in json format.');
    }

    public static function byReport(): self
    {
        return new self('Response does not contain a summary report.');
    }
}
