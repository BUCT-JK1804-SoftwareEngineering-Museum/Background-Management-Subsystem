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

if(empty($_GET['mus_id'])){
    exit('<h1>必须传入指定参数</h1>');
    return;
}
$mus_id = $_GET['mus_id'];

if(!$conn){
    exit('<h1>连接数据库失败</h1>');
}
$query = mysqli_query($conn,"select * from Museum where mus_id = {$mus_id} limit 1");
if(!$query){
    exit('<h1>查询数据失败</h1>');
}
$user = mysqli_fetch_assoc($query);
if(!$user){
    exit('<h1>找不到你要编辑的数据</h1>');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>后台管理子系统</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="museum.css">
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
        <div class="content">
            <div class="path">
                <ol class="breadcrumb">
                    <li><a href="../index.php">后台管理</a></li>
                    <li><a href="/jk-museum/MuseumManage/museum.php">博物馆管理</a></li>
                    <li class="active">修改博物馆信息</li>
                </ol>
            </div>
<div>
    <h4 class="alert alert-primary text-center">修改博物馆信息</h4>
    <form method="post" action="edit_mus.php">
        <div class="form-group row">
            <label for="mus_id" class="col-sm-2 col-form-label">博物馆编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_id" name="mus_id" value="<?php echo $user['mus_id']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_name" class="col-sm-2 col-form-label">博物馆名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_name" name="mus_name" value="<?php echo $user['mus_name']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_picture" class="col-sm-2 col-form-label">博物馆图片</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_picture" name="mus_picture" value="<?php echo $user['mus_picture']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_grade" class="col-sm-2 col-form-label">博物馆等级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_grade" name="mus_grade" value="<?php echo $user['mus_grade']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_time" class="col-sm-2 col-form-label">开发时间</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_time" name="mus_time" value="<?php echo $user['mus_time']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_address" class="col-sm-2 col-form-label">地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_address" name="mus_address" value="<?php echo $user['mus_address']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_remark" class="col-sm-2 col-form-label">官网网址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_remark" name="mus_remark" value="<?php echo $user['mus_remark']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_phone" class="col-sm-2 col-form-label">联系方式</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_phone" name="mus_phone" value="<?php echo $user['mus_phone']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_master" class="col-sm-2 col-form-label">馆主</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_master" name="mus_master" value="<?php echo $user['mus_master']; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">保存</button>
    </form>
</div>

