<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="creation_article_js_check.js" charset = "UTF-8"></script>
<link rel=stylesheet type="text/css" href="creation_article_index_css.css">
<head> 
<title>連載文章作者設定</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>
<div id="ca_authors_dta_config_title">
<font size="7"><font color="red"><i><?php echo $_GET["ca_authors_name"]."&nbsp;"; ?></i></font>連載文章作品清單設定</font><HR>
</div><BR>
<Form name="form1" method="POST" action="ca_works_data_config_sql.php" enctype="multipart/form-data">
<div id="ca_authors_dta_config_out">
<input type="hidden" name="this_mode" value="ins_mode">
<input type="hidden" name="ca_authors_name" value="<?php echo $_GET["ca_authors_name"]; ?>">
<input type="hidden" name="ca_works_set_the_date" value="<?php echo date("Y-m-d G:i:s", strtotime("+8HOUR")); ?>">

<div id="ca_authors_dta_config_detail01">作者代號：<input type="text" name="ca_authors_code" id="keyin_box00" value="<?php echo $_GET["ca_authors_code"]; ?>" readonly="true" style="width:410px"></div>
<div id="ca_authors_dta_config_detail01">創&nbsp;&nbsp;書&nbsp;&nbsp;日：<input type="text" name="ca_creation_date" id="keyin_box02" value="<?php echo date("Y-m-d", strtotime("+8HOUR")); ?>" style="width:409px"></div>
<div id="ca_authors_dta_config_detail02">請輸入作品名稱：<input type="text" name="ca_works_title" id="keyin_box03" style="width:322px"></div>
<div id="ca_authors_dta_config_detail02">連載狀態：<select name="ca_serial_status" id="select_box01">
　                                                     <option value="連載中" selected>連載中</option>
　                                                     <option value="連載結束">連載結束</option>
                                                   </select></div>
<div id="ca_authors_dta_config_img">請選擇作品代表圖：<input type="file" accept="image/*" name="ca_works_img" id="keyin_box04"  style="width:280px"><BR>
<div><font size="3" color="red">※圖片檔請使用寬 78 * 高 120 大小的圖片，效果較佳※</font><BR></div>
<div><font size="3" color="red">※如該文章作品內已有章回內容，將不允許使用修改、刪除功能※</font></div></div>
<BR><div id="ca_authors_dta_config_button"><input type="submit" value="提交" onclick="check_ck_works_data_config_keyin_box();if(event) event.preventDefault()">&nbsp;<input type="RESET" value="取消">
<input type="button" value="返回上一頁" onclick="self.location.href='creation_article_works_b.php?ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'"/>
<input type="button" value="返回文章作者清單" onclick="self.location.href='creation_article_index.php'"/>
<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
</div>
</div>
</Form>
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
	  
	 $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_authors_code='".mysql_real_escape_string($_GET["ca_authors_code"])."' ORDER BY ca_works_id DESC";
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
	  
	     echo "<table width='400' align='center' cellspacing='3'>";
			
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
		     $sel_sql_02 = "SELECT * FROM $dbtable_02 WHERE ca_works_id = '".mysql_real_escape_string($row["ca_works_id"])."'";
			 $result_sel_sql_02 = mysql_query($sel_sql_02) or die("失敗");
			 $result_row = MySQL_fetch_array($result_sel_sql_02);
?>
			 <tr><td style="width:370px;" bgcolor="<?php  echo $bg[$r - 1];  ?>"><div id="list_out_side_img"><div id="list_left_side_img">作品代表圖：</div><div id="list_right_side_img"><img src="<?php echo $row["ca_works_font_cover_long_path"]; ?>" width="78" height="120"></div></div>
			 <div id="list_out_side"><div id="list_left_side">作品名稱：</div><div id="list_right_side_name"><?php echo $row["ca_works_title"]; ?></div></div>
			 <div id="list_out_side"><div id="list_left_side">創書日期：</div><div id="list_right_side_ca_date"><?php  echo $row["ca_creation_date"]; ?></div></div>
			 <div id="list_out_side"><div id="list_left_side">連載狀態：</div><div id="list_right_side_ca_ser_status">
			 <Form name="formserial_status<?php echo $r; ?>" method="POST" action="ca_works_data_config_sql.php">
			 <input type="hidden" name="this_mode" value="up_serial_status_mode">
			 <input type="hidden" name="up_serial_status_ca_works_id" value="<?php echo $row["ca_works_id"] ?>">
			 <input type="hidden" name="ca_authors_code" value="<?php echo $_GET["ca_authors_code"]; ?>">
			 <input type="hidden" name="ca_authors_name" value="<?php echo $_GET["ca_authors_name"]; ?>">
			 <select name="ca_serial_status" id="select_box01">
<?php 
             if($row["ca_serial_status"] == "連載中")
             {
?>			 
　               <option value="連載中" selected>連載中</option>
　               <option value="連載結束">連載結束</option>
<?php 
             }
             elseif($row["ca_serial_status"] == "連載結束")
             {
?>
                 <option value="連載中">連載中</option>
　               <option value="連載結束" selected>連載結束</option>
<?php 
             }
?>
             </select>&nbsp;&nbsp;<input type="submit" id="select_box01" value="提交">
			 </Form></div>
			 </div></td>
			 <td bgcolor="<?php echo $bg[$r - 1]; ?>" style='text-align:center;'>
			 <input type="button" name="button" value="修改" onclick="location.href='ca_works_data_uni_edit_config.php?ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>&ca_works_id=<?php echo $row["ca_works_id"]; ?>'" style="font-size: 8 pt"/><BR>
			 <input type="button" name="button" value="刪除" onclick="location.href='ca_works_data_config_sql.php?this_mode=del_mode&ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>&del_ca_works_id=<?php echo $row["ca_works_id"]; ?>&del_ca_works_title=<?php echo $row["ca_works_title"]; ?>&del_ca_works_font_cover_long_path=<?php echo $row["ca_works_font_cover_long_path"]; ?>'" <?php if($result_row != 0) echo "disabled='disabled'"; ?> style="font-size: 8 pt"/>
			 </td></tr>
			 
		     <!--echo  , php echo -->
<?php			
             $r++;
         } 
         echo "</table>";
	  
	        //產生導覽列
         echo "<p align='center'>";
		 
         if($page > 1)
             echo "<font size='6'><a href='ca_works_data_config.php?page=".($page - 1)."&ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."'>上一頁</a></font>";
				
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "<font size='6'>$i</font>";}
             }
		     else
		     {
                 echo "<font size='6'><a href='ca_works_data_config.php?page=$i&ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."'>$i</a></font>";		
		     }
         }
			
         if($page < $total_pages)
             echo "<font size='6'><a  href='ca_works_data_config.php?page=".($page + 1)."&ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."'>下一頁</a></font>";			
				
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