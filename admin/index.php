<?php
require_once '../php/db.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <title>myWeb</title>

    <link rel='stylesheet prefetch' href='../css/bootstrap.min.css'>
    <link rel="stylesheet" href="../css/menuSidebar.css">
    <link rel="stylesheet" href="../css/bootstrapNavBar_Blue.css">

</head>

<body style="padding-top: 50px;">
    <?php include_once 'top.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info" role="alert">welcome to my web backend!</div>
            </div>
        </div>
    </div>

    <script src='../js/jquery-1.12.4.min.js'></script>
    <script src="../js/menuSidebar.js"></script>

</body>
</html>