<?php
mysql_connect("$db_host","$db_user","$db_pass") or die("連接失敗");
mysql_query("SET NAMES utf8");
mysql_select_db("$db_name");
?>
