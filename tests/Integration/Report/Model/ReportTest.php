<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Report\Model;

use EyeAble\EyeAbleAssist\Report\Model\Report;
use EyeAble\EyeAbleAssist\Tests\Integration\TestHelperTrait;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;
use DateTime;

final class ReportTest extends IntegrationTestCase
{
    use TestHelperTrait;

    private const OTHER_REPORT_OXID = 'other_report';

    /**
     * @var string[]
     */
    private $otherData = [
        'http://myoxidehop.local',
        'totalWarnings' => '12'
    ];

    public function testLoadReportById(): void
    {
        $this->prepareTestData();

        $report = oxNew(Report::class);
        $report->load($this->first);

        $this->assertTrue($report->isLoaded());
    }

    public function testWriteReport(): void
    {
        $report = oxNew(Report::class);
        $date = new DateTime('2024-02-03 12:12:12');

        $report->setId(self::OTHER_REPORT_OXID);
        $report->setReport($this->otherData);
        $report->setIssuedAt($date);
        $report->save();

        $report = oxNew(Report::class);
        $report->load(self::OTHER_REPORT_OXID);
        $this->assertTrue($report->isLoaded());

        $this->assertEquals($date, $report->getIssuedAt());
        $this->assertEquals($this->otherData, $report->getReport());
    }
}
