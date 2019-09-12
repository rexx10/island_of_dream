<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
    
	require_once("creation_article_config.php");
	require_once("creation_article_dbtools.inc.php");
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
		    $tmp_ca_authors_code = $_POST["ca_authors_code"];          //作者代號
			$tmp_ca_authors_name = $_POST["ca_authors_name"];          //作品作者名稱
			$tmp_ca_works_id = $_POST["ca_works_id"];                  //作品序號
			$tmp_ca_chapters_name = $_POST["ca_chapters_name"];        //章回名稱
			$tmp_ca_post_date = $_POST["ca_post_date"];                //章回刊載日
			$tmp_ca_chapters_detail = $_POST["ca_chapters_detail"];    //章回內容
			$tmp_ca_ch_set_the_date= $_POST["ca_ch_set_the_date"];     //章回設定時間
			
			
            $sel_sql = "SELECT * FROM $dbtable_02 WHERE ca_chapters_name = '".mysql_real_escape_string($tmp_ca_chapters_name)."'";
            $result_sel = mysql_query($sel_sql) or die("失敗0");
			mysql_num_rows($result_sel);
            if(mysql_num_rows($result_sel) == 0)
		    {
				
				echo $ins_sql = "INSERT INTO $dbtable_02 (ca_works_id,
				                                     ca_chapters_name,
				                                     ca_post_date,
													 ca_chapters_detail,
													 ca_ch_set_the_date)
											VALUES ('".mysql_real_escape_string($tmp_ca_works_id)."', 
											        '".mysql_real_escape_string($tmp_ca_chapters_name)."', 
											        '".mysql_real_escape_string($tmp_ca_post_date)."',
													'".mysql_real_escape_string($tmp_ca_chapters_detail)."', 
													'".mysql_real_escape_string($tmp_ca_ch_set_the_date)."')";
					
					                                                                                                                                       
		                  //↑寫入資料
		        mysql_query($ins_sql) or die("失敗00");
		            //mysql_free_result($result);
		        echo $sel_sql = "SELECT * FROM $dbtable_02 WHERE ca_works_id = '".mysql_real_escape_string($tmp_ca_works_id)."' AND
					                                        ca_post_date = '".mysql_real_escape_string($tmp_ca_post_date)."' AND 
															ca_chapters_name = '".mysql_real_escape_string($tmp_ca_chapters_name)."' AND 
															ca_chapters_detail = '".mysql_real_escape_string($tmp_ca_chapters_detail)."' AND 
															ca_ch_set_the_date = '".mysql_real_escape_string($tmp_ca_ch_set_the_date)."'";
					                                            
																
		                //↑檢查資料寫入是否成功
		        $result = mysql_query($sel_sql) or die("失敗01");
		        $row = MySQL_fetch_array($result);
		        if(!$row == 0)
		        {
			        mysql_free_result($result);
			        header("location:creation_article_chapters_b.php?ca_authors_code=$tmp_ca_authors_code&ca_authors_name=$tmp_ca_authors_name&ca_works_id=$tmp_ca_works_id");
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
			    echo "alert('注意！作品名稱重複!');";
			    echo "history.back();";
			    echo "</script>";
			}
			break;			
		case"up_mode":
		
		    
			$tmp_ch_ca_chapters_detail = $_POST["ch_ca_chapters_detail"];			
			
			$old_ca_chapters_name = $_POST["old_ca_chapters_name"];
			$old_ca_chapters_detail = $_POST["old_ca_chapters_detail"];
			$ca_works_id = $_POST["ca_works_id"];
			$ca_chapters_list_id = $_POST["ca_chapters_list_id"];
		
		    
		 //ca_chapters_name = '".mysql_real_escape_string($tmp_del_ca_chapters_list_id)."', 
				    $up_sql = "UPDATE $dbtable_02 SET ca_chapters_detail = '".mysql_real_escape_string($tmp_ch_ca_chapters_detail)."'
					                              WHERE ca_works_id = '".mysql_real_escape_string($ca_works_id)."' AND 
												        ca_chapters_list_id = '".mysql_real_escape_string($ca_chapters_list_id)."'";
														
					mysql_query($up_sql) or die("失敗23");
					$sel_sql = "SELECT * FROM $dbtable_02 WHERE ca_chapters_list_id = '".mysql_real_escape_string($ca_chapters_list_id)."' AND 
					                                            ca_works_id = '".mysql_real_escape_string($ca_works_id)."' AND 
																ca_chapters_detail = '".mysql_real_escape_string($tmp_ch_ca_chapters_detail)."'";
					
					$result = mysql_query($sel_sql) or die("失敗24");
		            $row = MySQL_fetch_array($result);
		            if(!$row == 0)
		            {   //ca_chapters_list_id=6&ca_works_id=2&ca_authors_code=ZEROd&ca_authors_name=dfdfd
			            mysql_free_result($result);
			            header("location:creation_article_chapters_uni_edit.php?ca_authors_code=".$_POST["ca_authors_code"]."&ca_authors_name=".$_POST["ca_authors_name"]."&ca_works_id=".$ca_works_id."&ca_chapters_list_id=".$ca_chapters_list_id);
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
            $tmp_del_ca_chapters_list_id = $_GET["del_ca_chapters_list_id"];          //欲刪除的章回編號
			$tmp_del_ca_works_id = $_GET["del_ca_works_id"];          //欲刪除的作品序號
			$tmp_del_ca_chapters_name = $_GET["del_ca_chapters_name"];                  //欲刪除的作品名稱
			//$tmp_del_ca_chapters_detail = $_GET["del_ca_chapters_detail"];        //欲章回內容
			

			
			$del_sql = "DELETE FROM $dbtable_02 WHERE ca_chapters_list_id= '".mysql_real_escape_string($tmp_del_ca_chapters_list_id)."' AND 
			                                          ca_works_id = '".mysql_real_escape_string($tmp_del_ca_works_id)."' AND 
													  ca_chapters_name = '".mysql_real_escape_string($tmp_del_ca_chapters_name)."'";
	        mysql_query($del_sql) or die("失敗d");
		    $sel_sql = "SELECT * FROM $dbtable_02 WHERE ca_chapters_list_id= '".mysql_real_escape_string($tmp_del_ca_chapters_list_id)."' AND 
			                                          ca_works_id = '".mysql_real_escape_string($tmp_del_ca_works_id)."' AND 
													  ca_chapters_name = '".mysql_real_escape_string($tmp_del_ca_chapters_name)."'";
													  
	        $result_sel = mysql_query($sel_sql) or die("失敗0");
	        if(mysql_num_rows($result_sel) < 1)
		    {
		        mysql_free_result($result_sel);
			    header("location:creation_article_chapters_b.php?ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."&ca_works_id=".$_GET["del_ca_works_id"]);
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