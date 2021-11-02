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

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <form class="form-horizontal" id="register" method="post" action="php/add_memeber.php">
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Id</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" placeholder="請輸入帳號" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" id="confirm_password" placeholder="請再次輸入密碼" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nickname" class="col-sm-4 control-label">Nickname</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="請輸入暱稱" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default" id="subBtn">Sign up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src='js/jquery-1.12.4.min.js'></script>
    <script src="js/menuSidebar.js"></script>

    <script>

    $(document).on("ready", function() {

        //當keyup的時候，檢查帳號有無重複
        $("#username").on("keyup", function(){
            //取得輸入的值
            var keyin_value = $(this).val();
            
            //不是空字串的話，就檢查。
            if(keyin_value != '')
            {
                $.ajax({
                type : "POST",	
                url : "php/check_username.php",  
                data : {
                    n : $(this).val()
                },
                dataType : 'html' 
                }).done(function(data) {
                //成功的時候
                if(data == "yes")
                {
                    $("#username").parent().parent().removeClass("has-error").addClass("has-success");
                    $("#subBtn").removeClass('disabled');
                }
                else
                {
                    $("#username").parent().parent().removeClass("has-success").addClass("has-error");
                    alert("帳號有重複，不可以註冊");
                    $("#subBtn").addClass('disabled');
                }
                
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
            }
            else
            {
                //若為空字串，就移除 has-error 跟 has-success 類別
                $("#username").parent().parent().removeClass("has-success").removeClass("has-error");
            }
            
        });


        //當表單 sumbit 出去的時候
        $("#register").on("submit", function(){

            //如果密碼與驗證密碼不一樣
            if ($("#password").val() != $("#confirm_password").val()) {
                //把 input 的父標籤 加入 has-error，讓人知道哪個地方有錯誤，作為提醒
                //為何要在父類別加has-error，請看 http://getbootstrap.com/css/#forms-control-validation
                $("#password").parent().parent().addClass("has-error"); 
                $("#confirm_password").parent().addClass("has-error"); 
                
                alert("兩次密碼輸入不一樣，請確認");
            }
            else
            {
                $.ajax({
                    type : "POST",
                    url : "php/add_user.php",
                    data : {
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
                        alert("註冊成功");
                        //window.location.href="admin/login.php";
                    }
                    else
                    {
                        alert("註冊失敗");
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