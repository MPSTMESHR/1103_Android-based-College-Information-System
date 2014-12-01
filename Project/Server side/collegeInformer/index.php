    <?php
    //Start session
    session_start();	
    //Unset the variables stored in session
    unset($_SESSION['SESS_MEMBER_ID']);
    unset($_SESSION['SESS_FIRST_NAME']);
    unset($_SESSION['SESS_LAST_NAME']);
	unset($_SESSION['SESS_MEMBER']);
	unset($_SESSION['SESS_PASS']);
	//session_unset();
    ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="cis.css">
<title>
Login Page- College Informer
</title>
<center><h1>LOGIN PAGE</h1></center>
</head>
<body>

<center>
</center>

    <form name="loginform" action="login_exec.php" method="post">
    <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
    <tr>
    <td colspan="2">
    <!--the code bellow is used to display the message of the input validation-->

    <?php
    if( isset($_SESSION['ERRMSG_ARR']) 
	&& is_array($_SESSION['ERRMSG_ARR']) 
	&& count($_SESSION['ERRMSG_ARR'])>0)
{
    echo '<ul>';
    foreach($_SESSION['ERRMSG_ARR'] as $msg)
{
    echo '<li>',$msg,'</li>';
}
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);
}
    ?>

    </td>
    </tr>
<tr>
<td width="auto">
Member Type:
</td>
<td>
<select name='member'>
<option value="default">Select Member Type</option>
<option value="admin">Administrator</option>
<option value="faculty">Faculty</option>
</select>
</td>
</tr>
    <tr>
    <td width="116"><div align="right">Username</div></td>
    <td width="177"><input name="username" type="text" /></td>
    </tr>
    <tr>
    <td><div align="right">Password</div></td>
    <td><input name="password" type="password" /></td>
    </tr>
    <tr>
    <td><div align="right"></div></td>
    <td><input type="submit" value="Login" /></td>
    </tr>
    </table>
    </form>
</body>
</html>