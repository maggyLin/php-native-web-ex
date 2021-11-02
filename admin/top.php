<?php

$current_file = $_SERVER['PHP_SELF'];
$current_file = basename($current_file , ".php");

$showTitle ="";

switch ($current_file) {
	case 'article_list':
	case 'article_edit':
    case 'article_add':
        $index = 1;
        $showTitle = "文章管理";
		break;
    case 'work_list':
    case 'work_edit':
    case 'work_add':
        $showTitle = "作品管理";
		$index = 2;
		break;
    case 'member_list':
    case 'member_edit':
    case 'member_add':
        $showTitle = "會員管理";
		$index = 3;
		break;
    default:
        $showTitle = "後台首頁";
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
                    <li><a href="../">回前台首頁</a></li>
                    <li <?php echo ($index == 0)?'class="active"':'';?>><a href="index.php">後台首頁</a></li>
                    <li <?php echo ($index == 1)?'class="active"':'';?>><a href="article_list.php">文章管理</a></li>
                    <li <?php echo ($index == 2)?'class="active"':'';?>><a href="work_list.php">作品管理</a></li>
                    <li <?php echo ($index == 3)?'class="active"':'';?>><a href="member_list.php">會員管理</a></li>
                    <li><a href="../php/logout.php">登出</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center"><?php echo($showTitle); ?></h1>                    
        </div>
    </div>
</div>
