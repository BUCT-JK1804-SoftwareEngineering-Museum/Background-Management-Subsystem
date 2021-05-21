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

$choice=$_POST["choice"];
$content=$_POST["content"];
$array=array();
if (empty($content)) {
	echo '<script>alert("请输入搜索内容！");history.go(-1);</script>';
}else{
    $sql="select * from Museum where $choice like '%$content%'";
	$res=$conn->query($sql);
	if ($res) {
		while ($sqll=mysqli_fetch_array($res)) {
			$array[]=$sqll;
		}
		// var_dump($array);
		if ($array==null) {
			echo '<script>alert("没有找到相关内容");</script>';
		}
	}else{
		echo '<script>alert("查询失败");history.go(-1);</script>';
	}
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
                <span><a href="/quit.php" class="Astyle">退出</a></span>
            </div>
        </nav>
        <!-- 内容，在这里添加对应页面的代码 -->
        <div class="content">
            <div class="path">
                <ol class="breadcrumb">
                    <li><a href="../index.php">后台管理</a></li>
                    <li><a href="/jk-museum/MuseumManage/museum.php">博物馆管理</a></li>
                    <li class="active" >博物馆查询</li>
                </ol>
            </div>
            <div class="searchContent">
                <div class="col-xs-6">
                    <form class="form-inline pull-left" role="form" id="search" action="searchmus.php" method="post">
                        <div class="form-group">
                            <select class="form-control" name="choice" >
                                <option value="mus_id">博物馆编号</option>
                                <option value="mus_name">博物馆名称</option>
                                <option value="mus_picture">博物馆图片</option>
                                <option value="mus_grade">博物馆等级</option>
                                <option value="mus_time">开放时间</option>
                                <option value="mus_address">地址</option>
                                <option value="mus_remark">官网网址</option>
                                <option value="mus_phone">联系方式</option>
                                <option value="mus_master">馆主</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="请输入需要搜索的内容" name="content">
                        </div>
                        <button class="btn btn-default" type="submit">
                            搜索
                        </button>
                    </form>
                </div>
                <button type="button" class="btn btn-info"><a href="addmus.php" class="buttonStyle">添加博物馆</a></button>
            </div>
        <div class="tableStyle">
            <table style='table-layout:fixed; word-wrap:break-word' class="table table-hover table-bordered" id="showMag">
                <tr>
                    <td>博物馆编号</td>
                    <td>博物馆名称</td>
                    <td>博物馆图片</td>
                    <td>博物馆等级</td>
                    <td>开放时间</td>
                    <td>地址</td>
                    <td>官网地址</td>
                    <td>联系方式</td>
                    <td>馆主</td>
                    <td>操作</td>
                </tr>
                <?php
                if (1) {
                foreach($array as $v){
                ?>
                <tr>
                    <td><?=$v["mus_id"]?></td>
                    <td><?=$v["mus_name"]?></td>
                    <td><img width=120 height=80 src = "<?=$v["mus_picture"]?>" /> </td>
                    <td><?=$v["mus_grade"]?></td>
                    <td><?=$v["mus_time"]?></td>
                    <td><?=$v["mus_address"]?></td>
                    <td><?=$v["mus_remark"]?></td>
                    <td><?=$v["mus_phone"]?></td>
                    <td><?=$v["mus_master"]?></td>
                    <td>
                        <a href="delmus.php?mus_id=<?=$v['mus_id']?>" class="btn btn-primary">删除</a>
                        <a href="chamus.php?mus_id=<?=$v['mus_id']?>" class="btn btn-danger">修改</a>
                    </td>
                    <?php
                    }}
                    ?>
            </table>
        </div>

        </div>

        <!--内容结束  -->
    </div>
</body>
</html>