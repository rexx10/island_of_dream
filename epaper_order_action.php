<?php
//嵌入 config,php 及 dbtools.inc.php
  require_once("config.php");
  require_once("dbtools.inc.php");
  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>";
  session_start();
  if($_SESSION["Checknum"] == $_POST['checknum'])
  {
      //將傳送過來的OrderEmail指定給$UserEmail變數
      $user_email=$_POST["myemail"];
	  switch($_POST["order_epaper_type"])
      {   //新增mail
          case"add_mail":
	    
              //判斷Email帳號是否重複
              $action="SELECT order_mail FROM $dbtable_05 WHERE order_mail='$user_email'";
              $check_sql=mysql_query($action) or die("失敗");
              if(mysql_num_rows($check_sql) > 0)
		      {
                  echo "<script type='text/javascript'>";
			      echo "confirm('這個郵件位址已經訂閱過了！請勿重複訂閱!');";
			      echo "history.back();";
			      echo "</script>";
                  exit;
              }
              //插入記錄
              $ins_sql="INSERT INTO $dbtable_05 (order_mail) VALUES ('$user_email')";
              $result=mysql_query($ins_sql) or die("失敗");
              /* header("Location:epaper_order_success.php");
              //註冊Session
              session_start();
              session_register("user_email"); */
			  $epaper_mail_subject="夢之鄉電子報訂閱通知";
              $epaper_mail_body="親愛的訂戶，您好！\n
			  歡迎您訂閱 夢之鄉的電子報，這是一封電子報訂閱的通知郵件。\n
			  您使用的訂閱信箱是：".$user_email."\n
			  夢之鄉會定期寄發電子報到您的信箱。會定期寄發電子報到您的信箱。
			  如果想要修改訂閱位址，或取消訂閱，請連結到下列位址：\n
			  http://localhost/www/epaper_order_modify_page.php\n
			  若有任何使用上的問題歡迎您來信詢問。\n
			  服務信箱：dreamland@dreamland8.com\n
			  期待您良性的批評與建議－夢之鄉  敬上";
              mail($user_email,$epaper_mail_subject,$epaper_mail_body);
			  
			  echo "<script type='text/javascript'>";
			  echo "confirm('您已訂閱成功!謝謝!');";
			  echo "history.back();";
			  echo "</script>";
              exit;
			  
		      break;
		  //刪除mail
          case"del_mail";
	          
			  $del_sql="DELETE FROM $dbtable_05 WHERE order_mail='$user_email'";
              $result=mysql_query($del_sql) or die("失敗");
              //echo "您已成功地取消&nbsp;".$user_email."&nbsp;位址的電子報訂閱 ";
			  echo "<script type='text/javascript'>";
			  echo "confirm('您已成功地取消 $user_email 位址的電子報訂閱');";
			  echo "history.back();";
			  echo "</script>";
              exit;
			  
		      break;
      }
  }
  else
  {
      echo "<script type='text/javascript'>";
	  echo "confirm('您所輸入的驗證碼錯誤！請回上一頁重新輸入。');";
	  echo "history.back();";
	  echo "</script>";
  
  }  
?>
