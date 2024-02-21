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
        $reportModel = $this->reportProvider->getLatestReport();

        if (
            !$reportModel->isLoaded() ||
            !$reportModel->getIssuedAt() ||
            ($reportModel->getIssuedAt()->getTimestamp() + $this->settings->getFrequency() < microtime(true))
        ) {
            try {
                $this->caller->createReport();
            } catch (CallerException $exception) {
                Registry::getLogger()->debug($exception->getMessage());
            }
        }
    }
}
