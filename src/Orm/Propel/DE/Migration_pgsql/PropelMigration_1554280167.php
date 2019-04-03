<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1554280167.
 * Generated on 2019-04-03 08:29:27 by vagrant
 */
class PropelMigration_1554280167
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

ALTER TABLE "spy_product" DROP CONSTRAINT "spy_product-myt_attribute_grid_group";

ALTER TABLE "spy_product" DROP CONSTRAINT "spy_product-myt_attribute_mother_grid_key";

ALTER TABLE "spy_product"

  DROP COLUMN "fk_attribute_grid_group",

  DROP COLUMN "fk_attribute_mother_grid_key";

ALTER TABLE "spy_product_abstract"

  ADD "fk_attribute_grid_group" INTEGER,

  ADD "fk_attribute_mother_grid_key" INTEGER;

ALTER TABLE "spy_product_abstract" ADD CONSTRAINT "spy_product-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "spy_product_abstract" ADD CONSTRAINT "spy_product-myt_attribute_grid_group"
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

ALTER TABLE "spy_product"

  ADD "fk_attribute_grid_group" INTEGER,

  ADD "fk_attribute_mother_grid_key" INTEGER;

ALTER TABLE "spy_product" ADD CONSTRAINT "spy_product-myt_attribute_grid_group"
    FOREIGN KEY ("fk_attribute_grid_group")
    REFERENCES "myt_attribute_grid_group" ("id_attribute_grid_group")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "spy_product" ADD CONSTRAINT "spy_product-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "spy_product_abstract" DROP CONSTRAINT "spy_product-myt_attribute_mother_grid_key";

ALTER TABLE "spy_product_abstract" DROP CONSTRAINT "spy_product-myt_attribute_grid_group";

ALTER TABLE "spy_product_abstract"

  DROP COLUMN "fk_attribute_grid_group",

  DROP COLUMN "fk_attribute_mother_grid_key";

COMMIT;
',
);
    }

}