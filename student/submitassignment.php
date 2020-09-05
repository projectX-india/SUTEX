<?php
session_start();

include("../database.php");

extract($_SESSION);
extract($_GET);
extract($_POST);

if($_SESSION['student_id']=="" || $_SESSION['student_group']==""){
    echo"please login to continue<br>";
    echo"<a href=\"index.php\">login</a>";
    exit();
}
$student_id = $_SESSION['student_id'];
$subjectid = $_GET['sid'];
$group = $_SESSION['student_group'];
$subject_table = $group."_subjects";
$query = "select * from ".$subject_table." where subject_id='$subjectid'";
$rs = mysqli_query($con,$query) or die("cannot perform query");

if(mysqli_num_rows($rs)<1){
    echo"no such subject found in this group!<br>";
    echo"<a href=\"student.php\">back to classroom</a>";
    exit();
}

$assignmentid=$_GET['aid'];
$assignment_table =$group."_".$subjectid."_assignment";
$query1="select * from ".$assignment_table." where assignment_id=$assignmentid";
$rs1 = mysqli_query($con,$query1)or die("cannot perform query1");

if(mysqli_num_rows($rs1)<1){
    echo"no such assignment found!<br>";
    echo"<a href=\"student.php\">back to panel</a>";
    exit();
}

////////////////////////////////////////////
$submission_table = $assignment_table."_".$assignmentid."_submission";
if(isset($submit)){

    $target_dir = "../attachments/$group/$sid/assignments/$assignmentid";
    $extension = pathinfo($_FILES["attachment"]["name"],PATHINFO_EXTENSION);
    $target_file = $target_dir ."/".$student_id.".".$extension;
    $uploadOk = 1;


if($extension!=""){

// Check if file already exists
if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOk = 0;
}

// Check file size
if ($_FILES["attachment"]["size"] > 5000000) {
echo "Sorry, your file is too large.";
$uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
echo "The file ". basename( $_FILES["attachment"]["name"]). " has been uploaded.";
$query3="insert into ".$submission_table." (assignment_id,submission_attachment,student_id,submission_time) VALUES ('$assignmentid','$target_file','$student_id',now())";
$rs3 = mysqli_query($con,$query3)or die("cannot submit");
header("location:assignments.php?sid=$subjectid");

} else {
echo "Sorry, there was an error uploading your file.";
}
}
}

}


/////////////////////////////////////////////


?>



<!doctype html>
<html lang="en">
  <head>
  	<title>Submit assignment</title>
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
            
            <li>
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Classrooms</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                
    <?php
        $subjecttable1 = $group."_subjects";
        $query24="select * from ".$subjecttable1;
        $rs24 = mysqli_query($con,$query24) or die("cannot find subject table");
        while($row24=mysqli_fetch_row($rs24)){
            $subjectid2 = $row24[0];
            echo"<li><a href=\"classroom.php?sid=$subjectid2\">".$row24[1]."</a></li>"; 
        }
    ?>
                
                </ul>
    </li>
    <li><?php echo"<a href=\"classroom.php?sid=$subjectid\">Posts</a>"; ?></li>
    <li><a href="../resources/index2.html">learning resources</a> </li>
               
    <li><a href="student.php">Student Panel</a></li>
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

<?php
        $data = $rs1->fetch_assoc();
        $title = $data['assignment_title'];
        $detials = $data['assignment_details'];
        $link = $data['assignment_attachment'];
        $lastdate = $data['assignment_deadline'];
        echo"<h2>Title - ".$title."</h2>";
        echo"<h2>Details - ".$detials."</h2>";
        echo"<h2>Deadline - ".$lastdate."</h2>";
        echo"<h2><a href=\"$link\" target=\"_blank\">attachment</a></h2><br><br>";
        
        //echo $submission_table;
        $query2="select * from ".$submission_table." where student_id = '$student_id'";
        $rs2=mysqli_query($con,$query2)or die("cannot perform check query");

        if(mysqli_num_rows($rs2)>0){
            echo"<br>assignment already submitted<br>";
        }else{
            echo"
            
            <form class=\"form-contact contact_form\" action=\"submitassignment.php?sid=$subjectid&aid=$assignmentid\" method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"col-12\">
            <div class=\"form-group\">
            <input class=\"form-control\" type=\"file\" name=\"attachment\" id=\"attachment\" required></div></div>
        <br><br>
        <button class=\"button button-contactForm boxed-btn\" type=\"submit\" name=\"submit\" value=\"submit\">submit assignment</button>
    </form>
            
            
            ";
        }
    ?>

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






