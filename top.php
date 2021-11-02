<?php
//取得目前檔案的名稱。透過$_SERVER['PHP_SELF']先取得路徑
$current_file = $_SERVER['PHP_SELF'];
//echo $current_file; //查看目前取得的檔案完整
//然後透過 basename 取得檔案名稱，加上第二個參數".php"，主要是將取得的檔案去掉 .php 這副檔名稱
$current_file = basename($current_file , ".php");
//echo $current_file; //查看目前取得後的檔名

switch ($current_file) {
	case 'article_list':
	case 'article':
		//為文章列表或完整文章頁
		$index = 1;
		break;
	case 'work_list':
	case 'work':
		//為作品列表或完整作品頁
		$index = 2;
		break;
	case 'about':
		//為關於我們頁
		$index = 3;
		break;
	case 'register':
		//為註冊頁
		$index = 4;
		break;
	default:
		//預設索引為 0
		$index = 0;
		break;
}

?>

<!-- Nav Bar  -->
<nav class="navbar navbar-default navbar-static-top navbar-fixed-top sidebarNavigation" data-sidebarClass="navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle left-navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                    <li <?php echo ($index == 0)?'class="active"':'';?>><a href="./">Home</a></li>
                    <li <?php echo ($index == 1)?'class="active"':'';?>><a href="article_list.php">artical</a></li>
                    <li <?php echo ($index == 2)?'class="active"':'';?>><a href="work_list.php">works</a></li>
                    <li <?php echo ($index == 3)?'class="active"':'';?>><a href="about.html">about me</a></li>
                    <li <?php echo ($index == 4)?'class="active"':'';?>><a href="register.php">sign up</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="jumbotron">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="text-center">My Web</h1>                    
			</div>
		</div>
	</div>
</div>