<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
	
	//globals: $conn; 
	$hostname = "localhost"; 
	$username = "root"; 
	$password = ""; 
	$database = "skynet";
    $conn = mysqli_connect($hostname, $username, $password, $database);






#$hostname_conn = "localhost";
#$database_conn = "skynet";
#$username_conn = "root";
#$password_conn = "";
#$conn = mysqli_connect($hostname_conn,$database_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>