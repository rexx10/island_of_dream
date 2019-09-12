<?php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
$epaper_my_email=$_POST['epaer_delete_email'];
$epaper_delete_sql="DELETE from $dbtable_01
            Where order_email='$epaper_my_email'";
$Result=mysql_query($epaper_delete_sql) or die("失敗");
echo "您已成功地取消".$epaper_my_email."位址的電子報訂閱 ";
?>
