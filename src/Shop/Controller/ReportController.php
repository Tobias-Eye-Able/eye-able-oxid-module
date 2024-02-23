<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Shop\Controller;

use EyeAble\EyeAbleAssist\Report\Service\ReportTrigger;
use OxidEsales\EshopCommunity\Application\Component\Widget\WidgetController;
use OxidEsales\EshopCommunity\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;

class ReportController extends WidgetController
{
    public function render()
    {
        return '';
    }

    public function triggerEyeableReport(): void
    {
        if ($this->isAdmin()) {
            Registry::getLogger()->debug('Trigger eye-able report');

            ContainerFactory::getInstance()
                ->getContainer()
                ->get(ReportTrigger::class)
                ->triggerReport();
        }

        if (!headers_sent()) {
            header_remove();
        }
        exit();
    }
}
