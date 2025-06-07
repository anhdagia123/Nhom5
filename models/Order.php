<?php

class Order extends BaseModel {
    // Lấy tất cả đơn hàng (admin)
    public function all() {
        $sql = "SELECT o.*, u.fullname, u.email, u.address, u.phone 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy đơn hàng theo user (cho khách)
    public function getByUser($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin 1 đơn hàng (admin hoặc khách)
    public function find($id) {
        $sql = "SELECT o.*, u.fullname, u.email, u.address, u.phone 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo đơn hàng mới
    public function create($data) {
        $sql = "INSERT INTO orders (user_id, total_price, status, payment_method) 
                VALUES (:user_id, :total_price, :status, :payment_method)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    // Cập nhật trạng thái đơn hàng
    public function update($id, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    // Thêm chi tiết đơn hàng
    public function createOrderDetail($data) {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Lấy chi tiết đơn hàng (dùng cho trang chi tiết đơn hàng)
    public function getOrderDetails($order_id) {
        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od 
                JOIN product p ON od.product_id = p.id 
                WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}