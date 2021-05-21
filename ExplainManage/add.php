<?php
session_start();
require '../dadb.php';
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}else{
    $user_name=$_SESSION["username"];
    //var_dump($user_name);
    $sql="select *from User where user_name='$user_name'";
    $res=$conn->query($sql);
    if ($res) {
        $row=$res->fetch_assoc();
        $user_phone=$row["user_phone"];
        $user_pic=$row["user_pic"];
        $user_gender=$row["user_gender"];
        $user_site=$row["user_site"];
        $user_level=$row["user_level"];
    }
 }

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

$vid=$_POST["vid"];
$vname=$_POST["vname"];
$mname=$_POST["mname"];
$eid=$_POST["eid"];
$vaddr=$_POST["vaddr"];
$vinfo=$_POST["vinfo"];
$uid=$_POST["uid"];
$time=$_POST["time"];

$sql="SELECT mus_id FROM Museum WHERE mus_name='$mname'";
$res=$conn->query($sql);
$midarr=mysqli_fetch_array($res);
$mid=$midarr["mus_id"];
$etime="2021-01-01 08:00:00";
$sql="INSERT INTO Video(vid_id,user_id,mus_id,vid_name,vid_addr,vid_info,vid_status,exa_id,exa_time,vid_time,mus_name)
      VALUES ('$vid','$uid','$mid','$vname','$vaddr','$vinfo',1,'0000','2021-01-01 00:00:00','$time','$mname')";

if ($conn->query($sql) === TRUE) {
    ini_set('error_log',"$filePath");
    error_log($username." 添加讲解"." ip地址:".$_SERVER['REMOTE_ADDR']."添加讲解:".$vname." ".date("Y-m-d H:i:s"));
    echo '<script>alert("添加完成");location="explain.php"</script>';
} else {
    ini_set('error_log',"$filePath");
    error_log($username." 添加讲解"." ip地址:".$_SERVER['REMOTE_ADDR']."添加讲解:".$vname."失败 ".date("Y-m-d H:i:s"));
    echo "添加失败";
    // echo '<script>alert("添加失败");history.go(-1);</script>';
    echo "vid=$vid
          uid=$uid
          mid=$mid
          vname=$vname
          vaddr=$vaddr
          vinfo=$vinfo
          eid=$eid
          etime=$etime
          time=$time
          mname=$mname";
}

?>