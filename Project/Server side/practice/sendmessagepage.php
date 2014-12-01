<html>
<body>
<?php 

$name = $branch = $Year = $message = $users = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$Year=test_input($_POST['Year']);
	//query
	$message=test_input($_POST['message']);
	$branch=test_input($_POST['branch']);
	
	include_once './db_functions.php';
	 $db = new DB_Functions();
    $users = $db->getAlluserlist($branch,$Year);
	if($users === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

		 while ($row = mysql_fetch_array($users)) 
		 {
			echo $row["gcm_regid"];
			
			sendmessage(test_input($row["gcm_regid"]),$message);
		 }
}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
function sendmessage($regId ,$message) 
{
    
    include_once './GCM.php';
    
    $gcm = new GCM();

    $registatoin_ids = array($regId);
    $message = array("price" => $message);

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Select Branch: 
 <select name='branch'>
  <option value="cs" >C.S</option>
  <option value="it">I.T</option>
  <option value="mechanical">Mechanical</option>
  <option value="civil">Civil</option>
  <option value="civil">Civil</option>
 </select>
 <br>
 Year:  
 <select name='Year'>
  <option value="1">1st</option>
  <option value="2">2nd</option>
  <option value="3">3rd</option>
  <option value="4">4th</option>
</select>
<br>
     <textarea rows="3" name="message" cols="25" class="txt_message" placeholder="Type message here"></textarea>

       <input type="submit" value="Submit">

</form>
Input Values are:
<?php echo" <br><br> Values are <br><br>";
echo $Year;
echo "<br><br>";
echo $branch;
echo "<br><br>";
echo $message;
echo "<br><br>";

?>
 </body>
</html>