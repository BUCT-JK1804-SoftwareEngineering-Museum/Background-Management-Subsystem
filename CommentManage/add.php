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

$mid=$_POST['mid'];
$cgr=$_POST['cgr'];
$uid=$_POST['uid'];
$mna=$_POST['mna'];
$ctime=date("Y-m-d H:i:s");

$flag=1;
        $sql="SELECT * FROM `Comment` order by com_id desc limit 1";
        $res=$conn->query($sql);
        $sqll=mysqli_fetch_array($res);
        $cid=(int)$sqll["com_id"]+1;

        $sql="INSERT INTO Comment(com_id,mus_id,com_grade,user_id,mus_name,com_info,com_time)VALUES ('$cid','$mid','$cgr','$uid','$mna','$cin','$ctime')";

        $res=$conn->query($sql);
        if ($res) {
            ini_set('error_log',"$filePath");
            error_log($username." 添加评论"." ip地址:".$_SERVER['REMOTE_ADDR']."添加评论:".$cid."成功 ".date("Y-m-d H:i:s"));
            echo '<script>alert("添加成功！");window.location="comment.php"</script>';
        }else{
            ini_set('error_log',"$filePath");
            error_log($username." 添加评论"." ip地址:".$_SERVER['REMOTE_ADDR']."添加评论:".$cid."失败 ".date("Y-m-d H:i:s"));
            echo '<script>alert("添加失败");history.go(-1);</script>';
        }
?>