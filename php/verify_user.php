<?php
require_once "db.php";

function verify_user($username, $password)
{
  $result = null;
  $password = md5($password);

  $sql = "SELECT * FROM `user` WHERE `username` = '{$username}' AND `password` = '{$password}'";

  $query = mysqli_query($_SESSION['link'], $sql);

  if ($query)
  {
    if(mysqli_num_rows($query) == 1)
    {
      //取得使用者資料
      $user = mysqli_fetch_assoc($query);

      //在session李設定 is_login 並給 true 值，代表已經登入
      $_SESSION['is_login'] = TRUE;
      $_SESSION['login_user_id'] = $user['id'];

      $result = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }
  return $result;
}


$check = verify_user($_POST['un'],$_POST['pw']);

if($check)
{
    echo "yes";
}
else
{
    echo 'no';	
}
 


?>