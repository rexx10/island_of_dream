<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php 

    require_once("./dreamland_basic_config.php");
    require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');

	$tmp_old_author_book_front_cover_img = $_POST["old_author_book_front_cover_img"];  //原始圖檔路徑
	$tmp_book_name_code = $_POST["book_name_code"];  //作品編號
	$tmp_author_code = $_POST["author_code"];  //作者代號
	$bak_author_name = $_POST["author_name"]; //作者姓名
	$bak_book_name = $_POST["book_name"];		//書名
	$temp_uniqid = uniqid(); //亂數編碼
   
switch($_POST["author_book_img_edit_type"])
{

  case"up_aut_book_front_cover_img":
		
      if($_FILES["chg_aut_book_front_cover_img"]["name"] != "")   //檢查是否選擇圖檔
	    {
		    switch($_FILES["chg_aut_book_front_cover_img"]["type"])
		    {	//判別圖片檔
			    case"image/jpeg":
				    $tmp_src = @imagecreatefromjpeg($_FILES["chg_aut_book_front_cover_img"]["tmp_name"]);
			        break;
			    case"image/gif":
				    $tmp_src = @imagecreatefromgif($_FILES["chg_aut_book_front_cover_img"]["tmp_name"]);
			        break;
			    case"image/png":
				    $tmp_src = @imagecreatefromjpeg($_FILES["chg_aut_book_front_cover_img"]["tmp_name"]);
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
			
			switch($_POST["author_book_img_type"])
			{
			      case"up_aut_book_front_cover_img_small":
				      if($tmp_src_w != 100 or $tmp_src_h != 154)
		              {
			              if($tmp_src_w > $tmp_src_h)
			              {    //縮圖判斷
				              $thumb_w = 154;
				              $thumb_h = intval($tmp_src_h / $tmp_src_w * 100);
			              }
			              else
			              {
				              $thumb_h = 100;
				              $thumb_w = intval($tmp_src_w / $tmp_src_h * 100);
			              }
		              }
		              else
		              {
			                  $thumb_h = $tmp_src_h;
			                  $thumb_w = $tmp_src_w;		
  		              }				  
				      break;
				  case"up_aut_book_front_cover_img_big":
				      if($tmp_src_w != 500 or $tmp_src_h != 270)
		              {
			              if($tmp_src_w > $tmp_src_h)
			              {    //縮圖判斷
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
                      break;		
            }					  
				
			
		   	
		     
		
		      //*********************************************
		
		      // if you are using GD 1.6.x, please use imagecreate()
		  $thumb = imagecreatetruecolor($thumb_w, $thumb_h);

 
		     // start resize
		  imagecopyresized($thumb, $tmp_src, 0, 0, 0, 0, $thumb_w, $thumb_h, $tmp_src_w, $tmp_src_h);
		  
		  switch($_POST["author_book_img_type"])
		  {
		        case"up_aut_book_front_cover_img_small":
			             // save thumbnail
		            switch($_FILES["chg_aut_book_front_cover_img"]["type"])
		            {
			              case"image/jpeg":
				              $tmp_author_book_front_cover_file_name = "author_book_front_cover_".$temp_uniqid."_".$tmp_book_name_code.".jpg";
				              break;
			              case"image/gif":
				              $tmp_author_book_front_cover_file_name = "author_book_front_cover_".$temp_uniqid."_".$tmp_book_name_code.".gif";
				              break;
			              case"image/png":
				              $tmp_author_book_front_cover_file_name = "author_book_front_cover_".$temp_uniqid."_".$tmp_book_name_code.".png";
				  			  break;
			        }
		            break;
		  
		        case"up_aut_book_front_cover_img_big":
		            switch($_FILES["chg_aut_book_front_cover_img"]["type"])
		            {  		//小說封面大圖
			              case"image/jpeg":
				              $tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$temp_uniqid."_".$tmp_book_name_code.".jpg";
				  	          break;
			              case"image/gif":
				              $tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$temp_uniqid."_".$tmp_book_name_code.".gif";
				              break;
			              case"image/png":
				              $tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$temp_uniqid."_".$tmp_book_name_code.".png";
				              break;
		            }
		            break;
		  }
		  
		  if(file_exists($_POST["old_author_book_front_cover_img"]))
		  {		//檢查是否有檔案
	
		      unlink($_POST["old_author_book_front_cover_img"]);
						//刪除圖片	
		  }

		  
          switch($_POST["author_book_img_type"])
		  {		
		        case"up_aut_book_front_cover_img_small":
				
					$tmp_author_book_front_cover_path = "./images/sys_images/$tmp_author_book_front_cover_file_name";  //作者圖路徑
		            $tmp_author_book_front_cover_long_path = "../../../images/sys_images/$tmp_author_book_front_cover_file_name"; //作者圖長路徑
					$sql_aut_book_conver_long_path = "../../../images/sys_images/$tmp_author_book_front_cover_file_name"; //給資料庫查詢的作者圖長路徑
		            $up_sql = "UPDATE $dbtable_02 SET author_book_front_cover_path = '$tmp_author_book_front_cover_path', author_book_front_cover_long_path = '$tmp_author_book_front_cover_long_path' WHERE author_code = '$tmp_author_code' AND book_name_code = '$tmp_book_name_code'";
		            mysql_query($up_sql) or die("失敗00");
					
                        // save thumbnail
		            switch($_FILES["chg_aut_book_front_cover_img"]["type"])
		            {
			              case"image/jpeg":
				                   //$tmp_author_book_front cover_file_name = "author_book_front cover".$author_book_banner_image_code.".jpg";
				              imagejpeg($thumb, "../../../images/sys_images/".$tmp_author_book_front_cover_file_name);  //將暫存檔改名，並寫入指定位置
			                  break;
			              case"image/gif":
				                   //$tmp_author_book_front cover_file_name = "author_".$author_book_banner_image_code.".gif";
				              imagegif($thumb, "../../../images/sys_images/".$tmp_author_book_front_cover_file_name);  //將暫存檔改名，並寫入指定位置
			                  break;
			              case"image/png":
							  //$tmp_author_book_front cover_file_name = "author_".$author_book_banner_image_code.".png";
				              imagepng($thumb, "../../../images/sys_images/".$tmp_author_book_front_cover_file_name);  //將暫存檔改名，並寫入指定位置
			                  break;
		            }
		            break;
				case"up_aut_book_front_cover_img_big":
				
					$tmp_author_book_front_cover_big_path = "./images/sys_images/$tmp_author_book_front_cover_big_img_file_name";  //小說封面大圖路徑
		            $tmp_author_book_front_cover_big_long_path = "../../../images/sys_images/$tmp_author_book_front_cover_big_img_file_name"; //小說封面大圖長路徑
		            $sql_aut_book_conver_long_path = "../../../images/sys_images/$tmp_author_book_front_cover_big_img_file_name"; //給資料庫查詢的小說封面大圖長路徑
					$up_sql = "UPDATE $dbtable_02 SET author_book_front_cover_big_path = '$tmp_author_book_front_cover_big_path', author_book_front_cover_big_long_path = '$tmp_author_book_front_cover_big_long_path' WHERE author_code = '$tmp_author_code' AND book_name_code = '$tmp_book_name_code'";
		            //如副檔名一樣會寫入失敗
					//先前寫入圖檔要加入亂數序號
					mysql_query($up_sql) or die("失敗00");
				
		            switch($_FILES["chg_aut_book_front_cover_img"]["type"])
		            {	    //小說封面大圖 路徑
			              case"image/jpeg":
				              //$tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$tmp_author_code.$tmp_book_name_code.".jpg";
				              imagejpeg($thumb, "../../../images/sys_images/".$tmp_author_book_front_cover_big_img_file_name);  //將暫存檔改名，並寫入指定位置
			                  break;
			              case"image/gif":
				              //$tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$tmp_author_code.$tmp_book_name_code.".gif";
				              imagegif($thumb, "../../../images/sys_images/".$tmp_author_book_front_cover_big_img_file_name);  //將暫存檔改名，並寫入指定位置
			                  break;
			              case"image/png":
				              //$tmp_author_book_front_cover_big_img_name = "author_book_front_cover_big_img_".$tmp_author_code.$tmp_book_name_code.".png";
				              imagepng($thumb, "../../../images/sys_images/".$tmp_author_book_front_cover_big_img_file_name);  //將暫存檔改名，並寫入指定位置
			                  break;
		            }
				    break;
          }					
		
		  $sel_sql = "SELECT * FROM $dbtable_02 WHERE author_code = '$tmp_author_code' AND book_name = '$bak_book_name' AND book_name_code = '$tmp_book_name_code'";
		       //↑檢查資料寫入是否成功
		  $result = mysql_query($sel_sql) or die("失敗3");
		  
	      switch($_POST["author_book_img_type"])
		  {
				case"up_aut_book_front_cover_img_small":
					$bak_author_book_front_cover_long_path = mysql_result($result, 0, "author_book_front_cover_long_path");
					$row = MySQL_fetch_array($result);
		        	$sql_author_code = mysql_result($result, 0, "author_code");
					$row = MySQL_fetch_array($result);
					if(!$row = "")
		            {
			           
				       mysql_free_result($result);
			           header("location:author_book_main_data_edit_uni_img.php?up_author_code=$tmp_author_code&up_book_name_code=$tmp_book_name_code&up_author_book_front_cover_long_path=$bak_author_book_front_cover_long_path&author_book_img_edit_type=up_aut_book_front_cover_long_path&up_author_name=$bak_author_name&up_book_name=$bak_book_name");
		            }
		            else
		            {	
				       
				       mysql_free_result($result);
			             //顯示訊息
			           echo "<script type='text/javascript'>";
			           echo "alert('資料寫入失敗，請聯絡程式設計師!!');";
			           echo "history.back();";
			           echo "</script>";
		            }
					break;
				case"up_aut_book_front_cover_img_big":
					
					$bak_author_book_front_cover_big_long_path = mysql_result($result, 0, "author_book_front_cover_big_long_path");
					$row = MySQL_fetch_array($result);
		        	$sql_author_code = mysql_result($result, 0, "author_code");
					$row = MySQL_fetch_array($result);
					if(!$row = "")
		            {
			           
					   mysql_free_result($result);
			           header("location:author_book_main_data_edit_uni_img.php?up_author_code=$tmp_author_code&up_book_name_code=$tmp_book_name_code&up_author_book_front_cover_big_long_path=$bak_author_book_front_cover_big_long_path&author_book_img_edit_type=up_aut_book_front_cover_big_long_path&up_author_name=$bak_author_name&up_book_name=$bak_book_name");
					   
		            }
		            else
		            {	
				       mysql_free_result($result_00);
		               mysql_free_result($result_01);
				       mysql_free_result($result);
			           mysql_free_result($result_02);
			             //顯示訊息
			           echo "<script type='text/javascript'>";
			           echo "alert('資料寫入失敗，請聯絡程式設計師!!');";
			           echo "history.back();";
			           echo "</script>";
		            }
				
					break;
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

	  break;
  //***************************************************************************************	  
  //case "up_data":     
	  //break;
  //case"del_data":
	  
	  //break;
}

?>

</body>
</html>
