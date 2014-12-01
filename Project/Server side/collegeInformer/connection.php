

    <?php
   $mysql_hostname = "sql306.byethost7.com";
    $mysql_user = "b7_14642980";
    $mysql_password = "collegeinfo";
    $mysql_database = "b7_14642980_collegeinformer";
    $prefix = "";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");
    ?>