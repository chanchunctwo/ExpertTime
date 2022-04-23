<?php
namespace PPhong\ProductDonate\Block\Catalog\Product;

/**
 * Class View
 * @package PPhong\ProductDonate\Block\Catalog\Product
 */
class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Store\Api\Data\StoreInterface
     */
    private $store;

    /**
     * @var \PPhong\ProductDonate\Service\Configuration
     */
    private $configuration;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    private $filterProvider;

    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    private $priceCurrency;

    /**
     * View constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \PPhong\ProductDonate\Service\Configuration $configuration
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \PPhong\ProductDonate\Service\Configuration $configuration,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->configuration         = $configuration;
        $this->_scopeConfig          = $context->getScopeConfig();
        $this->filterProvider        = $filterProvider;
        $this->priceCurrency         = $priceCurrency;
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isEnable() {
        return $this->configuration->isModuleEnable($this->_getStore());
    }


    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getTitle() {
        return $this->configuration->getTitle($this->_getStore());
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDescription() {
        $value = $this->configuration->getDescription($this->_getStore());
        $html = $this->filterProvider->getPageFilter()->filter($value);
        return $html;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBannerUrl() {
        return $this->configuration->getBannerUrl($this->_getStore());
    }

    /**
     * @return array|mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDonateOptions() {
        return $this->configuration->getDonateOptions($this->_getStore());
    }

        /**
     * @return array|mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAmount() {
        return $this->configuration->getAmount($this->_getStore());
    }

    /**
     * @param $price
     * @return float
     */
    public function roundPrice($price) {
        return $this->priceCurrency->round($price);
    }

    /**
     * @return \Magento\Store\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function _getStore() {
        if ( null == $this->store ) {
            $this->store = $this->_storeManager->getStore();
        }
        return $this->store;
    }
}
