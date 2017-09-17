<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Chattie Chat</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<h1 class="title"><a href="http://localhost/~berny/PHP/experiment/start_screen.php">Chattie Chat</a></h1>

<!---------------------------Notifications-------------------------->
	<div class="notification" id="password_wrong">
		<h2 class="notification_title">Incorrect</h2>
		<hr>
		<div class="notification_text">
			<p>Your email is right<br>but...<br>your password is wrong.</p>
		</div>
	</div>

	<div class="notification" id="no_account">
		<h2 class="notification_title">Incorrect</h2>
		<hr>
		<div class="notification_text">
			<p style="font-size: 180%; padding-top: 6%">You have not yet created an account<br>or<br>your email is wrong.</p>
		</div>
	</div>
	<button class="transparent_background" id="transparent" onClick="disable_notification()"></button>

<!---------------------------Normal Structure-------------------------->
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
			<input type="submit" class="login_button" value="Log In"/>
		</div>
	</form>
	<div id="initial_buttons">
		<hr>
		<form action="signup.php" name="signup_form">
			<p id="or">Don't have an account yet?</p>
			<button class="signup_button">Sign up</button>
		</form>
	</div>
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

	if(mysqli_num_rows($result) > 0 && $email != ''){
		echo "Email exists in database <br>";
		$sql = "select * from users where email = '$email' and password = '$password'";
		$result = $conn->query($sql);

		if(mysqli_num_rows($result) > 0){
			echo "Your email and password are correct";
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			echo "<script type='text/javascript'> window.location = 'http://localhost/~berny/PHP/experiment/home.php'</script>";
		}else{
			echo "Your password is wrong";
			echo "<script>
							var x = document.getElementById('password_wrong');
							x.style.display = 'block';
							
							var y = document.getElementById('transparent');
							y.style.display = 'block';
					</script>";
		}
	}
	else if($email) {
		echo "You have not yet created an account or your email is wrong";
			echo "<script>
							var x = document.getElementById('no_account');
							x.style.display = 'block';
							
							var y = document.getElementById('transparent');
							y.style.display = 'block';
					</script>";
	}
	
	$conn->close();
?>
</body>
<script>
	function disable_notification(){
		var x = document.getElementById('transparent');
		x.style.display = 'none';

		var y = document.getElementById('password_wrong');
		y.style.display = 'none';

		var z = document.getElementById('no_account');
		z.style.display = 'none';
	}
</script>
</html>
