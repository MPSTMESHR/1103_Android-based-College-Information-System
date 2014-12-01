<?php
// array for JSON response
$response = array();
//require_once('db_connect.php');
// connecting to db
//$db = new DB_CONNECT();

$username = "b7_14642980";
$password = "collegeinfo";
$hostname = "sql306.byethost7.com"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$selected = mysql_select_db("b7_14642980_collegeinformer",$dbhandle) 
  or die("Could not select collegeinformer");
  
$sap=null;
$response["res"]=array();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
		$sap=test_input($_POST['sap']);
		$pass=test_input($_POST['password']);
		
	$pass_query=mysql_query("SELECT * FROM student_information WHERE SAP='".$sap."' AND password='".$pass."'");
	$row=mysql_num_rows($pass_query);
	if ($row>0)
	{
		$login=array();
		$login["result"]=1;
		array_push($response["res"], $login);	
		$response["success"] = 1;
		 echo json_encode($response);
	}
else 
	{
    // no products found
    $login=array();
		$login["result"]=0;
		array_push($response["res"], $login);
		$response["success"] = 1;
		 echo json_encode($response);
	}
	
}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
	

?>