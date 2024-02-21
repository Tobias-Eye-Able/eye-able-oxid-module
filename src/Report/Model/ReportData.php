<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Report\Model;

final class ReportData implements ReportDataInterface
{
    public function __construct(
        private string $page,
        private int $errorCount,
        private string $date
    ) {
    }

    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    public function getTestedPage(): string
    {
        return $this->page;
    }

    public function getReportDate(): string
    {
        return $this->date;
    }
}
