<html>
<?php
// define variables and set to empty values

$sap=$name = $branch = $Year = $comment = $website = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$Year=test_input($_POST['Year']);
	$name=test_input($_POST["name"]);
	$sap=test_input($_POST["sap"]);
	$branch=test_input($_POST['branch']);
	
	include_once './db_functions.php';
	 $db = new DB_Functions();
    $res = $db->newUser($name, $sap, $branch,$Year);
	
}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<br><br>
Name:        <input type="text" name ="name" value"<?php echo $name;?>"> 
<br>
SAP I.D: <input type="text" name="sap" value="<?php echo $sap;?>">
<br>
Branch:  <select name='branch'>
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
       <input type="submit" value="Submit">
</form>

Input Values are:
<?php echo" <br><br> Values are <br><br>";
echo $name;
echo "<br><br>";
echo $branch;
echo "<br><br>";
echo $sap;
echo "<br><br>";
echo $Year;
?>
</body>
</html>
