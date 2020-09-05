<?php
session_start();
error_reporting(1);
include("../database.php");

extract($_SESSION);
extract($_POST);

if($_SESSION['teacher_id']){
    echo"logout to signup";
    exit();
}
if(isset($submit)){

    $rs2 = mysqli_query($con,"select * from teacher where teacher_username ='$username'");
    if(mysqli_num_rows($rs2)<1){
        $query1 = "insert into waiting_teacher (waiting_name,waiting_username,waiting_password,waiting_email) values ('$name','$username','$password','$email')";
        $rs3=mysqli_query($con,$query1)or die("cannot create student");
        header("location:index.php?account=waiting");
    }else{
        header("location:signup.php?username=exsists");
    }

}
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	            <a href="../index.php">Back to Main Menu</a>
                <a href="index.php">Login</a>
	          <li>

              
	          </li>
	        </ul>

	       

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        
               <div class="row">
                <div class="col-12">
                    <h2 class="contact-title"> TEACHER SIGNUP</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="signup.php" method="post" >
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" id="name" placeholder="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'name'"  required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'username'" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" id="email" placeholder="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'email'" required>
                                </div>
                            </div>
                            
                        </div>

                        <?php
                            extract($_GET);

                            if($_GET['username'] == "exsists"){
                                echo"<p>username already exists!</p>";
                            }else if($_GET['code']=="false"){
                                echo"<p>incorrect student code</p>";
                            }

                        ?>

                        <div class="form-group mt-3">
                            <button type="submit" name="submit" value="login" class="button button-contactForm boxed-btn">Signup</button>
                        </div>
                    </form>
                </div>
                
            </div>
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
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>
  </body>
</html>


