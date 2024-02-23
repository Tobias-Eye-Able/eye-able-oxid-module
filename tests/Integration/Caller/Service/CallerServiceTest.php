<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Caller\Service;

use EyeAble\EyeAbleAssist\Caller\Infrastructure\Caller;
use EyeAble\EyeAbleAssist\Caller\Infrastructure\Page;
use EyeAble\EyeAbleAssist\Caller\Service\CallerService;
use EyeAble\EyeAbleAssist\Caller\Exception\Caller as CallerException;
use EyeAble\EyeAbleAssist\Report\Model\Report;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;
use Symfony\Component\Filesystem\Path;

final class CallerServiceTest extends IntegrationTestCase
{
    public function testFetchReportSuccess(): void
    {
        $page = new Page(
            file_get_contents(Path::join(__DIR__, '..', '..', '..', 'Fixtures', 'success_response.txt')),
            '',
            ['http_code' => '200']
        );

        $caller = $this->createPartialMock(
            Caller::class,
            ['fetchReport']
        );
        $caller->method('fetchReport')
            ->willReturn($page);

        $service = new CallerService($caller);

        $reportId = $service->createReport();

        $this->assertNotEmpty($reportId);

        $report = oxNew(Report::class);
        $report->load($reportId);

        $this->assertTrue($report->isLoaded());
    }

    public function testFetchReportNoInfo(): void
    {
        $caller = $this->getCallerMock(
            new Page(
                '',
                '',
                ['bla' => '500']
            )
        );
        $service = new CallerService($caller);

        $this->expectException(CallerException::class);
        $service->createReport();
    }

    public function testFetchReportHttp500(): void
    {
        $caller = $this->getCallerMock(
            new Page(
                '',
                '',
                ['http_code' => '500']
            )
        );
        $service = new CallerService($caller);

        $this->expectException(CallerException::class);
        $service->createReport();
    }

    public function testFetchReportNoJson(): void
    {
        $caller = $this->getCallerMock(
            new Page(
                'no json',
                '',
                ['http_code' => '200']
            )
        );
        $service = new CallerService($caller);

        $this->expectException(CallerException::class);
        $service->createReport();
    }

    public function testFetchReportFailure(): void
    {
        $caller = $this->getCallerMock(
            new Page(
                file_get_contents(Path::join(__DIR__, '..', '..', '..', 'Fixtures', 'failure_response.txt')),
                '',
                ['http_code' => '200']
            )
        );
        $service = new CallerService($caller);

        $this->expectException(CallerException::class);
        $service->createReport();
    }

    private function getCallerMock(Page $page): Caller
    {
        $caller = $this->createPartialMock(
            Caller::class,
            ['fetchReport']
        );
        $caller->method('fetchReport')
            ->willReturn($page);

        return $caller;
    }
}
