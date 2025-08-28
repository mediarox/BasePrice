<?php

/**
 * @package   Theme_Module
 * @copyright Copyright 2025 (c) mediarox UG (haftungsbeschraenkt)
 *            (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Magenerds\BasePrice\ViewModel;

use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class BasePriceViewModel implements ArgumentInterface
{
    public function __construct(
        private Registry $registry,
    ) {
    }

    private function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    private function isCurrentProduct(int $productId): bool
    {
        return (int)$this->getCurrentProduct()?->getId() === $productId;
    }

    public function getSwatchOptSelector(int $productId): string
    {
        $selector = '.swatch-opt';
        if (!$this->isCurrentProduct($productId)) {
            $selector = '.swatch-opt' . '-' . $productId;
        }
        return $selector;
    }

    public function getAttributeIdSelector(int $productId): string
    {
        $selector = '.swatch-attribute';
        if (!$this->isCurrentProduct($productId)) {
            $selector = '.swatch-opt' . '-' . $productId . ' > ' . '.swatch-attribute';
        }
        return $selector;
    }

    public function getBasePriceSelector(int $productId)
    {
        $selector = '.base-price-' . $this->getCurrentProduct()->getId();
        if (!$this->isCurrentProduct($productId)) {

        }
    }
}
