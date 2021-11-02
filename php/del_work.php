<?php
@session_start();
//載入資料庫與處理的方法
require_once 'db.php';

function get_work($id)
{
  //宣告要回傳的結果
  $result = null;

  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `works` WHERE `publish` = 1 AND `id` = {$id};";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
    if (mysqli_num_rows($query) == 1)
    {
      //取得的量大於0代表有資料
      //while迴圈會根據查詢筆數，決定跑的次數
      //mysqli_fetch_assoc 方法取得 一筆值
      $result = mysqli_fetch_assoc($query);
    }

    //釋放資料庫查詢到的記憶體
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $result;
}

function del_work($id)
{
	//宣告要回傳的結果
  $result = null;

	//先取得該作品資訊，作為之後要刪除檔案用，此用本檔案中的 get_work 方法來取得作品資訊。
	$work = get_work($id);

	if($work)
	{
		//有作品才進行刪除工作
		//若有圖檔資料，以及圖檔有存在，就刪除
		// if($work['image_path'] && file_exists("../".$work['image_path']))
		// {
		// 	//unlink 為刪除檔案的方法，把上一層找到 files/ 裡面的檔案，做刪除
		// 	unlink("../".$work['image_path']);
		// }

		// //若有影片檔資料，以及影片檔有存在，就刪除
		// if($work['video_path'] && file_exists("../".$work['video_path']))
		// {
		// 	//unlink 為刪除檔案的方法，把上一層找到 files/ 裡面的檔案，做刪除
		// 	unlink("../".$work['video_path']);
		// }

		//刪除作品語法
	  $sql = "DELETE FROM `works` WHERE `id` = {$id};";

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


	}

  //回傳結果
  return $result;
}


//判別有無在登入狀態
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){

	//執行新增使用者的方法，直接把整個 $_POST個別的照順序變數丟給方法。
    $del_result = del_work($_POST['id']);
    
    echo($del_result);
	
	if($del_result)
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