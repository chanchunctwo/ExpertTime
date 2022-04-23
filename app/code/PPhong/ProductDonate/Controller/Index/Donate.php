<?php

namespace PPhong\ProductDonate\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Donate extends \Magento\Framework\App\Action\Action
{

        /**
     * @var \Magento\Checkout\Model\Cart
     */
    private $cart;

    /**
     * @var \Magento\Directory\Helper\Data
     */
    private $directoryHelper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    private $priceCurrency;

        public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency)
    {
        $this->cart = $cart;
        $this->directoryHelper  = $directoryHelper;
        $this->storeManager     = $storeManager;
        $this->priceCurrency    = $priceCurrency;

        return parent::__construct($context);
    }
    /**
     * Booking action
     *
     * @return void
     */
    public function execute()
    {

        $donate = $this->getRequest()->getParam('is_donate');


        if (!empty($donate)) {
            $items = $this->cart->getQuote()->getAllItems();

            $is_first_item = true;
            // Doing-something with...
            foreach($items as $item) {
                if($is_first_item){
                    $donateValue = $this->getRequest()->getParam('donate-value');

                    $baseCurrencyCode = $this->storeManager->getStore()->getBaseCurrencyCode();
        
                    $currencyCode = $this->storeManager->getStore()->getCurrentCurrency()->getCode();
        
                    $fee = $item->getPpDonateFee() ? $item->getPpDonateFee() : 0;
        
                    $baseFee = $item->getBasePpDonateFee() ? $item->getBasePpDonateFee() : 0;
        
                    $fee += $this->priceCurrency->round($donateValue);
        
                    $baseFee += $this->priceCurrency->round($this->directoryHelper->currencyConvert($donateValue, $currencyCode, $baseCurrencyCode));

                    $item->setBasePpDonateFee($baseFee);
        
                    $item->setPpDonateFee($fee);

                    $item->save();
                    
                    $is_first_item = false;
                }
            }

            // Display the success form validation message
            $this->messageManager->addSuccessMessage('Donation request submitted!');

            // Redirect to your form page (or anywhere you want...)
            //$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            // $resultRedirect->setUrl('/companymodule/index/booking');

            // return $resultRedirect;
        }else{
            $this->messageManager->addError(__('please try again. Donate Form Not Submit'));
        }

    }
}