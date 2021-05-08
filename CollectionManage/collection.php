<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';
$array=array();
$sql="select * from collection";
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
    <!-- bootstrap框架，联网 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="user.css">
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
                            <span style="color: yellow">藏品管理</span>
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
                        <a href="operator.php" class="header">
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
                <span><a href="../quit.php" class="Astyle">退出</a></span>
            </div>
        </nav>
        <!-- 内容开始 -->
        <div class="searchContent">
            <form class="bs-example bs-example-form" role="form" id="search" action="searchCollection.php" method="post">
                <div class="col-lg-6" id="searchBorder">
                    <div class="input-group" style="margin-top:10px;margin-left:3px">
                        <input type="text" class="form-control" placeholder="请输入需要搜索的内容" name="content">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" style="margin-top:0px">
                                搜索
                            </button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <a type="submit" class='btn' style="margin-left: 600px;margin-top: 20px;background-color: green" href=addCollection.php><span style="color: whitesmoke">添加新藏品</span></a>
            </form>
        </div>
        <div class="tableStyle" style="width:1585px;height:800px;overflow:auto">
            <style>
                .style_500px{width:500px;vertical-align:middle}
                .style_150px{width:150px;vertical-align:middle}
            </style>
            <table class="table table-hover table-bordered" style="margin-left:18px;margin-top:20px;width:1550px" id="showMag">
                <tr>
                    <td>藏品编号</td>
                    <td>藏品名称</td>
                    <td>博物馆编号</td>
                    <td>博物馆名称</td>
                    <td>藏品类型</td>
                    <td>藏品信息</td>
                    <td>藏品图片</td>
                    <td>操作选项</td>
                </tr>
                <?php
                if (1) {
                    foreach($array as $v){
                        ?>
                        <tr>
                            <td class="style_150px"><?=$v["col_id"]?></td>
                            <td class="style_150px"><?=$v["col_name"]?></td>
                            <td class="style_150px"><?=$v["mus_id"]?></td>
                            <td class="style_150px"><?=$v["mus_name"]?></td>
                            <td class="style_150px"><?=$v["col_era"]?></td>
                            <td class="style_500px"><textarea type="text" style="border:white;width:490px;height:100px;overflow:auto;background-color:whitesmoke;resize:none" readonly="readonly"><?=$v["col_info"]?></textarea></td>
                            <td class="style_150px"><a href=<?=$v["col_picture"]?> target="_blank">点击查看</a></td>
                            <td><a type='submit' class='btn' style="background-color: red;margin-top: 13px" href=deleteCollection.php?cid=<?=$v["col_id"]?>><span style="color: whitesmoke">删除</span></a>
                                <br>
                                <a type='submit' class='btn' style="background-color:darkorange;margin-top: 10px" href=modifyCollection.php?cid=<?=$v["col_id"]?>><span style="color: whitesmoke">修改</span></a>
                            </td>
                        </tr>
                        <?php
                    }}
                ?>
            </table>
        </div>
        <!-- 内容结束 -->
    </div>
</body>
</html>