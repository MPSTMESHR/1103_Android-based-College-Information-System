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

if(isset($_POST['subjectCheck']))
{
$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['subject']."'") or die(mysql_error);
//$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['subject']."' AND year='".$_POST['year']."'");
if(mysql_num_rows($test)>0)
{
	$errmsg_arr = 'Subject '.$_POST['subject'].' already present for year '.$_POST['year'].'.';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_subpage.php");
			exit();
			}
}
else
{
	mysql_query("INSERT INTO subject_information(subject_name,year) VALUES('".$_POST['subject']."','".$_POST['year']."')") or die(mysql_error);
	$errmsg_arr = 'Subject '.$_POST['subject'].' for year '.$_POST['year'].' added successfully.';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_subpage.php");
			exit();
			}
}
}

else if(isset($_POST['electiveCheck']))
{
$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['subject']."' AND elective='1'") or die(mysql_error);
//$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['subject']."' AND year='".$_POST['year']."' AND elective='1'");
if(mysql_num_rows($test)>0)
{
	$errmsg_arr = 'Subject '.$_POST['subject'].' is already an elective for year '.$_POST['year'].'.';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_subpage.php");
			exit();
			}
}
else
{
	mysql_query("INSERT INTO subject_information(subject_name,year,elective) VALUES('".$_POST['subject']."','".$_POST['year']."','1')") or die(mysql_error);
	$errmsg_arr = 'Elective Subject '.$_POST['subject'].' for year '.$_POST['year'].' added successfully.';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_subpage.php");
			exit();
			}
}
}
if(isset($_POST['committeeCheck']))
{
$test=mysql_query("SELECT * FROM subject_information WHERE subject_name='".$_POST['committee']."' AND year IS NULL") or die(mysql_error);
if(mysql_num_rows($test)>0)
{
	$errmsg_arr = 'Committee '.$_POST['committee'].' already exists';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_subpage.php");
			exit();
			}
}

else
{
	mysql_query("INSERT INTO subject_information(subject_name,YEAR,branch) VALUES('".$_POST['committee']."','NULL','NULL')") or die(mysql_error);
	$errmsg_arr = 'Committee '.$_POST['committee'].' added successfully';
	$errflag = true;
		if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: admin_subpage.php");
			exit();
			}
}
}
?>