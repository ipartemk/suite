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
class AttributeMotherGridKeyController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $table = $this
            ->getFactory()
            ->createAttributeMotherGridKeyTable();

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
            ->createAttributeMotherGridKeyTable();

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
        $dataProvider = $this->getFactory()->createAttributeMotherGridKeyFormDataProvider();

        $form = $this
            ->getFactory()
            ->createAttributeMotherGridKeyForm(
                $dataProvider->getData(),
                $dataProvider->getOptions()
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $attributeMotherGridKeyTransfer = $this->getFactory()
                    ->createAttributeMotherGridKeyFormTransferMapper()
                    ->mapToAttributeMotherGridKeyTransfer($form);

                $idAttributeMotherGrid = $this->getFacade()
                    ->addAttributeMotherGridKey($attributeMotherGridKeyTransfer);

                $this->addSuccessMessage('The Attribute Mother Grid Key [%s] was added successfully.', [
                    '%s' => $attributeMotherGridKeyTransfer->getKey(),
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
        $idAttributeMotherGridKey = $this->castId($request->query->get(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_KEY));
        $dataProvider = $this->getFactory()->createAttributeMotherGridKeyFormDataProvider();

        $form = $this->getFactory()
            ->createAttributeMotherGridKeyForm(
                $dataProvider->getData($idAttributeMotherGridKey),
                $dataProvider->getOptions($idAttributeMotherGridKey)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeMotherGridKeyTransfer = $this->getFactory()
                ->createAttributeMotherGridKeyFormTransferMapper()
                ->mapToAttributeMotherGridKeyTransfer($form);

            $isUpdated = $this->getFacade()
                ->updateAttributeMotherGridKey($attributeMotherGridKeyTransfer);

            if (!$isUpdated) {
                $this->addErrorMessage('Attribute Mother Grid Key was not updated.');

                return $this->viewResponse([
                    'form' => $form->createView(),
                    'idAttributeMotherGridKey' => $idAttributeMotherGridKey,
                ]);
            }

            $this->addSuccessMessage('The Attribute Mother Grid Key [%s] was updated successfully.', [
                '%s' => $attributeMotherGridKeyTransfer->getKey(),
            ]);

            return $this->createRedirectResponseAfterAdd($idAttributeMotherGridKey, $request);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'idAttributeMotherGridKey' => $idAttributeMotherGridKey,
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $idAttributeMotherGridKey = $this->castId($request->query->getInt(SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_KEY));

        $this->getFacade()->deleteAttributeMotherGridKey($idAttributeMotherGridKey);
        $this->addSuccessMessage(sprintf('AttributeMotherGrid key %d was deleted successfully.', $idAttributeMotherGridKey));

        return $this->redirectResponse(
            Url::generate('/size-harmonization/attribute-mother-grid-key')->build()
        );
    }

    /**
     * @param int $idAttributeMotherGridKey
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponseAfterAdd(int $idAttributeMotherGridKey, Request $request)
    {
        $params = $request->query->all();
        $params[SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_KEY] = $idAttributeMotherGridKey;

        return $this->redirectResponse(
            urldecode(Url::generate('/size-harmonization/attribute-mother-grid-key/edit', $params)->build())
        );
    }
}
