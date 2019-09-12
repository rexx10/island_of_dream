<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="creation_article_js_check.js" charset = "UTF-8"></script>
<link rel=stylesheet type="text/css" href="creation_article_index_css.css">
<head> 
<title>連載文章作者設定</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div id="ca_authors_dta_config_title">
<font size="7"><font color="red"><i><?php echo $_GET["ca_authors_name"]."&nbsp;"; ?></i></font>連載作品章回清單</font><HR>
</div><BR>
<Form name="form1" method="POST" action="creation_article_chapters_b_sql.php">
<div id="ca_authors_dta_config_out">
<input type="hidden" name="this_mode" value="ins_mode">
<input type="hidden" name="ca_authors_code" value="<?php echo $_GET["ca_authors_code"]; ?>">
<input type="hidden" name="ca_authors_name" value="<?php echo $_GET["ca_authors_name"]; ?>">
<?php date_default_timezone_set('Asia/Taipei'); ?>
<input type="hidden" name="ca_works_id" value="<?php echo $_GET["ca_works_id"]; ?>">
<input type="hidden" name="ca_ch_set_the_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
<input type="hidden" name="ca_chapters_list_id" value="<?php echo $_GET["ca_chapters_list_id"]; ?>">
<div id="creation_article_chapters_name">章節名稱：<input type="text" name="ca_chapters_name" id="keyin_box00" style="width:440px"></div>
<div id="creation_article_chapters_post_date">刊載日：<input type="text" name="ca_post_date" id="keyin_box02" value="<?php echo date("Y-m-d", strtotime("+8HOUR")); ?>" style="width:470px"></div>
<div id="creation_article_chapters_detail">章節內容：<BR>
<textarea cols="44" rows="5" name="ca_chapters_detail" id="keyin_box03"></textarea></div>
<BR><div id="ca_authors_dta_config_button"><input type="submit" value="提交" onclick="check_creation_article_chapters_b_keyin_box();if(event) event.preventDefault()">&nbsp;<input type="RESET" value="取消">
<input type="button" value="返回上一頁" onclick="self.location.href='creation_article_works_b.php?ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'"/>
<input type="button" value="返回連載文章作品清單" onclick="self.location.href='creation_article_works_b.php?ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'"/>
<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
</div>
</div>
</Form>
<?php
	require_once("creation_article_config.php");
	require_once("creation_article_dbtools.inc.php");
	require_once('check_session.php');
		
	 function cut_content($a, $b, $c)
	 {
         $a = strip_tags($a); //去除HTML標籤
         $sub_content = mb_substr($a, 0, $b, 'UTF-8'); //擷取子字串
         echo $sub_content; //顯示處理後的摘要文字
         //顯示 "......"
         if (strlen($a) > strlen($sub_content)) echo " ...... <div id='detail_tag'><a href='creation_article_chapters_b_detail.php?ca_chapters_list_id=".$c."' target='_new'>Detail</a></div>";
     }

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
	  
	 $sel_sql = "SELECT * FROM $dbtable_02 WHERE ca_works_id='".mysql_real_escape_string($_GET["ca_works_id"])."' ORDER BY ca_chapters_list_id DESC";
	 $result = mysql_query($sel_sql) or die("失敗1");
	 
	  
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
		 
?>
			 <tr><td style="width:370px;" bgcolor="<?php  echo $bg[$r - 1];  ?>"><div id="list_out_side"><div id="list_left_side">章節名稱：</div><div id="list_right_side_name"><?php echo $row["ca_chapters_name"]; ?></div></div>
			 <div id="list_out_side"><div id="list_left_side">刊載日期：</div><div id="list_right_side_name"><?php echo $row["ca_post_date"]; ?></div></div>
			 <div id="list_out_side"><div id="list_left_side">章節內容：</div><div id="list_ch_detail"><?php cut_content($row["ca_chapters_detail"], 100, $row["ca_chapters_list_id"]); ?></div></div>
			 </div></div>
			 </td>
			 <td bgcolor="<?php echo $bg[$r - 1]; ?>" style='text-align:center;'><input type="button" name="button" value="修改" onclick="location.href='creation_article_chapters_uni_edit.php?ca_chapters_list_id=<?php echo $row["ca_chapters_list_id"]; ?>&ca_works_id=<?php echo $_GET["ca_works_id"]; ?>&ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'" style="font-size: 8 pt"/><BR>
			 <input type="button" name="button" value="刪除" onclick="location.href='creation_article_chapters_b_sql.php?this_mode=del_mode&del_ca_chapters_list_id=<?php echo $row["ca_chapters_list_id"]; ?>&del_ca_works_id=<?php echo $_GET["ca_works_id"]; ?>&del_ca_chapters_name=<?php echo $row["ca_chapters_name"]; ?>&ca_authors_code=<?php echo $_GET["ca_authors_code"]; ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'" style="font-size: 8 pt"/>
			 </td></tr>
			 
		     <!--echo  , php echo -->
<?php			
             $r++;
         } 
         echo "</table>";
	  
	        //產生導覽列
         echo "<p align='center'>";
			//ca_authors_code=ZERO&ca_authors_name=我是誰
         if($page > 1)
             echo "<font size='6'><a href='creation_article_chapters_b.php?page=".($page - 1)."&ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."&ca_works_id=".$_GET["ca_works_id"]."'>上一頁</a></font>";
				                                                              
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "<font size='6'>$i</font>";}
             }
		     else
		     {
                 echo "<font size='6'><a href='creation_article_chapters_b.php?page=$i&ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."&ca_works_id=".$_GET["ca_works_id"]."'>$i</a></font>";		
		     }
         }
			
         if($page < $total_pages)
             echo "<font size='6'><a  href='creation_article_chapters_b.php?page=".($page + 1)."&ca_authors_code=".$_GET["ca_authors_code"]."&ca_authors_name=".$_GET["ca_authors_name"]."&ca_works_id=".$_GET["ca_works_id"]."'>下一頁</a></font>";			
				
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