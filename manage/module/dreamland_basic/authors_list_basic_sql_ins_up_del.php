<?php 
    require_once("./dreamland_basic_config.php");
	require_once("./dreamland_basic_dbtools.inc.php");
	require_once('check_session.php');
$authors_list_sql_type = $_POST["authors_list_sql_type"];

switch($authors_list_sql){
case "authors_list_sql_ins":
$authors_text = $_POST["authors_text"];
$inset_sql = "INSERT INTO $dbtable_00 (authors_data_type, authors_data) VALUES (1, '$authors_text')";
$result = mysql_query($inset_sql) or die("失敗");
                if(!mysql_query($result) == 1){
				
				    mysql_free_result($result);
				    //將網頁導至主選單
				    header("location:./authors_list_basic.php");
			
			    }else{
			
				    mysql_free_result($result);
					
				    //顯示無法上傳
				    echo "<script type='text/javascript'>";
				    echo "alert('新增有問題，請聯絡管理員');";
				    echo "history.back();";
				    echo "</script>";
				}

case "authors_list_sql_up":
$authors_text = $_GET["authors_text"];
$update_sql = "UPDATE $dbtable00 SET = '$authors_text' where = 1"

$result = mysql_query($update_sql) or die("失敗");
                if(!mysql_query($result) == 1){
				
				    mysql_free_result($result);
				    //將網頁導至主選單
				    header("location:./authors_list_basic.php");
			
			    }else{
			
				    mysql_free_result($result);
					
				    //顯示無法上傳
				    echo "<script type='text/javascript'>";
				    echo "alert('更新有問題，請聯絡管理員');";
				    echo "history.back();";
				    echo "</script>";
				}


case "authors_list_sql_del":
$authors_text = $_GET["authors_data_type"];
$delete_sql = "DELETE FROM $dbtable_00 WHERE authors_text = '$authors_text'";
$result = mysql_query($delete_sql) or die("失敗");
                if(!mysql_query($result) == 1){
				
				    mysql_free_result($result);
				    //將網頁導至主選單
				    header("location:./authors_list_basic.php");
			
			    }else{
			
				    mysql_free_result($result);
					
				    //顯示無法上傳
				    echo "<script type='text/javascript'>";
				    echo "alert('刪除有問題，請聯絡管理員');";
				    echo "history.back();";
				    echo "</script>";
				}
}
?>