<?php

function validate_UserName($un)
	{
		echo "validate username called";
		/*if(strlen($un)>5||strlen($un)< 25)
		{
			array_push($this->errorArray, "UserName must contain more than 25 and less than 5");
			return;
		}*/
	}
/*public function validate_FirstName($fn)
	{
		if(strlen($fn)>5||strlen($fn)< 25)
		{
			//array_push($this->errorArray, "LastName must contain more than 25 and less than 5");
			return;
		}

	}
public function validate_LastName($ln)
	{
		if(strlen($ln)>5||strlen($ln)< 25)
		{
			//array_push($this->errorArray, "UserName must contain more than 25 and less than 5");
			return;
		}
		
	}
public function validate_email($em,$em2)
	{
		if($em!=$em2)
		{
			//array_push($this->errorArray, "Email is not same");
			return;
		}
	}
public function validate_password($pass,$pass2)
	{
		if($pass!=$pass2)
		{
			//array_push($this->errorArray, "Password is not same");
			return;
		}
		if (preg_match('/[^A-Za-z0-9]/', $pass)) {
			# code...
			//array_push($this->errorArray, "Password does not match the policy");
			return;
		}
		if (strlen($pass)>15||strlen($pass)<6) 
		{
			# code...
			//array_push($this->errorArray, "password should contain less than 15 and more than 6");
			return;

		}
		
	}*/
?>