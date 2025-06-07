<?php
class Category extends BaseModel
{
    // Lấy toàn bộ danh mục
    public function all()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm mới danh mục
    public function create($data)
    {
        $sql = "INSERT INTO categories(cate_name) VALUES(:cate_name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Cập nhật danh mục
    public function update($id, $data)
    {
        $sql = "UPDATE categories SET cate_name = :cate_name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    // Tìm danh mục theo id
    public function find($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa danh mục
    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
    public function paginate($limit, $offset)
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) as total FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
