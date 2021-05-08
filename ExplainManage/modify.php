<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';

$time=date("Y-m-d H:i:s");
$newcom=$_POST["newcomment"];
$oldcid=$_POST["oldcid"];
$cid=$_POST["cid"];
$cgrade=$_POST["cgrade"];
$uid=$_POST["uid"];

$sql="UPDATE comment SET com_id='$cid',com_grade='$cgrade',user_id='$uid',com_info='$newcom',com_time='$time' WHERE com_id='$oldcid'";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("修改完成");location="explain.php"</script>';
} else {
    echo '<script>alert("修改失败");location="explain.php"</script>';
}

?>