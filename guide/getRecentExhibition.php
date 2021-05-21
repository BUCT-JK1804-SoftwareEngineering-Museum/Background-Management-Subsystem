<?php
// 单击某一个博物馆，在底部显示该博物馆的近期展览
header("content-type:text/html;charset=utf-8");

include('conn.php');

$mus_id=$_POST["mus_id"];
$sql="SELECT * from exhibition where mus_id='$mus_id' order by exh_id DESC limit 1";
$res=$conn->query($sql);
$array=array();
if ($res) {
	$result=mysqli_fetch_assoc($res);

}
echo(json_encode($result));

?>