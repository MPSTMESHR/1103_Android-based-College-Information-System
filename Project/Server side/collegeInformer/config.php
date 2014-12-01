<?php
/**
 * Database config variables
 */
define('DB_USER', "b7_14642980"); // db user
define('DB_PASSWORD', "collegeinfo"); // db password (mention your db password here)
define('DB_DATABASE', "b7_14642980_collegeinformer"); // database name
define('DB_SERVER', "sql306.byethost7.com"); // db server

	$mysql_hostname = "sql306.byethost7.com";
    $mysql_user = "b7_14642980";
    $mysql_password = "collegeinfo";
    $mysql_database = "b7_14642980_collegeinformer";
    $prefix = "";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");

/*
 * Google API Key
 */
define("GOOGLE_API_KEY", "AIzaSyBS-MSQhPKmmZrJkr0p_infnA150Z5Xtu4"); // Place your Google API Key
?>