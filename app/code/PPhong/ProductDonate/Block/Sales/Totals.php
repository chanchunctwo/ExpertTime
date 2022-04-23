<?php
namespace PPhong\ProductDonate\Block\Sales;

/**
 * Class Totals
 * @package PPhong\ProductDonate\Block\Sales
 */
class Totals extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $currency;

    /**
     * @var \PPhong\ProductDonate\Service\Configuration
     */
    protected $configuration;

    /**
     * Totals constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Directory\Model\Currency $currency
     * @param \PPhong\ProductDonate\Service\Configuration $configuration
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Model\Currency $currency,
        \PPhong\ProductDonate\Service\Configuration $configuration,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->currency = $currency;
        $this->configuration    = $configuration;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->currency->getCurrencySymbol();
    }

    /**
     * @return $this
     */
    public function initTotals()
    {
        $this->getParentBlock();
        $this->getOrder();
        $this->getSource();

        if(!$this->getSource()->getPpDonateFee()) {
            return $this;
        }
        $total = new \Magento\Framework\DataObject(
            [
                'code' => 'pp_donate_fee',
                'value' => $this->getSource()->getPpDonateFee(),
                'label' => __($this->configuration->getTitle()),
            ]
        );
        $this->getParentBlock()->addTotalBefore($total, 'grand_total');

        return $this;
    }
}
