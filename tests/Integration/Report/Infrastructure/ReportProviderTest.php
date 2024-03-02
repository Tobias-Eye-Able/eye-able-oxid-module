<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Report\Infrastructure;

use EyeAble\EyeAbleAssist\Tests\Integration\TestHelperTrait;
use EyeAble\EyeAbleAssist\Report\Infrastructure\ReportProvider;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

final class ReportProviderTest extends IntegrationTestCase
{
    use TestHelperTrait;

    public function setUp(): void
    {
        parent::setUp();

        $this->prepareTestData();
    }

    public function testGetLatestReport(): void
    {
        $provider = new ReportProvider(
            ContainerFactory::getInstance()
            ->getContainer()
            ->get(QueryBuilderFactoryInterface::class)
        );

         $report = $provider->getLatestReport();

         $this->assertSame($this->second, $report->getId());
    }

    public function testGetLatestReportIncludeEmpty(): void
    {
        $provider = new ReportProvider(
            ContainerFactory::getInstance()
                ->getContainer()
                ->get(QueryBuilderFactoryInterface::class)
        );

        $report = $provider->getLatestReport(true);

        $this->assertSame($this->third, $report->getId());
    }
}
