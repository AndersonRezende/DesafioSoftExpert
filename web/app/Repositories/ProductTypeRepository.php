<?php

namespace DesafioSoftExpert\Repositories;

use DesafioSoftExpert\Core\Database;
use DesafioSoftExpert\Models\ProductType;
use DesafioSoftExpert\Repositories\Repository;
use PDO;

class ProductTypeRepository implements Repository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM product_type");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $list = $stmt->fetchAll();
        $productTypes = [];
        foreach ($list as $productType) {
            $productTypes[] = new ProductType($productType);
        }
        return $productTypes;
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM product_type WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != false) {
            return new ProductType($result);
        }
        return false;
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare("INSERT INTO product_type (name) VALUES(:name)");
        $stmt->bindParam(':name', $data['name']);
        $result = $stmt->execute();
        if ($result) {
            $productType = new ProductType($data);
            $productType->setId($this->db->lastInsertId());
            return $productType;
        }
        return $result;
    }

    public function update(int $id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE product_type SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            $productType = new ProductType($data);
            $productType->setId($id);
            return $productType;
        }
        return false;
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM product_type WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            return true;
        }
        return false;
    }
}