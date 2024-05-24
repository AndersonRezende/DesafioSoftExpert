<?php

namespace DesafioSoftExpert\Service;

use DesafioSoftExpert\Models\ProductSale;
use DesafioSoftExpert\Models\ProductType;
use DesafioSoftExpert\Models\Sale;
use DesafioSoftExpert\Repositories\ProductRepository;
use DesafioSoftExpert\Repositories\SaleRepository;
use DesafioSoftExpert\Repositories\TaxRepository;

class SaleService
{
    public function buildSale($data)
    {
        $data = $this->adjustRequestData($data);
        $totalProductQuantity = array_sum($data);
        $products = (new ProductRepository())->getByIds(array_keys($data));


        $productsSale = [];
        $productTypesIds = [];
        $totalBase = 0;
        $totalValueWithTax = 0;
        foreach ($products as $product) {
            $productsSale[$product->getId()] = new ProductSale([
                'id_product' => $product->getId(),
                'quantity' => $data[$product->getId()],
                'product_price' => $product->getPrice(),
                'product_price_with_tax' => $product->getPriceWithTaxes()
            ]);
            $totalBase += ($product->getPrice() * $data[$product->getId()]);
            $totalValueWithTax += ($product->getPriceWithTaxes() * $data[$product->getId()]);

            $productTypesIds[] = $product->getProductType()->getId();
        }

        $taxes = (new TaxRepository())->getByProductTypeIds($productTypesIds);


        $productTax = [];
        foreach ($products as $index => $product) {
            foreach ($taxes as $tax) {
                foreach ($tax->getProductTypes() as $productType) {
                    if ($productType->getId() == $product->getProductType()->getId()) {
                        $productTax[$index] += $tax->getValue() * $product->getPrice() * $data[$product->getId()];
                    }
                }
            }
        }

        $sale = new Sale([
           'total_base_value' => $totalBase,
           'total_tax_value' => 0,
           'total_value_with_tax' => $totalValueWithTax,
           'items_count' => $totalProductQuantity,
           'products_count' => sizeof($data),
           'finished' => date('Y-m-d H:i:s')
        ]);

        return (new SaleRepository())->createWithChildren($sale, $productsSale);
    }


    private function adjustRequestData($data)
    {
        return array_filter($data, function($quantity) {
            return $quantity !== '0';
        });
    }
}