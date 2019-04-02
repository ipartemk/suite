<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1554133825.
 * Generated on 2019-04-01 15:50:25 by vagrant
 */
class PropelMigration_1554133825
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

CREATE SEQUENCE "myt_attribute_mother_grid_col_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_col"
(
    "id_attribute_mother_grid_col" INTEGER NOT NULL,
    "fk_attribute_mother_grid" INTEGER NOT NULL,
    "col" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_col"),
    CONSTRAINT "myt_fk_attribute_mother_grid-unique-col" UNIQUE ("fk_attribute_mother_grid","col")
);

ALTER TABLE "myt_attribute_grid_value"

  ADD "fk_attribute_mother_grid_col" INTEGER NOT NULL;

ALTER TABLE "myt_attribute_grid_value" ADD CONSTRAINT "myt_attribute_grid_value-myt_attribute_mother_grid_col"
    FOREIGN KEY ("fk_attribute_mother_grid_col")
    REFERENCES "myt_attribute_mother_grid_col" ("id_attribute_mother_grid_col")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

CREATE UNIQUE INDEX "myt_fk_attribute_mother_grid-unique-key" ON "myt_attribute_mother_grid_key" ("fk_attribute_mother_grid","key");

ALTER TABLE "myt_attribute_mother_grid_value"

  ADD "fk_attribute_mother_grid_col" INTEGER NOT NULL;

ALTER TABLE "myt_attribute_mother_grid_value" ADD CONSTRAINT "myt_attribute_mother_grid_value-myt_attribute_mother_grid_col"
    FOREIGN KEY ("fk_attribute_mother_grid_col")
    REFERENCES "myt_attribute_mother_grid_col" ("id_attribute_mother_grid_col")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_mother_grid_col" ADD CONSTRAINT "myt_attribute_mother_grid_col-myt_attribute_mother_grid"
    FOREIGN KEY ("fk_attribute_mother_grid")
    REFERENCES "myt_attribute_mother_grid" ("id_attribute_mother_grid")
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

DROP TABLE IF EXISTS "myt_attribute_mother_grid_col" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_col_pk_seq";

ALTER TABLE "myt_attribute_grid_value" DROP CONSTRAINT "myt_attribute_grid_value-myt_attribute_mother_grid_col";

ALTER TABLE "myt_attribute_grid_value"

  DROP COLUMN "fk_attribute_mother_grid_col";

    ALTER TABLE "myt_attribute_mother_grid_key" DROP CONSTRAINT "myt_fk_attribute_mother_grid-unique-key";
    
ALTER TABLE "myt_attribute_mother_grid_value" DROP CONSTRAINT "myt_attribute_mother_grid_value-myt_attribute_mother_grid_col";

ALTER TABLE "myt_attribute_mother_grid_value"

  DROP COLUMN "fk_attribute_mother_grid_col";

COMMIT;
',
);
    }

}