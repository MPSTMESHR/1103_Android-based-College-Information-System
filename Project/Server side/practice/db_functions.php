<?php
class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
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
    public function newUser($name, $sap, $branch,$year) {
        // insert user into database
        $result = mysql_query("INSERT INTO user(sap,name,branch,year) VALUES('$sap', '$name', '$branch', $year)");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM user WHERE sap=  $sap") or die(mysql_error());
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

	    public function Insertgcm($name, $sap, $gcm_regid) {
        // insert user into database
        $result = mysql_query("UPDATE student_information set gcm_regid='$gcm_regid' where sap='$sap'");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM user WHERE sap=  $sap") or die(mysql_error());
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
    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
	echo "get";
        $result = mysql_query("SELECT * FROM gcm_users WHERE email = '$email' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }
	
	public function getAlluserlist($branch,$year) {
        $result = mysql_query("select * FROM user where branch='$branch' and year='$year'");
        return $result;
    }
    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from gcm_users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }
}
?>