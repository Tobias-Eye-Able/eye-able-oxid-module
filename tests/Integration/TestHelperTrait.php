<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration;

use EyeAble\EyeAbleAssist\Report\Model\Report;
use OxidEsales\EshopCommunity\Core\Registry;

trait TestHelperTrait
{
    private $first = 'report_1';
    private $second = 'report_2';

    /**
     * @var string[]
     */
    private $data = [
        'first' => [
            'url' => 'http://myoxidehop.local',
            'page' => 'startpage',
            'errorcount' => '66'
        ],
        'second' => [
            'url' => 'http://myoxidehop.local',
            'page' => 'startpage',
            'errorcount' => '21'
        ],
    ];

    private function prepareTestData(): void
    {
        $report = oxNew(Report::class);
        $report->setId($this->first);
        $report->setShopId(1);
        $report->setReport($this->data['first']);
        $report->setIssuedAt(new \DateTime('2024-01-01 12:12:12'));
        $report->save();

        $report = oxNew(Report::class);
        $report->setId($this->second);
        $report->setShopId(1);
        $report->setReport($this->data['second']);
        $report->setIssuedAt(new \DateTime('2024-02-01 12:12:12'));
        $report->save();
    }
}
