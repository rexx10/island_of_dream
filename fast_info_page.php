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
		</div-->
		<!--中間左側登入區--></div>
		<div id="middle_right">
		<div id="middle_fast_info_title">
		<?php 

		function rexx10_my_search_str($my_search_point_str,$my_default_str, $my_search_num, $my_search_full_str)
	    {
	        $code = $my_search_point_str;
		    $input = $my_search_full_str;
		    if(false != ($rst = strpos($input, $my_default_str))){
		        
				echo $num_str = "";
				
		    }else{
			
	            $len=strlen($code);
		        //$len_input = strlen($my_search_str_full_path);
		        $pos1=strpos($input,$code);
		        echo $num_str=substr($input,-($len+10),$pos1);
				
		    }
	    }
		
		$sel_sql = "SELECT * FROM ecs_goods WHERE goods_id = '".mysql_real_escape_string($_GET["id"])."'";
		$result = mysql_query($sel_sql) or die("失敗");
		
		if(mysql_result($result, 0, "goods_id") == "" or  !is_numeric(mysql_real_escape_string($_GET["id"]))){
		
		      mysql_free_result($result);
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
		
		}			
		
		$i_attr = 1;
		while($i_attr <=12){
	    $sel_sql = "SELECT * FROM ecs_goods_attr WHERE goods_id = '".mysql_real_escape_string($_GET["id"])."' AND attr_id = '".mysql_real_escape_string($i_attr)."'";
		$result_01 = mysql_query($sel_sql) or die("失敗");
		if(mysql_num_rows($result_01) != ""){
		$attr_data_[$i_attr] = mysql_result($result_01, 0, "attr_value");
		}
		$i_attr++;
		}
	    ?>
		</div>
        <div id="middle_fast_info_title_name_pic"></div>
		<div id="midlle_fast_info_text">
		<div id="midlle_fast_info_text_top">
		<div id="midlle_fast_info_text_top_left_text">
		<table Border="0" CellSpacing="0" CellPadding="0" style="border-collapse:collapse; ">
		<tr><div style="font-weight:bold;">書名：<a href="<?php echo "ec/goods.php?id=".mysql_result($result, 0, "goods_id"); ?>"><?php echo mysql_result($result, 0, "goods_name"); ?></a></div><tr>
		<tr><div>貨號：<?php echo mysql_result($result, 0, "goods_sn"); ?></div><tr>
		<?php if(isset($attr_data_[1])){ ?><tr><div>作者：<?php echo $attr_data_[1]; ?></div><tr><?php } ?>
		<?php if(isset($attr_data_[4])){ ?><tr><div>出版日期：<?php echo $attr_data_[4]; ?></div><tr><?php } ?>
		<?php if(isset($attr_data_[2])){ ?><tr><div>出版社：<?php echo $attr_data_[2]; ?></div><tr><?php } ?>
		<?php if(isset($attr_data_[7])){ ?><tr><div>裝訂：<?php echo $attr_data_[7]; ?></div><tr><?php } ?>
		<?php if(isset($attr_data_[5])){ ?><tr><div>開本：<?php echo $attr_data_[5]; ?></div><tr><?php } ?>
		<tr><div>定價：<?php rexx10_my_search_str(".", "default", -10, mysql_result($result, 0, "market_price")); ?>&nbsp;元</div><tr>
		<tr><div>售價：<font color="red"><?php rexx10_my_search_str(".", "default", -10, mysql_result($result, 0, "shop_price")); ?></font>&nbsp;元</div><tr>
		<?php if(isset($attr_data_[6])){ ?><tr><tr><div>頁數：<?php echo $attr_data_[6]; ?>&nbsp;頁</div><tr><?php } ?>
		<?php if(isset($attr_data_[8])){ ?><tr><div>規格：<?php echo $attr_data_[8]; ?></div><tr><?php } ?>
		<?php if(isset($attr_data_[3])){ ?><div>ISBN：<?php echo $attr_data_[3]; ?></div><tr><?php } ?>
		</table>
		</div>
		<div id="midlle_fast_info_text_top_right">
		<?php if(mysql_result($result, 0, "original_img") != ""){ ?>
		<div id="midlle_fast_info_text_top_right_insite">
		<?php }?>
		<a href="<?php echo "ec/goods.php?id=".mysql_result($result, 0, "goods_id"); ?>" title="點我進入商場">
		<?php if(mysql_result($result, 0, "original_img") != ""){ ?>
		<img src="<?php echo "./ec/".mysql_result($result, 0, "original_img"); ?>" width="208" height="346">
		<?php }
		else
		{ ?>
		<div id="midlle_fast_info_text_top_right_insite_pic">
		<img src="./ec/images/no_picture.gif">
		<?php } ?>
		</a>
		</div>
		</div>
		</div>
		<div id="midlle_fast_info_text_midline">
		</div>
		<div id="midlle_fast_info_text_below">
		<div>內容簡介：</div>
		<?php 
		    if(mysql_result($result, 0, "goods_desc") != ""){
			
			    echo mysql_result($result, 0, "goods_desc"); 
			 
			}else{
			
				echo "<div>目前暫無內容簡介</div>";
				echo "<BR>";
			
			}
		?>
		</div>
		</div>
		<div id="middle_fast_info_text_button"></div>
		</div>
		
		
		
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div>

	</div>



</body></html>