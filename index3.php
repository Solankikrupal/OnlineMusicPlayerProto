<?php
include ('header.php')
?>

<h1 class="pageBigHeading">You also might Like</h1>
<div class="gridViewContainer">
	<?php
		include 'connect.php';
		$albumquery=mysqli_query($con, "SELECT * FROM Album ORDER BY RAND() LIMIT 3" );
		while ($row = mysqli_fetch_array($albumquery)) {
			# code...
			//echo $row['name']. "<br>";
			echo "<div class = 'gridalbumview'>
					<img src =".$row['artworkPath'].">
						<div class='gridnameview'>
							".$row['name']."; 
					</div>";
		}
	?>
</div>

<?php
include('footer.php')
?>