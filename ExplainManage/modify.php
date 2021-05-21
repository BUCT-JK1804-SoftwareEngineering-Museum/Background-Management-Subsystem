<?php
session_start();
require '../dadb.php';
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
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

$oldvid=(int)$_POST['oldvid'];
$vid=(int)$_POST['vid'];
$uid=$_POST['uid'];
$vaddr=$_POST['vaddr'];
$vinfo=$_POST['vinfo'];
$eid="0";
$etime="2021-01-01 08:00:00";
$vststus=1;

$sql2="select * from Video where vid_id=$vid";
$res2=$conn->query($sql2);
$row=mysqli_fetch_assoc($res2);
$vid_name=$row["vid_name"];

$sql="UPDATE Video SET vid_id='$vid',user_id='$uid',vid_addr='$vaddr',vid_info='$vinfo',vid_status='$vststus',exa_id='$eid',exa_time='$etime' WHERE vid_id='$oldvid'";

// var_dump($etime);
if ($conn->query($sql) === TRUE) {
	ini_set('error_log',"$filePath");
    error_log($username." 修改讲解"." ip地址:".$_SERVER['REMOTE_ADDR']."修改讲解:".$vid_name." ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改完成");location="explain.php"</script>';
} else {
	ini_set('error_log',"$filePath");
    error_log($username." 修改讲解"." ip地址:".$_SERVER['REMOTE_ADDR']."修改讲解:".$vid_name."失败 ".date("Y-m-d H:i:s"));
    echo "string";
    // echo '<script>alert("修改失败");location="explain.php"</script>';
}

?>