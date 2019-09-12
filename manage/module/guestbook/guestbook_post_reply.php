<?php
	  require_once("./guestbook_config.php");
      require_once("./guestbook_dbtools.inc.php");
	  require_once('check_session.php');
	
  $author = $_POST["author"]."&nbsp;(admin)";
  $subject = $_POST["subject"]; 
  $content = $_POST["content"]; 
  $current_time = date("Y-m-d G:i:t", strtotime("+8HOUR"));
  $reply_id = $_POST["reply_id"];

  //建立資料連接
  //$link_sql = create_sql_connection();
	
  //執行 SQL 命令
  $insert_sql = "INSERT INTO $dbtable_01(reply_message_author,reply_message_subject, reply_message_content, reply_message_date, reply_message_reply_id, admin_mode) 
          VALUES ('$author', '$subject', '$content', '$current_time', '$reply_id', 'Y')";
  //$result = execute_sql("mysexbook", $sql, $link_sql);
    $result = mysql_query($insert_sql) or die("失敗");

  //關閉資料連接
  //mysql_close($link_sql); 
  //釋放記憶體空間
  mysql_free_result($result);  
  
  //將網頁重新導向
  header("location:guestbook_show_news.php?id=" . $reply_id);
  exit();
?>