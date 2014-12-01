<?php
class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
      require_once('db_connect.php');
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
    // destructor
    function __destruct() {   
    }

    /**
     * Storing new user
     * returns user details
     */
    public function newUser($fname, $lname, $sap, $branch,$year) {
        // insert user into database
        $result = mysql_query("INSERT INTO student_information(sap,fname,lname,branch,year) VALUES('$sap', '$fname','$lname', '$branch', $year)");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM student_information WHERE sap=  $sap") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } 
		else 
		{
            return false;
        }
    }

	    public function Insertgcm( $sap, $gcm_regid) {
        // insert user into database
        $result = mysql_query("UPDATE student_information set gcm_regid='$gcm_regid' where sap='$sap'");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM student_information WHERE sap=  $sap") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
	
	public function getAlluserlist($subject,$year,$msg) {
	
	//echo "22";
	$s_id=mysql_query("SELECT sub_id FROM subject_information WHERE subject_name='".$subject."' AND YEAR='".$year."'");
	
while($row=mysql_fetch_array($s_id))
{
$sub_id=$row['sub_id'];
}
	$ss_id=mysql_query("SELECT ss_id FROM student_subject WHERE sub_id='".$sub_id."'");
//echo "44";
while($row=mysql_fetch_array($ss_id))
{
//echo "55";
$sss_id=$row['ss_id'];
//echo $sss_id;
//echo"----";
$result = mysql_query("select gcm_regid FROM student_information where ss_id='".$sss_id."'");
while($row=mysql_fetch_array($result))
{
$id=$row['gcm_regid'];
echo $id;
include_once './GCM.php';
//echo "33";
 
    $gcm = new GCM();
	   
    $registatoin_ids = array($row['gcm_regid']);
    $message = array("price" => $msg);

    $result = $gcm->send_notification($registatoin_ids, $message);
	
    //echo $result;
}
/*
include_once './GCM.php';
echo "33";
 
    $gcm = new GCM();
	   
    $registatoin_ids = array($result['gcm_regid']);
    $message = array("price" => $msg);

    $result = $gcm->send_notification($registatoin_ids, $message);
    echo $result;
	*/
}
	/*
        $result = mysql_query("select * FROM student_information where ss_id='".$sss_id."'");
        
		echo $result['gcm_regid'];
        return $result;
    }
	*/
    
	}
	
	
}
?>