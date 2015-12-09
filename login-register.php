<?php
	session_start();



?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8" />
	<title>Rancid Tomatoes - Login/Register</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<div class="banner">
		<img class="banner-centered" src="images/rancidbanner.png"
			alt="Rancid Tomatoes">
</div>

<h1>Login/Register</h1>

<br>
<form action = "login-controller.php?">
	<h4>Username
	<input type = "text" name = "username" required>
	</h4>

	<h4>Password 
	<input type = "password" name = "password" required>
	</h4>

	<input type = "hidden" name = "action" value = "login">

	<input type = "submit" value = "LOGIN">
</form>

<?php
	if( isset( $_SESSION['loginError'] ) )
    {
        echo "<script type=\"text/javascript\">alert(\"" . $_SESSION['loginError'] . "\");</script>";
        unset( $_SESSION['loginError']);
    }
?>

<h2>Register New Reviewer</h2>
<form action = "login-controller.php">

	<h4>Username
	<input type = "text" name = "username" required>
	</h4>

	<h4>Password 
	<input type = "password" name = "password" required>
	</h4>

	<h4>First Name 
	<input type = "text" name = "first_name">
	</h4>

	<h4>Last Name 
	<input type = "text" name = "last_name">
	</h4>

	<h4>Publication 
	<input type = "text" name = "publication">
	</h4>

	<input type = "hidden" name = "action" value = "register">

	<input type = "submit" value = "REGISTER">
</form>

</body>


</html>