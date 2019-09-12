<html>
	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
	</HEAD>
		<title>修改 / 刪除 橫幅廣告</title>
		<body background="../pic/back.jpg" bgproperties="fixed">
		<center>
			<font size="8"><font color="red">修改</font> / <font color="red">刪除</font> 橫幅廣告</font><HR>
<?php

		//引入SQL相關動作
		//如果dbtools.inc.php與此網頁不在同一目錄之下使用require.once，路徑需使用相對路徑../dbtools.inc.php 
	require_once("./banner_config.php");
	require_once("./banner_dbtools.inc.php");
	require_once('check_session.php');
	 //建立資料庫連接
	
	$select_sql = "SELECT * FROM $dbtable_00";

	$result = mysql_query($select_sql) or die("失敗");
	$temp_banner_ad_pic_link_01 = '0';
	$temp_banner_ad_pic_link_02 = '0';
    $temp_banner_ad_pic_link_03 = '0';
    $temp_banner_ad_pic_link_04 = '0';
//$row=MySQL_fetch_array($result);
	for($i=1;$i<=mysql_num_rows($result); $i++){
	
		if(mysql_result($result, $i-1, "filename") != "" or '0'){
		 
		 //${'temp_banner_ad_pic_link_0'.$i} = '0';
		 ${'temp_banner_ad_0'.$i} = mysql_result($result, $i-1, "filename");
		 ${'temp_banner_ad_pic_link_0'.$i} = mysql_result($result, $i-1, "filepiclink");
		 //${'temp_banner_ad_idno2_0'.$i} = mysql_result($result, $i-1, "idno2");
		 ${'temp_file_upload_file_name_0'.$i} = mysql_result($result, $i-1, "file_upload_file_name");
		 ${'temp_del_file_path_or_file_link_0'.$i} = "../../../images/sys_banner_ad/banner_files/".mysql_result($result, $i-1, "file_upload_file_name");
		
		}else{
		
	        ${'temp_banner_ad_0'.$i} = '0'; 
		
		}

	}

	mysql_free_result($result);
	
	
	
	 if($temp_banner_ad_01 != "banner_ad_pic_01"){
?>
		<Form name="form1" Action="./banner_sql_ins_up_del.php" Method="POST" enctype="multipart/form-data">
		<input type ="hidden" Name="t_banner_pic" value="edit_banner_ad_pic">
		<input type ="hidden" Name="banner_ad_idno_00" value="1">
		<input type ="hidden" Name="filename00" value="banner_ad_pic_01">
		<table>
		<tr><td ROWSPAN="2" ROWSPAN="3" WIDTH="100">廣告圖檔一</td><td width="120" height="40" style='position:relative;left:8px;text-align:center'>請選擇圖片檔：</td>
	    <td style='text-align:center'><input type="file" name="my_banner_edit_pic" size="50">&nbsp;&nbsp;</td>
		<td ROWSPAN="2"><input type="submit" value='上傳'><BR>
			  <input type="reset" value="取消"></td>
		</tr>
		<tr>
		<td style='text-align:center'>請輸入作者網址：</td><td style='text-align:center'><input type="text" name="my_banner_webside_path" size="50">&nbsp;&nbsp;</td>
		</tr>
		</table>
	    </Form>
	    <HR><BR>
<?php
	}else{
?>
		<table>
	    <tr><td WIDTH="100">廣告圖檔一</td>
	    <td style='text-align:center' WIDTH="335"><img src="<?php echo $temp_banner_ad_pic_link_01; ?>" width="200" height="108"></td>
		<td>
		<input type="button" value="修改廣告01" onclick="self.location.href='./banner_ad_edit.php?name=edit_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_01; ?>&banner_ad_idno_00=1&filename00=<?php echo $temp_banner_ad_01; ?>'"/><BR><BR>
		<input type="button" value="刪除廣告01" onclick="self.location.href='./banner_sql_ins_up_del.php?t_banner_pic=del_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_01; ?>&banner_ad_idno_00=1&filename00=<?php echo $temp_banner_ad_01; ?>&file_path_or_file_link=<?php echo $temp_del_file_path_or_file_link_01; ?>'"/>
		</td>
		</tr>
		</table>
        <HR><BR>
<?php
	}  

	if($temp_banner_ad_02 != "banner_ad_pic_02"){
?>
		<Form name="form2" Action="./banner_sql_ins_up_del.php" Method="POST" enctype="multipart/form-data">
		<input type ="hidden" Name="t_banner_pic" value="edit_banner_ad_pic">
		<input type ="hidden" Name="banner_ad_idno_00" value="2">
		<input type ="hidden" Name="filename00" value="banner_ad_pic_02">
		<table>
		<tr><td ROWSPAN="2" ROWSPAN="3" WIDTH="100">廣告圖檔二</td><td width="120" height="40" style='position:relative;left:8px;text-align:center'>請選擇圖片檔：</td>
	    <td style='text-align:center'><input type="file" name="my_banner_edit_pic" size="50">&nbsp;&nbsp;</td>
		<td ROWSPAN="2"><input type="submit" value='上傳'><BR>
			  <input type="reset" value="取消"></td>
		</tr>
		<tr>
		<td style='text-align:center'>請輸入作者網址：</td><td style='text-align:center'><input type="text" name="my_banner_webside_path" size="50">&nbsp;&nbsp;</td>
		</tr>
		</table>
	    </Form>
	    <HR><BR>
<?php
	}else{
?>
	    <table>
	    <tr><td WIDTH="100">廣告圖檔二</td>
	    <td style='text-align:center' WIDTH="335"><img src="<?php echo $temp_banner_ad_pic_link_02; ?>" width="200" height="108"></td>
		<td>
		<input type="button" value="修改廣告02" onclick="self.location.href='./banner_ad_edit.php?name=edit_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_02; ?>&banner_ad_idno_00=2&filename00=<?php echo $temp_banner_ad_02; ?>'"/><BR><BR>
		<input type="button" value="刪除廣告02" onclick="self.location.href='./banner_sql_ins_up_del.php?t_banner_pic=del_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_02; ?>&banner_ad_idno_00=2&filename00=<?php echo $temp_banner_ad_02; ?>&file_path_or_file_link=<?php echo $temp_del_file_path_or_file_link_02; ?>'"/>
		</td>
		</tr>
		</table>
        <HR><BR>
<?php
	}  

	if($temp_banner_ad_03 != "banner_ad_pic_03"){
?>
		<Form name="form3" Action="./banner_sql_ins_up_del.php" Method="POST" enctype="multipart/form-data">
		<input type ="hidden" Name="t_banner_pic" value="edit_banner_ad_pic">
		<input type ="hidden" Name="banner_ad_idno_00" value="3">
		<input type ="hidden" Name="filename00" value="banner_ad_pic_03">
		<table>
		<tr><td ROWSPAN="2" ROWSPAN="3" WIDTH="100">廣告圖檔三</td><td width="120" height="40" style='position:relative;left:8px;text-align:center'>請選擇圖片檔：</td>
	    <td style='text-align:center'><input type="file" name="my_banner_edit_pic" size="50">&nbsp;&nbsp;</td>
		<td ROWSPAN="2"><input type="submit" value='上傳'><BR>
			  <input type="reset" value="取消"></td>
		</tr>
		<tr>
		<td style='text-align:center'>請輸入作者網址：</td><td style='text-align:center'><input type="text" name="my_banner_webside_path" size="50">&nbsp;&nbsp;</td>
		</tr>
		</table>
	    </Form>
	    <HR><BR>
<?php	
	}else{
?>
	    <table>
	    <tr><td WIDTH="100">廣告圖檔三</td>
	    <td style='text-align:center' WIDTH="335"><img src="<?php echo $temp_banner_ad_pic_link_03; ?>" width="200" height="108"></td>
		<td>	
		<input type="button" value="修改廣告03" onclick="self.location.href='./banner_ad_edit.php?name=edit_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_03; ?>&banner_ad_idno_00=3&filename00=<?php echo $temp_banner_ad_03; ?>'"/><BR><BR>
		<input type="button" value="刪除廣告03" onclick="self.location.href='./banner_sql_ins_up_del.php?t_banner_pic=del_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_03; ?>&banner_ad_idno_00=3&filename00=<?php echo $temp_banner_ad_03; ?>&file_path_or_file_link=<?php echo $temp_del_file_path_or_file_link_03; ?>'"/>
		</td>
		</tr>
		</table>
        <HR><BR>
<?php	
	}  
	
	if($temp_banner_ad_04 != "banner_ad_pic_04"){
?>
		<Form name="form4" Action="./banner_sql_ins_up_del.php" Method="POST" enctype="multipart/form-data">
		<input type ="hidden" Name="t_banner_pic" value="edit_banner_ad_pic">
		<input type ="hidden" Name="banner_ad_idno_00" value="4">
		<input type ="hidden" Name="filename00" value="banner_ad_pic_04">
		<table>
		<tr><td ROWSPAN="2" ROWSPAN="3" WIDTH="100">廣告圖檔四</td><td width="120" height="40" style='position:relative;left:8px;text-align:center'>請選擇圖片檔：</td>
	    <td style='text-align:center'><input type="file" name="my_banner_edit_pic" size="50">&nbsp;&nbsp;</td>
		<td ROWSPAN="2"><input type="submit" value='上傳'><BR>
			  <input type="reset" value="取消"></td>
		</tr>
		<tr>
		<td style='text-align:center'>請輸入作者網址：</td><td style='text-align:center'><input type="text" name="my_banner_webside_path" size="50">&nbsp;&nbsp;</td>
		</tr>
		</table>
	    </Form>
	    <HR><BR>
<?php	
	}
	else
	{
?>	
	    <table>
	    <tr><td WIDTH="100">廣告圖檔四</td>
	    <td style='text-align:center' WIDTH="335"><img src="<?php echo $temp_banner_ad_pic_link_04; ?>" width="200" height="108"></td>
		<td>
		<input type="button" value="修改廣告04" onclick="self.location.href='./banner_ad_edit.php?name=edit_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_04; ?>&banner_ad_idno_00=4&filename00=<?php echo $temp_banner_ad_04; ?>'"/><BR><BR>
		<input type="button" value="刪除廣告04" onclick="self.location.href='./banner_sql_ins_up_del.php?t_banner_pic=del_banner_ad_pic&name2=<?php echo $temp_banner_ad_pic_link_04; ?>&banner_ad_idno_00=4&filename00=<?php echo $temp_banner_ad_04; ?>&file_path_or_file_link=<?php echo $temp_del_file_path_or_file_link_04; ?>'"/>
		</td>
		</tr>
		</table>
	    </Form>
	    <HR><BR>
<?php	
	}   

?>

<p align="center">
	<input type="button" value="返回管理頁面"  onclick="self.location.href='../../admin_view.php'"/>
   </p>

