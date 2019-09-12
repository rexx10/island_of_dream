<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="Description" content="多元小說，豐富生活，。">
<meta name="Keywords" content="小說, 言小說, 言情小說, 創作, 電子書"> 

  <title>夢之鄉-交流園地</title>
  <script language="javascript" src="test_adv_auto.js" charset = "UTF-8"></script>
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <link rel=stylesheet type="text/css" href="./index.css">
  <link rel="shortcut icon" href="./images/logo2.ico">
  <link rel=stylesheet type="text/css" href="./dream_topselectbutton.css">
  <script type="text/javascript" src="./epaper_check_mail.js"></script>

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
		<div id="middle_epaper_order_modify_title"></div>
        <div id="middle_epaper_order_modify_title_name_pic"></div>
		<div id="middle_epaper_order_modify_text">
		<form name="form1" action="epaper_order_action.php" method="POST" onsubmit="return checkdata(this);">
		<center>
		<BR>
		<div >E-mail：<input type="text" name="myemail" id="myemail"></div>
		<div>訂閱狀態：我要訂閱<input type="radio" name="order_epaper_type" value="add_mail" style="position:relative;top:2px;" checked>&nbsp;取消訂閱<input type="radio" name="order_epaper_type" value="del_mail" style="position:relative;top:2px;"></div>
		<div>請輸入驗證碼：<input type="text" name="checknum" id="checknum" style="width:60px;">&nbsp;&nbsp;<a href="" id="reload-img"><img src="showrandimg.php" id="rand-img" title="看不清楚，請點我刷新" style="position:relative;top:8px;"height="30px"></a></div>
		<BR>
		<div><input type="submit" name="" value="送出">&nbsp;&nbsp;&nbsp;<input type="reset" name=""  value="重設"></div>
		<BR>
		</center>
		</form>
		</div>

			
		<div id="middle_epaper_order_modify_text_button">
		
		</div>
		</div>
		
		
		</div>
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div>

	</div>



</body></html>