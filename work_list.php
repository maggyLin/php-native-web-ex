<?php 
require_once 'php/db.php';
require_once 'php/functions.php';

$datas=get_publish_work();
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
                <div class="col-xs-12 col-sm-6">

                    <?php 
                    if(!empty($datas)): 
                    foreach($datas as $work):
                    ?>
                    
                    <div class="thumbnail">
                        <img src="<?php echo $work['image_path']; ?>">
                        <div class="caption">
                            <p><?php echo $work['intro'] ?></p>
                        </div>
                    </div>

                    <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>


    <script src='js/jquery-1.12.4.min.js'></script>
    <script src="js/menuSidebar.js"></script>

</body>
</html>