<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 27/09/17
 * Time: 16:01
 */

namespace Training\Seller\Controller\Seller;


use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class View extends AbstractAction {
    /**
     * Execute the action
     *
     * @return void
     */
    public function execute() {
        // get the asked identifier
        $identifier = trim($this->getRequest()->getParam('identifier'));
        if (!$identifier) {
            $this->_forward('noroute');
            return null;
        }

        // get the asked seller
        try {
            $seller = $this->sellerRepository->getByIdentifier($identifier);
        } catch (NoSuchEntityException $e) {
            $this->_forward('noroute');
            return null;
        }

        $this->registry->register('current_seller', $seller);

        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Seller "%1"', $seller->getName()));

        return $resultPage;
    }
}