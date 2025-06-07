<?php 
// Model Product: Làm việc với bảng products
class Product extends BaseModel {
    // Lấy toàn bộ sản phẩm kèm tên danh mục
    public function all() {
        $sql = "SELECT p.*, c.cate_name 
                FROM product p 
                JOIN categories c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm thuộc một danh mục cụ thể
    public function listProductInCategory($id) {
        $sql = "SELECT p.*, c.cate_name 
                FROM product p 
                JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     // models/Product.php
    public function getAll() {
    $sql = "SELECT p.*, c.cate_name as category_name
            FROM product p
            JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



       public function searchByName($keyword) {
            $sql = "SELECT * FROM product WHERE name LIKE :keyword";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['keyword' => '%' . $keyword . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    //  Lay du lieu cho trang chu 
    public function listProductInCategoryHome($id) {
         $sql = "SELECT p.*, c.cate_name 
                FROM product p 
                JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :id ORDER BY id  LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    // sản phẩm liên quan
    public function listProductRelead($category_id,$id){
         $sql = "SELECT p.*, c.cate_name 
                FROM product p 
                JOIN categories c ON p.category_id = c.id 
                WHERE c.id =:category_id AND p.id <> :id ORDER BY id  LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id,'category_id'=> $category_id] );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm
    public function create($data) {
        $sql = "INSERT INTO product (name, image, price, quantity, description, content, status, category_id)
                VALUES (:name, :image, :price, :quantity, :description, :content, :status, :category_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Cập nhật sản phẩm
    public function update($id, $data) {
        $sql = "UPDATE product 
                SET name = :name, image = :image, price = :price,
                    quantity=:quantity, description = :description, content = :content, 
                    status = :status, category_id = :category_id 
                WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Xoá sản phẩm
    public function delete($id) {
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Lấy một sản phẩm theo ID
    public function find($id) {
        $sql = "SELECT p.*, c.cate_name 
                FROM product p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public function getOne($id)
    {
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateQuantity($id, $new_quantity)
    {
        $sql = "UPDATE product SET quantity = :quantity WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'quantity' => $new_quantity,
            'id' => $id
        ]);
    }

}
