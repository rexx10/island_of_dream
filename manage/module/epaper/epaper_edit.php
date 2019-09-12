<?php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
  $epaper_id=$_GET['epaper_id'];
  //$The_PaperID=$_GET['PaperID'];
  $query_epaper_data="SELECT * FROM $dbtable_00
                    WHERE epaper_id=$epaper_id";
  $epaper_data=mysql_query($query_epaper_data) or die("失敗");
  list($epaper_id,$epaper_title,$epaper_content,$epaper_issue_date)
  =mysql_fetch_row($epaper_data);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
<meta name="Generator" content="Dev-PHP 1.9.4">
<title>電子報系統</title>
</head>
<body>
<div align="center">
  <p>☆☆☆修改 第<font color="#FF0000"> <?php echo $epaper_id; ?>
  </font>期☆☆☆</p>
  <form name="form1" method="post" action="epaper_update_paper.php">
    <table width="500" border="0">
      <tr bgcolor="#0033CC">
        <td width="420"> <div align="center"><font color="#FFFFFF" size="-1">
            <input name="epaper_title" type="text"
            value="<?php echo $epaper_title; ?>" size="50">
        </font></div></td>
        <td width="80"> <div align="right"><font color="#FFFFFF" size="-1">
            <input name="epaper_issue_date" type="text"
            value="<?php echo $epaper_issue_date; ?>" size="7">
        </font></div></td>
      </tr>
      <tr>
        <td colspan="2"><font size="-1">&nbsp;</font></td>
      </tr>
      <tr>
        <td colspan="2"><font size="-1">
          <textarea name="epaper_content" cols="65" rows="10"
          ><?php echo $epaper_content; ?></textarea>
          </font></td>
      </tr>
      <tr>
        <td colspan="2"><font size="-1">&nbsp;</font></td>
      </tr>
      <tr>
        <td colspan="2"> <div align="right"><font size="-1"></font></div>
          <div align="right"><font size="-1">
            <input type="submit" style="width:80px;height:50px;font-size:25px;" name="Submit" value="修改">
            </font></div></td>
      </tr>
    </table>
<input type="hidden" name="epaper_id" value="<?php echo $epaper_id; ?>">
  </form>
</div>
<center><input type="button" style="width:250px;height:80px;font-size:25px;" value="返回電子報清單頁面" onclick="self.location.href='./epaper_list.php'"/></center>
</body>
</html>


<?php
include_once "ckeditor/ckeditor.php";
$CKEditor = new CKEditor();
$CKEditor->basePath = 'ckeditor/';
$CKEditor->replace("epaper_content");
?>
