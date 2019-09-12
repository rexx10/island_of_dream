<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Description" content="夢之鄉，言情小說，。">
<meta name="Keywords" content="夢之鄉, 孟華, 四方宇, 湛清, 彤琤, 小說, 言情小說, 電子書"> 
  <title>夢之鄉 首頁</title>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script language="javascript" src="test_adv_auto.js" charset = "UTF-8"></script>
  <meta http-equiv="Content-Script-Type" content="text/javascript"/>
  <link rel=stylesheet type="text/css" href="./index.css">
  <link rel=stylesheet type="text/css" href="./dream_topselectbutton.css">
  <link rel=stylesheet type="text/css" href="./test_adv_auto.css">
  <link rel=stylesheet type="text/css" href="./auto_run_adv.css">
  <link rel="shortcut icon" href="./images/logo2.ico">
  <script type="text/javascript" src="./test_adv_auto.js"></script>
  <script type="text/javascript" src="./auto_run_adv.js"></script>
  <script type="text/javascript" src="./check_index.js"></script>
  <style type="text/css">
a:link {color:#000000}　　　　//宣告連結顏色
a:active {color:#000000}　　  //執行中連結顏色
a:hover {color:#000000}       //當滑鼠移到連結時連結顏色
</style>
</head>

<body>
	<div id="out">
	    <div id="top_main">
		<div id="top_highest_link"><font size="1"><BR></font></div>
		<div id="top_middle">
		<div id="top_m_left"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']); ?>"><img src="./images/logo.jpg"></a></div>
		<div id="top_m_middle"></div>
		<div id="top_m_right"></div>
		</div>
		
<?php
    require_once("config.php");
	require_once("dbtools.inc.php");
	require_once("config2_new_book.php");

	//require_once("new_book_aut_query_s.php");
	$select_sql = "SELECT filepiclink2, file_path_or_file_link FROM $dbtable_01 WHERE pic_type = '1'";  //查詢banner
	$result = mysql_query($select_sql) or die("失敗");
	$sel_sql_news_all_list = "SELECT * FROM $dbtable_news_all ORDER BY id DESC";
	$result_news_all_list = mysql_query($sel_sql_news_all_list) or die("失敗");
	$result_news_all_list_02 = mysql_query($sel_sql_news_all_list) or die("失敗");
	$sel_sql_ebook_store_list = "SELECT * FROM $dbtable_ebook_store ORDER BY ebook_store_no DESC";
	$result_ebook_store_list = mysql_query($sel_sql_ebook_store_list) or die("失敗");
	$sel_sql_ca_works_list = "SELECT * FROM $dbtable_ca_01, $dbtable_ca_02 WHERE $dbtable_ca_01.ca_works_id = $dbtable_ca_02.ca_works_id ORDER BY ca_ch_set_the_date DESC";
	$result_ca_works_list = mysql_query($sel_sql_ca_works_list) or die("失敗d");
?>

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
		<div id="middle_l_s_sale_area">
		<div id="middle_l_s_sale_area_pic">
	    <div style="padding-top:35px;margin-left:13px;margin-right:20px;">
		<?php 
		if($get_sale_type == "0"){
		    echo "<div style='padding-top:20px' align='center'><font size='3px'>".$get_rand_sale_data[0]."</font></div>";
		}elseif($get_sale_type == "1"){
		?>
		<div style="float:left;"><a href="<?php echo $get_rand_sale_data[1]; ?>"><img src="<?php echo $get_rand_sale_data[2]; ?>" title="特價專區"></a></div>
		<div style="width:30px;float:left;position: relative;left:-1px;right:-1px;line-height:15px;">
		<div style="width:95px;font-size:12px;overflow: hidden;"><font color="#87CEFA"><?php echo cut_content($get_rand_sale_data[3], 12); ?></font></div>
		<div style="width:95px;font-size:12px;padding-top:15px;overflow: hidden;margin-right:10px;"><?php echo cut_content($get_rand_sale_data[4], 53); ?></div>
		</div>
		<?php } ?>
		</div>
		
		</div>
		</div>
		<!--中間左側登入區--></div>
		<div id="middle_right">
		<div id="middle_banner_ad">
		    <!-- 橫幅廣告開始 -->
			<div id="abgneBlock">
		        <div id="player">
			        <ul class="list">
				  <?php 
				        $j = 0;						
						while($row = mysql_fetch_assoc($result) and $j <= 3){ 
						    
				            echo "<li><a target='_blank' href='".$row["file_path_or_file_link"]."'><img src='".$row["filepiclink2"]."'></a></li>";
				            $j++;
				        } ?>
			        </ul>
		        </div>
	        </div>
		    <!-- 橫幅廣告結束 -->
		</div>
		<div id="middle_middle_left">
		<div id="middle_marquee">
		<!--跑馬燈開始-->
		
		<div id="abgne_marquee">
		<div class="auto_run_adv_btn" id="auto_run_adv_btn_down"><img src="images/auto_run_adv_btn_down.jpg" /></div>
		<ul>
			<li class="b1"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']); ?>">歡迎光臨&nbsp;&nbsp;夢之鄉</a></li>
			<li class="b2"><a href="./news_main_page.php?news_id=<?php echo mysql_result($result_news_all_list, 0, "id") ?>"><?php echo mysql_result($result_news_all_list, 0, "subject"); ?></a></li>
			<li class="b3"><a href="./news_main_page.php?news_id=<?php echo mysql_result($result_news_all_list, 1, "id") ?>"><?php echo mysql_result($result_news_all_list, 1, "subject"); ?></a></li>
		</ul>
		<div class="auto_run_adv_btn" id="auto_run_adv_btn_up"><img src="images/auto_run_adv_btn_up.jpg" /></div>
	    </div>
		<!--跑馬燈結束-->
		</div>
		<div id="middle_newbook">
		<div id="middle_newbook_head"></div>
		<div id="middle_newbook_text">
		<?php if(mysql_num_rows($sel_new_book_history_result_sql)>0){ ?>
		<div id="middle_newbook_text_left">
		<div id="middle_newbook_text_2side_text">
		<a href="<?php echo $new_book_full_link_page_00; ?>">
		<div id="middle_newbook_text_left_left">
		<img src="<?php echo $new_book_imgs_00; ?>">
		</div></a></div>
		<div id="middle_newbook_text_left_right">
		<font size='3px' color='#87CEFA'><div id="middle_newbook_text_left_right_title">
		<?php echo $new_book_add_time_and_book_name_00; ?></div></font>
		<div style='word-wrap: break-word; word-break: normal;'>
		<font size="4px"><?php 
		                     if(mysql_result($sel_new_book_history_result_sql, 0, "goods_desc") != ""){
							 
							     echo cut_content(mysql_result($sel_new_book_history_result_sql, 0, "goods_desc"),70);
							 
							 }else{
							     echo "<BR>";
								 echo "<BR>";
							     echo "【暫無簡介】";
							 
							 }?></font>
		</div>
		</div>
		</div>
		<div id="middle_newbook_text_right">
		<div id="middle_newbook_text_2side_text">
		<a href="<?php echo $new_book_full_link_page_01; ?>">
		<div id="middle_newbook_text_right_left">
		<img src="<?php echo $new_book_imgs_01; ?>">
		</div></a></div>
		<div id="middle_newbook_text_right_right">
		<font size='3px' color='#87CEFA'><div id="middle_newbook_text_right_right_title">
		<?php echo $new_book_add_time_and_book_name_01; ?></div></font>
		<div style='word-wrap: break-word; word-break: normal;'>
		<font size="4px"><?php 
		                     if(mysql_result($sel_new_book_history_result_sql, 1, "goods_desc") != ""){
							 
							     echo cut_content(mysql_result($sel_new_book_history_result_sql, 1, "goods_desc"),70);
							 
							 }else{
							 
						         echo "<BR>";
								 echo "<BR>";	 
							     echo "【暫無簡介】";
							 
							 }?></font>
		</div>
		</div>
		</div><?php
		}
		else
		{
		    echo $new_book_no_data_str;
		}?>
		</div>
		</div>
		<div id="middle_middle">
		<div id="middle_hot_book">
		<div id="middle_hot_book_head"></div>
		<div id="middle_hot_book_text">
		<?php if($get_top_ten_arr[0]['short_name'] != ""){ ?>
		<div id="middle_hot_book_text_left">
		<div id="middle_hot_book_text_left_text">
		<a href="<?php echo $top_one_data_id[0]; ?>">
		<div id="middle_hot_book_text_left_top_ten_no1">
		</div>
		<div id="middle_hot_book_text_left_top_ten_no1_pic">
		<img src="<?php echo $top_one_data_img[0]; ?>">
		</div>
		</a>
		</div>
		</div>
		<div id="middle_hot_book_text_right">
        <?php 
		$j_hot_book = 0;
		while($j_hot_book <= 13){
		    if($top_one_data_id[$j_hot_book] != "")
		    {
		        echo "<a href=".$top_one_data_id[$j_hot_book]."><img src='./images/top_pic.gif' sytle='background-size:216px 135px;'>";
		        echo "<font size='2px'>".$top_one_data_name[$j_hot_book]."</font></a>";
		    }
		    $j_hot_book++;
		}
        ?></div>
		<?php
        }
		else
		{
		    echo $top_ten_no_data_str;
		} ?>
		</div>
		</div>
		<div id="middle_news">
		<div id="middle_news_head"><div style="position:relative;top:231px;text-align:right;font-size:20px;color:#DDAA00;"><a href="./news_all_list_page.php" style="color:#DDAA00;">more....</a></div></div>
		
		<div id="middle_news_text">
<?php 
			$j_news = 0;						
	    while($row = mysql_fetch_assoc($result_news_all_list_02) and $j_news <= 6){ 
						   
			echo "<div id='middle_news_text'>";
			echo "<a href='./news_main_page.php?news_id=";
			echo $row["id"]."' title='";
			echo $row["subject"]."'";
			echo " style='text-decoration:none'>";
			echo $row["subject"];
			echo "</a></div>";
		    $j_news++;
        }
        
        ?>
		</div>
		</div>
		</div>
		<div id="middle_button">
		<div id="middle_single_book">
		<div id="middle_single_book_head"></div>
<?php 
			$j_single = 0;						
			while($row = mysql_fetch_assoc($result_ca_works_list) and $j_single <= 7){ 
						   
			echo "<div id='middle_single_book_text'>";
			echo "<a href='./single_book_page.php?id=";
			echo $row["ca_chapters_list_id"]."'";
			echo "style='text-decoration:none'>";
			echo $row["ca_works_title"];
			echo "</a></div>";
		    $j_single++;
        } 
        ?>
		</div>
		<div id="middle_ebook">
		<div id="middle_ebook_head"></div>
<?php 
			$j_ebook = 0;						
			while($row = mysql_fetch_assoc($result_ebook_store_list) and $j_ebook <= 7){ 
						   
			echo "<div id='middle_ebook_store_text'>";
			echo "<a href='".$row["ebook_store_webside"]."'";
			echo "target='_new'style='text-decoration:none'>";
			echo $row["ebook_store"];
			echo "</a></div>";
		    $j_ebook++;
        } 
        ?>
		</div>
		</div>
		</div>
		
		<div id="middle_middle_right">
		<!--中間右側廣告區-->
		</div>
		
		
		
		
		</div>
		
		
		</div>
		
		<div id="botton_area">
		<?php include ("./footer.php"); ?>		
		</div>
 
	</div>
    <?php
		
		if($_SESSION["now_out_type"] == "out_login_now_ok")
		{
		    echo "<script type='text/javascript'>";
		    echo "alert('".$_SESSION["get_go_login_data"]."')";
			echo "</script>";
			unset($_SESSION['get_go_login_data']);
			unset($_SESSION['now_out_type']);	
		}
		elseif($_SESSION['now_out_type'] == "out_login_now_not")
		{
            echo "<script type='text/javascript'>";
		    echo "alert('".$_SESSION["get_go_login_data"]."')";
		    echo "</script>";
			unset($_SESSION['get_go_login__data']);
			unset($_SESSION['now_out_type']);		
		}
		?>

</body></html>

<?php
    mysql_free_result($result);
?>
