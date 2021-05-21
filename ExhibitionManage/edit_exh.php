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

$exh_id = (int)$_POST["exh_id"];
$exh_name = (string)$_POST["exh_name"];
$mus_id = (int)$_POST["mus_id"];
$mus_name = (string)$_POST["mus_name"];
$exh_info = (string)$_POST["exh_info"];
$exh_picture = (string)$_POST["exh_picture"];
$exh_time = (string)$_POST["exh_time"];

if (!$conn) {
    exit('<h1>连接数据库失败</h1>');
}

$query = mysqli_query($conn, "UPDATE Exhibition SET exh_id='{$exh_id}',exh_name='{$exh_name}',mus_name='{$mus_name}',exh_info='{$exh_info}',exh_picture='{$exh_picture}',exh_time='{$exh_time}' 
            WHERE exh_id={$exh_id} ");
if (!$query) {
	ini_set('error_log',"$filePath");
    error_log($username." 更新展览"." ip地址:".$_SERVER['REMOTE_ADDR']."更新展览:".$exh_name."失败 ".date("Y-m-d H:i:s"));
    exit('<h1>查询数据失败</h1>');
}else{
	ini_set('error_log',"$filePath");
    error_log($username." 更新展览信息"." ip地址:".$_SERVER['REMOTE_ADDR']."更新展览:".$exh_name." ".date("Y-m-d H:i:s"));
}

header('Location:exhibition.php');
?>