<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';
$cid=$_GET['cid'];
$sql="SELECT user_id FROM Comment WHERE com_id='$cid'";
$res=$conn->query($sql);
if ($res) {
    while ($sqll=mysqli_fetch_array($res)) {
        $array[]=$sqll;
    }
    // var_dump($array);
    if ($array==null) {
        echo '<script>alert("没有找到相关内容");location="explain.php"</script>';
    }
}else{
    echo '<script>alert("查询失败");location="explain.php"</script>';
}
if (1) {
    foreach ($array as $v) {
        $olduid = $v['user_id'];
    }
}
$sql="UPDATE User SET user_pallow=0 WHERE user_id='$olduid'";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("拉黑成功");location="news.php"</script>';
} else {
    echo '<script>alert("拉黑失败");location="news.php"</script>';
}
?>