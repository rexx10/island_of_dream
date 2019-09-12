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

if(!empty($_POST["author_book_data_type"])){ $author_book_img_type = $_POST["author_book_data_type"]; }
if(!empty($_GET["author_book_data_type"])){ $author_book_img_type = $_GET["author_book_data_type"]; }





//echo $_FILES["author_book_front_cover"]["name"];
switch($author_book_img_type)
{

      case"ins_data":
	  
		  $tmp_author_code = $_POST["author_code"]; //作者代號
          $tmp_book_name = $_POST["book_name"];	//書名
          $tmp_book_name_code = $_POST["author_code"].$_POST["book_name_code"];	//書本代碼
          //$tmp_author_book_front_cover = $_POST["author_book_front_cover"];	//小說封面圖
          $tmp_book_cover_fig_aut = $_POST["book_cover_fig_aut"];	//小說封面作者
          //$tmp_book_name_code = $_POST["book_name_code"];
          $tmp_publication_date_y = $_POST["publication_date_y"];	//出書日_年
          $tmp_publication_date_m = $_POST["publication_date_m"];	//出書日_月
          $tmp_publication_date_d = $_POST["publication_date_d"]; //出書日_日(非一定要)
          $tmp_book_preface = $_POST["book_preface"];	//前言
          //$tmp_book_content = $_POST["book_content"];	//內容
		  $book_content_01 = $_POST["book_content_01"];
          
          $temp_uniqid = uniqid();
	  

          if($tmp_book_name_code != "" and $tmp_book_name != "")
          {	
	          if($_FILES["author_book_front_cover"]["name"] != "" and $_FILES["author_book_front_cover_big"]["name"] != "")   //檢查是否選擇圖檔
	          {
		          switch($_FILES["author_book_front_cover"]["type"])
		          {
			            case"image/jpeg":
				            $tmp_src = @imagecreatefromjpeg($_FILES["author_book_front_cover"]["tmp_name"]);
			                break;
			            case"image/gif":
				            $tmp_src = @imagecreatefromgif($_FILES["author_book_front_cover"]["tmp_name"]);
			                break;
			            case"image/png":
				            $tmp_src = @imagecreatefromjpeg($_FILES["author_book_front_cover"]["tmp_name"]);
			                break;
			            default:
					               //顯示訊息
				               echo "<script type='text/javascript'>";
				               echo "alert('抱歉！不支援此格式!');";
				               echo "history.back();";
				               echo "</script>";
			
		          }
		          switch($_FILES["author_book_front_cover_big"]["type"])
		          {   	//小說試閱內大圖
			            case"image/jpeg":
				            $tmp_src2 = imagecreatefromjpeg($_FILES["author_book_front_cover_big"]["tmp_name"]);
			                break;
			            case"image/gif":
				            $tmp_src2 = imagecreatefromgif($_FILES["author_book_front_cover_big"]["tmp_name"]);
			                break;
			            case"image/png":
				            $tmp_src2 = imagecreatefromjpeg($_FILES["author_book_front_cover_big"]["tmp_name"]);
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
		          if($tmp_src_w != 100 or $tmp_src_h != 154)
		          {
			          if($tmp_src_w > $tmp_src_h)
			          {      //縮圖判斷
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
		                //小說試閱內大圖用
		          $tmp_src_w2 = imagesx($tmp_src2);  //取得圖片寬度
		          $tmp_src_h2 = imagesy($tmp_src2);	 //取得圖片高度
		          if($tmp_src_w2 != 500 or $tmp_src_h2 != 270)
		          {
			          if($tmp_src_w2 > $tmp_src_h2)
			          {     //縮圖判斷
				          $thumb_w2 = 270;
				          $thumb_h2 = intval($tmp_src_h2 / $tmp_src_w2 * 100);
			          }
			          else
			          {
				          $thumb_h2 = 500;
				          $thumb_w2 = intval($tmp_src_w2 / $tmp_src_h2 * 100);
			          }
		          }
		          else
		          {
			          $thumb_h2 = $tmp_src_h2;
			          $thumb_w2 = $tmp_src_w2;
		          }
		
		              //*********************************************
		
		                // if you are using GD 1.6.x, please use imagecreate()
		          $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		          $thumb2 = imagecreatetruecolor($thumb_w2, $thumb_h2);
 
		                     // start resize
		          imagecopyresized($thumb, $tmp_src, 0, 0, 0, 0, $thumb_w, $thumb_h, $tmp_src_w, $tmp_src_h);
		          imagecopyresized($thumb2, $tmp_src2, 0, 0, 0, 0, $thumb_w2, $thumb_h2, $tmp_src_w2, $tmp_src_h2);
                  
			                 // save thumbnail
		          switch($_FILES["author_book_front_cover"]["type"])
		          {
			            case"image/jpeg":
				            $tmp_author_book_front_cover_file_name = "author_book_front_cover_".$temp_uniqid."_".$tmp_book_name_code.".jpg";
				            //imagejpeg($thumb, "../../../images/sys_images/".$tmp_author_book_front cover_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/gif":
				            $tmp_author_book_front_cover_file_name = "author_book_front_cover_".$temp_uniqid."_".$tmp_book_name_code.".gif";
				            //imagegif($thumb, "../../../images/sys_images/".$tmp_author_book_front cover_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/png":
				            $tmp_author_book_front_cover_file_name = "author_book_front_cover_".$temp_uniqid."_".$tmp_book_name_code.".png";
				            //imagepng($thumb, "../../../images/sys_images/".$tmp_author_book_front cover_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
		          }
		
		          switch($_FILES["author_book_front_cover_big"]["type"])
		          {  		//小說封面大圖
			            case"image/jpeg":
				            $tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$temp_uniqid."_".$tmp_book_name_code.".jpg";
				            //imagejpeg($thumb, "../../../images/sys_images/".$tmp_author_book_front cover_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/gif":
				            $tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$temp_uniqid."_".$tmp_book_name_code.".gif";
				            //imagegif($thumb, "../../../images/sys_images/".$tmp_author_book_front cover_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/png":
				            $tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$temp_uniqid."_".$tmp_book_name_code.".png";
				            //imagepng($thumb, "../../../images/sys_images/".$tmp_author_book_front cover_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
		          }
				  
		          $sel_sql_00 = "SELECT * FROM $dbtable_02 WHERE author_code = '$tmp_author_code' and book_name_code = '$tmp_book_name_code'"; 
		          $result_00 = mysql_query($sel_sql_00) or die("失敗sel_sql_00");
		                  //$resul tmysql_result($result_00, 0, "book_name_code");
		          if(mysql_result($result_00, 0, "book_name_code") != $tmp_book_name_code)
		          {
		              $sel_sql_01 = "SELECT * FROM $dbtable_03 WHERE author_code = '$tmp_author_code' and book_name_code = '$tmp_book_name_code'";
		              $result_01 = mysql_query($sel_sql_01) or die("失敗sel_sql_01");
		              $tmp_sec_type = $tmp_book_name_code."-1";
		              if(mysql_result($result_01, 0, "sec_type") != $tmp_sec_type)
		              {  
		    
		                  $tmp_author_book_front_cover_path = "./images/sys_images/$tmp_author_book_front_cover_file_name";  //作者圖路徑
		                  $tmp_author_book_front_cover_long_path = "../../../images/sys_images/$tmp_author_book_front_cover_file_name"; //作者圖長路徑
		
		                  $tmp_author_book_front_cover_big_path = "./images/sys_images/$tmp_author_book_front_cover_big_img_file_name";  //小說封面大圖路徑
		                  $tmp_author_book_front_cover_big_long_path = "../../../images/sys_images/$tmp_author_book_front_cover_big_img_file_name"; //小說封面大圖長路徑
		
		                  $ins_sql = "INSERT INTO $dbtable_02(author_code, author_book_front_cover_path, author_book_front_cover_long_path, book_preface,publication_date_y, publication_date_m,publication_date_d, book_cover_fig_aut, book_name, book_name_code, author_book_front_cover_big_path, author_book_front_cover_big_long_path) VALUES('$tmp_author_code', '$tmp_author_book_front_cover_path', '$tmp_author_book_front_cover_long_path', '$tmp_book_preface', '$tmp_publication_date_y', '$tmp_publication_date_m', '$tmp_publication_date_d', '$tmp_book_cover_fig_aut', '$tmp_book_name', '$tmp_book_name_code', '$tmp_author_book_front_cover_big_path', '$tmp_author_book_front_cover_big_long_path')";
		                  $result_ins_sql = mysql_query($ins_sql) or die("失敗1");
		                            //if($_POST["book_content_0$i"] != "")
		                 /*  for($i=1; $i <= 3; $i++)
		                  { 
		  	                        //echo "1".$_POST["book_content_0$i"];
		  	                  if($_POST["book_content_0$i"] != "")
			                  {
			  	                     //$_POST["book_content_0$i"];
		                          ${"book_content_0".$i} = $_POST["book_content_0$i"]; 
			                      $sec_type = $tmp_book_name_code."-".$i;
				
		  	                      //if(${"book_content_0".$i} != "") */
	                              $sec_type_1 = $tmp_book_name_code."-1";
			                     $sec_type_1 = $ins_sql_01 = "INSERT INTO $dbtable_03(author_code, book_content, book_name_code, sec_type)VALUES('$tmp_author_code', '$book_content_01', '$tmp_book_name_code', '$sec_type_1')";
			                      $result_ins_sql = mysql_query($ins_sql_01) or die("失敗rrr2");
			                      mysql_free_result($result_ins_sql);
								  
			                  // }
			                  // else
			                  // {
		                          // if($i == 1 and $_POST["book_content_01"] == "")
			                      // {
			                          // $sec_type = $tmp_book_name_code."-".$i;
				                      // $ins_sql_01 = "INSERT INTO $dbtable_03(author_code, book_name_code, sec_type)VALUES('$tmp_author_code', '$tmp_book_name_code', '$sec_type')";
				                      // $result_ins_sql = mysql_query($ins_sql_01) or die("失敗02");
				                      // mysql_free_result($result_ins_sql);
				                      // break;
			                      // }
			                      // else
			                      // {
				                      // /* $sec_type = $tmp_book_name_code."-".$i;
				                      // $ins_sql_01 = "INSERT INTO $dbtable_03(author_code, book_name_code, sec_type)VALUES('$tmp_author_code', '$tmp_book_name_code', '$sec_type')";
				                      // $result_ins_sql = mysql_query($ins_sql_01) or die("失敗003");
				                      // mysql_free_result($result_ins_sql); */
			                          // break;
			                      // }
				
			                  // }
			
	  	                  // }
		
		
		
		                       // save thumbnail
		                  switch($_FILES["author_book_front_cover"]["type"])
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
		
		                  switch($_FILES["author_book_front_cover_big"]["type"])
		                  {	                //小說封面大圖 路徑
			                    case"image/jpeg":
				                    //$tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$tmp_author_code.$tmp_book_name_code.".jpg";
				                    imagejpeg($thumb2, "../../../images/sys_images/".$tmp_author_book_front_cover_big_img_file_name);  //將暫存檔改名，並寫入指定位置
			                        break;
			                    case"image/gif":
				                    //$tmp_author_book_front_cover_big_img_file_name = "author_book_front_cover_big_img_".$tmp_author_code.$tmp_book_name_code.".gif";
				                    imagegif($thumb2, "../../../images/sys_images/".$tmp_author_book_front_cover_big_img_file_name);  //將暫存檔改名，並寫入指定位置
			                        break;
			                    case"image/png":
				                    //$tmp_author_book_front_cover_big_img_name = "author_book_front_cover_big_img_".$tmp_author_code.$tmp_book_name_code.".png";
				                    imagepng($thumb2, "../../../images/sys_images/".$tmp_author_book_front_cover_big_img_file_name);  //將暫存檔改名，並寫入指定位置
			                        break;
		                  }
		
		                  $sel_sql = "SELECT * FROM $dbtable_02 WHERE author_code = '$tmp_author_code' and book_name = '$tmp_book_name' and book_name_code = '$tmp_book_name_code'";
		                            //↑檢查資料寫入是否成功
		                  $result = mysql_query($sel_sql) or die("失敗3");
		
		                  $sel_sql_02 = "SELECT * FROM $dbtable_03 WHERE author_code = '$tmp_author_code' and book_name_code = '$tmp_book_name_code'";
		                  $result_02 = mysql_query($sel_sql_02) or die("失敗4");
		                  $row = MySQL_fetch_array($result);
		                  $row_02 = MySQL_fetch_array($result_02);
		                  $sql_author_code = mysql_result($result, 0, "author_code");
		                  if(!$row = "" and !$row_02 = "")
		                  {
			                  mysql_free_result($result_00);
		                      mysql_free_result($result_01);
				              mysql_free_result($result);
			                  mysql_free_result($result_02);
			                  header("location:author_book_main_data.php?author_code=$sql_author_code");
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
		                                    //*********************************************
		              }
		              else
		              {
			              mysql_free_result($result_00);
		                  mysql_free_result($result_01);
		  
		                       //顯示訊息
			              echo "<script type='text/javascript'>";
			              echo "alert('資料寫入失敗，請聯絡程式設計師!!');";
			              echo "history.back();";
			              echo "</script>";	
		  
		              }
		
		
		          }
		          else 
		          {	
			          mysql_free_result($result_00);
		                    //顯示訊息
			          echo "<script type='text/javascript'>";
			          echo "alert('抱歉！！已有相同作品編號，請更換!!');";
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

          }
          else
          { 
	    	  //顯示訊息
	          echo "<script type='text/javascript'>";
	          echo "alert('未輸入書名或書本代號');";
	          echo "history.back();";
	          echo "</script>";


          }
	      break;
      case"up_data":
		  
		  
		  $edit_book_name = $_POST["book_name"];  //書名
		  $edit_book_name_code = $_POST["book_name_code"];   //書本編號
		  $edit_author_code = $_POST["author_code"];
		  if(!empty($_POST["book_cover_fig_aut"]))
		  {
		      $edit_book_cover_fig_aut = $_POST["book_cover_fig_aut"];
		  } 
               //↑封面插圖作者
	      if(!empty($_POST["publication_date_y"]))
		  {    //↑出書年
		      $edit_publication_date_y = $_POST["publication_date_y"];
		  }
		  if(!empty($_POST["publication_date_m"]))
		  {    //↑出書月
		      $edit_publication_date_m = $_POST["publication_date_m"];
		  }
		  if(!empty($_POST["publication_date_d"]))
		  {    //↑出書日
		      $edit_publication_date_d = $_POST["publication_date_d"];
		  }
		  $edit_book_preface = $_POST["book_preface"];   //書序
	      
		  $up_sql = "UPDATE $dbtable_02 SET book_name = '$edit_book_name', book_cover_fig_aut = '$edit_book_cover_fig_aut', publication_date_y = '$edit_publication_date_y', publication_date_m = '$edit_publication_date_m', publication_date_d = '$edit_publication_date_d', book_preface = '$edit_book_preface' WHERE book_name_code = '$edit_book_name_code' AND author_code = '$edit_author_code'";
			   
		  $result_up_sql = mysql_query($up_sql) or die("失敗up");
		  
		  // for($i=1; $i <= 3; $i++)
		  // { 
		  
		      // if(!empty($_POST["book_content_0$i"]))
			  // {
		  	     //echo "1".$_POST["book_content_0$i"];
		          // if($_POST["book_content_0$i"] != "")
			      // {
			         $book_content_01 = $_POST["book_content_01"];
		              // ${"book_content_0".$i} = $_POST["book_content_0$i"]; 
			          // $sec_type = $edit_book_name_code."-".$i;
				
		  	            //if(${"book_content_0".$i} != "")
			           //$ins_sql_01 = "INSERT INTO $dbtable_03(author_code, book_content, book_name_code, sec_type)VALUES('$tmp_author_code', '${"book_content_0".$i}', '$tmp_book_name_code', '$sec_type')";
					   $sec_type_2 = $edit_book_name_code."-1";
			          $up_sql_01 = "UPDATE $dbtable_03 SET book_content = '$book_content_01' WHERE book_name_code = '$edit_book_name_code' AND sec_type = '$sec_type_2'";
				      mysql_query($up_sql_01) or die("失敗2");
								  
			      // }
				  // elseif($_POST["book_content_0$i"] == "")
				  // {
			          
			          // $sec_type = $edit_book_name_code."-".$i;
				      $up_sql_01 = "UPDATE $dbtable_03(author_code, book_name_code, sec_type)VALUES('$tmp_author_code', '$tmp_book_name_code', '$sec_type')";
					  // $temp_sec_type = $edit_book_name_code."-".$i;
				      // $del_sql = "DELETE FROM $dbtable_03 WHERE book_name_code = '$edit_book_name_code' AND sec_type = '$temp_sec_type'"; 
					  // $result_del_sql = mysql_query($up_del) or die("失敗02");
				      // mysql_free_result($result_del_sql);
				      // break;
			            
			              
				  // }
			  // }
	  	  // }
		  
		  $sel_sql = "SELECT * FROM $dbtable_03 WHERE book_name_code = '$edit_book_name_code'";
		  $result_sel_sql = mysql_query($sel_sql) or die("失敗03");
	      $up_author_code = mysql_result($result_sel_sql, 0, "author_code");
		  $up_book_name_code = mysql_result($result_sel_sql, 0, "book_name_code");
		  //header("location:author_book_main_data_edit.php?up_author_code=$up_author_code&up_book_name_code=$up_book_name_code");
	      header("location:author_book_main_data.php?author_code=$up_author_code");
	  
	      break;
      case"del_data":
	      $del_author_code = $_GET["del_author_code"];
	      $del_book_name_code = $_GET["del_book_name_code"];
	  
	      $sel_sql = "SELECT * FROM $dbtable_02 WHERE author_code = '$del_author_code' and book_name_code = '$del_book_name_code'";
	      $result_sel_sql = mysql_query($sel_sql) or die("失敗1");
	      $result_sel_sql_long_path = mysql_result($result_sel_sql, 0, "author_book_front_cover_long_path");
	      $result_sel_sql_big_long_path = mysql_result($result_sel_sql, 0, "author_book_front_cover_big_long_path");
	      if(file_exists($result_sel_sql_long_path))
	      {		//檢查是否有檔案
	
		      unlink($result_sel_sql_long_path);
						//刪除圖片
	      }	
	      if(file_exists($result_sel_sql_big_long_path))
	      {		//檢查是否有檔案
	
					unlink($result_sel_sql_big_long_path);
						//刪除圖片
	
	      }	
	
	      $del_sql = "DELETE FROM $dbtable_02 WHERE author_code = '$del_author_code' and book_name_code = '$del_book_name_code'";
	      $result_del_sql_00 = mysql_query($del_sql) or die("失敗1");
	  
	      $del_sql = "DELETE FROM $dbtable_03 WHERE author_code = '$del_author_code' and book_name_code = '$del_book_name_code'";
	      $result_del_sql_01 = mysql_query($del_sql) or die("失敗1");
	  
	      mysql_free_result($result_sel_sql);
	      mysql_free_result($result_del_sql_00);
	      mysql_free_result($result_del_sql_01);
	      header("location:author_book_main_data.php?author_code=$del_author_code");
	      break;
}
?>
</body>
</html>