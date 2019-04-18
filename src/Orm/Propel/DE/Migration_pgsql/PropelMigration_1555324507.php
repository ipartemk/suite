<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1555324507.
 * Generated on 2019-04-15 10:35:07 by vagrant
 */
class PropelMigration_1555324507
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

CREATE SEQUENCE "myt_attribute_mother_grid_product_abstract_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_product_abstract"
(
    "id_attribute_mother_grid_product_abstract" INTEGER NOT NULL,
    "fk_attribute_mother_grid" INTEGER NOT NULL,
    "fk_product_abstract" INTEGER NOT NULL,
    "country" VARCHAR(2) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_product_abstract"),
    CONSTRAINT "myt_fk_product_abstract-unique-country" UNIQUE ("fk_product_abstract","country")
);

ALTER TABLE "myt_attribute_mother_grid"

  ADD "sku" VARCHAR(255);

ALTER TABLE "spy_product_abstract" DROP CONSTRAINT "spy_product-myt_attribute_mother_grid_key";

ALTER TABLE "spy_product_abstract"

  DROP COLUMN "fk_attribute_mother_grid_key";

ALTER TABLE "myt_attribute_mother_grid_product_abstract" ADD CONSTRAINT "myt_amg_product_abstract-myt_amg"
    FOREIGN KEY ("fk_attribute_mother_grid")
    REFERENCES "myt_attribute_mother_grid" ("id_attribute_mother_grid")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_mother_grid_product_abstract" ADD CONSTRAINT "myt_amg_product_abstract-fk_product_abstract"
    FOREIGN KEY ("fk_product_abstract")
    REFERENCES "spy_product_abstract" ("id_product_abstract")
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

DROP TABLE IF EXISTS "myt_attribute_mother_grid_product_abstract" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_product_abstract_pk_seq";

ALTER TABLE "myt_attribute_mother_grid"

  DROP COLUMN "sku";

ALTER TABLE "spy_product_abstract"

  ADD "fk_attribute_mother_grid_key" INTEGER;

ALTER TABLE "spy_product_abstract" ADD CONSTRAINT "spy_product-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

COMMIT;
',
);
    }

}