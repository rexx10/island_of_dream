<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="book_content.js"></script>
<head>
<title>夢之鄉 管理頁面-夢文館新增作品</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
<link rel=stylesheet type="text/css" href="./authors_book_main_data.css">
</head>
<body>
<?php 
	require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');

	if(!empty($_GET['author_code'])) $author_code = $_GET['author_code']; //判斷並接收author_code的值
	
	$select_sql_000 = "SELECT * FROM $dbtable_01 WHERE author_code = '$author_code'"; //查詢作者橫幅圖是否有圖
	$result_000 = mysql_query($select_sql_000) or die("失敗");
	$select_sql_001 = "SELECT * FROM $dbtable_00 WHERE author_code = '$author_code'";
	$result_001 = mysql_query($select_sql_001) or die("失敗");
?>
<font size="7">新增作者<font color="red"><?php echo mysql_result($result_001, 0, "author_name"); ?></font> 的作品</font>
<HR>
<?php 
	echo "<div id='c1'><div id='c1-1'>";


	if( !mysql_num_rows($result_000) > "0" )
	{
?>
		<form name="author_form_banner" method="POST" action="author_book_banner_img_sql.php"  enctype="multipart/form-data">

		
		<input type ="hidden" Name="author_book_banner_image_code" value="<?php echo $author_code; ?>">
		<input type ="hidden" Name="author_book_img_type" value="new_img">
		請設定作者作品集上方圖：<input type="FILE" name="author_img"  size="45" />
		<input type="submit" value="上傳" ><BR>
		
<?php
	}
	else
	{
?>		
        
	    <form name="author_form_banner" method="POST" action="edit_author_banner_image.php"  enctype="multipart/form-data">
		<input type ="hidden" Name="author_book_banner_image_code" value="<?php echo $author_code; ?>">
		<input type ="hidden" Name="author_book_banner_image_author_name" value="<?php echo mysql_result($result_001, 0, "author_name");; ?>">
		<input type ="hidden" Name="author_book_banner_image_path" value="<?php echo mysql_result($result_000, 0, "author_banner_long_img_path"); ?>">
		<input type ="hidden" Name="author_name" value="<?php echo mysql_result($result_001, 0, "author_name"); ?>">
		<table align="center">
		<tr><td>
		<img src="<?php echo mysql_result($result_000, 0, "author_banner_long_img_path"); ?>" title="<?php echo mysql_result($result_001, 0, "author_name"); ?>">
        </td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
		<input type="SUBMIT" value="修改圖檔">
		</td></tr>
		</table>
<?php
	}
	?>
	</div>
	</form>
	<form name="author_form" method="POST" action="author_book_main_data_sql.php" enctype="multipart/form-data">
	<input type ="hidden" Name="author_code" value="<?php echo $author_code; ?>">
	<input type ="hidden" Name="author_book_data_type" value="ins_data"><BR>
	<center><table>
	<tr><td>封&nbsp;&nbsp;&nbsp;面&nbsp;&nbsp;大&nbsp;&nbsp;&nbsp;圖：</td><td><input type="file" name="author_book_front_cover_big"></td></tr>
	
	<tr><td>書&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</td><td><input type="text" name="book_name" value=""></td></tr>
	
	<tr><td>作&nbsp;&nbsp;&nbsp;品&nbsp;&nbsp;編&nbsp;&nbsp;&nbsp;號：</td><td><input type="text" name="book_name_code" value="">(請直接輸入數字即可)</td></tr>
	
	<tr><td>封&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;面&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;圖：</td><td><input type="file" name="author_book_front_cover"></td></tr>

	<tr><td>封面插畫作者：</td><td><input type="text" name="book_cover_fig_aut">(可不用填寫)</td></tr>
	
	<!--小說代號：<input type="text" name="book_name_code"><BR> -->
	<tr><td>出&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;書&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：</td><td><input type="text" name="publication_date_y">年
			<input type="text" name="publication_date_m">月
			<input type="text" name="publication_date_d">日(日可不填)</td></tr>
	
	<tr><td>前&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;言：</td><td><textarea cols=20 rows=5 name="book_preface"></textarea></td></tr>
	
	<tr><td>試&nbsp;&nbsp;&nbsp;閱&nbsp;&nbsp;內&nbsp;&nbsp;&nbsp;容：</td><td><textarea cols="20" rows=5 name="book_content_01" value=[]></textarea></td></tr>
	</table></center>
	<?php 
	//<div id="copy" style="display: none">
	//<center><table>
	//<tr><td>試&nbsp;&nbsp;閱&nbsp;內&nbsp;&nbsp;容-2：</td><td><textarea cols="20" rows="5" name="book_content_02" id="book_content_02" style="width:592px;" value=[]></textarea></td></tr>
	//<tr><td>試&nbsp;&nbsp;閱&nbsp;內&nbsp;&nbsp;容-3：</td><td><textarea cols="20" rows="5" name="book_content_03" id="book_content_03" style="width:592px;" value=[]></textarea></td></tr>
	//</table></center>
	//</div>
	?>
	
	<span id="write"></span>
	<div id="c2">
	
	<input type="submit" value="提交"/>
	<?php //<!--<input name="button" type="button" id="add_more" onclick="more()" value="增加試閱內容" style="font-size: 8 pt"/>--> ?>
	<input type="button" name="button" value="返回作者清單" onclick="location.href='authors_book_list.php'" style="font-size: 8 pt"/>
	<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
	</div>
	</form>
	
<?php


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
	  
	  $select_sql_002 = "SELECT * FROM author_book_personal_list WHERE author_code = '$author_code' ORDER BY book_name_code DESC";
	  $result_002 = mysql_query($select_sql_002) or die("失敗1");
	  
	  //$select_sql_003 = "SELECT * FROM author_book_test_read ORDER BY date DESC";
	  //$result_003 = mysql_query($select_sql_002) or die("失敗");
	  
	   //取得記錄數
      $total_records = mysql_num_rows($result_002);
	  if($total_records != "" or $total_records != 0)
	  {
	  echo "<BR><BR>";
	  //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
	  
	  //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);
	  
	  //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result_002, $started_record);
	  
	  echo "<table width='300' align='center' cellspacing='3'>";
			
      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";
	  
	  //顯示記錄
      $j = 1;
	  
	  while ($row = mysql_fetch_assoc($result_002) and $j <= $records_per_page)
      {
        echo "<tr>";
        echo "<td bgcolor='" . $bg[$j - 1] . "'>書名：" . $row["book_name"] . "<br>";
		echo "作品編號：" . $row["book_name_code"] . "<br>";
		echo "小說封面：<img src='" . $row["author_book_front_cover_long_path"] . "'><br>";
        echo "出書日：" . $row["publication_date_y"]."年".$row["publication_date_m"]."月";
		if($row["publication_date_d"] != "" ){
		echo $row["publication_date_d"];
		}
		else
		{ echo "<BR>";}
		echo "</td><td  border='". $bg[$j - 1] ."' bgcolor='" . $bg[$j - 1] . "'>";
		$tmp_book_name_code = $row["book_name_code"];
?>
			
		<input name="button" type="button" onclick="location.href='author_book_main_data_edit.php?up_author_code=<?php echo  $author_code; ?>&up_book_name_code=<?php echo $row["book_name_code"]; ?>&author_book_data_type=up_data'" value="修改" style="font-size: 8 pt"/>
		<BR>
		<input name="button" type="button" onclick="del_main_all_data('<?php echo $author_code; ?>', '<?php echo $tmp_book_name_code; ?>', 'del_data')" value="刪除" style="font-size: 8 pt /">
		<!--echo  , php echo -->
<?php			
        $j++;
      } 
      echo "</table>";
	  
	  //產生導覽列
      echo "<p align='center'>";
			
      if ($page > 1)
        echo "<a href='author_book_main_data.php?author_code=".$author_code."&page=". ($page - 1) . "'>上一頁</a>";
				
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
		{
		
			if($page != 1){ echo "$i";}
        }
		else
		{
          echo "<a href='author_book_main_data.php?author_code=".$author_code."&page=$i'>$i</a> ";		
		}
      }
			
      if ($page < $total_pages)
        echo "<a href='author_book_main_data.php?author_code=".$author_code."&page=". ($page + 1) . "'>下一頁</a> ";			
				
      echo "</p>";
			
      //釋放記憶體空間
	  mysql_free_result($result_000);
	  mysql_free_result($result_001);
      mysql_free_result($result_002);
      //mysql_close($link_sql);
	  }
echo "</div>";

	  
?>
</body>
</html>