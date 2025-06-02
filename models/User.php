<?php

class User extends BaseModel {
    public function all(){
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function find($id){
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserOfEmail($email){
        $sql = "SELECT * FROM users WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $sql = "INSERT INTO users(fullname, email, password, phone, address) VALUES (:fullname, :email, :password, :phone, :address)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET fullname=:fullname, phone=:phone, address=:address, role=:role, active=:active WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
<<<<<<< HEAD
       

        dd($data);
        $stmt->execute($data);
    }

    //  Cap nhat hoat dong user (Active ) 
    public function updateActive($id, $active) {
        $sql = " UPDATE users SET active=:active WHERE id=:id ";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(['id' => $id, 'active' => $active]);
    }
    
=======
        $stmt->execute($data);
    }
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
}