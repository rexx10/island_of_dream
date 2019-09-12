<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<title></title>
 <link rel="shortcut icon" href="./../../../images/logo2.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
	        $tmp_ca_authors_name = $_POST["ca_authors_name"];    //作者姓名
            $sel_sql = "SELECT * FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($tmp_ca_authors_code)."' OR ca_authors_name = '".mysql_real_escape_string($tmp_ca_authors_name)."'";
            echo $result_sel = mysql_query($sel_sql) or die("失敗0");
			echo mysql_num_rows($result_sel);
            if(mysql_num_rows($result_sel) == 0)
		    {
				
				if($_FILES["ca_authors_image"]["name"] != "")   //檢查是否選擇圖檔
	            {
		
		            switch($_FILES["ca_authors_image"]["type"])
		            {
			            case"image/jpeg":
				            $tmp_src = @imagecreatefromjpeg($_FILES["ca_authors_image"]["tmp_name"]);
			                break;
			            case"image/gif":
				            $tmp_src = @imagecreatefromgif($_FILES["ca_authors_image"]["tmp_name"]);
			                break;
			            case"image/png":
				            $tmp_src = @imagecreatefrompng($_FILES["ca_authors_image"]["tmp_name"]);
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
					
					$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
					imagecopyresized($thumb, $tmp_src, 0, 0, 0, 0, $thumb_w, $thumb_h, $tmp_src_w, $tmp_src_h);
					
					switch($_FILES["ca_authors_image"]["type"])
		            {
			            case"image/jpeg":
				            $tmp_ca_authors_image_file_name = $tmp_ca_authors_code."-".uniqid().".jpg";
				            imagejpeg($thumb, "../../../images/sys_creation_article/ca_authors_img/".$tmp_ca_authors_image_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/gif";
				            $tmp_ca_authors_image_file_name = $tmp_ca_authors_code."-".uniqid().".gif";
				            imagegif($thumb, "../../../images/sys_creation_article/ca_authors_img/".$tmp_ca_authors_image_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
			            case"image/png";
				            $tmp_ca_authors_image_file_name = $tmp_ca_authors_code."-".uniqid().".png";
				            imagepng($thumb, "../../../images/sys_creation_article/ca_authors_img/".$tmp_ca_authors_image_file_name);  //將暫存檔改名，並寫入指定位置
			                break;
		            }
					$tmp_ca_authors_img_path = "/images/sys_images/ca_authors_img/$tmp_ca_authors_image_file_name";  //作者代表圖路徑
		            $tmp_ca_authors_img_long_path = "../../../images/sys_creation_article/ca_authors_img/$tmp_ca_authors_image_file_name"; //作者代表圖長路徑
					
					$ins_sql = "INSERT INTO $dbtable_00 (ca_authors_code, ca_authors_name, ca_author_code_img_path, ca_author_code_img_long_path) VALUES ('".mysql_real_escape_string($tmp_ca_authors_code)."', '".mysql_real_escape_string($tmp_ca_authors_name)."', '".mysql_real_escape_string($tmp_ca_authors_img_path)."', '".mysql_real_escape_string($tmp_ca_authors_img_long_path)."')";
					
					                                                                                                                                       
		                  //↑寫入資料
		            $result = mysql_query($ins_sql) or die("失敗");
		                //mysql_free_result($result);
		            $sel_sql = "SELECT * FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($tmp_ca_authors_code)."' and
					                                            ca_authors_name = '".mysql_real_escape_string($tmp_ca_authors_name)."' and 
																ca_author_code_img_path = '".mysql_real_escape_string($tmp_ca_authors_img_path)."' and 
																ca_author_code_img_long_path = '".mysql_real_escape_string($tmp_ca_authors_img_long_path)."'";
					                                            
																
		                //↑檢查資料寫入是否成功
		            $result = mysql_query($sel_sql) or die("失敗");
		            $row = MySQL_fetch_array($result);
		            if(!$row == 0)
		            {
			            mysql_free_result($result);
			            header("location:ca_authors_data_config.php");
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
	    
 			         //顯示訊息
			        echo "<script type='text/javascript'>";
			        echo "alert('上傳失敗或未選擇圖片，請再次上傳');";
			        echo "history.back();";
			        echo "</script>";
		
	            }	
			  
		    }
		    else
			{
			    mysql_free_result($result_sel);
			      //顯示作者代號或姓名有重複
			    echo "<script type='text/javascript'>";
			    echo "alert('注意！作者代號或作者姓名有重複!');";
			    echo "history.back();";
			    echo "</script>";
			}
			break;			
		case"up_mode":

		    break;
			
		case"up_img_mode":
		    $ca_authors_code = $_POST["ca_authors_code"];
			$ca_authors_name = $_POST["ca_authors_name"];
						
			$tmp_img_file = $_FILES["ch_authors_data_config_img"]["tmp_name"];           //圖片來源 EX.$_FILES["myfile"]["tmp_name"];       
            $filter_img = $_FILES["ch_authors_data_config_img"]["type"];                 //過濾圖片類型   EX.$_FILES["myfile"]["type"];       
            $sel_resize_type = "one";         //縮圖方式  "one" = 直接縮圖  "two" = 自動判斷寬與高進行縮圖
            $target_src_w_int = 154;        //目標寬
            $target_src_h_int = 64;       //目標高
            $target_path = "/images/sys_images/ca_authors_img/";               //目的地資料夾路徑 "./"
            $target_full_path = "../../../images/sys_creation_article/ca_authors_img/";          //目的地資料夾路徑 "./fg/"
            $tmp_rand_code_or_any_int = $ca_authors_code;    //任意數值"fuck"; 




            $tmp_my_target_path = rexx10_thumbnail_tools($tmp_img_file, 
                                                         $filter_img, 
								                         $sel_resize_type, 
								                         $target_src_w_int, 
								                         $target_src_h_int, 
								                         $target_path, 
								                         $target_full_path, 
								                         $tmp_rand_code_or_any_int);
			
			
			

			$sel_sql = "SELECT * FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($ca_authors_code)."' AND 
			                                            ca_authors_name = '".mysql_real_escape_string($ca_authors_name)."'";
		    $result = mysql_query($sel_sql) or die("失敗4");
			if(file_exists(mysql_result($result, 0, "ca_author_code_img_long_path")))
			{
			    unlink(mysql_result($result, 0, "ca_author_code_img_long_path"));
			}
			mysql_free_result($result);
			echo $tmp_target_path = $tmp_my_target_path[0];
			echo $tmp_target_full_path = $tmp_my_target_path[1];
			
			$up_sql = "UPDATE $dbtable_00 SET ca_author_code_img_path = '".mysql_real_escape_string($tmp_target_path)."', 
			                                  ca_author_code_img_long_path = '".mysql_real_escape_string($tmp_target_full_path)."'
									    WHERE 
										      ca_authors_code = '".mysql_real_escape_string($ca_authors_code)."' AND 
			                                  ca_authors_name = '".mysql_real_escape_string($ca_authors_name)."'";
			mysql_query($up_sql) or die("失敗4");
		    $sel_sql = "SELECT * FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($ca_authors_code)."' AND 
			                                            ca_authors_name = '".mysql_real_escape_string($ca_authors_name)."' AND
			                                            ca_author_code_img_path = '".mysql_real_escape_string($tmp_target_path)."' AND 
			                                            ca_author_code_img_long_path = '".mysql_real_escape_string($tmp_target_full_path)."'";
			$result = mysql_query($sel_sql) or die("失敗4");
						   
			$row = MySQL_fetch_array($result);
		    if(!$row == 0)
		    {
			    mysql_free_result($result);
			    header("location:ca_authors_data_config.php");
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
		case"del_mode":
		    $tmp_del_ca_authors_code = $_GET["del_ca_authors_code"];
			$tmp_del_ca_authors_name = $_GET["del_ca_authors_name"];
			if(file_exists($_GET["del_ca_author_code_img_long_path"]))
			{
			    unlink($_GET["del_ca_author_code_img_long_path"]);
			}
			$del_sql = "DELETE FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($tmp_del_ca_authors_code)."' AND ca_authors_name = '".mysql_real_escape_string($tmp_del_ca_authors_name)."'";
	        mysql_query($del_sql) or die("失敗d");
		    $sel_sql = "SELECT * FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($tmp_del_ca_authors_code)."' AND ca_authors_name = '".mysql_real_escape_string($tmp_del_ca_authors_name)."'";
	        $result_sel = mysql_query($sel_sql) or die("失敗0");
	        if(mysql_num_rows($result_sel) < 1)
		    {
		        mysql_free_result($result_sel);
			    header("location:ca_authors_data_config.php");
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
</body>
</html>