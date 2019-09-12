<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" href="./../../../images/logo2.ico">	
    <title>留言板</title>
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.author.value.length == 0)
          alert("作者欄位不可以空白哦！");
        //else if (document.myForm.subject.value.length == 0)
          //alert("主題欄位不可以空白哦！");
        else
          myForm.submit();
      }
    </script>			
  </head>
  <body background="../manage/pic/back.jpg" bgproperties="fixed">
    
    <?php	
	//<center><img src="fig1.jpg"></center>
	  require_once("./guestbook_config.php");
      require_once("./guestbook_dbtools.inc.php");
	  require_once('check_session.php');
			
      //取得要顯示之記錄
      $id = $_GET["id"];
				
      //建立資料連接
      //$link_sql = create_sql_connection();
			
      //執行 SQL 命令
      $select_sql = "SELECT * FROM $dbtable_00 WHERE id = $id";
      //$result = execute_sql("mysexbook", $sql, $link_sql);
	  $result=mysql_query($select_sql) or die("失敗");
	  			
      echo "<table width='800' align='center' cellpadding='3'>";
      echo "<tr height='40'><td colspan='2' align='center'
            bgcolor='#663333'><font color='white'>
            <b>留言主題</b></font></td></tr>";	 
						  
      //顯示原討論主題的內容
      while ($row = mysql_fetch_assoc($result))
      {
        echo "<tr>";
        echo "<td bgcolor='#CCFFCC'>主題：" . $row["subject"] . "　";
        echo "作者：" . $row["author"] . "　";
        echo "時間：" . $row["date"] . "</td></tr>";				
        echo "<tr height='40'><td bgcolor='CCFFFF'>";
        echo $row["content"] . "</td></tr>";
      }
			
      echo "</table>";		
	 $view_subject = mysql_result($result, 0,"subject");
      //釋放 $result 佔用的記憶體空間
      mysql_free_result($result);

      //執行 SQL 命令
      $select_sql = "SELECT * FROM $dbtable_01 WHERE reply_message_reply_id = $id";
      //$result = execute_sql("mysexbook", $sql, $link_sql);
	  $result=mysql_query($select_sql) or die("失敗");
	  
			
      if (mysql_num_rows($result) <> 0)
      {
        echo "<hr>";
        echo "<table width='800' align='center' cellpadding='3'>";
        echo "<tr height='40'><td colspan='2' align='center'
              bgcolor='#99CCFF'><font color='#FF3366'>
              <b>回覆留言主題</b></font></td></tr>";
							 
        //顯示回覆主題的內容
		
        while ($row = mysql_fetch_assoc($result))
        {
		  
          echo "<tr>";
          //echo "<td bgcolor='#FFFF99'>主題：" . $row["reply_message_subject"] . "　";
		 
          echo "<td bgcolor='#FFFF99'>作者：<span";
		  if($row["admin_mode"] == "Y") echo " style='color:#FF0000'";
          echo ">".$row["reply_message_author"]."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          echo "時間：" . $row["reply_message_date"] . "</td></tr>";				
          echo "<tr><td bgcolor='CCFFFF'><span";
		  if($row["admin_mode"] == "Y") echo " style='color:#FF0000'";
          echo ">".$row["reply_message_content"] . "</span></td></tr>";
		  
        }
				
        echo "</table>";			
      }

      //釋放記憶體空間
      mysql_free_result($result);				
      //mysql_close($link_sql);					
    ?>
    <hr>
    <form name="myForm" method="post" action="guestbook_post_reply.php">
      <input type="hidden" name="reply_id" value="<?php echo "$id"; ?>">
	  <input type="hidden" name="subject" value="<?php echo "$view_subject"; ?>">
      <table border="0" width="800" align="center" cellspacing="0">
        <tr bgcolor="#0084CA" align="center">
          <td colspan="2"><font color="white">請在此輸入您的回覆</font></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">作者</td>
          <td width="85%"><input name="author" type="text" value="" size="50"></td>
        </tr>
       
        <tr bgcolor="#D9F2FF">
          <td width="15%">內容</td>
          <td width="85%"><textarea name="content" cols="30" rows="5"></textarea></td>
        </tr>
        <tr>
          <td colspan="2" height="40" align="center">
            <input type="button" value="回覆討論" onClick="check_data()">   
            <input type="reset" value="重新輸入">
			<input type="button" value="返回回覆討論區" onclick="location.href='./guestbook_index.php'"/>
			<input type="button" value="返回管理頁面" onclick="self.location.href='../../admin_view.php'"/>
          </td>
        </tr>  
      </table>                   
    </form>
  </body>                                                                                 
</html>



<?php
include_once "ckeditor/ckeditor.php";
$CKEditor = new CKEditor();
$CKEditor->basePath = 'ckeditor/';
$CKEditor->replace("content");
?>