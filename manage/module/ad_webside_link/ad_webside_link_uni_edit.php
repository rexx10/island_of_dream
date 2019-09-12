<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
<script language="javascript" src="ad_webside_link_index_js_check.js" charset = "UTF-8"></script>
</head>
<body>
<?php
    require_once("./ad_webside_link_config.php");
	require_once("./ad_webside_link_dbtools.inc.php");
	require_once('check_session.php');
	$_GET["uni_edit_webside_link_no"];
	$_GET["uni_edit_set_the_date"];
	$_GET["uni_edit_img_logn_path"];
	$sel_sql = "SELECT * FROM $dbtable_00 WHERE ad_webside_link_no = '".mysql_real_escape_string($_GET["uni_edit_webside_link_no"])."' AND set_the_date = '".mysql_real_escape_string($_GET["uni_edit_set_the_date"])."'";
	$result_sel = mysql_query($sel_sql) or die("失敗0");
 
?>
<title>修改橫幅廣告</title>
			<body background="../pic/back.jpg" bgproperties="fixed">
			<center>
			<font size="7">修改 側攔廣告</font><HR>
			
			<Form Action="ad_webside_link_sql.php" Method="POST" enctype="multipart/form-data">
				<input type ="hidden" Name="this_mode" value="up_mode">
				<input type ="hidden" Name="webside_link_no" value="<?php echo $_GET["uni_edit_webside_link_no"]; ?>">
				<input type ="hidden" Name="set_the_date" value="<?php echo $_GET["uni_edit_set_the_date"]; ?>">
				<input type ="hidden" Name="old_img_logn_path" value="<?php echo $_GET["uni_edit_img_logn_path"]; ?>">
				<table border="1">
				<font color="red" size="30">橫幅圖檔請使用514px × 270px 大小</font>
				<tr><td>廣告主或友站瀏覽圖：</td><td><img src="<?php echo $_GET["uni_edit_img_logn_path"]; ?>"width="514" height="270"></td></tr>
				<tr><td>更換成：</td><td><Input Type="file" Name="ch_ad_webside_image" id="keyin_box02" Size="45" /></td></tr>
				
                <tr><td>廣告主或友站名稱：</td><td><Input Type="text" name="uni_edit_ad_webside_link_name" value="<?php echo mysql_result($result_sel, 0, "ad_webside_link_name"); ?>" style="width:513px" /></td></tr>       
				<tr><td>廣告主或友站網址：</td><td><Input Type="text" name="uni_edit_ad_webside_link_website" value="<?php echo mysql_result($result_sel, 0, "ad_webside_link_link"); ?>" style="width:513px" /></td></tr>

				    <tr><td>修改FB註記：</td><td>
                    <input type="checkbox"  name="use_fb_fans" value="fb_fans_yes" id="use_fb_fans">
                    </td></tr>	
				
				</table>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="修改" onclick="check_keyin_box2();if(event) event.preventDefault()">&nbsp;&nbsp;<input type="RESET" value="取消">
				<input type="button" value="返回前一頁" onclick="self.location.href='./ad_webside_link_index.php'"/>
				<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				</center>
				</body>				
			</form>

</body>
</html>