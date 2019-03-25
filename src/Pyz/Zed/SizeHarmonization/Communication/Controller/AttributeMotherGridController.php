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
class AttributeMotherGridController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $attributeMotherGridTable = $this
            ->getFactory()
            ->createAttributeMotherGridTable();

        return $this->viewResponse([
            'attributeMotherGridTable' => $attributeMotherGridTable->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $attributeMotherGridTable = $this
            ->getFactory()
            ->createAttributeMotherGridTable();

        return $this->jsonResponse(
            $attributeMotherGridTable->fetchData()
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $dataProvider = $this->getFactory()->createAttributeMotherGridFormAddDataProvider();

        $form = $this
            ->getFactory()
            ->createAttributeMotherGridFormAdd(
                $dataProvider->getData(),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $attributeMotherGridTransfer = $this->getFactory()
                    ->createAttributeMotherGridFormTransferMapper()
                    ->mapToAttributeMotherGridTransfer($form);

                $idAttributeMotherGrid = $this->getFacade()
                    ->addAttributeMotherGrid($attributeMotherGridTransfer);

                $this->addSuccessMessage('The Attribute Mother Grid [%s] was added successfully.', [
                    '%s' => $attributeMotherGridTransfer->getName(),
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
        $idAttributeMotherGrid = $this->castId($request->query->get(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID));
        $dataProvider = $this->getFactory()->createAttributeMotherGridFormAddDataProvider();

        $form = $this->getFactory()
            ->createAttributeMotherGridFormAdd(
                $dataProvider->getData($idAttributeMotherGrid),
                $dataProvider->getOptions($idAttributeMotherGrid)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeMotherGridTransfer = $this->getFactory()
                ->createAttributeMotherGridFormTransferMapper()
                ->mapToAttributeMotherGridTransfer($form);

            $isUpdated = $this->getFacade()
                ->updateAttributeMotherGrid($attributeMotherGridTransfer);

            if (!$isUpdated) {
                $this->addErrorMessage('Attribute Mother Grid was not updated.');

                return $this->viewResponse([
                    'form' => $form->createView(),
                    'idAttributeMotherGrid' => $idAttributeMotherGrid,
                ]);
            }

            $this->addSuccessMessage('The Attribute Mother Grid [%s] was updated successfully.', [
                '%s' => $attributeMotherGridTransfer->getName(),
            ]);

            return $this->createRedirectResponseAfterAdd($idAttributeMotherGrid, $request);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'idAttributeMotherGrid' => $idAttributeMotherGrid,
        ]);
    }

    /**
     * @param int $idAttributeMotherGrid
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponseAfterAdd(int $idAttributeMotherGrid, Request $request)
    {
        $params = $request->query->all();
        $params[SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID] = $idAttributeMotherGrid;

        return $this->redirectResponse(
            urldecode(Url::generate('/size-harmonization/attribute-mother-grid/edit', $params)->build())
        );
    }
}
