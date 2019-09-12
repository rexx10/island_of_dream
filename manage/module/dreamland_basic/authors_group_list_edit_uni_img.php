<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
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
			
			          <center>
			          <font size="7">修改作者 <font color="red"><?php echo mysql_result($result, 0, "authors_name"); ?></font>網站圖片</font><HR>
			          <Form name="form1" Action="./authors_group_list_sql.php" Method="POST" enctype="multipart/form-data">
					       <input type ="hidden" Name="this_mode" value="up_img_mode">
						   <input type ="hidden" Name="authors_id" value="<?php echo $_GET["authors_id"]; ?>">
						   <input type ="hidden" Name="authors_code" value="<?php echo $_GET["authors_code"]; ?>">						   
						   <table border="1">
				           <font color="red" size="6">橫幅圖檔請使用500px × 270px 大小</font>
				           <tr><td>圖片：</td><div><td><div><img src="<?php echo mysql_result($result, 0, "authors_img_full_path"); ?>" width='500' height='270'></div></td></div></tr>
				           <tr><td>更換成：</td><td><Input Type="file" Name="ch_group_authors_img" id="group_authors_img"></td></tr>
				           </table>
				           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="修改">&nbsp;&nbsp;<input type="RESET" value="取消">
						   <input type="button" value="返回前一頁" onclick="location.href='authors_group_list_edit.php?authors_id=<?php echo $_GET["authors_id"]; ?>&authors_code=<?php echo $_GET["authors_code"]; ?>'" style="font-size: 8 pt"/>
				           <input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				           
				           </body>				
			          </form>
					  </center>
			

</body>
</html>
