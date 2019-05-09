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
class AttributeMotherGridValueController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $table = $this
            ->getFactory()
            ->createAttributeMotherGridValueTable();

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
            ->createAttributeMotherGridValueTable();

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
        $dataProvider = $this->getFactory()->createAttributeMotherGridvalueFormDataProvider();

        $form = $this
            ->getFactory()
            ->createAttributeMotherGridvalueForm(
                $dataProvider->getData(),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $attributeMotherGridValueTransfer = $this->getFactory()
                    ->createAttributeMotherGridValueFormTransferMapper()
                    ->mapToAttributeMotherGridValueTransfer($form);

                $idAttributeMotherGrid = $this->getFacade()
                    ->addAttributeMotherGridValue($attributeMotherGridValueTransfer);

                $this->addSuccessMessage('The Attribute Mother Grid Value [%s] was added successfully.', [
                    '%s' => $attributeMotherGridValueTransfer->getValue(),
                ]);

                return $this->createRedirectResponseAfterAdd($idAttributeMotherGrid, $request);
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
        $idAttributeMotherGridValue = $this->castId($request->query->get(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_VALUE));
        $dataProvider = $this->getFactory()->createAttributeMotherGridValueFormDataProvider();

        $form = $this->getFactory()
            ->createAttributeMotherGridValueForm(
                $dataProvider->getData($idAttributeMotherGridValue),
                $dataProvider->getOptions($idAttributeMotherGridValue)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeMotherGridValueTransfer = $this->getFactory()
                ->createAttributeMotherGridValueFormTransferMapper()
                ->mapToAttributeMotherGridValueTransfer($form);

            $isUpdated = $this->getFacade()
                ->updateAttributeMotherGridValue($attributeMotherGridValueTransfer);

            if (!$isUpdated) {
                $this->addErrorMessage('Attribute Mother Grid Value was not updated.');

                return $this->viewResponse([
                    'form' => $form->createView(),
                    'idAttributeMotherGridValue' => $idAttributeMotherGridValue,
                ]);
            }

            $this->addSuccessMessage('The Attribute Mother Grid Value [%s] was updated successfully.', [
                '%s' => $attributeMotherGridValueTransfer->getValue(),
            ]);

            return $this->createRedirectResponseAfterAdd($idAttributeMotherGridValue, $request);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'idAttributeMotherGridValue' => $idAttributeMotherGridValue,
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $idAttributeMotherGridValue = $this->castId($request->query->getInt(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_VALUE));

        $this->getFacade()->deleteAttributeMotherGridValue($idAttributeMotherGridValue);
        $this->addSuccessMessage(sprintf('AttributeMotherGrid value %d was deleted successfully.', $idAttributeMotherGridValue));

        return $this->redirectResponse(
            Url::generate('/size-harmonization/attribute-mother-grid-value')->build()
        );
    }

    /**
     * @param int $idAttributeMotherGridValue
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponseAfterAdd(int $idAttributeMotherGridValue, Request $request)
    {
        $params = $request->query->all();
        $params[SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_VALUE] = $idAttributeMotherGridValue;

        return $this->redirectResponse(
            urldecode(Url::generate('/size-harmonization/attribute-mother-grid-value/edit', $params)->build())
        );
    }
}
