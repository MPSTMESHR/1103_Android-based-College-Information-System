

    <?php
    //Start session
    session_start();
     
    //Include database connection details
    require_once('config.php');
     
    //Array to store validation errors
    $errmsg_arr = array();
     
    //Validation error flag
    $errflag = false;
     
    //Function to prevent SQL injection
    function clean($str) 
	{
    $str = @trim($str);
    if(get_magic_quotes_gpc()) 
	{
    $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
    }
     
    //Sanitize the POST values
    $username = clean($_POST['username']);
    $password = clean($_POST['password']);
    $member = clean($_POST['member']);
     
    //Input Validations
    if($username == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
    }
    if($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
    }
     
    //If there are input validations, redirect back to the login form
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
    }
     
	if($member=="faculty")
{
    //Create query
    $result=mysql_query("SELECT * FROM faculty_information WHERE username='$username' AND password='$password'");
     
    //Check whether the query was successful or not
    if($result) 
{
    if(mysql_num_rows($result) > 0) 
{
    //Login Successful
    session_regenerate_id();
    $output = mysql_fetch_assoc($result);
	$_SESSION['SESS_MEMBER_ID']=$output['username'];
    $_SESSION['SESS_FIRST_NAME'] = $output['fname'];
	$_SESSION['SESS_LAST_NAME'] = $output['lname'];
	$_SESSION['SESS_PASS'] = $output['password'];
    $_SESSION['SESS_MEMBER'] = $member;
	    header("location: faculty_home.php");
    session_write_close();

    exit();
    }
else 
{
    //Login failed
    $errmsg_arr[] = 'user name and password not found';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
    }
    }
    }
	}
elseif ($member=="admin")
{
//Create query
    $result=mysql_query("SELECT * FROM admin_information WHERE username='".$username."' AND password='".$password."'");
     
    //Check whether the query was successful or not
    if($result) 
{
    if(mysql_num_rows($result) > 0) 
{
    //Login Successful
    session_regenerate_id();
    $output = mysql_fetch_assoc($result);
    $_SESSION['SESS_MEMBER_ID']=$output['username'];
    $_SESSION['SESS_FIRST_NAME'] = $output['fname'];
	$_SESSION['SESS_LAST_NAME'] = $output['lname'];
	$_SESSION['SESS_PASS'] = $output['password'];
    $_SESSION['SESS_MEMBER'] = $member;
    session_write_close();
    header("location: admin_home.php");
    exit();
    }
else 
{
    //Login failed
    $errmsg_arr[] = 'user name and password not found';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
    }
    }

}
}
else {
    die("Query failed");
    }
    ?>