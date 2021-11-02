<?php

require_once "db.php";

//檢查資料庫有無該使用者名稱
function check_has_username($username)
{
  $result = null;

  $sql = "SELECT * FROM `user` WHERE `username` = '{$username}';";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
    if (mysqli_num_rows($query) >= 1)
    {
      //取得的量大於0代表有資料
      $result = true;
     
    }

    //釋放資料庫查詢到的記憶體
    mysqli_free_result($query);
    
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  return $result;
}


$check = check_has_username($_POST['n']);

if($check)
{
    echo "no";
}
else
{
    echo 'yes';	
}
 


?>