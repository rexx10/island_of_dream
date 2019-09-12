
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>夢之鄉 管理頁面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./../../../images/logo2.ico">
	<link rel=stylesheet type="text/css" href="./admin_view_css.css">

	</HEAD>	
	<BODY background="./pic/back.jpg" bgproperties="fixed">
	<form>

	<center>
	<font size="7" color="red">系統選單</font><HR><BR><BR>
	 <!--<H3>歡迎&nbsp;&nbsp;<font color="red" size="15"><I><B><?php echo $admin_ID; ?></B></I></font>&nbsp;&nbsp;登入<BR>-->
			<!--<input type="button" Name="P01" value="    作      者      彷    " onclick="location.href='./module/news/news_index.php'"/><BR>-->
			<a href="./module/dreamland_basic/authors_group_list.php" class="css_btn_class"><font size="6">作者坊設定區</font></a><BR>
			<!--<input type="button" Name="P01" value="  夢 文 館 修 改 區  " onclick="location.href='./module/dreamland_basic/authors_book_list.php'"/><BR>-->
			<a href="./module/dreamland_basic/authors_book_list.php" class="css_btn_class"><font size="6">夢文館設定區</font></a><BR>
			<!--<input type="button" Name="P01" value="發報新聞區" onclick="location.href='./module/news/news_index.php'"/><BR>-->
		    <a href="./module/news/news_index.php" class="css_btn_class"><font size="6">設定最新訊息區</font></a><BR>
			<!--<input type="button" Name="P01" value="設定橫幅廣告區" onclick="location.href='./module/banner_ad/banner_ad_index.php'"/><BR>-->
		    <a href="./module/banner_ad/banner_ad_index.php" class="css_btn_class"><font size="6">設定橫幅作者網頁區</font></a><BR>
			<!--<input type="button" Name="P01" value="回覆留言區" onclick="location.href='./module/guestbook/guestbook_index.php'"/><BR>-->
			<a href="./module/guestbook/guestbook_index.php" class="css_btn_class"><font size="6">交流園地回覆區</font></a><BR>
			<!--<input type="button" Name="P01" value="電子報發報區" onclick="location.href='./module/epaper/epaper_list.php'"/><BR>-->
			<a href="./module/epaper/epaper_list.php" class="css_btn_class"><font size="6">設定電子報區</font></a><BR>
			<a href="./module/creation_article/creation_article_index.php" class="css_btn_class"><font size="6">連載文章設定區</font></a><BR>
			<a href="./module/ebook_store/ebook_store_index.php" class="css_btn_class"><font size="6">電子書廠商設定區</a><BR>
			<a href="module/ad_webside_link/ad_webside_link_index.php" class="css_btn_class"><font size="6">側攔廣告友站設定區</font></a><BR>
			
	</center>
		

		
		
		</form>
	</BODY>
</HTML>