<?php
namespace PyzTest\Zed\SizeHarmonization;

use Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacade;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class SizeHarmonizationBusinessTester extends \Codeception\Actor
{
    use _generated\SizeHarmonizationBusinessTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * @return \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacade
     */
    public function createSizeHarmonizationFacade(): SizeHarmonizationFacade
    {
        return new SizeHarmonizationFacade();
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer
     */
    public function createSizeHarmonizationQueryContainer(): SizeHarmonizationQueryContainer
    {
        return new SizeHarmonizationQueryContainer();
    }

    /**
     * @return void
     */
    public function purgeAttributeMotherGrid()
    {
        $sizeHarmonizationQueryContainer = $this->createSizeHarmonizationQueryContainer();
        $attributeMotherGridEntities = $sizeHarmonizationQueryContainer->queryAttributeMotherGrid()
            ->find();

        foreach ($attributeMotherGridEntities as $attributeMotherGridEntity) {
            $attributeMotherGridEntity->delete();
        }
    }


}
