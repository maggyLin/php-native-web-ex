<?php
//載入資料庫與處理的方法
require_once 'db.php';


function add_work($intro, $image_path, $video_path, $publish)
{
	//宣告要回傳的結果
  $result = null;

	//內容處理html
	$intro = htmlspecialchars($intro);
	//建立者id
	$create_user_id = $_SESSION['login_user_id'];
	//上傳時間
	$upload_date = date("Y-m-d H:i:s");

  //處理圖片路徑
	$image_path_value = "'{$image_path}'";
	if($image_path == '') $image_path_value = 'NULL';

	//處理影片路徑
	$video_path_value = "'{$video_path}'";
	if($video_path == '') $video_path_value = 'NULL';

	//新增語法
  $sql = "INSERT INTO `works` (`intro`, `image_path`, `video_path`, `publish`, `upload_date`, `create_user_id`)
  				VALUE ('{$intro}', {$image_path_value}, {$video_path_value}, {$publish}, '{$upload_date}', '{$create_user_id}');";


  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
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


//判別有無在登入狀態
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//執行新增使用者的方法，直接把整個 $_POST個別的照順序變數丟給方法。
	$add_result = add_work($_POST['intro'], $_POST['image_path'], $_POST['video_path'], $_POST['publish']);
	
	if($add_result)
	{
		//若為true 代表新增成功，印出yes
		echo 'yes';
	}
	else
	{
		//若為 null 或者 false 代表失敗
		echo 'no';	
	}
}
else
{
	//若為 null 或者 false 代表失敗
	echo 'no';	
}
?>