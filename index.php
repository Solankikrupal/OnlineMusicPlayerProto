<?php include ("header.php"); ?>
					<h1 class="pageBigHeading">You also might Like</h1>
					<div class="gridViewContainer" >
						<?php
							include 'connect.php';
							$albumquery=mysqli_query($con, "SELECT * FROM Album ORDER BY RAND() LIMIT 8" );
							while ($row = mysqli_fetch_array($albumquery)) 
							{
			# code...
							#echo $row['name']. "<br>";
							echo "<div class= 'gridViewItem'>
								<a href='album.php?id=".$row['id']."'>
								<img src = '".$row['artworkPath']."'>
								<div class = 'gridViewInfo'>
									".$row['name']."
								</div>
								</a>
							</div>"
							;
							}

						?>
					</div>
<?php include("footer.php") ?>
				