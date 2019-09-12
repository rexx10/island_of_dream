<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="ad_webside_link_index_js_hid.js" charset = "UTF-8"></script>
<script language="javascript" src="ad_webside_link_index_js_check.js" charset = "UTF-8"></script>
<link rel=stylesheet type="text/css" href="creation_article_index_css.css">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
<head> 
<title>夢之鄉-新增 / 刪除 側攔廣告</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div id="ad_webside_link_main_title">
<font size="7">連載文章作者清單</font><HR>
</div>
<div><BR>
<center>
<a href="ca_authors_data_config.php" class="css_btn_class" title="點我設定連載作者清單">連載作者清單設定</a><BR><BR>
<div><input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/></div>
</center>
</div>
<!--<Form name="form1" method="POST" action="ad_webside_link_sql.php" enctype="multipart/form-data">
<input type="hidden" name="this_mode" value="ins_mode">
<div id="ad_webside_link_detail01">請輸入作者代號：<input type="text" name="ad_webside_link_name" id="keyin_box00" style="width:315px"></div>
<div id="ad_webside_link_detail02">請輸入作者姓名：<input type="text" name="ad_webside_link_name" id="keyin_box00" style="width:300px"></div>
<div id="raido_sel_no">請選擇作者代表圖：<input type="file" name="creation_article_authors_image" id="keyin_box02"  style="width:158px" ><BR>
<font size="3" color="red">※圖片檔請使用寬 250 * 高 200 大小的圖片，效果較佳※</font></div>
<BR><div id="ad_webside_link_button"><input type="submit" value="提交" onclick="check_keyin_box();if(event) event.preventDefault()">&nbsp;<input type="RESET" value="取消">
<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/></div>
</div>
</Form>-->
<?php
     require_once("creation_article_config.php");
	 require_once("creation_article_dbtools.inc.php");
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
	  
	 $sel_sql = "SELECT * FROM $dbtable_00 ORDER BY ca_authors_id ASC";
	 $result = mysql_query($sel_sql) or die("失敗");
	  
	  //取得記錄數
     $total_records = mysql_num_rows($result);
	 if($total_records != "" or $total_records != 0)
	 {
	     //echo "<BR><BR>";
	            //計算總頁數
         $total_pages = ceil($total_records / $records_per_page);
	  
	           //計算本頁第一筆記錄的序號
         $std_record = $records_per_page * ($page - 1);
	  
	        //將記錄指標移至本頁第一筆記錄的序號
         mysql_data_seek($result, $std_record);
	     echo "<div>";
	     echo "<table width='300' align='center' cellspacing='3'>";
			
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
			 <tr><td style="width:370px;" bgcolor="<?php  echo $bg[$r - 1];  ?>"><div id="list_pic">作者代表圖：</div><div id="list_pic2"><a href="creation_article_works_b.php?ca_authors_code=<?php echo $row["ca_authors_code"]; ?>&ca_authors_name=<?php echo $row["ca_authors_name"]; ?>"><img title="請點擊圖示入內修改作者<?php echo $row["ca_authors_name"]; ?>的作品" src="<?php echo $row["ca_author_code_img_long_path"]; ?>"></a></div>
			 <div id="list_ca_authors_data_config_name">作者名稱：</div><div id="list_ca_authors_data_config_name2"><?php echo $row["ca_authors_name"]; ?></div>
			 </td>
			 <!--</td>
			 <td bgcolor="<?php //echo $bg[$r - 1]; ?>" style='text-align:center;'><input type="button" name="button" value="修改" onclick="location.href='ad_webside_link_uni_edit.php?uni_edit_webside_link_no=<?php //echo $row["ad_webside_link_no"]; ?>&uni_edit_set_the_date=<?php// echo  $row["set_the_date"]; ?>&uni_edit_img_logn_path=<?php //echo $row["ad_webside_link_cover_long_path"]; ?>'" style="font-size: 8 pt"/><BR>
			 <input type="button" name="button" value="刪除" onclick="location.href='ad_webside_link_sql.php?this_mode=del_mode&del_webside=<?php //echo $row["ad_webside_link_name"]; ?>&del_set_the_date=<?php// echo$row["set_the_date"]; ?>&del_img_logn_path=<?php// echo $row["ad_webside_link_cover_long_path"]; ?>'" style="font-size: 8 pt"/>
			 </td></tr>-->
			 
		     <!--echo  , php echo -->
<?php			
             $r++;
         } 
         echo "</table>";
	  
	        //產生導覽列
         echo "<p align='center'>";
			
         if($page > 1)
             echo "<font size='6'><a href='creation_article_index.php?page=".($page - 1)."'>上一頁</a></font>";
				
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "<font size='6'>$i</font'>";}
             }
		     else
		     {
                 echo "<font size='6'><a href='creation_article_index.php?page=$i'>$i</a></font>";		
		     }
         }
			
         if($page < $total_pages)
             echo "<font size='6'><a href='creation_article_link_index.php?page=".($page + 1)."'>下一頁</a></font>";			
				
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