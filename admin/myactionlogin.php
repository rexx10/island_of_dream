<?php
require('config.php');
require_once("dbtools.inc.php");
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$refer = mysql_real_escape_string($_POST['refer']);

if ($username == '' || $password == '')
{
    // No login information
    //header('Location: index.php?refer='. urlencode($_POST['refer']));
	header('Location:../');
}
else
{
    // Authenticate user
    //$con = mysql_connect($db_host, $db_user, $db_pass);
    //mysql_select_db($db_name, $con);
    
    $query = "SELECT userid, MD5(UNIX_TIMESTAMP() + userid + RAND(UNIX_TIMESTAMP()))guid  FROM root_login_ck WHERE admin_name = '$username' AND password = md5('$password')";
        
    $result = mysql_query($query) or die ('Error in query');
    //echo mysql_num_rows($result);
    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_row($result);
        // Update the user record
        $query = "UPDATE root_login_ck SET guid = '$row[1]' WHERE userid = $row[0]";
            
        mysql_query($query) or die ('Error in query');
        
        // Set the cookie and redirect
        // setcookie( string name [, string value [, int expire [, string path
        // [, string domain [, bool secure]]]]])
        // Setting cookie expire date, 6 hours from now
        //$cookieexpiry = (time() + 1200);  //只要在20分鐘內回網頁都不需要輸入帳密
		//echo $row[1];
        //setcookie("my_session_id", $row[1], $cookieexpiry);
		session_start();
        $_SESSION['adminuser'] = $row[1];
		
        /* if (empty($refer) || !$refer)
        { */
        header('Location:../manage/admin_view.php');
        /* }

        header('Location: '. $refer); */
    }
    else
    {
        // Not authenticated
        //header('Location: index.php?refer='. urlencode($refer));
		echo "<script type='text/javascript'>";
		    echo "alert('帳號或密碼錯誤，請再試一次!!')";
			echo "</script>";
		header('Location:index.php');
    }
}
?>