<?php
require_once("DB.php");

$db = new DB("localhost", "root", "", "Example");

	//print_r($_GET);

	if ($_SERVER['REQUEST_METHOD'] == "GET" )
	{
		//print(json_encode($db->query("SELECT * FROM Registration")));
		print_r($db->query("SELECT * FROM Registration"));
	}
	else if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		print_r($postBody);

		$username = $postBody->Username;
        $password = $postBody->Password;

        //print_r($username);

        if ($db->query("SELECT username FROM Registration WHERE username=:username", array(':username'=>$username)))
        	{
        		//print_r($password);

        		$pass = $db->query("SELECT password FROM Registration WHERE username='$username'");
        		$row = $pass['0']['password'];

        		//print_r($row);

                        if (password_verify($password, $row ))
                        {
                        	print("Matched");
                        }
                        else
                        {
                        	print("Invalid");
                        }
            }

        //print_r($username);
	}
	else
	{
		echo "Hello";
	}
?>