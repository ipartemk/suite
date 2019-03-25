<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1553163090.
 * Generated on 2019-03-21 10:11:30 by vagrant
 */
class PropelMigration_1553163090
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

CREATE SEQUENCE "myt_attribute_mother_grid_pk_seq";

CREATE TABLE "myt_attribute_mother_grid"
(
    "id_attribute_mother_grid" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid")
);

CREATE SEQUENCE "myt_attribute_mother_grid_key_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_key"
(
    "id_attribute_mother_grid_key" INTEGER NOT NULL,
    "fk_attribute_mother_grid" INTEGER NOT NULL,
    "key" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_key")
);

CREATE SEQUENCE "myt_attribute_mother_grid_value_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_value"
(
    "id_attribute_mother_grid_value" INTEGER NOT NULL,
    "fk_attribute_mother_grid_key" INTEGER NOT NULL,
    "value" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_value")
);

CREATE SEQUENCE "myt_attribute_grid_group_pk_seq";

CREATE TABLE "myt_attribute_grid_group"
(
    "id_attribute_grid_group" INTEGER NOT NULL,
    "group" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_grid_group")
);

CREATE SEQUENCE "myt_attribute_grid_value_pk_seq";

CREATE TABLE "myt_attribute_grid_value"
(
    "id_attribute_grid_value" INTEGER NOT NULL,
    "fk_attribute_mother_grid_key" INTEGER NOT NULL,
    "fk_attribute_grid_group" INTEGER NOT NULL,
    "value" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_grid_value")
);

ALTER TABLE "myt_attribute_mother_grid_key" ADD CONSTRAINT "myt_attribute_mother_grid_key-myt_attribute_mother_grid"
    FOREIGN KEY ("fk_attribute_mother_grid")
    REFERENCES "myt_attribute_mother_grid" ("id_attribute_mother_grid")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_mother_grid_value" ADD CONSTRAINT "myt_attribute_mother_grid_value-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_grid_value" ADD CONSTRAINT "myt_attribute_grid_value-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_grid_value" ADD CONSTRAINT "myt_attribute_grid_value-myt_attribute_grid_group"
    FOREIGN KEY ("fk_attribute_grid_group")
    REFERENCES "myt_attribute_grid_group" ("id_attribute_grid_group")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

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

DROP TABLE IF EXISTS "myt_attribute_mother_grid" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid_key" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_key_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid_value" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_value_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_grid_group" CASCADE;

DROP SEQUENCE "myt_attribute_grid_group_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_grid_value" CASCADE;

DROP SEQUENCE "myt_attribute_grid_value_pk_seq";

COMMIT;
',
);
    }

}