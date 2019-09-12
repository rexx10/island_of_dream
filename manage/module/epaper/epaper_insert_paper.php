<?php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");

echo $epaper_title=$_POST['epaper_title'];
echo $epaper_content=$_POST['epaper_content'];
echo $epaper_issue_date=$_POST['epaper_issue_date'];

$insertsql="INSERT INTO $dbtable_00 (epaper_title,epaper_content,epaper_issue_date)
           VALUES ('$epaper_title','$epaper_content','$epaper_issue_date')";
			


$Result=mysql_query($insertsql) or die("失敗");
header("Location:epaper_list.php");
?>
