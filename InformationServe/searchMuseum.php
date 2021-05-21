<?php
//8. post**不完整**的博物馆名称，获取模糊查询符合要求的多个博物馆名称mus_name
header("content-type:text/html;charset=utf-8");

include('conn.php');
$mus_name= $_POST['mus_name'];
$sql="SELECT * FROM museum WHERE mus_name like '%$mus_name%'";
$res=$conn->query($sql);
$array=array();
if ($res) {
	while ($sqll=mysqli_fetch_assoc($res)) {
			$array[]=$sqll;
		}
}
echo json_encode($array);

?>