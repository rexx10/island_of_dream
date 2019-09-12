<?php 

	require_once("./ebook_store_config.php");
	require_once("./ebook_store_dbtools.inc.php");
	require_once('check_session.php');

if(!empty($_POST["this_mode"]))
{
	$tmp_this_mode = $_POST["this_mode"];
	$tmp_ebook_store = $_POST["ebook_store"];    //電子書商店名稱
	$tmp_ebook_store_webside = $_POST["ebook_webside"];    //電子書網址
	//date_default_timezone_set('Asia/Taipei');
    $now_date = date("Y-m-d H:i:s", strtotime("+8HOUR"));
	//$tmp_this_mode = $_GET["this_mode"];
   //$tmp_del_ebook_store = $_POST["del_store"];
  //echo  $tmp_del_ebook_store_webside = $_POST["del_store_webside"];
}
elseif(!empty($_GET["this_mode"]))
{
   $tmp_this_mode = $_GET["this_mode"];
   $tmp_del_ebook_store = $_GET["del_store"];
   //$tmp_del_ebook_store_webside = $_GET["del_store_webside"];
   $tmp_del_set_date = $_GET["del_set_date"];
}

    //判斷新增、修改、刪除模式
switch($tmp_this_mode)
{
      case"ins_mode":
	  
          $sel_sql = "SELECT * FROM $dbtable_00 WHERE ebook_store = '".mysql_real_escape_string($tmp_ebook_store)."' OR ebook_store_webside = '".mysql_real_escape_string($tmp_ebook_store_webside)."'";
	      $result_sel = mysql_query($sel_sql) or die("失敗0");
		  if(mysql_num_rows($result_sel) > 0)
		  {
		      mysql_free_result($result_sel);
					
			      //顯示無法上傳
			  echo "<script type='text/javascript'>";
			  echo "alert('注意！廠商名稱或電子書網址有重複!');";
			  echo "history.back();";
			  echo "</script>";
			  
		  }
		  else
		  {		  
		      $ins_sql = "INSERT INTO $dbtable_00 (ebook_store, ebook_store_webside, ebook_set_date) VALUES ('".mysql_real_escape_string($tmp_ebook_store)."', '".mysql_real_escape_string($tmp_ebook_store_webside)."', '$now_date')";
		      echo $result_ins = mysql_query($ins_sql) or die("失敗1");
		      if(mysql_num_rows($result_ins) == "0")
		      {
		          mysql_free_result($result_ins);
					 //顯示無法上傳
			      echo "<script type='text/javascript'>";
			      echo "alert('資料寫入失敗！請聯絡程式設計師!');";
			      echo "history.back();";
			      echo "</script>";
			      
		      
		      }
		      else
		      {
		          mysql_free_result($result_ins);
			      header("location:ebook_store_index.php");
			        // break;
		   
		      }
		  }
		  break;
	  case"up_mode":
	      break;
	  case"del_mode":
	      
		  $del_sql = "DELETE FROM $dbtable_00 WHERE ebook_store = '".mysql_real_escape_string($tmp_del_ebook_store)."' AND ebook_set_date = '".mysql_real_escape_string($tmp_del_set_date)."'";
	      mysql_query($del_sql) or die("失敗d");
		  echo $sel_sql = "SELECT * FROM $dbtable_00 WHERE ebook_store = '".mysql_real_escape_string($tmp_del_ebook_store)."' AND ebook_set_date = '".mysql_real_escape_string($tmp_del_set_date)."'";
	      $result_sel = mysql_query($sel_sql) or die("失敗0");
	      if(mysql_num_rows($result_sel) < 1)
		  {
		      mysql_free_result($result_sel);
			  header("location:ebook_store_index.php");
		  }
		  else
		  {
		      mysql_free_result($result_sel);
					
			      //顯示無法上傳
			  echo "<script type='text/javascript'>";
			  echo "confirm('刪除失敗！請聯絡程式設計師!');";
			  echo "history.back();";
			  echo "</script>";
		  		  
		  }
	      break;


}



?>