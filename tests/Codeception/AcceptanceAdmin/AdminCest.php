<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Codeception;

use EyeAble\EyeAbleAssist\Tests\Codeception\AcceptanceAdminTester;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * @group eyeable_assist
 * @group eyeable_assist_admin
 */
final class AdminCest
{
    public function testAdminHomeNoReportYet(AcceptanceAdminTester $I): void
    {
        $I->wantToTest('that the eye able information is visible on the admin start page but no report details');

        $I->clearShopCache();
        $I->loginAdmin();

        $I->waitForText(Translator::translate('EYEABLE_REPORT_TITLE'));
        $I->waitForText(Translator::translate('EYEABLE_PLEASE_WAIT_FOR_REPORT'));
    }

    public function testAdminHomeReport(AcceptanceAdminTester $I): void
    {
        $I->wantToTest('that the eye able report is visible on the admin start page');

        $this->insertReport($I);

        $I->clearShopCache();
        $I->loginAdmin();

        $I->waitForText(Translator::translate('EYEABLE_REPORT_TITLE'));
        $I->waitForText(Translator::translate('EYEABLE_LATEST_REPORT_PAGE') . 'http://myoxidehop.local');
        $I->waitForText(Translator::translate('EYEABLE_LATEST_REPORT_ERRORCOUNT') . '66');
        $I->waitForText(Translator::translate('EYEABLE_LATEST_REPORT_DATE'));
        $I->waitForText(date('Y-m-d 12:12:12'));
    }

    private function insertReport(AcceptanceAdminTester $I): void
    {
        $data = [
            'crawlInfo' => [
                'start' => 'http://myoxidehop.local',
            ],
            'totalWarnings' => '66'
        ];

        $I->haveInDatabase(
            'eyeablereports',
            [
                'OXID' => 'report_1',
                'OXSHOPID' => 1,
                'REPORT' => json_encode($data),
                'ISSUED_AT' => date('Y-m-d 12:12:12')
            ]
        );
    }
}
