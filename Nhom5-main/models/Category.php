<?php 
// thao tac voi bang categories
class Category extends BaseModel {
    // Lay ra toan bo  du lieu categories
    public function all(){
        $sql = "SELECT *FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Phuong thuc create 
    public function create($data) {
        $sql = "INSERT INTO categories(cate_name) VALUES(:cate_name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
    // Phuong thuc update @id:ma danh muc , @data: mang du lieu
    public function update($id, $data){
        $sql = "UPDATE categories SET cate_name=:cate_name WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        // them id va data
        $data['id'] =$id;
        $stmt->execute($data);
    }
    // phuong thuc tim danh muc theo id
    public function find($id){
        $sql ="SELECT FROM categories WHERE id=:id";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(['id'=> $id]);
         return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // phuong thuc delete
    public function delete($id){
        $sql ="DELETE FROM categories WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
         $stmt->execute(['id'=> $id]);
    }

}