<?php

@session_start();

//取得發布的文章資料
function get_publish_article()
{
    $datas = array();
    $sql = "SELECT * FROM `article` WHERE `publish` = 1;";

    //$_SESSION['link'] 在db.php定義
    $query = mysqli_query($_SESSION['link'],$sql);

    if($query)
    {
        if(mysqli_num_rows($query)>0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $datas[] = $row;
            }
        }

        mysqli_free_result($query);
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    return $datas;
}


//取得發布的文章資料
function get_article($id)
{
    $result = null;
    $sql = "SELECT * FROM `article` WHERE `publish` = 1 AND `id`={$id};";

    //$_SESSION['link'] 在db.php定義
    $query = mysqli_query($_SESSION['link'],$sql);

    if($query)
    {
        if(mysqli_num_rows($query)==1)
        {
            $result = mysqli_fetch_assoc($query);            
        }
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    return $result;
}


//取得發布的文章資料
function get_publish_work()
{
    $datas = array();
    $sql = "SELECT * FROM `works` WHERE `publish` = 1;";

    //$_SESSION['link'] 在db.php定義
    $query = mysqli_query($_SESSION['link'],$sql);

    if($query)
    {
        if(mysqli_num_rows($query)>0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $datas[] = $row;
            }
        }

        mysqli_free_result($query);
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    return $datas;
}

//取得所有文章資料
function get_all_article()
{
    $datas = array();
    $sql = "SELECT * FROM `article` ;";

    //$_SESSION['link'] 在db.php定義
    $query = mysqli_query($_SESSION['link'],$sql);

    if($query)
    {
        if(mysqli_num_rows($query)>0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $datas[] = $row;
            }
        }

        mysqli_free_result($query);
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    return $datas;
}

//取得特定文章資料
function get_edit_article($id)
{
    $sql = "SELECT * FROM `article` WHERE`id`={$id} ;";

    //$_SESSION['link'] 在db.php定義
    $query = mysqli_query($_SESSION['link'],$sql);

    if($query)
    {
        if(mysqli_num_rows($query)==1)
        {
            $result = mysqli_fetch_assoc($query);            
        }

        mysqli_free_result($query);
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    return $result;
}

//取得所有的會員
function get_all_member()
{
  //宣告空的陣列
  $datas = array();

  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `user` ORDER BY `id` DESC;"; // ORDER BY `create_date` DESC 代表是排序，使用 `create_date` 這欄位， DESC 是從最大到最小(最新到最舊)

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
    if (mysqli_num_rows($query) > 0)
    {
      //取得的量大於0代表有資料
      //while迴圈會根據查詢筆數，決定跑的次數
      //mysqli_fetch_assoc 方法取得 一筆值
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //釋放資料庫查詢到的記憶體
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $datas;
}


/**
 * 取得單個會員
 */
function get_user($id)
{
  //宣告要回傳的結果
  $result = null;

  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `user` WHERE `id` = {$id};";

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

/**
 * 取得所有的文章
 */
function get_all_work()
{
  //宣告空的陣列
  $datas = array();

  //將查詢語法當成字串，記錄在$sql變數中
  $sql = "SELECT * FROM `works` ORDER BY `upload_date` DESC;"; // ORDER BY `create_date` DESC 代表是排序，使用 `create_date` 這欄位， DESC 是從最大到最小(最新到最舊)

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
    if (mysqli_num_rows($query) > 0)
    {
      //取得的量大於0代表有資料
      //while迴圈會根據查詢筆數，決定跑的次數
      //mysqli_fetch_assoc 方法取得 一筆值
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //釋放資料庫查詢到的記憶體
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $datas;
}



?>