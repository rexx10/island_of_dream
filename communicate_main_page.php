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
	<div id="out">
		<div id="top_main">
		<div id="top_highest_link"><font size="1"><BR></font><!--最上層連結區--></div>
		<div id="top_middle">
		<div id="top_m_left"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']); ?>"><img src="./images/logo.jpg"></a></div>
		<div id="top_m_middle"></div>
		<div id="top_m_right"></div>
		</div>
		<div id="top_botton">
			<ul>
				<li id="toptop"><a href="./new_books_list_page.php" title="新書特報">新書特報</a></li>
				<li id="toptop"><a href="./communicate_list_page.php" title="交流園地">交流園地</a></li>
				<li id="toptop"><a href="./dream_books_list_page.php" title="夢文館">夢文館</a></li>
				<li id="toptop"><a href="./authors_list_page.php" title="作者坊">作者坊</a></li> 
				<li id="toptop"><a href="./epaper_page.php" title="電子報">電子報</a></li>
				<li id="toptop"><a href="./ec" title="電子報">購物館</a></li>
			</ul>
		</div>
		</div>
		<?php 		
		require_once("config.php");
		require_once("dbtools.inc.php");
		require_once("config2_new_book.php");		
		?>		
		<div id="middle_area">
		<div id="middle_left">
		<?php
		if($_SESSION['user_name']==false)
		{ ?>
		<div id="middle_l_login">
		<form method="post" name="form_fast_login" action="ec/user.php">
		<div style="margin-left:20px;font-size:15px;">帳號：<input type="text" name="username" id="id_username" style="width:120px; border: 1px solid #000000;background-color: #FFFAFA;color:#000000;"></div>
		<div style="margin-left:20px;font-size:15px;">密碼：<input type="password" name="password" id="id_password" style="width:120px; border: 1px solid #000000;background-color: #FFFAFA;color:#000000;"></div>
		<input type="hidden" name="act" value="act_login" />
		<input name="now_type" type="hidden" value="out_fast_login">
		<div align="right" style="margin-right:25px; margin-top:5px;"><input type="submit" id="Submit" value="登入">&nbsp;&nbsp;<input type="reset"></div>
		</form>
		<div align="right" style="margin-right:27px; font-size:12px;"><a href="join_go_page.php?id=go">註冊會員</a>|<a href="ec/user.php?act=qpassword_name">取回密碼</a></div>
		</div>
		<?php
		}
		else
		{ ?>
		<div id="middle_l_loging">
		<?php
        //echo "<div>歡迎光臨，".$_SESSION['user_name']."會員</div>";
		echo "<div align='center' style='margin-left:20px;font-size:15px;'>歡迎光臨</div>";
		echo "<div align='center'style='margin-left:20px;font-size:15px;'>".$_SESSION['user_name']."會員</div>"
		
		?>
		<div align="right" style="margin-right:25px; margin-top:30px;"><input type="button" value="登出" onclick="self.location.href='bye_bye.php'"></div>
		</div>
		
		<?php 
		}
		?>
		<!--<div id="middle_l_s_sale_area">
		<div id="middle_l_s_sale_area_pic"></div>
		</div>-->
		<!--中間左側登入區--></div>
		<div id="middle_right">
		<div id="middle_communicate_title"></div>
		<div id="middle_communicate_main_text">
		<div id="middle_communicate_main_text_title"><?php 
		require_once("config.php");
	    require_once("dbtools.inc.php");
		$sel_sql = "SELECT * FROM $dbtable_02 WHERE id = '".mysql_real_escape_string($_GET["id"])."'";
		$result = mysql_query($sel_sql) or die("失敗");
		if(mysql_result($result, 0, "subject") == "" or  !is_numeric(mysql_real_escape_string($_GET["id"]))){
		
		      mysql_free_result($result);
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
		
		}		
		//指定每頁顯示幾筆記錄
      $records_per_page = 8;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"])){
	       if(!is_numeric(mysql_real_escape_string($_GET["page"]))){;
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
		  
		   }
        $page = $_GET["page"];
      }else{
        $page = 1;
	  }
					
      //執行 SQL 命令
      $sel_sql_01 = "SELECT * FROM $dbtable_03 WHERE reply_message_reply_id = '".mysql_real_escape_string($_GET["id"])."' ORDER BY reply_message_date ASC";
	  $result_01 = mysql_query($sel_sql_01) or die("失敗");
      //取得記錄數
	  if(mysql_num_rows($result_01) != ""){
      $total_records = mysql_num_rows($result_01);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
		if(!mysql_data_seek($result_01, $started_record)){
		
		      //mysql_free_result($result);
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
		
		}		
      mysql_data_seek($result_01, $started_record);
	  }
		?></div>
		<div id="middle_communicate_main_text_body">
		<div id="middle_communicate_main_text_body_title">
		
		<table align="center">
		<tr>
		<td><a href="./communicate_list_page.php" style='text-decoration: none'>回交流園地首頁</a></td><td>&nbsp;|&nbsp;</td><td><a href="communicate_re_page.php?id=<?php echo mysql_result($result, 0, "id"); ?>">我要回覆留言</td>
		</tr>
		</table>
		</div>
		<div id="middle_communicate_main_text_body_body">
		<div id="middle_communicate_main_text_body_body_tilte">
		</div>
		<div id="middle_communicate_main_text_body_body_subject" align='center'>
		交流主題：<?php echo mysql_result($result, 0, "subject"); ?>
		</div>
		<div id="middle_communicate_main_text_body_body_aut_date">
		<table width="100%">
		<tr style='font-size: 10pt;'>
		<td width="60%" style='position:relative; left:-4px;'>發表作者：<?php echo mysql_result($result, 0, "author"); ?></td><td width="80%" style='float:right'>發表日期：<span style="line-height: 13px;"><?php echo mysql_result($result, 0, "date"); ?></span></td>
		</tr>
		</table>
		</div>
		<div id="middle_communicate_main_text_body_body_text" style='font-size: 10pt; line-height: 20px;'>
		<?php echo nl2br(mysql_result($result, 0, "content")); ?>
		<div id="middle_communicate_main_text_body_body_text_line"></div>
		<?php 
		if(mysql_num_rows($result_01) != ""){
		if(mysql_num_rows($result_01)>0){
		$j=1;
		while ($row = mysql_fetch_assoc($result_01) and $j <= $records_per_page)
        {
		?>
		<table width="100%">
		<tr style='font-size: 10pt;'>
		<td width="60%" style='position:relative; left:-4px;'>回覆作者：<span <?php if($row["admin_mode"] == "Y") echo "style='color:#FF0000';" ?>><?php echo $row["reply_message_author"]; ?></span></td><td width="80%" style='float:right'>回覆日期：<span style="line-height: 13px;"><?php echo $row["reply_message_date"]; ?></span></td>
		</tr>
		<tr>
		<td <?php if($row["admin_mode"] == "Y") echo "style='color:#FF0000';" ?>><?php echo nl2br($row["reply_message_content"]); ?></td>
		</tr>
		</table>
		<div id="middle_communicate_main_text_body_body_text_reply_message_line"></div>
        <?php
        $j++;
         } 		
		//產生導覽列
	  echo "<p align='center'>";
      if ($page > 1)
        echo "<a href='./communicate_main_page.php?page=".($page - 1)."&id=".$_GET["id"]."'>上一頁</a> ";
	  if($total_pages>1)
	  {	
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
		  echo "$i";
        else
          echo "<a href='./communicate_main_page.php?page=".$i."&id=".$_GET["id"]."'>&nbsp;".$i."</a>";		
      }
	  }	
      if ($page < $total_pages)
        echo "<a href='./communicate_main_page.php?page=".($page + 1)."&id=".$_GET["id"]."'>下一頁</a> ";			
				
      echo "</p>";
		}	
      //釋放記憶體空間
      mysql_free_result($result);
		mysql_free_result($result_01);
		}
		?>		
		</div>
		</div>
		<div id="middle_communicate_main_text_botton"></div>
		</div>
		</div>
		</div>
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div>
 
 
 
 
 
 
	</div>
</body></html>