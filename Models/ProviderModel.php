<?php

namespace App\Models;

class ProviderModel extends BaseModel
{
    public function getAll()
    {
        $query = "SELECT * FROM get_providers ";
        $query = $this->db->query($query);
        return $query->fetchAll(\PDO::FETCH_CLASS);
    }

    public function getAllWithProducts()
    {
        $query = "SELECT * FROM get_providers_with_products ";
        $query = $this->db->query($query);
        $result = $query->fetchAll(\PDO::FETCH_CLASS);
        unset($query);
        foreach ($result as $key => $item) {
            $result[$key]->product_ids = explode(',', $item->product_ids);
        }
        return $result;
    }

    public function updateProviderProducts(int $providerId, array $ids)
    {
        $values = '';
        foreach ($ids as $id) {
            $values .= '(' . $providerId . ', ' . $id . '), ';
        }
        $values = substr($values, 0, -2);
        $query = $this->db->prepare('call update_provider_products(?, ?)');
        $query->bindParam(1, $providerId);
        $query->bindParam(2, $values);
        $result = $query->execute();
        return $values ? $result : true;
    }
}