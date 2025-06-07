<?php
class CommentModelAdmin extends BaseModel
{
    // Lấy tất cả bình luận
    public function all()
    {
        $sql = "SELECT c.*, u.fullname as username, p.name as product_name
                FROM comments c
                JOIN users u ON c.user_id = u.id
                JOIN product p ON c.product_id = p.id
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm bình luận theo id
    public function find($id)
    {
        $sql = "SELECT * FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái bình luận
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE comments SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    // Xóa bình luận
    public function delete($id)
    {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    // Lấy bình luận có phân trang
    public function allWithPaging($limit, $offset)
    {
        $sql = "SELECT c.*, u.fullname as username, p.name as product_name
                FROM comments c
                JOIN users u ON c.user_id = u.id
                JOIN products p ON c.product_id = p.id
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số bình luận
    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM comments";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }
}