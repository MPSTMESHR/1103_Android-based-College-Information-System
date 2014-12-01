<?php
	$Year=$_POST['Year'];
	$course=$_POST['course'];

	//echo $Year;
if ($_FILES["file"]["error"] > 0)
{
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";
    //echo "Stored in: " . $_FILES["file"]["tmp_name"];
	$a=$_FILES["file"]["tmp_name"];
	//echo $a;
 
	$connect = mysql_connect('sql306.byethost7.com','b7_14642980','collegeinfo');
if (!$connect) {
die('Could not connect to MySQL: ' . mysql_error());
}	
//your database name
$cid =mysql_select_db('b7_14642980_collegeinformer',$connect);
 session_start();
//$strm=$_SESSION['stream'];
//$yr=$_SESSION['year'];

// path where your CSV file is located
//define('CSV_PATH','C:/xampp/htdocs/');
//<!-- C:\xampp\htdocs -->
// Name of your CSV file
$csv_file = $a; 
 
if (($getfile = fopen($csv_file, "r")) !== FALSE) {
         $data = fgetcsv($getfile, 1000, ",");
   while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
     $num = count($data);
	   //echo $num;
       // for ($c=0; $c < $num; $c++) {
            $result = $data;
        	$str = implode(",", $result);
        	$slice = explode(",", $str);
 
            $col1 = $slice[0];
            $col2 = $slice[1];
            $col3 = $slice[2];
			//$col4 = $slice[3];
			//class(Roll_No.,SAP_No.,Name)
			//persons(id,name,email,contacts)
			$query = "INSERT INTO student_information(SAP,fname,lname,Branch,Year,Course) VALUES('".$col2."','".$col3."',null,null,'".$Year."','".$course."')";
$s=mysql_query($query, $connect );
}
}}
echo "<script>alert('Record successfully uploaded.');</script>";

//echo "File data successfully imported to database!!";
mysql_close($connect);
$errmsg_arr = 'File Imported Successfully';
			$errflag = true;
			$_SESSION['EDIT_MSG'] = $errmsg_arr;
			if($errflag) 
			{
			session_write_close();
			header("location: admin_studentpage.php");
			exit();
			}
?>