<?php
session_start();
require '../dadb.php';
if (empty($_SESSION["username"])) {
    header("Location: ../Login/Login.php");
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

//分页
$pageSize = 3;//每一页面内容大小
$res="select * from Video";
$sql=$conn->query($res);
$num=mysqli_num_rows($sql);
$pageNum=ceil($num/$pageSize);//取整函数，向上取整；
// $pageVal=empty($_GET['page'])?1:$_GET['page'];
if(isset($_GET['page'])&&$_GET['page']>1&&$_GET['page']<=$pageNum){
    $pageVal=$_GET['page'];
}else{
    $pageVal=1;
}
$pageSql=($pageVal-1)*$pageSize;//当前开始查询的位置

$array=array();
$sql="select * from Video limit $pageSql,$pageSize";
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
                    <li class="active"><span style="color:orangered"><u>讲解管理</u></span></li>
                    <li><a href="approvedExplain.php">已审核</a></li>
                    <li><a href="disapprovedExplain.php">未过审</a></li>
                    <li><a href="unhandledExplain.php">待审核</a></li>
                </ol>
            </div>
            <div class="searchContent">
                <form class="bs-example bs-example-form" role="form" id="search" action="searchExplain.php" method="post">
                    <div class="col-lg-12" id="searchBorder">
                        <select class="form-control" name="op" id="choiceBorder">
                            <option value="vid_id">讲解编号</option>
                            <option value="user_id">用户编号</option>
                            <option value="mus_name">博物馆名称</option>
                            <option value="vid_info">内容简介</option>
                        </select>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="请输入需要搜索的内容" name="content">
                            <span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						搜索
					</button>
				</span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </form>
                <a href="addExplain.php" class="btn" style="background-color: green;color: whitesmoke">添加讲解</a>
            </div>
            <div class="tableStyle">
                <table class="table table-hover table-bordered" id="showMag">
                    <tr>
                        <td>讲解编号</td>
                        <td>用户编号</td>
                        <td>博物馆名称</td>
                        <td>讲解内容</td>
                        <td>内容简介</td>
                        <td>审核状态</td>
                        <td>审核人员</td>
                        <td>操作选项</td>
                    </tr>
                    <?php
                    if (1) {
                        foreach($array as $v) {
                            ?>
                            <tr>
                                <td><?=$v["vid_id"]?></td>
                                <td><?=$v["user_id"]?></td>
                                <td><?=$v["mus_name"]?></td>
                                <td><audio src="<?=$v["vid_addr"]?>" controls="controls"></audio></td>
                                <td><textarea style="height:150px;resize: none;background-color: white;border: white" readonly="readonly"><?=$v["vid_info"]?></textarea></td>
                                <td>
                                    <?php
                                    $vstatus=$v["vid_status"];
                                    if($vstatus==1){
                                        ?>未审核<?php
                                    }else if($vstatus==2){
                                        ?>未过审<?php
                                    }else{
                                        ?>已审核<?php
                                    }
                                    ?>
                                </td>
                                <td class="style_150px"><?=$v["exa_id"]?></td>
                                <td>
                                    <?php
                                    if($vstatus==1){
                                        ?><a type='submit' class='btn' style="background-color: red;margin-top: 13px" href=deleteExplain.php?vid=<?=$v["vid_id"]?>><span style="color: whitesmoke">删除</span></a>
                                        <br>
                                        <a type='submit' class='btn' style="background-color: darkorange;margin-top: 10px" href=modifyExplain.php?vid=<?=$v["vid_id"]?>><span style="color: whitesmoke">修改</span></a>
                                        <br>
                                        <a type='submit' class='btn' style="background-color:blue;margin-top: 10px" href=examineExplain.php?vid=<?=$v["vid_id"]?>><span style="color: whitesmoke">审核</span></a>
                                        <?php
                                    }else{
                                        ?><a type='submit' class='btn' style="background-color: red;margin-top: 13px" href=deleteExplain.php?vid=<?=$v["vid_id"]?>><span style="color: whitesmoke">删除</span></a>
                                        <br>
                                        <a type='submit' class='btn' style="background-color: darkorange;margin-top: 10px" href=modifyExplain.php?vid=<?=$v["vid_id"]?>><span style="color: whitesmoke">修改</span></a>
                                        <br>
                                        <a type='submit' class='btn' style="background-color: deepskyblue;margin-top: 10px" href=detail.php?vid=<?=$v["vid_id"]?>><span style="color: whitesmoke">详情</span></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }}
                    ?>
                </table>
                <!-- 页码 -->
                <div>
                    <nav aria-label="Page navigation" style="text-align: center;">
                        <ul class="pagination" id="pageNum">
                            <li>
                                <a href="?page=<?php echo $pageVal==1?1:($pageVal-1)?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            if($pageVal<5){
                                $finalpage=7;
                                for($i=1;$i<8&&$i<$pageNum+1;$i++){
                                    ?>
                                    <li><a href="?page=<?php echo $i?>"><?php echo $i;?></a></li>
                                    <?php
                                }
                            }elseif ($pageVal>$pageNum-3){
                                $finalpage=$pageNum;
                                for($i=$pageNum-6;$i<$pageNum+1;$i++){
                                    ?>
                                    <li><a href="?page=<?php echo $i?>"><?php echo $i;?></a></li>
                                    <?php
                                }
                            }
                            else{
                                $finalpage=$pageVal+3;
                                for ($i=$pageVal-3;$i<$pageVal+4; $i++) {
                                    ?>
                                    <li><a href="?page=<?php echo $i?>"><?php echo $i;?></a></li>
                                    <?php
                                }
                            }
                            ?>
                            <li>
                                <a href="?page=<?php echo $pageVal==$pageNum?$pageNum:($pageVal+1)?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
        <!-- 内容结束 -->
    </div>
</body>
</html>