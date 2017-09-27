<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 27/09/17
 * Time: 16:01
 */

namespace Training\Seller\Controller\Seller;


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

        echo '<h1>'.$seller->getName().'</h1>';
        echo '<hr />';
        echo '<p>#'.$seller->getIdentifier().'</p>';
        echo '<hr />';
        echo '<a href="/sellers.html">back to the list</a>';
    }
}