<html>
<body>
<?php
	require_once('aauth.php');
require_once('config.php');
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
  
if(isset($_POST['demoteCheck']))
{
$sap=$_POST['sap'];
$qry=mysql_query("SELECT * FROM student_information WHERE SAP='".$sap."'");
while($row=mysql_fetch_array($qry))
{
$result['course']=$row['course'];
$result['year']=$row['Year'];
$result['SAP']=$row['SAP'];
$result['fname']=$row['fname'];
$result['lname']=$row['lname'];
}

if($result['course']=='B.Tech')
{
if($result['year']=='I')
{
	$errmsg_arr = 'Student in Ist year. Cannot be demoted. Kindly check.';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_advance.php");
			exit();
			}
}
if($result['year']=='II')
{
mysql_query("UPDATE student_information SET YEAR='I' WHERE sap='".$sap."'");
}
else if($result['year']=='III')
{
mysql_query("UPDATE student_information SET YEAR='II' WHERE sap='".$sap."'");
}
else if($result['year']=='IV')
{
mysql_query("UPDATE student_information SET YEAR='III' WHERE sap='".$sap."'");
}
else if($result['year']=='done')
{
mysql_query("UPDATE student_information SET YEAR='IV' WHERE sap='".$sap."'");
}
}
if($result['course']=='MBA Tech')
{
if($result['year']=='II')
{
mysql_query("UPDATE student_information SET YEAR='I' WHERE sap='".$sap."'");
}
else if($result['year']=='III')
{
mysql_query("UPDATE student_information SET YEAR='II' WHERE sap='".$sap."'");
}
else if($result['year']=='IV')
{
mysql_query("UPDATE student_information SET YEAR='III' WHERE sap='".$sap."'");
}
else if($result['year']=='V')
{
mysql_query("UPDATE student_information SET YEAR='IV' WHERE sap='".$sap."'");
}
else if($result['year']=='done')
{
mysql_query("UPDATE student_information SET YEAR='V' WHERE sap='".$sap."'");
}
}

	$errmsg_arr = 'Student '.$result['fname'].' '.$result['lname'].' with sap '.$result['SAP'].' demoted';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_advance.php");
			exit();
			}
			
}

if(isset($_POST['promoteCheck']))
{
$qry=mysql_query("SELECT * FROM student_information");
while($row=mysql_fetch_array($qry))
{
$result['course']=$row['course'];
$result['year']=$row['Year'];
$result['SAP']=$row['SAP'];

if($result['course']=='B.Tech')
{
if($result['year']=='I')
{
mysql_query("UPDATE student_information SET YEAR='II' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='II')
{
mysql_query("UPDATE student_information SET YEAR='III' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='III')
{
mysql_query("UPDATE student_information SET YEAR='IV' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='IV')
{
mysql_query("UPDATE student_information SET YEAR='done' WHERE sap='".$result['SAP']."'");
}
}
if($result['course']=='MBA Tech')
{
if($result['year']=='I')
{
mysql_query("UPDATE student_information SET YEAR='II' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='II')
{
mysql_query("UPDATE student_information SET YEAR='III' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='III')
{
mysql_query("UPDATE student_information SET YEAR='IV' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='IV')
{
mysql_query("UPDATE student_information SET YEAR='V' WHERE sap='".$result['SAP']."'");
}
else if($result['year']=='V')
{
mysql_query("UPDATE student_information SET YEAR='done' WHERE sap='".$result['SAP']."'");
}
}
	$errmsg_arr = 'All students have been successfully promoted';
	$errflag = true;
}
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_advance.php");
			exit();
			}
}
if(isset($_POST['deleteCheck']))
{
	mysql_query("DELETE FROM student_information WHERE YEAR='done'");
	
	$errmsg_arr = 'All the data associated to the final year students have been deleted';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_advance.php");
			exit();
			}
}
?>
</body>
</html>