<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面-夢文館作者清單</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./../../../images/logo2.ico">	
<link rel=stylesheet type="text/css" href="./authors_book_main_data.css">
</head>
<body>
<?php

	//$select_sql = "SELECT * FROM $dbtable_00 WHERE author_id != ''"; //查詢是否有作者的基本資料
	//$result = mysql_query($select_sql) or die("失敗");
	//$row = MySQL_fetch_array($result);	
//echo mysql_result($result, 1, "author_id");
?>
<div id="top-text"><font color="red">作者坊-新增作者</font></div><HR>
<Form name="form1" method="POST" action="authors_group_list_sql.php" enctype="multipart/form-data">
<input type="hidden" name="this_mode" value="ins_mode">
<center><table>
	<tr><div><td><div id="authors_group_list_outside">作者名稱：</div></td><td><div><input type="text" name="group_authors_name" id="authors_group_list_authors_name"></div></div></td></tr>
	<tr><div><td><div id="authors_group_list_outside">作者編號：</div></td><td><div><input type="text" name="group_authors_code" id="group_authors_code" value=""></div></td></div></tr>	
	<tr><div><td><div id="authors_group_list_outside">網站名稱：</div></td><td><div><input type="text" name="group_authors_webside_name" id="group_authors_webside_name" value=""></div></td></div></tr>	
	<tr><div><td><div id="authors_group_list_outside">網站網址：</div></td><td><div><input type="text" name="group_authors_webside" id="group_authors_webside" value=""></div></td></div></tr>	
	<tr><td><div id="authors_group_list_outside">備&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;註：</div></td><td><div><input type="text" name="group_authors_explanation" id="group_authors_explanation"></div></td></div></tr>	
	<tr><div><td><div id="authors_group_list_outside">網站圖片：</td><td><input type="file" name="group_authors_img" id="group_authors_img" accept="image/*"></div></td></div></tr>

		
	</table>
	<BR><BR>
	<div id="authors_group_list_under_button">
	<input type="submit" value="提交" id="authors_group_list_under_button_00">&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'" id="authors_group_list_under_button_01" />
	</div></center>
<Form>
<?php
    require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
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
	  
	  $sel_sql = "SELECT * FROM $dbtable_04 ORDER BY authors_id DESC";
	  $result = mysql_query($sel_sql) or die("失敗1");
	  
	   //取得記錄數
      $total_records = mysql_num_rows($result);
	  if($total_records != "" or $total_records != 0)
	  {
	  echo "<BR><BR>";
	  //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
	  
	  //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);
	  
	  //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result, $started_record);
	  
	  echo "<table width='800' align='center' cellspacing='4'>";
			
      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";
	  
	  //顯示記錄
      $j = 1;
	  
	  while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page)
      {
        echo "<tr>";
		echo "<td bgcolor='".$bg[$j - 1]."'><div id='authors_group_list_outside_list_main'><div id='authors_group_list_outside_list'><div id='authors_group_list_left_list_authors_name'>作者名稱：</div><div id='authors_group_list_right_list_authors_name'>".$row["authors_name"]."</div></div>";
		echo "<div id='authors_group_list_outside_list'><div id='authors_group_list_left_list_authors_code'>作者編號：</div><div id='authors_group_list_right_list_authors_code'>".$row["authors_code"]."</div></div>";
		echo "<div id='authors_group_list_outside_list'><div id='authors_group_list_left_list_webside_name'>作者網站：</div><div id='authors_group_list_right_list_webside_name'><a target='_new' href='".$row["authors_webside"]."' title='點我進入'>".$row["authors_webside_name"]."</a></div></div>"; 
		if($row["authors_explanation"] != "")
		{
		    echo "<div id='authors_group_list_outside_list'><div id='authors_group_list_left_list_authors_explanation'>備註：</div><div id='authors_group_list_right_list_authors_explanation'>".$row["authors_explanation"]."</div></div>";
		}
		echo "<div id='authors_group_list_outside_list'><div id='authors_group_list_left_list_authors_img'>網站圖片：</div><div id='authors_group_list_right_list_authors_img'><img src='".$row["authors_img_full_path"]."' title='".$row["authors_name"]."' width='500' height='270'></div></div>";
		echo "</div></td><td  border='". $bg[$j - 1] ."' bgcolor='" . $bg[$j - 1] . "'>";
?>
			
		<input name="button" type="button" onclick="location.href='authors_group_list_edit.php?authors_id=<?php echo $row["authors_id"]; ?>&authors_code=<?php echo $row["authors_code"]; ?>'" value="修改" style="font-size: 8 pt"/><BR>
		<input name="button" type="button" onclick="location.href='authors_group_list_sql.php?this_mode=del_mode&authors_id=<?php echo $row["authors_id"]; ?>&authors_code=<?php echo $row["authors_code"]; ?>'" value="刪除" style="font-size: 8 pt /"></td></tr>
		<!--echo  , php echo -->
<?php			
        $j++;
      } 
      echo "</table>";
	  
	  //產生導覽列
      echo "<p align='center'>";
			
      if ($page > 1)
        echo "<a href='author_group_list.php?&page=". ($page - 1) . "'>上一頁</a>";
				
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
		{
		
			if($page != 1){ echo "$i";}
        }
		else
		{
          echo "<a href='author_group_list.php?author_code=&page=$i'>$i</a> ";		
		}
      }
			
      if ($page < $total_pages)
        echo "<a href='author_group_list.php?author_code=&page=". ($page + 1) . "'>下一頁</a> ";			
				
      echo "</p>";
			
      //釋放記憶體空間
      mysql_free_result($result);
      //mysql_close($link_sql);
	  }
echo "</div>";

	  
?>
</body>
</html>