<?php
	session_start();
	$conn = new mysqli($_SESSION['servername'], $_SESSION['username'], $_SESSION['password']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$useDb = "USE seniorHelp";
	$conn->query($useDb);
	$getService = "SELECT serviceName, serviceDescription, pictureURL FROM service WHERE serviceName = '".$_GET["service"]."';";
	$serviceDetail = $conn->query($getService);
	while($row = $serviceDetail->fetch_assoc()){
		$serviceName = $row["serviceName"];
		$serviceDesc = $row["serviceDescription"];
		$servicePic = $row["pictureURL"];
	}
	if (isset($_SESSION["UserName"])){
	$getBooking = "SELECT dateReqFrom, dateReqTo, note, status FROM Booking WHERE user = '".$_SESSION["UserName"]."' AND
	service = '".$_GET["service"]."' ORDER BY date DESC";
	$getBooking = $conn->query($getBooking);
	$getReview = "SELECT * FROM Review WHERE user = '".$_SESSION["UserName"]."' AND service = '".$_GET["service"]."';";
	$review = $conn->query($getReview);
	}
	$getAllReview = "SELECT * FROM Review WHERE service = '".$_GET["service"]."' ORDER BY date DESC;";
	$allReview = $conn->query($getAllReview);
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
	<link rel="stylesheet" href="css/serviceDetail.css">
	<style>
		.checked{
	color:orange;
}
	</style>
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
	<section class="site-section element-animate">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-md-2">
            <div class="block-16">
              <figure>
                <img src="<?php echo $servicePic; ?>" alt="Image placeholder" class="img-fluid">
              </figure>
            </div>
          </div>
          <div class="col-md-6 order-md-1">

            <div class="block-15">
              <div class="heading">
                <h2><?php echo $serviceName; ?></h2>
              </div>
              <div class="text mb-5">
              <p><?php echo $serviceDesc; ?></p>
              </div>  
			  <div class="bg-light p-4 mb-2">
				<div class="col-md-12">
				<?php if (isset($_SESSION["UserName"]) && $getBooking->num_rows > 0 ){
						$row = $getBooking->fetch_assoc();
						$notes = "";
						$updateMsg = "";
						if (isset($_SESSION["updateBooking"]) && $_SESSION["updateBooking"] === true){
							$_SESSION["updateBooking"] = false;
							echo "<div class=\"alert alert-success alert-dismissible pb-0\"><button type = \"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p style=\"text-transform: uppercase;\">Booking changes is saved</p></div>";
						}
						if (isset($_SESSION["review"])  && $_SESSION["review"] === true){
							$_SESSION["review"] = false;
							echo "<div class=\"alert alert-success alert-dismissible pb-0\"><button type = \"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p style=\"text-transform: uppercase;\">Thank you for your review</p></div>";
						}
						if ($row["note"] != "")
							$notes = "Note/Additional Request: ".$row["note"];
						echo "<div id=\"bookingDiv\" class=\"row\"><div class=\"col-md-12\">
						<p>You have booked this service from ".$row["dateReqFrom"]." to ".$row["dateReqTo"]."<br>".$notes."</p></div>";
						echo "<div class=\"col-md-12\"><p onclick=\"makeChanges()\" class=\"btn btn-primary py-2 px-4\">
						Make changes</p></div></div>";
						echo "<div class=\"row mb-3\"><div class=\"col-md-12\"><form action=\"".$_SERVER['REQUEST_URI']."\" 
						method=\"post\" onsubmit=\"return booking()\">";
						}
					  else{
						  echo "<form action=\"booking.php?service=".$serviceName."\"
						  method=\"post\" onsubmit=\"return booking()\">";
					  }
				?>
                <div class="row mb-2">
                  <div class="col-md-6 form-group">
					<span class="icon ion-android-calendar mr-2"></span><label>Required from*</label>
                    <input type="date" id="dateFrom" name="dateFrom" class = "form-control" <?php 
					if (isset($row["dateReqFrom"])) 
						echo "value = \"".$row["dateReqFrom"]."\""; ?> onchange="dateFromSelect()">
					<p class="msg errorMsg">&#10007;<small> Please enter date</small></p>
                  </div>
                  <div class="col-md-6 form-group">
					<span class="icon ion-android-calendar mr-2"></span><label>To*</label>
                    <input type="date" id="dateTo" name="dateTo" class = "form-control" <?php 
					if (isset($row["dateReqTo"])) 
						echo "value = \"".$row["dateReqTo"]."\""; ?> onchange="dateToSelect()">
					<p class="msg errorMsg">&#10007;<small> Please enter date</small></p>
                  </div>
                </div>
				<div class="row mb-2">
					<div class = "col-md-12 form-group">
						<span class="icon ion-edit mr-2"></span><label>Note/Additional Request</label>
						<textarea type="text" id="note" name="note" placeholder="" class = "form-control" rows="2"><?php 
					if (isset($row["note"])) 
						echo $row["note"];
					?></textarea>
					</div>
				</div>
				<p><small>* required</small></p>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="submit" value="<?php 
					if (isset($_SESSION["UserName"]) && $getBooking->num_rows > 0) 
						echo "Save Changes";
					else
						echo "Book an Appointment";
					?>" class="btn btn-primary px-5 py-2">
                  </div>
                </div>
					
				</form>
				</div>
				</div>
				<?php
					if (isset($_SESSION["UserName"]) && $getBooking->num_rows > 0){
						$reviewStr = "";
						if (isset($review->num_rows) && $review->num_rows > 0)
							$reviewStr = "d-none";
						echo "<div id = \"reviewDiv\" class=\"row ".$reviewStr."\"><div class=\"col-md-12\"><p>Tell Others What You Think
						</p></div>";
						echo "<div class=\"col-md-12\"><p onclick=\"review()\" class=\"btn btn-primary py-2 px-4\">Make review
						</p></div></div>";
					}
				?>
				<div class="row mb-3">
					<div class = "col-md-12">
					<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" onsubmit="return submitReview()">
						<label>Tell Others What You Think</label>
						<div class = "row mb-2">
							<div class = "col-md-12 form-group">
								<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" checked="true"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
</fieldset>
							</div>
						</div>
						<div class="row mb-2">
							<div class="col-md-12">
								<textarea type="text" id="comment" name="comment" placeholder="Comment*" class = "form-control" rows="2"></textarea>
								<p class="msg errorMsg">&#10007;<small> Please enter comment</small></p>
							</div>
						</div>
						<p><small>* required</small></p>
						<div class="row">
							<div class="col-md-12 form-group">
								<input type="submit" value="Submit" class="btn btn-primary px-5 py-2">
							</div>
						</div>
					</form>
					</div>
					</div>
				</div>			  
				</div>
				</div>
          </div>
          
        </div>

      </div>
    </section>
    <!-- END section -->
	
	<section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="block-15">
              <div class="heading">
				<?php if (isset($allReview->num_rows) && $allReview->num_rows > 0)
						echo "<h2>What others think about this service</h2>";
					?>
              </div>
			  <?php if (isset($allReview->num_rows) && $allReview->num_rows > 0){
						while ($row = $allReview->fetch_assoc()){
							
							echo "<div class=\"text mb-5\"><p><span class=\"icon ion-person mr-2\"></span>".$row["user"]."</p>".str_repeat("<span class=\"fa fa-star checked\">&nbsp;&nbsp;
							</span>",($row["rating"])).str_repeat("<span class=\"fa fa-star\">&nbsp;&nbsp;</span>",(5-$row["rating"]))."<span>&nbsp;&nbsp;".$row["date"]."
							</span><p>".$row["comments"]."</p><hr></div>";
						}
			  }
			  ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
	
    <footer class="site-footer border-top bg-light">
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
			if (isset($_POST["dateFrom"]) && isset($_POST["dateTo"])){
			$updateBooking = "UPDATE Booking SET dateReqFrom = '".$_POST["dateFrom"]."',dateReqTo = '".$_POST["dateTo"]."', note = '".$_POST["note"]."' 
			WHERE service = '".$serviceName."' AND user = '".$_SESSION["UserName"]."';";
			$conn->query($updateBooking);
			$_SESSION["updateBooking"] = true;
			$updateNote = "";
			if ($_POST["note"] != "")
				$updateNote = "Note/Additional Request: ".$_POST["note"];
			echo "<script>var bookDiv = document.getElementById(\"bookingDiv\"); 
			bookDiv.innerHTML = \"<p>You have booked this service from ".$_POST["dateFrom"]." to ".$_POST["dateTo"]."<br>".$updateNote."</p><p onclick='makeChanges()' class='btn btn-primary py-2 px-4'>Make changes</p>\";</script>";
			}
			if (isset($_POST["comment"])){
				$inReview = $conn->prepare("INSERT INTO review(user, rating, comments, service, date) VALUES (?,?,?,?,?);");
				$inReview->bind_param("sssss",$_SESSION["UserName"],$_POST["rating"], $_POST["comment"],$_GET["service"],$date);
				$date = date("Y-m-d");
				$inReview->execute();
				$inReview->close();
				$_SESSION["review"] = true;
			}
			echo "<script>window.open('".$_SERVER['REQUEST_URI']."', '_self');</script>";
			
		}
		$str = "";
		if ($getBooking->num_rows > 0 ){
			$str = "style.display = \"none\"";
			echo "<script>var form = document.getElementsByTagName(\"form\");var bookDiv = document.getElementById(\"bookingDiv\");
var reviewDiv = document.getElementById(\"reviewDiv\"); var errorMsg = document.getElementById(\"errorMsg\");
var comment = document.getElementById(\"comment\"); form[0].".$str.";form[1].".$str.";
function makeChanges(){
	bookDiv.style.display = \"none\";
	form[0].style.display = \"block\";
}

function review(){
	reviewDiv.style.display = \"none\";
	form[1].style.display = \"block\";
}

comment.onkeyup  = function(){
	if (comment.value != \"\"){
		errorMsg[2].style.display = \"none\";
		comment.style.border = \"1px solid lightgrey\";
	}
}

function submitReview(){
	if (comment.value == \"\"){
		errorMsg[2].style.display = \"block\";
		comment.style.border = \"1px solid red\";
		comment.focus();
		return false;
	}
}</script>";
		}
			
	?>
	<script src="js/booking.js"></script>
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