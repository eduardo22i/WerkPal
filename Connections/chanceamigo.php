<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"


$hostname_chanceamigo = "68.178.138.182";
$database_chanceamigo = "palenterprises";
$username_chanceamigo = "palenterprises";
$password_chanceamigo = "unPato1!";
$chanceamigo = mysql_pconnect($hostname_chanceamigo, $username_chanceamigo, $password_chanceamigo) or trigger_error(mysql_error(),E_USER_ERROR); 

/*
$hostname_chanceamigo = "localhost";
$database_chanceamigo = "Hack";
$username_chanceamigo = "root";
$password_chanceamigo = "root";
$chanceamigo = mysql_pconnect($hostname_chanceamigo, $username_chanceamigo, $password_chanceamigo) or trigger_error(mysql_error(),E_USER_ERROR); 
*/

?>