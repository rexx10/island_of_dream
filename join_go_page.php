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
  <!--<link href="ec/themes/shoes/style.css" rel="stylesheet" type="text/css" />-->
  <script type="text/javascript" src="js/java_talk.js"></script><script type="text/javascript" src="js/user.js"></script><script type="text/javascript" src="js/transport.js">


      <style type="text/css">
a:link {color:#000000;}　　　　/* //宣告連結顏色 */
a:active {color:#000000;}　　  /* //執行中連結顏色 */
a:hover {color:#000000;}     /*   //當滑鼠移到連結時連結顏色 */
</style>
</head>
<body>
<script type="text/javascript">
var process_request = "正在處理您的請求...";
var btn_buy = "購買";
var is_cancel = "取消";
var select_spe = "請選擇商品屬性";
</script>

   <script type="text/javascript" src="ec/js/utils.js"></script> 
  <script type="text/javascript">
  CartMenu();
  </script>
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
       // require_once("./ec/user.php");
/* 密?找回?? */
$_LANG['passwd_questions']['friend_birthday'] = '我最好朋友的生日？';
$_LANG['passwd_questions']['old_address']     = '我兒時居住地的住址？';
$_LANG['passwd_questions']['motto']           = '我的座右銘？';
$_LANG['passwd_questions']['favorite_movie']  = '我最喜愛的電影？';
$_LANG['passwd_questions']['favorite_song']   = '我最喜愛的歌曲？';
$_LANG['passwd_questions']['favorite_food']   = '我最喜愛的食物？';
$_LANG['passwd_questions']['interest']        = '我最大的愛好？';
$_LANG['passwd_questions']['favorite_novel']  = '我最喜歡的小說？';
$_LANG['passwd_questions']['favorite_equipe'] = '我最喜歡的運動隊伍？';		
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
        <div id="middle_communicate_title_name_pic">
		</div>
		<div id="middle_communicate_text">
		<?php 
		if($_GET["id"] == "get_reg_ok")
		{
	        //session_start();
			//echo $_SESSION['get_go_reg_ok_data'];
			//echo "10秒後將自動跳頁至XXX";
			$url="http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
           //將傳入需要轉換的網址建立起
			//echo $_SESSION['get_go_reg_ok_data'];
			echo "<div align='center' style='font-size:20px;font-family: 華康儷粗宋,Comic Sans MS,arial,helvetica,sans-serif;'>".$_SESSION['get_go_reg_ok_data']."</div>";
			echo "<BR><BR>";
            echo "<div align='center' style='font-size:20px;font-family: 華康儷粗宋,Comic Sans MS,arial,helvetica,sans-serif;'>五秒後自動返回首頁，或請<a href='".$url."'><font color='blue'>按此</font><a>回返回首頁</div>";
			echo "</center><BR>";
		    //unset($_SESSION['get_go_reg_ok_data']);
			/*<Script Language="JavaScript">setTimeout("location.href='<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']); ?>'",10000);</Script> */
			//利用JavaScript轉換網頁

            echo " <script type=\"text/javascript\">
               
            var t=setTimeout(\"location.href='$url'\",5000)

            </script> ";
		?>	
			
		<?php } 
		elseif($_GET["id"] == "go"){
		?>
		
		<form action="ec/user.php" method="post" name="formUser_Reg" onsubmit="return register();">
      <table width="100%"  border="0"  cellpadding="5" cellspacing="3">
        <tr>
          <td width="40%" align="right">會員名稱</td>
          <td width="60%" align="left">
          <input name="username" type="text" size="25" id="username" onblur="is_registered(this.value);" class="InputBorder"/>
            <span id="username_notice" style="color:#FF0000"> *</span>
          </td>
        </tr>
        <tr>
          <td align="right">Email</td>
          <td>
          <input name="email" type="text" size="25" id="email" onblur="checkEmail(this.value);"  class="InputBorder"/>
            <span id="email_notice" style="color:#FF0000"> *</span>
          </td>
        </tr>
        <tr>
          <td align="right">密碼</td>
          <td>
          <input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" class="InputBorder" style="width:179px;" />
            <span style="color:#FF0000" id="password_notice"> *</span>
          </td>
        </tr>
        <tr>
          <td align="right">密碼強度</td>
          <td>
            <table width="145" border="0" cellspacing="0" cellpadding="1">
              <tr align="center">
                <td width="33%" id="pwd_lower_go">弱</td>
                <td width="33%" id="pwd_middle_go">中</td>
                <td width="33%" id="pwd_high_go">強</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="right">確認密碼</td>
          <td>
          <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);"  class="InputBorder" style="width:179px;"/>
            <span style="color:#FF0000" id="conform_password_notice"> *</span>
          </td>
        </tr>
        	        <tr>
          <td align="right" >skype          <td>
          <input name="extend_field1" type="text" size="25" class="InputBorder" />          </td>
        </tr>
			        <tr>
          <td align="right" id="extend_field4i">電話          <td>
          <input name="extend_field4" type="text" size="25" class="InputBorder" /><span style="color:#FF0000"> *</span>          </td>
        </tr>
			        <tr>
          <td align="right" id="extend_field5i">手機          <td>
          <input name="extend_field5" type="text" size="25" class="InputBorder" /><span style="color:#FF0000"> *</span>          </td>
        </tr>
			        <tr>
          <td align="right">密碼提示問題</td>
          <td>
          <select name='sel_question' class="InputBorder">
		  <option value='0'>請選擇密碼提示問題</option>
		  <?php foreach($_LANG['passwd_questions'] as $value){ ?>
		<option value="<?php echo array_search($value, $_LANG['passwd_questions']); ?>"><?php echo $value; ?></option>                                                       <?php } ?>
		</select>
          </td>
        </tr>
        <tr>
          <td align="right" id="passwd_quesetion">密碼問題答案</td>
          <td>
	  <input name="passwd_answer" type="text" size="25" class="InputBorder" maxlengt='20'/><span style="color:#FF0000"> *</span>          </td>
        </tr>
		              <tr>
          <td>&nbsp;</td>
          <td><label>
            <input name="agreement" type="checkbox" value="1" checked="checked" />
            我已看過並接受《<a href="ec/article.php?cat_id=-1" style="color:blue" target="_blank">會員協議</a>》</label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="left">
          <input name="act" type="hidden" value="act_register" >
		  <input name="now_type" type="hidden" value="out_register">
          <input type="hidden" name="back_act" value="" />
         <input name="Submit" type="submit" value="" class="bnt_go_reg">
		 <div><font color="red" size="5px" style="position:relative;top:6px;">*</font><font color="#666666">為必要填寫項目</font></div>
          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td class="actionSub">
          <a href="login_page.php?id=go" class="txtdot">我已有帳號，我要登入</a><br />
          </td>
        </tr>
      </table>
    </form>
	<?php }elseif(empty($_GET["id"]) or $_GET["id"] != "go" or $_GET["id"] = "get_reg_ok"){
	
			//echo $_SESSION['get_go_reg_ok_data'];
			//echo "10秒後將自動跳頁至XXX";
			$url="http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
           //將傳入需要轉換的網址建立起
			//echo $_SESSION['get_go_reg_ok_data'];
			echo "<div align='center' style='font-size:20px;font-family:華康儷粗宋,Comic Sans MS,arial,helvetica,sans-serif;'>請遵守規則，謝謝</div>";
			echo "<BR><BR>";
            echo "<div align='center' style='font-size:20px;font-family:華康儷粗宋,Comic Sans MS,arial,helvetica,sans-serif;'>五秒後自動返回首頁，或請<a href='".$url."'><font color='blue'>按此</font><a>回返回首頁</div>";
			echo "</center><BR>";
		    unset($_SESSION['get_go_reg_ok_data']);
			/*<Script Language="JavaScript">setTimeout("location.href='<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']); ?>'",10000);</Script> */
			//利用JavaScript轉換網頁

            echo " <script type=\"text/javascript\">
               
            var t=setTimeout(\"location.href='$url'\",5000)

            </script> ";
	 } ?>
		</div>		
		<div id="middle_communicate_text_button">
		
		</div>
		</div>
		
		
		</div>
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div>

	</div>



</body>
</html>