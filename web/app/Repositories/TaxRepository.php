<?php

namespace DesafioSoftExpert\Repositories;

use DesafioSoftExpert\Core\Database;
use DesafioSoftExpert\Models\Tax;
use PDO;

class TaxRepository implements Repository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM taxes");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $list = $stmt->fetchAll();
        $taxes = [];
        foreach ($list as $index => $tax) {
            $taxes[] = new Tax($tax);
            $productTypes = (new ProductTypeRepository())->findByTax($taxes[$index]->getId());
            $taxes[$index]->setProductTypes($productTypes);
        }
        return $taxes;
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM taxes WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != false) {
            $tax = new Tax($result);

            $productTypes = (new ProductTypeRepository())->findByTax($tax->getId());
            $tax->setProductTypes($productTypes);
            return $tax;
        }
        return false;
    }

    public function create(array $data)
    {
        $data['value'] = str_replace(',', '.', $data['value']);
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO taxes (name, value) VALUES(:name, :value)");
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':value', $data['value']);
            if (!$stmt->execute()) {
                throw new \Exception("Erro ao cadastrar imposto");
            }

            $lastInsertId = $this->db->lastInsertId();
            foreach ($data['product_type'] as $productType) {
                $id_product_type = intval($productType);
                $stmt_tp = $this->db->prepare("INSERT INTO tax_product (id_tax, id_product_type) VALUES(:id_tax, :id_product_type)");
                $stmt_tp->bindParam(':id_tax', $lastInsertId);
                $stmt_tp->bindParam(':id_product_type', $id_product_type);
                if (!$stmt_tp->execute()) {
                    throw new \Exception("Erro ao cadastrar imposto de tipo de produto");
                }
            }
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $data['value'] = str_replace(',', '.', $data['value']);

            $this->db->beginTransaction();
            $stmt = $this->db->prepare("UPDATE taxes SET name = :name, value = :value WHERE id = :id");
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':value', $data['value']);
            $stmt->bindParam(':id', $id);
            if (!$stmt->execute()) {
                throw new \Exception("Erro ao atualizar imposto");
            }

            $stmt = $this->db->prepare("SELECT * FROM tax_product WHERE id_tax = :id_tax");
            $stmt->bindParam(':id_tax', $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $result = $stmt->fetchAll();
                foreach ($result as $row) {
                    $existInArray = in_array($row['id_product_type'], $data['product_type']);
                    if (!$existInArray) {
                        $stmt = $this->db->prepare('DELETE FROM tax_product WHERE id_product_type = :id_product_type AND id_tax = :id_tax');
                        $stmt->bindParam(':id_product_type', $row['id_product_type']);
                        $stmt->bindParam(':id_tax', $id);
                        if (!$stmt->execute()) {
                            throw new \Exception("Erro ao deletar vínculo de imposto com tipo de produto");
                        }
                    } else {
                        if (($key = array_search($row['id_product_type'], $data['product_type'])) !== false) {
                            unset($data['product_type'][$key]);
                        }
                    }
                }
            }
            foreach ($data['product_type'] as $productType) {
                $id_product_type = intval($productType);
                $stmt_tp = $this->db->prepare("INSERT INTO tax_product (id_tax, id_product_type) VALUES(:id_tax, :id_product_type)");
                $stmt_tp->bindParam(':id_tax', $id);
                $stmt_tp->bindParam(':id_product_type', $id_product_type);
                if (!$stmt_tp->execute()) {
                    throw new \Exception("Erro ao cadastrar imposto de tipo de produto");
                }
            }

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM taxes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            return true;
        }
        return false;
    }

    public function getByProductType(int $id)
    {
        $stmt = $this->db->prepare("SELECT taxes.* FROM taxes INNER JOIN tax_product on taxes.id = tax_product.id_tax WHERE tax_product.id_product_type = :id_product_type");
        $stmt->bindParam(':id_product_type', $id);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() != 0) {
            $taxes = [];
            $result = $stmt->fetchAll();
            foreach ($result as $row) {
                $taxes[] = new Tax($row);
            }
            return $taxes;
        }
        return null;
    }

    public function getByProductTypeIds(array $ids)
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT taxes.* FROM taxes INNER JOIN tax_product on taxes.id = tax_product.id_tax WHERE tax_product.id_product_type IN ($placeholders)");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute($ids);
        $list = $stmt->fetchAll();
        $taxes = [];
        foreach ($list as $index => $tax) {
            $taxes[] = new Tax($tax);
            $productTypes = (new ProductTypeRepository())->findByTax($taxes[$index]->getId());
            $taxes[$index]->setProductTypes($productTypes);
        }
        return $taxes;
    }
}