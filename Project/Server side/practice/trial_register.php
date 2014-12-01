<html>
<?php
$name=$sap=$gcm_regid="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	$name=test_input($_POST["name"]);
	$sap=test_input($_POST["sap"]);
	$gcm_regid=test_input($_POST["gcm_regid"]);
		register($name,$sap,$gcm_regid);
}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
function register($name ,$email,$gcm_regid) {
     
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();
    $gcm = new GCM();

    $res = $db->Insertgcm($name, $email, $gcm_regid);

    $registatoin_ids = array($gcm_regid);
    $message = array("product" => "shirt");

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
} 

?>
<body> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<br><br>
Name:        <input type="text" name ="name" value"<?php echo $name;?>"> 
<br>
SAP I.D: <input type="text" name="sap" value="<?php echo $sap;?>">
<br>
GCM_reg: <input type="text" name="gcm_regid" value="<?php echo $gcm_regid;?>"><br>
<input type="submit" value="Submit">
</form>

</body>
</html>