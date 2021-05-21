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

$user_id=$_GET['user_id'];
$sql="SELECT user_name from User where user_id='$user_id'";
$res=$conn->query($sql);
$user=mysqli_fetch_assoc($res);
$user_name=$user['user_name'];
$sql="delete from  User where user_id=$user_id";

$res=$conn->query($sql);
if ($res) {
	ini_set('error_log',"$filePath");
    error_log($username." 删除用户"." ip地址:".$_SERVER['REMOTE_ADDR']."删除用户:".$user_name."成功 ".date("Y-m-d H:i:s"));
	echo '<script>alert("删除成功！");window.location="user.php"</script>';
}else{
	ini_set('error_log',"$filePath");
    error_log($username." 删除用户"." ip地址:".$_SERVER['REMOTE_ADDR']."删除用户:".$user_name."失败 ".date("Y-m-d H:i:s"));
	echo '<script>alert("删除失败！");history.go(-1);</script>';
}
?>