<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Caller\Service;

use EyeAble\EyeAbleAssist\Caller\Exception\Caller;
use EyeAble\EyeAbleAssist\Caller\Infrastructure\Page;
use EyeAble\EyeAbleAssist\Caller\Infrastructure\CallerInterface;
use EyeAble\EyeAbleAssist\Report\Model\Report;
use DateTime;

class CallerService implements CallerServiceInterface
{
    public function __construct(private CallerInterface $caller)
    {
    }

    public function createReport(): ?string
    {
        $report = oxNew(Report::class);
        $report->setReport([]);
        $report->setIssuedAt(new DateTime('now'));
        $report->save();

        $page = $this->caller->fetchReport();
        $this->validateReport($page);

        $decoded = json_decode($page->getContent(), true);
        if (
            (false == $decoded) ||
            !isset($decoded['summary'])
        ) {
            throw Caller::byReport();
        }

        $report->setReport($decoded['summary']);
        $report->save();

        return $report->getId();
    }

    private function validateReport(Page $page): void
    {
        if (
            !is_array($page->getInfo()) ||
            !isset($page->getInfo()['http_code']) ||
            200 !== (int) $page->getInfo()['http_code']
        ) {
            $code = isset($page->getInfo()['http_code']) ? (int) $page->getInfo()['http_code'] : -1;
            throw Caller::byHttpResponseCode($code);
        }
        if (0 < strlen($page->getErrorMessage())) {
            throw Caller::byErrorMessage($page->getErrorMessage());
        }
        if (0 == strlen($page->getContent())) {
            throw Caller::byContent();
        }
    }
}
