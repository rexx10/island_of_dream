<?php
	
	require_once("./banner_config.php");           //相關設定檔
	require_once("./banner_dbtools.inc.php");      //相關設定檔
    require_once('check_session.php');
	
	$print_banner_name = $_GET["name"];    //修改模試
	$print_banner_filepiclink = $_GET["name2"];    //顯示編輯頁面圖片長路徑
	$banner_ad_idno_00 = $_GET["banner_ad_idno_00"];  //資料序號
	$filename00 = $_GET["filename00"];    //圖片名稱
	
	$sel_sql = "SELECT * FROM $dbtable_00 WHERE filename = '$filename00'";
	$result_sel = mysql_query($sel_sql) or die("查詢失敗");
	//mysql_result($result_sel, 0, "file_path_or_file_link")
?>
<html>
	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
	</HEAD>


	<title>修改橫幅廣告</title>
			<body background="../pic/back.jpg" bgproperties="fixed">
			<center>
			<font size="7">修改 橫幅 廣告</font><HR>
			
			<Form Action="./banner_sql_ins_up_del.php" Method="POST" enctype="multipart/form-data">
				<input type ="hidden" Name="t_banner_pic" value="<?php echo $print_banner_name; ?>">  
				<input type ="hidden" Name="t_banner_pic02" value="<?php echo $print_banner_filepiclink; ?>">
				<input type ="hidden" Name="t_banner_pic02_1" value="<?php echo mysql_result($result_sel, 0, "file_path_or_file_link"); ?>">
				<input type ="hidden" Name="t_banner_f_t_f_o_f" value="<?php echo mysql_result($result_sel, 0, "file_type_filepath_or_filelink"); ?>">
				<input type ="hidden" Name="banner_ad_idno_00" value="<?php echo $banner_ad_idno_00; ?>">
				<input type ="hidden" Name="filename00" value="<?php echo $filename00; ?>">
				<table border="1">
				<font color="red" size="30">橫幅圖檔請使用514px × 270px 大小</font>
				<tr><td>圖片：</td><td><img src="<?php echo $print_banner_filepiclink; ?>"width="514" height="270"></td></tr>
				<tr><td>更換成：</td><td><Input Type="file" Name="my_banner_edit_pic"  Size="45" /></td></tr>
<?php
		     if(mysql_result($result_sel, 0, "file_type_filepath_or_filelink") == "filepath")
		     {
?>				
                <tr><td>原始附件：</td><td><Input Type="text" value="<?php echo mysql_result($result_sel, 0, "file_upload_file_name"); ?>" disabled="disabled" style="width:513px" /></td></tr>       
				<tr><td>更換成：</td><td><input type="file" name="my_banner_file_or_path" size="45" /></td></tr>
<?php 
             }
			 elseif(mysql_result($result_sel, 0, "file_type_filepath_or_filelink") == "filelink")
			 {
?>
                 <tr><td>原始連結路徑：</td><td><Input Type="text" value="<?php echo mysql_result($result_sel, 0, "file_path_or_file_link"); ?>" disabled="disabled" style="width:513px" /></td></tr>       
				<tr><td>更換成：</td><td><input type="text" value="<?php echo mysql_result($result_sel, 0, "file_path_or_file_link"); ?>" name="ch_my_banner_webside_path" style="width:100%;" /></td></tr>
<?php
             } 
?>		
				
				</table>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="修改">&nbsp;&nbsp;<input type="RESET" value="取消">
				<input type="button" value="返回橫幅廣告列表" onclick="self.location.href='./banner_ad_index.php'"/>
				<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				</center>
				</body>				
			</form>
</html>