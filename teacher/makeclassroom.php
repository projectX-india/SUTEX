<?php
session_start();


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

$query1 = "select * from teacher where teacher_id = '$teacher_id'";
$rs1 = mysqli_query($con,$query1);
$row = $rs -> fetch_assoc();
$teachername = $row['teacher_name'];

if(mysqli_num_rows($rs)<1){
    echo"you dont have access to this group";
    exit();
}

if($_SESSION['teacher_id']==""){
	echo'<h4>please login to continue</h4>';
	echo'<a href="index.php">login</a>';
	exit();
}

//print_r($_SESSION);
//echo"<br>";

if(isset($submit)){
    $subject_table = $gid_decrypted."_subjects";
    $query3 = "insert into ".$subject_table." (subject_name, subject_teachercode, subject_teachername) VALUES ('$class_name','$teacher_id','$teachername')";
    echo $query3;
    $rs3 = mysqli_query($con,$query3)or die ("cannot be done");
    $subject_id = mysqli_insert_id($con);
    $newtablename = $gid_decrypted."_".$subject_id;
    $file1 = mkdir("../attachments/$gid_decrypted/$subject_id/assignments",0777,true);
    $file2= mkdir("../attachments/$gid_decrypted/$subject_id/posts",0777,true);
    $query4 = "CREATE TABLE `".$newtablename."_assignment` (assignment_id int(10) AUTO_INCREMENT PRIMARY KEY, assignment_title varchar(30), assignment_details varchar(2200), assignment_attachment varchar(255), assignment_specialcode varchar(255), assignment_deadline datetime, assignment_createtime datetime)";
    $query5 ="CREATE TABLE `".$newtablename."_post` (post_code int(10) AUTO_INCREMENT PRIMARY KEY, post_title varchar(30),post_details varchar(2200), post_attachment varchar(255),  post_date datetime)";
    $rs4= mysqli_query($con,$query4) or die ("cannot create assignment table");
    $rs5 = mysqli_query($con,$query5) or die ("cannot create post table");
    header("location:group.php?id=$gid");
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
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url();">logo</a>
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
                <a href="students.php">Student List</a>
              </li>
              <li>
                  <a href="joingroup.php">join group</a>
              </li>
              <li>
              <?php
   echo" <a href=\"makeclassroom.php?id=$gid\">make classrom</a>";
?>
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
<div class="row">
                <div class="col-12">
                    <h2 class="contact-title"> Create Class</h2>
                </div>
                <div class="col-lg-8">
                <?php echo"<form method=\"post\" action=\"makeclassroom.php?id=$gid\" class=\"form-contact contact_form\"> "; ?>
                    
                        <div class="row">
                            
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="class_name" id="class_name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Class name'" placeholder="class name">
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group mt-3">
                            <button type="submit" name="submit" value="login" class="button button-contactForm boxed-btn">create Class</button>
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










