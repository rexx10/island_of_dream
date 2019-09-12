<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
</head>
<body>

<?php 
 require_once("./dreamland_basic_config.php");
  require_once("./dreamland_basic_dbtools.inc.php");
require_once('check_session.php');
	$tmp_up_author_code = $_GET["up_author_code"]; //作者代號
	$tmp_up_book_name_code = $_GET["up_book_name_code"]; //作品編號
	$tmp_up_book_name = $_GET["up_book_name"]; //作品名稱
	$tmp_up_author_name = $_GET["up_author_name"]; //作者姓名
	
	
	
	
	switch($_GET["author_book_img_edit_type"])
	{
		case"up_aut_book_front_cover_big_long_path":
		
		    $tmp_up_author_book_front_cover_big_long_path = $_GET["up_author_book_front_cover_big_long_path"]; //作品內文大圖
?>			
			<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->

	             <!--<title>修改作者<//?php echo $tmp_up_author_name; ?>作品編號 <//?php echo $tmp_up_book_name_code;?> 內文大圖</title>
			          <!--<body background="../pic/back.jpg" bgproperties="fixed">-->
			          <center>
			          <font size="7">修改作者 <font color="red"><?php echo $tmp_up_author_name; ?></font> 作品編號 <font color="red"><?php echo $tmp_up_book_name_code; echo "&nbsp;&nbsp;"; echo $tmp_up_book_name; ?></font> 內文大圖</font><HR>
			          <Form Action="./author_book_main_data_edit_uni_img_sql.php" Method="POST" enctype="multipart/form-data">
				           <input type ="hidden" Name="old_author_book_front_cover_img" value="<?php echo $tmp_up_author_book_front_cover_big_long_path; ?>"> 
				           <input type ="hidden" Name="author_code" value="<?php echo $tmp_up_author_code; ?>">
						   <input type ="hidden" Name="author_name" value="<?php echo $tmp_up_author_name; ?>">
						   <input type ="hidden" Name="book_name_code" value="<?php echo $tmp_up_book_name_code; ?>">
						   <input type ="hidden" Name="book_name" value="<?php echo $tmp_up_book_name; ?>">
						   <input type ="hidden" Name="author_book_img_edit_type" value="up_aut_book_front_cover_img">
						   <input type ="hidden" Name="author_book_img_type" value="up_aut_book_front_cover_img_big">
						   
						   <table border="1">
				           <font color="red" size="6">橫幅圖檔請使用500px × 270px 大小</font>
				           <tr><td>圖片：</td><td><img src="<?php echo $tmp_up_author_book_front_cover_big_long_path; ?>"></td></tr>
				           <tr><td>更換成：</td><td><Input Type="file" Name="chg_aut_book_front_cover_img" Size="45" /></td></tr>
				           </table>
				           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="修改">&nbsp;&nbsp;<input type="RESET" value="取消">
						   <input type="button" value="返回前一頁" onclick="location.href='author_book_main_data_edit.php?up_author_code=<?php echo  $tmp_up_author_code; ?>&up_book_name_code=<?php echo $tmp_up_book_name_code; ?>&author_book_data_type=up_data'" style="font-size: 8 pt"/>
				           <input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				           
				           </body>				
			          </form>
					  </center>
			
			
<?php		
			break;
		
		case"up_aut_book_front_cover_long_path":
		
			$tmp_up_author_book_front_cover_long_path = $_GET["up_author_book_front_cover_long_path"];  //作者封面圖
			
?>			
			<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->

	             <title>修改作者<?php echo $tmp_up_author_name; ?>作品編號 <?php echo $tmp_up_book_name_code;?> 封面圖</title>
			          <body background="../pic/back.jpg" bgproperties="fixed">
			          <center>
			          <font size="8">修改作者 <font color="red"><?php echo $tmp_up_author_name; ?></font> 作品編號 <font color="red"><?php echo $tmp_up_book_name_code; echo "&nbsp;&nbsp;"; echo $tmp_up_book_name; ?></font> 封面圖</font><HR>
			          <Form Action="./author_book_main_data_edit_uni_img_sql.php" Method="POST" enctype="multipart/form-data">
				           <input type ="hidden" Name="old_author_book_front_cover_img" value="<?php echo $tmp_up_author_book_front_cover_long_path; ?>"> 
				           <input type ="hidden" Name="author_code" value="<?php echo $tmp_up_author_code; ?>">
						   <input type ="hidden" Name="author_name" value="<?php echo $tmp_up_author_name; ?>">
						   <input type ="hidden" Name="book_name_code" value="<?php echo $tmp_up_book_name_code; ?>">
						   <input type ="hidden" Name="book_name" value="<?php echo $tmp_up_book_name; ?>">
						   <input type ="hidden" Name="author_book_img_edit_type" value="up_aut_book_front_cover_img">
						   <input type ="hidden" Name="author_book_img_type" value="up_aut_book_front_cover_img_small">
						   
						   <table border="1">
				           <font color="red" size="6">橫幅圖檔請使用154px × 100px 大小</font>
				           <tr><td>圖片：</td><td style='text-align:center'><img src="<?php echo $tmp_up_author_book_front_cover_long_path; ?>"></td></tr>
				           <tr><td>更換成：</td><td><Input Type="file" Name="chg_aut_book_front_cover_img"  Size="45" /></td></tr>
				           </table>
				           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="修改">&nbsp;&nbsp;<input type="RESET" value="取消">
				           <input type="button" value="返回前一頁" onclick="location.href='author_book_main_data_edit.php?up_author_code=<?php echo  $tmp_up_author_code; ?>&up_book_name_code=<?php echo $tmp_up_book_name_code; ?>&author_book_data_type=up_data'" style="font-size: 8 pt"/>
				           <input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				           </center>
				           </body>				
			          </form>
			
			
<?php
			
			
		
			break;
		
	
	}
	


?>
</body>
</html>
