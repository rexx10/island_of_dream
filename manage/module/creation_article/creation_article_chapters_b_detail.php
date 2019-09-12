<html>
<head> 
<title>章回內容</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="creation_article_index_css.css">
</head>
<body>
<?php
    
	require_once("creation_article_config.php");
	require_once("creation_article_dbtools.inc.php");
	require_once('check_session.php');
	//***************
	
	
	$sel_sql = "SELECT ca_chapters_detail FROM $dbtable_02 WHERE ca_chapters_list_id = '".mysql_real_escape_string($_GET["ca_chapters_list_id"])."'";
	
	$result = mysql_query($sel_sql) or die("失敗00");
	
	$tmp_ca_chapters_detail = mysql_result($result, 0, "ca_chapters_detail");

?>

<div id="creation_article_chapters_b_detail_text"><?php echo $tmp_ca_chapters_detail; ?>
</div><BR><div id="under_hr"><HR></div>
<div id="under_close"><a href="#" onClick="window.close()"><img src="../../../images/img_x.jpg"> 關閉視窗</a></div>
</body>
</html>