<?php
  
 //Define your host here.
 $host_name = "localhost";
  
 //Define your database name here.
 $database_name = "Example";
  
 //Define your database username here.
 $host_user = "root";
  
 //Define your database password here.
 $host_password = "";

 $connection = new mysqli($host_name, $host_user, $host_password, $database_name);

if (!$connection)
{
 	$message = 'Connection failed.';
 	echo json_encode($message);
}
?>
