<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Report\Model;

use OxidEsales\Eshop\Core\Model\BaseModel;
use DateTime;

class Report extends BaseModel
{
    protected $_sClassName = 'eyablereport';

    protected $_sCoreTable = 'eyeablereports';

    public function __construct()
    {
        parent::__construct();
        $this->init('eyeablereports');
    }

    public function getReport(): array
    {
        return $this->getRawFieldData('report') ?
            json_decode($this->getRawFieldData('report'), true) : [];
    }

    public function getIssuedAt(): DateTime
    {
        return $this->getRawFieldData('issued_at') ?
            new DateTime($this->getFieldData('issued_at')) : new DateTime('now');
    }

    public function setReport(array $report): void
    {
        $this->assign(
            [
                'report' => json_encode($report)
            ]
        );
    }

    public function setIssuedAt(\DateTime $date): void
    {
        $this->assign(
            [
                'issued_at' => $date->format('Y-m-d H:i:s')
            ]
        );
    }
}
