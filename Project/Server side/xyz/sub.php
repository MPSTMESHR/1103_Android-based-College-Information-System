<?php


// array for JSON response
$response = array();


// include db connect class
//require_once __DIR__ . '/db_connect.php';

// connecting to db
//$db = new DB_CONNECT();
$username = "root";
$password = "";
$hostname = "localhost"; 
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$selected = mysql_select_db("collegeinformer",$dbhandle) 
  or die("Could not select androidhive");
/*
$username = "b7_14642980";
$password = "collegeinfo";
$hostname = "sql306.byethost7.com"; 
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$selected = mysql_select_db("b7_14642980_collegeinformer",$dbhandle) 
  or die("Could not select androidhive");
 // echo "Connected to db";
*/
$qu=null;
$bran=null;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
		$sap=test_input($_POST['sap']);
	//	$sap=71202100021;
// get all products from products table
$id=mysql_query("SELECT ss_id FROM student_information WHERE SAP=$sap");
if (mysql_num_rows($id) > 0) 
{
	while ($row = mysql_fetch_array($id)) 
	{
		$id1=$row["ss_id"];
	}
}
//echo "id is $id1 <br>";
$result=mysql_query("SELECT DISTINCT subject_information.subject_name, subject_information.sub_id
FROM subject_information
INNER JOIN student_subject
ON student_subject.ss_id=$id1 AND student_subject.sub_id=subject_information.sub_id") or die(mysql_error());
//$result=mysql_query("SELECT subject_name,sub_id FROM subject_information") or die(mysql_error());
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["slit"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $sub = array();
       $sub["s_name"] = $row["subject_name"];
		$sub["s_id"] = $row["sub_id"];
 
        // push single product into final response array
        array_push($response["slit"], $sub);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
}
 else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found $id1";

    // echo no users JSON
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
