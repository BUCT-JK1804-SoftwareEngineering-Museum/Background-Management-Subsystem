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

$cid=$_GET['cid'];
$sql="SELECT user_id FROM Comment WHERE com_id='$cid'";
$res=$conn->query($sql);
if ($res) {
    while ($sqll=mysqli_fetch_array($res)) {
        $array[]=$sqll;
    }
    // var_dump($array);
    if ($array==null) {
        echo '<script>alert("没有找到相关内容");location="explain.php"</script>';
    }
}else{
    echo '<script>alert("查询失败");location="explain.php"</script>';
}
if (1) {
    foreach ($array as $v) {
        $olduid = $v['user_id'];
    }
}
$sql="UPDATE User SET user_pallow=0 WHERE user_id='$olduid'";

$sql2="SELECT * from User where user_id='$olduid'";
$res2=$conn->query($sql2);
$old=mysqli_fetch_assoc($res2);
$oldName=$old["user_name"];

if ($conn->query($sql) === TRUE) {
    ini_set('error_log',"$filePath");
    error_log($username." 拉黑用户"." ip地址:".$_SERVER['REMOTE_ADDR']."拉黑用户:".$oldName." ".date("Y-m-d H:i:s"));
    echo '<script>alert("拉黑成功");location="comment.php"</script>';
} else {
    ini_set('error_log',"$filePath");
    error_log($username." 拉黑用户"." ip地址:".$_SERVER['REMOTE_ADDR']."拉黑用户:".$oldName."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("拉黑失败");location="comment.php"</script>';
}
?>