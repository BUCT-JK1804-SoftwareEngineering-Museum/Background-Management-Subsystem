<?php

function dataBackup(){
    $doc_root=$_SERVER['DOCUMENT_ROOT'];
    $file_path_name=$doc_root.'/backup';//保存到的路径
    $name='backup_'.date('YmdHis').".sql";
    if(!file_exists($file_path_name)){mkdir($file_path_name,0777);}
    $mysqldump_url='C:\Program Files\MySQL\MySQL Server 5.7\bin\mysqldump.exe';//mysqldump.exe的绝对路径，安装mysql自带的有，可以搜索一下路径
    $host='localhost';//规定主机名或 IP 地址
    $User='root';//规定 MySQL 用户名
    $Password='chear';//规定 MySQL 密码
    $databaseName='museum';//规定默认使用的数据库
    $process="mysqldump -h ".$host." -u ".$User." -p ".$Password." ".$databaseName." > ".$file_path_name."/".$name;
    $er=system($process);//system()执行外部程序，并且显示输出
    if($er!==false){
        echo '<script>alert("备份成功！");location="index.php";</script>';
    }else{
        echo '<script>alert("备份失败！");</script>';
    }
}
dataBackup();
?>
