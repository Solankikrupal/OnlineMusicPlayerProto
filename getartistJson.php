<?php

include("connect.php");

if (isset($_POST['artistid'])) {

	# code...

	$artistid = $_POST['artistid'];

	$query = mysqli_query($con,"SELECT * FROM Artist WHERE id = '$artistid'");
	$queryResult = mysqli_fetch_array($query);
	echo json_encode($queryResult);
}

?>