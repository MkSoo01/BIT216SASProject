<?php
	session_start();
	$conn = new mysqli($_SESSION['servername'], $_SESSION['username'], $_SESSION['password']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$useDb = "USE seniorHelp";
	$conn->query($useDb);
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
		$insertBooking = $conn->prepare("INSERT INTO Booking(user, service, dateReqFrom, dateReqTo, note, date, status) VALUES(?,?,?,?,?,?,?);");
		$insertBooking->bind_param("sssssss",$_SESSION["UserName"],$_GET["service"],$dateFrom,$dateTo,$note, $date, $status);
		$status = "PENDING";
		$dateFrom = $_POST["dateFrom"];
		$dateTo = $_POST["dateTo"];
		$date = date("Y-m-d");
		$note = "";
		if (isset($_POST["note"]) && $_POST["note"] != "")
			$note = $_POST["note"];
		if (isset($_SESSION['bookingSv'])){
			$dateFrom = $_SESSION['dateFrom'];
			$dateTo = $_SESSION['dateTo'];
			$note = $_SESSION['note'];
		}
		$insertBooking->execute();
		$insertBooking->close();
		$_SESSION["booking"] = true;
		header("location: profile.php");
		exit;
	}else{
		$_SESSION['bookingSv'] = $_GET["service"];
		$_SESSION['dateFrom'] = $_POST['dateFrom'];
		$_SESSION['dateTo'] = $_POST['dateTo'];
		$_SESSION['note'] = $_POST['note'];
		header("location: login.php");
		exit;
	}
	$conn->close();
?>