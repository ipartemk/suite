<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1556100789.
 * Generated on 2019-04-24 10:13:09 by vagrant
 */
class PropelMigration_1556100789
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'zed' => '
BEGIN;

CREATE SEQUENCE "myt_attribute_grid_storage_pk_seq";

CREATE TABLE "myt_attribute_grid_storage"
(
    "id_attribute_grid_storage" INT8 NOT NULL,
    "fk_product_abstract" INTEGER NOT NULL,
    "fk_attribute_grid_group" INTEGER,
    "attribute_grid_group" VARCHAR(255),
    "data" TEXT,
    "store" VARCHAR(128),
    "locale" VARCHAR(16),
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_grid_storage"),
    CONSTRAINT "myt_attribute_grid_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "myt_attribute_grid_storage-spy_product_abstract" ON "myt_attribute_grid_storage" ("fk_product_abstract");

COMMIT;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'zed' => '
BEGIN;

DROP TABLE IF EXISTS "myt_attribute_grid_storage" CASCADE;

DROP SEQUENCE "myt_attribute_grid_storage_pk_seq";

COMMIT;
',
);
    }

}