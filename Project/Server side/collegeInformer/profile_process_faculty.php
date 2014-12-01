<?php
require_once('config.php');
require_once('fauth.php');

	if (isset($_POST['username_submit'])) 
	{	
		if($_SESSION['SESS_PASS']==$_POST['password'])
		 {
			$qryCheck=mysql_query("SELECT username FROM faculty_information");
		while($row=mysql_fetch_array($qryCheck))
		 {
			$uname=$row['username'];
		if(!strcmp($uname,$_POST['username']))
		 {	
			$errmsg_arr[] = 'Username already exists.';
			$errflag = true;
			if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: profile_edit_admin.php");
			exit();
			}
		 }
		 }
			$qry=mysql_query("UPDATE faculty_information SET username='".$_POST['username']."' WHERE username='".$_SESSION['SESS_MEMBER_ID']."'");
			$errmsg_arr[] = 'Username changed.';
			$errflag = true;
			if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: profile_edit_faculty.php");
			exit();
			}
		 }
		 else
		 {
			$errmsg_arr[] = 'Wrong password.';
			$errflag = true;
			if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: profile_edit_admin.php");
			exit();
			}
		 }
	}	 
 
	else if (isset($_POST['name_submit']))
	{	
		if($_SESSION['SESS_PASS']==$_POST['password'])
		 {
			$qry=mysql_query("UPDATE faculty_information SET fname='".$_POST['fname']."' AND lname='".$_POST['lname']."'WHERE username='".$_SESSION['SESS_MEMBER_ID']."'");
			$errmsg_arr[] = 'Name changed.';
			$errflag = true;
			if($errflag) 
			{
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			session_write_close();
			header("location: profile_edit_faculty.php");
			exit();
			}
		}
	}
?>
