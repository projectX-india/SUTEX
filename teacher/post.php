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
<?php

if(isset($submit)){
    $post_table_name = $gid_decrypted."_".$sid."_post";
    $details = nl2br($details);
    $details = str_replace("'","&apos;",$details);
    $title = str_replace("'","&apos;",$title);
    $query5 = "insert into ".$post_table_name." (post_title,post_details,post_attachment,post_date) VALUES ('$title','$details','',now()) ";
    $rs5 = mysqli_query($con,$query5) or die ("problem");
    $post_id = mysqli_insert_id($con);
    ///////////////////////////
    
$target_dir = "../attachments/$gid_decrypted/$sid/posts";
$extension = pathinfo($_FILES["attachment"]["name"],PATHINFO_EXTENSION);
$target_file = $target_dir ."/".$post_id.".".$extension;
$uploadOk = 1;


if($extension!=""){
  $query6="UPDATE ".$post_table_name." SET post_attachment='$target_file' where post_code='$post_id'";
$rs6 = mysqli_query($con,$query6) or die("cannot perform");
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
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
    
    ///////////////////////////
    
header("location:classroom.php?id=$gid&sid=$sid");

}

?>




<!doctype html>
<html lang="en">
  <head>
  	<title>post assignment</title>
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
              <?php
echo"<a href=\"classroom.php?id=$gid&sid=$sid\">back</a>";

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
                    <h2 class="contact-title">New Post</h2>
                </div>
                <div class="col-lg-8">
                <form class="form-contact contact_form" action="<?php echo"post.php?id=$gid&sid=$sid"; ?>" method="post" enctype="multipart/form-data">
                
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name = "title" onfocus="this.placeholder = ''" onblur="this.placeholder = 'notice title'" placeholder="notice title" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control"  name="details" id="details" cols="80" rows="4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'assignment details'" placeholder="assignment details"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" type="file" name="attachment" id="attachment">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" name="submit" value="add" class="button button-contactForm boxed-btn">Post Notice</button>
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










