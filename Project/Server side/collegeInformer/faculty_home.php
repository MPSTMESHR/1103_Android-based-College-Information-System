<html>
<?php
	require_once('fauth.php');
	require_once('config.php');
?>
    
<head>
<link rel="stylesheet" type="text/css" href="cis.css">
<script>
function displayClass()
			{
			document.getElementById('classdiv').style.display="block";
			//document.getElementById('committeediv').style.display="none";
			document.getElementById('msg').style.display="none";
			}
function displayCommittee()
			{
			document.getElementById('committeediv').style.display="block";
			//document.getElementById('classdiv').style.display="none";
			document.getElementById('msg').style.display="none";
			}
</script>
<title>
	Welcome Faculty
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
<a href="profile_edit_faculty.php">Edit profile</a><br>
<a href="index.php">Logout</a>
</p>

<center>
	<table>
		<tr>
			<td width="400" align="center">
				<a href="javascript:displayClass()">Send to Class</a>
			</td>
			</tr>
		
			<td>
				<div id="classdiv" style="display:none;">
				<form name="classform" action="process_fac.php" method="post">
				<input type="hidden" name="classCheck" value="sent">
				<table>
					<tr>
						<td>
						Select Year:
						</td>
						<td>
						<select name='year'>
						<option value="default">--Select Year--</option>
<?php
	$query = mysql_query("SELECT DISTINCT YEAR FROM subject_information WHERE username='".$_SESSION['SESS_MEMBER_ID']."' AND year IS NOT NULL ORDER BY year ASC");
	while($result = mysql_fetch_array($query))
{
	echo'<option value="'.$result['YEAR'].'">'.$result['YEAR'].'</option>';
}
?>
						</select>
						</td>
					</tr>
					<tr>
						<td>
						Select Subject:
						</td>
						<td> 
						<select name='subject'>
						<option value="NULL">Select Subject</option>
<?php
$query = mysql_query("SELECT DISTINCT subject_name FROM subject_information WHERE username='".$_SESSION['SESS_MEMBER_ID']."'");
//	$query = mysql_query("SELECT DISTINCT subject_name FROM subject_information WHERE username='".$_SESSION['SESS_MEMBER_ID']."' AND year IS NOT NULL");
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
					Enter Message:
					</td>
					<td>
					<textarea rows="3" name="message" cols="25" class="txt_message" placeholder="Type message here"></textarea>
					</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Send Message">
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