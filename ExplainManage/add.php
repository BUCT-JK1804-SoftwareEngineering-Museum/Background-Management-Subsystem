<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';

$cid=$_POST["cid"];
$mname=$_POST["mname"];
$comment=$_POST["comment"];
$uid=$_POST["uid"];
$time=$_POST["time"];

$sql="SELECT mus_id FROM museum WHERE mus_name='$mname'";
$res=$conn->query($sql);
$midarr=mysqli_fetch_array($res);
$mid=$midarr["mus_id"];

$sql="INSERT INTO comment(com_id,mus_id,com_grade,user_id,mus_name,com_info,com_time) 
      VALUES ('$cid','$mid',5,'$uid','$mname','$comment','$time')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("添加完成");location="explain.php"</script>';
} else {
    echo '<script>alert("添加失败");location="explain.php"</script>';
}

?>