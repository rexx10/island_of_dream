<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面-夢文館作者清單</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./authors_book_main_data_edit.css">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>
<?php
    require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');
	//$select_sql = "SELECT * FROM $dbtable_00 WHERE author_id != ''"; //查詢是否有作者的基本資料
	//$result = mysql_query($select_sql) or die("失敗");
	//$row = MySQL_fetch_array($result);	
//echo mysql_result($result, 1, "author_id");
?>
<font size="7" color="red">夢文館作者清單</font><HR>
<table align="center">
<?php
	$i=1;
	while($i <= $default_num_of_author)
	{
		$select_sql = "SELECT * FROM $dbtable_00 WHERE author_id = 'author_0$i'"; //查詢是否有作者的基本資料
		$result = mysql_query($select_sql) or die("失敗");
		if(mysql_result($result, 0, "author_id") == "author_0".$i)
		{
			echo "<tr><td>作者".mysql_result($result, 0, "author_name")."：</td><td>&nbsp<a href='author_book_main_data.php?author_code=".mysql_result($result, 0, "author_code")."'><img title='請點擊圖示入內修改作者  ".mysql_result($result, 0, "author_name")." 的資料' src='".mysql_result($result, 0, "author_code_pic_long_path")."'></a></td></tr>";
		}
		else
		{
?>			
			
			<form name="myform0<?php echo $i; ?>" method="POST" action="author_book_list_ins_up_del_sel.php" enctype="multipart/form-data">
			<input type ="hidden" name="author_id" value="author_0<?php echo $i; ?>"> 
			請輸入作者群<?php echo $i;  ?>資訊
			<1>作者名稱：<input type="text" name="author_name">
			<2>作者代號：<input type="text" name="author_code">
			<3>作者代表圖：<input type="file" name="author_code_pic"  size="45" />
			<input type="submit" value="送出">
			</form>
<?php		
		}
		


		$i++;
	
	}
?>
</table>
<BR><BR>
<center>
<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
</center>
</body>
</html>