<?php
/**
 * 
 */
//include("Album.php");
class Artist
{
	private $con;
	private $id;

	public function __construct($con,$id)
	{
		# code...
		$this -> con = $con;
		$this -> id = $id;

	}
	public function getName()
	{
		$artistquery = mysqli_query($this->con,"SELECT name FROM Artist WHERE id = '$this->id' ");
		$artist = mysqli_fetch_array($artistquery);
		return $artist['name'];
	}
}

?>