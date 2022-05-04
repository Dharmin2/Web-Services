<?php

/**
 * @OA\Info(
 *      title="User API", 
 *      version="0.1",
 *      description="API to interact with users"
 * )
 */

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

    /**
     * @OA\Get(
     *     path="/api/Get",
     *     @OA\Response(response="200", description="Retreives all users")
     * )
     */
    function get(){
        $query = "SELECT * FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * @OA\Get(
     *     path="/api/Profile",
     *     @OA\Response(response="200", description="Retrieves specified user")
     * )
     */
    function getOne($name){
        $query = "SELECT * FROM user where name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$name]);
        return $stmt;
    }

    /**
     * @OA\Post(
     *     path="/api/CreateUser",
     *     @OA\Response(response="200", description="Registers a user to the database")
     * )
     */
    function create(){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user SET name=:name, password_hash=:password_hash, email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$this->name,'password_hash'=>$this->password_hash,'email'=>$this->email]);
    } 

    /**
     * @OA\Delete(
     *     path="/api/unused",
     *     @OA\Response(response="200", description="Unused")
     * )
     */
    function delete($name){
        $query = "DELETE from user where name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['name'=>$name]);
    }

    /**
     * @OA\Patch(
     *     path="/api/UpdateUser",
     *     @OA\Response(response="200", description="Changes the password for the user that is logged in")
     * )
     */
    function update($name){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET password_hash=:password_hash where name=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(['password_hash'=>$this->password_hash,'name'=>$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Patch(
     *     path="/api/AddMoney",
     *     @OA\Response(response="200", description="User adds funds to his account")
     * )
     */
    function addMoney($funds, $name){
        $query = "UPDATE user SET funds = funds + :funds where name=:name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['funds'=>$funds,'name'=>$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Patch(
     *     path="/api/SubtractMoney",
     *     @OA\Response(response="200", description="Subtracts money from users account when he makes a purchase")
     * )
     */
    function subtractMoney($funds, $name){
        $query = "UPDATE user SET funds = funds - :funds where name=:name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['funds'=>$funds,'name'=>$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>