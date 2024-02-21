<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace EyeAble\EyeAbleAssist\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202171900 extends AbstractMigration
{
    //NOTE: write migrations so that they can be run multiple times without breaking anything.
    //      Means: check if changes are already present before actually modifying a table
    public function up(Schema $schema): void
    {
        $this->connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        if (!$schema->hasTable('eyeable_reports')) {
            $this->addSql(
                "CREATE TABLE `eyeablereports` (
                `OXID` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci  NOT NULL COMMENT 'Primary oxid',
                `OXSHOPID` int(11) NOT NULL DEFAULT '0' COMMENT 
                    'Shop id (oxshops), value 0 in case no shop was specified',
                `REPORT` JSON NOT NULL COMMENT 'json report',
                `ISSUED_AT` datetime NOT NULL COMMENT 'creation date',
                `OXTIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                    COMMENT 'Timestamp',
                PRIMARY KEY (`OXID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
            );
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
