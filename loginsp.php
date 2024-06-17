<?php
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('session.use_only_cookies','1');
	session_start();
	require_once('configsp.php');



?><!DOCTYPE html> <html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron">
  <div class="container text-center">
    <hl>LOGIN PAGE</h1>
	<?php
		//var_dump($_POST);
	 if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM tblstudent WHERE username=? AND password=?";
		$stmtselect = $db->prepare($sql);
		$stmtselect->execute([$username, $password]);
		if($stmtselect->rowCount()==1){
			$result=$stmtselect->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
			$_SESSION["username"]=$result[0]["username"];
			header("Location: studentprofilepg.php");
			exit();
		}else{
			echo 'Incorrect username or password';
		}	
   }
   ?>
   
   <div>
   <form action="loginsp.php" method="post">
	<div class="container">
	   <h1>Log in here:</h1>

	   <lable for="username"><b>USERNAME</b></label>
	   <input type="varchar" name="username" required>
	<br>
	<br>
	   <lable for="password"><b>PASSWORD</b></label>
	   <input type="varchar" name="password" required>
	<br>
	<br>	
	   <input type="submit" name="login" value="Submit">
	<br>
       
   </form>
   <div>
	<a href="studentportal.php"><span class="glyphicon glyphicon-home"></span> Home</a>
	</div>
</div>
  </div>
</div>
</body>