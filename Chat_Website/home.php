<?php 
				session_start(); 
				$servername = "192.168.1.127";
				$username = "berny";
				$password = "starwars25u";
				$dbname = "chattieChat";

				$conn = new mysqli($servername, $username, $password, $dbanme);

				if($conn->connect_error){
					die("Connection Failed: ".$conn->connect_error);
				}

				$sql = "use chattieChat";
				$conn->query($sql);

				function checkQuery(&$connection, &$sql){
					if($connection->query($sql) == TRUE){
						echo "<script>console.log('Message delivered succesfully')</script>";
					}
					else {
						echo "<div class='notify'>Error: $sql, $connection->error<div>";
					}
				}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Chattie Chat</title>
	<link rel="stylesheet" href="css/home.css" type="text/css">
</head>
<body id="body">
	<div class="profile_preferences_window_trigger" id="profile_preferences_window_trigger"></div>
	
	<!---------------------------Notifications-------------------------->
	<div class="notification" id="password_wrong">
		<h2 class="notification_title">Incorrect</h2>
		<hr>
		<div class="notification_text">
			<p>Your email is right<br>but...<br>your password is wrong.</p>
		</div>
	</div>

	<div class="notification" id="no_account">
		<div class="notification_title">
			<form name="search_people" action="" method="get">
				<input type="text" name="search_people_input" class="search_people_input" placeholder="Search for new people"/>
			</form>
		</div>
		<div class="notification_text">
		</div>
	</div>
	<button class="transparent_background" id="transparent" onClick="disable_notification()"></button>
	
	<!---------------------------Structure-------------------------->
	<div class="added_friends">
		<div class="search_friends">
			<form name="search_friends" action="" method="get">
				<input type="text" class="search_friends_input" name="search_friends_input" placeholder="Search added friends" />
			</form>
		</div>
		<hr>
		<div class="populate_friends">
			
		</div>
	</div>
	<div class="chats">
		<div class="preferences" id="preferences">
			<h1>Chattie Chat</h1>
			<div class="add_friends">
				<?php
					echo file_get_contents("icons/add-friend.svg");
				?>
			</div>
			<div class="profile_preferences">
				<?php
					echo file_get_contents("icons/user-2.svg");
				?>
			</div>
			<hr width="3" size="75.99%" style="position: absolute; right: 11%; top: 0%; margin: 0%; background-color: #256B69; border: 0px">
			<div class="preferences_cog">
				<?php
					echo file_get_contents("icons/cog-wheel.svg");
				?>
			</div>
		</div>
		<div class="write_chat">
			<form name="send_chat" action="" method="get">
				<input type="text" id="write_chat_input" class="write_chat_input" name="write_chat_input" placeholder="Chat" />
				<input type="submit" value="Send" class="send_button"/>
			</form>
		</div>
		<div class="profile_preferences_window" id="profile_preferences_window">
			<?php echo "<div class='tab'><p>Hi, {$_SESSION['email']}!</p></div><hr style='margin-top: 0px; margin-bottom: 0px'>"; ?>
			<div class='tab'><p>Friend Requests</p></div>
		</div>
		<!-----------------------------------Process New Messages---------------------------------->
		<?php
					$message = $_GET['write_chat_input'];
					echo "<script>console.log('$message')</script>";
					$sql = "INSERT INTO berny_and_fer VALUES('$message', '{$_SESSION['email']}', NULL, NULL)";
					if($message){
						checkQuery($conn, $sql);
					}
		?>	
		<div class="chats_window" id="chats_window">
			<?php
					echo "<div class='chat_friend'><p>{$_SESSION['email']}</p></div>";
			?>
			<div class="chat_own">
				<p>Not much man. I think I'll go to dinner in like 30 minutes</p>
			</div>
			<div class="chat_friend"><p>Okay</p></div>
			<div class="chat_friend"><?php echo "<p>{$_SESSION['password']}</p>";?></div>

		<!-----------------------------------Display Messages---------------------------------->
			<?php
				$sql = "select message, user from berny_and_fer";
					if($conn->real_query($sql)){
						if($result = $conn->use_result()){
							while($row = $result->fetch_row()){
								if($row[1] == "{$_SESSION['email']}"){
									echo "<div class='chat_own'>";
								}else{
									echo "<div class='chat_friend'>";
								}
								echo "<p>$row[0]</p></div>";
							}
							$result->close;
						}
					}	
				?>
		</div>
	</div>
<?php
	$conn->close();
?>
</body>
<script>
	var chats_window = document.getElementById('chats_window');
	chats_window.scrollTop = chats_window.scrollHeight;
	var profile_preferences = document.getElementById('profile_preferences');
	var profile_preferences_tab = document.getElementById('profile_preferences_window');
	var profile_preferences_window_trigger = document.getElementById('profile_preferences_window_trigger');
	var add_friend_icon = document.getElementById('add_friend_icon');
	var transparent = document.getElementById('transparent');
	var no_account = document.getElementById('no_account');

	profile_preferences.onmouseover = function(){
			profile_preferences_tab.style.display = "block";
	}
	chats_window.onmouseover = function(){
		profile_preferences_tab.style.display = "none";
	}
	profile_preferences_window_trigger.onmouseover = function(){
		profile_preferences_tab.style.display = "none";
	}
	add_friend_icon.onclick = function(){
		console.log("Add friends");
		no_account.style.display = "block";
		transparent.style.display = "block";
	}

	function disable_notification(){
		no_account.style.display = "none";
		transparent.style.display = "none";
	}
</script>
</html>
