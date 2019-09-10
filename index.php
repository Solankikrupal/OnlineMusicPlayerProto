<!DOCTYPE html>
<html>
<head>
	
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div id="mainContainer">
		<div id="topContainer">
			<!-- navBar-->
			<div id="navContainer">
				
				<nav class="navBar">
					<a href="index.html" class="logo">
						<img src="icons/logohappen.png">
						<h4>Spotify</h4>
					</a>
				</nav>
				<div class="group">
					<div class="navGroup">
						<a href="search.php" class="navItem">Search
							<img src="icons/search.png">
						</a>

					</div>
				</div>
				<div class="group">
					<div class="navGroup">
						<a href="search.php" class="navItem">Browse</a>
					</div>
					<div class="navGroup">
						<a href="search.php" class="navItem">Your Song</a>
					</div>
					<div class="navGroup">
						<a href="search.php" class="navItem">Krupal Solanki</a>
					</div>
				</div>
			</div>
			<!--end navBar-->
			<div id="mainViewContainer">
				<div id="mainContent">
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
				</div>
			</div>
			


	<div id="nowplayingBarContainer">
		<div id="nowplayingBars">
			<div id="nowplayingleft">
				<div class="content">
					<span class="albumlink">
						<img src="album_pic.jpg" class="album_pic">
					</span>
					<div class="trackInfo">
					<span class="trackName"> 
						<span>Sucker </span>
					</span>
					<span class="artistName"> 
						<span>Jonas Brother </span>
					</span>
					</div>	
				</div>
			</div>

			<div id="nowplayingcenter">
				<div class="content playingbar">
					<div class="button">
						<button class="controlButton shuffle" title="Shuffle button">
						<img src="icons/shuffle.png" alt="Shuffle">
						</button>
						<button class="controlButton previous" title="Previous button">
						<img src="icons/previous.png" alt="Previous">
						</button>
						<button class="controlButton play" title="Play button">
						<img src="icons/play.png" alt="Play">
						</button>
						<button class="controlButton pause" title="Pause button" style="display: none;">
						<img src="icons/pause.png" alt="Pause">
						</button>
						<button class="controlButton next" title="Next button">
						<img src="icons/next.png" alt="Next">
						</button>
						<button class="controlButton repeat" title="Repeat button">
						<img src="icons/repeat.png" alt="Repeat">
						</button>
					</div>
					<div class="playingbackbar">
						<span class="progressTime current">0:00</span>
						<div class="progressBars">
							<div class="progressbgbar">
								<div class="progress"></div>
							</div>
						</div>
						<span class="progressTime remaing">0:00</span>
					</div>
				</div>
			</div>	

			<div id="nowplayingright">
				<div class="volumeBars">
					<button class="controlButton volume" title="Volume">
							<img src="icons/volume.png" alt="volume">
					</button>
				
				<div class="progressBars">
							<div class="progressbgbar">
								<div class="progress"></div>
							</div>
						</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

</body>
</html>