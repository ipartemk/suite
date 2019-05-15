<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1557907361.
 * Generated on 2019-05-15 08:02:41 by vagrant
 */
class PropelMigration_1557907361
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

CREATE INDEX "index-myt_attribute_mother_grid_product_abstract-f-40ed1a13646e" ON "myt_attribute_mother_grid_product_abstract" ("fk_attribute_mother_grid");

CREATE INDEX "index-myt_attribute_mother_grid_product_abstract-f-3c06f8d240c6" ON "myt_attribute_mother_grid_product_abstract" ("fk_product_abstract");

CREATE SEQUENCE "myt_attribute_mother_grid_key_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_key"
(
    "id_attribute_mother_grid_key" INTEGER NOT NULL,
    "fk_attribute_mother_grid" INTEGER NOT NULL,
    "key" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_key"),
    CONSTRAINT "myt_fk_attribute_mother_grid-unique-key" UNIQUE ("fk_attribute_mother_grid","key")
);

CREATE INDEX "index-myt_attribute_mother_grid_key-fk_attribute_mother_grid" ON "myt_attribute_mother_grid_key" ("fk_attribute_mother_grid");

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

CREATE INDEX "index-myt_attribute_mother_grid_col-fk_attribute_mother_grid" ON "myt_attribute_mother_grid_col" ("fk_attribute_mother_grid");

CREATE SEQUENCE "myt_attribute_mother_grid_value_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_value"
(
    "id_attribute_mother_grid_value" INTEGER NOT NULL,
    "fk_attribute_mother_grid_col" INTEGER NOT NULL,
    "fk_attribute_mother_grid_key" INTEGER NOT NULL,
    "value" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_value"),
    CONSTRAINT "myt_attribute_mother_grid_value_unique-key-col" UNIQUE ("fk_attribute_mother_grid_key","fk_attribute_mother_grid_col")
);

CREATE INDEX "index-myt_attribute_mother_grid_value-fk_attribute-adce30bd6c4b" ON "myt_attribute_mother_grid_value" ("fk_attribute_mother_grid_key");

CREATE INDEX "index-myt_attribute_mother_grid_value-fk_attribute-d261ddc67f69" ON "myt_attribute_mother_grid_value" ("fk_attribute_mother_grid_col");

CREATE SEQUENCE "myt_attribute_grid_value_pk_seq";

CREATE TABLE "myt_attribute_grid_value"
(
    "id_attribute_grid_value" INTEGER NOT NULL,
    "fk_attribute_grid_group" INTEGER NOT NULL,
    "fk_attribute_mother_grid_col" INTEGER NOT NULL,
    "fk_attribute_mother_grid_key" INTEGER NOT NULL,
    "value" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_grid_value"),
    CONSTRAINT "myt_attribute_grid_value_unique-key-col" UNIQUE ("fk_attribute_mother_grid_key","fk_attribute_mother_grid_col","fk_attribute_grid_group")
);

CREATE INDEX "index-myt_attribute_grid_value-fk_attribute_mother_grid_key" ON "myt_attribute_grid_value" ("fk_attribute_mother_grid_key");

CREATE INDEX "index-myt_attribute_grid_value-fk_attribute_mother_grid_col" ON "myt_attribute_grid_value" ("fk_attribute_mother_grid_col");

CREATE INDEX "index-myt_attribute_grid_value-fk_attribute_grid_group" ON "myt_attribute_grid_value" ("fk_attribute_grid_group");

CREATE SEQUENCE "myt_attribute_mother_grid_pk_seq";

CREATE TABLE "myt_attribute_mother_grid"
(
    "id_attribute_mother_grid" INTEGER NOT NULL,
    "amg_key" VARCHAR(255) NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid"),
    CONSTRAINT "myt_attribute_mother_grid-unique-amg_key" UNIQUE ("amg_key")
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

CREATE SEQUENCE "myt_attribute_mother_grid_storage_pk_seq";

CREATE TABLE "myt_attribute_mother_grid_storage"
(
    "id_attribute_mother_grid_storage" INT8 NOT NULL,
    "fk_attribute_mother_grid" INTEGER NOT NULL,
    "data" TEXT,
    "store" VARCHAR(128),
    "locale" VARCHAR(16),
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_attribute_mother_grid_storage"),
    CONSTRAINT "myt_attribute_mother_grid_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "myt_attribute_mother_grid_storage-myt_attribute_mother_grid" ON "myt_attribute_mother_grid_storage" ("fk_attribute_mother_grid");

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

CREATE INDEX "index-spy_availability_notification_subscription-fk_locale" ON "spy_availability_notification_subscription" ("fk_locale");

CREATE INDEX "index-spy_category_image_set-fk_locale" ON "spy_category_image_set" ("fk_locale");

CREATE INDEX "index-spy_category_image_set_to_category_image-fk_-85872f21dafe" ON "spy_category_image_set_to_category_image" ("fk_category_image_set");

CREATE INDEX "index-spy_category_image_set_to_category_image-fk_-7c0ba662126c" ON "spy_category_image_set_to_category_image" ("fk_category_image");

CREATE INDEX "index-spy_cms_page_store-fk_cms_page" ON "spy_cms_page_store" ("fk_cms_page");

CREATE INDEX "index-spy_cms_page_store-fk_store" ON "spy_cms_page_store" ("fk_store");

ALTER TABLE "spy_product_abstract"

  ADD "fk_attribute_grid_group" INTEGER;

CREATE INDEX "index-spy_product_abstract-fk_attribute_grid_group" ON "spy_product_abstract" ("fk_attribute_grid_group");

ALTER TABLE "spy_product_abstract" ADD CONSTRAINT "spy_product-myt_attribute_grid_group"
    FOREIGN KEY ("fk_attribute_grid_group")
    REFERENCES "myt_attribute_grid_group" ("id_attribute_grid_group")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

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

ALTER TABLE "myt_attribute_mother_grid_key" ADD CONSTRAINT "myt_attribute_mother_grid_key-myt_attribute_mother_grid"
    FOREIGN KEY ("fk_attribute_mother_grid")
    REFERENCES "myt_attribute_mother_grid" ("id_attribute_mother_grid")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_mother_grid_col" ADD CONSTRAINT "myt_attribute_mother_grid_col-myt_attribute_mother_grid"
    FOREIGN KEY ("fk_attribute_mother_grid")
    REFERENCES "myt_attribute_mother_grid" ("id_attribute_mother_grid")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_mother_grid_value" ADD CONSTRAINT "myt_attribute_mother_grid_value-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_mother_grid_value" ADD CONSTRAINT "myt_attribute_mother_grid_value-myt_attribute_mother_grid_col"
    FOREIGN KEY ("fk_attribute_mother_grid_col")
    REFERENCES "myt_attribute_mother_grid_col" ("id_attribute_mother_grid_col")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_grid_value" ADD CONSTRAINT "myt_attribute_grid_value-myt_attribute_mother_grid_key"
    FOREIGN KEY ("fk_attribute_mother_grid_key")
    REFERENCES "myt_attribute_mother_grid_key" ("id_attribute_mother_grid_key")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "myt_attribute_grid_value" ADD CONSTRAINT "myt_attribute_grid_value-myt_attribute_mother_grid_col"
    FOREIGN KEY ("fk_attribute_mother_grid_col")
    REFERENCES "myt_attribute_mother_grid_col" ("id_attribute_mother_grid_col")
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

DROP TABLE IF EXISTS "myt_attribute_mother_grid_product_abstract" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_product_abstract_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid_key" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_key_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid_col" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_col_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid_value" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_value_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_grid_value" CASCADE;

DROP SEQUENCE "myt_attribute_grid_value_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_grid_group" CASCADE;

DROP SEQUENCE "myt_attribute_grid_group_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_mother_grid_storage" CASCADE;

DROP SEQUENCE "myt_attribute_mother_grid_storage_pk_seq";

DROP TABLE IF EXISTS "myt_attribute_grid_storage" CASCADE;

DROP SEQUENCE "myt_attribute_grid_storage_pk_seq";

DROP INDEX "index-spy_availability_notification_subscription-fk_locale";

DROP INDEX "index-spy_category_image_set-fk_locale";

DROP INDEX "index-spy_category_image_set_to_category_image-fk_-85872f21dafe";

DROP INDEX "index-spy_category_image_set_to_category_image-fk_-7c0ba662126c";

DROP INDEX "index-spy_cms_page_store-fk_cms_page";

DROP INDEX "index-spy_cms_page_store-fk_store";

ALTER TABLE "spy_product_abstract" DROP CONSTRAINT "spy_product-myt_attribute_grid_group";

DROP INDEX "index-spy_product_abstract-fk_attribute_grid_group";

ALTER TABLE "spy_product_abstract"

  DROP COLUMN "fk_attribute_grid_group";

COMMIT;
',
);
    }

}