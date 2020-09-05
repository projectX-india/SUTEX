<?php

session_start();
error_reporting(1);

include("../database.php");
include("generator.php");

extract($_POST);
extract($_GET);
extract($_SESSION);

$gid = $_GET['id'];
$gid_decrypted = decrypt("parv",$gid);
$tablename2 = $gid_decrypted."_teachers";
$query2 = "select * from ".$tablename2." where teacher_id = '$teacher_id'";
$rs = mysqli_query($con,$query2);

if(mysqli_num_rows($rs)<1){
    echo"you dont have access to this group";
    exit();
}

$table_subjects = $gid_decrypted."_subjects";
$sid = $_GET['sid'];
$query3 = "select * from ".$table_subjects." where subject_teachercode = '$teacher_id' and subject_id = '$sid'";
$rs2 = mysqli_query($con,$query3) or die("cannot perform query 3");

if(mysqli_num_rows($rs2)<1){
    echo"you dont have access to this subject";
    exit();
}


if($_SESSION['teacher_id']==""){
	echo'<h4>please login to continue</h4>';
	echo'<a href="index.php">login</a>';
	exit();
}

//print_r($_SESSION);
//echo"<br>";

$assignment_id = $_GET['aid'];
echo $assignment_id;
$assignment_table_name = $gid_decrypted."_".$sid."_assignment";
echo $assignment_table_name;
$query4="delete from ".$assignment_table_name." where assignment_id = '$assignment_id'";
$rs3=mysqli_query($con,$query4) or die("cannot delete");
header("location:assignments.php?id=$gid&sid=$sid");
?>