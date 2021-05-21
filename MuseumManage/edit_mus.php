<?php

session_start();
require '../dadb.php';
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}else{
 	$user_name=$_SESSION["username"];
	//var_dump($user_name);
   	$sql="select *from User where user_name='$user_name'";
  	$res=$conn->query($sql);
  	if ($res) {
  		$row=$res->fetch_assoc();
	  	$user_phone=$row["user_phone"];
	  	$user_pic=$row["user_pic"];
	  	$user_gender=$row["user_gender"];
	  	$user_site=$row["user_site"];
	  	$user_level=$row["user_level"];
  	}
 }
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

$mus_id = (int)$_POST["mus_id"];
$mus_name = (string) $_POST["mus_name"];
$mus_picture = (string) $_POST["mus_picture"];
$mus_grade = (double)$_POST["mus_grade"];
$mus_time = (string)$_POST["mus_time"];
$mus_address = (string)$_POST["mus_address"];
$mus_remark = (string)$_POST["mus_remark"];
$mus_phone = (string)$_POST["mus_phone"];
$mus_master = (string)$_POST["mus_master"];

if(!$conn){
    $GLOBALS['msg'] = '连接数据库失败';
    return;
}

$query = mysqli_query($conn,"UPDATE Museum SET mus_id='{$mus_id}',mus_name='{$mus_name}',mus_picture='{$mus_picture}',mus_grade='{$mus_grade}',mus_time='{$mus_time}',mus_address='{$mus_address}',mus_remark='{$mus_remark}',mus_phone='{$mus_phone}',mus_master='{$mus_master}' 
WHERE mus_id={$mus_id}");
if (!$query) {
	ini_set('error_log',"$filePath");
    error_log($username." 修改博物馆信息"." ip地址:".$_SERVER['REMOTE_ADDR']."修改博物馆:".$mus_name."失败 ".date("Y-m-d H:i:s"));
    exit('<h1>查询过程失败</h1>');
}else{
	ini_set('error_log',"$filePath");
    error_log($username." 修改博物馆信息"." ip地址:".$_SERVER['REMOTE_ADDR']."修改博物馆:".$mus_name."成功 ".date("Y-m-d H:i:s"));
}

header('Location:museum.php');
?>
