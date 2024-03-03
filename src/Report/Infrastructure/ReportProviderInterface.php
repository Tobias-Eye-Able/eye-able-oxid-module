<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

namespace EyeAble\EyeAbleAssist\Report\Infrastructure;

use EyeAble\EyeAbleAssist\Report\Model\Report;

interface ReportProviderInterface
{
    public function getLatestReport(bool $includeEmpty = false): Report;
}
