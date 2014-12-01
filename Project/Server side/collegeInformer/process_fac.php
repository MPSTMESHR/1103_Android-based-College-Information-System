<?php
require_once('fauth.php');
require_once('db_functions.php');
//require_once('db_connect.php');

$username = "b7_14642980";
$password = "collegeinfo";
$hostname = "sql306.byethost7.com"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("b7_14642980_collegeinformer",$dbhandle) 
  or die("Could not select collegeinformer");
  
	$s_id=mysql_query("SELECT sub_id FROM subject_information WHERE subject_name='".$_POST['subject']."' AND year='".$_POST['year']."'");
	if($s_id === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row=mysql_fetch_array($s_id))
{
$sub_id=$row['sub_id'];
}
$db = new DB_Functions();
    $users = $db->getAlluserlist($_POST['subject'],$_POST['year'],$_POST['message']);
	if($users === FALSE) {
    die(mysql_error()); // TODO: better error handling
}



	mysql_query("INSERT INTO notices(notice,sub_id) VALUES('".$_POST['message']."','".$sub_id."')");
	$errmsg_arr = 'Message Sent Successfully';
			$errflag = true;
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			if($errflag) 
			{
			session_write_close();
			header("location: faculty_home.php");
			exit();
			}
		/* while ($row1 = mysql_fetch_array($users)) 
		 {
				echo "abcd";
				sendmessage($row1['gcm_regid'],$_POST['message']);
				echo $row1['gcm_regid'];
		 }
function sendmessage($regId ,$message) 
{
    
    include_once './GCM.php';
    
    $gcm = new GCM();
	//$echo $regId;
    $registatoin_ids = array($regId);
    $message = array("price" => $message);

    $result = $gcm->send_notification($registatoin_ids, $message);
    echo $result;
}
*/


?>

<html>
<head>
<title>
Success!
</title>
</head>
<body>
<a href="faculty_home.php">Home</a>
</body>
</html>