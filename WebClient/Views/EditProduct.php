<?php
if (!isset($_COOKIE['JWT'])) {
	header('Location: http://localhost/Views/Login.php');
}
?>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head><body>
	<div class="container">
		<a href = '../Views/Index.php'>Home</a>
		<a href = '../Views/AddFunds.php'>Add Funds</a>
		<a href = '../Views/Profile.php'>View My Profile
			<a href = '../Views/MyItems.php'>View My Items</a>
			<a href = '../Views/ChangePassword.php'>Change Password</a><br><br>
			<a href = '../Views/CreateProduct.php'>Create Product</a><br>
			<a href = '../../WebService/Controllers/LogoutController.php'>Logout</a><br>
			Edit a Product
			<form action='../../WebService/Controllers/EditProductController.php' method='post' enctype="multipart/form-data">
				<div class="form-group">
					<label>Name:</label><input class='form-control' type='text' name='name' required/>
				</div>
				<div class="form-group">
					<label>Price:</label><input class='form-control' type='text' name='price' required/>
				</div>
				<div class="form-group">
					<label>Description:</label><input class='form-control' type='text' name='description' required/>
				</div>
				<div class="form-group">
					<label>Image:</label><input class='form-control' type='file' name='image' required accept="image/*"/>
				</div>
				<div class="form-group">
					<label>Product Id:</label><input value="<?php echo $_GET['id']?>" class='form-control' type='text' name='id' readonly/>
				</div>
				<input type='submit' name='action' value='Create' />
			</form>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
	</html>