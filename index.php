<?php
	session_start();
	$_SESSION['servername'] = "localhost";
	$_SESSION['username'] = "root";
	$_SESSION['password'] = "";
	$conn = new mysqli($_SESSION['servername'], $_SESSION['username'], $_SESSION['password']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$createDb = "CREATE DATABASE seniorHelp";
	$conn->query($createDb);
	$useDb = "USE seniorhelp";
	$conn->query($useDb);
	$createSvTable = "CREATE TABLE service (serviceName VARCHAR(50) PRIMARY KEY, serviceDescription VARCHAR(500) NOT NULL, pictureURL VARCHAR(200) NOT NULL);";
	$conn->query($createSvTable);
	$createUserTb = "CREATE TABLE user (username VARCHAR(50) PRIMARY KEY, 
	password VARCHAR(25) NOT NULL, name VARCHAR(50) NOT NULL, contactNo VARCHAR(20) NOT NULL, 
	email VARCHAR(40) NOT NULL, address VARCHAR (150) NOT NULL);";
	$conn->query($createUserTb);
	$createBookingTb = "CREATE TABLE booking (user VARCHAR(50), 
	service VARCHAR(50) NOT NULL, dateReqFrom DATE NOT NULL, dateReqTo DATE NOT NULL, note VARCHAR(200), date DATE NOT NULL, status VARCHAR(20) NOT NULL,
	PRIMARY KEY(user, service), FOREIGN KEY (user) REFERENCES User(username), 
	FOREIGN KEY (service) REFERENCES Service (serviceName));";
	$conn->query($createBookingTb);
	$createReviewTb = "CREATE TABLE review (user VARCHAR(50), rating INT, comments VARCHAR(100), service VARCHAR(50), date DATE,
	PRIMARY KEY(user, service), FOREIGN KEY(user) REFERENCES User(username), FOREIGN KEY(service) REFERENCES Service(serviceName));";
	$conn->query($createReviewTb);
	$inAllSv = $conn->prepare("INSERT INTO service(serviceName, serviceDescription, pictureURL) VALUES(?,?,?)");
	$inAllSv->bind_param("sss", $serviceName, $serviceDesc, $pic);
	$serviceName ="House and Pets Sitting";
	$serviceDesc = "We enjoy looking after your house and pet. Our insights are unrivalled, which in turn, has helped us to shape the most trusted house & pet sitting service";
	$pic = "pic/daily-visit-dog-and-cat.jpg";
	$inAllSv->execute();
	$serviceName ="Meals Preparation";
	$serviceDesc = "A nutritious diet comes with many health benefits. Our caregivers love to prepare delicious meals, including specific ethnic dishes if requested.";
	$pic = "pic/healthy-cooking.jpg";
	$inAllSv->execute();
	$serviceName ="Home Cleaning";
	$serviceDesc = "We offer light housekeeping services to help our clients with daily activities. This way, seniors can stay at home in a safe and clean environment.";
	$pic = "pic/Home-Cleaning-Service-in-KL.jpg";
	$inAllSv->execute();
	$serviceName ="Personal Care";
	$serviceDesc = "We design personal senior care such as bathing, grooming, dressing to support day-to-day independence. In a way you are most comfortable with.";
	$pic = "pic/Caregiver+brushing+a+clients+hair.jpg";
	$inAllSv->execute();
	$serviceName ="Transportation";
	$serviceDesc = "Without reliable transportation, it can be tough to get to activities. We arrange transportation and accompaniment with a friendly and attentive caregiver.";
	$pic = "pic/transportImg2.jpg";
	$inAllSv->execute();
	$serviceName ="In-Home Nursing Care";
	$serviceDesc = "For optimal health, our Registered Nurses and Licensed/Registered Practical Nurses help prevent illness and increase comfort at home.";
	$pic = "pic/home health aide.jpg";
	$inAllSv->execute();
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
    <link rel="stylesheet" href="css/magnific-popup.css">
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
                <a class="nav-link active" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about-us.php">About Us</a>
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
    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(pic/seniorHelpBg.jpg);">
      <div class="container">
        <div class="row align-items-center justify-content-center site-hero-inner">
          <div class="col-md-10">
  
            <div class="mb-5 element-animate">
              <div class="block-17">
                <h2 class="heading text-center mb-4">Apply For Services That Ease You</h2><!--
                <form action="" method="post" class="d-block d-lg-flex mb-4">
                  <div class="fields d-block d-lg-flex">
                    <div class="textfield-search one-third"><input type="text" class="form-control" placeholder="Keyword search..."></div>
                    <div class="select-wrap one-third">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="" class="form-control">
                        <option value="">Category Course</option>
                        <option value="">Laravel</option>
                        <option value="">PHP</option>
                        <option value="">JavaScript</option>
                        <option value="">Python</option>
                      </select>
                    </div>
                    <div class="select-wrap one-third">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="" class="form-control">
                        <option value="">Difficulty</option>
                        <option value="">Beginner</option>
                        <option value="">Intermediate</option>
                        <option value="">Advance</option>
                      </select>
                    </div>
                  </div>
                  <input type="submit" class="search-submit btn btn-primary" value="Search">  
                </form>-->
                <p class="text-center mb-5">We provide various services to help you in everyday life.</p>
                <p class="text-center"><a href="sign-up.php" class="btn py-3 px-5">Register Now</a></p>
				
              </div>
			  
            </div> 
          </div>
		  
        </div>
		<div id="scrollDown" class="text-center">
					<a href="#content" style="color:white;"><span></span>View More</a>
			</div>
      </div>
    </section>
    <!-- END section -->

    <section class="site-section element-animate" id="content">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-md-2">
            <div class="block-16">
              <figure>
                <img src="pic/welcome-picture.jpg" alt="Image placeholder" class="img-fluid">

                <!-- <a href="https://vimeo.com/45830194" class="button popup-vimeo" data-aos="fade-right" data-aos-delay="700"><span class="ion-ios-play"></span></a> -->

              </figure>
            </div>
          </div>
          <div class="col-md-6 order-md-1">

            <div class="block-15">
              <div class="heading">
                <h2>Welcome to SeniorHelp</h2>
              </div>
              <div class="text mb-5">
              <p class="mb-4">We provide various services in one website to help and ease your burdens.
			  We put your convenient as our top priority to help you save as much precious time as possible.</p>
			  <p><a href="about-us.php" class="btn btn-primary py-2 px-4">View More ></a></p>
              </div>              
            </div>

          </div>
          
        </div>

      </div>
    </section>
    <!-- END section -->

    <section class="site-section bg-light element-animate" id="section-counter">
      <div class="container">
        <div class="row pb-5">
          <div class="col-lg-6">
            <figure><img src="pic/helping-elderly-parents.jpg" alt="Image placeholder" class="img-fluid"></figure>
          </div>
          <div class="col-lg-5 ml-auto">
            <div class="block-15">
              <div class="heading">
                <h2>Provide Care like Family</h2>
              </div>
              <div class="text mb-5">
                <p>Our caregiver service providers specialised care for your elderly. We consists of a team of friendly and expert professionals with flexible service hours.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5 element-animate">
          <div class="col-md-7 text-center section-heading">
            <h2 class="heading">Popular Services</h2>
			<p>Here we have few of the most popular, and highly demanded services in Malaysia waiting for you.</p>
            <p><a href="ourServices.php" class="btn btn-primary py-2 px-4"><span class="mr-2"></span>View Services</a></p>
          </div>
        </div>
      </div>
        <section class="site-section pt-5 pb-4 element-animate bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="media block-6 d-block">
              <div class="icon mb-3"><a href="serviceDetail.php?service=House and Pets Sitting"><img src="pic/dogs.png" alt="Image placeholder" class="img-fluid"></a></div>
              <div class="media-body">
                <h3 class="heading"><a class="serviceLink" href="serviceDetail.php?service=House and Pets Sitting">House & Pets Sitting</a></h3>
                <p>We match your pet to our trusted and well-trained pet sitter we have to offer.</p>
              </div>
            </div> 
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="media block-6 d-block">
              <div class="icon mb-3"><a href="serviceDetail.php?service=Meals Preparation"><img src="pic/breakfast.png" alt="Image placeholder" class="img-fluid"></a></div>
              <div class="media-body">
                <h3 class="heading"><a class="serviceLink" href="serviceDetail.php?service=Meals Preparation">Meals Preparation</a></h3>
                <p>Pick your food, we cook and deliver time saving prep meals at your convenience.</p>
              </div>
            </div> 
          </div>
          
          <div class="col-md-6 col-lg-3">
            <div class="media block-6 d-block">
              <div class="icon mb-3"><a href="serviceDetail.php?service=Home Cleaning"><img src="pic/washing-machine2.png" alt="Image placeholder" class="img-fluid"></a></div>
              <div class="media-body">
                <h3 class="heading"><a class="serviceLink" href="serviceDetail.php?service=Home Cleaning">Home Cleaning</a></h3>
                <p>Need a reliable cleaning service? We deliver trained cleaners within an hour.</p>
              </div>
            </div> 
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="media block-6 d-block">
              <div class="icon mb-3"><a href="serviceDetail.php?service=Personal Care"><img src="pic/handshake.png" alt="Image placeholder" class="img-fluid"></a></div>
              <div class="media-body">
                <h3 class="heading"><a class="serviceLink" href="serviceDetail.php?service=Personal Care">Personal Care</a></h3>
                <p>We provide personal care to your house using qualified caregivers. Reliable and hassle free.</p>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </section>
    <!-- END section --> 
    </div>
    <!-- END section -->
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

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>