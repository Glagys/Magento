<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 27/09/17
 * Time: 15:45
 */
namespace Training\Seller\Controller\Seller;


/**
 * Class AbstractAction
 * @package Training\Seller\Controller\Seller
 */
abstract class AbstractAction extends \Magento\Framework\App\Action\Action {

    /**
     * @var \Training\Seller\Api\SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteria;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var \Magento\Framework\Api\SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * AbstractAction constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Training\Seller\Api\SellerRepositoryInterface $sellerRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Training\Seller\Api\SellerRepositoryInterface $sellerRepository,
                                \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria,
                                \Magento\Framework\Api\FilterBuilder $filterBuilder,
                                \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
                                \Magento\Framework\Registry $registry) {
        $this->sellerRepository = $sellerRepository;
        $this->searchCriteria = $searchCriteria;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->registry = $registry;
        parent::__construct($context);
    }
}