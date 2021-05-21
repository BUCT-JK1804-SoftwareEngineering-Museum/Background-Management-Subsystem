<?php
//2. post博物馆名称mus_name，获取藏品表collection对应多条数据。
header("content-type:text/html;charset=utf-8");

include('conn.php');
$mus_name= $_POST['mus_name'];
$sql="SELECT * FROM collection WHERE mus_name='$mus_name'";
$res=$conn->query($sql);
$array=array();
if ($res) {
	while ($sqll=mysqli_fetch_assoc($res)) {
			$array[]=$sqll;
		}
}
echo json_encode($array);
?>