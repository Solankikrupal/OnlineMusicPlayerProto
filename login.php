<?php
//include 'login_process.php';
include 'connect.php';
include 'login_process.php';
$account = new Account($con);

if(isset($_POST['loginButton']))
{
	$loginUsername=$_POST['lemail'];
	$loginPassword=$_POST['loginpassword'];

	$result=$account->login($loginUsername,$loginPassword);
	if ($result == true) 
	{
		# code...
		echo ("<script language='javascript'>
			   window.alert('Welcome to login page')
			   window.location.href('index.html');</script>");
	}
	function getvalue($loginUsername)
	{
		if (isset($loginUsername)) {
			# code...
			echo $loginUsername;
		}
	}

}
if(isset($_POST['register']))
{

	$UserName=$_POST['UserName'];
	$f_name=$_POST['FirstName'];
	$l_name=$_POST['LastName'];
	$e_mail=$_POST['email'];
	$e_mail2=$_POST['email2'];
	$pw=$_POST['password'];
	$pw2=$_POST['password2'];
	//$account = new Account($con);
	$account -> register($UserName,$f_name,$l_name,$e_mail,$e_mail2,$pw,$pw2);


}
if(isset($_POST['register']))
{
	echo '<script language="javascript">
				$(document).ready(function() {
						$("#registerform").hide();
						$("#loginForm").show();
												   });
		</script>';											
}else
{
	echo '<script language="javascript">
				$(document).ready(function() {
						$("#registerform").show();
						$("#loginForm").hide();
													  });	
	</script>';
	
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="login.js"></script>
</head>
<body>
	<div id="background">
	<div id="logincontainer">
	<div id="inputcontainer">
	
		<form id="loginForm" action="login.php" method="POST">
	<h1>Login to Account</h1>
			<p>

				<label for="loginUsername">Email</label>
				<input id="loginUsername"  type="text" name="lemail" placeholder="@email" value=>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" type="password" name="loginpassword" placeholder="@pass@1213">
			</p>
			<?php 
			echo $account->getError("Invalid username or password");
			?>
			<button type="submit" name="loginButton">Log In</button>
			<div class="hasAccounttext">
				<span id="hidelogin">Don't have an Account yet?SignUp Here</span>
			</div>
		</form>




		
		<form id="registerform" action="login.php" method="POST">
		<h1>Create free Account</h1>
			<p>
				
				<label for="userName">UserName</label>
				<input id="userName" type="text" name="UserName"  placeholder="@userName" required>
				<?php 
				echo $account->getError("UserName must contain more than 25 and less than 5");
				echo $account->getError("username is taken");
				 ?>
			</p>
			<p>
				
				<label for="firstName">FirstName</label>
				<input id="firstName" type="text" name="FirstName"  placeholder="@firstName" required>
				<?php 
				echo $account->getError("FirstName must contain more than 25 and less than 5");
				 ?>
			</p>
			<p>
				
				<label for="lastName">LastName</label>
				<input id="lastName" type="text" name="LastName"  placeholder="@lastName" required>
				<?php 
				echo $account->getError("LastName must contain more than 25 and less than 5");
				 ?>
			</p>
			<p>
				
				<label for="email">Email</label>
				<input id="email" type="text" name="email"  placeholder="@email" required>
				<?php 
				echo $account->getError("Email is not same");
				echo $account->getError("email is not valid");
				echo $account->getError("email is taken");

				 ?>
			</p>
			<p>
				
				<label for="email2">Confirm-Email</label>
				<input id="email2" type="text" name="email2"  placeholder="@confirm-email" required>
				<?php 
				echo $account->getError("email is not valid");
				echo $account->getError("email is taken");
				echo $account->getError("UserName must contain more than 25 and less than 5");
				 ?>
			</p>
			<p>
				
				<label for="password">Password</label>
				<input id="password" type="password" name="password"  placeholder="@password" required>
				<?php 
				echo $account->getError("Password is not same");
				echo $account->getError("Password does not match the policy");
				echo $account->getError("password should contain less than 15 and more than 6");
				 ?>
			</p>
			<p>
								 ?>
				<label for="password2">Confirm-Password</label>
				<input id="password2" type="password" name="password2"  placeholder="@confirm-password" required>
				<?php 
				echo $account->getError("Password is not same");
				echo $account->getError("Password does not match the policy");
				?>
			</p>
			<button type="submit" name="register">Sign Up</button>
			<div class="hasAccounttext">
				<span id="hideregister">Already have an Account?LogIn Here</span>
			</div>
		</form>
	</div>
	<div  id="loginText">
		<h1>Get great music, right now</h1>
		<h2>Listen to loads of songs for free</h2>
		<ul>
			<li>Discover music you'll fall in love with</li>
			<li>Create your own playlists</li>
			<li>Follow artists to keep up to date</li>
		</ul>
	</div>
</div>
</div>



</body>
</html>