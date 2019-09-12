<?php
    require_once("././news_config.php");
    require_once("././news_dbtools.inc.php");
	require_once('check_session.php');

    $id = $_POST["id"];
    $author = $_POST["author"];    
	$sub_title = $_POST["sel_sub_title"];
	$subject = $sub_title.$_POST["subject"];
    $content = $_POST["content"];
    $current_time = date("Y-m-d");

    if ($_GET["news_sel"] == ''){
      
	   $news_sel = $_POST["news_sel"];
  
   }else{
  
       $news_sel = $_GET["news_sel"];
  
   }

    switch ($news_sel){
	    case "News_post":
		
            $sql = "INSERT INTO $dbtable_00(author, subject, content, date) 
			VALUES('$author', '$subject', '$content', '$current_time')";
		
        break;
		
		case "Edit_news":

            $id = $_POST["id"];
	        $sql = "UPDATE $dbtable_00 SET author = '$author', subject = '$subject', 
			       content = '$content', date = '$current_time' 
				   WHERE id = '$id'";

        break;

		case "Del_news":

            $id = $_GET["id"];
	        $sql = "DELETE FROM $dbtable_00 WHERE id = '$id'";

        break;

	}

    $result=mysql_query($sql) or die("失敗");

	//釋放 $result 佔用的記憶體空間
    mysql_free_result($result);

    //將網頁重新導向到 index.php
	header("location:news_index.php");
	exit(); 
?>