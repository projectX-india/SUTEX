<?php
session_start();
//error_reporting(1);

include("../database.php");
include("generator.php");
extract($_SESSION);

if($_SESSION['teacher_id']==""){
	echo'<h4>please login to continue</h4>';
	echo'<a href="index.php">login</a>';
	exit();
}

?>



<!doctype html>
<html lang="en">
  <head>
  	<title>Teacher Home</title>
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
	          <li class="active">
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">groups</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                
    <?php
        $tid = $_SESSION['teacher_id'];
        
        $rs1 = mysqli_query($con,"select * from groups");

        while($row=mysqli_fetch_row($rs1)){
            $uniquecode = $row[4];
            $tname = $uniquecode."_teachers";
            $query1 = "select * from ".$tname." where teacher_id = '$tid' ";
            $rs2 = mysqli_query($con,$query1);

            if(mysqli_num_rows($rs2)>0){
                $encryptedid = encrypt("parv",$uniquecode);
                echo "<li><a href=\"group.php?id=$encryptedid\">".$row[3]."</a></li>";
                
            }
        }

    ?>
                
                
                
             
                </ul>
    </li>
    
                
              <li>
                  <a href="joingroup.php">join group</a>
              </li>
              <li>
                <a href="../resources/index2.html">Teaching Resources</a>
              </li>

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
        <div class="courses-area section-padding20 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Your groups</h2>
                        </div>
                    </div>
                </div>
                <div class="row">


                <?php
        $tid = $_SESSION['teacher_id'];
        
        $rs1 = mysqli_query($con,"select * from groups");

        while($row=mysqli_fetch_row($rs1)){
            $uniquecode = $row[4];
            $tname = $uniquecode."_teachers";
            $query1 = "select * from ".$tname." where teacher_id = '$tid' ";
            $rs2 = mysqli_query($con,$query1);

            if(mysqli_num_rows($rs2)>0){
                $encryptedid = encrypt("parv",$uniquecode);

            echo" <div class=\"col-lg-4\">
            <div class=\"properties properties2 mb-30\">
                <div class=\"properties__card\">
                    <div class=\"properties__img overlay1\">
                        <a href=\"group.php?id=$encryptedid\"><img src=\"../assets/img/gallery/featured1.png\"></a>
                    </div>
                    <div class=\"properties__caption\">
                        <p><a href=\"group.php?id=$encryptedid\">".$row[3]."</a></p>
                        <h4>student joining code - </h4>
                        <p>".$row[2]."
                        </p>
                        
                        
                    </div>
                </div>
            </div>
        </div>";
                
            }
        }

    ?>

                   
                    
                    
                    
                    
                    
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        
                    </div>
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

