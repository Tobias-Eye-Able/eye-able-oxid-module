<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Caller\Infrastructure;

final class Page
{
    public function __construct(
        private string $content,
        private string $errorMessage,
        private array $info
    ) {
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getInfo(): array
    {
        return $this->info;
    }
}
