<?php

namespace App\Models;

class ProductModel extends BaseModel
{
    public function getAll()
    {
        $query = "SELECT * FROM get_products ";
        $query = $this->db->query($query);
        return $query->fetchAll(\PDO::FETCH_CLASS);
    }

    public function getAllWithProviders()
    {
        $query = "SELECT * FROM get_products_with_providers ";
        $query = $this->db->query($query);
        $result = $query->fetchAll(\PDO::FETCH_CLASS);
        unset($query);
        foreach ($result as $key => $item) {
            $result[$key]->provider_ids = explode(',', $item->provider_ids);
        }
        return $result;
    }

    public function updateProductProviders(int $productId, array $ids)
    {
        $values = '';
        foreach ($ids as $id) {
            $values .= '(' . $id . ', ' . $productId . '), ';
        }
        $values = substr($values, 0, -2);
        $query = $this->db->prepare('call update_product_providers(?, ?)');
        $query->bindParam(1, $productId);
        $query->bindParam(2, $values);
        $result = $query->execute();
        return $values ? $result : true;
    }
}