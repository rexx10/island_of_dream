<?php
//嵌入 config,php 及 dbtools.inc.php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
$old_email=$_POST['old_email'];
$new_email=$_POST['new_email'];
$update_sql="UPDATE $dbtable_01
            SET order_mail='$new_email'
            Where order_mail='$olde_email'";
$Result=mysql_query($update_sql) or die("失敗");
echo "您電子報寄送的郵件位址已更改為".$new_email;
?>
