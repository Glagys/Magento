<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */

namespace Training\Helloworld\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;

class PredispatchLogUrl implements ObserverInterface {

    /**
     * Object logger
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * PredispatchLogUrl constructor.
     *
     * @param \Psr\Log\LoggerInterface $log Magento Logger Interface
     *
     * @return PredispatchLogUrl
     */
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(Observer $observer) {
        $url = $observer->getEvent()->getRequest()->getPathInfo();
        $this->logger->debug('Current url : '. $url);
    }
}