<?php
	session_start();
	require_once('configsp.php');
?><!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="utf-8" />
</head>
<body>
	<hl>REGISTRATION PAGE</hl>
	<div id='error_div'>
		<?php
		$created = false;
		if(isset($_POST['create'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$fullName = $_POST['fullName'];
			$number = $_POST['number'];
			$email = $_POST['email'];

			$sql = "SELECT username FROM tblstudent WHERE username=?;";
			$stmtselect = $db->prepare($sql);
			$stmtselect->execute([$username]);
			if($stmtselect->rowCount() > 0){
				echo '<b>username already in use.</b>';	
			}else{
				$sql = "INSERT INTO tblstudent (username, password, fullName, number, email ) VALUES(?,?,?,?,?)";
				$stmtinsert = $db->prepare($sql);
				$result = $stmtinsert->execute([$username, $password, $fullName, $number, $email]);
				if($result){
					echo 'USER PROFILE SAVED';
					$created = true;
				}else{
					echo 'ERROR SAVING DATA.';
				}
			}
		}
		?>
	</div>
	<div id="registration_form">
		<?php
		if($created == false) {
			?>
			<form action="registersp.php" method="post">
				<div class="container">
					<h1>Register Here!</h1>
					<p>Fill out the information below to complete your user profile.</p>
					<label for="username"><b>USER NAME</b></label>
					<input type="varchar" name="username" required>
					<br>
					<label for="password"><b>PASSWORD</b></label>
					<input type="varchar" name="password" required>
					<br>
					<label for="fullName"><b>FIRST AND LAST NAME</b></label>
					<input type="varchar" name="fullName" required>
					<br>
					<label for="number"><b>PHONE NUMBER</b></label>
					<input type="varchar" name="number" required>
					<br>
					<label for="email"><b>EMAIL ADDRESS</b></label>
					<input type="varchar" name="email" required>
					<br>   
					<input type="submit" name="create" value="SUBMIT">
				</div>
			</form>
		<?php
		}
		?>
	</div>
	<div>
		<a href="./">Home</a>
	</div>
</body>
</html>