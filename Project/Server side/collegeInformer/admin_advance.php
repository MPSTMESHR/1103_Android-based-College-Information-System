<?php
	require_once('aauth.php');
	require_once('config.php');
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="cis.css">
<title>
Semester Advanced Settings
</title>
<script>
	function displayDemote()
			{
			document.getElementById('demotediv').style.display="block";
			document.getElementById('deletediv').style.display="none";
			document.getElementById('promotediv').style.display="none";
			document.getElementById('msg').style.display="none";
			}
		function displayDelete()
			{
			document.getElementById('deletediv').style.display="block";
			document.getElementById('demotediv').style.display="none";
			document.getElementById('msg').style.display="none";
			document.getElementById('promotediv').style.display="none";
			}
			function displayPromote()
			{
			document.getElementById('promotediv').style.display="block";
			document.getElementById('deletediv').style.display="none";
			document.getElementById('demotediv').style.display="none";
			document.getElementById('msg').style.display="none";
			}
</script>
</head>

<body>
<center>
<h1>Advanced</h1>
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
				<a href="javascript:displayDemote()">Demote Students</a>
			</td>
			<td width="400" align="center">
				<a href="javascript:displayPromote()">Promote Students</a>
			</td>
			<td width="400" align="center">
				<a href="javascript:displayDelete()">Delete Final Year Student Data</a>
			</td>
		</tr>
		
			<td>
				<div id="demotediv" style="display:none;">
				<form name="demoteform" action="advanced_process.php" method="post">
				<input type="hidden" name="demoteCheck" value="sent">
				<table>
					<tr>
						<td>
						Enter SAP of student:
						</td>
						<td>
						<input type="text" name="sap" />
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Demote" name="demote_submit"/>
						</td>
					</tr>
				</table>
				</form>
				<center>
				<font color="red" size="2">**Do not demote student before promoting the whole batch. This may lead to inconsistencies
				</font>
				</center>
				</div>
			</td>
			<td>
			<div id="promotediv" style="display:none;">
			<form name="promoteform" action="advanced_process.php" method="post">
			<input type="hidden" name="promoteCheck" value="sent">
			<center>
			<br>
			<input type="submit" value="Promote" name="promote_submit"/>
			<font size="2" color="red">
			<br><br>
			**By clicking promote button you will promote all the registered students to the next year!
			</font>
			</center>
			</form>
			</div>
			</td>
			<td>
				<div id="deletediv" style="display:none;">
				<form name="deleteform" action="advanced_process.php" method="post">
				<input type="hidden" name="deleteCheck" value="sent">
				<center>
				<br>
				<input type="submit" value="Delete"><br><br>
				<font color="red" size="2">
					**Click on delete button to delete all the data associated to the students of final year.<br>
					**WARNING!!!! The deleted data cannot be recovered!
					</font>
					</center>
				</form>
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