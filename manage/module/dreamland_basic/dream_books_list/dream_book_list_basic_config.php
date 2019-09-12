<?php
	require_once("../dreamland_basic_config.php");
	require_once("../dreamland_basic_dbtools.inc.php");
	
	$select_sql = "SELECT * FROM $dbtable_sys_00 WHERE num_of_author >=1";
	$result = mysql_query($select_sql) or die("失敗");
	$row = MySQL_fetch_array($result);
	
	if($row == 0) 
	{
	
?>		
		<form name="myform" method="POST" action="dream_book_list_basic_config_sql_edit_del.php">
		<p>請輸入作者數：<input type="text" name="num_of_author_keyin" value=""/>
		<input type="submit" value="送出"/></p>
		</form>
<?php	
	}
	else
	{

		
		$num_of_author = mysql_result($result, 0, "num_of_author");
		MySQL_free_result($result);
		$select_sql = "SELECT code_of_author FROM $dbtable_sys_01 WHERE code_of_author >=1";
		$result = mysql_query($select_sql) or die("失敗");
		$row = MySQL_fetch_array($result);
		
		for($i=1; $i >= $num_of_author; $i++)
		{    //${'temp_banner_ad_0'.$i}
			${'code_of_author_'.$i} = mysql_result($result, $i, "code_of_author");
		    if(!${'code_of_author_'.$i} == "")
			{
			    echo "作者".$i."代碼：" .${'code_of_author_'.$i}."<input type='SUBMIT' value='修改'>";
		    }
			else
            {
			
				echo "作者".$i."代碼：<inuput type='text'value=''>";
			
			}		//判斷是否有輸入作者代碼	
		
		
		}
		
		MySQL_free_result($result);
	
	}

?>