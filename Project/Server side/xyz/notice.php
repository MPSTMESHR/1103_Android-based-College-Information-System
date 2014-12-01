<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
//require_once __DIR__ . '/db_connect.php';

// connecting to db
//$db = new DB_CONNECT();
$username = "b7_14642980";
$password = "collegeinfo";
$hostname = "sql306.byethost7.com"; 
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$selected = mysql_select_db("b7_14642980_collegeinformer",$dbhandle) 
  or die("Could not select androidhive");
$qu=null;
$bran=null;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
		$s_id=test_input($_POST['s_id']);
// get all products from products table
$result = mysql_query("SELECT * FROM notices WHERE sub_id=$s_id") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["message"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $notices = array();
        $notices["timestamp"] = $row["time"];
		$notices["notice"] = $row["notice"];
        //$product["name"] = $row["Title"];
       // $product["price"] = $row["Account"];
       /* $product["description"] = $row["description"];
        $product["created_at"] = $row["created_at"];
        $product["updated_at"] = $row["updated_at"];
		*/


        // push single product into final response array
        array_push($response["message"], $notices);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
}
 else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

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
