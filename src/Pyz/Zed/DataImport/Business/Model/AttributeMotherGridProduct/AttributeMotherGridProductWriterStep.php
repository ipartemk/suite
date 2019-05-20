<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\AttributeMotherGridProduct;

use Generated\Shared\Transfer\EventEntityTransfer;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstractQuery;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery;
use Pyz\Zed\DataImport\Business\Exception\InvalidDataException;
use Pyz\Zed\SizeHarmonization\Dependency\SizeHarmonizationEvents;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AttributeMotherGridProductWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public const BULK_SIZE = 100;

    public const KEY_PRODUCT_ABSTRACT_SKU = 'product_abstract_sku';
    public const KEY_COUNTRY = 'country';
    public const KEY_AMG_KEY = 'attribute_mother_grid_key';

    /**
     * @var \Spryker\Zed\DataImport\Dependency\Facade\DataImportToEventFacadeInterface
     */
    protected $eventFacade;

    /**
     * @param \Spryker\Zed\DataImport\Dependency\Facade\DataImportToEventFacadeInterface $eventFacade
     */
    public function __construct($eventFacade)
    {
        $this->eventFacade = $eventFacade;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\InvalidDataException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $productAbstractEntity = SpyProductAbstractQuery::create()
            ->findOneBySku($dataSet[static::KEY_PRODUCT_ABSTRACT_SKU]);
        if ($productAbstractEntity === null) {
            throw new InvalidDataException(
                sprintf('Product abstract SKU is (%s) not found in permanent storage.', $dataSet[static::KEY_PRODUCT_ABSTRACT_SKU])
            );
        }

        $attributeMotherGridEntity = MytAttributeMotherGridQuery::create()
            ->findOneByAmgKey($dataSet[static::KEY_AMG_KEY]);
        if ($attributeMotherGridEntity === null) {
            throw new InvalidDataException(
                sprintf('Attribute mother grid Key is (%s) not found in permanent storage.', $dataSet[static::KEY_AMG_KEY])
            );
        }

        $entity = MytAttributeMotherGridProductAbstractQuery::create()
            ->filterByFkProductAbstract($productAbstractEntity->getIdProductAbstract())
            ->filterByFkAttributeMotherGrid($attributeMotherGridEntity->getIdAttributeMotherGrid())
            ->findOneOrCreate();
        $entity->setCountry($dataSet[static::KEY_COUNTRY]);
        $entity->save();

        $this->eventFacade->trigger(
            SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_PRODUCT_ABSTRACT_UPDATE,
            (new EventEntityTransfer())->setId($entity->getIdAttributeMotherGridProductAbstract())
        );
    }
}
