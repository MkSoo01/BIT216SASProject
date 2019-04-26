<?php
	session_start();
	$conn = new mysqli($_SESSION['servername'], $_SESSION['username'], $_SESSION['password']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$useDb = "USE seniorHelp";
	$conn->query($useDb);
	$_SESSION['loggedin'] = false;
		$findUser = $conn->prepare("SELECT * FROM User WHERE username = ? AND password = ?;");
		$findUser->bind_param("ss",$_POST["username"],$_POST["password"]);
		$findUser->execute();
		$findUser->store_result();
		if($findUser->num_rows == 1){
			$findUser->close();
			$_SESSION['loggedin'] = true;
			$_SESSION['UserName'] = $_POST["username"];
			$directPage = 'profile.php';
			if (isset($_SESSION['bookingSv']))
				$directPage = "booking.php?service=".$_SESSION["bookingSv"];
		}else{
			$directPage = "login.php";
		}
	echo "<script>window.open('".$directPage."','_self')</script>";
	$conn->close();
?>