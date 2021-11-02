<?php 
require_once 'db.php';

function add_article($title, $category, $content, $publish, $id)
{
    $result = null;
   
    //建立現在的時間
    $modify_date = date("Y-m-d H:i:s");
    //內容處理html
    $content = htmlspecialchars($content);
    
    $sql = "UPDATE `article` SET `title` = '{$title}', `category` = '{$category}', `content` = '{$content}', `publish` = {$publish}, `modify_date` = '{$modify_date}'  WHERE `id` = {$id};";

    //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
    $query = mysqli_query($_SESSION['link'], $sql);

    //如果請求成功
    if ($query)
    {
        //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
        if(mysqli_affected_rows($_SESSION['link']) == 1)
        {
            $result = true;
        }
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    //回傳結果
    return $result;
}

$add_result = add_article($_POST['title'], $_POST['category'], $_POST['content'], $_POST['publish'], $_POST['id']);

if($add_result)
{
    echo "yes";
}
else
{
    echo "no";
}

?>