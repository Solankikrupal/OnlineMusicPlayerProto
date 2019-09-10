<?php
class Account
{
	private $con;
	private $errorArray;
	public function __construct()
	{
		$this->errorArray=array();

	}
	public function register($un,$fn,$ln,$em,$em2,$pass,$pass2)
	{
		# code...
		$this-> validate_UserName($un);
		$this->validate_FirstName($fn);
		$this-> validate_LastName($ln);
		$this->validate_email($em,$em2);
		$this->validate_password($pass,$pass2);

		if (empty($this->errorArray) == true) 
		{
			# code...
			return $this->insertUserDetail($un,$fn,$ln,$em,$pass);
		}
		else
		{
			return false;
		}

	}
	public function getError($error)
	{
		if (!in_array($error, $this->errorArray)) 
		{
			# code...
			$error="";
		}
		return "<span class='errorMessage'>$error</span>";
	}
	
	
	private function validate_UserName($un)
	{
		//echo "validate username called";
		if(strlen($un)>25||strlen($un)< 5)
		{
			array_push($this->errorArray, "UserName must contain more than 25 and less than 5");
			return;
		}
	}
	private function validate_FirstName($fn)
	{
		if(strlen($fn)>25||strlen($fn)< 5)
		{
			array_push($this->errorArray, "LastName must contain more than 25 and less than 5");
			return;
		}

	}
	private function validate_LastName($ln)
	{
		if(strlen($ln)>25||strlen($ln)< 5)
		{
			array_push($this->errorArray, "UserName must contain more than 25 and less than 5");
			return;
		}
		
	}
	private function validate_email($em,$em2)
	{
		if($em!=$em2)
		{
			array_push($this->errorArray, "Email is not same");
			return;
		}
	}
	private function validate_password($pass,$pass2)
	{
		if($pass!=$pass2)
		{
			array_push($this->errorArray, "Password is not same");
			return;
		}
		if (preg_match('/[^A-Za-z0-9]/', $pass)) {
			# code...
			array_push($this->errorArray, "Password does not match the policy");
			return;
		}
		if (strlen($pass)>15||strlen($pass)<6) 
		{
			# code...
			array_push($this->errorArray, "password should contain less than 15 and more than 6");
			return;

		}
		
	}
	
}
?>