<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';

$cid=$_POST["cid"];
$cname=$_POST["cname"];
$mname=$_POST["mname"];
$cera=$_POST["cera"];
$cinfo=$_POST["cinfo"];
$curl=$_POST["curl"];

$sql="SELECT mus_id FROM museum WHERE mus_name='$mname'";
$res=$conn->query($sql);
$midarr=mysqli_fetch_array($res);
$mid=$midarr["mus_id"];

$sql="INSERT INTO collection(col_id,mus_id,col_name,col_era,col_info,mus_name,col_picture) 
      VALUES ('$cid','$mid','$cname','$cera','$cinfo','$mname','$curl')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("添加完成");location="collection.php"</script>';
} else {
    echo '<script>alert("添加失败");location="collection.php"</script>';
}

?>