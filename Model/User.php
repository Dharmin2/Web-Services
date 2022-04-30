<?php
class User {

    private $conn;
    public $id;
    public $name;
    public $password;
    public $email;
    public $password_hash;

    public function __construct($db){
        $this->conn = $db;
    }

    function get(){
        $query = "SELECT * FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getOne($name){
        $query = "SELECT * FROM user where name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$name]);
        return $stmt;
    }

    function create(){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user SET name=:name, password_hash=:password_hash, email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$this->name,'password_hash'=>$this->password_hash,'email'=>$this->email]);
    } 

    function delete($name){
        $query = "DELETE from user where name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$name]);
    }

    function update($name){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET password_hash=:password_hash where name=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(['password_hash'=>$this->password_hash,'name'=>$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function addMoney($funds, $name){
        $query = "UPDATE user SET funds = funds + :funds where name=:name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['funds'=>$funds,'name'=>$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function subtractMoney($funds, $name){
        $query = "UPDATE user SET funds = funds - :funds where name=:name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['funds'=>$funds,'name'=>$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>