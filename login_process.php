<?php

include 'connect.php';
//error_reporting(0);

	class Account
		{
		private $errorArray;
		private $con;
		public function __construct($con)
		{
			# code...
			$this->errorArray=array();
			$this->con=$con;
		}
		public function login($un,$ps)
		{
			$decryptpw=md5($ps);
			$query=mysqli_query($this->con,"SELECT * FROM users WHERE username='$un' AND encrptpass='$decryptpw'");
			if (mysqli_num_rows($query) == 1)
			 {
				# code...
				return true;
			}
			else
			{
				array_push($this->errorArray,"Invalid username or password");
				return false;
			}
		}
		public function register($un,$fn,$ln,$em,$em2,$ps,$ps2)
		{
		$this-> validate_UserName($un);
		$this->validate_FirstName($fn);
		$this-> validate_LastName($ln);
		$this->validate_email($em,$em2);
		$this->validate_password($ps,$ps2);
		if (empty($this->errorArray) == true) 
		{
			# code...
			return $this->insertUserDetail($un,$fn,$ln,$em,$ps);
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
	
		private function insertUserDetail($un,$fn,$ln,$em,$ps)
		{
		$encrptedpw=md5($ps);
		$date=date('d-m-y');
		$profilepic='';
			if(!$this->con)
	{
		die("connection failed:".mysqli_connect_error());
	}	
	/*else
	{
		echo "connected successfully";
	}*/

	$result="INSERT INTO users(username,firstname,lastname,email,encrptpass,signupdate,profilepic) VALUES('$un', '$fn', '$ln', '$em', '$encrptedpw', '$date', '$profilepic' )";
	//echo $result;
	if (mysqli_query($this->con,$result))
	 {
		# code...
			  //echo "New Record created successfully";
			  echo ("<script language='javascript'>
			   window.alert('New Record created successfully')
			   window.location.href('index.html');</script>");
	}

	else
	{
		echo "Error:".$result."".mysqli_error($con);
	}
	}
		private function validate_UserName($un)
	{
		//echo "validate username called";
		if(strlen($un)>25||strlen($un)< 5)
		{
			array_push($this->errorArray, "UserName must contain more than 25 and less than 5");
			return;
		}

		$checkusername=mysqli_query($this->con,"SELECT username FROM users WHERE username='$un'");
			if(mysqli_num_rows($checkusername) != 0) 
			{

				# code...
				array_push($this->errorArray, "username is taken");
				return;
			}
		
	
	
	}
	private function validate_FirstName($fn)
	{
		if(strlen($fn)>25||strlen($fn)< 5)
		{
			array_push($this->errorArray, "FirstName must contain more than 25 and less than 5");
			return;
		}

	}
	private function validate_LastName($ln)
	{
		if(strlen($ln)>25||strlen($ln)< 5)
		{
			array_push($this->errorArray, "LastName must contain more than 25 and less than 5");
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
		/*if (filter_var($em,FILTER_VALIDATE_EMAIL)) {
			# code...
			array_push($this->errorArray,"email is not valid");
		}*/
		$checkemail=mysqli_query($this->con,"SELECT email FROM users WHERE email='$em'");
	
			if (mysqli_num_rows($checkemail)!=0)
			 	{

				# code...
				array_push($this->errorArray, "email is taken");
				return;
				}
			
	}
	private function validate_password($ps,$ps2)
	{
		if($ps!=$ps2)
		{
			array_push($this->errorArray, "Password is not same");
			return;
		}
		if (preg_match('/[^A-Za-z0-9]/', $ps)) {
			# code...
			array_push($this->errorArray, "Password does not match the policy");
			return;
		}
		if (strlen($ps)>15||strlen($ps2)<6) 
		{
			# code...
			array_push($this->errorArray, "password should contain less than 15 and more than 6");
			return;

		}
		
	}
	


}
//echo "INSERT INTO users VALUES('','$UserName','$f_name','$l_name','$e_mail','encrptedpw','date','profilepic')";



?>