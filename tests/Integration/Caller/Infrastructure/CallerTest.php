<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration\Caller\Infrastructure;

use EyeAble\EyeAbleAssist\Caller\Infrastructure\Caller;
use EyeAble\EyeAbleAssist\Caller\Infrastructure\Page;
use EyeAble\EyeAbleAssist\Module\Service\Settings;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Transition\Utility\Context;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;
use OxidEsales\Facts\Facts;

final class CallerTest extends IntegrationTestCase
{
    public function testFetchReportFromApi(): void
    {
        #Provide api url and key in settings to be able to run this test successfully
        $this->markTestSkipped('Use for manual testing only, test calls the eye-able api');

        $facts = $this->createPartialMock(
            Facts::class,
            ['getShopUrl', 'isEnterprise']
        );
        $facts->method('getShopUrl')
            ->willReturn('https://zugang4all.de');
        $facts->method('isEnterprise')
            ->willReturn(false); //prevent shp parameter on non shop url

        $context = $this->createPartialMock(
            Context::class,
            ['getFacts']
        );
        $context->method('getFacts')
            ->willReturn($facts);

        $settings = ContainerFactory::getInstance()
            ->getContainer()
            ->get(Settings::class);

        $caller = new Caller($context, $settings);
        $page = $caller->fetchReport();

        $this->assertInstanceOf(Page::class, $page);
        $this->assertEquals('', $page->getErrorMessage());
        $this->assertEquals(200, $page->getInfo()['http_code']);
        $this->assertNotEmpty($page->getContent());
    }
}
