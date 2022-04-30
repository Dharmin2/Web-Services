<?php
class Product{

    private $conn;
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;

    public function __construct($db){
        $this->conn = $db;
    }

    function get(){
        $query = "SELECT * FROM product";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO product SET name=:name, price=:price, description=:description, image=:image";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$this->name,'price'=>$this->price,'description'=>$this->description,'image'=>$this->image]);
    } 

    function delete($name){
        $query = "DELETE from product where name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$name]);
    }

    function update($id){
        $query = "UPDATE product SET name=:name, price=:price, description=:description where id=:id";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(['name'=>$this->name,'price'=>$this->price,'description'=>$this->description,'image'=>$this->image,'id'=>$id]);
    }
}
?>