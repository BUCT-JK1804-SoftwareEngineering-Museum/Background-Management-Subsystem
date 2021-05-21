<?php
// 6. post用户名，获取评论表Commit对应用户多条数据。
header("content-type:text/html;charset=utf-8");

include('conn.php');
$user_name= $_POST['user_name'];
$sql="SELECT * FROM user WHERE user_name='$user_name'";
$res=$conn->query($sql);
$res_sql=mysqli_fetch_assoc($res);
$user_id=$res_sql["user_id"];
$sql="SELECT * FROM comment WHERE user_id='$user_id'";
$res=$conn->query($sql);
$array=array();
if ($res) {
	while ($sqll=mysqli_fetch_assoc($res)) {
			$array[]=$sqll;
		}
}
echo json_encode($array);
?>