<?php
//嵌入 config,php 及 dbtools.inc.php
require_once("../epaper/epaper_config.php"); //引入參數設定
require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
require_once("../epaper/check_session.php");
$epaper_id=$_POST['epaper_id'];
$new_title=$_POST['epaper_title'];
$new_date=$_POST['epaper_issue_date'];
$new_content=$_POST['epaper_content'];
$update_sql="UPDATE $dbtable_00
            SET epaper_title = '$new_title',epaper_issue_date='$new_date',
            epaper_content = '$new_content'
            WHERE epaper_id = '$epaper_id'";
$Result=mysql_query($update_sql) or die("失敗");
header("Location:epaper_list.php");
?>
