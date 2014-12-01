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
			document.getElementById('subjectdiv').style.display="block";
			document.getElementById('electivediv').style.display="none";
			document.getElementById('msg').style.display="none";
			//document.getElementById('committeediv').style.display="none";
			}
function displayElective()
			{
			document.getElementById('electivediv').style.display="block";
			document.getElementById('subjectdiv').style.display="none";
			document.getElementById('msg').style.display="none";
			//document.getElementById('committeediv').style.display="none";
			}
function displayCommittee()
			{
			//document.getElementById('committeediv').style.display="block";
			document.getElementById('electivediv').style.display="none";
			document.getElementById('subjectdiv').style.display="none";
			document.getElementById('msg').style.display="none";
			}
</script>
<title>
Subject Page-Admin
</title>
</head>
<body>
<body>
 <center>
	<h1>
	Subjects
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
				<a href="javascript:displaySubject()">Add Subject</a>
			</td>
			<td width="400" align="center">
				<a href="javascript:displayElective()">Add Elective</a>
			</td>
			<!--<td width="400" align="center">
				<a href="javascript:displayCommittee()">Add Committee</a>
			</td>-->
		</tr>
		<tr>
			<td>
				<div id="subjectdiv" style="display:none;">
				<form name="subjectform" action="subject_process.php" method="post">
				<input type="hidden" name="subjectCheck" value="sent">
				<table>
					<tr>
						<td>
						Enter Subject Name:
						</td>
						<td>
						<input type="text" name="subject" />
						</td>
					</tr>
					<tr>
						<td>
						Select Year:
						</td>
						<td>
						<select name='year'>
						<option value="default">--Select Year--</option>
<?php
	$query = mysql_query("SELECT DISTINCT YEAR FROM subject_information WHERE year IS NOT NULL ORDER BY year ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['YEAR'].'">'.$result['YEAR'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Add"/>
						</td>
					</tr>
				</table>
				</form>
				</div>
			</td>
			<td>
				<div id="electivediv" style="display:none;">
				<form name="electiveform" action="subject_process.php" method="post">
				<input type="hidden" name="electiveCheck" value="sent">
				<table>
					<tr>
						<td>
						Enter Subject Name:
						</td>
						<td>
						<input type="text" name="subject" />
						</td>
					</tr>
					<tr>
						<td>
						Select Year:
						</td>
						<td>
						<select name='year'>
						<option value="default">--Select Year--</option>
<?php
	$query = mysql_query("SELECT DISTINCT YEAR FROM subject_information WHERE year IS NOT NULL ORDER BY year ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['YEAR'].'">'.$result['YEAR'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Add"/>
						</td>
					</tr>
				</table>
				</form>
				</div>
			</td>
			<!--
			<td>
				<div id="committeediv" style="display:none;">
				<form name="committeeform" action="subject_process.php" method="post">
				<input type="hidden" name="committeeCheck" value="sent">
				<table>
					<tr>
						<td>
						Enter Committee Name:
						</td>
						<td>
						<input type="text" name="committee" />
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Add"/>
						</td>
					</tr>
				</table>
				</form>
				</div>
			</td>-->
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