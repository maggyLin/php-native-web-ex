<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
    header("Location: login.php");
}

$data = get_edit_article($_GET["i"]);

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
    <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form id="article">
                    <div class="form-group">
                        <label for="article_title" >Title</label>
                        <input type="text" class="form-control" id="article_title" value="<?php echo $data["title"]?>">
                    </div>
                    <div class="form-group">
                        <label for="article_category" >category</label>
                        <select class="form-control"  id="article_category">
                            <option value="news" <?php echo ($data["category"]=='news')?'selected':''?> >news</option>
                            <option value="experience" <?php echo ($data["category"]=='experience')?'selected':''?>  >experience</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article_content" >content</label>
                        <textarea class="form-control" rows="5" id="article_content"><?php echo $data["content"]?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"> <input type="radio" name="article_public" value="1" <?php echo ($data["publish"]== 1)?'checked':''?> > public </label>
                        <label class="radio-inline"> <input type="radio" name="article_public" value="0" <?php echo ($data["publish"]== 0)?'checked':''?>> hide </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src='../js/jquery-1.12.4.min.js'></script>
    <script src="../js/menuSidebar.js"></script>

    <script>
        
        $(document).on("ready", function(){
            $("#article").on("submit",function(){
                //????????????????????????
                if($("#article_title").val()=="" || $("#article_content").val()=="")
                {
                    alert("???????????????");
                }
                else
                {    
                    $.ajax({
                        type : "POST",
                        url : "../php/update_article.php",
                        data : {
                            title : $("#article_title").val(),
                            category : $("#article_category").val(),
                            content : $("#article_content").val(),
                            publish : $("input[name='article_public']:checked").val(),
                            id : <?php echo $data["id"]?>
                        },
                        dataType : 'html' 
                    }).done(function(data) {
                        if(data == "yes")
                        {   
                            alert("????????????");
                            window.location.href="article_list.php";
                        }
                        else
                        {
                            alert("????????????");
                        }
            
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        alert("???????????????????????? console log");
                        console.log(jqXHR.responseText);
                    });
                    
                    return false;

                }

            });
        });
    
    
    </script>

</body>
</html>