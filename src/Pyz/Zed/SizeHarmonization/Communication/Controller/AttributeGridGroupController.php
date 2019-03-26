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
class AttributeGridGroupController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $attributeGridGroupTable = $this
            ->getFactory()
            ->createAttributeGridGroupTable();

        return $this->viewResponse([
            'table' => $attributeGridGroupTable->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $attributeGridGroupTable = $this
            ->getFactory()
            ->createAttributeGridGroupTable();

        return $this->jsonResponse(
            $attributeGridGroupTable->fetchData()
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $dataProvider = $this->getFactory()->createAttributeGridGroupFormDataProvider();

        $form = $this
            ->getFactory()
            ->createAttributeGridGroupForm(
                $dataProvider->getData(),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $attributeGridGroupTransfer = $this->getFactory()
                    ->createAttributeGridGroupFormTransferMapper()
                    ->mapToAttributeGridGroupTransfer($form);

                $idAttributeGridGroup = $this->getFacade()
                    ->addAttributeGridGroup($attributeGridGroupTransfer);

                $this->addSuccessMessage('The Attribute Grid Group [%s] was added successfully.', [
                    '%s' => $attributeGridGroupTransfer->getGroup(),
                ]);

                return $this->createRedirectResponseAfterAdd($idAttributeGridGroup, $request);
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
        $idAttributeGridGroup = $this->castId($request->query->get(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_GROUP));
        $dataProvider = $this->getFactory()->createAttributeGridGroupFormDataProvider();

        $form = $this->getFactory()
            ->createAttributeGridGroupForm(
                $dataProvider->getData($idAttributeGridGroup),
                $dataProvider->getOptions($idAttributeGridGroup)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeGridGroupTransfer = $this->getFactory()
                ->createAttributeGridGroupFormTransferMapper()
                ->mapToAttributeGridGroupTransfer($form);

            $isUpdated = $this->getFacade()
                ->updateAttributeGridGroup($attributeGridGroupTransfer);

            if (!$isUpdated) {
                $this->addErrorMessage('Attribute Grid Group was not updated.');

                return $this->viewResponse([
                    'form' => $form->createView(),
                    'idAttributeGridGroup' => $idAttributeGridGroup,
                ]);
            }

            $this->addSuccessMessage('The Attribute Grid Group [%s] was updated successfully.', [
                '%s' => $attributeGridGroupTransfer->getGroup(),
            ]);

            return $this->createRedirectResponseAfterAdd($idAttributeGridGroup, $request);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'idAttributeGridGroup' => $idAttributeGridGroup,
        ]);
    }

    /**
     * @param int $idAttributeGridGroup
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponseAfterAdd(int $idAttributeGridGroup, Request $request)
    {
        $params = $request->query->all();
        $params[SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_GROUP] = $idAttributeGridGroup;

        return $this->redirectResponse(
            urldecode(Url::generate('/size-harmonization/attribute-grid-group/edit', $params)->build())
        );
    }
}
