<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

		//引入SQL相關動作
		//如果dbtools.inc.php與此網頁不在同一目錄之下使用require.once，路徑需使用相對路徑../dbtools.inc.php 
	require_once("./banner_config.php");
	require_once("./banner_dbtools.inc.php");
	require_once('check_session.php');
	 //建立資料庫連接
	
	$select_sql = "SELECT * FROM $dbtable_00 WHERE idno = 1";
	//$select_sql = "SELECT * FROM $dbtable_00";
	$result = mysql_query($select_sql) or die("失敗");
	$row = MySQL_fetch_array($result);
	
	if(!$row == 0)
	{
			
		$print_banner_filepiclink = mysql_result($result, 0, "filepiclink");
		
			//釋放查詢$result所佔用的記憶體
		mysql_free_result($result);	
		
		//如果資料庫內有資料顯示 $my_adv_filename, $my_adv_pric, $my_adv_introduction 三個變數的資料及 修改廣告和刪除廣告兩個選項
?>
	<html>
	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
	</HEAD>
		<title>修改 / 刪除 橫幅廣告</title>
		<body background="../pic/back.jpg" bgproperties="fixed">
		<center>
			<H3>修改 / 刪除 橫幅廣告</H3><HR>
			<form>
			<table border="1">
			<tr><td>圖片：</td><td><img src="<?php echo $print_banner_filepiclink; ?>"></td></tr>
			</table><BR>
			&nbsp;&nbsp;&nbsp;<input type="button" value="修改橫幅廣告" onclick="self.location.href='banner_ad_edit.php?name=edit_banner_ad_pic&name2=<?php echo $print_banner_filepiclink; ?>'"/>
			&nbsp;&nbsp;<input type="button" value="刪除橫幅廣告" onclick="self.location.href='banner_sql_ins_up_del.php?t_banner_pic=del_banner_ad_pic&name2=<?php echo $print_banner_filepiclink; ?>'"/>&nbsp;&nbsp;
			&nbsp;&nbsp;<input type="button" value="返回管理頁面" onclick="self.location.href='../../admin_view.php'"/>
			</form>
		</center>
		</body>
	</html>
<?php
	}
	
	else
	
	{ 
	
		//釋放查詢$result所佔用的記憶體
		mysql_free_result($result);	
		
		//關閉資料庫連結
		//mysql_close($link_sql);
		//如果資料庫內無任何資料就顯示新增廣告畫面
		
?>
	<HTML>
		<HEAD>
			<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		</HEAD>
				<title>新增橫幅廣告</title>
				<BODY background="../pic/back.jpg" bgproperties="fixed">
				<center>
				<H3>新增橫幅廣告</H3>
				<HR>
				
				<Form Action="./banner_sql_ins_up_del.php" Method="POST" enctype="multipart/form-data">
					<input type ="hidden" Name="t_banner_pic" value="new_banner"> 
					<table border="1">
					<font color="red" size="30">橫幅圖檔請使用514px × 270px 大小</font>
					<tr><td>圖片：</td><td><Input Type="file" Name="my_banner_pic"  Size="45" /></td></tr>
					</table>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="新增">&nbsp;&nbsp;<input type="RESET" value="取消">
					<input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				
								
				</form>
		</center>
		</BODY>
	</HTML>
	
 <?php
  } 
  ?>		
