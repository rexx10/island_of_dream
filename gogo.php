<?php 
ob_start(); //打開緩衝區 
//echo "Hellon"; //輸出 
header("index.php"); //把瀏覽器重定向到index.php 
ob_end_flush();//輸出全部內容到瀏覽器 

?>