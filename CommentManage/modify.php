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

$oldcid=$_POST['oldcid'];
$cid=$_POST['cid'];
$mid=$_POST['mid'];
$cgr=$_POST['cgr'];
$uid=$_POST['uid'];
$mna=$_POST['mna'];
$cin=$_POST['cin'];
$ctime=date("Y-m-d H:i:s");

$sql="UPDATE Comment SET com_id='$cid',mus_id='$mid',com_grade='$cgr',user_id='$uid',mus_name='$mna',com_info='$cin',com_time='$ctime' WHERE com_id='$oldcid'";

$res=$conn->query($sql);
if ($res) {
    ini_set('error_log',"$filePath");
    error_log($username." 修改评论"." ip地址:".$_SERVER['REMOTE_ADDR']."修改评论:".$cid."成功 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改成功！");window.location="comment.php"</script>';
}else{
    ini_set('error_log',"$filePath");
    error_log($username." 修改评论"." ip地址:".$_SERVER['REMOTE_ADDR']."修改评论:".$cid."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改失败");history.go(-1);</script>';
}

?>