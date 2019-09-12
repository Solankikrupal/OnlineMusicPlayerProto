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
			updateVolumeProgressBar(audioElement.audio);
			$("#nowplayingBarContainer").on("mousedown touchstart mousemove touchstart",function(e){
				e.preventDefault();
			});
		/* song progress bar */
		$(".playingbackbar .progressBars").mousedown(function(){
			mouseDown = true;
		});


		$(".playingbackbar .progressBars").mousemove(function(e){
			if (mouseDown = true) {
				timeFromOffset = (e,this);		
			}
		});

		$(".playingbackbar .progressBars").mouseup(function(e){
			timeFromOffset = (e,this);
		});
		/* end song progress bar */
		/*volume bar*/
		$(".volumeBars .progressBars").mousedown(function(){
			mouseDown = true;
		});


		$(".volumeBars .progressBars").mousemove(function(e){
			if (mouseDown = true) {
				var percentage = e.offsetX / $(this).width();
				if (percentage >= 0 && percentage <=1) {
				audioElement.audio.volume = percentage;
			}
							}
		});

		$(".volumeBars .progressBars").mouseup(function(e){
			var percentage = e.offsetX / $(this).width();
			if (percentage>=0 && percentage <=1) {
				audioElement.audio.volume = percentage;
			}
		});

		/* end volume bar */ 


		$(document).mouseup(function(){
			mouseDown = false;
		});

		});

		function timeFromOffset(mouse,progressBars){
			var percentage = mouse.offsetX/$(progressBars).width() * 100;
			var seconds = audioElement.audio.duration * (percentage/ 100);
			audioElement.settime(seconds);
		}
		function previousSong(){
			if (audioElement.currentTime >= 3 || currentIndex == 0) {
			audioElement.settime(0);
		} else{
			currentIndex = currentIndex - 1;
			setTrack(currentPlaylist[currentIndex],currentPlaylist,true);
			  }
		}
		function nextSong(){
			if (repeat == true) {
				audioElement.settime(0);
				playSong();
				return;
			}
			if (currentIndex == currentPlaylist.length - 1) {
				currentIndex = 0;
			}
			else
			{
				currentIndex++;
			}
			var tracktoPlay = currentPlaylist[currentIndex];
			setTrack(tracktoPlay,currentPlaylist,true);
			//$(".controlButton.next").show();

		}
		function setRepeat()
		{
			if (repeat == true)
			 {
				repeat = false;
			}
			else{
				repeat = true;
			}
			
			var repeatImage = repeat ? "repeat-active.png" : "repeat.png";

			$(".controlButton.repeat img").attr("src","icons/"+repeatImage);
		}
		function setMuted(){
			/*if (audioElement.audio.muted==true) {
				audioElement.audio.muted==false;
			}
			else{
				audioElement.audio.muted==true;
			}*/
			audioElement.audio.muted = !audioElement.audio.muted;
			var mutedimage = audioElement.audio.muted ? "volume-mute.png":"volume.png";
			$(".controlButton.volume img").attr("src","icons/"+mutedimage);

		}
		function setShuffle(){
			shuffle = !shuffle;
			var shuffleImage = shuffle ? "shuffle-active.png":"shuffle.png";
			$(".controlButton.shuffle img").attr("src","icons/"+shuffleImage);
			//shuffle start
			/*if (shuffle == true) {
				shuffleArray(shufflePlaylist);
			}
			else
			{

			}
			function shuffleArray(a) {
  			    var j, x, i;
    			for (i = a.length - 1; i > 0; i--) {
				j = Math.floor(Math.random() * (i + 1));
			    x = a[i];
			    a[i] = a[j];
			    a[j] = x;
    				}
			}*/
			//shuffle end
		}
		function setTrack(trackid,newPlaylist,play){
			/*if (newPlaylist != currentPlaylist) 	//shuffle
			{
				currentPlaylist = newPlaylist
				shufflePlaylist = currentPlaylist.slice();
				shuffleArray(shufflePlaylist);
			}*/										//shuffle end
			$.post("getsongJson.php",{songid:trackid},function(data){
					
				currentIndex = currentPlaylist.indexOf(trackid);

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
				//audioElement.play();
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
						<button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
						<img src="icons/shuffle.png" alt="Shuffle">
						</button>
						<button class="controlButton previous" title="Previous button" onclick="previousSong()">
						<img src="icons/previous.png" alt="Previous">
						</button>
						<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="icons/play.png" alt="Play">
						</button>
						<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()" >
						<img src="icons/pause.png" alt="Pause">
						</button>
						<button class="controlButton next" title="Next button" onclick="nextSong()">
						<img src="icons/next.png" alt="Next">
						</button>
						<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
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
					<button class="controlButton volume" title="Volume" onclick="setMuted()">
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