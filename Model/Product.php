<?php
class Product{

    private $conn;
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $userId;

    public function __construct($db){
        $this->conn = $db;
    }

    function get(){
        $query = "SELECT * FROM product";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getOne($id){
        $query = "SELECT * FROM product where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt;
    }

    function getMyItems($userId){
        $query = "SELECT * FROM product where userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['userId'=>$userId]);
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO product SET name=:name, price=:price, description=:description, image=:image, userId =:userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$this->name,'price'=>$this->price,'description'=>$this->description,'image'=>$this->image,'userId'=>$this->userId]);
    } 

    function delete($id){
        $query = "DELETE from product where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
    }

    function update($id){
        $query = "UPDATE product SET name=:name, price=:price, description=:description, image =:image where id=:id";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(['name'=>$this->name,'price'=>$this->price,'description'=>$this->description,'image'=>$this->image,'id'=>$id]);
    }
}
?>