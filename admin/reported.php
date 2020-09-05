<?php
session_start();
//error_reporting(1);

include("../database.php");
include("generator.php");

extract($_SESSION);
extract($_GET);
extract($_POST);

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
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>admin panel</title>
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
            <li><a href="addgroup.php">add groups</a></li>
			<li><a href="groups.php">see groups</a></li>
			<li><a href="waiting.php">waiting teachers</a></li>
			<li><a href="students.php">students</a></li>
			<li><a href="reported.php">reported students</a></li>
			
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
                                <th class="column2">Username</th>
                                <th class="column3">teacher name</th>
                               <th class="column3"></th>
                               <th class="column3"></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php

$rs1 = mysqli_query($con,"select * from reported_student");

while($row = mysqli_fetch_row($rs1)){
    echo"<tr>";
    $code = $row[0];
    $teacher = $row[1];
    $rs2= mysqli_query($con,"select * from student where student_id = '$code'") or die("cannot do rs2");
    $rs3 = mysqli_query($con,"select * from teacher where teacher_id = '$teacher'") or die("cannot do rs3");
    $row1 = $rs2 ->fetch_assoc();
    $student_name = $row1['student_name'];
    $student_username = $row1['student_username'];
    $row2 = $rs3->fetch_assoc();
    $teacher_name = $row2['teacher_name'];
    echo"<td class=\"column1\">".$student_name."</td>";
    echo"<td class=\"column2\">".$student_username."</td>";
    echo"<td class=\"column3\">".$teacher_name."</td>";
    echo"<td class=\"column3\"><a href=\"approve.php?id=$code\">approve</a></td>";
    echo"<td class=\"column3\"><a href=\"disapprove.php?id=$code\">disapprove</a></td>";
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
