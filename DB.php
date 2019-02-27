<?php
//include 'config_file.php';
//header("Content-type:application/json");
//$message = '';

class DB
{
	private $conn;

	public function __construct($host_name, $host_user, $host_password, $database_name)
	{
 		$conn = new mysqli($host_name, $host_user, $host_password, $database_name);
 		$this->conn =  $conn;
	}

	public function query($query , $params = array())
	{
		$query_result = $this->conn->query($query);

		if (!$query_result){
			   print('Invalid query');
			}
		else if(explode(' ',$query)[0] == 'SELECT')
		{
			while($row=mysqli_fetch_assoc($query_result))
			{
				$output[]=$row;
			}
			return $output;
			//$this->conn->close();
		}
	}

}
//echo json_encode($message);
//this->conn->close();
?>
