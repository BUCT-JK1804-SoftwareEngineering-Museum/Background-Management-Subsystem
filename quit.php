<?php
session_start();
header("location:Login/Login.php");
setcookie("username","",time()-3600);
session_destroy();
?>
