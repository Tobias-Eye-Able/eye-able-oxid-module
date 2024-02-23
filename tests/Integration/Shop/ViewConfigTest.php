<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Shop;

use EyeAble\EyeAbleAssist\Report\Model\ReportDataInterface;
use EyeAble\EyeAbleAssist\Tests\Integration\TestHelperTrait;
use OxidEsales\Eshop\Core\ViewConfig;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

final class ViewConfigTest extends IntegrationTestCase
{
    use TestHelperTrait;

    public function testGetLatestEyeableReportDataNoDataYet(): void
    {
        $viewConfig = oxNew(ViewConfig::class);

        $reportData = $viewConfig->getLatestEyeableReportData();

        $this->assertInstanceOf(ReportDataInterface::class, $reportData);
        $this->assertEquals(-1, $reportData->getErrorCount());
        $this->assertEquals('', $reportData->getTestedPage());
    }

    public function testGetLatestEyeableReportData(): void
    {
        $this->prepareTestData();

        $viewConfig = oxNew(ViewConfig::class);

        $reportData = $viewConfig->getLatestEyeableReportData();

        $this->assertInstanceOf(ReportDataInterface::class, $reportData);
        $this->assertEquals(21, $reportData->getErrorCount());
        $this->assertEquals('http://myoxidehop.local', $reportData->getTestedPage());
        $this->assertEquals('2024-02-01 12:12:12', $reportData->getReportDate());
    }
}
