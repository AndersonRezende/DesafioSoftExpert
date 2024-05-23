<?php

namespace DesafioSoftExpert\Models;

use DesafioSoftExpert\Traits\Hydrator;

class Tax extends Model
{
    use Hydrator;

    private $id;
    private $name;
    private $value;
    private $productTypes;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getProductTypes()
    {
        return $this->productTypes;
    }

    /**
     * @param mixed $productTypes
     */
    public function setProductTypes($productTypes): void
    {
        $this->productTypes = $productTypes;
    }

    public function productTypesList()
    {
        $result = implode(', ', array_map(function ($item) {
            return $item->getName();
        }, $this->productTypes));
        return $result;
    }


    public function isCheckedProductType($productType)
    {
        return str_contains($this->productTypesList(), $productType) ? 'checked' : '';
    }
}