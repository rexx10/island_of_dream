<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
</head>
<body>
<?php
	
	require_once("./dreamland_basic_config.php");       //引入相關設定檔
	require_once("./dreamland_basic_dbtools.inc.php");  //引入資料庫模組
	require_once('check_session.php');
	
	$tmp_author_id = $_POST["author_id"];     //作者群ID
	$tmp_author_name = $_POST["author_name"]; //作者名稱
	$tmp_author_code = $_POST["author_code"]; //作者代號
	
	if($_FILES["author_code_pic"]["name"] != "")   //檢查是否選擇圖檔
	{
		
		switch($_FILES["author_code_pic"]["type"])
		{
			case "image/jpeg":
				$tmp_src = imagecreatefromjpeg($_FILES["author_code_pic"]["tmp_name"]);
			break;
			case "image/gif";
				$tmp_src = imagecreatefromgif($_FILES["author_code_pic"]["tmp_name"]);
			break;
			case "image/png";
				$tmp_src = imagecreatefrompng($_FILES["author_code_pic"]["tmp_name"]);
			break;
			case "image/bmp";
					//顯示訊息
				echo "<script type='text/javascript'>";
				echo "alert('抱歉！不支援BMP格式!');";
				echo "history.back();";
				echo "</script>";
			break;
		}	
		echo $tmp_src_w = imagesx($tmp_src);  //取得圖片寬度
		echo "<BR>";
		echo $tmp_src_h = imagesy($tmp_src);	 //取得圖片高度
		if($tmp_src_w != 150 and $tmp_src_h != 50)
		{
			if($tmp_src_w > $tmp_src_h){   //縮圖判斷
				$thumb_w = 50;
				$thumb_h = intval($tmp_src_h / $tmp_src_w * 100);
			}
			else
			{
				$thumb_h = 150;
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
 
		//$adv_desc_file_name = uniqid().".jpg";
//		$tmp_author_pic_file_name = $tmp_author_id.".jpg";
			
			// save thumbnail
		switch($_FILES["author_code_pic"]["type"])
		{
			case "image/jpeg":
				$tmp_author_pic_file_name = $tmp_author_id.".jpg";
				imagejpeg($thumb, "../../../images/sys_images/".$tmp_author_pic_file_name);  //將暫存檔改名，並寫入指定位置
			break;
			case "image/gif";
				$tmp_author_pic_file_name = $tmp_author_id.".gif";
				imagegif($thumb, "../../../images/sys_images/".$tmp_author_pic_file_name);  //將暫存檔改名，並寫入指定位置
			break;
			case "image/png";
				$tmp_author_pic_file_name = $tmp_author_id.".png";
				imagepng($thumb, "../../../images/sys_images/".$tmp_author_pic_file_name);  //將暫存檔改名，並寫入指定位置
			break;
		}	
		
		
		$tmp_author_code_pic_path = "./images/sys_images/$tmp_author_pic_file_name";  //作者圖路徑
		$tmp_author_code_pic_long_path = "../../../images/sys_images/$tmp_author_pic_file_name"; //作者圖長路徑
		
		$ins_sql = "INSERT INTO $dbtable_00 (author_id, author_name, author_code, author_code_pic_path, author_code_pic_long_path) VALUES ('$tmp_author_id', '$tmp_author_name', '$tmp_author_code', '$tmp_author_code_pic_path', '$tmp_author_code_pic_long_path')";
		//↑寫入資料
		$result = mysql_query($ins_sql) or die("失敗");
		//mysql_free_result($result);
		$sel_sql = "SELECT * FROM $dbtable_00 WHERE author_id = '$tmp_author_id' and author_name = '$tmp_author_name' and author_code = '$tmp_author_code' and author_code_pic_path = '$tmp_author_code_pic_path'";
		//↑檢查資料寫入是否成功
		$result = mysql_query($sel_sql) or die("失敗");
		$row = MySQL_fetch_array($result);
		if(!$row == 0)
		{
			mysql_free_result($result);
			header("location:authors_book_list.php");
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