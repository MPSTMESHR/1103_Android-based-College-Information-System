<?php
    require_once('aauth.php');
	require_once('config.php');
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="cis.css">
<title>
Welcome Admin
</title>
</head>
<center>
<h1>
<?php
echo "Welcome ".$_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];
?>
</h1>
</center>

<p align="right">
<a href="profile_edit_admin.php">Edit profile</a>
<br>
<a href="index.php">Logout</a>
</p>

<body>

<center>
<table>
<ul>
<tr>
<td>
<li></li>
</td>
<td>
<a href="admin_sendmsg.php"> Send Message</a>
</td>
</tr>

<tr>
<td>
<li></li>
</td>
<td>
<a href="admin_studentpage.php">Student</a>
</td>
</tr>

<tr>
<td>
<li></li>
</td>
<td>
<a href="admin_facultypage.php">Faculty</a>
</td>
</tr>

<tr>
<td>
<li></li>
</td>
<td>
<a href="admin_subpage.php">Subjects</a>
</td>
</tr>

<tr>
<td>
<li></li>
</td>
<td>
<a href="admin_advance.php">Advanced</a>
</td>
</tr>
</ul>
</table>
</center>

</body>
</html>