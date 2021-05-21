<?php
// 修改个人信息
header("content-type:text/html;charset=utf-8");

include('conn.php');

$user_phone=$_POST["user_phone"];
$user_pic=$_POST["user_pic"];//用户上传图片是直接复制链接吗？
$user_name=$_POST["user_name"];
$user_gender=$_POST["user_gender"];
$user_site=$_POST["user_site"];

$sql1="SELECT * from user where user_name='$user_name'";
$res1=$conn->query($sql1);
$num=mysqli_num_rows($res1);
if ($num) {
	$wrongMsg="用户名已经存在";
	$flag="0";
	echo(json_encode($flag));
}else{
	$sql="UPDATE user set user_name='$user_name',user_pic='$user_pic',user_name='$user_name',user_gender='$user_gender',user_site='$user_site' where user_phone='$user_phone'";
	$res=$conn->query($sql);
	if ($res) {
		$flag="1";
		echo(json_encode($flag));
	}
}


?>