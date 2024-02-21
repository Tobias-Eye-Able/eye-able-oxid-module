<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Tests\Integration;

use OxidEsales\Eshop\Application\Controller\StartController as EshopStartController;
use PHPUnit\Framework\TestCase;

/*
 * Integration test example
 */
final class StartControllerRenderTest extends TestCase
{
    public function testRender(): void
    {
        $controller = oxNew(EshopStartController::class);

        $this->assertSame('page/shop/start', $controller->render());
    }
}
