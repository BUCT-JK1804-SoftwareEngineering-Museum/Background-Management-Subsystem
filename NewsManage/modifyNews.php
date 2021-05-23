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
$nid=$_GET['nid'];
$sql="SELECT * FROM New where new_id='$nid'";
$res=$conn->query($sql);
if ($res) {
    $v=mysqli_fetch_array($res);
    //var_dump($ress);
}else{
    echo '<script>alert("出现错误！请联系管理员！");history.go(-1);</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>后台管理子系统</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="comment.css">
    <!-- bootstrap框架，联网 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                            藏品管理
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
                    <li><a href="../index.php">后台管理</a></li>
                    <li><a href="news.php">新闻管理</a></li>
                    <li class="active">修改新闻</li>
                </ol>
            </div>
            <form class="form-horizontal" action="modify.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">新闻编号</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_id']?>" name="nid">
                        <input type="hidden" name="oldnid" readonly value=<?=$v["new_id"]?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">博物馆编号</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['mus_id']?>" name="mid">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">发布者</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_publisher']?>" name="npu">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">新闻时间</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_time']?>" name="ntime">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">新闻标题</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_title']?>" name="nti">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">新闻内容</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_content']?>" name="nco">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile" class="col-sm-1 control-label">新闻图片</label>
                    <div class="col-sm-10">
                        <input type="file" id="file" name="npi">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">新闻来源</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_source']?>" name="nso">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-1 control-label">新闻性质</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputPassword3" value="<?=$v['new_level']?>" name="nle">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">修改</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- 内容结束 -->
    </div>
</body>
</html>