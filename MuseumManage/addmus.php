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
        $user_pic=$row["user_pic"];
    }
}
if (!$conn) {
    exit('<h1>连接数据库失败</h1>');
}
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

if($_SERVER['REQUEST_METHOD']==='POST'){
    $mus_id = (int)$_POST["mus_id"];
    $mus_name = (string) $_POST["mus_name"];
    $mus_picture = (string) $_POST["mus_picture"];
    $mus_grade = (double)$_POST["mus_grade"];
    $mus_time = (string)$_POST["mus_time"];
    $mus_address = (string)$_POST["mus_address"];
    $mus_remark = (string)$_POST["mus_remark"];
    $mus_phone = (string)$_POST["mus_phone"];
    $mus_master = (string)$_POST["mus_master"];
    if(!$conn){
        $GLOBALS['msg'] = '连接数据库失败';
        return;
    }

    $query = mysqli_query($conn," INSERT INTO Museum (mus_id , mus_name,mus_picture,mus_grade,mus_time,mus_address,mus_remark,mus_phone,mus_master) 
                VALUES ('{$mus_id}','{$mus_name}','{$mus_picture}','{$mus_grade}','{$mus_time}','{$mus_address}','{$mus_remark}','{$mus_phone}','{$mus_master}')");

    if (!$query) {
        $GLOBALS['msg'] = '查询过程失败';
        return;
    }else{
        ini_set('error_log',"$filePath");
        error_log($username." 添加博物馆"." ip地址:".$_SERVER['REMOTE_ADDR']."添加博物馆:".$mus_name."成功 ".date("Y-m-d H:i:s"));
    }

    $affected = mysqli_affected_rows($conn);
    if($affected!==1){
        $GLOBALS['error_message'] = '添加数据失败';
        return;
    }
    header('Location: museum.php');
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
                    <li class="active">添加博物馆</li>
                </ol>
            </div>
<div>
    <h4 class="alert alert-primary text-center">添加博物馆信息</h4>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group row">
            <label for="mus_id" class="col-sm-2 col-form-label">博物馆编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_id" name="mus_id">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_name" class="col-sm-2 col-form-label">博物馆名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_name" name="mus_name">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_picture" class="col-sm-2 col-form-label">博物馆图片</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_picture" name="mus_picture">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_grade" class="col-sm-2 col-form-label">博物馆等级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_grade" name="mus_grade">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_time" class="col-sm-2 col-form-label">开放时间</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_time" name="mus_time">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_address" class="col-sm-2 col-form-label">地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_address" name="mus_address">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_remark" class="col-sm-2 col-form-label">官网网址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_remark" name="mus_remark">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_phone" class="col-sm-2 col-form-label">联系方式</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_phone" name="mus_phone">
            </div>
        </div>
        <div class="form-group row">
            <label for="mus_master" class="col-sm-2 col-form-label">馆主</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mus_master" name="mus_master">
            </div>
        </div>

        <!--这里添加提示-->
        <?php if(!empty($GLOBALS['msg'])): ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $GLOBALS['msg']; ?>
            </div>
        <?php endif ?>
        <button type="submit" class="btn btn-primary btn-block">保存</button>
    </form>
</div>
</div>
</body>
</html>
