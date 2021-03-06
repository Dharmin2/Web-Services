<?php
if (!isset($_COOKIE['JWT'])) {
	header('Location: http://localhost/WebClient/Views/Login.php');
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
		<a href = '../Views/Profile.php'>View My Profile</a>
			<a href = '../Views/MyItems.php'>View My Items</a>
			<a href = '../Views/ChangePassword.php'>Change Password</a>
			<a href = '../Views/CreateProduct.php'>Create Product</a><br><br>
			Change Password
			<form action='../../WebService/Controllers/ChangePasswordController.php' method='post'>
				<div class="form-group">
					<label>Old Password:</label><input class='form-control' type='password' name='oldPassword' required/>
				</div>
				<div class="form-group">
					<label>New Password:</label><input class='form-control' type='password' name='password' required/>
				</div>
				<div class="form-group">
					<label>Password confirmation:</label><input class='form-control' type='password' name='password_confirm' required/>
				</div>
				<input type='submit' name='action' value='Confirm' />
			</form>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
	</html>