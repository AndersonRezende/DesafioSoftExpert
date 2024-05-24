<?php

namespace DesafioSoftExpert\Repositories;

use DesafioSoftExpert\Core\Database;
use DesafioSoftExpert\Models\Product;
use PDO;
use PDOException;

class ProductRepository implements Repository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $list = $stmt->fetchAll();
        $products = [];
        foreach ($list as $index => $product) {
            $products[] = new Product($product);
            $productType = (new ProductTypeRepository())->find($product['id_product_type']);
            $products[$index]->setProductType($productType);
            $products[$index]->setImage($this->getImageAsString($product['image']));
            $taxes = (new TaxRepository())->getByProductType($productType->getId());
            $products[$index]->setTaxes($taxes);
        }
        return $products;
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != false) {
            $product = new Product($result);
            $productType = (new ProductTypeRepository())->find($result['id_product_type']);
            $product->setProductType($productType);
            $product->setImage($this->getImageAsString($result['image']));
            return $product;
        }
        return false;
    }

    public function create(array $data)
    {
        $data['price'] = str_replace(',', '.', $data['price']);
        $data['product_type'] = intval($data['product_type']);
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $stmt = $this->db->prepare("INSERT INTO products (sku, name, description, price, id_product_type, image) VALUES(:sku, :name, :description, :price, :id_product_type, :image)");
        $stmt->bindParam(':sku', $data['sku']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':id_product_type', $data['product_type']);
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        $result = $stmt->execute();
        if ($result) {
            $product = new Product($data);
            $product->setId($this->db->lastInsertId());
            return $product;
        }
        return $result;
    }

    public function update(int $id, array $data)
    {
        $data['price'] = str_replace(',', '.', $data['price']);
        $data['product_type'] = intval($data['product_type']);
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
            $image = file_get_contents($_FILES['image']['tmp_name']);
        }
        if ($image) {
            $stmt = $this->db->prepare("UPDATE products SET sku = :sku, name = :name, description = :description, price = :price, id_product_type = :id_product_type, image = :image WHERE id = :id");
            $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        } else {
            $stmt = $this->db->prepare("UPDATE products SET sku = :sku, name = :name, description = :description, price = :price, id_product_type = :id_product_type WHERE id = :id");
        }
        $stmt->bindParam(':sku', $data['sku']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':id_product_type', $data['product_type']);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            $product = $this->find($id);
            $productType = (new ProductTypeRepository())->find($product->getIdProductType());
            $product->setProductType($productType);
            return $product;
        }
        return false;
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            return true;
        }
        return false;
    }

    private function getImageAsString($imageStream)
    {
        if (is_resource($imageStream)) {
            return stream_get_contents($imageStream);
        }
        return $imageStream;
    }

    public function getByIds(array $ids)
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute($ids);
        $list = $stmt->fetchAll();
        $products = [];
        foreach ($list as $index => $product) {
            $products[] = new Product($product);
            $productType = (new ProductTypeRepository())->find($product['id_product_type']);
            $products[$index]->setProductType($productType);
            $products[$index]->setImage($this->getImageAsString($product['image']));
            $taxes = (new TaxRepository())->getByProductType($productType->getId());
            $products[$index]->setTaxes($taxes);
        }
        return $products;
    }
}