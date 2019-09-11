<?php

include("connect.php");

$songList = mysqli_query($con,"SELECT id FROM songs ORDER BY RAND() LIMIT 8");
$resultArray = array();
while ($row = mysqli_fetch_array($songList))
 	{
	# code...
	array_push($resultArray, $row['id']);
	}
$arrayJson = json_encode($resultArray);
?>
<script>
		
		$(document).ready(function(){
			currentPlaylist= <?php echo $arrayJson; ?>;
			audioElement = new Audio();
			setTrack(currentPlaylist[0],audioElement,false);
		$(".playingbackbar .progress").mousedown(function(){
			mouseDown = true;
		});

		$(".playingbackbar .progress").mouseup(function(e){
			timeFromOffset = (e,this);
		});

		$(".playingbackbar .progress").mousemove(function(e){
			if (mouseDown = true) {
				timeFromOffset = (e,this);		
			}
		});

		$(document).mouseup(function(){
			mouseDown = false;
		});

		});
		function timeFromOffset(mouse,progressBars){
			var percentage = mouse.offsetX/$(progressBars).width()*100;
			var seconds = audioElement.audio.duration * (percentage/ 100);
			audioElement.settime(seconds);
		}

		function setTrack(trackid,newPlaylist,play){
			$.post("getsongJson.php",{songid:trackid},function(data){
				
				var track = JSON.parse(data)
				$(".trackName span").text(track.title);
				$.post("getartistJson.php",{artistid:track.artist},function(data){
					var artistname = JSON.parse(data)
					$(".artistName span").text(artistname.name);
				})
				$.post("getalbumJson.php",{albumid:track.album},function(data){
					var albumname = JSON.parse(data)
					$(".albumlink img").attr("src",albumname.artworkPath);
				})
				console.log(track);
				audioElement.setTrack(track);
				audioElement.play();
			})
			
			if (play == true) {
				audioElement.play()
			}
		
		}
		function playSong(){

			if (audioElement.audio.currentTime == 0) {
				$.post("updatePlays.php",{songid:audioElement.currentlyPlaying.id })
			}
			$(".controlButton.play").hide();
			$(".controlButton.pause").show();
			audioElement.play();
		}
		function pauseSong(){
			$(".controlButton.play").show();
			$(".controlButton.pause").hide();
			audioElement.pause();
		}

</script>
<div id="nowplayingBarContainer">
	<div id="nowplayingBars">
			<div id="nowplayingleft">
				<div class="content">
					<span class="albumlink">
						<img src="" class="album_pic">
					</span>
					<div class="trackInfo">
					<span class="trackName"> 
						<span> </span>
					</span>
					<span class="artistName"> 
						<span></span>
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
						<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="icons/play.png" alt="Play">
						</button>
						<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()" >
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