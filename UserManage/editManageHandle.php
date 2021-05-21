<?php
session_start();
if (empty($_SESSION["username"])) {
	header("Location: ../Login/Login.php");
  exit;
 }
require'../dadb.php';
// 操作日志
$username=$_SESSION["username"];
header("Content-type: text/html; charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai'); 
$chinatime = date('Y-m-d H:i:s');
$fileName=date("Ymd").".log";
$RootDir = $_SERVER['DOCUMENT_ROOT']; 
$filePath="$RootDir/jk-museum/operatorManage/".$fileName;
if (!file_exists($filePath)) {
    $myfile=fopen("$filePath", "w");
}
$max_size = 500000;
 error_reporting(0);//关闭所有的错误信息，不会显示，如果清除掉，会将错误的日志写入到log中
ini_set('log_errors','on');
error_log('示例的错误信息');

$user_name=$_POST["user_name"];
$user_password=$_POST["user_password"];
$user_phone=$_POST["user_phone"];
$user_gender=$_POST["user_gender"];
$user_site=$_POST["user_site"];
$user_level=$_POST["user_level"];
$user_pallow=$_POST["user_pallow"];
// var_dump($user_pallow);
if (empty($user_name)||empty($user_password)) {
	echo '<script>alert("用户名和密码不能为空！");history.go(-1);</script>';
	exit();
}
$user_pattern='/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]+$|^[a-zA-Z0-9\x{4e00}-\x{9fa5}][a-zA-Z0-9_\s\ \x{4e00}-\x{9fa5}\.]*[a-zA-Z0-9\x{4e00}-\x{9fa5}]+$/u';
$pwd_pattern='/^\w{8,16}$/S';
// 电话号码正则表达式（支持手机号码，3-4位区号，7-8位直播号码，1－4位分机号）:
$phone_pattern='/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/';
$flag=1;
if (!preg_match($user_pattern,$user_name)) {
	echo '<script>alert("用户名格式不匹配！");history.go(-1);</script>';
	exit();
	$flag=0;
}
if (!preg_match($pwd_pattern,$user_password)) {
	echo '<script>alert("密码格式不匹配！");history.go(-1);</script>';
	exit();
	$flag=0;
}
if (!preg_match($phone_pattern,$user_phone)) {
	echo '<script>alert("请输入正确的手机号码！");history.go(-1);</script>';
	$flag=0;
}

if (!empty($_FILES["user_pic"]["name"])) {
	$isEditPic=1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["user_pic"]["name"]);
	$extension = end($temp); // 获取文件后缀名
	$RootDir = $_SERVER['DOCUMENT_ROOT']; 
	$uploaddir="$RootDir/jk-museum/UserManage/images/";
	function GetRandStr($length) {
	        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	        $len = strlen($str) - 1;
	        $randstr = '';
	        for ($i = 0; $i < $length; $i++) {
	            $num = mt_rand(0, $len);
	            $randstr .= $str[$num];
	        }
	        return $randstr;
	    }
	$_FILES["user_pic"]["new_name"]=GetRandStr(8).".$extension";
	$uploadfile=$uploaddir.$_FILES["user_pic"]["new_name"];
	$user_pic=$_FILES["user_pic"]["new_name"];
	$a = GetRandStr(8);
}else{
	$isEditPic=0;
}


if ($flag==1) {
	$sql = "SELECT * FROM `User` where user_name='$user_name'";
	$res=$conn->query($sql);//执行某个针对数据库的查询
	$num=mysqli_num_rows($res);//返回结果集中行的数量。
	$old=mysqli_fetch_array($res);
	//var_dump($old);
	if ($old&&$isEditPic) {//存在该用户并且修改头像,如果有就删除原来的头像
		if (file_exists($uploaddir.$old['user_pic'])) {
			$delPhoRes=unlink($uploaddir.$old['user_pic']);
			//echo "删除";
		}
	}else{
		$user_pic=$old['user_pic'];
	}
	if ($num) {//存在该用户
		if ($isEditPic) {
			if(in_array($extension, $allowedExts))//上传新头像
			{
			    if ($_FILES["user_pic"]["error"] > 0)
			    {
			        echo "错误： " . $_FILES["user_pic"]["error"] . "<br>";
			    }
			    else
			    {    
			        // 判断当前目录下的 upload 目录是否存在该文件
			        while (file_exists($uploadfile))
			        {
			           $_FILES["user_pic"]["new_name"]=GetRandStr(8).".$extension";
			        }
			        if (is_uploaded_file($_FILES['user_pic']['tmp_name'])) {
			        	$upres=move_uploaded_file($_FILES["user_pic"]["tmp_name"],$uploadfile);
			            if ($upres) {
			            	 //var_dump($uploadfile);
			            }else{

			            }
			            //var_dump($_FILES["user_pic"]["new_name"]);
			        }else{
			        	echo '<script>alert("非法的文件来源");</script>';
			    		exit();
			        }
			    }
			}
			else
			{
			    echo '<script>alert("非法的文件格式");</script>';
			    exit();
			}
		}
		$sql="UPDATE User set user_name='$user_name',user_password='$user_password',user_phone='$user_phone',user_pic='$user_pic',user_gender='$user_gender',user_site='$user_site',user_level='$user_level',user_pallow='$user_pallow' where user_name='$user_name'";
		$res=$conn->query($sql);
		if ($res) {
			ini_set('error_log',"$filePath");
            error_log($username." 修改管理员信息"." ip地址:".$_SERVER['REMOTE_ADDR']."修改用户:".$user_name."成功 ".date("Y-m-d H:i:s"));
			 echo '<script>alert("修改成功！");window.location="user.php"</script>';
		}else{
			ini_set('error_log',"$filePath");
            error_log($username." 修改管理员信息"." ip地址:".$_SERVER['REMOTE_ADDR']."修改用户:".$user_name."失败 ".date("Y-m-d H:i:s"));
			echo '<script>alert("修改失败");history.go(-1);</script>';
		}
	}else{
		ini_set('error_log',"$filePath");
            error_log($username." 修改管理员信息"." ip地址:".$_SERVER['REMOTE_ADDR']."修改用户:".$user_name."失败 ".date("Y-m-d H:i:s"));
		echo '<script>alert("修改失败");history.go(-1);</script>';
		exit();
	}
}
?>