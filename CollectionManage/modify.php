<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';


$cid=$_POST["cid"];
$oldcid=$_POST["oldcid"];
$cname=$_POST["cname"];
$cera=$_POST["cera"];
$collection=$_POST["newcollection"];
$curl=$_POST["curl"];

$sql="UPDATE collection SET col_id='$cid',col_name='$cname',col_era='$cera',col_info='$collection',col_picture='$curl' WHERE col_id='$oldcid'";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("修改完成");location="collection.php"</script>';
} else {
    echo '<script>alert("修改失败");location="collection.php"</script>';
}

?>