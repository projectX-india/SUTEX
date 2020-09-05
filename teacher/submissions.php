<?php

session_start();
//error_reporting(1);

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

?>


<!doctype html>
<html lang="en">
  <head>
  	<title><?php
        $row2 = $rs2 ->fetch_assoc(); 
        echo $row2['subject_name']; 
    ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>



<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">



<link rel="stylesheet" type="text/css" href="../css/util.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url('../assets/img/logo.png');"></a>
	        <ul class="list-unstyled components mb-5">
	          
                
            
             <li><?php echo"<a href=\"classroom.php?id=$gid&sid=$sid\">back to classroom</a>";?></li>
	        </ul>

	        

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn">
              <i class="fa fa-bars"></i>
          
            </button>
            

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                
              </ul>

            </div>
          </div>
        </nav>

<!-- Courses area start -->

<div class="limiter">
        
            <div class="wrap-table40">
                <div class="table40">
                    <table>
                        <thead>
                            <tr class="table40-head">
                                <th class="column1">Name</th>
                                <th class="column2">Roll No.</th>
                                <th class="column3">Attachment</th>
                               <th class="column3">Time</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody>
                                
                                <?php
echo"<tr>";
$submission_table_name = $gid_decrypted."_".$sid."_assignment_".$aid."_submission";

$query7 = "select * from ".$submission_table_name." order by submission_time desc";
$rs3 = mysqli_query($con,$query7) or die("cannot perform query 7");

while($row = mysqli_fetch_row($rs3)){
    $student_id = $row[2];
    $time = $row[3];
    $query8 = "select * from student where student_id = '$student_id'";
    $rs4 = mysqli_query($con,$query8) or die ("cannot find student");
    $row4 = $rs4 ->fetch_assoc();
    $name = $row4['student_name'];
    $roll = $row4['student_rollnumber'];
    $attachment = $row[1];
    echo"<td class=\"column1\">".$name."</td>";
    echo"<td class=\"column2\">".$roll."</td>";
    echo"<td class=\"column3\"><a href=\"$attachment\" target=\"_blank\">attachment</td></a>"; 
    echo"<td class=\"column3\">$time</td>";
echo"</tr>";
}
          ?>                      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Courses area End -->
      </div>
		</div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="../assets/js/jquery.barfiller.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->  
    <script src="./assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>










