<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 26/09/17
 * Time: 16:53
 */

namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Model\Category;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class Categories extends Action {

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $categoryCollectionFactory;

    public function __construct(Context $context, ProductCollectionFactory $productCollectionFactory, CategoryCollectionFactory $categoryCollectionFactory) {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addAttributeToFilter('name', array('like' => '%bag%'))
            ->addCategoryIds()
            ->load();
        $categoryIds = [];
        $return = "";
        foreach ($productCollection->getItems() as $product){
            /** @var \Magento\Catalog\Model\Product $product */
            $categoryIds = array_merge($categoryIds, $product->getCategoryIds());
        }

        $categoryIds = array_unique($categoryIds);

        $categoryCollection = $this->categoryCollectionFactory->create();
        $categoryCollection->addAttributeToFilter('entity_id', array('in' => $categoryIds))
            ->addAttributeToSelect('name')
            ->load();

        $html = '<ul>';
        foreach ($productCollection->getItems() as $product) {
            $html.= '<li>';
            $html.= $product->getId().' => '.$product->getSku().' => '.$product->getName();
            $html.= '<ul>';
            foreach ($product->getCategoryIds() as $categoryId) {
                /** @var \Magento\Catalog\Model\Category $category */
                $category = $categoryCollection->getItemById($categoryId);
                $html .= '<li>' . $categoryId . ' => '.$category->getName() . '</li>';
            }
            $html.= '</ul>';
            $html.= '</li>';
        }
        $html.= '</ul>';

        $this->getResponse()->appendBody($html);

    }
}