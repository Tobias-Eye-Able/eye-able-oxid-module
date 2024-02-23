<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Report\Service;

use EyeAble\EyeAbleAssist\Report\Model\ReportData;
use EyeAble\EyeAbleAssist\Report\Model\ReportDataInterface;
use EyeAble\EyeAbleAssist\Report\Service\ReportServiceInterface;
use EyeAble\EyeAbleAssist\Tests\Integration\TestHelperTrait;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

final class ReportServiceTest extends IntegrationTestCase
{
    use TestHelperTrait;

    public function testGetLatestReportData(): void
    {
        $this->prepareTestData();

        $provider = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ReportServiceInterface::class);

        /** @var ReportDataInterface $report */
         $report = $provider->getLatestReportData();

         $this->assertSame(21, $report->getErrorCount());
         $this->assertSame('http://myoxidehop.local', $report->getTestedPage());
    }

    public function testGetLatestReportDataNoReport(): void
    {
        $provider = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ReportServiceInterface::class);

        /** @var ReportDataInterface $report */
        $report = $provider->getLatestReportData();

        $this->assertSame(-1, $report->getErrorCount());
        $this->assertEmpty($report->getTestedPage());
    }
}
