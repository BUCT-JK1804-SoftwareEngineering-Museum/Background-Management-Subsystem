<?php
//修改密码

header("content-type:text/html;charset=utf-8");

include('conn.php');
$user_phone= $_POST['user_phone'];
$old_password=$_POST['old_password'];
$user_password=$_POST['user_password'];
$sql1="SELECT user_password from user where user_phone='$user_phone'";
$res1=$conn->query($sql1);
if ($res1) {
	$num=mysqli_fetch_assoc($res1);
	if ($old_password==$num['user_password']) {
		$sql="UPDATE user set user_password='$user_password' where user_phone='$user_phone'";
		$res=$conn->query($sql);
		if ($res) {
			$flag="1";
			echo(json_encode($flag));
		}else{
			$flag="0";
			echo(json_encode($flag));
		}
	}
	else{
		$flag="0";
			echo(json_encode($flag));
	}
}else{
	$flag="0";
	echo(json_encode($flag));
}





?>