<?php

include('connect.php');


if (isset($_POST['songid'])) {
	# code...
	$songid = $_POST['songid'];
}
$query=mysqli_query($con,"SELECT * from songs WHERE id = '$songid'");
	$resultquery = mysqli_fetch_array($query);
	echo json_encode($resultquery);

?>