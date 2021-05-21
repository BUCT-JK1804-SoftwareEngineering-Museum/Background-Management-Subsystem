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

$sql2="SELECT * FROM `New` order by new_id desc limit 1";
$res2=$conn->query($sql2);
$sqll2=mysqli_fetch_array($res2);
$nid=(int)$sqll2["new_id"]+1;

$mid=$_POST['mid'];
$npu=$_POST['npu'];
$ntime=$_POST['ntime'];
$nti=$_POST['nti'];
$nco=$_POST['nco'];
$npi=$_POST['npi'];
$nso=$_POST['nso'];
$nle=$_POST['nle'];

$flag=1;


        $sql="INSERT INTO New(new_id, mus_id,new_publisher,new_time,new_title,new_content,new_pic,new_source,new_level)VALUES ('$nid','$mid','$npu','$ntime','$nti','$nco','$npi','$nso','$nle')";

        $res=$conn->query($sql);
        if ($res) {
            ini_set('error_log',"$filePath");
            error_log($username." 添加新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."添加新闻:".$nid." ".date("Y-m-d H:i:s"));
            echo '<script>alert("添加成功！");window.location="news.php"</script>';
        }else{
            ini_set('error_log',"$filePath");
            error_log($username." 添加新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."添加新闻:".$nid."失败 ".date("Y-m-d H:i:s"));
             echo '<script>alert("添加失败");history.go(-1);</script>';
        }
?>