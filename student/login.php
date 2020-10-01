<?php
session_start();
include("../database.php");

extract($_POST);
if(isset($submit)){
    $rs = mysqli_query($con,"select * from student where student_username = '$student_username' and student_password = '$student_password'");


    if(mysqli_num_rows($rs)<1){
        header("location:index.php?login=false");

    }else{
        $row = $rs->fetch_assoc();
        $student_id = $row['student_id'];
        $student_group = $row['student_group'];
        $_SESSION[student_id]= $student_id;
        $_SESSION[student_group]=$student_group;
    }

}

if(isset($_SESSION[student_id])){
    header("location:student.php");
}

?>
