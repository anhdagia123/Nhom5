<?php
class CommentModel extends BaseModel
{
    // Lấy tất cả bình luận của sản phẩm
    public function getByProduct($product_id)
    {
        $sql = "SELECT c.*, u.fullname as username
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.product_id = :product_id 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm bình luận mới
    public function create($data)
    {
        $sql = "INSERT INTO comments (user_id, product_id, content, created_at) 
                VALUES (:user_id, :product_id, :content, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    // Kiểm tra user đã mua sản phẩm chưa
    public function hasPurchased($userId, $productId)
    {
        $sql = "SELECT COUNT(*) FROM order_details od
            JOIN orders o ON od.order_id = o.id
            WHERE o.user_id = :user_id AND od.product_id = :product_id AND o.status = 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
        return $stmt->fetchColumn() > 0;
    }
}