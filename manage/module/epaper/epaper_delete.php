<?php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
$epaper_id=$_GET['epaper_id'];
$epaper_delete_sql="DELETE from $dbtable_00
            Where epaper_id='$epaper_id'";
$Result=mysql_query($epaper_delete_sql) or die("失敗");
header("Location:epaper_list.php");
?>
