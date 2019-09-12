<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="Description" content="夢之鄉，言情小說，。">
<meta name="Keywords" content="夢之鄉, 孟華, 四方宇, 湛清, 彤琤, 小說, 言情小說, 電子書"> 

  <title>夢之鄉-新書特報</title>
  <script language="javascript" src="test_adv_auto.js" charset = "UTF-8"></script>
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <link rel="shortcut icon" href="./images/logo2.ico">
  <link rel=stylesheet type="text/css" href="./index.css">
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
		<?php 
		require_once("config.php");
	    require_once("dbtools.inc.php");
		require_once("config2_new_book.php");
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
		<!--<div id="middle_l_s_sale_area">
		<div id="middle_l_s_sale_area_pic"></div>
		</div>-->
		<!--中間左側登入區--></div>
		<div id="middle_right">
		<div id="middle_new_book_title">
		<?php 		
		function rexx10_my_search_str($my_search_point_str,$my_default_str, $my_search_num, $my_search_full_str)
	    {
	        $code = $my_search_point_str;
		    $input = $my_search_full_str;
		    if(false != ($rst = strpos($input, $my_default_str)))
		    {
		        echo $num_str = "";
		    }
		    else
		    {
	            $len=strlen($code);
		        //$len_input = strlen($my_search_str_full_path);
		        $pos1=strpos($input,$code);
		        echo $num_str=substr($input,-($len+10),$pos1);
		    }
	    }
		$records_per_page = 7;
	  
	    //取得要顯示第幾頁的記錄
        if (isset($_GET["page"]))
	    {
		    if(!is_numeric(mysql_real_escape_string($_GET["page"]))){;
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
		  
		   }
            $page = $_GET["page"];
        }
	    else
	    {
            $page = 1;
	    }
		
		
		
		$sel_sql = "SELECT * FROM ecs_goods WHERE (cat_id = '".mysql_real_escape_string($cat_id_result[0])."' OR 
                                                            cat_id = '".mysql_real_escape_string($cat_id_result[1])."' OR 
														    cat_id = '".mysql_real_escape_string($cat_id_result[2])."' OR 
														    cat_id = '".mysql_real_escape_string($cat_id_result[3])."') AND
														    is_on_sale = 1 ORDER BY add_time DESC";
															
        $result = mysql_query($sel_sql) or die("失敗");
		
		$total_records = mysql_num_rows($result);
			?></div>		
		<div id="middle_new_book_text">
		
		<?php 
		if($total_records != "" or $total_records != 0)
	    {
	        //echo "<BR><BR>";
	              //計算總頁數
            $total_pages = ceil($total_records / $records_per_page);
	  
	           //計算本頁第一筆記錄的序號
            $std_record = $records_per_page * ($page - 1);
	  
	        //將記錄指標移至本頁第一筆記錄的序號
			if(!mysql_data_seek($result, $std_record)){
			
			  mysql_free_result($result);
              //將網頁重新導向
			  $tmp_index = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['PHP_SELF']);
              header("location:$tmp_index");
              exit();
			
			}
            mysql_data_seek($result, $std_record);
	        
	        //echo "<table width='600'  cellspacing='3'>";
			
           //使用 $bg 陣列來儲存表格背景色彩
            /* $bg[0] = "#D9D9FF";
            $bg[1] = "#FFCAEE";
            $bg[2] = "#FFFFCC";
            $bg[3] = "#B9EEB9";
            $bg[4] = "#B9E9FF"; */
	  
	        //顯示記錄
		$count_r = 1; 
		while($row = mysql_fetch_assoc($result) and $count_r <= $records_per_page){ 
		    $count_i = 1;
		    while($count_i <=12){
	            $sel_sql = "SELECT * FROM ecs_goods_attr WHERE goods_id = '".mysql_real_escape_string($row["goods_id"])."' AND attr_id = '".mysql_real_escape_string($count_i)."'";
		        $result_01 = mysql_query($sel_sql) or die("失敗");
		        if(mysql_num_rows($result_01) != ""){
		            $attr_data_[$count_i] = mysql_result($result_01, 0, "attr_value");
		        }
		    $count_i++;
		    }
			
			
		if($attr_data_[1] == ""){
		
		    //mysql_result($result, 0, "cat_id")
			$sel_author_name_sql = "SELECT cat_name FROM ecs_category WHERE cat_id =".$row["cat_id"];
			$result_author_name_sql = mysql_query($sel_author_name_sql) or die("失敗");
		    $tmp_my_author_name_all = mysql_result($result_author_name_sql, 0, "cat_name");
		    $tmp_my_author_name = substr($tmp_my_author_name_all,0, 2*3);
		   //echo iconv("utf-8","big5", $tmp_my_author_name);
		}			
		?>
		
		<div id="middle_new_book_text_top">
		
        <div id="middle_new_book_text_top_left_pic" style="float:left;position:relative;top:-40px;left:10px;">
		<a href="./new_books_main_page.php?id=<?php echo $row["goods_id"]; ?>" >
		<img src="./ec/<?php echo $row["goods_img"]; ?>" width="184px" height="184px">
		</a>
		</div>
		<div id="middle_new_book_text_top_right_text">
		<div>書名：<a href="./new_books_main_page.php?id=<?php echo $row["goods_id"]; ?>"><?php echo $row["goods_name"]; ?></a></div>
		<?php
		if($attr_data_[1] != ""){
		    echo "<div>作者：".$attr_data_[1]."</div>";
		}else{
		
		    echo "<div>作者：".$tmp_my_author_name."</div>";
		
		}
		if($attr_data_[4] != ""){
		    echo "<div>出版日期：".$attr_data_[4]."</div>";
		}		
		?>
		<div>定價：<?php rexx10_my_search_str(".", "default", -10, $row["market_price"]); ?>&nbsp;元</div>
		<div>售價：<font color="red"><?php rexx10_my_search_str(".", "default", -10, $row["shop_price"]); ?></font>&nbsp;元</div>
		<div>貨號：<?php echo $row["goods_sn"]; ?></div>
		</div>
		</div>
		<div id="middle_new_book_text_line"></div>
		<?php
             $count_r++;
         } 
          
	        //產生導覽列
         echo "<p align='center'>";
			
         if($page > 1)
             echo "<a href='new_books_list_page.php?page=". ($page - 1) . "'>上一頁</a>";
				
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "$i";}
             }
		     else
		     {
                 echo "<a href='new_books_list_page.php?page=$i'>$i</a> ";		
		     }
         }
			
         if($page < $total_pages)
             echo "<a href='new_books_list_page.php?page=". ($page + 1) . "'>下一頁</a> ";			
				
             echo "</p>";
			
             //釋放記憶體空間
	         mysql_free_result($result);
	         mysql_free_result($result_01);
             //mysql_free_result($result_002);
             //mysql_close($link_sql);
	 }
?>
		</div>
			
		</div>
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div>
 
 
 
 
 
 
	</div>



</body></html>