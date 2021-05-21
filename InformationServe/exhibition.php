<?php
//3 post博物馆名称mus_name，获取展览表Exhibition对应多条数据。
header("content-type:text/html;charset=utf-8");

include('conn.php');
$mus_name= $_POST['mus_name'];
$sql="SELECT mus_id from museum where mus_name='$mus_name'";
$res=$conn->query($sql);
if ($res) {
	$res_sql=mysqli_fetch_assoc($res);
	$mus_id=$res_sql['mus_id'];
	$sql="SELECT * FROM exhibition WHERE mus_id='$mus_id'";
	$res=$conn->query($sql);
	$array=array();
	if ($res) {
		while ($sqll=mysqli_fetch_assoc($res)) {
				$array[]=$sqll;
			}
	}
	echo json_encode($array);
}


?>