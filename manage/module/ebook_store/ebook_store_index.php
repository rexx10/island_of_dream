<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="ebook_js.js" charset = "UTF-8"></script>
<head> 
<title>夢之鄉-新增 / 刪除 電子書廠商</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
</head>
<body>
<center>
<font size="7">新增 / 刪除 電子書廠商</font><HR>
<Form name="form1" method="POST" action="ebook_store_sql.php">
<input type="hidden" name="this_mode" value="ins_mode">
<div>請輸入廠商名稱：<input type="text" name="ebook_store" id="input_box00"></div>
<div>請輸入電子書網址：<input type="text" name="ebook_webside" value="http://" id="input_box01"></div><BR>
<div><input type="submit" value="提交" onclick="check_input_box();if(event) event.preventDefault()">&nbsp;<input type="RESET" value="取消">
<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/><div>

</Form>
<?php
     require_once("./ebook_store_config.php");
	 require_once("./ebook_store_dbtools.inc.php");
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
	  
	 $sel_sql = "SELECT * FROM $dbtable_00 ORDER BY ebook_set_date DESC";
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
			 <tr>
			 <td style="width:500px;" bgcolor="<?php echo $bg[$r - 1]; ?>">電子書廠商：<?php echo $row["ebook_store"]; ?><BR>
			 電子書網址：<input type="text" name="del_store_webside" value="<?php echo $row["ebook_store_webside"]; ?>" disabled="disabled" style='width:399px;'>
			 </td>
			 <td bgcolor="<?php echo $bg[$r - 1]; ?>" style='text-align:center;'>
			 <input type="button" name="button" value="刪除" onclick="location.href='ebook_store_sql.php?this_mode=del_mode&del_store=<?php echo $row["ebook_store"]; ?>&del_set_date=<?php echo  $row["ebook_set_date"]; ?>'" style="font-size: 8 pt"/>
			 </td></tr>
			 
		     <!--echo  , php echo -->
<?php			
             $r++;
         } 
         echo "</table>";
	  
	        //產生導覽列
         echo "<p align='center'>";
			
         if($page > 1)
             echo "<a href='ebook_store_index.php?page=". ($page - 1) . "'>上一頁</a>";
				
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "$i";}
             }
		     else
		     {
                 echo "<a href='ebook_store_index.php?page=$i'>$i</a> ";		
		     }
         }
			
         if($page < $total_pages)
             echo "<a href='ebook_store_index.php?page=". ($page + 1) . "'>下一頁</a> ";			
				
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