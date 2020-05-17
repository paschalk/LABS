<?php
	include_once 'DBConnector.php';
	include_once 'user.php';

	$con = new DBConnector; //connect to database
	if(isset($_POST['btn-login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$instance = User::create();
		$instance->setPassword($password);
		$instance->setUsername($username);

		if($instance->isPasswordCorrect()){
			$instance->login();
			//close the db connection
			$con->closeDatabase();
			//create a user session
			$instance->createUserSession();

		}else{
			$con->closeDatabase();
			header("Location:login.php");
		}
	}

?>
<html>
<head>
	<title>Login</title>
	<script type="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
	<!--"=$_SERVER['PHP_SELF']" this means that we are submitting this form to itself for processing-->
	<form method="post" name="login" id="login" action="<?=$_SERVER['PHP_SELF']?>">
		<table align="center">
			<tr>
				<td><input type="text" name="username" placeholder="Username" required /></td>
			</tr>
			<tr>
				<td><input type="password" name="password" placeholder="Password" required /></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
			</tr>
		</table>
	</form>
</body>
</html>