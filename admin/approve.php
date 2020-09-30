<?php
session_start();
error_reporting(1);

include("../database.php");
include("generator.php");

extract($_SESSION);
extract($_GET);
extract($_POST);
//remove you
if($_SESSION['admin_id']==""){
	echo'<h4>please login to continue</h4>';
	echo'<a href="index.php">login</a>';
	exit();
}

//echo "admin_id = ".$admin_id."<br>";
//$class = encrypt("parv","teachergroup1");
//echo "encrypted text- ".$class."<br>";
//$decrypted = decrypt("parv",$class);
//echo "decrypted text - ".$decrypted."<br>";

$id = $_GET['id'];
$rs = mysqli_query($con,"select * from student where student_id='$id'") or die("error rs");
$row = $rs->fetch_assoc();
$group = $row['student_group'];
$studenttable = $group."_students";
$query2 = "delete from ".$studenttable." where student_id ='$id'";
$rs1 = mysqli_query($con,$query2) or die("query2");
$rs3 = mysqli_query($con,"delete from student where student_id='$id'") or die("error rs3");
header("location:reported.php");
?>
