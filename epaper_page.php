<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="Description" content="多元小說，豐富生活，。">
<meta name="Keywords" content="小說, 言小說, 言情小說, 創作, 電子書"> 

  <title>夢之鄉-電子報</title>
  <script language="javascript" src="test_adv_auto.js" charset = "UTF-8"></script>
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <link rel="shortcut icon" href="./images/logo2.png">
  <link rel=stylesheet type="text/css" href="./index.css">
  <link rel=stylesheet type="text/css" href="./index_link.css">
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
		<div id="middle_epaper_title"></div>
		<div id="middle_epaper_title_name_pic"><div style="position:relative;top:25px;left:20px;font-size:20px;float:left;">期別</div><div style="position:relative;top:25px;left:250px;font-size:20px;float:left;">電子報主題</div><div style="float:right;"><a href="epaper_order_modify_page.php"><img src="./images/epaper1538412484.png"></a></div></div>
		<div id="middle_epaper_text">
		<BR>
		<!--<div style="height:20px;"></div>-->
		<?php		 		
	   
//指定每頁顯示幾筆記錄
     $records_per_page = 5;
	  
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
	  
	 $sel_sql = "SELECT * FROM $dbtable_epaper_history_list ORDER BY epaper_issue_date DESC";
	 $result = mysql_query($sel_sql) or die("失敗");
	  
	  //取得記錄數
     $total_records = mysql_num_rows($result);
	 if($total_records != "" or $total_records != 0)
	 {
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
	  
	     echo "<table width='774' align='center' cellspacing='3'>";
			
           //使用 $bg 陣列來儲存表格背景色彩
         $bg[0] = "#D9D9FF";
         $bg[1] = "#FFCAEE";
         $bg[2] = "#FFFFCC";
         $bg[3] = "#B9EEB9";
         $bg[4] = "#B9E9FF";
	  
	        //顯示記錄
         $r = 1;
	  
	     while ($row = mysql_fetch_assoc($result) and $r <= $records_per_page)
         {
?>
			 <tr><td class="epaper_list_page_td" width="8%" align="center"><?php echo "第&nbsp;".$row["epaper_id"]."&nbsp;期"; ?></td><td width="61%" class="epaper_list_page_td"><a href="./epaper_main_page.php?e_id=<?php echo $row["epaper_id"]; ?>" title="<?php echo $row["epaper_title"]; ?>" style="text-decoration:none"><?php echo $row["epaper_title"] ?></a></td><td class="epaper_list_page_td" align="center" width="8%"><font color="#BC8F8F"><?php echo $row["epaper_issue_date"]; ?></font></td></tr>
<?php			
             $r++;
         } 
         echo "</table>";
	  
	        //產生導覽列
         echo "<p align='center'>";
			
         if($page > 1)
             echo "<a href='epaper_page.php?page=". ($page - 1) . "'>上一頁</a>";
				
         for($i = 1; $i <= $total_pages; $i++)
         {
             if ($i == $page)
		     {
		
			     if($page != 1){ echo "$i";}
             }
		     else
		     {
                 echo "<a href='epaper_page.php?page=$i'>$i</a> ";		
		     }
         }
			
         if($page < $total_pages)
             echo "<a href='epaper_page.php?page=". ($page + 1) . "'>下一頁</a> ";			
				
             echo "</p>";
			
             //釋放記憶體空間
	         mysql_free_result($result);
	         //mysql_free_result($result_001);
             //mysql_free_result($result_002);
             //mysql_close($link_sql);
	 }
echo "</div>";
?>
		
		
		</div>
		
		
		</div>
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div>
 
 
 
 
 
 
	</div>



</body></html>