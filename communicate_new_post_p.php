<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="Description" content="多元小說，豐富生活，。">
<meta name="Keywords" content="小說, 言小說, 言情小說, 創作, 電子書"> 

  <title>夢之鄉-交流園地</title>
  <script language="javascript" src="test_adv_auto.js" charset = "UTF-8"></script>
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <link rel=stylesheet type="text/css" href="./index.css">
    <link rel="shortcut icon" href="./images/logo2.png">
  <link rel=stylesheet type="text/css" href="./dream_topselectbutton.css">
    <style type="text/css">
a:link {color:#000000}　　　　//宣告連結顏色
a:active {color:#000000}　　  //執行中連結顏色
a:hover {color:#000000}       //當滑鼠移到連結時連結顏色
</style>
</head>
<body>
<?php
		require_once("config.php");
	    require_once("dbtools.inc.php");
	
  $author = $_POST["re_value_01"];
  $subject = strip_tags($_POST["re_value_02"]); 
  $content = strip_tags($_POST["re_value_03"]); 
  $current_time = date("Y-m-d G:i:t", strtotime("+8HOUR"));

  //建立資料連接
  //$link_sql = create_sql_connection();
  
  //執行 SQL 命令
  $insert_sql = "INSERT INTO $dbtable_02(author, 
                                         subject, 
										 content, date)
          VALUES ('".mysql_real_escape_string($author)."', 
		          '".mysql_real_escape_string($subject)."', 
				  '".mysql_real_escape_string($content)."', 
				  '".mysql_real_escape_string($current_time)."')";
				  
  //$result = execute_sql("mysexbook", $sql, $link_sql);
  $result = mysql_query($insert_sql) or die("失敗");

  //關閉資料連接
  //mysql_close($link);  
  //釋放記憶體空間
  mysql_free_result($result);
  //將網頁重新導向
  header("location:communicate_list_page.php?id=");
  exit();
?>
</body></html>