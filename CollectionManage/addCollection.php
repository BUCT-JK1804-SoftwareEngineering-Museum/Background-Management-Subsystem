<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: Login/Login.php");
    exit;
}
require '../dadb.php';
$uname=$_SESSION["username"];
$sql="SELECT user_id FROM user where user_name='$uname'";
$res=$conn->query($sql);
$uidarr=mysqli_fetch_array($res);
$uid=$uidarr["user_id"];

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
        <div>
            <form action="add.php" method="post">
                <div class="col-lg-6" id="searchBorder">
                    <div class="input-group" style="margin-top:10px;margin-left:3px">
                        <span style="margin-left:700px"><br>
                            <?php
                            $sql="SELECT MAX(col_id) FROM collection WHERE 1";
                            $res=$conn->query($sql);
                            $cidarr=mysqli_fetch_array($res);
                            $cid=$cidarr["MAX(col_id)"]+1;
                            ?>
                            <table class="table table-hover table-bordered" style="margin-left:200px;margin-top:20px;width:1000px" id="showMag">
                                <tr>
                                    <td>项目</td>
                                    <td>内容</td>
                                </tr>
                                <tr>
                                    <td>藏品编号</td>
                                    <td><?=$cid?><input style="width:200px" type="hidden" name="cid" readonly value=<?=$cid?>></td>
                                </tr>
                                <tr>
                                    <td>藏品名称</td>
                                    <td>
                                        <input name="cname" style="width:140px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>藏品类型</td>
                                    <td>
                                        <input name="cera" style="width:140px">
                                    </td>
                                </tr>
                                <tr>
                                    <td>博物馆名</td>
                                    <td>
                                        <select style="width:160px;height:25px" name="mname">
                                            <option>请选择</option>
                                            <?php
                                            $array=array();
                                            $sql="SELECT mus_name FROM museum";
                                            $res=$conn->query($sql);
                                            if ($res) {
                                                while ($sqll=mysqli_fetch_array($res)) {
                                                    $array[]=$sqll;
                                                }
                                                // var_dump($array);
                                                if ($array==null) {
                                                    echo '<script>alert("博物馆表为空");</script>';
                                                }
                                            }else{
                                                echo '<script>alert("ERROR!");history.go(-1);</script>';
                                            }
                                            foreach ($array as $v){
                                                echo "<option value='".$v["mus_name"]."'>".$v["mus_name"]."</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>藏品详情</td>
                                    <td><textarea style="width:600px;height:360px;resize:none" type="text" name="cinfo"></textarea></td>
                                </tr>
                                <tr>
                                    <td>藏品图片</td>
                                    <td>
                                        <input name="curl" style="width:400px">
                                    </td>
                                <tr>
                                    <td>操作选项</td>
                                    <td>
                                        <input class="btn" style="background-color:green;color:whitesmoke" type="submit" value="提交">
                                        <a class="btn" type="button" style="background-color: red;color: whitesmoke" href="collection.php">取消</a>
                                    </td>
                                </tr>
                            </table>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </form>
        </div>
        <!-- 内容结束 -->
    </div>
</body>
</html>