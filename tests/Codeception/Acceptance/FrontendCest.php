<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Codeception;

use Codeception\Util\Fixtures;
use EyeAble\EyeAbleAssist\Tests\Codeception\AcceptanceTester;

/**
 * @group eyeable_assist
 * @group eyeable_assist_frontend
 */
final class FrontendCest
{
    public function testEyeAbleAssistIsVisibleOnStartPage(AcceptanceTester $I): void
    {
        $I->wantToTest('that the eye able assist is visible on the start page');

        $I->openShop();
        $I->waitForPageLoad();

        $source = $I->grabPageSource();
        $I->assertStringContainsString('eye-able', $source);
        $I->assertStringContainsString('eyeAbleWebsitePlugin', $source);
    }

    public function testEyeAbleAssistIsVisibleOnContact(AcceptanceTester $I): void
    {
        $I->wantToTest('that the eye able assist is visible on account page');

        $I->openShop()
            ->loginUser(Fixtures::get('user')['email' ], Fixtures::get('user')['password'])
            ->openAccountPage()
            ->seePageOpened();

        $source = $I->grabPageSource();
        $I->assertStringContainsString('eye-able', $source);
        $I->assertStringContainsString('eyeAbleWebsitePlugin', $source);
    }

    private function getExistingUserData()
    {
        return Fixtures::get('user');
    }
}
