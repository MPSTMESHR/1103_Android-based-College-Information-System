<?php
	require_once('aauth.php');
	require_once('config.php');
?>

<html>
<head>
<script>

</script>
<link rel="stylesheet" type="text/css" href="cis.css">
<title>
Student Page-Admin
</title>
</head>
<body>
<center>
<h1>
Student Page
</h1>
</center>
<p align="right">
<a href="admin_home.php">Home</a>
<br>
<a href="profile_edit_admin.php">Edit Profile</a>
<br>
<a href="index.php">Logout</a>
</p>
<form action="import_file.php" method="post" enctype="multipart/form-data">
        <center>
<table width="40%">
    <tr>
        <td><h3>
            Filename:
      </h3>  </td>
        <td>
            <input type="file" name="file" id="file">
		</td>
		</tr>
		<tr>
		<td></td>
		<td>
			 Year:  
 <select name='Year'>
  <option value="I">1st</option>
  <option value="II">2nd</option>
  <option value="III">3rd</option>
  <option value="IV">4th</option>
</select>

 Course:  
 <select name='course'>
  <option value="B.Tech">B.Tech</option>
  <option value="M.B.A Tech">M.B.A Tech.</option>
  </select>

			 
        </td>
    </tr>
    </table>
    <table width="20%">
    <tr>
        <td  colspan="5"  align="left">
       <input type="submit" name="submit" value="Submit">
        </td>
    </tr>
</table>
</form>

<?php
    if( isset($_SESSION['EDIT_MSG']))
{
    echo $_SESSION['EDIT_MSG'];
    unset($_SESSION['EDIT_MSG']);
}
?>	
</center>

</body>
</html>