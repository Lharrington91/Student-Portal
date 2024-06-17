<?php
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('session.use_only_cookies','1');
	session_start();


?><!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8" />
	</head>
	<body>
		<h1>WELCOME TO THE STUDENT PORTAL</h1>

		<?php
		if( isset($_SESSION['username'])) {
			?>
			<ul>
				<li><a href="logoutsp.php">Log Out of <?=$_SESSION['username']?></a></li>
			</ul>
			<?php
		}
		else {
			?>
			<ul>
				<li><a href="loginsp.php">Login</a></li>
				<li><a href="registersp.php">New user registration</a></li>
			</ul>
			<?php
		}
		?>
	</body>
</html>



