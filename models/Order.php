<?php

class Oder extends BaseModel {
    public function all() {
        $sql = "SELECT o.*, u.fullname, u.email, u.address, u.phone 
                FROM oders o 
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $sql = "SELECT o.*, u.fullname, u.email, u.address, u.phone 
                FROM oders o 
                JOIN users u ON o.user_id = u.id 
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO oders (user_id, total_price, status, payment_method) 
                VALUES (:user_id, :total_price, :status, :payment_method)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    public function update($id, $status) {
        $sql = "UPDATE oders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function createOderDetail($data) {
        $sql = "INSERT INTO oder_details (oder_id, product_id, quantity, price) 
                VALUES (:oder_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}
