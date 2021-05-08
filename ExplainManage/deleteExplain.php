<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';

$cid=$_GET['cid'];
$sql="DELETE FROM comment WHERE com_id=$cid";
$res=$conn->query($sql);
if($res){
    echo '<script>alert("删除成功");location="explain.php"</script>';
}else{
    echo '<script>alert("删除失败");location="explain.php"</script>';
}
?>