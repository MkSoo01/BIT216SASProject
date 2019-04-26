<?php
	session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>SeniorHelp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="icons/icon.png"/>
    <!-- Theme Style -->
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    
    <header role="banner">
     
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand absolute" href="index.php">SeniorHelp</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link active" href="about-us.php">About Us</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="ourServices.php">Our Services</a>
              </li>
			  <?php
				if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
					echo "<li class=\"nav-item\">
						<a class=\"nav-link\" href=\"profile.php\">My Profile</a>
						</li>";
				}
			  ?>
            </ul>
            <ul class="navbar-nav absolute-right">
				<?php
					if (isset($_SESSION["loggedin"])){
						echo "<li>Logged in as ".$_SESSION['UserName']."
						<a href=\"logout.php\">(logout)</a></li>";
					}else{
						echo "<li>
						<a href=\"login.php\">Login</a> / <a href=\"sign-up.php\">Register</a>
						</li>";
					}
			  ?>
            </ul>
            
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->

    <section class="site-hero sm-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(pic/seniorHelpBg.jpg);">
      <div class="container">
        <div class="row align-items-center justify-content-center sm-inner">
          <div class="col-md-7 text-center">
  
            <div class="mb-5 element-animate">
              <h1 class="mb-2">About Us</h1>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
	
	<section class="site-section element-animate mb-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-md-2">
            <div class="block-16" id="content">
              <figure>
                <img src="pic/about-us.jpg" alt="Image placeholder" class="img-fluid">

                <!-- <a href="https://vimeo.com/45830194" class="button popup-vimeo" data-aos="fade-right" data-aos-delay="700"><span class="ion-ios-play"></span></a> -->

              </figure>
            </div>
          </div>
          <div class="col-md-6 order-md-1">

            <div class="block-15">
              <div class="heading">
                <h2>About Us</h2>
              </div>
              <div class="text mb-5">
              <p class="mb-4">SeniorHelp website is established in 2018. The main purposes of this website is to help people with their daily tasks. 
					We deliver services to people who are in needs especially senior.</p>
              </div>              
            </div>

          </div>
          
        </div>

      </div>
    </section>

	
    <div class="site-section bg-light">
      <div class="container">
		<div class="row">
			<div class = "col-md-8">
				<h2 class="heading">Have Professional Services You Can Trust</h2>
				<div class="text mb-5">
					<p>SeniorHelp website is established in 2018. The main purposes of this website is to help people with their daily tasks. 
					We deliver services to people who are in needs especially senior. </p>
				</div>
			</div>
			<div class = "col-md-8">
				<h3 class="heading">Our Mission</h3>
				<div class="text mb-5">
					<p>To provide services to people where it will lead them to have a comfort zone anytime,anywhere.</p>
				</div>
			</div>
			<div class = "col-md-8">
				<h4 class="heading">Our Services</h4>
				<div class="text mb-5">
					<li>Home Cleaning</li>
					<li>House and Pet Sitting</li>
					<li>In-Home Nursing Care</li>
					<li>Meals Preparation</li>
					<li>Nursing Care</li>
					<li>Transportation</li>
				</div>
			</div>
		</div>
        <div class="row"> 
          <div class="col-md-12">
            <div class="row">              
            </div>
          </div>
          <!-- END content -->
        </div>
      </div>
    </div>
  
    <footer class="site-footer">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <h3>SeniorHelp</h3>
            <p>A website where you can find various trusted and reliable services in just one search.</p>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <h3 class="heading">Quick Link</h3>
            <div class="row">
              <div class="col-md-6">
                <ul class="list-unstyled">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="about-us.php">About us</a></li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-unstyled">
                  <li><a href="ourServices.php">Our Services</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <h3 class="heading">Join Us</h3>
            <div class="block-21 d-flex mb-4">
              <div class="text">
                <h3 class="heading mb-0">Become a service provider</h3>
                <div class="meta">
					<small>Please contact us via email.</small>
                </div>
              </div>
            </div> 		
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <h3 class="heading">Contact Information</h3>
            <div class="block-23">
              <ul>
                <li><span class="icon ion-android-pin"></span><span class="text">15, Jalan Sri Semantan 1, Damansara Heights, 50490 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</span></li>
                <li><span class="icon ion-ios-telephone"></span><span class="text">+60 14-338 7456 &nbsp; +60 16-3072716</span></li>
                <li><span class="icon ion-android-mail"></span><a href="mailto:kingdom@hotmail.com"><span class="text wrap">kingdom@hotmail.com</span></a>
				<a href="mailto:khimsoo@gmail.com"><span class="text">khimsoo@gmail.com</span></a></li>
                <li><span class="icon ion-android-time"></span><span class="text">Monday &mdash; Friday 8:00am - 5:00pm</span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row pt-5">
          <div class="col-md-12 text-center copyright">
            
            <p class="float-md-left"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
			<div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
          </div>
        </div>
      </div>
    </footer>
    <!-- END footer -->
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			echo "<script>document.getElementById(\"searchProgramme\").focus();</script>";
		}		
	?>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>

    <script src="js/main.js"></script>
  </body>
</html>