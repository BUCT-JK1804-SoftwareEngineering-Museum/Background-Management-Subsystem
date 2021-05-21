<?php
// 显示博物馆的基本信息
header("content-type:text/html;charset=utf-8");

include('conn.php');
$mus_id=$_POST["mus_id"];
$sql="SELECT * from museum where mus_id='$mus_id'";
$res=$conn->query($sql);
if ($res) {
	$sqll=mysqli_fetch_assoc($res);
	echo json_encode($sqll);
}

?>