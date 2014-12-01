<?php
// array for JSON response
$response = array();
require_once('connection.php');
// connecting to db
$db = new DB_CONNECT();
?>

<body>
<?php
$s_id=null;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
		$s_id=test_input($_POST['s_id']);
$result=mysql_query("SELECT * FROM notices WHERE sub_id='".$s_id."'")or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // subject name node
    $response["timestamp"] = array();
	$response["notice"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $notices = array();
        $notices["timestamp"] = $row["time"];
		$notices["notice"] = $row["notice"];
      
        // push single subject into response array
        array_push($response["timestamp"], $notices["timestamp"]);
		array_push($response["notice"],$notices["notice"]);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No notices found";

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
	

?>
</body>

