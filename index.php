<?php
session_start();
require_once("dadb.php");
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
	  	$user_phone=$row["user_phone"];
	  	$user_pic=$row["user_pic"];
	  	$user_gender=$row["user_gender"];
	  	$user_site=$row["user_site"];
	  	$user_level=$row["user_level"];
  	}
  	$sql2="SELECT * from Video where vid_status='1' limit 5";
  	$res2=$conn->query($sql2);
  		$array=array();
  	if ($res2) {
		while ($sqll=mysqli_fetch_array($res2)) {
			$array[]=$sqll;
		}
	}else{
		echo '<script>alert("查询未处理事项出现错误！");</script>';
	}	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>后台管理子系统</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="index.css">
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
		<a href="/jk-museum/UserManage/userCenter.php"><img src="UserManage/images/<?=$user_pic?>" class="userAvater"></a>
		<a href="backup.php" class="btn"style="background-color: cornflowerblue;color: white;margin-right: 20px;">备份数据</a>
		<span><a href="quit.php" class="Astyle">退出</a></span>
	</div>
</nav>
<!-- 内容，在这里添加对应页面的代码 -->
<div id="mainWrapper">
	<div class="information">
		<div class="firstInfor" id="firstInfor">
			<a href="/jk-museum/UserManage/userCenter.php"><img src="/jk-museum/UserManage/images/<?=$user_pic?>" class="infoFigure"></a>
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
			<?php
				$index=0;
				foreach($array as $v){
					$index++;
					if ($index==4) {
						break;
					}
			?>
			<tr>
				<td>
					讲解：<?=$v["vid_name"]?>
				</td>
				<td><a type='submit' href=ExplainManage/examineExplain.php?vid=<?=$v["vid_id"]?>>待审核</a></td>
			</tr>
		<?php }?>
		</table>
	</div>
	<div class="operatorDiary">
		<h2>操作日志</h2>
		<table class="table table-striped">
		  <tr>
		  	<td>
		  		管理员
		  	</td>
		  	<td>
		  		操作
		  	</td>
		  	<td>
		  		详细信息
		  	</td>
		  	<td>
		  		操作时间
		  	</td>
		  </tr>
		  <?php 
		  $index=1;
		  	foreach( array_reverse(glob( "operatorManage/*.log" )) as $file ) {
    			$log = new SplFileObject($file);
    			//var_dump($file);
				foreach( $log as $line){
					$index++;
					if ($index>=20) {
						break;
					}
		  			$arr=explode(" ", $line);
		  			if (!empty($arr[1])) {
		  			
		  	?>
		  	<tr>
		  		<td>
		  			<?=$arr[3]?>
		  		</td>
		  		<td>
		  			<?=$arr['4']?>
		  		</td>
		  		<td>
		  			<?=$arr['5']?>
		  		</td>
		  		<td>
		  			<?=$arr['6']?>
		  			<?=$arr[7]?>
		  		</td>
		  	</tr>
		  <?php }}}?>
		</table>
	</div>
</div>	
</div>
<!--内容结束  -->
</div>
</body>
</html>