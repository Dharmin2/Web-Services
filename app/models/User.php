<?php
namespace app\models;

class User extends \app\core\Model{
	public $user_id;
	public $username;
	public $email;
	public $password_hash;
	public $password;

	public function __construct(){
		parent::__construct();
	}

	public function get($username){
		$SQL = 'SELECT * FROM user WHERE username LIKE :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\User');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO user(username, email, password_hash) VALUES (:username,:email,:password_hash)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$this->username,'email'=>$this->email,'password_hash'=>$this->password_hash]);
	}

	public function insertRequest($user_id,$video,$newVideo) {
		$SQL = 'INSERT INTO video VALUES (Default,:user_id,:video,:newVideo,Default,Default)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id,'video'=>$video,'newVideo'=>$newVideo]);
	}

	public function completeRequest($newVideo){//update an user record
		$SQL = 'UPDATE video set completeTime = CURRENT_TIMESTAMP where newVideo = :newVideo';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['newVideo'=>$newVideo]);//associative array with key => value pairs
	}

}