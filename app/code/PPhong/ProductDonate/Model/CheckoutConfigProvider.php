<?php
namespace PPhong\ProductDonate\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

/**
 * Class CheckoutConfigProvider
 * @package PPhong\ProductDonate\Model
 */
class CheckoutConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \PPhong\ProductDonate\Service\Configuration
     */
    protected $configuration;

    /**
     * @var \PPhong\ProductDonate\Service\CalculateService
     */
    protected $calculateService;

    /**
     * CheckoutConfigProvider constructor.
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \PPhong\ProductDonate\Service\Configuration $configuration
     * @param \PPhong\ProductDonate\Service\CalculateService $calculateService
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \PPhong\ProductDonate\Service\Configuration $configuration,
        \PPhong\ProductDonate\Service\CalculateService $calculateService
    ) {
        $this->checkoutSession  = $checkoutSession;
        $this->configuration    = $configuration;
        $this->calculateService = $calculateService;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getConfig()
    {
        $ppFeeConfig = [];

        $quote = $this->checkoutSession->getQuote();

        $feeService = $this->calculateService->calculate($quote);

        $ppFeeConfig['ppdonate']['fee_title'] = $this->configuration->getTitle();

        $ppFeeConfig['ppdonate']['extra_fee_amount'] = $feeService->getPpDonateFee();

        $ppFeeConfig['ppdonate']['base_extra_fee_amount'] = $feeService->getBasePpDonateFee();

        $ppFeeConfig['ppdonate']['show_hide_extrafee'] = $feeService->getPpDonateFee() > 0.0;

        return $ppFeeConfig;
    }
}
