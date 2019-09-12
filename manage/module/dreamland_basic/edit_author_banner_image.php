<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./authors_book_main_data_edit.css">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>

<?php
  require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');
$tmp_author_book_banner_image_code = $_POST["author_book_banner_image_code"];
$tmp_author_book_banner_image_path = $_POST["author_book_banner_image_path"];
$tmp_author_book_banner_image_author_name = $_POST["author_book_banner_image_author_name"];
?>
<font size="7">請選擇作者&nbsp;&nbsp;<font color="red"><?php echo $_POST["author_name"]; ?></font>&nbsp;&nbsp;作品集上方圖</font><HR>
<form name="author_form_edit_banner" method="POST" action="author_book_banner_img_sql.php"  enctype="multipart/form-data">
<input type ="hidden" Name="author_book_banner_image_code" value="<?php echo $tmp_author_book_banner_image_code; ?>">
<input type ="hidden" Name="author_book_img_type" value="up_img">
<table border="1" align="center">
<tr><td>原&nbsp;&nbsp;&nbsp;&nbsp;圖：</td><td><img src="<?php echo $tmp_author_book_banner_image_path; ?>" title="<?php echo $tmp_author_book_banner_image_author_name; ?>"></td></tr>
<tr><td>更換成：</td><td><input type="FILE" name="author_img"  size="45" /></td></tr>
</table>
<BR>
<input type="submit" value="修改圖檔">
<input type="button" value="返回上一頁" onclick="location.href='author_book_main_data.php?author_code=<?php echo $tmp_author_book_banner_image_code; ?>'">

</form>




</body>
</html>