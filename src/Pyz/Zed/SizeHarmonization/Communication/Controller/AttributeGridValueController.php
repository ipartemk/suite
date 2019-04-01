<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Controller;

use Exception;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacade getFacade()
 * @method \Pyz\Zed\SizeHarmonization\Communication\SizeHarmonizationCommunicationFactory getFactory()
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer getQueryContainer()
 */
class AttributeGridValueController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $table = $this
            ->getFactory()
            ->createAttributeGridValueTable();

        return $this->viewResponse([
            'table' => $table->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $table = $this
            ->getFactory()
            ->createAttributeGridValueTable();

        return $this->jsonResponse(
            $table->fetchData()
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $dataProvider = $this->getFactory()->createAttributeGridvalueFormDataProvider();

        $form = $this
            ->getFactory()
            ->createAttributeGridvalueForm(
                $dataProvider->getData(),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $attributeGridValueTransfer = $this->getFactory()
                    ->createAttributeGridValueFormTransferMapper()
                    ->mapToAttributeGridValueTransfer($form);

                $idAttributeGridValue = $this->getFacade()
                    ->addAttributeGridValue($attributeGridValueTransfer);

                $this->addSuccessMessage('The Attribute Grid Value [%s] was added successfully.', [
                    '%s' => $attributeGridValueTransfer->getValue(),
                ]);

                return $this->createRedirectResponseAfterAdd($idAttributeGridValue, $request);
            } catch (Exception $exception) {
                $this->addErrorMessage($exception->getMessage());
            }
        }

        return $this->viewResponse([
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request)
    {
        $idAttributeGridValue = $this->castId($request->query->get(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_VALUE));
        $dataProvider = $this->getFactory()->createAttributeGridValueFormDataProvider();

        $form = $this->getFactory()
            ->createAttributeGridValueForm(
                $dataProvider->getData($idAttributeGridValue),
                $dataProvider->getOptions($idAttributeGridValue)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeGridValueTransfer = $this->getFactory()
                ->createAttributeGridValueFormTransferMapper()
                ->mapToAttributeGridValueTransfer($form);

            $isUpdated = $this->getFacade()
                ->updateAttributeGridValue($attributeGridValueTransfer);

            if (!$isUpdated) {
                $this->addErrorMessage('Attribute Grid Value was not updated.');

                return $this->viewResponse([
                    'form' => $form->createView(),
                    'idAttributeGridValue' => $idAttributeGridValue,
                ]);
            }

            $this->addSuccessMessage('The Attribute Grid Value [%s] was updated successfully.', [
                '%s' => $attributeGridValueTransfer->getValue(),
            ]);

            return $this->createRedirectResponseAfterAdd($idAttributeGridValue, $request);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'idAttributeGridValue' => $idAttributeGridValue,
        ]);
    }

    /**
     * @param int $idAttributeGridValue
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponseAfterAdd(int $idAttributeGridValue, Request $request)
    {
        $params = $request->query->all();
        $params[SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_VALUE] = $idAttributeGridValue;

        return $this->redirectResponse(
            urldecode(Url::generate('/size-harmonization/attribute-grid-value/edit', $params)->build())
        );
    }
}
