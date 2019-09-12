<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="ad_webside_link_index_js_hid.js" charset = "UTF-8"></script>
<script language="javascript" src="ad_webside_link_index_js_check.js" charset = "UTF-8"></script>
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
<link rel=stylesheet type="text/css" href="./ad_webside_link_index_css.css">
<head> 
<title>夢之鄉-新增 / 刪除 側攔廣告</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
</head>
<body>
<div id="ad_webside_link_main_title">
<font size="7">新增 / 修改 / 刪除 側攔廣告</font><HR>
</div>
<Form name="form1" method="POST" action="ad_webside_link_sql.php" enctype="multipart/form-data">
<input type="hidden" name="this_mode" value="ins_mode">
<div id="ad_webside_link_main_out">
<!--<div id="ad_webside_link_detail00">是否要使用網站縮圖功能：
<input  type="radio" name="use_this_tool" id="raido_sel_this_yes" onclick='showhidediv("raido_sel_yes")' value="yes_this_tool" checked>使用
<input  type="radio" name="use_this_tool" id="raido_sel_this_no" onclick='showhidediv("raido_sel_no")' value="no_this_tool">不使用</div>
<div id="ad_webside_link_detail00"><font size="3" color="red">※網站縮圖功能如法使用，請改用手動上傳圖片※</font></div>-->
<div id="ad_webside_link_detail01">設定為FaceBook網站：<input type="checkbox"  name="use_fb_fans" value="fb_fans_yes" id="use_fb_fans"></div>
<div id="ad_webside_link_detail02">請輸入廣告主或友站名稱：<input type="text" name="ad_webside_link_name" id="keyin_box00" style="width:300px"></div>
<div id="ad_webside_link_detail03">請輸入廣告主或友站網址：<input type="text" name="ad_webside_link_website" id="keyin_box01" style="width:300px"></div> 
<div id="raido_sel_no">請選擇廣告主或友站圖檔：<input type="file" name="ad_webside_image" id="keyin_box02"  style="width:158px" ><BR>
<font size="3" color="red">※圖片檔請使用寬 250 * 高 200 大小的圖片，效果較佳※</font></div>
<BR><div id="ad_webside_link_button"><input type="submit" value="提交" onclick="check_keyin_box();if(event) event.preventDefault()">&nbsp;<input type="RESET" value="取消">
<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/></div>
</div>
</Form>
<?php
     require_once("./ad_webside_link_config.php");
	 require_once("./ad_webside_link_dbtools.inc.php");
	 require_once('check_session.php');

//指定每頁顯示幾筆記錄
     $records_per_page = 5;
	  
	  //取得要顯示第幾頁的記錄
     if (isset($_GET["page"]))
	 {
        $page = $_GET["page"];
     }
	 else
	 {
       $page = 1;
	 }
	  
	 $sel_sql = "SELECT * FROM $dbtable_00 ORDER BY set_the_date DESC";
	 $result = mysql_query($sel_sql) or die("失敗");
	  
	  //取得記錄數
     $total_records = mysql_num_rows($result);
	 if($total_records != "" or $total_records != 0)
	 {
	     echo "<BR><BR>";
	            //計算總頁數
         $total_pages = ceil($total_records / $records_per_page);
	  
	           //計算本頁第一筆記錄的序號
         $std_record = $records_per_page * ($page - 1);
	  
	        //將記錄指標移至本頁第一筆記錄的序號
         mysql_data_seek($result, $std_record);
	  
	     echo "<table width='600' align='center' cellspacing='3'>";
			
           //使用 $bg 陣列來儲存表格背景色彩
         $bg[0] = "#D9D9FF";
         $bg[1] = "#FFCAEE";
         $bg[2] = "#FFFFCC";
         $bg[3] = "#B9EEB9";
         $bg[4] = "#B9E9FF";
	  
	        //顯示記錄
         $r = 1;
	  
	     while ($row = mysql_fetch_assoc($result) and $r <= $records_per_page)
         {
		 
?>
			 <tr><td style="width:500px;" bgcolor="<?php echo $bg[$r - 1]; ?>"><div id="list_pic">廣告主或友站瀏覽圖：</div><div id="list_pic2"><img src="<?php echo $row["ad_webside_link_cover_long_path"]; ?>" width="250" height="200"></div>
			 <div id="list_name">廣告主或友站名稱：</div><div id="list_name2"><?php echo $row["ad_webside_link_name"]; ?></div>
			 <div id="list_webside">廣告主或友站網址：</div><div id="list_webside2"><input type="text" name="del_store_webside" value="<?php echo $row["ad_webside_link_link"]; ?>" disabled="disabled" style='width:350px;'></div>
<?php
             if($row["ad_webside_link_fb_webside"] == "fb_yes")
			 {
			     echo "<div>";
			     echo "已設定為FB網站";
				 echo "</div>";
			 }

?>
			 </td>
			 <td bgcolor="<?php echo $bg[$r - 1]; ?>" style='text-align:center;'><input type="button" name="button" value="修改" onclick="location.href='ad_webside_link_uni_edit.php?uni_edit_webside_link_no=<?php echo $row["ad_webside_link_no"]; ?>&uni_edit_set_the_date=<?php echo  $row["set_the_date"]; ?>&uni_edit_img_logn_path=<?php echo $row["ad_webside_link_cover_long_path"]; ?>'" style="font-size: 8 pt"/><BR>
			 <input type="button" name="button" value="刪除" onclick="location.href='ad_webside_link_sql.php?this_mode=del_mode&del_webside=<?php echo $row["ad_webside_link_name"]; ?>&del_set_the_date=<?php echo  $row["set_the_date"]; ?>&del_img_logn_path=<?php echo $row["ad_webside_link_cover_long_path"]; ?>'" style="font-size: 8 pt"/>
			 </td></tr>
			 
		     <!--echo  , php echo -->
<?php			
             $r++;
         } 
         echo "</table>";
	  
	        //產生導覽列
         echo "<p align='center'>";
			
         if($page > 1)
             echo "<a href='ad_webside_link_index.php?page=". ($page - 1) . "'>上一頁</a>";
				
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "$i";}
             }
		     else
		     {
                 echo "<a href='ad_webside_link_index.php?page=$i'>$i</a> ";		
		     }
         }
			
         if($page < $total_pages)
             echo "<a href='ad_webside_link_index.php?page=". ($page + 1) . "'>下一頁</a> ";			
				
             echo "</p>";
			
             //釋放記憶體空間
	         mysql_free_result($result);
	         //mysql_free_result($result_001);
             //mysql_free_result($result_002);
             //mysql_close($link_sql);
	 }
echo "</div>";
?>


</body>
</html>