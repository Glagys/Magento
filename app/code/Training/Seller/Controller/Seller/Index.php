<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 27/09/17
 * Time: 15:48
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Training\Seller\Api\Data\SellerInterface;

class Index extends AbstractAction {

    /**
     * Execute the action
     *
     * @return ResultInterface
     */
    public function execute() {
        $searchCriteria = $this->getSearchCriteria();
        $sellers = $this->sellerRepository->getList($searchCriteria);


        $this->registry->register('seller_search_result', $sellers);

        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Sellers'));

        return $resultPage;
    }

    public function getSearchCriteria() {
        // get the asked filter name, with protection
        $searchName = (string) $this->_request->getParam('search_name', '');
        $searchName = strip_tags($searchName);
        $searchName = preg_replace('/[\'"%]/', '', $searchName);
        $searchName = trim($searchName);

        // build the filter, if needed, and add it to the criteria
        if ($searchName!== '') {
            // build the filter for the name
            $filters[] = $this->filterBuilder
                ->setField(SellerInterface::FIELD_NAME)
                ->setConditionType('like')
                ->setValue("%$searchName%")
                ->create();

            // add the filter to the criteria
            $this->searchCriteria->addFilters($filters);
        }

        // get the asked sort order, with protection
        $sortOrder = (string) $this->_request->getParam('sort_order');
        $availableSort = [
            SortOrder::SORT_ASC,
            SortOrder::SORT_DESC,
        ];
        if (!in_array($sortOrder, $availableSort)) {
            $sortOrder = $availableSort[0];
        }

        // build the sort order and add it to the criteria
        $sort = $this->sortOrderBuilder
            ->setField(SellerInterface::FIELD_NAME)
            ->setDirection($sortOrder)
            ->create();
        $this->searchCriteria->addSortOrder($sort);

        // build the criteria
        return $this->searchCriteria->create();
    }
}