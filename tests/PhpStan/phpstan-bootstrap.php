<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

class_alias(
    \OxidEsales\Eshop\Application\Model\User::class,
    \OxidEsales\EyeAble\Model\User_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Controller\StartController::class,
    \OxidEsales\EyeAble\Controller\StartController_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Model\Basket::class,
    \OxidEsales\EyeAble\Model\Basket_parent::class
);
