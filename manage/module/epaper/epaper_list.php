<?php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
$query_epaper_data="SELECT * FROM $dbtable_00 ORDER BY epaper_issue_date DESC";
$epaper_data=mysql_query($query_epaper_data) or die("失敗");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset = UTF-8">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
<meta name="Generator" content="Dev-PHP 1.9.4">
<title>電子報系統</title>
</head>
<body>
<div align="center">
  <table width="800" border="0">
    <tr>
      <td><div align="center">☆☆☆
          <font size="5" color="#FF0000">電子報清單</font>☆☆☆
      </div></td>
      <td width="150">
        <div align="right"><font size="5">
        <a href="epaper_add_paper.php">新增電子報</a>
      </font></div></td>
    </tr>
  </table>
  <table width="1000" border="0" align="center">
    <tr bgcolor="#0000FF">
      <td width="50">
        <div align="center"><font color="#FFFFFF" size="5">期號
      </font></div></td>
      <td width="250">
        <div align="center"><font color="#FFFFFF" size="5">標題
      </font></div></td>
      <td width="70">
        <div align="center"><font color="#FFFFFF" size="5">建報日期
      </font></div></td>
      <td width="80">
        <div align="center"><font color="#FFFFFF" size="5">編輯
      </font></div></td>
      <td width="50">
        <div align="center"><font color="#FFFFFF" size="5">寄送
      </font></div></td>
    </tr>
<?php while(list($epaper_id,$epaper_title,$epaper_content,$epaper_issue_date)
      =mysql_fetch_row($epaper_data))
      { ?>
    <tr>
      <td width="50">
        <div align="center"><font size="5">
        <?php echo $epaper_id; ?>
      </font></div></td>
      <td width="300"><font size="5">
        <a href="epaper_view.php?epaper_id=<?php echo $epaper_id;?>">
        <?php echo $epaper_title; ?></a>
      </font></td>
      <td width="70">
        <div align="center"><font size="5">
        <?php echo $epaper_issue_date; ?>
      </font></div></td>
      <td width="80">
        <div align="center"><font size="5">
        <a href="epaper_edit.php?epaper_id=<?php echo $epaper_id;?>">
        修改</a>&nbsp;&nbsp;&nbsp;
        <a href="epaper_delete.php?epaper_id=<?php echo $epaper_id;?>
        ">刪除</a>
        </font></div></td>
      <td width="50">
        <div align="center"><font size="5">
        <a href="epaper_send.php?epaper_id=<?php echo $epaper_id;?>">
        送出</a>
      </font></div></td>
    </tr>
<?php } ?>
  </table>
</div>
<BR><BR><BR>
<center><input type="button" style=" width:140px;height:50px;font-size:20px;" value="返回管理頁面" onclick="self.location.href='../../admin_view.php'"/></center>
</body>
</html>
