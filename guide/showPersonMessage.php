<?php
// 个人信息显示：
header("content-type:text/html;charset=utf-8");
include('conn.php');
$user_phone=$_POST["user_phone"];
$sql="SELECT * from user where user_phone='$user_phone'";
$res=$conn->query($sql);
if ($res) {
	$result = mysqli_fetch_assoc($res);
	echo(json_encode($result['user_password']));
}
?>