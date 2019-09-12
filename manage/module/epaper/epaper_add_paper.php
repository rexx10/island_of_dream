<?php 
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
?>
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Generator" content="Dev-PHP 1.9.4">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
<title>電子報系統</title>
</head>
<body>
<div align="center">
  <p>☆☆☆<font color="#FF0000">建立最新一期的電子報</font>☆☆☆</p>
  <form name="form1" method="POST" Action="../epaper/epaper_insert_paper.php">
    <table width="500" border="0">
      <tr bgcolor="#0033CC">
        <td width="420"> <div align="center"><font color="#FFFFFF" size="-1">
            <input name="epaper_title" type="text" value="請輸入電子報的標題"
             size="50">
            </font></div></td>
        <td width="80"> <div align="right"><font color="#FFFFFF" size="-1">
            <input name="epaper_issue_date" type="text" value="<?php echo date('Y-m-d', strtotime('+8HOUR') ); ?>" size="10">
            </font></div></td>
      </tr>
      <tr>
        <td colspan="2"><font size="-1">&nbsp;</font></td>
      </tr>
      <tr>
        <td colspan="2"><font size="-1">
          <textarea name="epaper_content" cols="80" rows="10"
          >請建立電子報的內容。</textarea>
          </font></td>
      </tr>
      <tr>
        <td colspan="2"><font size="-1">&nbsp;</font></td>
      </tr>
      <tr>
        <td colspan="2"> <div align="right"><font size="-1"></font></div>
          <div align="right"><font size="-1">
            <input type="submit" style="width:80px;height:50px;font-size:25px;" name="Submit" value="送出">
            </font></div></td>
      </tr>
    </table>
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
