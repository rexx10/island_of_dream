<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面-夢文館新增作品</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
  <link rel=stylesheet type="text/css" href="./authors_book_main_data_edit.css">
  <link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>
<?php 
  require_once("./dreamland_basic_config.php");
  require_once("./dreamland_basic_dbtools.inc.php");
  require_once('check_session.php');
	
  $up_author_code = $_GET["up_author_code"];
  $up_book_name_code = $_GET["up_book_name_code"];
  $sel_sql_00 = "SELECT * FROM $dbtable_00 WHERE author_code = '$up_author_code'";
  $result_sel_sql_00 = mysql_query($sel_sql_00) or die("失敗1");
  $sel_sql_01 = "SELECT * FROM $dbtable_02 WHERE author_code = '$up_author_code' and book_name_code = '$up_book_name_code'";
  $result_sel_sql_01 = mysql_query($sel_sql_01) or die("失敗2");
  $edit_author_name = mysql_result($result_sel_sql_00, 0, "author_name"); //作者名稱
  $tmp_author_code = mysql_result($result_sel_sql_00, 0, "author_code"); //作者代號
  $edit_book_name = mysql_result($result_sel_sql_01, 0, "book_name"); //書名
  
  $sel_sql_02 = "SELECT * FROM $dbtable_03 WHERE author_code = '$up_author_code' and book_name_code = '$up_book_name_code'";
  $result_sel_sql_02 = mysql_query($sel_sql_02) or die("失敗3");
  
  
  $edit_author_code = mysql_result($result_sel_sql_01, 0, "author_code");
  $edit_author_book_front_cover_long_path = mysql_result($result_sel_sql_01, 0, "author_book_front_cover_long_path"); 
      //作者封面圖長路徑
  $edit_author_book_front_cover_big_long_path = mysql_result($result_sel_sql_01, 0, "author_book_front_cover_big_long_path");
	  //作者試閱內文圖大圖長路徑
  $edit_book_preface = mysql_result($result_sel_sql_01, 0, "book_preface"); //書序
  $edit_publication_date_y = mysql_result($result_sel_sql_01, 0, "publication_date_y"); //出版年
  $edit_publication_date_m = mysql_result($result_sel_sql_01, 0, "publication_date_m");
  
  $edit_book_name_code = mysql_result($result_sel_sql_01, 0, "book_name_code");  //書本編號(無法進行變更)
  $edit_book_cover_fig_aut = mysql_result($result_sel_sql_01, 0, "book_cover_fig_aut");
  $sel_count_sql = "SELECT COUNT(sec_type) FROM $dbtable_03 WHERE book_name_code = '$edit_book_name_code'";
  $row_sel_count = mysql_fetch_array(mysql_query($sel_count_sql)) or die("失敗3"); 
  //查詢試閱內文資料表中，育查詢的書本編號有幾筆，用於判斷有試閱內容有幾個分段
?>
	
	<font size="7">修改作者 <font color="red"><?php echo $edit_author_name; ?></font> 作品編號 <font color="red"><?php echo $edit_book_name_code; echo "&nbsp;&nbsp;"; echo $edit_book_name; ?></font>的作品</font>
	<HR>
	<Form Action="./author_book_main_data_sql.php" Method="POST" enctype="multipart/form-data">
	<input type ="hidden" Name="author_book_data_type" value="up_data">
	<input type="hidden" name="sec_type_00" value="<?php echo mysql_result($result_sel_sql_02, 0, "sec_type");?>">
	<input type="hidden" name="author_code" value="<?php echo $tmp_author_code; ?>">
	<input type="hidden" name="book_name_code" value="<?php echo $edit_book_name_code; ?>">
	<table align="center">
	
	<tr><td>作品內文大圖：</td><td ><img src="<?php echo $edit_author_book_front_cover_big_long_path; ?>" hight="400" width="350"></td><td><input type="button" name="button" value="修改" onclick="location.href='author_book_main_data_edit_uni_img.php?up_author_code=<?php echo  $_GET["up_author_code"]; ?>&up_book_name_code=<?php echo $edit_book_name_code; ?>&up_author_book_front_cover_big_long_path=<?php echo $edit_author_book_front_cover_big_long_path; ?>&author_book_img_edit_type=up_aut_book_front_cover_big_long_path&up_author_name=<?php echo $edit_author_name; ?>&up_book_name=<?php echo $edit_book_name; ?>'" value="修改" style="font-size: 8 pt"/></td></tr>
    
	

	
	<tr><td>書&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</td><td><input type="text" name="book_name" value="<?php echo $edit_book_name ?>"></td></tr>
	
	<tr><td>作&nbsp;品&nbsp;封&nbsp;面&nbsp;圖：</td><td><img src="<?php echo $edit_author_book_front_cover_long_path; ?>"></td><td><input type="button" name="button" value="修改" onclick="location.href='author_book_main_data_edit_uni_img.php?up_author_code=<?php echo  $_GET["up_author_code"]; ?>&up_book_name_code=<?php echo $edit_book_name_code; ?>&up_author_book_front_cover_long_path=<?php echo $edit_author_book_front_cover_long_path; ?>&author_book_img_edit_type=up_aut_book_front_cover_long_path&up_author_name=<?php echo $edit_author_name; ?>&up_book_name=<?php echo $edit_book_name; ?>'" value="修改" style="font-size: 8 pt"/></td></tr>
	
	<tr><td>封面插圖作者：</td><td><input type="text" name="book_cover_fig_aut" value="<?php echo $edit_book_cover_fig_aut; ?>"></td></tr>
	<tr><td>出&nbsp;&nbsp;&nbsp;版&nbsp;&nbsp;日&nbsp;&nbsp;&nbsp;期：</td><td><input type="text" name="publication_date_y" value="<?php echo $edit_publication_date_y;?>">
	年<input type="text" name="publication_date_m" value="<?php echo $edit_publication_date_m;?>">月
	<input type="text" name="publication_date_d" value="<?php echo mysql_result($result_sel_sql_01, 0, "publication_date_d");?>">日
	</td></tr>
	
	<tr><td>書&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序：</td><td><textarea cols="80" rows="10" name="book_preface"><?php echo $edit_book_preface; ?></textarea></tr></td>
	<tr><td>內&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文：</td><td><textarea cols="80" rows="10" name="book_content_01" value=[]><?php echo mysql_result($result_sel_sql_02, 0, "book_content"); ?></textarea></td></tr>
<?php
	if($row_sel_count[0] >= 2)
	{
?>
		<input type="hidden" name="sec_type_01" value="<?php echo mysql_result($result_sel_sql_02, 1, "sec_type");?>">
		
	    <tr><td>
		內&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文-2：</td><td><textarea cols="80" rows="10" name="book_content_02" value=[]><?php echo mysql_result($result_sel_sql_02, 1, "book_content"); ?></textarea>
		</td></tr>
<?php	
	}
	if($row_sel_count[0] >= 3)
	{
?>
		<input type="hidden" name="sec_type_02" value="<?php echo mysql_result($result_sel_sql_02, 2, "sec_type");?>">
	    <tr><td>
		內&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文-3：</td><td><textarea cols="80" rows="10" name="book_content_03" value=[]><?php echo mysql_result($result_sel_sql_02, 2, "book_content"); ?></textarea>
		</td></tr>
<?php	
	}
?>
	</table>
	<table align="center">
	<tr><td><input type="submit" value="修改作品">
	<input type="button" name="button" value="返回前一頁" onclick="location.href='author_book_main_data.php?author_code=<?php echo  $tmp_author_code; ?>'" style="font-size: 8 pt"/>
	<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
	</tr></td>
	</table>
	</Form>

</body>
</html>