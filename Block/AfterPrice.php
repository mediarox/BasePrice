<?php
/**
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * @category   Magenerds
 * @package    Magenerds_BasePrice
 * @subpackage Block
 * @copyright  Copyright (c) 2019 TechDivision GmbH
 *             (https://www.techdivision.com)
 * @link       https://www.techdivision.com/
 * @author     Florian Sydekum <f.sydekum@techdivision.com>
 */

namespace Magenerds\BasePrice\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magenerds\BasePrice\Helper\Data;

/**
 * Class AfterPrice
 *
 * @package Magenerds\BasePrice\Block
 */
class AfterPrice extends Template
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        protected Data $helper,
        protected Product $product,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Returns the configuration if module is enabled
     *
     * @return mixed
     */
    public function isEnabled()
    {
        $moduleEnabled = $this->_scopeConfig->getValue(
            'baseprice/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        $productAmount = $this->getProduct()
            ->getData('baseprice_product_amount');

        return $moduleEnabled && !empty($productAmount);
    }

    /**
     * Retrieve current product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Returns the base price information
     */
    public function getBasePrice()
    {
        return $this->helper->getBasePriceText($this->getProduct());
    }
}
