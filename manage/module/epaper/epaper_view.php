<?php
//嵌入 config,php 及 dbtools.inc.php
  require_once("../epaper/epaper_config.php"); //引入參數設定
  require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
  require_once("../epaper/check_session.php");
  $epaper_id=$_GET['epaper_id'];
  //$The_PaperID=$_GET['epaper_id'];
  $query_epaper_data="SELECT * FROM $dbtable_00
                    WHERE epaper_id = $epaper_id";
  //$query_PaperData="SELECT * FROM paperbody WHERE PaperID=$The_PaperID";
  $epaper_data=mysql_query($query_epaper_data) or die("失敗");
  list($epaper_id,$epaper_title,$epaper_content,$epaper_issue_date)
  =mysql_fetch_row($epaper_data);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content = "text/html; charset = UTF-8">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
<title>電子報系統</title>
</head>
<body>
<div align="center">
  <p>☆☆☆<font size="5" color="#FF0000">第<?php echo $epaper_id; ?>期
  </font>☆☆☆</p>
  <table width="800" border="0" align="center">
    <tr bgcolor="#0000FF">
      <td colspan="2"><div align="center"><font color="#FFFFFF" size="5">
         <?php echo $epaper_title; ?>
      </font></div></td>
      <td width="120"><div align="right"><font color="#FFFFFF" size="5">
         <?php echo $epaper_issue_date; ?>
      </font></div></td>
    </tr>
    <tr>
      <td colspan="3"><font size="5">&nbsp;</font></td>
    </tr>
    <tr>
      <td colspan="6"><font size="5">
         <?php echo $epaper_content; ?>
      </font></td>
    </tr>
    <tr>
      <td colspan="3"><font size="5">&nbsp;</font></td>
    </tr>
    <tr>
      <td width="403"><div align="right"><font size="5">
         <a href="epaper_list.php">回電子報清單</a>
      </font></div></td>
      <td colspan="2"><div align="right"><font size="5">
         <a href="epaper_send.php?epaper_id=<?php echo $epaper_id; ?>">
         送出電子報</a>
      </font></div></td>
    </tr>
  </table>
</div>
</body>
</html>
