<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';
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

if(empty($_GET['exh_id'])){
    exit('<h1>连接数据库失败</h1>');
}
$exh_id = $_GET['exh_id'];
$query = mysqli_query($conn,"delete from Exhibition where exh_id = {$exh_id}");
if (!$query) {
    exit('<h1>查询数据失败</h1>');
}
$affected_rows = mysqli_affected_rows($conn);
if ($affected_rows <= 0) {
	ini_set('error_log',"$filePath");
    error_log($username." 删除展览"." ip地址:".$_SERVER['REMOTE_ADDR']."删除展览:".$exh_name."失败 ".date("Y-m-d H:i:s"));
    exit('<h1>删除失败</h1>');
}else{
	ini_set('error_log',"$filePath");
    error_log($username." 删除展览"." ip地址:".$_SERVER['REMOTE_ADDR']."删除展览:".$exh_name." ".date("Y-m-d H:i:s"));
}
header('Location: exhibition.php');
?>
