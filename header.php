<?php
include ("connect.php");
//session_destroy();
/*if (isset($_SESSION['userLoggedIn'])) 
{
	# code...
	$userLoggedIn = $_SESSION['userLoggedIn'];
	echo "<script>userLoggedIn = '$userLoggedIn';</script>";
}
else
{
	header("Location:login.php");
}*/
?>


<!DOCTYPE html>
<html>
<head>
	
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="audio.js"></script>
</head>
<body>
	
	<div id="mainContainer">
		<div id="topContainer">
			<!-- navBar-->
			<?php
			include("navContainer.php");
			?>
			<!--end navBar-->
			<div id="mainViewContainer">
				<div id="mainContent">
			