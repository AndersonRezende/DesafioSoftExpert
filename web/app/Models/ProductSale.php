<?php

namespace DesafioSoftExpert\Models;

use DesafioSoftExpert\Traits\Hydrator;
use DesafioSoftExpert\Traits\Money;

class ProductSale
{
    use Hydrator, Money;
    private $id;
    private $id_sale;
    private $id_product;
    private $quantity;
    private $product_price;
    private $product_price_with_tax;
    private $product;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdSale()
    {
        return $this->id_sale;
    }

    /**
     * @param mixed $id_sale
     */
    public function setIdSale($id_sale): void
    {
        $this->id_sale = $id_sale;
    }

    /**
     * @return mixed
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param mixed $id_product
     */
    public function setIdProduct($id_product): void
    {
        $this->id_product = $id_product;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * @param mixed $product_price
     */
    public function setProductPrice($product_price): void
    {
        $this->product_price = $product_price;
    }

    /**
     * @return mixed
     */
    public function getProductPriceWithTax()
    {
        return $this->product_price_with_tax;
    }

    /**
     * @param mixed $product_price_with_tax
     */
    public function setProductPriceWithTax($product_price_with_tax): void
    {
        $this->product_price_with_tax = $product_price_with_tax;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    public function totalTax()
    {
        $value = ($this->product_price_with_tax - $this->product_price) * $this->quantity;
        return max($value, 0);
    }
}