<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" href="./../../../images/logo2.ico">
    <title>新聞發表</title>
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.author.value.length == 0)
          alert("作者欄位不可以空白哦！");
        else if (document.myForm.subject.value.length == 0)
          alert("主題欄位不可以空白哦！");
        else 
          myForm.submit();
      }
    </script>
  </head>
  <body background="../pic/back.jpg" bgproperties="fixed">
    

<?php 
	//<p align="center"><img src="bowwow_back.gif"></p>
    require_once("././news_config.php");
    require_once("././news_dbtools.inc.php");
	require_once('check_session.php');
	
	$id = $_GET["id"];
	$select_sql = "SELECT * FROM $dbtable_00 WHERE id = '$id'";
	$result=mysql_query($select_sql) or die("失敗");
	$author = mysql_result($result, 0, "author");
	$subject = mysql_result($result, 0, "subject");
	$content = mysql_result($result, 0, "content");
	mysql_free_result($result);

?>

<form name="myForm" method="POST" action="news_post.php">
	<input type ="hidden" Name="news_sel" value="Edit_news">
	<input type ="hidden" Name="author" value="<?php echo $author; ?>">	
	<input type ="hidden" Name="id" value="<?php echo $id; ?>">	
      <table border="0" width="800" align="center" cellspacing="0">
        <tr bgcolor="#0084CA" align="center">
          <td colspan="2">
            <font color="#FFFFFF">修改新聞內容</font></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">作者</td>
          <td width="85%"><?php echo $author; ?></td>
        </tr>
        <tr bgcolor="#84D7FF">
          <td width="15%">主題</td>
          <td width="85%"><input name="subject" value="<?php echo $subject; ?>" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">內容</td>
          <td width="85%"><textarea name="content" cols="50" rows="5"><?php echo $content; ?></textarea></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="button" value="修改" onClick="check_data()">　
            <input type="reset" value="重新輸入">
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


