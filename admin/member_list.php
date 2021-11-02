<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
    header("Location: login.php");
}

$datas  = get_all_member();

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
    <link rel="stylesheet" href="../css/style.css">

</head>

<body style="padding-top: 50px;">
    <?php include_once 'top.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="member_add.php" class="btn btn-warning" role="button">新增會員</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-hover">
                    <tr>
                        <th>num</th>
                        <th>id</th>
                        <th>name</th>
                        <th>管理動作</th>
                    </tr>

                    <?php if(!empty($datas)): ?>
                        <?php foreach($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["id"]; ?></td>
                            <td><?php echo $data["username"]; ?></td>
                            <td><?php echo $data["name"]; ?></td>
                            <td><a class='btn btn-success' href='member_edit.php?i=<?php echo $data["id"];?>' role='button'>編輯</a>
                                <a class='btn btn-danger del_article' href='javascript:void(0);' role='button' data-id="<?php echo $data["id"];?>">刪除</a></td>
                        </tr>
                        <?php endforeach;  ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5">無資料</td>
                        </tr>
                        
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <script src='../js/jquery-1.12.4.min.js'></script>
    <script src="../js/menuSidebar.js"></script>

    <script>
        $(document).on("ready", function(){
            $(".del_article").on("click",function(){
                var c = confirm("Are you sure to delay the member?");
                
                if(c)
                {
                    $.ajax({
                        type : "POST",
                        url : "../php/del_member.php",
                        data : {
                            id : $(this).attr("data-id")  //h5以後可以自己設定attr
                        },
                        dataType : 'html' 
                    }).done(function(data) {
                        if(data == "yes")
                        {   
                            alert("刪除成功");
                            window.location.reload();
                        }
                        else
                        {
                            alert("刪除失敗");
                        }
            
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                    
                }
        
            });

            
        });
    
    </script>

</body>
</html>