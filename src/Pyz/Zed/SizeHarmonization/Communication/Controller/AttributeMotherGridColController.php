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
class AttributeMotherGridColController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $table = $this
            ->getFactory()
            ->createAttributeMotherGridColTable();

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
            ->createAttributeMotherGridColTable();

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
        $dataProvider = $this->getFactory()->createAttributeMotherGridColFormDataProvider();

        $form = $this
            ->getFactory()
            ->createAttributeMotherGridColForm(
                $dataProvider->getData(),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $attributeMotherGridColTransfer = $this->getFactory()
                    ->createAttributeMotherGridColFormTransferMapper()
                    ->mapToAttributeMotherGridColTransfer($form);

                $idAttributeMotherGrid = $this->getFacade()
                    ->addAttributeMotherGridCol($attributeMotherGridColTransfer);

                $this->addSuccessMessage('The Attribute Mother Grid Col [%s] was added successfully.', [
                    '%s' => $attributeMotherGridColTransfer->getCol(),
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
        $idAttributeMotherGridCol = $this->castId($request->query->get(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_COL));
        $dataProvider = $this->getFactory()->createAttributeMotherGridColFormDataProvider();

        $form = $this->getFactory()
            ->createAttributeMotherGridColForm(
                $dataProvider->getData($idAttributeMotherGridCol),
                $dataProvider->getOptions($idAttributeMotherGridCol)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeMotherGridColTransfer = $this->getFactory()
                ->createAttributeMotherGridColFormTransferMapper()
                ->mapToAttributeMotherGridColTransfer($form);

            $isUpdated = $this->getFacade()
                ->updateAttributeMotherGridCol($attributeMotherGridColTransfer);

            if (!$isUpdated) {
                $this->addErrorMessage('Attribute Mother Grid Col was not updated.');

                return $this->viewResponse([
                    'form' => $form->createView(),
                    'idAttributeMotherGridCol' => $idAttributeMotherGridCol,
                ]);
            }

            $this->addSuccessMessage('The Attribute Mother Grid Col [%s] was updated successfully.', [
                '%s' => $attributeMotherGridColTransfer->getCol(),
            ]);

            return $this->createRedirectResponseAfterAdd($idAttributeMotherGridCol, $request);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'idAttributeMotherGridCol' => $idAttributeMotherGridCol,
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $idAttributeMotherGridCol = $this->castId($request->query->getInt(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_COL));

        $this->getFacade()->deleteAttributeMotherGridCol($idAttributeMotherGridCol);
        $this->addSuccessMessage(sprintf('AttributeMotherGrid col %d was deleted successfully.', $idAttributeMotherGridCol));

        return $this->redirectResponse(
            Url::generate('/size-harmonization/attribute-mother-grid-col')->build()
        );
    }

    /**
     * @param int $idAttributeMotherGridCol
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponseAfterAdd(int $idAttributeMotherGridCol, Request $request)
    {
        $params = $request->query->all();
        $params[SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_COL] = $idAttributeMotherGridCol;

        return $this->redirectResponse(
            urldecode(Url::generate('/size-harmonization/attribute-mother-grid-col/edit', $params)->build())
        );
    }
}
