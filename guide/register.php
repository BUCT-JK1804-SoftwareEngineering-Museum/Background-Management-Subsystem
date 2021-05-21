<?php
// 注册
header("content-type:text/html;charset=utf-8");
require'../dadb.php';
$user_name=$_POST["user_name"];
$user_password=$_POST["user_password"];
$user_phone=$_POST["user_phone"];
$user_pallow=1;
$user_level=1;
$falg=1;//$falg为1时表示成功，为0失败
if (empty($user_name)||empty($user_password)||empty($user_phone)) {
	$wrongMsg="用户名、密码或手机号为空";
	echo (json_encode());
	exit();
}
// 1.允许输入字符：数字(0-9)、字母(a-z和A-Z)、汉字、下划线(_)、圆点(.)和空格；
//2、姓名中间允许有空格；
//3、下划线、圆点和空格均为英文状态输入法下的字符；
//4、姓名前后不允许输入下划线、圆点、空格和特殊字符
$user_pattern='/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]+$|^[a-zA-Z0-9\x{4e00}-\x{9fa5}][a-zA-Z0-9_\s\ \x{4e00}-\x{9fa5}\.]*[a-zA-Z0-9\x{4e00}-\x{9fa5}]+$/u';
$pwd_pattern='/^\w{8,16}$/S';
// 电话号码正则表达式（支持手机号码，3-4位区号，7-8位直播号码，1－4位分机号）:
$phone_pattern='/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/';
$flag=1;
if (!preg_match($user_pattern,$user_name)) {
	$wrongMsg="用户名格式不匹配！";
	exit();
	$flag=0;
}
if (!preg_match($pwd_pattern,$user_password)) {
	$wrongMsg="密码格式不匹配！";
	exit();
	$flag=0;
}
if (!preg_match($phone_pattern,$user_phone)) {
	$wrongMsg="请输入正确的手机号码！";
	exit();
	$flag=0;
}


if ($flag==1) {
	//var_dump($user_level);
	$user_level=(int)$user_level;
	//var_dump($user_level);
	$sql = "SELECT user_name FROM `user` where user_name='$user_name'";
	$res=$conn->query($sql);//执行某个针对数据库的查询
	$num=mysqli_num_rows($res);//返回结果集中行的数量。
	$sql2 = "SELECT user_name FROM `user` where user_name='$user_name'";
	$res2=$conn->query($sql);//执行某个针对数据库的查询
	$num2=mysqli_num_rows($res);//返回结果集中行的数量。
	if ($num2) {
		$wrongMsg="手机号已存在";
		exit();
	}
	if ($num) {
		$wrongMsg="用户名已存在";
		exit();
		//echo '<script>alert("用户名已存在");history.go(-1);</script>';
	}else{
		$sql="SELECT * FROM `user` order by user_id desc limit 1";
		$res=$conn->query($sql);
		$sqll=mysqli_fetch_array($res);
		$user_id=(int)$sqll["user_id"]+1;
		$sql="INSERT INTO user(user_id, user_name,user_password,user_phone,user_level,user_pallow)VALUES ('$user_id','$user_name','$user_password','$user_phone','$user_level','$user_pallow')";
		$res=$conn->query($sql);
		if ($res) {
			$flag="1";
			echo (json_encode($flag));
			//echo '<script>alert("增添用户成功！");window.location="user.php"</script>';
		}else{
			$flag="0";
			echo (json_encode($flag));
			//echo '<script>alert("增添用户失败");</script>';
		}
	}
}
?>