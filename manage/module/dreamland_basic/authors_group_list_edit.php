<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	
   $authors_id = $_GET["authors_id"];
   $authors_code = $_GET["authors_code"];
   $sel_sql = "SELECT * FROM $dbtable_04 WHERE authors_id = '".mysql_real_escape_string($authors_id)."' AND 
                                               authors_code = '".mysql_real_escape_string($authors_code)."'";
   $result = mysql_query($sel_sql) or die("失敗1");
?>
	
	<font size="7">修改-<font color="red"><?php echo mysql_result($result, 0, "authors_name"); ?></font>作者坊資料</font>
	<HR>
	<Form name="form1" Action="./authors_group_list_sql.php" Method="POST">
	<input type ="hidden" Name="this_mode" value="up_mode">
	<input type ="hidden" Name="authors_id" value="<?php echo $authors_id; ?>">
	<input type ="hidden" Name="authors_code" value="<?php echo $authors_code; ?>">
	<table align="center">
	<tr><td><div id="authors_group_list_edit_outside">網站名稱：</div></td><td><div id="authors_group_list_edit_middle"><input type="text" name="group_authors_webside_name" id="authors_group_list_edit_authors_webside_name" value="<?php echo mysql_result($result, 0, "authors_webside_name"); ?>"></div></td></tr>
	<tr><td><div id="authors_group_list_edit_outside">網站網址：</div></td><td><div id="authors_group_list_edit_middle"><input type="text" name="group_authors_webside" id="authors_group_list_edit_authors_webside" value="<?php echo mysql_result($result, 0, "authors_webside"); ?>"></div></td></tr>
	<tr><td><div id="authors_group_list_edit_outside">備註：</div></td><td><div id="authors_group_list_edit_middle"><textarea cols="80" rows="10" name="group_authors_explanation" id="authors_group_list_edit_authors_explanation"><?php echo mysql_result($result, 0, "authors_explanation"); ?></textarea></div><BR></td></tr>
	<tr><td><div id="authors_group_list_edit_outside">網站圖片：</div></td><div id="authors_group_list_edit_middle"><td><img src="<?php echo mysql_result($result, 0, "authors_img_full_path"); ?>" width='500' height='270'></td><td>&nbsp;&nbsp;<input type="button" name="button" value="修改" onclick="location.href='authors_group_list_edit_uni_img.php?authors_id=<?php echo  $_GET["authors_id"]; ?>&authors_code=<?php echo $authors_code; ?>'" value="修改" id="authors_group_list_under_button_00" style="font-size: 8 pt"/></div></td></tr>
	</table><BR>
	<div id="authors_group_list_under_button">
	<input type="submit" id="authors_group_list_under_button_00" value="修改作品">
	<input type="button" name="button" value="返回前一頁" onclick="location.href='authors_group_list.php'" id="authors_group_list_under_button_00" style="font-size: 8 pt"/>
	<input type="button" value="返回主選單" id="authors_group_list_under_button_00" onclick="self.location.href='../../admin_view.php'"/>
	</div>
	</Form>

</body>
</html>