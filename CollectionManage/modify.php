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
$filePath="$RootDir/operatorManage/$fileName";
if (!file_exists($filePath)) {
    $myfile=fopen("$filePath", "w");
}
$max_size = 500000;
 error_reporting(0);//关闭所有的错误信息，不会显示，如果清除掉，会将错误的日志写入到log中
ini_set('log_errors','on');
error_log('示例的错误信息');

$cid=$_POST["cid"];
$oldcid=$_POST["oldcid"];
$cname=$_POST["cname"];
$cera=$_POST["cera"];
$collection=$_POST["newcol_info"];
$curl=$_POST["curl"];

$sql="UPDATE Collection SET col_id='$cid',col_name='$cname',col_era='$cera',col_info='$collection',col_picture='$curl' WHERE col_id='$oldcid'";

if ($conn->query($sql) === TRUE) {
	ini_set('error_log',"$filePath");
    error_log($username." 修改藏品"." ip地址:".$_SERVER['REMOTE_ADDR']."修改藏品:".$cname." ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改完成");location="collection.php"</script>';
} else {
	ini_set('error_log',"$filePath");
    error_log($username." 修改藏品"." ip地址:".$_SERVER['REMOTE_ADDR']."修改藏品:".$cname."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改失败");location="collection.php"</script>';
}

?>