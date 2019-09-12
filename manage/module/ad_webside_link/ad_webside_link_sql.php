<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="ad_webside_link_index_js_hid.js" charset = "UTF-8"></script>
<script language="javascript" src="ad_webside_link_index_js_check.js" charset = "UTF-8"></script>
<head> 
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
</head>
<body>
<?php
    
	require_once("./ad_webside_link_config.php");
	require_once("./ad_webside_link_dbtools.inc.php");
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
			$sel_sql = "SELECT * FROM $dbtable_00 WHERE ad_webside_link_name = '".mysql_real_escape_string($tmp_ad_webside_link_name)."' OR ad_webside_link_link = '".mysql_real_escape_string($tmp_ad_webside_link_website)."'";
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
			    $tmp_ad_webside_link_name = $_POST["ad_webside_link_name"];    //廣告主或友站名稱
	            $tmp_ad_webside_link_website = $_POST["ad_webside_link_website"];    //廣告主或友站網址
			    
					      if($_FILES["ad_webside_image"]["name"] != "")
						  {
						      echo $tmp_name_ad_webside_image = $_FILES["ad_webside_image"]["tmp_name"];
						      switch($_FILES["ad_webside_image"]["type"])
			                  {      //判斷上傳的圖檔類型
			                        case"image/jpeg":
				                        $tmp_ad_webside_image = "ad_webside_image".date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.jpg";
				                        break;    //檔案命名原則:一組亂數碼
				                    case"image/png":
				                        $tmp_ad_webside_image = "ad_webside_image".date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.png";
				                        break;
				                    case"image/gif":
					                    $tmp_ad_webside_image = "ad_webside_image".date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.gif";
				                        break;
			                        default:    //顯示無法支援訊息
					                       echo "<script type='text/javascript'>";
				                           echo "alert('抱歉！不支援此種檔案類型的廣告圖檔！');";
				                           echo "history.back();";
				                           echo "</script>";
				          
			                  }
							 							  
							  		    //將上傳到暫存資料夾的圖片檔移動到 /images/sys_ad_webside/資料夾裡，並變更為亂數取的檔名
		                      move_uploaded_file($tmp_name_ad_webside_image,"../../../images/sys_ad_webside/".$tmp_ad_webside_image);
			                            //後台觀看自行上傳網站瀏覽圖的路徑
			                  $tmp_ad_webside_link_cover_long_path = "../../../images/sys_ad_webside/".$tmp_ad_webside_image;
			                            //前台觀看自行上傳網站瀏覽圖的路徑
			                  $tmp_ad_webside_link_cover_path = "./images/sys_ad_webside/".$tmp_ad_webside_image;

							  
							  if(!empty($_POST["use_fb_fans"]))
			                  {    //設定為FB粉絲團
					              $tmp_ad_webside_link_fb_webside = "fb_yes";
			                  }
				              else
				              {
					              $tmp_ad_webside_link_fb_webside = "fb_no";
				              }
							  
							  $now_date = date("Y-m-d H:i:s", strtotime("+8HOUR"));
							  $ins_sql = "INSERT INTO $dbtable_00 (ad_webside_link_name, ad_webside_link_link, ad_webside_link_cover_path, ad_webside_link_cover_long_path, ad_webside_link_fb_webside, set_the_date) VALUES('".mysql_real_escape_string($tmp_ad_webside_link_name)."','".mysql_real_escape_string($tmp_ad_webside_link_website)."', '".mysql_real_escape_string($tmp_ad_webside_link_cover_path)."','".mysql_real_escape_string($tmp_ad_webside_link_cover_long_path)."', '".mysql_real_escape_string($tmp_ad_webside_link_fb_webside)."', '$now_date')";
				              $result_ins = mysql_query($ins_sql) or die("失敗1");
							  
							  
				              $sel_sql_check = "SELECT COUNT(ad_webside_link_name) FROM $dbtable_00 WHERE ad_webside_link_name = '".mysql_real_escape_string($tmp_ad_webside_link_name)."' AND
					                                                                                      ad_webside_link_link = '".mysql_real_escape_string($tmp_ad_webside_link_website)."' AND
																							              ad_webside_link_cover_path ='".mysql_real_escape_string($tmp_ad_webside_link_cover_path)."' AND
																							              ad_webside_link_cover_long_path = '".mysql_real_escape_string($tmp_ad_webside_link_cover_long_path)."' AND
																							              ad_webside_link_fb_webside = '".mysql_real_escape_string($tmp_ad_webside_link_fb_webside)."'";
				              $result_sel_check = mysql_query($sel_sql_check) or die("失敗1");
				              $row_sel_check = mysql_fetch_array($result_sel_check);
				              if($row_sel_check >= 1)
				              {
					                //mysql_free_result($result_ins);
				                  mysql_free_result($result_sel_check);
				                  header("location:ad_webside_link_index.php");
			                  }
				              else
				              {
					              mysql_free_result($result_ins);
					              mysql_free_result($result_sel_check);
						            //顯示訊息
					              echo "<script type='text/javascript'>";
					              echo "alert('資料寫入失敗，請聯絡程式設計師!!');";
					              echo "</script>";
				              }
			              }
						  else
						  {
						      echo "<script type='text/javascript'>";
				              echo "alert('您未選取任何圖檔，請再次上傳');";
				              echo "history.back();";
				              echo "</script>";
						  }
						 
				
			}
                		    
			break;			
		case"up_mode":
		    if($_FILES["ch_ad_webside_image"]["name"] != "")
			{
			    $tmp_uni_edit_name_ad_webside_image = $_FILES["ch_ad_webside_image"]["tmp_name"];
				switch($_FILES["ch_ad_webside_image"]["type"])
			    {      //判斷上傳的圖檔類型
			           case"image/jpeg":
				           $tmp_uni_edit_ad_webside_image = "ad_webside_image".date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.jpg";
				           break;    //檔案命名原則:一組亂數碼
				       case"image/png":
				           $tmp_uni_edit_ad_webside_image = "ad_webside_image".date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.png";
				           break;
				       case"image/gif":
					       $tmp_uni_edit_ad_webside_image = "ad_webside_image".date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.gif";
				           break;
			           default:    //顯示無法支援訊息
					          echo "<script type='text/javascript'>";
				              echo "alert('抱歉！不支援此種檔案類型的廣告圖檔！');";
				              echo "history.back();";
				              echo "</script>";
				          
			    }
				
				if(file_exists($_POST["old_img_logn_path"]))
			    {
			        unlink($_POST["old_img_logn_path"]);
			    }
				     //將上傳到暫存資料夾的圖片檔移動到 /images/sys_ad_webside/資料夾裡，並變更為亂數取的檔名
		        move_uploaded_file($tmp_uni_edit_name_ad_webside_image,"../../../images/sys_ad_webside/".$tmp_uni_edit_ad_webside_image);
			         //後台觀看自行上傳網站瀏覽圖的路徑
			    $tmp_uni_edit_ad_webside_link_cover_long_path = "../../../images/sys_ad_webside/".$tmp_uni_edit_ad_webside_image;
			                            //前台觀看自行上傳網站瀏覽圖的路徑
			    $tmp_uni_edit_ad_webside_link_cover_path = "./images/sys_ad_webside/".$tmp_uni_edit_ad_webside_image;
				if(!empty($_POST["use_fb_fans"]))
			    {    //設定為FB粉絲團
				    $tmp_uni_edit_ad_webside_link_fb_webside = "fb_yes";
			    }
				else
				{
				    $tmp_uni_edit_ad_webside_link_fb_webside = "fb_no";
				}
				
                $up_sql = "UPDATE $dbtable_00 SET ad_webside_link_name = '".mysql_real_escape_string($_POST["uni_edit_ad_webside_link_name"])."',
				                                  ad_webside_link_link = '".mysql_real_escape_string($_POST["uni_edit_ad_webside_link_website"])."',
												  ad_webside_link_cover_path = '".mysql_real_escape_string($tmp_uni_edit_ad_webside_link_cover_path)."',
												  ad_webside_link_cover_long_path = '".mysql_real_escape_string($tmp_uni_edit_ad_webside_link_cover_long_path)."',
												  ad_webside_link_fb_webside = '".mysql_real_escape_string($tmp_uni_edit_ad_webside_link_fb_webside)."'
												  WHERE ad_webside_link_no = '".mysql_real_escape_string($_POST["webside_link_no"])."' AND
												        set_the_date = '".mysql_real_escape_string($_POST["set_the_date"])."'";
                $result_ins = mysql_query($up_sql) or die("失敗13");

				$sel_sql_check2 = "SELECT COUNT(ad_webside_link_name) FROM $dbtable_00 WHERE ad_webside_link_name = '".mysql_real_escape_string($_POST["uni_edit_ad_webside_link_name"])."' AND
					                                                                        ad_webside_link_link = '".mysql_real_escape_string($_POST["uni_edit_ad_webside_link_website"])."' AND
																							ad_webside_link_cover_path ='".mysql_real_escape_string($tmp_uni_edit_ad_webside_link_cover_path)."' AND
																							ad_webside_link_cover_long_path = '".mysql_real_escape_string($tmp_uni_edit_ad_webside_link_cover_long_path)."' AND
																							ad_webside_link_fb_webside = '".mysql_real_escape_string($tmp_uni_edit_ad_webside_link_fb_webside)."'";
				              $result_sel_check2 = mysql_query($sel_sql_check2) or die("失敗12");
				              $row_sel_check2 = mysql_fetch_array($result_sel_check2);
				              if($row_sel_check2 >= 1)
				              {
					                //mysql_free_result($result_ins);
				                  mysql_free_result($result_sel_check);
				                  header("location:ad_webside_link_index.php");
			                  }
				              else
				              {
					              mysql_free_result($result_ins);
					              mysql_free_result($result_sel_check);
						            //顯示訊息
					              echo "<script type='text/javascript'>";
					              echo "alert('資料寫入失敗，請聯絡程式設計師!!');";
					              echo "</script>";
				              }				
			}
		
		
		    break;
		case"del_mode":
		    $tmp_del_webside = $_GET["del_webside"];
			$tmp_del_set_the_date = $_GET["del_set_the_date"];
			if(file_exists($_GET["del_img_logn_path"]))
			{
			    unlink($_GET["del_img_logn_path"]);
			}
			echo $del_sql = "DELETE FROM $dbtable_00 WHERE ad_webside_link_name = '".mysql_real_escape_string($tmp_del_webside)."' AND set_the_date = '".mysql_real_escape_string($tmp_del_set_the_date)."'";
	        mysql_query($del_sql) or die("失敗d");
		    echo $sel_sql = "SELECT * FROM $dbtable_00 WHERE ad_webside_link_name = '".mysql_real_escape_string($tmp_del_ebook_store)."' AND set_the_date = '".mysql_real_escape_string($tmp_del_set_date)."'";
	        $result_sel = mysql_query($sel_sql) or die("失敗0");
	        if(mysql_num_rows($result_sel) < 1)
		    {
		        mysql_free_result($result_sel);
			    header("location:ad_webside_link_index.php");
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