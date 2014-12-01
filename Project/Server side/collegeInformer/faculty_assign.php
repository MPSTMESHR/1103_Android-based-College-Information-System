<html>
<head>
<link rel="stylesheet" type="text/css" href="cis.css">
</head>
<body>
<?php
require_once('aauth.php');
require_once('config.php');
//require_once('db_functions.php');
//require_once('db_connect.php');
$username = "b7_14642980";
$password = "collegeinfo";
$hostname = "sql306.byethost7.com"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("b7_14642980_collegeinformer",$dbhandle) 
  or die("Could not select collegeinformer");

if(isset($_POST['classCheck']))
{
$uname=mysql_query("SELECT username FROM faculty_information WHERE fname='".$_POST['faculty']."'") or die(mysql_error);
while($row=mysql_fetch_array($uname))
{
$userName=$row['username'];
}

$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['subject']."'") or die(mysql_error);
//$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['subject']."' AND year='".$_POST['year']."'");

if(mysql_num_rows($test)>0)
{
	mysql_query("UPDATE subject_information SET username='".$userName."' WHERE subject_name='".$_POST['subject']."' AND year='".$_POST['year']."'") or die(mysql_error);	
}
else
{
	mysql_query("INSERT INTO subject_information(subject_name,year,username) VALUES ('".$_POST['subject']."','".$_POST['year']."','$userName')") or die(mysql_error);
}
	$errmsg_arr = $_POST['faculty'].' assigned to subject '.$_POST['subject'];
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_facultypage.php");
			exit();
			}
 }
else if (isset($_POST['committeeCheck']))
{
//fetch username
$uname=mysql_query("SELECT username FROM faculty_information WHERE fname='".$_POST['faculty']."'") or die(mysql_error);
while($row=mysql_fetch_array($uname))
{
$userName=$row['username'];
}
//fetch similar tuples
$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['committee']."'") or die(mysql_error);

while($row=mysql_fetch_array($test))
{
$uname=$row['username'];
$sid=$row['sub_id'];
}

//if returns similar tuples
if(mysql_num_rows($test)>0)
{
//check if username null
if($uname=='')
{
//if null and present then update
	mysql_query("UPDATE subject_information SET username='".$userName."' WHERE subject_name='".$_POST['committee']."' AND NOT username='".$userName."' AND sub_id='".$sid."'") or die(mysql_error);	
	$errmsg_arr = $_POST['faculty'].' assigned to committee '.$_POST['committee'];
			$errflag = true;
}
else
{
//if present but associated to another faculty
mysql_query("INSERT INTO subject_information(subject_name,username) VALUES ('".$_POST['committee']."','".$userName."')") or die(mysql_error);

$errmsg_arr = $_POST['faculty'].' assigned to committee '.$_POST['committee'];
			$errflag = true;
}
}
else
{
//if not present
	mysql_query("INSERT INTO subject_information(subject_name,username) VALUES ('".$_POST['committee']."','".$userName."')") or die(mysql_error);
			$errmsg_arr = $_POST['faculty'].' assigned to committee '.$_POST['committee'];
			$errflag = true;
}
if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_facultypage.php");
			exit();
			}  
/*
if(mysql_query("INSERT INTO subject_information(subject_name,username)
VALUES('".$_POST['committee']."','$userName')"))
{
			$errmsg_arr = $_POST['faculty'].' assigned to committee '.$_POST['committee'];
			$errflag = true;
			if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_facultypage.php");
			exit();
			}  
}*/
}
else if (isset($_POST['unassignCheck']))
{
$uname=mysql_query("SELECT username FROM faculty_information WHERE fname='".$_POST['faculty']."'") or die(mysql_error);
while($row=mysql_fetch_array($uname))
{
$userName=$row['username'];
}
if(mysql_query("UPDATE subject_information SET username='NULL' WHERE username='".$userName."'") or die(mysql_error))
{
			$errmsg_arr = 'All subjects linked to '.$_POST['faculty'].' unassigned';
			$errflag = true;
			if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_facultypage.php");
			exit();
			}  
}
}
  
?>
</body>
</html>