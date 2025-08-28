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

namespace Magenerds\BasePrice\Block\Adminhtml\Form\Field;

use Magento\Catalog\Api\ProductAttributeOptionManagementInterface;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;

/**
 * Class Unit
 *
 * @package Magenerds\BasePrice\Block\Adminhtml\Form\Field
 */
class Unit extends Select
{
    public function __construct(
        Context $context,
        protected ProductAttributeOptionManagementInterface $productAttributeOptionManagementInterface,
        protected $attributeCode,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productAttributeOptionManagementInterface = $productAttributeOptionManagementInterface;
        $this->attributeCode = $attributeCode;
    }


    public function _toHtml()
    {
        if (!$this->getOptions()) {
            $this->addOption('', __('-- Select value --'));
            foreach ($this->productAttributeOptionManagementInterface->getItems(
                $this->attributeCode
            ) as $item) {
                $this->addOption($item->getValue(), $item->getLabel());
            }
        }
        return parent::_toHtml();
    }

    public function setInputName($value): self
    {
        return $this->setName($value);
    }
}
