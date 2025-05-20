<?php 
// Model Product: Lam viec voi mang Product
class Product extends BaseModel {
    // lay toan bo du lieu 
    public function all(){
        $sql = "SELECT *FROM products p.*, cate_name JOIN categories c ON p.category_id=c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // lay san pham danh muc
     public function listProductInCategory($id){
        $sql = "SELECT *FROM products p.*, cate_name JOIN categories c ON p.category_id=c.id WHERE c.id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // them du lieu 
    public function create($data) {
        $sql = "INSERT INTO
         products(name, image, price, description, content, status, category_id)
          VALUE(:name, :image, :price, :description, :content, :status, :category_id)";
          $stmt= $this->conn->prepare($sql);
          $stmt->execute($data);
    }
    // cap nhat du lieu
    public function update($id,$data){
        $sql= "UPDATE products SET name=:name, image=:image, price=:price, description=:description,
         content=:content, status=:status, category_id=:category_id WHERE id=:id";
         $stmt = $this->conn->prepare($sql);
        //  them id vao mang id
        $data['id']=$id;
         $stmt->execute($data);
    }
    // xoa du lieu
    public function delete($id){
        $sql = "DELETE FROM products WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
          $stmt->execute(['id' =>$id]);
    }
    // lay 1 san pham theo id 
    public function find($id) {
        $sql = "SELECT *FROM products p.*, cate_name JOIN categories c ON p.category_id=c.id WHERE p.id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' =>$id]);
    }
}