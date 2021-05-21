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
$vid=$_GET["vid"];
$sql="select * from Video where vid_id='$vid'";
$res=$conn->query($sql);
if ($res) {
    while ($sqll=mysqli_fetch_array($res)) {
        $array[]=$sqll;
    }
    // var_dump($array);
    if ($array==null) {
        echo '<script>alert("讲解表为空");</script>';
    }
}else{
    echo '<script>alert("查询失败");history.go(-1);</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>后台管理子系统</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="explain.css">
    <!-- bootstrap框架，联网 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="explain.css">
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
                            <span style=";color:whitesmoke"><u>讲解管理</u></span>
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
                    <li><a href="../index.php">首页</a></li>
                    <li><a href="explain.php">讲解管理</a></li>
                    <li class="active">讲解详细信息</li>
                </ol>
            </div>
            <div class="tableStyle">
                <table class="table table-hover table-bordered" id="showMag">
                    <?php
                    if (1) {
                        foreach($array as $v){
                            ?>
                            <tr>
                                <td>讲解编号</td>
                                <td><?=$v["vid_id"]?></td>
                            </tr>
                            <tr>
                                <td>讲解标题</td>
                                <td><?=$v["vid_name"]?></td>
                            </tr>
                            <tr>
                                <td>内容简介</td>
                                <td><textarea style="border:white;width:70%;height:100px;overflow:auto;background-color:white;resize:none" readonly="readonly"><?=$v["vid_info"]?></textarea></td>
                            </tr>
                            <tr>
                                <td>内容详情</td>
                                <td><audio src="<?=$v["vid_addr"]?>" controls="controls"></audio></td>
                            </tr>
                            <tr>
                                <td>Url</td>
                                <td><?=$v["vid_addr"]?></td>
                            </tr>
                            <tr>
                                <td>博物馆名</td>
                                <td><?=$v["mus_name"]?></td>
                            </tr>
                            <tr>
                                <td>博物馆编号</td>
                                <td><?=$v["mus_id"]?></td>
                            </tr>
                            <tr>
                                <td>上传用户</td>
                                <td><?=$v["user_id"]?></td>
                            </tr>
                            <tr>
                                <td>上传时间</td>
                                <td><?=$v["vid_time"]?></td>
                            </tr>
                            <tr>
                                <td>审核状态</td>
                                <td>
                                    <?php
                                    $vstatus=$v["vid_status"];
                                    if($vstatus==0){
                                        ?>未审核<?php
                                    }else if($vstatus==-1){
                                        ?>未过审<?php
                                    }else{
                                        ?>已审核<?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>审核人员</td>
                                <td><?=$v["exa_id"]?></td>
                            </tr>
                            <tr>
                                <td>审核时间</td>
                                <td><?=$v["exa_time"]?></td>
                            </tr>
                            <?php
                        }}
                    ?>
                    <tr>
                        <td>操作选项</td>
                        <td><a href="explain.php" class="btn" style="background-color: green;color: whitesmoke">返回</a></td>
                    </tr>
                </table>
            </div>

        </div>
        <!-- 内容结束 -->
    </div>
</body>
</html>
