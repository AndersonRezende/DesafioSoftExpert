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
            return $product;
        }
        return false;
    }

    public function create(array $data)
    {
        $data['price'] = str_replace(',', '.', $data['price']);
        $data['product_type'] = intval($data['product_type']);
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, id_product_type) VALUES(:name, :description, :price, :id_product_type)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':id_product_type', $data['product_type']);
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
        $stmt = $this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price, id_product_type = :id_product_type WHERE id = :id");
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
}