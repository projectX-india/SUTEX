<?php
session_start();
//error_reporting(1);

include("../database.php");

extract($_POST);

if(isset($submit)){
    $rs = mysqli_query($con, "select * from admin where admin_username='$admin_username' and admin_password='$admin_password'");

    if (mysqli_num_rows($rs)>1){
        header("location:index.php?login=false");
    }else{
        $row = $rs->fetch_assoc();
        $adminid=$row['admin_id']; 
        $_SESSION['admin_id'] = $adminid;
    }

}

if(isset($_SESSION['admin_id'])){
    header("location:adminpanel.php");
}

?>
