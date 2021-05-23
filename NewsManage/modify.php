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

$oldnid=$_POST['oldnid'];
$nid=$_POST['nid'];
$mid=$_POST['mid'];
$npu=$_POST['npu'];
$ntime=$_POST['ntime'];
$nti=$_POST['nti'];
$nco=$_POST['nco'];
$npi=$_POST['npi'];
$nso=$_POST['nso'];
$nle=$_POST['nle'];

$flag=1;

$sql="UPDATE New SET mus_id='$mid',new_publisher='$npu',new_time='$ntime',new_title='$nti',new_content='$nco',new_pic='$npi',new_source='$nso',new_level='$nle' WHERE mus_id='$mid'";

$res=$conn->query($sql);
if ($res) {
    ini_set('error_log',"$filePath");
    error_log($username." 修改新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."修改新闻:".$nid."成功 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改成功！");window.location="news.php"</script>';
}else{
    ini_set('error_log',"$filePath");
    error_log($username." 修改新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."修改评论:".$nid."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改失败");history.go(-1);</script>';
}
?>