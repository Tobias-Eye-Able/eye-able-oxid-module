<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Shop;

use EyeAble\EyeAbleAssist\Report\Model\ReportData;
use EyeAble\EyeAbleAssist\Report\Service\ReportServiceInterface;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;

class ViewConfig extends ViewConfig_parent
{
    public function getLatestEyeableReportData(): ?ReportData
    {
        return  ContainerFactory::getInstance()
            ->getContainer()
            ->get(ReportServiceInterface::class)
            ->getLatestReportData();
    }
}
