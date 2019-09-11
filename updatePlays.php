<?php

include('connect.php');


if (isset($_POST['songid'])) {
	# code...
	$songid = $_POST['songid'];
}
$query=mysqli_query($con,"UPDATE songs set plays = plays + 1 WHERE id = '$songid'");
	

?>