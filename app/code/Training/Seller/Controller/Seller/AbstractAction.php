<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 27/09/17
 * Time: 15:45
 */
namespace Training\Seller\Controller\Seller;

abstract class AbstractAction extends \Magento\Framework\App\Action\Action {

    /**
     * @var \Training\Seller\Api\SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteria;



    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Training\Seller\Api\SellerRepositoryInterface $sellerRepository,
                                \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria) {
        $this->sellerRepository = $sellerRepository;
        $this->searchCriteria = $searchCriteria;
        parent::__construct($context);
    }
}