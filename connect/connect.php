<?php
function connectdb()
{
$hostname_school = "localhost";
$database_school = "HMIS";
$username_school = "root";
$password_school = "";

$conn=mysql_connect($hostname_school,$username_school,$password_school);
$db=mysql_select_db($database_school);
#echo "connected";
}
?>