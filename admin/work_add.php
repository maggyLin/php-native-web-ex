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
    <br>
    <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form id="work">
                    <div class="form-group">
                        <label for="intro" >Introduce</label>
                        <textarea class="form-control" rows="5" id="intro"></textarea>
                    </div>
                    <div class="form-group">
                        <label >圖片上傳</label>
                        <input type="file" name="image_path" accept="image/gif, image/jpeg, image/png">
                        <input type="hidden" id="image_path" value="">
                        <div  class="image"></div>
                        <a href='javascript:void(0);' class="del_image btn btn-default">刪除照片</a>
                    </div>
                    <div class="form-group">
                        <label for="category">影片上傳</label>
                        <input type="file" name="video_path" accept="video/mp4">
                        <input type="hidden" id="video_path" value="">
                        <div class="video"></div>
                        <a href='javascript:void(0);' class="del_video btn btn-default">刪除影片</a>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"> <input type="radio" name="public" value="1" checked > public </label>
                        <label class="radio-inline"> <input type="radio" name="public" value="0"> hide </label>
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
            //圖片上傳
            $("input[name='image_path']").on("change",function(){
              
                var file_data = new FormData(),
                    file_name = $(this)[0].files[0],
                    save_path = "files/images/";

                file_data.append("file", file_name);
                file_data.append("save_path", save_path); 

                $.ajax({
                    type : 'POST',
                    url : '../php/upload_file.php',
                    data : file_data,
                    cache : false, //因為只有上傳檔案，所以不要暫存
                    processData : false, //因為只有上傳檔案，所以不要處理表單資訊
                    contentType : false, //送過去的內容，由 FormData 產生了，所以設定false
                    dataType : 'html'
                }).done(function(data) {
                    //console.log(data);
                    //上傳成功
                    if (data == "yes") {
                    //將檔案插入
                   // $("div.image").html("<img src='../" + save_path + file_name['name'] + "'>");
                    //給予 #image_path 值，等等存檔時會用
                    $("#image_path").val(save_path + file_name['name']);
                    } else {
                    //警告回傳的訊息
                    alert(data);
                    }

                }).fail(function(data) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });      


            });

            //圖片刪除
            $("a.del_image").on("click", function() {
            //如果有圖片路徑，就刪除該檔案
            if ($("#image_path").val() != '') {
                //透過ajax刪除
                $.ajax({
                type : 'POST',
                url : '../php/del_file.php',
                data : {
                    "file" : $("#image_path").val()
                },
                dataType : 'html'
                }).done(function(data) {
                console.log(data);
                //上傳成功
                if (data == "yes") {
                    //將圖片標籤移除，並清空目前設定路徑
                   // $("div.image").html("");
                    //給予 #image_path 值，等等存檔時會用
                    $("#image_path").val('');
                    $("input[name='image_path']").val('');
                } else {
                    //警告回傳的訊息
                    alert(data);
                }

                }).fail(function(data) {
                //失敗的時候
                alert("有錯誤產生，請看 console log");
                console.log(jqXHR.responseText);
                });
            } else {
                alert("無檔案可以刪除");
            }
            });


            //video上傳
            $("input[name='video_path']").on("change", function() {
                //產生 FormData 物件
                var file_data = new FormData(),
                    file_name = $(this)[0].files[0],
                    save_path = "files/videos/";

                    console.log($(this)[0].files[0]);
                    console.log(file_name['name']);
                    console.log(file_name['tmp_name']);
                //在影片區塊，顯示loading
                $("div.video").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

                //FormData 新增剛剛選擇的檔案
                file_data.append("file", file_name);
                file_data.append("save_path", save_path);

                //console.log(file_data["file"]);
                
                //透過ajax傳資料
                $.ajax({
                    type : 'POST',
                    url : '../php/upload_file.php',
                    data : file_data,
                    cache : false, //因為只有上傳檔案，所以不要暫存
                    processData : false, //因為只有上傳檔案，所以不要處理表單資訊
                    contentType : false, //送過去的內容，由 FormData 產生了，所以設定false
                    dataType : 'html'
                }).done(function(data) {
                    console.log(data);
                    //上傳成功
                    if (data == "yes") {
                    //將檔案插入
                    $("div.video").html("<video src='../" + save_path + file_name['name'] + "' controls>");
                    //給予 #image_path 值，等等存檔時會用
                    $("#video_path").val(save_path + file_name['name']);
                    } else {
                    //警告回傳的訊息
                    alert(data);
                    }

                }).fail(function(data) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
                });

            //video刪除
            $("a.del_video").on("click", function() {

                if ($("#video_path").val() != '') {
                    //透過ajax刪除
                    $.ajax({
                    type : 'POST',
                    url : '../php/del_file.php',
                    data : {
                        "file" : $("#video_path").val()
                    },
                    dataType : 'html'
                    }).done(function(data) {
                    console.log(data);
                    //上傳成功
                    if (data == "yes") {
                        //將影片標籤移除，並清空目前設定路徑
                        $("div.video").html("");
                        //給予 #image_path 值，等等存檔時會用
                        $("#video_path").val('');
                        $("input[name='video_path']").val('');
                    } else {
                        //警告回傳的訊息
                        alert(data);
                    }

                    }).fail(function(data) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                    });
                } else {
                    alert("無檔案可以刪除");
                }
                });


            $("#work ").on("submit",function(){
                //判斷有無填寫資料
                if($("#intro").val()=="")
                {
                    alert("請填簡介");
                }
                else
                {    
                    $.ajax({
                        type : "POST",
                        url : "../php/add_work.php",
                        data : {
                            intro : $("#intro").val(),
                            image_path : $("#image_path").val(),
                            video_path : $("#video_path").val(),
                            publish : $("input[name='public']:checked").val()
                        },
                        dataType : 'html' 
                    }).done(function(data) {
                        if(data == "yes")
                        {   
                            alert("新增成功");
                            //window.location.href="article_list.php";
                            window.location.reload();
                        }
                        else
                        {
                            alert("新增失敗");
                        }
            
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                    
                    return false;

                }


                

            });
        });
    
    
    </script>

</body>
</html>