<?php


/*  函數用變數，說明
require_once("rexx10_fun_tools.php");  //使用前先引入API檔
$tmp_img_file = ;            //圖片來源 EX.$_FILES["myfile"]["tmp_name"];       
$filter_img = ;                 //過濾圖片類型   EX.$_FILES["myfile"]["type"];       
$sel_resize_type = "";         //縮圖方式  "one" = 直接縮圖  "two" = 自動判斷寬與高進行縮圖
$target_src_w_int = 78;        //目標寬
$target_src_h_int = 120;       //目標高
$target_path = ;               //目的地資料夾路徑 "./"
$target_full_path = ;          //目的地資料夾路徑 "./fg/"
$tmp_rand_code_or_any_int =;    //任意數值"fuck"; 




$aa = rexx10_thumbnail_tools($tmp_img_file, 
                                $filter_img, 
								$se_resize_type, 
								$target_src_w_int, 
								$target_src_h_int, 
								$target_path, 
								$target_full_path, 
								$tmp_rand_code_or_any_int);
*/

function rexx10_thumbnail_tools($tmp_img_file, $filter_img, $sel_resize_type, $target_src_w_int, $target_src_h_int, $target_path, $target_full_path, $tmp_rand_code_or_any_int)
{
    switch($filter_img)
	{   //過濾圖片副檔名
		case"image/jpeg":
		$tmp_src = @imagecreatefromjpeg($tmp_img_file);
		break;
		case"image/gif":
		$tmp_src = @imagecreatefromgif($tmp_img_file);
		break;
		case"image/png":
		$tmp_src = @imagecreatefrompng($tmp_img_file);
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
	if($tmp_src_w != $target_src_w_int or $tmp_src_h != $target_src_h_int)
	{
	    switch($sel_resize_type)
		{
		    case"one":
			    $thumb_w = $target_src_w_int;
	            $thumb_h = $target_src_h_int;
			    break;
		    case"two":
			    if($tmp_src_w > $tmp_src_h)
	            {      //縮圖判斷
	                $thumb_w = $target_src_h_int;
	                $thumb_h = intval($tmp_src_h / $tmp_src_w * 100);
	            }
	            else
	            {
		            $thumb_h = $target_src_w_int;
		            $thumb_w = intval($tmp_src_w / $tmp_src_h * 100);
	            }			
			    break;	    
		}
	}
	else
	{
		$thumb_h = $tmp_src_h;
		$thumb_w = $tmp_src_w;
	}
					
	$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
	imagecopyresized($thumb, $tmp_src, 0, 0, 0, 0, $thumb_w, $thumb_h, $tmp_src_w, $tmp_src_h);
					
	switch($filter_img)
	{
	    case"image/jpeg":  //過濾圖片並依副檔名分類儲存
		    $tmp_rand_code_image_file_name = $tmp_rand_code_or_any_int."-".uniqid().".jpg";
		    imagejpeg($thumb, $target_full_path.$tmp_rand_code_image_file_name);  //將暫存檔改名，並寫入指定位置
		    break;
	    case"image/gif";
			$tmp_rand_code_image_file_name = $tmp_rand_code_or_any_int."-".uniqid().".gif";
			imagegif($thumb, $target_full_path.$tmp_rand_code_image_file_name);  //將暫存檔改名，並寫入指定位置
			break;
		case"image/png";
			$tmp_rand_code_image_file_name = $tmp_rand_code_or_any_int."-".uniqid().".png";
			imagepng($thumb, $target_full_path.$tmp_rand_code_image_file_name);  //將暫存檔改名，並寫入指定位置
			break;
	}
	
	    //將$my_target_path宣告成陣列
	$my_target_path = array();	
    $my_target_path[] = $tmp_target_path = $target_path.$tmp_rand_code_image_file_name;  //作者代表圖路徑
	$my_target_path[] = $tmp_target_full_path = $target_full_path.$tmp_rand_code_image_file_name; //作者代表圖長路徑
	
	return $my_target_path;
	
}
?>