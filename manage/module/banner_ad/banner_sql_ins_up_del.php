<?php

	//引入SQL相關動作
	require_once("./banner_config.php");
	require_once("./banner_dbtools.inc.php");
	require_once('check_session.php');
	//echo $_POST["t_banner_pic"];
	//檢查變數傳來是否為空值
    if(!empty($_POST["t_banner_pic"]))
	{
	
        $t_banner_sel = $_POST["t_banner_pic"];
		$filename00 = $_POST["filename00"];
		$banner_ad_idno_00 = $_POST["banner_ad_idno_00"];
		//$tmp_ch_my_banner_file_link = $_POST["ch_my_banner_file_link"];
  
    }
	elseif(!empty($_GET["t_banner_pic"]))
	{
  
        $t_banner_sel = $_GET["t_banner_pic"];	
		$filename00 = $_GET["filename00"];
		$banner_ad_idno_00 = $_GET["banner_ad_idno_00"];
  
    }
	
	 //檢查進行 新增/修改/刪除 動作
	switch ($t_banner_sel){
	    case "new_banner":
		  //檢查是否有選擇圖檔
		    if($_FILES["my_banner_pic"]["name"] != ""){
			    				
			    $image_banner_file = $_FILES["my_banner_pic"]["tmp_name"];
                $banner_desc_file_name = uniqid().".jpg";
				
		        //將上傳到暫存資料夾的圖片檔移動到 Photo資料夾裡，並變更為亂數取的檔名
		        move_uploaded_file($image_banner_file,"./banner_ad_pic/". $banner_desc_file_name);
				
				//後台瀏覽路徑
			    $banner_file_name = "./banner_ad_pic/$banner_desc_file_name";
				//前台瀏覽路徑
			    $banner_file_name2 = "./manage/module/banner_ad/banner_ad_pic/$banner_desc_file_name";
				
			    //寫入banner_ad 資料表語句
			    $insert_sql = "INSERT INTO $dbtable_00 (idno, filepiclink, filepiclink2)
				              VALUES (1, '$banner_file_name', '$banner_file_name2')";
							  
			    $result = mysql_query($insert_sql) or die("失敗");
				
			    if(!mysql_query($result) == 1){
				
				    mysql_free_result($result);
				    //將網頁導至主選單
				    header("location:banner_ad_view.php");
			
			    }else{
			
				    mysql_free_result($result);
					
				    //顯示無法上傳
				    echo "<script type='text/javascript'>";
				    echo "alert('您所上傳的檔案無法儲存，請再次上傳');";
				    echo "history.back();";
				    echo "</script>";
				}
					
			}else{
			
		        //顯示無法上傳
		        echo "<script type='text/javascript'>";
		        echo "alert('您未選取任何圖檔，請再次上傳');";
			    echo "history.back();";
			    echo "</script>";
		
		    }
	
	    break;
		
	case "edit_banner_ad_pic":
	//echo $_FILES["my_banner_edit_pic"]["name"];
		if($_FILES["my_banner_edit_pic"]["name"] != "")
		{
			if(!empty($_POST["my_banner_webside_path"]) and empty($_POST["t_banner_pic02_1"]))
			{  //用於判斷是否是否有上傳檔案，如上傳附件，則不為空直，
			
			   if((false !== strpos($_POST["my_banner_webside_path"], "http://")) or (false !== strpos($_POST["my_banner_webside_path"], "https://"))){
			       $tmp_my_banner_webside_path = $_POST["my_banner_webside_path"];   
			   }else{
			       $tmp_my_banner_webside_path = "http://".$_POST["my_banner_webside_path"];
			   }
			   //echo "<BR>001<BR>";
			}
			elseif(empty($_POST["my_banner_webside_path"]) or !empty($_POST["t_banner_pic02_1"]))
			{
			    if(empty($_POST["my_banner_webside_path"]))
				{    
					if(empty($_POST["my_banner_webside_path"]))
					{
				        echo $tmp_my_banner_webside_path = "#";
					}
					if(!empty($_POST["t_banner_pic02_1"]))
					{
					    if(!empty($_POST["ch_my_banner_webside_path"]))
						{
						    if((false !== strpos($_POST["ch_my_banner_webside_path"], "http://")) or (false !== strpos($_POST["ch_my_banner_webside_path"], "https://"))){
							
						        $tmp_my_banner_webside_path = $_POST["ch_my_banner_webside_path"];
							
							}else{
								
								$tmp_my_banner_webside_path = "http://".$_POST["ch_my_banner_webside_path"];
							
							}
							
						}else{
						
						    $tmp_my_banner_webside_path = "#";
						
						}
					    //$edit_banner_file_or_path = $_POST["ch_my_banner_file_link"];
				       // $edit_file_type_filepath_or_filelink = "filelink"; 
                        //$edit_temp_my_banner_file_or_path = $edit_banner_file_or_path;
				            //標記filepath(有上傳檔案) 或 filelink(非上傳檔案)
					}
					elseif(empty($_POST["t_banner_pic02_1"]))
					{
					    echo "<BR>002<BR>";					
					}				
				}
				elseif(!empty($_POST["t_banner_pic02_1"]))
				{		//判斷修改頁面是否有上傳檔案
					if($_POST["t_banner_f_t_f_o_f"] == "filepath")
					{
					    $tmp_my_banner_file_or_path = ($_FILES["my_banner_file_or_path"]["name"]);
						echo "<BR>003<BR>";
					}
					elseif($_POST["t_banner_f_t_f_o_f"] == "filelink")
					{
					    $edit_banner_file_or_path = $_POST["ch_my_banner_file_link"];
						$edit_file_type_filepath_or_filelink = "filelink";
						echo "<BR>004<BR>";
					}				
				}
			}			
			
/* 	        if($tmp_my_banner_webside_path != "")
			{
			    $edit_my_banner_file_or_path = $_FILES["my_banner_file_or_path"]["tmp_name"];
				switch($_FILES["my_banner_file_or_path"]["type"])
				{     //判斷橫幅廣告上傳附件的類型，只支援jpg/png/gif/html其他不支援。
				      case"image/jpeg":
						  $edit_temp_my_banner_file_or_path = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_f.jpg";
					      break;   //檔案命名原則，當天日期+一組亂數碼
					  case"image/png":
					      $edit_temp_my_banner_file_or_path = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_f.png";
					      break;
					  case"image/gif":
					      $edit_temp_my_banner_file_or_path = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_f.gif";
					      break;
				      case"text/html":
					      $edit_temp_my_banner_file_or_path = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_f.htm";
					      break;
					  default:    //顯示無法支援訊息
					         echo "<script type='text/javascript'>";
				             echo "alert('抱歉！不支援此種檔案類型的附件！');";
				             echo "history.back();";
				             echo "</script>";
												  
				}
				move_uploaded_file($edit_my_banner_file_or_path,"../../../images/sys_banner_ad/banner_files/".$edit_temp_my_banner_file_or_path);
				    //將檔案移至指定路徑，並重新命名
				$edit_banner_file_or_path = "./images/sys_banner_ad/banner_files/$edit_temp_my_banner_file_or_path";
					//前台連接檔案的路徑
				$edit_file_type_filepath_or_filelink = "filepath";   
				    //標記filepath(有上傳檔案) 或 filelink(非上傳檔案)
			}
			else
			{
			    if(empty($_POST["ch_my_banner_file_link"]))
				{
			        $edit_banner_file_or_path = "#";
				    $edit_file_type_filepath_or_filelink = "filelink"; 
                    $edit_temp_my_banner_file_or_path = $edit_banner_file_or_path;
				        //標記filepath(有上傳檔案) 或 filelink(非上傳檔案)
				}
			} */
			$edit_file_type_filepath_or_filelink = "filelink";
			$edit_banner_file_or_path = $tmp_my_banner_webside_path;
			$edit_image_banner_file = $_FILES["my_banner_edit_pic"]["tmp_name"];
			
			if($_POST["t_banner_pic02"] != "")
			{  //刪除橫幅廣告檔
			    if(file_exists($_POST["t_banner_pic02"]))
				{
	
				    unlink($_POST["t_banner_pic02"]);
	
			    }
			}
			if($_POST["t_banner_pic02_1"] != "")
			{  //刪除附件檔
			    if(file_exists($_POST["t_banner_pic02_1"]))
				{
	
				    unlink($_POST["t_banner_pic02_1"]);
	
			    }
			}
			
			switch($_FILES["my_banner_edit_pic"]["type"])
			{      //判斷上傳的圖檔類型
			      case"image/jpeg":
				      $edit_banner_desc_file_name = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.jpg";
				      break;    //檔案命名原則:一組亂數碼
				  case"image/png":
				      $edit_banner_desc_file_name = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.png";
				      break;
				  case"image/gif":
					  $edit_banner_desc_file_name = date("Ymd", strtotime("+8HOUR"))."-".uniqid()."_p.gif";
				      break;
			      default:    //顯示無法支援訊息
					     echo "<script type='text/javascript'>";
				         echo "alert('抱歉！不支援此種檔案類型的廣告圖檔！');";
				         echo "history.back();";
				         echo "</script>";
				          
			}
			
			
		    //將上傳到暫存資料夾的圖片檔移動到 Photo資料夾哩，並變更為亂數取的檔名
		    move_uploaded_file($edit_image_banner_file,"../../../images/sys_banner_ad/banner_pic/". $edit_banner_desc_file_name);
			//後台觀看影像的路徑
			$edit_banner_file_name = "../../../images/sys_banner_ad/banner_pic/$edit_banner_desc_file_name";
			//前台觀看影像的路徑
			$edit_banner_file_name2 = "./images/sys_banner_ad/banner_pic/$edit_banner_desc_file_name";
			/* $dbtable_00;
			$filename00;
			$edit_banner_file_name;
			$edit_banner_file_name2;
			$banner_ad_idno_00; */
			 //寫入banner_ad 資料表語句
/* 			 $update_sql = "UPDATE $dbtable_00 SET filename = '$filename00', 
			              filepiclink = '$edit_banner_file_name', 
			              filepiclink2 = '$edit_banner_file_name2', 
						  file_path_or_file_link = '$edit_banner_file_or_path',
						  file_type_filepath_or_filelink = '$edit_file_type_filepath_or_filelink',
						  file_upload_file_name = '$edit_temp_my_banner_file_or_path',
						  pic_type = '1'
			              WHERE idno2 = '$banner_ad_idno_00'";  */

			 $update_sql = "UPDATE $dbtable_00 SET filename = '$filename00', 
			              filepiclink = '$edit_banner_file_name', 
			              filepiclink2 = '$edit_banner_file_name2', 
                          file_type_filepath_or_filelink = '$edit_file_type_filepath_or_filelink',						  
						  file_path_or_file_link = '$edit_banner_file_or_path',
						  pic_type = '1'
			              WHERE idno2 = '$banner_ad_idno_00'"; 						  
						
						  			
			$result=mysql_query($update_sql) or die("失敗");
			
			if(!mysql_query($result) == 1){
			    mysql_free_result($result);			       
                header("Location:banner_ad_index.php");    //將頁面導引至橫幅廣告編輯頁
			}
			else
			{
			
				mysql_free_result($result);
				//顯示無法上傳
				echo "<script type='text/javascript'>";
				echo "alert('您所上傳的檔案無法儲存，請再次上傳');";
				echo "history.back();";
				echo "</script>";
		
			}
		
		}
		else
		{
		
			 //顯示無法上傳
			echo "<script type='text/javascript'>";
			echo "alert('您未選取任何圖檔，請再次上傳');";
			echo "history.back();";
			echo "</script>";
		
		}
	
	break;

	case "del_banner_ad_pic":
		$search_del_banner_ad_filepiclink = $_GET["name2"];
		$search_del_file_path_or_file_link = $_GET["file_path_or_file_link"];
		//檢查 圖片是否存在，如果存在就刪除指定圖片
		if(file_exists($search_del_banner_ad_filepiclink))
		{
	
			unlink($search_del_banner_ad_filepiclink);
	
		}
		
		if(file_exists($search_del_file_path_or_file_link))
		{
	
			unlink($search_del_file_path_or_file_link);
	
		}
		
		//$delete_sql = "DELETE FROM $dbtable_00 WHERE filepiclink = '$search_del_banner_ad_filepiclink'";
		
		$delete_sql = "UPDATE $dbtable_00 SET filename = '0', 
			              filepiclink = '0', 
			              filepiclink2 = '0', 
						  pic_type = '0', 
						  file_path_or_file_link = '0', 
						  file_type_filepath_or_filelink = '0', 
						  file_upload_file_name = '0'
			              WHERE idno2 = '$banner_ad_idno_00'"; 
		
		$result = mysql_query($delete_sql) or die("失敗");
		   //將網頁導向 adv_select_editor.php，也就是選則要編輯的廣告頁面
		header("location:banner_ad_index.php");

	}
?>