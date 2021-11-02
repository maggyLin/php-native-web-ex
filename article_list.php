<?php 
require_once 'php/db.php';
require_once 'php/functions.php';

$datas=get_publish_article();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <title>myWeb</title>

    <link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/menuSidebar.css">
    <link rel="stylesheet" href="css/bootstrapNavBar_Blue.css">

</head>

<body style="padding-top: 50px;">
    <?php include_once 'top.php'; ?>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <?php 
                    if(!empty($datas)): 
                    foreach($datas as $article):
                    ?>
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="article.php?i=<?php echo $article['id']; ?>">
                                    <?php echo $article['title'];?>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <span class="label label-warning"><?php echo $article['category'];?></span>
                            <span class="label label-success"><?php echo $article['create_date'];?></span>
                            <br>
                            <?php
                            //去除所有html標籤
                            //$abstract = strip_tags($article['content']);
                            //取得100個字
                            //$abstract = mb_substr($abstract, 0, 100, "UTF-8");

                            //echo $abstract."...MORE";
                            echo $article['content'];
                            ?>
                        </div>
                    </div>

                    <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>


    <script src='js/jquery-1.12.4.min.js'></script>
    <script  src="js/menuSidebar.js"></script>

</body>
</html>