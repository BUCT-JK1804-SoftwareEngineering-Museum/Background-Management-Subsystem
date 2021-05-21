<?php
session_start();
require '../dadb.php';
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}else{
    $user_name=$_SESSION["username"];
    //var_dump($user_name);
    $sql="select *from User where user_name='$user_name'";
    $res=$conn->query($sql);
    if ($res) {
        $row=$res->fetch_assoc();
        $user_phone=$row["user_phone"];
        $user_pic=$row["user_pic"];
        $user_gender=$row["user_gender"];
        $user_site=$row["user_site"];
        $user_level=$row["user_level"];
    }
 }


$array=array();
$cid=$_GET['cid'];
$sql="SELECT * FROM Collection where col_id='$cid'";
$res=$conn->query($sql);
if ($res) {
    while ($sqll=mysqli_fetch_array($res)) {
        $array[]=$sqll;
    }
    if ($array==null) {
        echo '<script>alert("获取详情时发生错误");</script>';
    }
}else{
    echo '<script>alert("获取详情时发生错误");history.go(-1);</script>';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>后台管理子系统</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="collection.css">
    <!-- bootstrap框架，联网 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="collection.css">
</head>
<body>
<div class="allBox">
    <!-- 左侧导航 -->
    <nav class="leftNav">
        <div>
            <ul class="navBox">
                <li class="navTitle">
                    <div class="titleBox">
                        <a href="/jk-museum/index.php" class="title">后台管理子系统</a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/UserManage/user.php" class="header">
                            用户管理
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/MuseumManage/museum.php" class="header">
                            博物馆管理
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/ExplainManage/explain.php" class="header">
                            讲解管理
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/CollectionManage/collection.php" class="header">
                            <span style=";color:whitesmoke"><u>藏品管理</u></span>
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/ExhibitionManage/exhibition.php" class="header">
                            展览管理
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/CommentManage/comment.php" class="header">
                            评论管理
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/NewsManage/news.php" class="header">
                            新闻管理
                        </a>
                    </div>
                </li>
                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/UserManage/manager.php" class="header">
                            管理员
                        </a>
                    </div>
                </li>

                <li class="navHeader">
                    <div class="headerBox">
                        <a href="/jk-museum/operator.php" class="header">
                            操作日志
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- 右侧导航 -->
    <div class="topWrapper">
        <nav class="rightNav">
            <div class="welcomBox">
                <div class="indent">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24"><path d="M0 84V44c0-8.837 7.163-16 16-16h416c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16zm176 144h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zM16 484h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm-52.687-111.313l-96-95.984C17.266 138.652 0 145.776 0 160.016v191.975c0 14.329 17.325 21.304 27.313 11.313l96-95.992c6.249-6.247 6.249-16.377 0-22.625z" style="fill: rgba(146, 146, 146)"></path></svg>
                </div>
                <span>
				欢迎进入博物馆应用管理平台！
		</span>
            </div>
            <div>
                <a href="/jk-museum/UserManage/userCenter.php"><img src="/jk-museum/UserManage/images/<?=$user_pic?>" class="userAvater"></a>
                <span><a href="../quit.php" class="Astyle">退出</a></span>
            </div>
        </nav>
        <!-- 内容开始 -->
        <div class="content">
            <div class="path">
                <ol class="breadcrumb">
                    <li><a href="../index.php">首页</a></li>
                    <li><a href="collection.php">藏品管理</a></li>
                    <li class="active">修改藏品</li>
                </ol>
            </div>
            <div class="tableStyle">
                <table class="table table-hover table-bordered" id="showMag" style="margin-left:10%;width:80%">
                    <form class="bs-example bs-example-form" role="form" id="modify" action="modify.php" method="post">
                        <?php
                        if (1) {
                        foreach($array as $v){
                        ?>
                        <tr>
                            <td>项目</td>
                            <td>内容</td>
                        </tr>
                        <tr>
                            <td>藏品编号</td>
                            <td>
                                <input name="cid" type="text" value=<?=$v["col_id"]?>>
                                <input name="oldcid" type="hidden" readonly value=<?=$v["col_id"]?>>
                            </td>
                        </tr>
                        <tr>
                            <td>藏品名称</td>
                            <td>
                                <input name="cname" type="text" value=<?=$v["col_name"]?>>
                            </td>
                        </tr>
                        <tr>
                            <td>博物馆编号</td>
                            <td><?=$v["mus_id"]?></td>
                        </tr>
                        <tr>
                            <td>博物馆名称</td>
                            <td><?=$v["mus_name"]?></td>
                        </tr>
                        <tr>
                            <td>藏品类型</td>
                            <td>
                                <input name="cera" type="text" value=<?=$v["col_era"]?>>
                            </td>
                        </tr>
                        <tr>
                            <td>藏品信息</td>
                            <td>
                                <textarea name="newcol_info" style="min-width:90%;height:300px;resize: none"><?=$v["col_info"]?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>藏品图片</td>
                            <td>
                                <input type="text" name="curl" style="width:90%" value=<?=$v["col_picture"]?>>
                            </td>
                        </tr>
                        <tr>
                            <td>操作选项</td>
                            <td>
                                <button class="btn" style="color: whitesmoke;background-color: green" type="submit">提交</button>
                                <a href="collection.php" class="btn" type="button" style="background-color: red;color: whitesmoke">取消</a>
                            </td>
                        </tr>
                    </form>
                    <?php
                    }}
                    ?>
                </table>
            </div>
        </div>
        <!-- 内容结束 -->
    </div>
</body>
</html>