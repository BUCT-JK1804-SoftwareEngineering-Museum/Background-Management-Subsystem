<?php
// 1. post博物馆名称mus_name，获取博物馆表museum对应一条数据。
header("content-type:text/html;charset=utf-8");

include('conn.php');
$mus_name= $_POST['mus_name'];
$sql="SELECT * FROM museum WHERE mus_name='$mus_name'";
$check_query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($check_query);
echo(json_encode($result));

?>