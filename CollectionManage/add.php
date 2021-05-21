<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';

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
	ini_set('error_log',"$filePath");
    error_log($username." 添加藏品"." ip地址:".$_SERVER['REMOTE_ADDR']."添加藏品:".$mname." ".date("Y-m-d H:i:s"));
    echo '<script>alert("添加完成");location="collection.php"</script>';
} else {
	ini_set('error_log',"$filePath");
    error_log($username." 添加藏品"." ip地址:".$_SERVER['REMOTE_ADDR']."添加藏品:".$mname."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("添加失败");location="collection.php"</script>';
}

?>