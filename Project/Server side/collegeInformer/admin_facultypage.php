<?php
	require_once('aauth.php');
	require_once('config.php');
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="cis.css">
<script>
function displaySubject()
			{
			document.getElementById('subdiv').style.display="block";
			//document.getElementById('committeediv').style.display="none";
			document.getElementById('msg').style.display="none";
			document.getElementById('unassigndiv').style.display="none";
			}
function displayCommittee()
			{
			document.getElementById('committeediv').style.display="block";
			document.getElementById('subdiv').style.display="none";
			document.getElementById('msg').style.display="none";
			document.getElementById('unassigndiv').style.display="none";
			}
function displayUnassign()
			{
			//document.getElementById('committeediv').style.display="none";
			document.getElementById('subdiv').style.display="none";
			document.getElementById('msg').style.display="none";
			document.getElementById('unassigndiv').style.display="block";
			}
</script>
<title>
Faculty Page-Admin
</title>
</head>
<body>

<center>
<h1>
<?php
echo "Welcome ".$_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];
?>
</h1>
</center>

<p align="right">
<a href="admin_home.php">Home</a>
<br>
<a href="profile_edit_admin.php">Edit Profile</a>
<br>
<a href="index.php">Logout</a>
</p>

<center>
	<table>
		<tr>
			<td width="400" align="center">
				<a href="javascript:displaySubject()">Assign to Subject</a>
			</td>
			<!--<td width="400" align="center">
				<a href="javascript:displayCommittee()">Assign to Committee</a>
			</td>-->
			<td width="400" align="center">
				<a href="javascript:displayUnassign()">Unassign Subject</a>
			</td>
		</tr>
		
			<td>
				<div id="subdiv" style="display:none;">
				<form name="classform" action="faculty_assign.php" method="post">
				<input type="hidden" name="classCheck" value="sent">
				<table>
					<tr>
						<td>
						Enter Subject:
						</td>
						<td> 
						<input type="text" name="subject">
						<!--<select name='subject'>
						<option value="default">Select Subject</option>
<?php
	$query = mysql_query("SELECT DISTINCT subject_name FROM subject_information WHERE year IS NOT NULL");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['subject_name'].'">'.$result['subject_name'].'</option>';
}
?>
						</select>-->
						</td>
					</tr>
					<tr>
						<td>
						Select Year:
						</td>
						<td> 
						<select name='year'>
						<option value="default">Select Year</option>
<?php
	$query = mysql_query("SELECT DISTINCT year FROM subject_information WHERE year IS NOT NULL ORDER BY year ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['year'].'">'.$result['year'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td>
						Select Faculty:
						</td>
						<td>
						<select name='faculty'>
						<option value="default">Select Faculty</option>
<?php
	$query = mysql_query("SELECT DISTINCT fname,lname FROM faculty_information ORDER BY fname,lname ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['fname'].'">'.$result['fname'].' '.$result['lname'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Assign">
						</td>
					</tr>
					</form>
				</table>
				</div>
			</td>
			<!--
			<td>
				<div id="committeediv" style="display:none;">
				<form name="committeeform" action="faculty_assign.php" method="post">
				<input type="hidden" name="committeeCheck" value="sent">
				<table>
					<tr>
						<td>
						Select Committee:
						</td>
						<td>
						<select name='committee'>
						<option value="default">Select Committee</option>
<?php
	$query = mysql_query("SELECT DISTINCT subject_name FROM subject_information WHERE year IS NULL");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['subject_name'].'">'.$result['subject_name'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td>
						Select Faculty:
						</td>
						<td>
						<select name='faculty'>
						<option value="default">Select Faculty</option>
<?php
	$query = mysql_query("SELECT DISTINCT fname,lname FROM faculty_information ORDER BY fname,lname ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['fname'].'">'.$result['fname'].' '.$result['lname'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Assign">
						</td>
					</tr>
					</form>
				</table>
				</div>
			</td>-->
			<td>
				<div id="unassigndiv" style="display:none;">
				<form name="unassignform" action="faculty_assign.php" method="post">
				<input type="hidden" name="unassignCheck" value="sent">
				<table>
					<tr>
						<td>
						Select Faculty:
						</td>
						<td>
						<select name='faculty'>
						<option value="default">Select Faculty</option>
<?php
	$query = mysql_query("SELECT DISTINCT fname,lname FROM faculty_information ORDER BY fname,lname ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['fname'].'">'.$result['fname'].' '.$result['lname'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Unassign">
						<br>
					<font size="2" color="red">
						**By clicking Unassign button you will
						<br>  clear all the subjects assigned to the
						<br>selected faculty!!
					</font>
						</td>
					</tr>
					</form>
				</table>
				</div>
			</td>
		</tr>
	</table>
	
<div id="msg" style="display:block;">
<?php
    if( isset($_SESSION['EDIT_MSG']))
{
    echo $_SESSION['EDIT_MSG'];
    unset($_SESSION['EDIT_MSG']);
}
?>	
	</div>
	</center>
</body>
</html>