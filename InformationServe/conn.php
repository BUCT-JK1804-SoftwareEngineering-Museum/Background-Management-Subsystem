<?php

$host='localhost';//规定主机名或 IP 地址
$myusername='root';//规定 MySQL 用户名
$mypassword='chear';//规定 MySQL 密码
$dbname='museum';//规定默认使用的数据库
$conn = new mysqli($host,$myusername,$mypassword,$dbname);

if($conn->connect_error){
	die("连接错误：".mysqli_connect_error());
	//mysqli_connect_error（）函数返回上一次连接错误的错误描述。
}
$conn_index=1;
$conn->query("SET NAMES 'UTF8'");//解决乱码
?>