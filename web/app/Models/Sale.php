<?php

namespace DesafioSoftExpert\Models;

use DesafioSoftExpert\Traits\Hydrator;
use DesafioSoftExpert\Traits\Money;

class Sale extends Model
{
    use Hydrator, Money;

    private $id;
    private $total_base_value;
    private $total_tax_value;
    private $total_value_with_tax;
    private $items_count;
    private $products_count;
    private $finished;
    private $created_at;
    private $updated_at;
    private $productsSale;

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
    public function getTotalBaseValue()
    {
        return $this->total_base_value;
    }

    /**
     * @param mixed $total_base_value
     */
    public function setTotalBaseValue($total_base_value): void
    {
        $this->total_base_value = $total_base_value;
    }

    /**
     * @return mixed
     */
    public function getTotalTaxValue()
    {
        return $this->total_tax_value;
    }

    /**
     * @param mixed $total_tax_value
     */
    public function setTotalTaxValue($total_tax_value): void
    {
        $this->total_tax_value = $total_tax_value;
    }

    /**
     * @return mixed
     */
    public function getTotalValueWithTax()
    {
        return $this->total_value_with_tax;
    }

    /**
     * @param mixed $total_value_with_tax
     */
    public function setTotalValueWithTax($total_value_with_tax): void
    {
        $this->total_value_with_tax = $total_value_with_tax;
    }

    /**
     * @return mixed
     */
    public function getItemsCount()
    {
        return $this->items_count;
    }

    /**
     * @param mixed $items_count
     */
    public function setItemsCount($items_count): void
    {
        $this->items_count = $items_count;
    }

    /**
     * @return mixed
     */
    public function getProductsCount()
    {
        return $this->products_count;
    }

    /**
     * @param mixed $products_count
     */
    public function setProductsCount($products_count): void
    {
        $this->products_count = $products_count;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finished
     */
    public function setFinished($finished): void
    {
        $this->finished = $finished;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getProductsSale()
    {
        return $this->productsSale;
    }

    /**
     * @param mixed $productsSale
     */
    public function setProductsSale($productsSale): void
    {
        $this->productsSale = $productsSale;
    }

    public function totalTax()
    {
        $value = ($this->total_value_with_tax - $this->total_base_value);
        return max($value, 0);
    }
}