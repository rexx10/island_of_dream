<?php
//嵌入 config,php 及 dbtools.inc.php
    require_once("epaper_config.php"); //引入參數設定
    require_once("epaper_dbtools.inc.php"); //引入資料庫設定檔
	require_once("../epaper/check_session.php");
	
$query_epaper_men="SELECT order_mail FROM $dbtable_01";
$epaper_men=mysql_query($query_epaper_men) or die("失敗");

$get_id=$_GET['epaper_id'];
$query_epaper_data="SELECT epaper_title,epaper_content FROM $dbtable_00
                  WHERE epaper_id=$get_id";
$epaper_data=mysql_query($query_epaper_data) or die("失敗");
$row_epaper_data=mysql_fetch_assoc($epaper_data);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- mail 部分的 UTF-8 需再研究一下 -->
<!--<meta name="Generator" content="Dev-PHP 1.9.4">-->
		<link rel="shortcut icon" href="./../../../images/logo2.ico">
<title>電子報系統</title>
</head>
<body>
<?php
echo $epaper_total=0;
while($row_email=mysql_fetch_assoc($epaper_men)){
$epaper_to=$row_email['order_mail'];
$epaper_subject=$row_epaper_data['epaper_title'];
$epaper_body=$row_epaper_data['epaper_content'];
$epaper_msg="<BR> \n\n\n  夢之鄉 敬上";
$epaper_headers="Content-Type: text/html; charset=UTF-8";
mail($epaper_to,$epaper_subject,$epaper_body.$epaper_msg,$epaper_headers);
$epaper_total=$epaper_total+1;
echo "已送出第 $epaper_total 封郵件"."<br>";
}
echo "所有郵件已發送完畢，共送出 $epaper_total 封郵件";
?>
</body>
</html>
