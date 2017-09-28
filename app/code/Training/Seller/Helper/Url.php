<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 28/09/17
 * Time: 09:14
 */

namespace Training\Seller\Helper;


use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Url
 * @package Training\Seller\Helper
 */
class Url extends AbstractHelper {

    /**
     * Get Url for the list of sellers
     *
     * @return string
     */
    public function getSellersUrl() {
        return $this->_urlBuilder->getDirectUrl('sellers.html');
    }

    /**
     * Get Url for one seller
     *
     * @param int $identifier
     * @return string
     */
    public function getSellerUrl($identifier) {
        return $this->_urlBuilder->getDirectUrl('seller/'.$identifier.'.html');
    }
}