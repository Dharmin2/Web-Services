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

    function create(){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user SET name=:name, password_hash=:password_hash, email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$this->name,'password_hash'=>$this->password_hash,'email'=>$this->email]);
    } 

    function delete($id){
        $query = "DELETE from user where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
    }

    function update($id){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET password_hash=:password_hash where id=:id";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(['password_hash'=>$this->password_hash,'id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>