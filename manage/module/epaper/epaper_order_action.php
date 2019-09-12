<?php
//嵌入 config,php 及 dbtools.inc.php
    require_once("../epaper/epaper_config.php"); //引入參數設定
    require_once("../epaper/epaper_dbtools.inc.php"); //引入資料庫設定檔
	require_once("../epaper/check_session.php");
//將傳送過來的OrderEmail指定給$UserEmail變數
  $user_email=$_POST["order_email"];
//判斷Email帳號是否重複
  $action="SELECT order_mail FROM $dbtable_01
           WHERE order_mail='$user_email'";
  $check_sql=mysql_query($action) or die("失敗");
  if(mysql_num_rows($check_sql) > 0) {
  echo "這個郵件位址已經訂閱過了！";
  exit;
  }
//插入記錄
  $insert_sql="INSERT INTO $dbtable_01 (order_mail)
              VALUES ('$user_email')";
  $Result=mysql_query($insert_sql) or die("失敗");
  header("Location:epaper_order_success.php");
//註冊Session
  session_start();
  session_register("user_email");
?>
