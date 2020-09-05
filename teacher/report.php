<?php
session_start();
error_reporting(1);

include("../database.php");
include("generator.php");

extract($_POST);
extract($_GET);
extract($_SESSION);


if($_SESSION['teacher_id']==""){
	echo'<h4>please login to continue</h4>';
	echo'<a href="index.php">login</a>';
	exit();
}

//print_r($_SESSION);
//echo"<br>";

print_r($_GET);
$studentid= $_GET['id'];
$gid = $_GET['gid'];
$teacherid = $_SESSION['teacher_id'];

$query4 = "insert into reported_student (student_id,teacher_id) VALUES ('$studentid','$teacherid')";
$rs3 = mysqli_query($con,$query4) or die("cannot report");
header("location:students.php?id=$gid");

?>
