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
              
                    <a href="teacher.php">Main menu</a>
                </li><li>
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">classrooms</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                
    <?php

$tablename = $gid_decrypted."_subjects";
$query123 = "select * from ".$tablename." where subject_teachercode = '$teacher_id'";
$rs123 = mysqli_query($con,$query123);
while($row = mysqli_fetch_row($rs123)){
    $sid2 = $row[0];

    echo"<li><a href=\"classroom.php?id=$gid&sid=$sid2\">".$row[1]."</a></li>";
        
    
}





       

    ?>
                
                
                
             
                </ul>
    </li>
    
                
              <li>
                  <?php
                  echo"
                <a href=\"assignments.php?id=$gid&sid=$sid\">assignments</a>
                    ";
                ?>
              </li>
              <li>
                  <?php echo"<a href=\"post.php?id=$gid&sid=$sid\">post a notice</a>"; ?>
              </li>
              <li>
                  <?php echo" <a href=\"assignment.php?id=$gid&sid=$sid\">post a assignment</a>"; ?>
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
<div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Posts</h2>
                        </div>
                    </div>
                </div>
               <section >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">


                        <?php

$post_table_name = $gid_decrypted."_".$sid."_post";
$query4 = "select * from ".$post_table_name." order by post_date desc "; 
$rs5 = mysqli_query($con,$query4);

while ($row = mysqli_fetch_row($rs5)){
    $post_id = $row[0];
    echo"<article class=\"blog_item\">
                                
    <div class=\"blog_details\">";
    echo"<h2 class=\"blog-head\" style=\"color: #2d2d2d;\">".$row[1]."</h2>";
    echo"<p> ".$row[2]."</p>";
    echo"<p>post date - ".$row[4]."</p>";
    if($row[3] != ""){
        echo"<p><a href=\"$row[3]\" target=\"_blank\">attachment</a></p>";
    }
    echo"<p><a href=\"deletepost.php?id=$gid&sid=$sid&pid=$post_id\"><button class=\"button button-contactForm boxed-btn\">delete post</button></a></p>";
    echo" </div>
    </article>";

}

?>




                            
                                 
                                    
                                    
                               
                           
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                    </div>
                </div>
            </div>
        </section>
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





