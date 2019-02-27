<?php
require_once("DB.php");

$db = new DB("localhost", "root", "", "Example");

        //print_r($_GET);

if ($_SERVER['REQUEST_METHOD'] == "GET" )
{
        //print(json_encode($db->query("SELECT * FROM Registration")));
        print_r($db->query("SELECT * FROM Registration"));
}
else if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);
                $username = $postBody->Username;
                $password = $postBody->Password;
                if ($db->query("SELECT username FROM Registration WHERE username='$username'"))
                {
                        $pass = $db->query("SELECT password FROM Registration WHERE username='$username'");
                        $row = $pass['0']['password'];

                        if (password_verify($password, $row))
                        {
                                $cstrong = True;
                                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                                $token = sha1($token);
                                $user_id = $db->query("SELECT id FROM Registration WHERE username='$username'");
                                $user_id = $user_id[0]['id'];
                                $db->query("INSERT INTO login_tokens(token, user_id) VALUES ('$token', '$user_id')");
                                echo '{ "Token": "'.$token.'" }';
                        }
                        else
                        {
                                http_response_code(401);
                        }
        
        }
}
else if ($_SERVER['REQUEST_METHOD'] == "DELETE") 
{

                if (isset($_GET['token'])) 
                {
                        $token = sha1($_GET['token']);
                        if ($db->query("SELECT token FROM login_tokens WHERE token='$token'")) 
                        {
                                $db->query("DELETE FROM login_tokens WHERE token='$token'");
                                echo '{ "Status": "Success" }';
                                http_response_code(200);
                        }
                        else
                        {
                                echo '{ "Error": "Invalid token" }';
                                http_response_code(400);
                        }
                }
                else 
                {
                        echo 'token not set';
                        http_response_code(400);
                }

} 
else
{
        http_response_code(405);
}
?>