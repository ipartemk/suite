<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\SizeHarmonization\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AttributeGridGroupTransfer;
use Generated\Shared\Transfer\AttributeGridValueTransfer;
use Generated\Shared\Transfer\AttributeMotherGridColTransfer;
use Generated\Shared\Transfer\AttributeMotherGridKeyTransfer;
use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Generated\Shared\Transfer\AttributeMotherGridValueTransfer;

/**
 * @group PyzTest
 * @group Zed
 * @group SizeHarmonization
 * @group Business
 * @group Facade
 * @group ProductAbstractManagerTest
 * Add your own group annotations below this line
 */
class SizeHarmonizationFacadeTest extends Unit
{
    /**
     * @var \PyzTest\Zed\SizeHarmonization\SizeHarmonizationBusinessTester
     */
    protected $tester;

    /**
     * @var \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacade
     */
    protected $sizeHarmonizationFacade;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->sizeHarmonizationFacade = $this->tester->createSizeHarmonizationFacade();
    }

    /**
     * @return void
     */
    public function testAttributeMotherGrid(): void
    {
        $amgId = $this->addAttributeMotherGrid();
        $amgEntity = $this->findAttributeMotherGridEntityById($amgId);

        $this->assertEquals($amgEntity->getIdAttributeMotherGrid(), $amgId);

        $amgKey = "test_AMG_name2";
        $amgName = "test_AMG_name2";
        $attributeMotherGridTransfer = new AttributeMotherGridTransfer();
        $attributeMotherGridTransfer->setIdAttributeMotherGrid($amgId);
        $attributeMotherGridTransfer->setName($amgName);
        $attributeMotherGridTransfer->setAmgKey($amgKey);

        $updated = $this->sizeHarmonizationFacade->updateAttributeMotherGrid($attributeMotherGridTransfer);
        $this->assertTrue($updated);

        $amgEntity = $this->findAttributeMotherGridEntityById($amgId);
        $this->assertEquals($amgEntity->getAmgKey(), $amgKey);
        $this->assertEquals($amgEntity->getName(), $amgName);

        $this->sizeHarmonizationFacade->deleteAttributeMotherGrid($amgId);
        $amgEntity = $this->findAttributeMotherGridEntityById($amgId);
        $this->assertNull($amgEntity);
    }

    /**
     * @return void
     */
    public function testAttributeMotherGridKey(): void
    {
        $amgId = $this->addAttributeMotherGrid();
        $amgKeyId = $this->addAttributeMotherGridKey($amgId);
        $amgKeyEntity = $this->findAttributeMotherGridKeyEntityById($amgKeyId);

        $this->assertEquals($amgKeyEntity->getIdAttributeMotherGridKey(), $amgKeyId);

        $key = "test_AMG_key2";
        $attributeMotherGridKeyTransfer = new AttributeMotherGridKeyTransfer();
        $attributeMotherGridKeyTransfer->setIdAttributeMotherGridKey($amgKeyId);
        $attributeMotherGridKeyTransfer->setFkAttributeMotherGrid($amgId);
        $attributeMotherGridKeyTransfer->setKey($key);

        $updated = $this->sizeHarmonizationFacade->updateAttributeMotherGridKey($attributeMotherGridKeyTransfer);
        $this->assertTrue($updated);

        $amgKeyEntity = $this->findAttributeMotherGridKeyEntityById($amgKeyId);
        $this->assertEquals($amgKeyEntity->getKey(), $key);

        $this->sizeHarmonizationFacade->deleteAttributeMotherGridKey($amgKeyId);
        $amgKeyEntity = $this->findAttributeMotherGridKeyEntityById($amgKeyId);
        $this->assertNull($amgKeyEntity);
    }

    /**
     * @return void
     */
    public function testAttributeMotherGridCol(): void
    {
        $amgId = $this->addAttributeMotherGrid();
        $amgColId = $this->addAttributeMotherGridCol($amgId);
        $amgColEntity = $this->findAttributeMotherGridColEntityById($amgColId);

        $this->assertEquals($amgColEntity->getIdAttributeMotherGridCol(), $amgColId);

        $col = "test_AMG_col2";
        $attributeMotherGridColTransfer = new AttributeMotherGridColTransfer();
        $attributeMotherGridColTransfer->setIdAttributeMotherGridCol($amgColId);
        $attributeMotherGridColTransfer->setFkAttributeMotherGrid($amgId);
        $attributeMotherGridColTransfer->setCol($col);

        $updated = $this->sizeHarmonizationFacade->updateAttributeMotherGridCol($attributeMotherGridColTransfer);
        $this->assertTrue($updated);

        $amgColEntity = $this->findAttributeMotherGridColEntityById($amgColId);
        $this->assertEquals($amgColEntity->getCol(), $col);

        $this->sizeHarmonizationFacade->deleteAttributeMotherGridCol($amgColId);
        $amgColEntity = $this->findAttributeMotherGridColEntityById($amgColId);
        $this->assertNull($amgColEntity);
    }

    /**
     * @return void
     */
    public function testAttributeMotherGridValue(): void
    {
        $amgId = $this->addAttributeMotherGrid();
        $amgKeyId = $this->addAttributeMotherGridKey($amgId);
        $amgColId = $this->addAttributeMotherGridCol($amgId);
        $amgValueId = $this->addAttributeMotherGridValue($amgKeyId, $amgColId);
        $amgValueEntity = $this->findAttributeMotherGridValueEntityById($amgValueId);

        $this->assertEquals($amgValueEntity->getIdAttributeMotherGridValue(), $amgValueId);

        $value = "test_AMG_value2";
        $attributeMotherGridValueTransfer = new AttributeMotherGridValueTransfer();
        $attributeMotherGridValueTransfer->setIdAttributeMotherGridValue($amgValueId);
        $attributeMotherGridValueTransfer->setFkAttributeMotherGridKey($amgKeyId);
        $attributeMotherGridValueTransfer->setFkAttributeMotherGridCol($amgColId);
        $attributeMotherGridValueTransfer->setValue($value);

        $updated = $this->sizeHarmonizationFacade->updateAttributeMotherGridValue($attributeMotherGridValueTransfer);
        $this->assertTrue($updated);

        $amgValueEntity = $this->findAttributeMotherGridValueEntityById($amgValueId);
        $this->assertEquals($amgValueEntity->getValue(), $value);

        $this->sizeHarmonizationFacade->deleteAttributeMotherGridValue($amgValueId);
        $amgValueEntity = $this->findAttributeMotherGridvalueEntityById($amgValueId);
        $this->assertNull($amgValueEntity);
    }

    /**
     * @return void
     */
    public function testAttributeGridGroup(): void
    {
        $agGroupId = $this->addAttributeGridGroup();
        $agGroupEntity = $this->findAttributeGridGroupEntityById($agGroupId);

        $this->assertEquals($agGroupEntity->getIdAttributeGridGroup(), $agGroupId);

        $group = "test_AG_group2";
        $attributeGridGroupTransfer = new AttributeGridGroupTransfer();
        $attributeGridGroupTransfer->setIdAttributeGridGroup($agGroupId);
        $attributeGridGroupTransfer->setGroup($group);

        $updated = $this->sizeHarmonizationFacade->updateAttributeGridGroup($attributeGridGroupTransfer);
        $this->assertTrue($updated);

        $agGroupEntity = $this->findAttributeGridGroupEntityById($agGroupId);
        $this->assertEquals($agGroupEntity->getGroup(), $group);

        $this->sizeHarmonizationFacade->deleteAttributeGridGroup($agGroupId);
        $agGroupEntity = $this->findAttributeGridGroupEntityById($agGroupId);
        $this->assertNull($agGroupEntity);
    }

    /**
     * @return void
     */
    public function testAttributeGridValue(): void
    {
        $amgId = $this->addAttributeMotherGrid();
        $amgKeyId = $this->addAttributeMotherGridKey($amgId);
        $amgColId = $this->addAttributeMotherGridCol($amgId);
        $agGroupId = $this->addAttributeGridGroup();
        $agValueId = $this->addAttributeGridValue($amgKeyId, $amgColId, $agGroupId);
        $agValueEntity = $this->findAttributeGridValueEntityById($agValueId);

        $this->assertEquals($agValueEntity->getIdAttributeGridValue(), $agValueId);

        $value = "test_AG_value2";
        $attributeGridValueTransfer = new AttributeGridValueTransfer();
        $attributeGridValueTransfer->setIdAttributeGridValue($agValueId);
        $attributeGridValueTransfer->setFkAttributeMotherGridKey($amgKeyId);
        $attributeGridValueTransfer->setFkAttributeMotherGridCol($amgColId);
        $attributeGridValueTransfer->setFkAttributeGridGroup($agGroupId);
        $attributeGridValueTransfer->setValue($value);

        $updated = $this->sizeHarmonizationFacade->updateAttributeGridValue($attributeGridValueTransfer);
        $this->assertTrue($updated);

        $agValueEntity = $this->findAttributeGridValueEntityById($agValueId);
        $this->assertEquals($agValueEntity->getValue(), $value);

        $this->sizeHarmonizationFacade->deleteAttributeGridValue($agValueId);
        $agValueEntity = $this->findAttributeGridValueEntityById($agValueId);
        $this->assertNull($agValueEntity);
    }

    /**
     * @param int $amgId
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid|null
     */
    protected function findAttributeMotherGridEntityById($amgId)
    {
        $sizeHarmonizationQueryContainer = $this->tester->createSizeHarmonizationQueryContainer();

        return $sizeHarmonizationQueryContainer->queryAttributeMotherGridById($amgId)
            ->findOne();
    }

    /**
     * @param int $amgKeyId
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKey|null
     */
    protected function findAttributeMotherGridKeyEntityById($amgKeyId)
    {
        $sizeHarmonizationQueryContainer = $this->tester->createSizeHarmonizationQueryContainer();

        return $sizeHarmonizationQueryContainer->queryAttributeMotherGridKeyById($amgKeyId)
            ->findOne();
    }

    /**
     * @param int $amgColId
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol|null
     */
    protected function findAttributeMotherGridColEntityById($amgColId)
    {
        $sizeHarmonizationQueryContainer = $this->tester->createSizeHarmonizationQueryContainer();

        return $sizeHarmonizationQueryContainer->queryAttributeMotherGridColById($amgColId)
            ->findOne();
    }

    /**
     * @param int $amgValueId
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue|null
     */
    protected function findAttributeMotherGridValueEntityById($amgValueId)
    {
        $sizeHarmonizationQueryContainer = $this->tester->createSizeHarmonizationQueryContainer();

        return $sizeHarmonizationQueryContainer->queryAttributeMotherGridValueById($amgValueId)
            ->findOne();
    }

    /**
     * @param int $agGroupId
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroup|null
     */
    protected function findAttributeGridGroupEntityById($agGroupId)
    {
        $sizeHarmonizationQueryContainer = $this->tester->createSizeHarmonizationQueryContainer();

        return $sizeHarmonizationQueryContainer->queryAttributeGridGroupById($agGroupId)
            ->findOne();
    }

    /**
     * @param int $agValueId
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue|null
     */
    protected function findAttributeGridValueEntityById($agValueId)
    {
        $sizeHarmonizationQueryContainer = $this->tester->createSizeHarmonizationQueryContainer();

        return $sizeHarmonizationQueryContainer->queryAttributeGridValueById($agValueId)
            ->findOne();
    }

    /**
     * @return int
     */
    protected function addAttributeMotherGrid()
    {
        $amgKey = "test_AMG_name";
        $attributeMotherGridTransfer = new AttributeMotherGridTransfer();
        $attributeMotherGridTransfer->setName("test AMG name");
        $attributeMotherGridTransfer->setAmgKey($amgKey);

        return $this->sizeHarmonizationFacade->addAttributeMotherGrid($attributeMotherGridTransfer);
    }

    /**
     * @param int $attributeMotherGridId
     *
     * @return int
     */
    protected function addAttributeMotherGridKey($attributeMotherGridId)
    {
        $key = "test_AMG_key";
        $attributeMotherGridKeyTransfer = new AttributeMotherGridKeyTransfer();
        $attributeMotherGridKeyTransfer->setFkAttributeMotherGrid($attributeMotherGridId);
        $attributeMotherGridKeyTransfer->setKey($key);

        return $this->sizeHarmonizationFacade->addAttributeMotherGridKey($attributeMotherGridKeyTransfer);
    }

    /**
     * @param int $attributeMotherGridId
     *
     * @return int
     */
    protected function addAttributeMotherGridCol($attributeMotherGridId)
    {
        $col = "test_AMG_col";
        $attributeMotherGridColTransfer = new AttributeMotherGridColTransfer();
        $attributeMotherGridColTransfer->setFkAttributeMotherGrid($attributeMotherGridId);
        $attributeMotherGridColTransfer->setCol($col);

        return $this->sizeHarmonizationFacade->addAttributeMotherGridCol($attributeMotherGridColTransfer);
    }

    /**
     * @param int $amgKeyId
     * @param int $amgColId
     *
     * @return int
     */
    protected function addAttributeMotherGridValue($amgKeyId, $amgColId)
    {
        $value = "test_AMG_value";
        $attributeMotherGridValueTransfer = new AttributeMotherGridValueTransfer();
        $attributeMotherGridValueTransfer->setFkAttributeMotherGridKey($amgKeyId);
        $attributeMotherGridValueTransfer->setFkAttributeMotherGridCol($amgColId);
        $attributeMotherGridValueTransfer->setValue($value);

        return $this->sizeHarmonizationFacade->addAttributeMotherGridValue($attributeMotherGridValueTransfer);
    }

    /**
     * @return int
     */
    protected function addAttributeGridGroup()
    {
        $group = "test_AG_group";
        $attributeGridGroupTransfer = new AttributeGridGroupTransfer();
        $attributeGridGroupTransfer->setGroup($group);

        return $this->sizeHarmonizationFacade->addAttributeGridGroup($attributeGridGroupTransfer);
    }

    /**
     * @param int $amgKeyId
     * @param int $amgColId
     * @param int $agGroupId
     *
     * @return int
     */
    protected function addAttributeGridValue($amgKeyId, $amgColId, $agGroupId)
    {
        $value = "test_AG_value";
        $attributeGridValueTransfer = new AttributeGridValueTransfer();
        $attributeGridValueTransfer->setFkAttributeMotherGridKey($amgKeyId);
        $attributeGridValueTransfer->setFkAttributeMotherGridCol($amgColId);
        $attributeGridValueTransfer->setFkAttributeGridGroup($agGroupId);
        $attributeGridValueTransfer->setValue($value);

        return $this->sizeHarmonizationFacade->addAttributeGridValue($attributeGridValueTransfer);
    }
}
