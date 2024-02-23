<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Report\Service;

use DateTime;
use EyeAble\EyeAbleAssist\Caller\Service\CallerService;
use EyeAble\EyeAbleAssist\Module\Service\Settings;
use EyeAble\EyeAbleAssist\Report\Infrastructure\ReportProvider;
use EyeAble\EyeAbleAssist\Report\Model\Report;
use EyeAble\EyeAbleAssist\Report\Model\ReportDataInterface;
use EyeAble\EyeAbleAssist\Report\Service\ReportService;
use EyeAble\EyeAbleAssist\Report\Service\ReportServiceInterface;
use EyeAble\EyeAbleAssist\Report\Service\ReportTrigger;
use EyeAble\EyeAbleAssist\Tests\Integration\TestHelperTrait;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

final class ReportTriggerTest extends IntegrationTestCase
{
    use TestHelperTrait;

    public function setUp(): void
    {
        parent::setUp();

        $this->prepareTestData();
    }

    public function testTriggerReportNotNeeded(): void
    {
        $report = $this->createPartialMock(
            Report::class,
            ['isLoaded', 'getReport']
        );
        $report->method('isLoaded')->willReturn(true);
        $report->method('getReport')
            ->willReturn(
                [
                    'crawlInfo' =>
                        [
                            'start' => 'some_url'
                        ],
                    'totalWarnings' => 13
                ]
            );

        $reportProvider = $this->createPartialMock(
            ReportProvider::class,
            ['getLatestReport']
        );
        $reportProvider->method('getLatestReport')
            ->willReturn($report);

        $callerService = $this->createPartialMock(CallerService::class, ['createReport']);
        $callerService->expects($this->never())->method('createReport');

        $settings = ContainerFactory::getInstance()
            ->getContainer()
            ->get(Settings::class);

        $service = new ReportTrigger(
            $reportProvider,
            $callerService,
            $settings
        );

        $service->triggerReport();
    }

    public function testTriggerReportNeedsARefresh(): void
    {
        $report = $this->createPartialMock(
            Report::class,
            ['isLoaded', 'getReport']
        );
        $report->method('isLoaded')->willReturn(true);
        $report->method('getReport')->willReturn([]);

        $reportProvider = $this->createPartialMock(
            ReportProvider::class,
            ['getLatestReport']
        );
        $reportProvider->method('getLatestReport')
            ->willReturn($report);

        $callerService = $this->createPartialMock(CallerService::class, ['createReport']);
        $callerService->expects($this->never())->method('createReport');

        $settings = ContainerFactory::getInstance()
            ->getContainer()
            ->get(Settings::class);

        $service = new ReportTrigger(
            $reportProvider,
            $callerService,
            $settings
        );

        $service->triggerReport();
    }

    public function testTriggerReportFirstCall(): void
    {
        $report = $this->createPartialMock(
            Report::class,
            ['isLoaded']
        );
        $report->method('isLoaded')->willReturn(false);

        $reportProvider = $this->createPartialMock(
            ReportProvider::class,
            ['getLatestReport']
        );
        $reportProvider->method('getLatestReport')
            ->willReturn($report);

        $callerService = $this->createPartialMock(CallerService::class, ['createReport']);
        $callerService->expects($this->once())->method('createReport');

        $settings = ContainerFactory::getInstance()
            ->getContainer()
            ->get(Settings::class);

        $service = new ReportTrigger(
            $reportProvider,
            $callerService,
            $settings
        );

        $service->triggerReport();
    }

    public function testTriggerReportRenew(): void
    {
        $report = $this->createPartialMock(
            Report::class,
            ['isLoaded', 'getIssuedAt']
        );
        $report->method('isLoaded')->willReturn(true);
        $report->method('getIssuedAt')->willReturn(new DateTime('2024-01-01 12:12:12'));

        $reportProvider = $this->createPartialMock(
            ReportProvider::class,
            ['getLatestReport']
        );
        $reportProvider->method('getLatestReport')
            ->willReturn($report);

        $callerService = $this->createPartialMock(CallerService::class, ['createReport']);
        $callerService->expects($this->once())->method('createReport');

        $settings = ContainerFactory::getInstance()
            ->getContainer()
            ->get(Settings::class);

        $service = new ReportTrigger(
            $reportProvider,
            $callerService,
            $settings
        );

        $service->triggerReport();
    }
}
