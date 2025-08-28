<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * @category   Magenerds
 * @package    Magenerds_BasePrice
 * @subpackage Model
 * @copyright  Copyright (c) 2019 TechDivision GmbH (https://www.techdivision.com)
 * @link       https://www.techdivision.com/
 * @author     Florian Sydekum <f.sydekum@techdivision.com>
 */
namespace Magenerds\BasePrice\Model\Plugin;

/**
 * Class ConfigurablePrice
 * @package Magenerds\BasePrice\Model\Plugin
 */
class ConfigurablePrice
{
    public function __construct(
        private \Magenerds\BasePrice\Helper\Data $helper,
        private \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        private \Magento\Framework\Json\DecoderInterface $jsonDecoder
    ){
    }

    public function afterGetJsonConfig(\Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject, $json)
    {
        $config = $this->jsonDecoder->decode($json);

        foreach ($subject->getAllowProducts() as $product) {
            $basePriceText = $this->helper->getBasePriceText($product);

            if (empty($basePriceText)) {
                // if simple has no configured base price, us at least the base price of configurable
                $basePriceText = $this->helper->getBasePriceText($subject->getProduct());
            }

            $config['optionPrices'][$product->getId()]['magenerds_baseprice_text'] = $basePriceText;
        }

        return $this->jsonEncoder->encode($config);
    }
}
