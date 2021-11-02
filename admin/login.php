<?php
require_once '../php/db.php';

if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
{
    header("Location: index.php");
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

</head>

<body style="padding-top: 50px;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center">後台登入</h1>                    
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <form class="form-horizontal" id="login_form" method="post" action="">
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Id</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="login_username" name="username" placeholder="請輸入帳號" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" id="login_password" name="password" placeholder="請輸入密碼" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default">登入</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src='../js/jquery-1.12.4.min.js'></script>

    <script>

    $(document).on("ready", function() {

        //當表單 sumbit 出去的時候
        $("#login_form").on("submit", function(){

            $.ajax({
                type : "POST",
                url : "../php/verify_user.php",
                data : {
                    un : $("#login_username").val(),
                    pw : $("#login_password").val()
                },
                dataType : 'html' 
            }).done(function(data) {
                if(data == "yes")
                {
                    window.location.href="index.php";
                }
                else
                {
                    alert("登入失敗");
                }
    
            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert("有錯誤產生，請看 console log");
                console.log(jqXHR.responseText);
            });
            
            return false;
        });
    });
    
    </script>

</body>
</html>