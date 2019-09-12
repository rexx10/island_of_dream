<?php
//嵌入 config,php 及 dbtools.inc.php
  require_once("../epaper/epaper_config.php");
  include("../epaper/epaper_dbtools.inc.php");
  require_once("../epaper/check_session.php");
//將傳送過來的OrderEmail指定給$UserEmail變數
  $user_email=$_GET['order_email'];
//判斷Email帳號是否存在
  $action="SELECT order_mail FROM $dbtable_01
           WHERE order_mail='$user_email'";
  $check_sql=mysql_query($action) or die("失敗");
  if(mysql_num_rows($check_sql) <= 0) {
  echo "找不到這個訂閱位址！";
  exit;
  }
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
  <p><strong>☆☆☆<font color="#0000FF">修改／取消訂閱</font>
  ☆☆☆</strong></p>
  <form name="form1" method="POST" action="epaper_update_order_email.php">
    <table width="300" border="1">
      <tr>
        <td><p><strong>修改：</strong>將電子報的寄送位址修改為</p>
          </td>
      </tr>
      <tr>
        <td><input name="new_email" type="text"
                   value="<?php echo $_GET['order_email']; ?>">
          <input type="hidden" name="old_email"
                 value="<?php echo $_GET['order_email']; ?>">
          <input type="submit" name="Submit" value="送出修改">
        </td>
      </tr>
    </table>
  </form>
  <form name="form2" method="post" action="epaper_delete_order_email.php">
    <table width="300" border="1">
      <tr>
        <td><p><strong>取消訂閱：</strong>
        取消<font color="#0000FF"><?php echo $_GET['order_email']; ?>
        </font>位址的電子報訂閱</p></td>
      </tr>
      <tr>
        <td><div align="right"><strong>
            <input type="hidden" name="delete_email"
                   value="<?php echo $_GET['order_email']; ?>">
            <input type="submit" name="Submit2" value="取消訂閱">
            </strong></div></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
