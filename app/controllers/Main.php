<?php
namespace app\controllers;

class Main extends \app\core\Controller{
	// Use: /Default/makeQRCode?data=protocol://address

	public function index(){
		$this->view('Main/index');
	}

// 	public function register(){
// 		if (isset($_POST['email'])) {
// 			if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === false) {
// 				echo '<script>alert("Invalid Format")</script>';
// 				$this->view('Main/register');
// 			}
// 			else {
// 				// Don't waste the API
// 				$ch = curl_init();
// 				$url = "https://emailvalidation.abstractapi.com/v1/?api_key=52fe1a3852154953a1cb643399405f15&email=".$_POST["email"];
// // Set the URL that you want to GET by using the CURLOPT_URL option.
// 				curl_setopt($ch, CURLOPT_URL, $url);

// // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
// 				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
// 				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// // Execute the request.
// 				$data = curl_exec($ch);

// // Close the cURL handle.
// 				curl_close($ch);
// 				$getEmail = json_decode($data, true);
// // Print the data out onto the page.
// 				var_dump($getEmail);
// 				echo "Email is valid";
// 				// Insert user into database if the email is valid
// 				if ($getEmail['deliverability'] === "DELIVERABLE") {
// 					echo "Email is Deliverable";
// 					// Insert user into the database
// 					$user = new \app\models\User();
// 					$user->email = $_POST['email'];
// 					$user->username = $_POST['username'];
// 					$user->password = $_POST['password'];
// 					$user->insert();
// 				}
// 				$this->view('Main/register');
// 			}
// 		}
// 		else {
// 			$this->view('Main/register');
// 		}
// }

public function login(){
		//TODO: register session variables to stay logged in
		if(isset($_POST['action'])){//verify that the user clicked the submit button
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);

			if(password_verify($_POST['password'], $user->password_hash)){
				$jwt = new \app\models\JWT();
				$json = "{\"username\": \"{$_POST['username']}\", \"password\": \"{$_POST['password']}\"}";
				$data = json_decode($json, true);
				//var_dump($data);
				$token = $jwt->generate($data);
				setcookie("JWT",$token,time()+6000);
				//$data = (array) json_decode($json, true);
				// $_SESSION['user_id'] = $user->user_id;
				// $_SESSION['username'] = $user->username;
				header('location:'.BASE.'Main/index');
			}else{
				$this->view('Main/login','Wrong username and password combination!');
			}

		}else //1 present a form to the user
		$this->view('Main/login');
	}

	// public function upload() {
	// 	$user = new \app\models\User();
	// 	if (isset($_POST['action'])) {
	// 		$video = $_FILES["video"]["tmp_name"];
	// 		$name = date("Ymd").time();
	// 		$user->insertRequest($_SESSION['user_id'],$_FILES["video"]["name"],$name.'.avi');
	// 		$command = "ffmpeg -i $video $name.avi";
	// 		system($command);
	// 		$user->completeRequest($name.'.avi');
	// 		echo '<script>alert("File has been converted")</script>';
	// 		$this->view('Main/index');
	// 	}
	// 	else {
	// 		$this->view('Main/upload');
	// 	}
	// }

	public function logout(){
		setcookie("JWT", "", time()-6000);
		header('location:/Main/login');
	}

}