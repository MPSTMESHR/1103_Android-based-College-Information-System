

    <?php
    //Start session
    session_start();
    //Check whether the session variable SESS_MEMBER_ID is present or not
    if(!($_SESSION['SESS_MEMBER'] =="admin") || (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) )
	{
	$errmsg_arr[] = 'You do not have admin rights!</li>
		<li>Please login again';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
    }
   }
    ?>