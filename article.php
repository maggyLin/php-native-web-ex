<?php 
require_once 'php/db.php';
require_once 'php/functions.php';

$data=get_article($_GET['i']);

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
                    <?php if(!empty($data)):?>
                        <h3><?php echo $data['title'];?></h3>
                        <hr>
                        <span class="label label-warning"><?php echo $data['category'];?></span>
                        <span class="label label-success"><?php echo $data['create_date'];?></span>
                        <br>
                        <p><?php echo $data['content'];?></p>
                    <?php else: ?>
                        <h3 class="text-center">無此篇文章</h3>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>


    <script src='js/jquery-1.12.4.min.js'></script>
    <script src="js/menuSidebar.js"></script>

</body>
</html>