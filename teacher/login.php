<?php
session_start();

include("../database.php");


extract($_POST);

if(isset($submit)){

    $rs= mysqli_query($con, "select * from teacher where teacher_username = '$teacher_username' and teacher_password = '$teacher_password'");


    if(mysqli_num_rows($rs)<1){
        header("location:index.php?login=false");
    }else{
        $row = $rs->fetch_assoc();
        $teacher_id=$row['teacher_id'];
        $_SESSION['teacher_id']= $teacher_id;
    }

}

if(isset($_SESSION['teacher_id'])){
    header("location:teacher.php");
}

?>