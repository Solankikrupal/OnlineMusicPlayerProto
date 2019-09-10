<?php


	/**
	 * 
	 */
	class Album
	{
		private $con;
		private $id;
		private $name;
		private $artistid;
		private $genreid;
		private $artworkPath;

		public function __construct($con,$id)
		{
			# code...
			$this-> con = $con;
			$this-> id = $id;

			$query = mysqli_query($this->con,"SELECT * FROM Album WHERE id = '$this->id'");
			$album = mysqli_fetch_array($query);

			$this-> name = $album['name'];
			$this-> artistid = $album['artist'];
			$this-> genreid = $album['genre'];
			$this-> artworkPath = $album['artworkPath'];

		}
		public function getAlbum()
		{
			/*$albumquery = mysqli_query($this->con,"SELECT name FROM Album WHERE id = '$this->id'");
			$album = mysqli_fetch_array($albumquery);*/
			return $this->name;

		}
		public function getArtist()
		{
			return new Artist($this->con,$this->artistid);
		}
		public function getGenre()
		{
			return $this->genreid;
		}
		public function getworkArtPath()
		{
			/*$artworkPathquery = mysqli_query($this->con,"SELECT artworkPath FROM Album WHERE id = '$this->id'");
			$artwork = mysqli_fetch_array($artworkPathquery);*/
			return $this->artworkPath;

		}
		public function getnumberofsong()
		{
			$songquery = mysqli_query($this -> con,"SELECT * FROM songs WHERE id = '$this->id'");
			return mysqli_num_rows($songquery);
			
		}
		public function getSongID()
	{
		$query=mysqli_query($this->con,"SELECT id FROM songs WHERE album = '$this->id' ORDER BY albumorder ASC");
		$array =array();

		while ($row = mysqli_fetch_array($query)) {
			# code...
			array_push($array, $row['id']);
		}
		return $array;
	}
	}
?>