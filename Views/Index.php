<?php
if (!isset($_COOKIE['JWT'])) {
	header('Location: http://localhost/Views/Login.php');
}
?>