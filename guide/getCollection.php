<?php
// 显示展览信息
header("content-type:text/html;charset=utf-8");

include('conn.php');
$mus_id=$_POST["mus_id"];
$sql="SELECT * from collection where mus_id='$mus_id' limit 3";
$res=$conn->query($sql);
if ($res) {
	while ($sqll=mysqli_fetch_assoc($res)) {
			$array[]=$sqll;
		}
}
echo json_encode($array);
?>