<?php
require_once('fauth.php');
require_once('config.php');

?>

<html>

 <head>
 <link rel="stylesheet" type="text/css" href="cis.css">
	<title>
		Edit Profile
	</title>
	<script>
		function displayUsername()
			{
			document.getElementById('usernamediv').style.display="block";
			document.getElementById('namediv').style.display="none";
			}
		function displayName()
			{
			document.getElementById('namediv').style.display="block";
			document.getElementById('usernamediv').style.display="none";
			}
	</script>

 </head>

 <body>
 <center>
	<h1>
	Edit Profile
	</h1>
 </center>
	<p align="right">
	<a href="faculty_home.php">Home</a><br>
	<a href="index.php">Logout</a></p>
	<center>
	<table>
		<tr>
			<td width="400" align="center">
				<a href="javascript:displayUsername()">Change Username</a>
			</td>
			<td width="400" align="center">
				<a href="javascript:displayName()">Change Name</a>
			</td>
		</tr>
		
			<td>
				<div id="usernamediv" style="display:none;">
				<form name="usernameform" action="profile_process_faculty.php" method="post">
				<table>
					<tr>
						<td>
						Enter New Username:
						</td>
						<td>
						<input type="text" name="username" />
						</td>
					</tr>
					<tr>
						<td>
						Enter Current Password:
						</td>
						<td>
						<input type="password" name="password" />
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Change" name="username_submit"/>
						</td>
					</tr>
					</form>
				</table>
				</div>
			</td>
			<td>
				<div id="namediv" style="display:none;">
				<form name="nameform" action="profile_process_faculty.php" method="post">
				<table>
					<tr>
						<td>
						Enter New First Name:
						</td>
						<td>
						<input type="text" name="fname" />
						</td>
					</tr>
					<tr>
						<td>
						Enter New Last Name:
						</td>
						<td>
						<input type="text" name="lname" />
						</td>
					</tr>
					<tr>
						<td>
						Enter Current Password:
						</td>
						<td>
						<input type="password" name="password" />
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
						<input type="submit" value="Change" name="name_submit"/>
						</td>
					</tr>
					</form>
				</table>
				</div>
			</td>
		</tr>
	</table>
<?php
    if( isset($_SESSION['EDIT_MSG']) && is_array($_SESSION['EDIT_MSG']) && count($_SESSION['EDIT_MSG'])>0)
{
    echo '<ul class="editmsg">';
    foreach($_SESSION['EDIT_MSG'] as $msg)
{
    echo '<li>',$msg,'</li>';
}
    echo '</ul>';
    unset($_SESSION['EDIT_MSG']);
}
?>	
	</center>
</body>
</html>