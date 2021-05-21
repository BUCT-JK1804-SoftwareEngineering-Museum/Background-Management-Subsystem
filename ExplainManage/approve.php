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
$filePath="$RootDir/jk-museum/operatorManage/".$fileName;
if (!file_exists($filePath)) {
    $myfile=fopen("$filePath", "w");
}
$max_size = 500000;
 error_reporting(0);//关闭所有的错误信息，不会显示，如果清除掉，会将错误的日志写入到log中
ini_set('log_errors','on');
error_log('示例的错误信息');

$uname=$_SESSION["username"];
$sql="SELECT user_id FROM User WHERE user_name='$uname'";
$res=$conn->query($sql);
if($res){
    $uidarr=mysqli_fetch_array($res);
    $uid=$uidarr["user_id"];
}

$vid=$_GET['vid'];
$sql2="select * from Video where vid_id=$vid";
$res2=$conn->query($sql2);
$row=mysqli_fetch_assoc($res2);
$vid_name=$row["vid_name"];

$time=date("Y-m-d H:i:s");
$sql="UPDATE video SET vid_status=3,exa_id='$uid',exa_time='$time' WHERE vid_id=$vid";
$res=$conn->query($sql);
if ($res) {
    ini_set('error_log',"$filePath");
    error_log($username." 审核讲解"." ip地址:".$_SERVER['REMOTE_ADDR']."审核讲解:".$vid_name."通过 ".date("Y-m-d H:i:s"));
    echo '<script>alert("审核完成");location="explain.php"</script>';
}else{
    ini_set('error_log',"$filePath");
    error_log($username." 审核讲解"." ip地址:".$_SERVER['REMOTE_ADDR']."审核讲解:".$vid_name."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("发生错误");history.go(-1);</script>';
}
?>