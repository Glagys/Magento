<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 27/09/17
 * Time: 15:48
 */
namespace Training\Seller\Controller\Seller;

class Index extends AbstractAction {

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|\Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        $searchCriteria = $this->getSearchCriteria();
        $sellers = $this->sellerRepository->getList($searchCriteria);

        /** @var \Training\Seller\Model\Seller $seller */
        echo '<ul>';
        foreach ($sellers->getItems() as $seller) {
            echo '<li><a href="/seller/'.$seller->getIdentifier().'.html">'.$seller->getName().'</a></li>';
        }
        echo '</ul>';
    }

    public function getSearchCriteria() {
        return $this->searchCriteria->create();
    }
}