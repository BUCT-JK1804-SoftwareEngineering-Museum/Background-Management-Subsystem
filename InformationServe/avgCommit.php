<?php
// 5. post博物馆名称mus_name、用户名user_name、评论内容com_info、评分com_grade插入一条数据到评论表Commit。在评论后更新该博物馆的评分为该博物馆所有评分的平均值。
date_default_timezone_set('Asia/Shanghai'); 
$chinatime = date('Y-m-d H:i:s');
require 'conn.php';
$mus_name=$_POST["mus_name"];
$user_name=$_POST["user_name"];
$com_info=$_POST["com_info"];
$com_grade=$_POST["com_grade"];

$sql="SELECT * FROM `comment` order by com_id desc limit 1";
$res=$conn->query($sql);
$sqll=mysqli_fetch_array($res);
$com_id=(int)$sqll["com_id"]+1;

$sql="SELECT *from museum where mus_name='$mus_name'";
$res=$conn->query($sql);
$sqll=mysqli_fetch_assoc($res);
$mus_id=(int)$sqll['mus_id'];

$sql="SELECT *from user where user_name='$user_name'";
$res=$conn->query($sql);
$sqll=mysqli_fetch_assoc($res);
$user_id=(int)$sqll['user_id'];

$sql="INSERT into comment(com_id,mus_id,com_grade,user_id,mus_name,com_info,com_time)values('$com_id','$mus_id','$com_grade','$user_id','$user_name','$com_info','$chinatime')";
$res=$conn->query($sql);
if ($res) {
	$sql2="SELECT avg(com_grade) from comment where mus_id='$mus_id'";
	$res2=$conn->query($sql2);
	$avgGrade=mysqli_fetch_assoc($res2);
	$newGrade=$avgGrade['avg(com_grade)'];

	$sql4="UPDATE museum set mus_grade='$newGrade' where mus_id='$mus_id'";
	$res4=$conn->query($sql4);
	if ($res4) {
		// var_dump($newGrade);
		echo "1";
	}
	
}else{
	echo "0";
}
?>
