<?php
require('config.php');
require_once("dbtools.inc.php");

// Check for a cookie, if none go to login page
session_start();

 if (!isset($_SESSION['adminuser']))
{
    //header('Location: login.php?refer='. urlencode(getenv('REQUEST_URI')));
	header('Location:../');
} 

// Try to find a match in the database
$guid = $_SESSION['adminuser'];
//$con = mysql_connect($db_host, $db_user, $db_pass);
//mysql_select_db($db_name, $con);

$query = "SELECT userid FROM root_login_ck WHERE guid = '$guid'";
echo $result = mysql_query($query);

if (!mysql_num_rows($result))
{
    // No match for guid
//header('Location: login.php?refer='. urlencode(getenv('REQUEST_URI')));
header('Location:../');

}else{
header('Location:../manage/admin_view.php');
exit();
}
?>