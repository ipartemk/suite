<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1555327698.
 * Generated on 2019-04-15 11:28:18 by vagrant
 */
class PropelMigration_1555327698
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

ALTER TABLE "myt_attribute_mother_grid"

  ALTER COLUMN "amg_key" SET NOT NULL;

CREATE UNIQUE INDEX "myt_attribute_mother_grid-unique-amg_key" ON "myt_attribute_mother_grid" ("amg_key");

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

    ALTER TABLE "myt_attribute_mother_grid" DROP CONSTRAINT "myt_attribute_mother_grid-unique-amg_key";
    
ALTER TABLE "myt_attribute_mother_grid"

  ALTER COLUMN "amg_key" DROP NOT NULL;

COMMIT;
',
);
    }

}