<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

namespace EyeAble\EyeAbleAssist\Caller\Infrastructure;

interface CallerInterface
{
    public function fetchReport(): Page;
}
