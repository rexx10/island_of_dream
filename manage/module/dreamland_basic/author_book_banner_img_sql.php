<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
</head>
<body>
<?php 
	require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');

	$author_book_banner_image_code = $_POST["author_book_banner_image_code"];
	$author_book_img_type = $_POST["author_book_img_type"];
	
	if($_FILES["author_img"]["name"] != "")   //檢查是否選擇圖檔
	{
		switch($_FILES["author_img"]["type"])
		{
			case"image/jpeg":
				$tmp_src = imagecreatefromjpeg($_FILES["author_img"]["tmp_name"]);
			    break;
			case"image/gif":
				$tmp_src = imagecreatefromgif($_FILES["author_img"]["tmp_name"]);
			    break;
			case"image/png":
				$tmp_src = imagecreatefromjpeg($_FILES["author_img"]["tmp_name"]);
			    break;
			default:
					//顯示訊息
				   echo "<script type='text/javascript'>";
				   echo "alert('抱歉！不支援此格式!');";
				   echo "history.back();";
				   echo "</script>";
			
		}	
		$tmp_src_w = imagesx($tmp_src);  //取得圖片寬度
		$tmp_src_h = imagesy($tmp_src);	 //取得圖片高度
		if($tmp_src_w != 500 or $tmp_src_h != 270)
		{
			if($tmp_src_w > $tmp_src_h){   //縮圖判斷
				$thumb_w = 270;
				$thumb_h = intval($tmp_src_h / $tmp_src_w * 100);
			}
			else
			{
				$thumb_h = 500;
				$thumb_w = intval($tmp_src_w / $tmp_src_h * 100);
			}
		}
		else
		{
			$thumb_h = $tmp_src_h;
			$thumb_w = $tmp_src_w;
		
		}
		
		// if you are using GD 1.6.x, please use imagecreate()
		$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
 
		// start resize
		imagecopyresized($thumb, $tmp_src, 0, 0, 0, 0, $thumb_w, $thumb_h, $tmp_src_w, $tmp_src_h);
 
			// save thumbnail
		switch($_FILES["author_img"]["type"])
		{
			case"image/jpeg":
			    $sel_sql = "SELECT * FROM $dbtable_01 WHERE author_code = '$author_book_banner_image_code'";
				$result_up_sql_sel = mysql_query($sel_sql) or die("失敗1");
				$result_up_sql_sel_01 = mysql_result($result_up_sql_sel, 0, "author_banner_long_img_path");
				
				if(file_exists($result_up_sql_sel_01))
				{		//檢查是否有檔案
	
				    unlink($result_up_sql_sel_01);
						//刪除圖片
	
				}
				$tmp_author_img_file_name = "author_".$author_book_banner_image_code.".jpg";
				imagejpeg($thumb, "../../../images/sys_images/".$tmp_author_img_file_name);  //將暫存檔改名，並寫入指定位置
			    break;
			case"image/gif":
				$sel_sql = "SELECT * FROM $dbtable_01 WHERE author_code = '$author_book_banner_image_code'";
				$result_up_sql_sel = mysql_query($sel_sql) or die("失敗1");
				$result_up_sql_sel_01 = mysql_result($result_up_sql_sel, 0, "author_banner_long_img_path");
				
				if(file_exists($result_up_sql_sel_01))
				{		//檢查是否有檔案
	
					unlink($result_up_sql_sel_01);
						//刪除圖片
	
				}	
			
				$tmp_author_img_file_name = "author_".$author_book_banner_image_code.".gif";
				imagegif($thumb, "../../../images/sys_images/".$tmp_author_img_file_name);  //將暫存檔改名，並寫入指定位置
			    break;
			case"image/png":
				$sel_sql = "SELECT * FROM $dbtable_01 WHERE author_code = '$author_book_banner_image_code'";
				$result_up_sql_sel = mysql_query($sel_sql) or die("失敗1");
				$result_up_sql_sel_01 = mysql_result($result_up_sql_sel, 0, "author_banner_long_img_path");
				
				if(file_exists($result_up_sql_sel_01))
				{		//檢查是否有檔案
	
					unlink($result_up_sql_sel_01);
						//刪除圖片
	
				}
				$tmp_author_img_file_name = "author_".$author_book_banner_image_code.".png";
				imagepng($thumb, "../../../images/sys_images/".$tmp_author_img_file_name);  //將暫存檔改名，並寫入指定位置
			    break;
		}	
		
		mysql_free_result($result_up_sql_sel_01);
		$tmp_author_banner_img_path = "./images/sys_images/$tmp_author_img_file_name";  //作者圖路徑
		$tmp_author_banner_long_img_path = "../../../images/sys_images/$tmp_author_img_file_name"; //作者圖長路徑
		
		if($_FILES["author_img"]["type"] == "image/jpeg" or $_FILES["author_img"]["type"] == "image/gif" or $_FILES["author_img"]["type"] == "image/png")
		{	//如果圖檔非認可格式，將返回上一頁
			switch($author_book_img_type)
			{
				case"new_img":
					$ins_sql = "INSERT INTO $dbtable_01(author_code, author_banner_img_path, author_banner_long_img_path) VALUES('$author_book_banner_image_code', '$tmp_author_banner_img_path', '$tmp_author_banner_long_img_path')";
					//↑寫入資料
					 $result = mysql_query($ins_sql) or die("失敗1");
					break;
				case"up_img":			
					$up_sql= "UPDATE $dbtable_01 SET author_banner_img_path = '$tmp_author_banner_img_path', author_banner_long_img_path = '$tmp_author_banner_long_img_path' WHERE author_code = '$author_book_banner_image_code'";
					$result = mysql_query($up_sql) or die("失敗1");
				    break;
			}
		
		}
		else
		{
		
			echo "<script type='text/javascript'>";
			echo "history.back();";
			echo "</script>";
			
		}
		
		$sel_sql = "SELECT * FROM $dbtable_01 WHERE author_code = '$author_book_banner_image_code' and author_banner_img_path = '$tmp_author_banner_img_path'";
			//↑檢查資料寫入是否成功
		$result_00 = mysql_query($sel_sql) or die("失敗2");
		
		$row = MySQL_fetch_array($result_00);
		$sql_author_code = mysql_result($result_00, 0, "author_code");
		if(!$row == 0)
		{
			mysql_free_result($result);
			mysql_free_result($result00);
			header("location:author_book_main_data.php?author_code=$sql_author_code");
		}
		else
		{
				//顯示訊息
			echo "<script type='text/javascript'>";
			echo "alert('寫入失敗，請聯絡管理員');";
			echo "history.back();";
			echo "</script>";
		}
			
	
	}
	else
	{
	    
 			 //顯示訊息
			echo "<script type='text/javascript'>";
			echo "alert('上傳失敗或未選擇圖片，請再次上傳');";
			echo "history.back();";
			echo "</script>";
		
	} 
?>
</body>
</html>