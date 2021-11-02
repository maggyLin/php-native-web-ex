<?php 
require_once 'db.php';

function add_article($title, $category, $content, $publish)
{
    $result = null;
   
    //建立現在的時間
    $create_date = date("Y-m-d H:i:s");
    //內容處理html
    $content = htmlspecialchars($content);
    //取得登入者的id
	$creater_id = $_SESSION['login_user_id'];
    
    $sql = "INSERT INTO `article` (`title`, `category`, `content`, `publish`, `create_date`, `user_id`)
  			VALUE ('{$title}', '{$category}', '{$content}', {$publish}, '{$create_date}', '{$creater_id}');";

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

$add_result = add_article($_POST['title'], $_POST['category'], $_POST['content'], $_POST['publish']);

if($add_result)
{
    echo "yes";
}
else
{
    echo "no";
}

?>