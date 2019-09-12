<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
<meta name="Generator" content="Dev-PHP 1.9.4">
<title>電子報系統</title>
</head>
<body>
<?php
$epaper_mail_to=$_SESSION['user_email'];
$epaper_mail_subject="夢之鄉電子報訂閱通知";
$epaper_mail_body="親愛的訂戶，您好！\n
歡迎您訂閱 夢之鄉的電子報，這是一封電子報訂閱的通知郵件。\n
您使用的訂閱信箱是：".$epaper_mail_to."\n
夢之鄉會定期寄發電子報到您的信箱。會定期寄發電子報到您的信箱。
如果想要修改訂閱位址，或取消訂閱，請連結到下列位址：\n
http://localhost/www/epaper_order_modify_page.php\n
若有任何使用上的問題歡迎您來信詢問。\n
服務信箱：dreamland@dreamland8.com\n
期待您良性的批評與建議－夢之鄉  敬上";

mail($epaper_mail_to,$epaper_mail_subject,$epaper_mail_body);
echo "訂閱成功！";
?>
</body>
</html>
<?php session_unregister("usere_mail"); ?>
