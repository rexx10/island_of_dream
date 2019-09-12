<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
</head>
<body>
<?php
    require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');
	$select_sql = "SELECT * FROM $dbtable_00 WHERE authors_data_type = '1'";  //查詢banner
	$result = mysql_query($select_sql) or die("失敗");
	$row = MySQL_fetch_array($result);
	if($row == ""){
?>
<form name="myform" method="POST" action="1">
<div>作者坊-修改區</div>
<input type="hidden" name="authors_list_sql_type" value="authors_list_sql_ins">
<div id=authors_text_div>
<textarea name="authors_text"></textarea>
</div>
<div>
<button type="submit">送出</button>
</div>
<img src=".././ck_module/logo.jpg">
</form>
<?php
include_once ".././ck_module/ckeditor/ckeditor.php";
$CKEditor = new CKEditor();
$CKEditor->basePath = '.././ck_module/ckeditor/';
$CKEditor->replace("authors_text");
}else{
$authors_data = mysql_result($result, 0, "authors_data");
?>
<form name="myform" method="POST" action="1">
<div>作者坊-修改區</div>

<div id=authors_text_div>
<?php echo $authors_data; ?>
</div>
<div>
<button type="submit">送出</button>
</div>
<img src=".././ck_module/logo.jpg">
</form>
<?php 
}
?>


</body>
</html>