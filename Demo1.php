<?php
require_once("DB.php");

 
 //Define your host here.
 $host_name = "localhost";
  
 //Define your database name here.
 $database_name = "Example";
  
 //Define your database username here.
 $host_user = "root";
  
 //Define your database password here.
 $host_password = "";

$db = new DB($host_name, $host_user, $host_password, $database_name);

	if ($_SERVER['REQUEST_METHOD'] == "GET" )
	{
		print_r($db->query("SELECT * FROM `Registration`"));
	}
	else if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		echo "Post";
	}
	else
	{
		echo "Hello";
	}
?>