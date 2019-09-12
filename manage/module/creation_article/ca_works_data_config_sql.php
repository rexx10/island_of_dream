<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>
<?php
    
	require_once("creation_article_config.php");
	require_once("creation_article_dbtools.inc.php");
	require_once("rexx10_fun_tools.php");
	require_once('check_session.php');
	//***************

	
	
	if(!empty($_POST["this_mode"]))
	{
	    $this_mode = $_POST["this_mode"];
	}
	if(!empty($_GET["this_mode"]))
	{
	    $this_mode = $_GET["this_mode"];
	}
	
	
	
	switch($this_mode)
	{
	    case"ins_mode":
		    $tmp_ca_authors_code = $_POST["ca_authors_code"];    //作者代號
	        $tmp_ca_creation_date = $_POST["ca_creation_date"];    //創書日
			$tmp_ca_works_title = $_POST["ca_works_title"];    //作品名稱
			$tmp_ca_serial_status = $_POST["ca_serial_status"];    //連載狀態
			$tmp_ca_works_set_the_date = $_POST["ca_works_set_the_date"];  //作品設定日期
			$tmp_ca_authors_name = $_POST["ca_authors_name"]; //作品作者名稱
            $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_title = '".mysql_real_escape_string($tmp_ca_works_title)."'";
            $result_sel = mysql_query($sel_sql) or die("失敗0");
			
            if(mysql_num_rows($result_sel) == 0)
		    {
				
				if($_FILES["ca_works_img"]["name"] != "")   //檢查是否選擇圖檔
	            {
		
		            switch($_FILES["ca_works_img"]["type"])
		            {
			            case"image/jpeg":
				            $tmp_src = @imagecreatefromjpeg($_FILES["ca_works_img"]["tmp_name"]);
			                break;
			            case"image/gif":
				            $tmp_src = @imagecreatefromgif($_FILES["ca_works_img"]["tmp_name"]);
			                break;
			            case"image/png":
				            $tmp_src = @imagecreatefromjpeg($_FILES["ca_works_img"]["tmp_name"]);
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
		            if($tmp_src_w != 78 or $tmp_src_h != 120)
		            {
			            if($tmp_src_w > $tmp_src_h)
			            {      //縮圖判斷
				            $thumb_w = 120;
				            $thumb_h = intval($tmp_src_h / $tmp_src_w * 100);
			            }
			            else
			            {
				            $thumb_h = 78;
				            $thumb_w = intval($tmp_src_w / $tmp_src_h * 100);
			            }
		            }
		            else
		            {
			            $thumb_h = $tmp_src_h;
			            $thumb_w = $tmp_src_w;
		  		    }
					
					$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
					imagecopyresized($thumb, $tmp_src, 0, 0, 0, 0, $thumb_w, $thumb_h, $tmp_src_w, $tmp_src_h);
					
					switch($_FILES["ca_works_img"]["type"])
		            {
			            case"image/jpeg":
				            $tmp_ca_works_image_file_name = $tmp_ca_authors_code."-".$tmp_ca_creation_date."-".uniqid().".jpg";
				            imagejpeg($thumb, "../../../images/sys_creation_article/ca_works_img/".$tmp_ca_works_image_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/gif";
				            $tmp_ca_works_image_file_name = $tmp_ca_authors_code."-".$tmp_ca_creation_date."-".uniqid().".gif";
				            imagegif($thumb, "../../../images/sys_creation_article/ca_works_img/".$tmp_ca_works_image_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/png";
				            $tmp_ca_works_image_file_name = $tmp_ca_authors_code."-".$tmp_ca_creation_date."-".uniqid().".png";
				            imagepng($thumb, "../../../images/sys_creation_article/ca_works_img/".$tmp_ca_works_image_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
		            }
					
					
					
				}
                else
                {
				    $tmp_ca_works_image_file_name = "default.png";  //預設圖片
				}				
						
                $tmp_ca_works_img_path = "/images/sys_images/ca_works_img/$tmp_ca_works_image_file_name";  //作者代表圖路徑
		        $tmp_ca_works_img_long_path = "../../../images/sys_creation_article/ca_works_img/$tmp_ca_works_image_file_name"; //作者代表圖長路徑						

					
				$ins_sql = "INSERT INTO $dbtable_01 (ca_authors_code,
				                                     ca_works_title,
													 ca_creation_date,
													 ca_serial_status,
													 ca_works_font_cover_path,
													 ca_works_font_cover_long_path,
													 ca_works_set_the_date)
											VALUES ('".mysql_real_escape_string($tmp_ca_authors_code)."', 
											        '".mysql_real_escape_string($tmp_ca_works_title)."', 
													'".mysql_real_escape_string($tmp_ca_creation_date)."', 
													'".mysql_real_escape_string($tmp_ca_serial_status)."', 
													'".mysql_real_escape_string($tmp_ca_works_img_path)."', 
													'".mysql_real_escape_string($tmp_ca_works_img_long_path)."', 
													'".mysql_real_escape_string($tmp_ca_works_set_the_date)."')";
					
					                                                                                                                                       
		                  //↑寫入資料
		        $result = mysql_query($ins_sql) or die("失敗");
		            //mysql_free_result($result);
		        $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_authors_code = '".mysql_real_escape_string($tmp_ca_authors_code)."' AND
					                                        ca_works_title = '".mysql_real_escape_string($tmp_ca_works_title)."' AND 
															ca_works_font_cover_path = '".mysql_real_escape_string($tmp_ca_works_img_path)."' AND 
															ca_works_set_the_date = '".mysql_real_escape_string($tmp_ca_works_set_the_date)."'";
					                                            
																
		                //↑檢查資料寫入是否成功
		        $result = mysql_query($sel_sql) or die("失敗");
		        $row = MySQL_fetch_array($result);
		        if(!$row == 0)
		        {
			        mysql_free_result($result);
			        header("location:ca_works_data_config.php?ca_authors_code=$tmp_ca_authors_code&ca_authors_name=$tmp_ca_authors_name");
		        }
		        else
		        {
			               //顯示訊息
		            echo "<script type='text/javascript'>";
			        echo "alert('寫入失敗，請聯絡程式設計師');";
		            echo "history.back();";
			        echo "</script>";
		        }
							  
		    }
		    else
			{
			    mysql_free_result($result_sel);
			      //顯示作品名稱重複
			    echo "<script type='text/javascript'>";
			    echo "alert('警告！作品名稱重複!');";
			    echo "history.back();";
			    echo "</script>";
			}
			break;			
		case"up_mode":
		    if(!empty($_POST["ch_ca_works_title"]))
			{
		        $old_ca_works_title = $_POST["old_ca_works_title"];                            //原始作品名稱
		        $tmp_ch_ca_works_title = $_POST["ch_ca_works_title"];                         //更換的作品名稱
			}
			else
			{
			    $old_ca_works_title = $_POST["old_ca_works_title"];
				$tmp_ch_ca_works_title = $_POST["old_ca_works_title"];			
			}
			$ca_works_id = $_POST["ca_works_id"];                                          //原始作品序號
			$ca_authors_code = $_POST["ca_authors_code"];                                  //原始作者代號
			$ca_authors_name = $_POST["ca_authors_name"];                                  //原始作者名稱
			$old_ca_works_font_cover_file = $_POST["old_ca_works_font_cover_file"];        //原始封面圖檔案名稱
		
		    $tmp_img_file = $_FILES["ch_img_ca_works_img"]["tmp_name"];                    //圖片來源 EX.$_FILES["myfile"]["tmp_name"];       
            $filter_img = $_FILES["ch_img_ca_works_img"]["type"];                          //過濾圖片類型   EX.$_FILES["myfile"]["type"];
			$sel_resize_type = "one";         //縮圖方式  "one" = 直接縮圖  "two" = 自動判斷寬與高進行縮圖
            $target_src_w_int = 78;        //目標寬
            $target_src_h_int = 120;       //目標高
            $target_path = "/images/sys_images/ca_works_img/";                             //目的地資料夾路徑 "./"
            $target_full_path = "../../../images/sys_creation_article/ca_works_img/";      //目的地資料夾路徑 "./fg/"
            $tmp_rand_code_or_any_int = $ca_authors_code;                                  //任意數值 
		    
            if($tmp_ch_ca_works_title != $old_ca_works_title or $tmp_ch_ca_works_title == "")
			{
			    $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_title = '".mysql_real_escape_string($tmp_ch_ca_works_title)."'";
				$result_sel = mysql_query($sel_sql) or die("失敗0");	
			    if(mysql_num_rows($result_sel) == 0)
		        {
			        if($_FILES["ch_img_ca_works_img"]["name"] != "")
				    {
					    if($old_ca_works_font_cover_file != "default.png")
			            {      //判斷檔案是否為預設圖檔，如為否將刪除封面圖檔
			                if(file_exists($_POST["old_ca_works_font_cover_long_path"]))
			                {
			                    unlink($_POST["old_ca_works_font_cover_long_path"]);
			                }
			            }
						$thumbnail_img = rexx10_thumbnail_tools($tmp_img_file, 
					                                        $filter_img, 
															$sel_resize_type, 
								                            $target_src_w_int, 
								                            $target_src_h_int, 
								                            $target_path, 
								                            $target_full_path, 
								                            $tmp_rand_code_or_any_int);
                    
                        $tmp_target_path = $thumbnail_img[0];
					    $tmp_target_full_path = $thumbnail_img[1];
				
				
				    }
				    else
		            {
			            echo $sel_sql_02 = "SELECT * FROM $dbtable_01 WHERE ca_works_id = '".mysql_real_escape_string($ca_works_id)."'";
						$result_sel_sql_02 = mysql_query($sel_sql_02) or die("失敗212");
						
						$tmp_target_path = mysql_result($result_sel_sql_02, 0, "ca_works_font_cover_path");
					    $tmp_target_full_path = mysql_result($result_sel_sql_02, 0, "ca_works_font_cover_long_path");
		            }
					
					$up_sql = "UPDATE $dbtable_01 SET ca_works_title = '".mysql_real_escape_string($tmp_ch_ca_works_title)."', 
					                                  ca_works_font_cover_path = '".mysql_real_escape_string($tmp_target_path)."', 
													  ca_works_font_cover_long_path = '".mysql_real_escape_string($tmp_target_full_path)."'
													  WHERE ca_works_id = '".mysql_real_escape_string($ca_works_id)."'";
				    
					mysql_query($up_sql) or die("失敗22");
					
					$sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_title = '".mysql_real_escape_string($tmp_ch_ca_works_title)."' AND 
					                                            ca_works_font_cover_path = '".mysql_real_escape_string($tmp_target_path)."' AND
																ca_works_font_cover_long_path = '".mysql_real_escape_string($tmp_target_full_path)."' AND
																ca_authors_code = '".mysql_real_escape_string($tmp_ca_authors_code)."'";
					                                            
					             //↑檢查資料寫入是否成功
				    $result = mysql_query($sel_sql) or die("失敗");
		            $row = MySQL_fetch_array($result);
					if(!$row != 0)
		            {
			            mysql_free_result($result);
			            header("location:ca_works_data_uni_edit_config.php?ca_authors_code=".$ca_authors_code."&ca_authors_name=".$ca_authors_name."&ca_works_id=".$ca_works_id);
		            }
		            else
		            {
			                  //顯示訊息
		                echo "<script type='text/javascript'>";
			            echo "alert('警告!寫入失敗，請聯絡程式設計師');";
		                echo "history.back();";
			            echo "</script>";
		            }
				}
				else
				{
				    mysql_free_result($result_sel);
			             //顯示作品名稱重複
			        echo "<script type='text/javascript'>";
			        echo "alert('警告！作品名稱重複!');";
			        echo "history.back();";
			        echo "</script>";
			    }			
			}
			else
			{
			    if($_FILES["ch_img_ca_works_img"]["name"] != "")
				{				
				    if($old_ca_works_font_cover_file != "default.png")
			        {   //判斷檔案是否為預設圖檔，如為否將刪除封面圖檔
			            if(file_exists($_POST["old_ca_works_font_cover_long_path"]))
			            {
			                unlink($_POST["old_ca_works_font_cover_long_path"]);
			            }
			        }
                    $thumbnail_img = rexx10_thumbnail_tools($tmp_img_file, 
					                                        $filter_img, 
															$sel_resize_type, 
								                            $target_src_w_int, 
								                            $target_src_h_int, 
								                            $target_path, 
								                            $target_full_path, 
								                            $tmp_rand_code_or_any_int);
                    
                    echo $tmp_target_path = $thumbnail_img[0];
					echo $tmp_target_full_path = $thumbnail_img[1];
					
					$up_sql = "UPDATE $dbtable_01 SET ca_works_font_cover_path = '".mysql_real_escape_string($tmp_target_path)."', 
					                                  ca_works_font_cover_long_path = '".mysql_real_escape_string($tmp_target_full_path)."'
													  WHERE ca_works_id = '".mysql_real_escape_string($ca_works_id)."' AND 
													        ca_authors_code = '".mysql_real_escape_string($ca_authors_code)."' AND 
															ca_works_title = '".mysql_real_escape_string($old_ca_works_title)."'";
					mysql_query($up_sql) or die("失敗d");
					$sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_font_cover_path = '".mysql_real_escape_string($tmp_target_path)."' AND 
					                                            ca_works_font_cover_long_path = '".mysql_real_escape_string($tmp_target_full_path)."' AND 
																ca_works_id = '".mysql_real_escape_string($ca_works_id)."' AND 
																ca_authors_code = '".mysql_real_escape_string($ca_authors_code)."' AND 
															    ca_works_title = '".mysql_real_escape_string($old_ca_works_title)."'";
					
					echo $result_sel = mysql_query($sel_sql) or die("失敗0");
	                
					if(mysql_num_rows($result_sel) != 0)
		            {
		                mysql_free_result($result_sel);
			            header("location:ca_works_data_uni_edit_config.php?ca_authors_code=".$ca_authors_code."&ca_authors_name=".$ca_authors_name."&ca_works_id=".$ca_works_id);
		            }
		            else
		            {
		                mysql_free_result($result_sel);
					
			              //顯示無法上傳
			            echo "<script type='text/javascript'>";
			            echo "confirm('寫入失敗！請聯絡程式設計師!');";
			            echo "history.back();";
			            echo "</script>";		  		  
		            }
				}
				else
		        {
			               //顯示訊息
		            echo "<script type='text/javascript'>";
			        echo "alert('注意，尚未選擇任何圖片檔');";
		            echo "history.back();";
			        echo "</script>";
		        }
			}
		    break;
		case"del_mode":
		    $tmp_del_ca_works_id = $_GET["del_ca_works_id"];
			$tmp_del_ca_works_title = $_GET["del_ca_works_title"];
			$search_str = substr($_GET["del_ca_works_font_cover_long_path"], -11);
			if($search_str != "default.png")
			{
			    if(file_exists($_GET["del_ca_works_font_cover_long_path"]))
			    {
			        unlink($_GET["del_ca_works_font_cover_long_path"]);
			    }
			}
			
			$del_sql = "DELETE FROM $dbtable_01 WHERE ca_works_id = '".mysql_real_escape_string($tmp_del_ca_works_id)."' AND 
			                                          ca_works_title = '".mysql_real_escape_string($tmp_del_ca_works_title)."'";
	        mysql_query($del_sql) or die("失敗d");
		    $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_id = '".mysql_real_escape_string($tmp_del_ca_works_id)."' AND 
			                                            ca_works_title = '".mysql_real_escape_string($tmp_del_ca_works_title)."'";
	        $result_sel = mysql_query($sel_sql) or die("失敗0");
	        if(mysql_num_rows($result_sel) < 1)
		    {
		        mysql_free_result($result_sel);
			    header("location:ca_works_data_config.php?ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]);
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
		case"up_serial_status_mode":
		
		    $tmp_ca_works_id = $_POST["up_serial_status_ca_works_id"];  //作品序號
			$tmp_ca_serial_status = $_POST["ca_serial_status"];         //連載狀態
			$tmp_ca_authors_code = $_POST["ca_authors_code"];           //作者代號
			$tmp_ca_authors_name = $_POST["ca_authors_name"];           //作品作者名稱
			
            $up_serial_status_sql = "UPDATE $dbtable_01 SET ca_serial_status = '".mysql_real_escape_string($tmp_ca_serial_status)."' WHERE ca_works_id = '".mysql_real_escape_string($tmp_ca_works_id)."'";
			mysql_query($up_serial_status_sql) or die("失敗");
			
			$sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_id = '".mysql_real_escape_string($tmp_ca_works_id)."' AND
			                                            ca_serial_status = '".mysql_real_escape_string($tmp_ca_serial_status)."'";
					                                            
																
		                //↑檢查資料寫入是否成功
		    $result = mysql_query($sel_sql) or die("失敗");
		    $row = MySQL_fetch_array($result);
		    if(!$row == 0)
		    {
			    mysql_free_result($result);
			    header("location:ca_works_data_config.php?ca_authors_code=$tmp_ca_authors_code&ca_authors_name=$tmp_ca_authors_name");
		    }
		    else
		    {
			           //顯示訊息
		        echo "<script type='text/javascript'>";
			    echo "alert('寫入失敗，請聯絡程式設計師');";
		        echo "history.back();";
			    echo "</script>";
		    }
			
			break;

	}
	
?>
</body>
</html>