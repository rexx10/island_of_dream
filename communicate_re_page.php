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
a:link {color:#000000;}　　　　/* //宣告連結顏色 */
a:active {color:#000000;}　　  /* //執行中連結顏色 */
a:hover {color:#000000;}     /*   //當滑鼠移到連結時連結顏色 */
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

		
		 $url="http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
		if($_SESSION['user_name']==false)
		{
		?>
            
			<script language="JavaScript">
                alert("請登入會員或註冊成會員！！謝謝！！");
                location.href = "<?php echo $url; ?>"; //直接指向頁面名稱
        </script> 
		<?php
			}
		
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
		<div id="middle_communicate_main_text_title">
		<?php
		
		$sel_sql = "SELECT * FROM $dbtable_02 WHERE id = '".mysql_real_escape_string($_GET["id"])."'";
		$result = mysql_query($sel_sql) or die("失敗");
		if(mysql_result($result, 0, "id") == "" or !is_numeric(mysql_real_escape_string($_GET["id"]))){
		
		      mysql_free_result($result);
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
		
		}		
		//指定每頁顯示幾筆記錄
      
		?></div>
		<div id="middle_communicate_main_text_body">
		<form action="communicate_re_p.php" method="POST" name="myForm">
		<input name="re_value_00" type="hidden" value="<?php echo mysql_result($result, 0, "id"); ?>">
        <input name="re_value_01" type="hidden" value="<?php echo $_SESSION['user_name']; ?>">
		<div align="center">回覆留言</div>
		<div style="margin-left: 25px;">留言主題：<font size="20px"><input type="text" name="re_value_02" value="re:<?php echo mysql_result($result, 0, "subject"); ?>" id="re_sub" style="width:500px;"></font></div>
		<span style="position:relative;top:-250px; margin-left: 25px;">回覆內容：</span><span><textarea name="re_value_03" cols="60" rows="20" id="content"></textarea></span>
		<div align="right" style="margin-right: 50px;"><input type="submit">&nbsp;&nbsp;<input type="reset"></div>
		</form>
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