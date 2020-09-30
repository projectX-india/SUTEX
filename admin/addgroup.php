<?php

//session_start();
//error_reporting(1);
include("../database.php");
include("generator.php");

extract($_SESSION);
extract($_POST);
extract($_GET);

if($_SESSION['admin_id']==""){
	echo'<h4>please login to continue</h4>';
	echo'<a href="index.php">login</a>';
	exit();
}

if (isset($submit)){
    
    $rs= mysqli_query($con, "select * from groups where group_uniquename='$groupuid'");

    if(mysqli_num_rows($rs)<1){
        $tcode= "teacher".$groupuid;
        $scode="student".$groupuid;

        $tcode=encrypt("parv",$tcode);
        $scode=encrypt("parv",$scode);

        $rs2 = mysqli_query($con,"insert into groups(tcode,scode,group_name,group_uniquename) values ('$tcode','$scode','$groupname','$groupuid') ") or die("cannot create group");
        $query_teachers = "CREATE TABLE `".$groupuid."_teachers` (teacher_id int(10) , teacher_name varchar(255) , teacher_username varchar(255), teacher_email varchar(255))"; 
        $rs3 = mysqli_query($con,$query_teachers) or die ("cannot create teacher's table");
        $query_students = "CREATE TABLE `".$groupuid."_students` (student_id int(10) , student_name varchar(255) , student_username varchar(255), student_email varchar(255))"; 
        $rs4 = mysqli_query($con,$query_students)or die ("cannot create student table");
        $query_subject = "CREATE TABLE `".$groupuid."_subjects` (subject_id int(10) AUTO_INCREMENT PRIMARY KEY,subject_name varchar(30) ,subject_teachercode int(10),subject_teachername varchar(255))";
        $rs5 = mysqli_query($con,$query_subject) or die("cannot create subject table");
         
     }else{
        header("location:addgroup.php?status=2");
    }

}

?>





<!doctype html>
<html lang="en">
  <head>
  	<title>Create group</title>
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
<div class="row">
                <div class="col-12">
                    <h2 class="contact-title"> Create Group</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="addgroup.php" method="post" >
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="groupname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'group name'" placeholder="group name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="groupuid" onfocus="this.placeholder = ''" onblur="this.placeholder = 'group unique id'" placeholder="group unique id">
                                </div>
                            </div>
                        </div>

                        <?php

$stat = $_GET['status'];

if($stat == 2 || $stat == "2"){
echo"<br>group uniqueid already exists<br>";
    
}


?>
                        <div class="form-group mt-3">
                            <button type="submit" name="submit" value="login" class="button button-contactForm boxed-btn">Create class</button>
                        </div>
                    </form>
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












