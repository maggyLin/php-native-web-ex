<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
    header("Location: login.php");
}

$data = get_user($_GET["i"]);

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
    <br>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <form class="form-horizontal" id="register" method="post" action="php/add_memeber.php">
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">username</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $data["username"]?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼">
                        <label >如不需修改密碼請留白</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" id="confirm_password" placeholder="請再次輸入密碼">
                        <label >如不需修改密碼請留白</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nickname" class="col-sm-4 control-label">Nickname</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $data["name"]?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default">submit</button>
                        </div>
                    </div>
                </form>

                
            </div>
        </div>
    </div>

    <script src='../js/jquery-1.12.4.min.js'></script>
    <script src="../js/menuSidebar.js"></script>

    <script>
        
        $(document).on("ready", function(){
            
            $("#register").on("submit", function(){

                //如果密碼與驗證密碼不一樣
                if ($("#password").val() != $("#confirm_password").val()) {
                    $("#password").parent().parent().addClass("has-error"); 
                    $("#confirm_password").parent().addClass("has-error"); 
                    alert("兩次密碼輸入不一樣，請確認");
                }
                else
                {
                    $.ajax({
                        type : "POST",
                        url : "../php/update_user.php",
                        data : {
                            id : <?php echo $data["id"]?>,
                            un : $("#username").val(),
                            pw : $("#password").val(), 
                            n : $("#nickname").val() 
                        },
                        dataType : 'html' 
                    }).done(function(data) {
                        //成功的時候
                        console.log(data);
                        if(data == "yes")
                        {
                            alert("更新成功");
                            window.location.href="member_list.php";
                        }
                        else
                        {
                            alert("更新失敗");
                        }
            
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                }
            
                return false;
            });
        });
    
    
    </script>

</body>
</html>