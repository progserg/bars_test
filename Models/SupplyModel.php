<?php

namespace App\Models;

class SupplyModel extends BaseModel
{
    public function getAll()
    {
        $query = "SELECT * FROM get_supplies ";
        $query = $this->db->query($query);
        return $query->fetchAll(\PDO::FETCH_CLASS);
    }

    public function search(int $productId, int $providerId, $dateStart, $dateEnd, string $customer)
    {
        $query = $this->db->prepare('call search_supply(:prod_id, :prov_id, :supply_date_start, :supply_date_end, :supply_customer)');
        $query->bindParam(':prod_id', $productId, \PDO::PARAM_INT);
        $query->bindParam(':prov_id', $providerId, \PDO::PARAM_INT);
        $query->bindParam(':supply_date_start', $dateStart);
        $query->bindParam(':supply_date_end', $dateEnd);
        $query->bindParam(':supply_customer', $customer);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS);
    }

    public function save(int $supplyId, int $providerId, int $productId, int $quantity, string $customer): bool
    {
        $query = $this->db->prepare('call update_supply(?, ?, ?, ?, ?)');
        $query->bindParam(1, $supplyId);
        $query->bindParam(2, $providerId);
        $query->bindParam(3, $productId);
        $query->bindParam(4, $quantity);
        $query->bindParam(5, $customer);
        return $query->execute();
    }

    public function delete(int $supplyId): bool
    {
        $query = $this->db->prepare('call delete_supply(?)');
        $query->bindParam(1, $supplyId);
        return $query->execute();
    }

    public function add(int $providerId, int $productId, int $quantity, string $customer)
    {
        $query = $this->db->prepare('call add_supply(?, ?, ?, ?, @last_insert_id)');
        $query->bindParam(1, $providerId);
        $query->bindParam(2, $productId);
        $query->bindParam(3, $quantity);
        $query->bindParam(4, $customer);
        $query->execute();
        $id = (int)$query = $this->db->query('select @last_insert_id as last_insert_id')->fetch(\PDO::FETCH_COLUMN);
        $query = $this->db->prepare('call get_supply_by_id(:id)');
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS);
    }
}