<?php

/**
 * @OA\Info(
 *      title="My Api", 
 *      version="0.1",
 *      description="API to interact with products"
 * )
 */
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

    /**
     * @OA\Get(
     *     path="/api/get",
     *     @OA\Response(response="200", description="Retrieves all the products")
     * )
     */
    function get(){
        $query = "SELECT * FROM product";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * @OA\Get(
     *     path="/api/SubtractMoney",
     *     @OA\Response(response="200", description="Retreives specified item")
     * )
     */
    function getOne($id){
        $query = "SELECT * FROM product where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt;
    }

    /**
     * @OA\Get(
     *     path="/api/MyItems",
     *     @OA\Response(response="200", description="Retrieves all the products from a specified user")
     * )
     */
    function getMyItems($userId){
        $query = "SELECT * FROM product where userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['userId'=>$userId]);
        return $stmt;
    }

    /**
     * @OA\Post(
     *     path="/api/Create",
     *     @OA\Response(response="200", description="Inserts the product into the database and uploads image to cdn")
     * )
     */
    function create(){
        $query = "INSERT INTO product SET name=:name, price=:price, description=:description, image=:image, userId =:userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$this->name,'price'=>$this->price,'description'=>$this->description,'image'=>$this->image,'userId'=>$this->userId]);
    } 

    /**
     * @OA\Delete(
     *     path="/api/get",
     *     @OA\Response(response="200", description="Deletes a specified product")
     * )
     */
    function delete($id){
        $query = "DELETE from product where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
    }

    /**
     * @OA\Put(
     *     path="/api/get",
     *     @OA\Response(response="200", description="Update a product with new data")
     * )
     */
    function update($id){
        $query = "UPDATE product SET name=:name, price=:price, description=:description, image =:image where id=:id";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(['name'=>$this->name,'price'=>$this->price,'description'=>$this->description,'image'=>$this->image,'id'=>$id]);
    }
}
?>