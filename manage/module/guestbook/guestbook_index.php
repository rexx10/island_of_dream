<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="./../../../images/logo2.ico">	
    <title>討論區</title>
    <script type="text/javascript">
      function check_data()
			{
        if (document.myForm.author.value.length == 0)
          alert("作者欄位不可以空白哦！");
        else if (document.myForm.subject.value.length == 0)
          alert("主題欄位不可以空白哦！");
        else if (document.myForm.content.value.length == 0)
          alert("內容欄位不可以空白哦！");
        else
          myForm.submit();
      }
    </script>		
  </head>
  <body background="../manage/pic/back.jpg" bgproperties="fixed">
    <p align="center"><img src="top.gif"></p>
    <?php
	  require_once("./guestbook_config.php");
      require_once("./guestbook_dbtools.inc.php");
	  require_once('check_session.php');
		
      //指定每頁顯示幾筆記錄
      $records_per_page = 5;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
					
      //執行 SQL 命令
      $select_sql = "SELECT id, author, subject, date FROM $dbtable_00 ORDER BY date DESC";
	  $result = mysql_query($select_sql) or die("失敗");
				
      //取得記錄數
      $total_records = mysql_num_rows($result);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result, $started_record);

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
        echo "<td bgcolor='" . $bg[$j - 1] . "'>作者：" . $row["author"] . "<br>";
        echo "主題：" . $row["subject"] . "<br>";
        echo "時間：" . $row["date"] . "<hr>";
        echo "<a href='guestbook_show_news.php?id=";
        echo $row["id"] . "'>閱讀留言及回覆</a></td></tr>";				
        $j++;
      } 
      echo "</table>" ;
			
      //產生導覽列
      echo "<p align='center'>";
			
      if ($page > 1)
        echo "<a href='./guestbook_index.php?page=". ($page - 1) . "'>上一頁</a> ";
				
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='./guestbook_index.php?page=$i'>$i</a> ";		
      }
			
      if ($page < $total_pages)
        echo "<a href='./guestbook_index.php?page=". ($page + 1) . "'>下一頁</a> ";			
				
      echo "</p>";
			
      //釋放記憶體空間
      mysql_free_result($result);
	 
    ?> 		
	
	<p align="center">
	<input type="button" value="返回管理頁面"  onclick="self.location.href='../../admin_view.php'"/>
   </p>
  </body>
</html>