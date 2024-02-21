<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

class_alias(
    \OxidEsales\Eshop\Application\Controller\StartController::class,
    \EyeAble\EyeAbleAssist\Controller\StartController_parent::class
);

class_alias(
    \OxidEsales\Eshop\Core\ViewConfig::class,
    \EyeAble\EyeAbleAssist\Shop\ViewConfig_parent::class
);
