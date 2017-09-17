<!DOCTYPE HTML>
<html>
<head>
	<title>Chattie Chat</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<h1 class="title"><a href="http://localhost/~berny/PHP/experiment/start_screen.php">Chattie Chat</a></h1>
<div id="login_signup">
	<p>"Chattie Chat is the #1 chat website"<br><i>-New York Times</i></p>
	<form id="initial_form" name="form" action="" method="get">
		<p>Email Address</p><br>
		<div class="input_div">
		<input type="text" class="text_input" name="email" placeholder="email" value=""/>
		</div>
		<br><p>Password</p><br>
		<div class="input_div">
		<input type="password" class="text_input" name="password" placeholder="password" value="" />
		</div>
		<div id="initial_buttons">
			<input type="submit" class="signup_button" value="Sign Up"/>
		</div>
	</form>
</div>
<?php
	$servername = "192.168.1.127";
	$username = "berny";
	$password = "starwars25u";
	$dbname = "chattieChat";
	
	$conn = new mysqli($servername, $username, $password, $dbanme);
	
	if($conn->connect_error){
		die("Connection Failed: ".$conn->connect_error);
	}
	
	$email = $_GET['email'];
	$password = $_GET['password'];
	$sql = "use chattieChat";
	$conn->query($sql);
	$sql = "select * from users where email = '$email'";
	$result = $conn->query($sql);
	if($email != ''){
	if(mysqli_num_rows($result) > 0){
		echo "An account with that email already exists <br>";
	}
	else {
		$sql = "INSERT INTO users VALUES('".$email."','".$password."')";
		if($conn->query($sql) == TRUE){
			echo "Account Created Succesfully";
			echo '<script type="text/javascript">
			window.location = "http://localhost/~berny/PHP/experiment/start_screen.php"</script>';
		}
		else {
			echo "Error: ".$sql."<br>".$conn->error;
		}
	}
	}
	?>
</body>
</html>
