<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="creation_article_js_check.js" charset = "UTF-8"></script>
<link rel=stylesheet type="text/css" href="creation_article_index_css.css">
<head> 
<title>連載文章作者設定</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php

	require_once("creation_article_config.php");
	require_once("creation_article_dbtools.inc.php");
	require_once('check_session.php');


    $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_id='".mysql_real_escape_string($_GET["ca_works_id"])."'";
    $result = mysql_query($sel_sql) or die("失敗");	
	$sel_sql_02 = "SELECT * FROM $dbtable_02 WHERE ca_chapters_list_id='".mysql_real_escape_string($_GET["ca_chapters_list_id"])."'";
    $result_02 = mysql_query($sel_sql_02) or die("失敗");
?>
<font size="7">修改作者&nbsp;&nbsp;<font color="red"><i><?php echo $_GET["ca_authors_name"]; ?></i></font>&nbsp;&nbsp;連載作品&nbsp;&nbsp;<font color="red"><i><?php echo mysql_result($result, 0, "ca_works_title"); ?></i></font>&nbsp;&nbsp;內的第&nbsp;&nbsp;<font color="red"><i><?php echo mysql_result($result_02, 0, "ca_chapters_name"); ?></i></font>&nbsp;&nbsp;章節</font><HR>
			<Form name="form1" action="creation_article_chapters_b_sql.php" method="POST" enctype="multipart/form-data">
			    <input type ="hidden" Name="this_mode" value="up_mode">
                <input type="hidden" name="ca_authors_code" value="<?php echo $_GET["ca_authors_code"]; ?>">
                <input type="hidden" name="ca_authors_name" value="<?php echo $_GET["ca_authors_name"]; ?>">
				<input type="hidden" name="ca_works_id" value="<?php echo $_GET["ca_works_id"]; ?>">
				<input type="hidden" name="ca_chapters_list_id" value="<?php echo $_GET["ca_chapters_list_id"]; ?>">
				<input type="hidden" name="old_ca_chapters_name" value="<?php echo mysql_result($result_02, 0, "old_ca_chapters_name"); ?>">
				<div id="ca_works_data_uni_edit_config_out">
				<center><table border="1">
				<tr><td id="ca_works_data_uni_edit_config_list_left_side">章節名稱</td><td id="ca_works_data_uni_edit_config_list_right_side"><input type="text" value="<?php echo mysql_result($result_02, 0, "ca_chapters_name"); ?>" readonly="true"></td></tr>
				<tr><td id="ca_works_data_uni_edit_config_list_left_side01">原始章節內容：</td><td id="old_ca_works_data_uni_edit_config_list_right_side" ><textarea cols="44" rows="5" name="old_ca_chapters_detail" id="keyin_box03" readonly="true"><?php echo mysql_result($result_02, 0, "ca_chapters_detail"); ?></textarea></td></tr>
				<tr><td id="ca_works_data_uni_edit_config_list_left_side_02">
			    章節內容更換成：</td><td><textarea cols="44" rows="5" name="ch_ca_chapters_detail" id="keyin_box05"></textarea>      
			    </td></tr>			
				</table></center>
				<BR>
				<div id="ca_works_data_uni_edit_config_button">
				<input type="submit" value="修改" onclick="check_creation_article_chapters_uni_edit_keyin_box();if(event) event.preventDefault()">&nbsp;&nbsp;<input type="RESET" value="取消">
				<input type="button" value="返回上一頁" onclick="self.location.href='creation_article_chapters_b.php?ca_authors_code=<?php echo $_GET["ca_authors_code"];  ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>&ca_works_id=<?php echo $_GET["ca_works_id"] ?>'"/>
				<input type="button" value="返回作者清單" onclick="self.location.href='creation_article_works_b.php?ca_authors_code=<?php echo $_GET["ca_authors_code"];  ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'"/><input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				</div>
			</Form>
				
</body>
</html>