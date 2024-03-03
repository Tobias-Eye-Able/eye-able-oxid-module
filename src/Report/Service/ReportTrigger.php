<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Report\Service;

use EyeAble\EyeAbleAssist\Caller\Exception\Caller as CallerException;
use EyeAble\EyeAbleAssist\Caller\Service\CallerServiceInterface;
use EyeAble\EyeAbleAssist\Report\Infrastructure\ReportProviderInterface;
use EyeAble\EyeAbleAssist\Report\Model\Report;
use OxidEsales\EshopCommunity\Core\Registry;
use EyeAble\EyeAbleAssist\Module\Service\Settings as ModuleSettings;

class ReportTrigger
{
    public function __construct(
        private ReportProviderInterface $reportProvider,
        private CallerServiceInterface $caller,
        private ModuleSettings $settings
    ) {
    }

    public function triggerReport(): void
    {
        $reportModel = $this->reportProvider->getLatestReport(true);

        Registry::getLogger()->debug('trigger start');
        $start = microtime(true);
        $mustFetch = false;

        if ($this->needValidReport($reportModel) ) {
            $mustFetch = true;
            $reportModel->delete();
        }

        if (!$reportModel->isLoaded() || $mustFetch || $this->needNewReport($reportModel)) {
            try {
                $this->caller->createReport();
            } catch (CallerException $exception) {
                Registry::getLogger()->debug($exception->getMessage());
            }
        }
        Registry::getLogger()->debug('trigger stop ' . (microtime(true) - $start));
    }

    private function needNewReport(Report $report): bool
    {
        return ($report->getIssuedAt()->getTimestamp() + $this->settings->getFrequency() < microtime(true));
    }

    private function needValidReport(Report $report): bool
    {
        $issuedAt = $report->getIssuedAt()->getTimestamp();

        return (!isset($report->getReport()['crawlInfo']) &&
            ($issuedAt + $this->settings->getRefreshOnlyAfter() < microtime(true)));
    }
}
