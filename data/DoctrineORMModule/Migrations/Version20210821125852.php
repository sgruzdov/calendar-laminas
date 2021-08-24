<?php

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210821125852
 * @package Migrations
 */
class Version20210821125852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('event')) {
            $table = $schema->createTable('event');

            $table->addColumn('event_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('name', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('description', 'text', ['notnull' => true]);
            $table->addColumn('date', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['event_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения событий');
        }

        if (!$schema->hasTable('client')) {
            $table = $schema->createTable('client');

            $table->addColumn('client_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('event_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('initials', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('email', 'string', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['client_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для клиентов');

            $table->addIndex(['event_id'], 'event_id');
            $table->addForeignKeyConstraint('event', ['event_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CLIENT_EVENT');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');
            if ($table->hasForeignKey('FK_CLIENT_EVENT')) {
                $table->removeForeignKey('FK_CLIENT_EVENT');
            }

            $schema->dropTable('client');
        }

        if ($schema->hasTable('event')) {
            $schema->dropTable('event');
        }
    }
}
