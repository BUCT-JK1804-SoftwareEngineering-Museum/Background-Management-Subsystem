<?php
//9. post展览名称exh_name,模糊查询获取展览表Exhibition对应一条数据。
header("content-type:text/html;charset=utf-8");

include('conn.php');
$exh_name= $_POST['exh_name'];
$sql="SELECT * FROM exhibition WHERE exh_name like '%$exh_name%'";
$res=$conn->query($sql);
$result = mysqli_fetch_assoc($res);
echo(json_encode($result));


?>