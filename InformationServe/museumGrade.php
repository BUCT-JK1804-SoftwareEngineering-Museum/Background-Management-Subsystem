<?php
// 7. 直接显示博物馆名称和评分，按评分 从大到小排序；{mus_name, mus_grade}
header("content-type:text/html;charset=utf-8");
include('conn.php');
$sql="SELECT * from museum order by mus_grade DESC";
$res=$conn->query($sql);
$array=array();
if ($res) {
	while ($sqll=mysqli_fetch_assoc($res)) {
			$array[]=$sqll;
		}
}
echo json_encode($array);
?>