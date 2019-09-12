<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="creation_article_js_check.js" charset = "UTF-8"></script>
<link rel=stylesheet type="text/css" href="creation_article_index_css.css">
<head> 
<title>連載文章作者設定</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>
<?php

	require_once("creation_article_config.php");
	require_once("creation_article_dbtools.inc.php");
	require_once('check_session.php');
    function rexx10_my_search_str($my_search_point_str,$my_default_str, $my_search_num, $my_search_full_str)
	{
	    $code = $my_search_point_str;
		$input = $my_search_full_str;
		if(false != ($rst = strpos($input, $my_default_str)))
		{
		    echo $num_str = "default.png";
		}
		else
		{
	        $len=strlen($code);
		    //$len_input = strlen($my_search_str_full_path);
		    $pos1=strpos($input,$code);
		    echo $num_str=substr($input,-($len+10),$pos1);
		}
	}
   /*  $_GET["ca_authors_code"];
    $_GET["ca_authors_name"];
    $_GET["ca_works_id"]; */

    $sel_sql = "SELECT * FROM $dbtable_01 WHERE ca_works_id='".mysql_real_escape_string($_GET["ca_works_id"])."'";
    $result = mysql_query($sel_sql) or die("失敗");

?>
<font size="7">修改<font color="red"> <i><?php echo $_GET["ca_authors_name"]."&nbsp;"; ?></i> </font>連載文章作品清單 </font><HR>
			<font color="red">※作品代表圖檔請使用寬 78 * 高 120 大小※</font><BR><BR>
			<Form name="form1" action="ca_works_data_config_sql.php" method="POST" enctype="multipart/form-data">
			    <input type ="hidden" Name="this_mode" value="up_mode">
                <input type ="hidden" Name="ca_works_id" value="<?php echo $_GET["ca_works_id"]; ?>">
				<input type ="hidden" Name="old_ca_works_title" id="old_ca_works_title_id" value="<?php echo mysql_result($result, 0, "ca_works_title"); ?>">
				<input type ="hidden" Name="ca_authors_code" value="<?php echo $_GET["ca_authors_code"]; ?>">
				<input type ="hidden" Name="ca_authors_name" value="<?php echo $_GET["ca_authors_name"] ?>">
				<input type ="hidden" Name="old_ca_works_font_cover_file" value="<?php rexx10_my_search_str("ca_works_img/", "default.png", 10, mysql_result($result, 0, "ca_works_font_cover_long_path")); ?>">
				<input type ="hidden" Name="old_ca_works_font_cover_long_path" value="<?php echo mysql_result($result, 0, "ca_works_font_cover_long_path"); ?>">
				<div id="ca_works_data_uni_edit_config_out">
				<table border="1">
				<tr><td id="ca_works_data_uni_edit_config_list_left_side">作品代表圖：</td><td id="ca_works_data_uni_edit_config_list_right_side"><img src="<?php echo mysql_result($result, 0, "ca_works_font_cover_long_path"); ?>" width="78" height="120" id="ca_works_data_uni_edit_config_list_right_side_img"></td></tr>
				<tr><td id="ca_works_data_uni_edit_config_list_left_side00">原始檔案：</td><td><Input Type="text" value="<?php rexx10_my_search_str("ca_works_img/", "default.png", 10, mysql_result($result, 0, "ca_works_font_cover_long_path")); ?>" disabled="disabled" style="width:150px" /></td></tr>
				<tr><td id="ca_works_data_uni_edit_config_list_left_side01">更換成：</td><td id="ca_works_data_uni_edit_config_list_right_side"><input type="file" accept="image/*" name="ch_img_ca_works_img" id="ch_ca_works_img_id" style="width:150px"/></div></td></tr>
				<tr><td id="ca_works_data_uni_edit_config_list_left_side_02">
			    原始作品名稱：</td><td><Input Type="text" name="old_ca_works_title" id="old_ca_works_title_key_in_box" value="<?php echo mysql_result($result, 0, "ca_works_title"); ?>" disabled="disabled" style="width:150px" />
				<tr><td id="ca_works_data_uni_edit_config_list_left_side_02">
				作品新名稱：</td><td><Input Type="text" name="ch_ca_works_title" id="ca_works_title_key_in_box" style="width:150px" />
			    </td></tr>       
			    </td></tr>				
				</table>
				</div><BR>
				<div id="ca_works_data_uni_edit_config_button">
				<input type="submit" value="修改" onclick="check_ca_works_data_uni_edit_config_keyin_box();if(event) event.preventDefault()">&nbsp;&nbsp;<input type="RESET" value="取消">
				<input type="button" value="返回上一頁" onclick="self.location.href='ca_works_data_config.php?ca_authors_code=<?php echo $_GET["ca_authors_code"];  ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'"/>
				<input type="button" value="返回作者清單" onclick="self.location.href='creation_article_works_b.php?ca_authors_code=<?php echo $_GET["ca_authors_code"];  ?>&ca_authors_name=<?php echo $_GET["ca_authors_name"]; ?>'"/>
				<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				</div>
			</Form>
				
</body>
</html>