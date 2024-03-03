<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Report\Infrastructure;

use EyeAble\EyeAbleAssist\Report\Model\Report;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;

class ReportProvider implements ReportProviderInterface
{
    public function __construct(private QueryBuilderFactoryInterface $queryBuilderFactory)
    {
    }

    public function getLatestReport(bool $includeEmpty = false): Report
    {
        $report = oxNew(Report::class);

        $queryBuilder = $this->queryBuilderFactory->create();
        $queryBuilder->select($report->getViewName() . '.oxid')
            ->from($report->getViewName());

        if (!$includeEmpty) {
            $queryBuilder->where('json_length(report) > 0');
        }

        $queryBuilder
            ->orderBy($report->getViewName() . '.issued_at', 'DESC')
            ->setMaxResults(1);

        /** @var \Doctrine\DBAL\Statement $result */
        $result = $queryBuilder->execute();
        $resultId = (string) $result->fetchOne();

        if ($resultId) {
            $report->load($resultId);
        }

        return $report;
    }
}
