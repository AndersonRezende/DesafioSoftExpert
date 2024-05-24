<?php

namespace DesafioSoftExpert\Repositories;

use DesafioSoftExpert\Core\Database;
use DesafioSoftExpert\Models\Product;
use DesafioSoftExpert\Models\ProductSale;
use DesafioSoftExpert\Models\Sale;
use Exception;
use PDO;
use PDOException;

class SaleRepository implements Repository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM sales");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $list = $stmt->fetchAll();
        $sales = [];
        foreach ($list as $index => $sale) {
            $sales[] = new Sale($sale);
            //$productType = (new ProductTypeRepository())->find($product['id_product_type']);
            //$sales[$index]->setProductType($productType);
        }
        return $sales;
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM sales WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != false) {
            $sale = new Sale($result);
            $stmt = $this->db->prepare("SELECT * FROM product_sale WHERE id_sale = :id");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $list = $stmt->fetchAll();
            $productSales = [];
            foreach ($list as $index => $productSale) {
                $productSales[$index] = new ProductSale($productSale);
                $productSales[$index]->setProduct((new ProductRepository())->find($productSale['id_product']));
            }
            $sale->setProductsSale($productSales);
            return $sale;
        }
        return false;
    }

    public function create(array $data)
    {
    }

    public function update(int $id, array $data)
    {
    }

    public function delete(int $id)
    {
    }

    public function adjustRequestData($data)
    {
        return array_filter($data, function($quantity) {
            return $quantity !== '0';
        });
    }

    public function createWithChildren(Sale $sale, array $productsSale)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO sales (total_base_value, total_tax_value, total_value_with_tax, items_count, products_count, finished) VALUES (:total_base_value, :total_tax_value, :total_value_with_tax, :items_count, :products_count, :finished)");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindValue(':total_base_value', $sale->getTotalBaseValue());
            $stmt->bindValue(':total_tax_value', $sale->getTotalTaxValue());
            $stmt->bindValue(':total_value_with_tax', $sale->getTotalValueWithTax());
            $stmt->bindValue(':items_count', $sale->getItemsCount());
            $stmt->bindValue(':products_count', $sale->getProductsCount());
            $stmt->bindValue(':finished', $sale->getFinished());
            if (!$stmt->execute()) {
                throw new \Exception("Erro ao cadastrar venda");
            }
            $lastInsertId = $this->db->lastInsertId();
            foreach ($productsSale as $productSale) {
                $stmt = $this->db->prepare("INSERT INTO product_sale (id_sale, id_product, quantity, product_price, product_price_with_tax) VALUES (:id_sale, :id_product, :quantity, :product_price, :product_price_with_tax)");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindValue(':id_sale', $lastInsertId);
                $stmt->bindValue(':id_product', $productSale->getIdProduct());
                $stmt->bindValue(':quantity', $productSale->getQuantity());
                $stmt->bindValue(':product_price', $productSale->getProductPrice());
                $stmt->bindValue(':product_price_with_tax', $productSale->getProductPriceWithTax());
                if (!$stmt->execute()) {
                    throw new \Exception("Erro ao cadastrar itens da venda");
                }
            }
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            return $e->getMessage();
        }
        return true;
    }
}