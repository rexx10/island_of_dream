<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel=stylesheet type="text/css" href="./edit_dream_book_config.css">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">
<script language="javascript" src="creation_article_js_check.js" charset = "UTF-8"></script>
</head>
<body>

<?php 
     require_once("creation_article_config.php");
	 require_once("creation_article_dbtools.inc.php");
	 require_once('check_session.php');
	
   $ca_authors_code = $_GET["ca_authors_code"];
   $ca_authors_name = $_GET["ca_authors_name"];
   $sel_sql = "SELECT * FROM $dbtable_00 WHERE ca_authors_code = '".mysql_real_escape_string($ca_authors_code)."' AND 
                                               ca_authors_name = '".mysql_real_escape_string($ca_authors_name)."'";
   $result = mysql_query($sel_sql) or die("失敗1");
	
	//<input type ="hidden" Name="authors_name" value="<?php echo $_GET["authors_name"]; ">	
?>			
			
			          <center>
			          <font size="7">修改作者 <font color="red"><?php echo mysql_result($result, 0, "ca_authors_name"); ?></font>網站圖片</font><HR>
			          <Form name="form1" Action="./ca_authors_data_config_sql.php" Method="POST" enctype="multipart/form-data">
				           <input type ="hidden" Name="this_mode" value="up_img_mode">
				           <input type ="hidden" Name="ca_authors_code" value="<?php echo $_GET["ca_authors_code"]; ?>">
						   <input type ="hidden" Name="ca_authors_name" value="<?php echo $_GET["ca_authors_name"]; ?>">
						   <table border="1">
				           <font color="red" size="6">橫幅圖檔請使用 W 93px × H 100px 大小</font>
				           <tr><td>圖片：</td><div><td><div><center><img src="<?php echo mysql_result($result, 0, "ca_author_code_img_long_path"); ?>" width='93' height='100'></center></div></td></div></tr>
				           <tr><td>更換成：</td><td><Input Type="file" Name="ch_authors_data_config_img"  id="ch_authors_data_config_img"></td></tr>
				           </table>
				           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="SUBMIT" value="修改" onclick="check_ca_authors_data_configuni_edit_img_keyin_box();if(event) event.preventDefault()">&nbsp;&nbsp;
					   	   <input type="button" value="返回前一頁" onclick="location.href='ca_authors_data_config.php'" style="font-size: 8 pt"/>
						   <input type="button" value="返回連載作者清單" onclick="location.href='creation_article_index.php'" style="font-size: 8 pt"/>
						   <input type="button" value="返回主選單" onclick="self.location.href='../../admin_view.php'"/>
				           
				           </body>				
			          </form>
					  </center>
			

</body>
</html>
