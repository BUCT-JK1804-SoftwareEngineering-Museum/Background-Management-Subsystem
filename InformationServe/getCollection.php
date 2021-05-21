<?php
//10. post藏品名称col_name,获取藏品表collection对应一条数据。

header("content-type:text/html;charset=utf-8");

include('conn.php');
$col_name= $_POST['col_name'];
$sql="SELECT * FROM collection WHERE col_name like '$col_name'";
$res=$conn->query($sql);
$result = mysqli_fetch_assoc($res);
echo(json_encode($result));

?>