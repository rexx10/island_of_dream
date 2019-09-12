<?php
	require_once("../dreamland_basic_config.php");
	require_once("../dreamland_basic_dbtools.inc.php");
	
	$num_of_author_keyin = $_POST["num_of_author_keyin"];  //作者數量
	
	$insert_sql = "INSERT INTO $dbtable_sys_00 (num_of_author) VALUE('$num_of_author_keyin')";

?>