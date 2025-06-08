<?php
class OrderModel extends BaseModel
{
    // Lấy tất cả đơn hàng

    public function all($limit = 10, $offset = 0)
    {
        $sql = "SELECT 
                o.*, 
                u.fullname AS customer_name, 
                u.email, 
                u.phone, 
                u.address,
                (SELECT SUM(price * quantity) FROM order_details WHERE order_id = o.id) AS total,
                (SELECT GROUP_CONCAT(p.name SEPARATOR ', ')
                    FROM order_details od
                    JOIN product p ON od.product_id = p.id
                    WHERE od.order_id = o.id
                ) AS product_names
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            ORDER BY o.id DESC
            LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số đơn hàng
    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM orders";
        return $this->conn->query($sql)->fetchColumn();
    }

    // Tìm đơn hàng theo id
public function find($id)
{
    $sql = "SELECT 
                o.*, 
                u.fullname AS customer_name, 
                u.email, 
                u.phone, 
                u.address,
                (SELECT SUM(price * quantity) FROM order_details WHERE order_id = o.id) AS total
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            WHERE o.id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // Lấy chi tiết đơn hàng
    public function getOrderDetails($order_id)
    {
        $sql = "SELECT od.*, p.name as product_name, p.image 
                FROM order_details od 
                JOIN product p ON od.product_id = p.id 
                WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }

    // Xóa đơn hàng
    public function delete($id)
    {
        // Xóa chi tiết trước
        $sql1 = "DELETE FROM order_details WHERE order_id = :id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute(['id' => $id]);
        // Xóa đơn hàng
        $sql2 = "DELETE FROM orders WHERE id = :id";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute(['id' => $id]);
    }
}