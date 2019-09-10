<?php
include('connect.php');
include('artist.php');
include('Album.php');
include('song.php');
include ('header.php');

if (isset($_GET['id'])) {
	# code...
	$albumID =  $_GET['id'];
}
else
{
	echo "<script language= 'javascript'>
		alert('noooo');
		location('index.php');
	</script>" ;
}
/*$albumquery = mysqli_query($con,"SELECT * FROM Album WHERE id = '$albumID'");
$album = mysqli_fetch_array($albumquery);*/
//echo $album['name']."<br>";
/*$artistID = $album['artist'];
$album = new Album($con,$albumID);
echo $album->getAlbum()."<br>";
$artist = new Artist($con,$artistID);
$artwork = new Artist($con,$artistID);
echo $artist->getName()."<br>";
echo $artwork->getworkArtPath();


/*$artistquery = mysqli_query($con,"SELECT * FROM Artist WHERE id = '$artistID' ");
$artist = mysqli_fetch_array($artistquery);
echo $artist['name'];*/

$album =  new Album($con,$albumID);
$artist = $album -> getArtist();
//echo $album -> getAlbum()."<br>";
//echo $artist -> getName();
?>
<div class="entityInfo">
	<div class="leftSection">
		<img src="<?php echo $album -> getworkArtPath(); ?>">
	</div>
	<div class="rightSection">
		<h2><?php echo $album -> getAlbum() ?></h2>
		<p> By <?php echo $artist -> getName();?> </p>
		<p><?php echo $album -> getnumberofsong();?></p>
	</div>
</div>
<div class="tracklistContainer">
	<ul class="tracklist">
		<?php
			$songID = $album -> getSongID();

			$i = 1;
			foreach ($songID as $song) {
				# code...
				#echo $song."<br>";
				$albumSong = new Song($con,$song);
				$albumArtist = $albumSong -> getArtist();

#				echo ;

				echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src = 'icons/play-white.png'>
						<span class = 'trackNumber'>$i</span>
					</div>
					<div class='trackInfo'>
						<span class = 'trackName'>". $albumSong->getTitle() ."</span>
						<span class = 'trackArtist'>" . $albumArtist->getName() . "</span>
					</div>
					<div class='trackOptions'>
						<img class='optionsButton' src='icons/more.png'>
					</div>
					<div class ='trackDuration'>
						<span class = 'duration'>".$albumSong->getDuration()."</span> 
					</div>
				</li>";
				$i= $i + 1;
			}
		?>
	</ul>

</div>

<?php
include('footer.php');
?>