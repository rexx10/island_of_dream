<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="Description" content="多元小說，豐富生活，。">
<meta name="Keywords" content="小說, 言小說, 言情小說, 創作, 電子書"> 

  <title>夢之鄉-夢文館</title>
  <script language="javascript" src="test_adv_auto.js" charset = "UTF-8"></script>
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <link rel="shortcut icon" href="./images/logo2.png">  
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
		<div id="middle_dream_books_title"></div>
		<div id="middle_dream_books_text">
		<?php 

            //指定每頁顯示幾筆記錄
      $records_per_page = 5;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
					
      //執行 SQL 命令
      $sel_sql = "SELECT * FROM $dbtable_author_book_personal_list WHERE author_code = '".mysql_real_escape_string($_GET["ac"])."' ORDER BY book_name_code ASC";
	  $result = mysql_query($sel_sql) or die("失敗");
	  $sel_sql_2 = "SELECT * FROM $dbtable_author_book_image WHERE author_code = '".mysql_real_escape_string($_GET["ac"])."'";
	  $result_2 = mysql_query($sel_sql_2) or die("失敗");
      //取得記錄數
      $total_records = mysql_num_rows($result);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result, $started_record);
	  echo "<tr><center><font face='華康儷粗宋' color='#800080' size='70'>".$_GET["an"]."─夢之鄉作品集</font></center></tr><BR><BR>";
      echo "<center><img src='".mysql_result($result_2, 0, "author_banner_img_path")."'></center><BR>";
      echo "<table width='800' align='center' cellspacing='3'>";
			
      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";					
	  
      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page)
      {

        echo "<tr>";
	    echo "<td width='15%'><font size='3'>";
		echo $row["book_name_code"];
		echo "</font></td>";
        echo "<td width='25%'><img src='".$row["author_book_front_cover_path"]."' width='100' height='166'><br>";
        echo "出書日：".$row["publication_date_y"]."年".$row["publication_date_m"]."月";
		if($row["publication_date_d"] != "") echo $row["publication_date_d"]."日";
		echo "<br>";
		if($row["book_cover_fig_aut"] != "") echo "封面繪圖：".$row["book_cover_fig_aut"]."<BR>";
        echo "第一章試閱：<a href='authors_list_page_main_text.php?ac=".$row["author_code"]."&bnc=".$row["book_name_code"]."' target='_blank'><img src='./images/author_01.gif' title='點我試閱' width='40' height='40'></a>";
        echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td width='60%' style='border-bottom-style:dotted; text-align: justify; text-justify:inter-ideograph;'>";
		echo "<p style='font-size:15px;'}>".$row["book_preface"]."</p>";
		echo "</td>";
		echo "</tr>";
        	
        $j++;
      } 
      echo "</table>" ;
			
      //產生導覽列
      echo "<p align='center'>";
			
      if ($page > 1)
        echo "<a href='./authors_list_page_main.php?ac=".$_GET["ac"]."&an=".$_GET["an"]."&page=". ($page - 1) . "'>上一頁</a> ";
				
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='./authors_list_page_main.php?ac=".$_GET["ac"]."&an=".$_GET["an"]."&page=".$i."'>&nbsp;".$i."</a>";		
      }
			
      if ($page < $total_pages)
        echo "<a href='./authors_list_page_main.php?ac=".$_GET["ac"]."&an=".$_GET["an"]."&page=". ($page + 1) . "'>下一頁</a> ";			
				
      echo "</p>";
			
      //釋放記憶體空間
      mysql_free_result($result);
		mysql_free_result($result_2);	
		?>
		
		
		</div>
		
		
		
		
		
		
		</div>
		
		
		</div>
		
		<div id="botton_area">
        <?php include ("./footer.php"); ?>	
		</div> 
 
	</div>
</body></html>