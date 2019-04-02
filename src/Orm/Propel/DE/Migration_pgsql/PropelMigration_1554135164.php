<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1554135164.
 * Generated on 2019-04-01 16:12:44 by vagrant
 */
class PropelMigration_1554135164
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
    
CREATE UNIQUE INDEX "myt_attribute_grid_value_unique-key-col" ON "myt_attribute_grid_value" ("fk_attribute_mother_grid_key","fk_attribute_mother_grid_col");

CREATE UNIQUE INDEX "myt_attribute_mother_grid_value_unique-key-col" ON "myt_attribute_mother_grid_value" ("fk_attribute_mother_grid_key","fk_attribute_mother_grid_col");

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

    ALTER TABLE "myt_attribute_grid_value" DROP CONSTRAINT "myt_attribute_grid_value_unique-key-col";
    
    ALTER TABLE "myt_attribute_mother_grid_value" DROP CONSTRAINT "myt_attribute_mother_grid_value_unique-key-col";
    
COMMIT;
',
);
    }

}
