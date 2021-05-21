<?php
session_start();
require_once("../dadb.php");
//
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
  		$user_id=$row["user_id"];
	  	$user_phone=$row["user_phone"];
	  	$user_pic=$row["user_pic"];
	  	$user_gender=$row["user_gender"];
	  	$user_site=$row["user_site"];
	  	$user_level=$row["user_level"];
  	}	
  	// 查询未处理事项
  	$sql2="SELECT * from Video where vid_status='1' limit 5";
  	$res2=$conn->query($sql2);
  		$array2=array();
  	if ($res2) {
		while ($sqll=mysqli_fetch_array($res2)) {
			$array2[]=$sqll;
		}
	}else{
		echo '<script>alert("查询未处理事项出现错误！");</script>';
	}


	//分页
$pageSize = 3;//每一页面内容大小
$res3="select * from Comment where user_id='$user_id'";
$sql3=$conn->query($res3);
$num=mysqli_num_rows($sql3);
$pageNum=ceil($num/$pageSize);//取整函数，向上取整；
// $pageVal=empty($_GET['page'])?1:$_GET['page'];
if(isset($_GET['page'])&&$_GET['page']>1&&$_GET['page']<=$pageNum){
	$pageVal=$_GET['page'];
}else{
	$pageVal=1;
}
$pageSql=($pageVal-1)*$pageSize;//当前开始查询的位置

$array3=array();
	$sql="SELECT * from Comment  where  user_id='$user_id' order by com_time DESC  limit $pageSql,$pageSize";
	$res=$conn->query($sql);
	if ($res) {
		while ($sqll=mysqli_fetch_array($res)) {
			$array3[]=$sqll;
		}
		// var_dump($array);
		if ($array3==null) {
			// echo '<script>alert("用户表为空");</script>';
		}
	}else{
		echo '<script>alert("查询失败");history.go(-1);</script>';
	}
  	// 查评论
  	// $sql2="SELECT * from comment where user_id='$user_id' order by com_time DESC";
  	// $res2=$conn->query($sql2);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>后台管理子系统</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../index.css">
	<link rel="stylesheet" type="text/css" href="user.css">
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
		<span><a href="quit.php" class="Astyle">退出</a></span>
	</div>
</nav>
<!-- 内容，在这里添加对应页面的代码 -->

<div id="mainWrapper">
	<div class="path" id="pathStyle">
		<ol class="breadcrumb" id="breadcrumb">
		  <li><a href="../index.php">后台管理</a></li>
		  <li><a href="user.php">用户管理</a></li>
		  <li class="active" >用户个人中心</li>
		</ol>
	</div>
	<div class="information">
		<div class="firstInfor" id="firstInfor">
			<img src="images/<?=$user_pic?>" class="infoFigure">
			<div class="infoIdentify">
				管理员
			</div>
		</div>
		<div class="secondInfor">
			<span class="infoName">
				<?= $user_name ?>
			</span>
			<span>
				手机 <?= $user_phone ?>
			</span>
			<span>
				性别 <?= $user_gender ?>
			</span>
			<span class="infoSite">
				住址 <?= $user_site ?>
			</span>
		</div>
	</div>
	<div class="handleWork">
		<p>待办事项</p>
		<table class="table">
			<tr>
				<?php
				$num=0;
				foreach($array2 as $v){
					$num++;
					if ($num==4) {
						break;
					}
			?>
			<tr>
				<td>
					<div style="width: 240px">讲解：<?=$v["vid_name"]?></div>
				</td>
				<td><a type='submit' href=ExplainManage/examineExplain.php?vid=<?=$v["vid_id"]?>>待审核</a></td>
			</tr>
			</tr>
			<?php }?>
		</table>
	</div>
	<div class="operatorDiary">
		<h2>评论</h2>
		<table class="table table-striped">
			<tr>
				<td>
					博物馆id
				</td>
				<td>
					博物馆名称
				</td>
				<td>
					评分
				</td>
				<td>
					评论内容
				</td>
				<td>
					评论时间
				</td>
			</tr>
		  <?php 
				foreach($array3 as $v){
		  	?>
		  	<tr>
		  		<td><?=$v["mus_id"]?></td>
		  		<td><?=$v["mus_name"]?></td>
		  		<td><?=$v["com_grade"]?></td>
		  		<td class="textAreaStyle"><textarea id="textAreaStyle"><?=$v["com_info"]?></textarea></td>
		  		<td><?=$v["com_time"]?></td>
		  	</tr>
		  <?php }?>
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
		    	for ($i=1; $i<=$pageNum ; $i++) { 
		    		?>
		    		<li><a href="?page=<?php echo $i?>"><?php echo $i;?></a></li>
		    		<?php
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
</div>
<!--内容结束  -->
</div>
</body>
</html>