<?php
setcookie("JWT",$result,time()-6000, "/");
header('Location: http://localhost/WebClient/Views/Login.php');
?>