<?php
	error_reporting(E_ALL);
		
	$con= mysqli_connect("localhost","root","","Spotify");
	if(!$con)
	{
		die("connection failed:".mysqli_connect_error());
	}	
	else
	{
		//echo "connected successfully";
		mysqli_select_db($con,"Spotify");
		if (!mysqli_select_db($con,"Spotify")) 
		{
			# code...
			die("uh oh ,couldnt connected");
		}
	}

?>