<?php

inclued('connect.php')

$result="INSERT INTO songs(id,title,artist,album,genre,duration,paths,albumOrder,plays) 
VALUES(1,'Bad Guy',1,1,1,'3:14','icons/music/pop/Bad Guy (Billie Eilish).mp3',1,12)";

if (mysqli_query($con,$result)) {
	# code...
	 echo ("<script language='javascript'>
			   window.alert('New Record created successfully')
			   window.location.href('index.html');</script>");
}
?>