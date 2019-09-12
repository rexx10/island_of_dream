<?php
mysql_connect("$dbhost","$dbuser","$dbpasswd") or die("連接失敗");
mysql_query("SET NAMES utf8");
mysql_select_db("$dbname");
?>
