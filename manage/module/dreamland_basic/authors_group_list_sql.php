<?php 
	require_once("./dreamland_basic_config.php");       //引入相關設定檔
	require_once("./dreamland_basic_dbtools.inc.php");  //引入資料庫模組
	require_once('check_session.php');
	require_once("./rexx10_fun_tools.php");  //引入自己的工具API
    if(!empty($_POST["this_mode"]))    $this_mode = $_POST["this_mode"];
	if(!empty($_GET["this_mode"]))    $this_mode = $_GET["this_mode"];


switch($this_mode)
{
    case"ins_mode":
	    $tmp_group_authors_name = $_POST["group_authors_name"];    //作者坊-作者名稱
		$tmp_group_authors_code = $_POST["group_authors_code"];    //作者坊-作者代號
		$tmp_group_authors_webside_name = $_POST["group_authors_webside_name"];    //作者坊-作者網站名稱
		$tmp_group_authors_webside = $_POST["group_authors_webside"];    //作者坊-作者網站網址
		$tmp_group_authors_explanation = $_POST["group_authors_explanation"];    //作者坊-備註
		$tmp_authors_group_list_set_the_date = date("Y-m-d G:i:s", strtotime("+8HOUR"));
		
		$tmp_img_file = $_FILES["group_authors_img"]["tmp_name"];           //圖片來源 EX.$_FILES["myfile"]["tmp_name"];       
        $filter_img = $_FILES["group_authors_img"]["type"];                 //過濾圖片類型   EX.$_FILES["myfile"]["type"];       
        $sel_resize_type = "two";         //縮圖方式  "one" = 直接縮圖  "two" = 自動判斷寬與高進行縮圖
        $target_src_w_int = 500;        //目標寬
        $target_src_h_int = 270;       //目標高
        $target_path = "./images/sys_authors_group_list/";               //目的地資料夾路徑 "./"
        $target_full_path = "../../../images/sys_authors_group_list/";          //目的地資料夾路徑 "./fg/"
        $tmp_rand_code_or_any_int = $tmp_group_authors_code;    //任意數值"fuck"; 
		
		
	    $sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_name = '".mysql_real_escape_string($tmp_group_authors_name)."' AND
		                                            authors_code = '".mysql_real_escape_string($tmp_group_authors_code)."'";
	    $result_sel = mysql_query($sel_sql) or die("失敗11");	
	    if(mysql_num_rows($result_sel) == 0)
		{   
		    if($_FILES["group_authors_img"]["name"] != "")
		    {
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
				
				
				$ins_sql = "INSERT INTO $dbtable_04 (authors_name, 
				                                      authors_code, 
													  authors_webside_name, 
													  authors_webside, 
													  authors_explanation, 
													  authors_img_path, 
													  authors_img_full_path, 
													  authors_group_list_set_the_date) 
									         VALUES('".mysql_real_escape_string($tmp_group_authors_name)."', 
											        '".mysql_real_escape_string($tmp_group_authors_code)."', 
													'".mysql_real_escape_string($tmp_group_authors_webside_name)."', 
													'".mysql_real_escape_string($tmp_group_authors_webside)."', 
													'".mysql_real_escape_string($tmp_group_authors_explanation)."', 
													'".mysql_real_escape_string($tmp_target_path)."', 
													'".mysql_real_escape_string($tmp_target_full_path)."', 
													'".mysql_real_escape_string($tmp_authors_group_list_set_the_date)."')";
		        mysql_query($ins_sql) or die("失敗12");
				
				$sel_sql_02 = "SELECT * FROM $dbtable_04 WHERE authors_name = '".mysql_real_escape_string($tmp_group_authors_name)."' AND 
				                                            authors_code = '".mysql_real_escape_string($tmp_group_authors_code)."' AND 
															authors_webside_name = '".mysql_real_escape_string($tmp_group_authors_webside_name)."' AND 
													        authors_webside = '".mysql_real_escape_string($tmp_group_authors_webside)."' AND 
													        authors_explanation = '".mysql_real_escape_string($tmp_group_authors_explanation)."' AND 
													        authors_img_path = '".mysql_real_escape_string($tmp_target_path)."' AND 
													        authors_img_full_path = '".mysql_real_escape_string($tmp_target_full_path)."' AND 
													        authors_group_list_set_the_date = '".mysql_real_escape_string($tmp_authors_group_list_set_the_date)."'";
		        
				$result_sel_sql_02 = mysql_query($sel_sql_02) or die("失敗13");
		        $row = MySQL_fetch_array($result_sel_sql_02);
		        if(!$row == 0)
		        {
			        mysql_free_result($result);
			        header("location:authors_group_list.php");
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
			   //顯示作品名稱重複
			echo "<script type='text/javascript'>";
			echo "alert('警告！作者名稱或代號重複!');";
			echo "history.back();";
			echo "</script>";
		}
	
	
	    break;
		
    case"up_mode":
	    $authors_id = $_POST["authors_id"];
		$authors_code = $_POST["authors_code"];
		
	    if(!empty($_POST["group_authors_webside_name"]))
		{
		    $edit_group_authors_webside_name = $_POST["group_authors_webside_name"];
		} 
		if(!empty($_POST["group_authors_webside"]))
		{
		    $edit_group_authors_webside = $_POST["group_authors_webside"];
		}
		
		if(!empty($_POST["group_authors_explanation"]))
		{
		    $edit_group_authors_explanation = $_POST["group_authors_explanation"];
		}
		
		$up_sql = "UPDATE $dbtable_04 SET authors_webside_name ='".mysql_real_escape_string($edit_group_authors_webside_name)."', 
		                                  authors_webside = '".mysql_real_escape_string($edit_group_authors_webside)."', 
										  authors_explanation = '".mysql_real_escape_string($edit_group_authors_explanation)."' 
								    WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
									      authors_code = '".mysql_real_escape_string($authors_code)."'";
										  
		mysql_query($up_sql) or die("失敗up");
		
		$sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
				                                            authors_code = '".mysql_real_escape_string($authors_code)."' AND 
															authors_webside_name = '".mysql_real_escape_string($edit_group_authors_webside_name)."' AND 
													        authors_webside = '".mysql_real_escape_string($edit_group_authors_webside)."' AND 
													        authors_explanation = '".mysql_real_escape_string($edit_group_authors_explanation)."'";
		        
		$result_sel_sql = mysql_query($sel_sql) or die("失敗13");
		$row = MySQL_fetch_array($result_sel_sql);
		if(!$row == 0)
		{
		    mysql_free_result($result);
		    header("location:authors_group_list.php");
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
    case"up_img_mode":
	    $authors_id = $_POST["authors_id"];
		$authors_code = $_POST["authors_code"];
		

		
		$tmp_img_file = $_FILES["ch_group_authors_img"]["tmp_name"];           //圖片來源 EX.$_FILES["myfile"]["tmp_name"];       
        $filter_img = $_FILES["ch_group_authors_img"]["type"];                 //過濾圖片類型   EX.$_FILES["myfile"]["type"];       
        $sel_resize_type = "two";         //縮圖方式  "one" = 直接縮圖  "two" = 自動判斷寬與高進行縮圖
        $target_src_w_int = 500;        //目標寬
        $target_src_h_int = 270;       //目標高
        $target_path = "./images/sys_authors_group_list/";               //目的地資料夾路徑 "./"
        $target_full_path = "../../../images/sys_authors_group_list/";          //目的地資料夾路徑 "./fg/"
        $tmp_rand_code_or_any_int = $authors_code;    //任意數值"fuck";
		
        $sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
				                                    authors_code = '".mysql_real_escape_string($authors_code)."'";
		$result = mysql_query($sel_sql) or die("失敗up");
		
		if(file_exists(mysql_result($result, 0, "authors_img_full_path")))
	    {		//檢查是否有檔案
	
			unlink(mysql_result($result, 0, "authors_img_full_path"));
						//刪除圖片	
	    }	
		mysql_free_result($result);
		
		if($_FILES["ch_group_authors_img"]["name"] != "")
		{
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
				
				
			$up_sql = "UPDATE $dbtable_04 SET authors_img_path ='".mysql_real_escape_string($tmp_target_path)."', 
											  authors_img_full_path = '".mysql_real_escape_string($tmp_target_full_path)."'
			     					    WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
									          authors_code = '".mysql_real_escape_string($authors_code)."'";
										  
	        mysql_query($up_sql) or die("失敗up");
		
		    $sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
				                                        authors_code = '".mysql_real_escape_string($authors_code)."' AND 
												        authors_img_path = '".mysql_real_escape_string($tmp_target_path)."' AND 
													    authors_img_full_path = '".mysql_real_escape_string($tmp_target_full_path)."'";
		        
		    $result= mysql_query($sel_sql) or die("失敗13");
		    $row = MySQL_fetch_array($result);
		    if(!$row == 0)
		    {
		    mysql_free_result($result);
		    header("location:authors_group_list.php");
		    }
		    else
		    {
			               //顯示訊息
		        echo "<script type='text/javascript'>";
			    echo "alert('寫入失敗，請聯絡程式設計師');";
		        echo "history.back();";
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

	case"del_mode":
	      $authors_id = $_GET["authors_id"];
	      $authors_code = $_GET["authors_code"];
	  
	      $sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
				                                      authors_code = '".mysql_real_escape_string($authors_code)."'";
	      $result = mysql_query($sel_sql) or die("失敗1");
	      
	      if(file_exists(mysql_result($result, 0, "authors_img_full_path")))
	      {		//檢查是否有檔案
	
		      unlink(mysql_result($result, 0, "authors_img_full_path"));
						//刪除圖片
	      }	
           
		  mysql_free_result($result);
		   
	      $del_sql = "DELETE FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
				                                    authors_code = '".mysql_real_escape_string($authors_code)."'";
	      mysql_query($del_sql) or die("失敗1");
	  
	      $sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
				                                      authors_code = '".mysql_real_escape_string($authors_code)."'";
													  
	      		  
          $result= mysql_query($sel_sql) or die("失敗13");
		  $row = MySQL_fetch_array($result);
		  if(mysql_num_rows($result_sel) == 0)
		  {
		      mysql_free_result($result);
		      header("location:authors_group_list.php");
		  }
		  else
		  {
			               //顯示訊息
		      echo "<script type='text/javascript'>";
			  echo "alert('寫入失敗，請聯絡程式設計師');";
		      echo "history.back();";
		  }
	    break;
}




?>