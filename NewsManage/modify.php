<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: ../Login/Login.php");
    exit;
}
require'../dadb.php';
// 操作日志
$username=$_SESSION["username"];
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
$chinatime = date('Y-m-d H:i:s');
$fileName=date("Ymd").".log";
$RootDir = $_SERVER['DOCUMENT_ROOT'];
$filePath="$RootDir/jk-museum/operatorManage/".$fileName;
if (!file_exists($filePath)) {
    $myfile=fopen("$filePath", "w");
}
$max_size = 500000;
error_reporting(0);//关闭所有的错误信息，不会显示，如果清除掉，会将错误的日志写入到log中
ini_set('log_errors','on');
error_log('示例的错误信息');

$oldnid=$_POST['oldnid'];
$nid=$_POST['nid'];
$mid=$_POST['mid'];
$npu=$_POST['npu'];
$ntime=$_POST['ntime'];
$nti=$_POST['nti'];
$nco=$_POST['nco'];
$npi=$_POST['npi'];
$nso=$_POST['nso'];
$nle=$_POST['nle'];

$flag=1;

if (!empty($_FILES["npi"]["name"])) {
    $isEditPic=1;
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["npi"]["name"]);
    $extension = end($temp); // 获取文件后缀名
    $RootDir = $_SERVER['DOCUMENT_ROOT'];
    $uploaddir="$RootDir/jk-museum/NewsManage/images/";
    function GetRandStr($length) {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }
    $_FILES["npi"]["new_name"]=GetRandStr(8).".$extension";
    $uploadfile=$uploaddir.$_FILES["npi"]["new_name"];
    $user_pic=$_FILES["npi"]["new_name"];
    $a = GetRandStr(8);
}else{
    $isEditPic=0;
}


if ($flag==1) {
    $sql = "SELECT * FROM `New` where new_id='$nid'";
    $res=$conn->query($sql);//执行某个针对数据库的查询
    $num=mysqli_num_rows($res);//返回结果集中行的数量。
    $old=mysqli_fetch_array($res);
    //var_dump($old);
    if ($old&&$isEditPic) {//存在该新闻并且修改图片,如果有就删除原来的图片
        if (file_exists($uploaddir.$old['npi'])) {
            $delPhoRes=unlink($uploaddir.$old['npi']);
            //echo "删除";
        }
    }else{
        $user_pic=$old['npi'];
    }
    if ($num) {//存在该用户
        if ($isEditPic) {
            if(in_array($extension, $allowedExts))//上传新图片
            {
                if ($_FILES["npi"]["error"] > 0)
                {
                    echo "错误： " . $_FILES["npi"]["error"] . "<br>";
                }
                else
                {
                    // 判断当前目录下的 upload 目录是否存在该文件
                    while (file_exists($uploadfile))
                    {
                        $_FILES["npi"]["new_name"]=GetRandStr(8).".$extension";
                    }
                    if (is_uploaded_file($_FILES['npi']['tmp_name'])) {
                        $upres=move_uploaded_file($_FILES["npi"]["tmp_name"],$uploadfile);
                        if ($upres) {
                            //var_dump($uploadfile);
                        }else{

                        }
                        //var_dump($_FILES["user_pic"]["new_name"]);
                    }else{
                        echo '<script>alert("非法的文件来源");</script>';
                        exit();
                    }
                }
            }
            else
            {
                echo '<script>alert("非法的文件格式");</script>';
                exit();
            }
        }

$sql="UPDATE New SET new_id='$nid',mus_id='$mid',new_publisher='$npu',new_time='$ntime',new_title='$nti',new_content='$nco',new_pic='$npi',new_source='$nso',new_level='$nle' WHERE new_id='$oldnid'";

$res=$conn->query($sql);
if ($res) {
    ini_set('error_log',"$filePath");
    error_log($username." 修改新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."修改新闻:".$nid."成功 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改成功！");window.location="news.php"</script>';
}else{
    ini_set('error_log',"$filePath");
    error_log($username." 修改新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."修改评论:".$nid."失败 ".date("Y-m-d H:i:s"));
    echo '<script>alert("修改失败");history.go(-1);</script>';
}
    }else{
        ini_set('error_log',"$filePath");
        error_log($username." 修改新闻"." ip地址:".$_SERVER['REMOTE_ADDR']."修改新闻:".$nid."失败 ".date("Y-m-d H:i:s"));
        echo '<script>alert("修改失败");history.go(-1);</script>';
        exit();
    }
}
?>