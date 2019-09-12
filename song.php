<?php
/**
 * 
 */
class Song
{
	private $con;
	private $id;
	private $title;
	private $artistid;
	private $albumid;
	private $genre;
	private $duration;
	private $paths;
	private $mysqliData;

	function __construct($con,$id)
	{
		# code...
		$this -> con =$con;
		$this -> id = $id;

		$query = mysqli_query($this->con,"SELECT * FROM songs WHERE id = '$this->id'");
		$this -> mysqliData = mysqli_fetch_array($query);
		$this->id = $this->mysqliData['id'];
		$this-> title =$this->mysqliData['title'];
		$this-> albumid =$this->mysqliData['album'];
		$this-> artistid =$this->mysqliData['artist'];
		$this-> genre =$this->mysqliData['genre'];
		$this-> duration =$this->mysqliData['duration'];
		$this-> paths =$this->mysqliData['paths'];
	}
	public function getID()
	{
		return $this -> id;
	}
	public function getTitle()
	{
		return $this -> title;
	}
	public function getArtist()
		{
			return new Artist($this->con,$this->artistid);
		}
		public function getAlbum()
	{
		return new Album($this->con,$this->albumid);
	}
		public function getDuration()
	{
		return $this -> duration;
	}
		public function getGenre()
	{
		return $this -> genre;
	}
	public function getPath()
	{
		return $this -> paths;
	}

}
 ?>