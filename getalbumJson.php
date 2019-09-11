<?php

include("connect.php");

if (isset($_POST['albumid'])) {

	# code...

	$albumid = $_POST['albumid'];

	$query = mysqli_query($con,"SELECT * FROM Album WHERE id = '$albumid'");
	$queryResult = mysqli_fetch_array($query);
	echo json_encode($queryResult);
}

?>