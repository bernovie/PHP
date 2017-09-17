<!DOCTYPE HTML>
<html>
<head>
  <title>Chat</title>
  <link rel="stylesheet" href="css/addition_style.css" type="text/css">
</head>
<body>
<?php
	$servername = "127.0.0.1";
	$username = "root";
	$password = "starwars25m";
	$dbname = "chat";

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
	  die("Connection Failed: ".$conn->connect_error);
	}


      	$html = '<form name="form" action="" method="get">';
	$html .= '<p style="display: inline">The Text: </p><input type="text" class="text_input" name="theText" id="number1" value="" />';
	$html .= "<br><br>";
	$html .= '<p style="display:inline">The Nick:</p><input type="text" class="text_input" name="theNick" id="number2" value="" />';
	$html .= "<br><br>";
	$html .= '<input type="submit" class="button" name="my_form_submit_button" value="Submit Message"/>';
	$html .= "</form>";
	echo $html;
	$theText = $_GET['theText'];
	$theNick = $_GET['theNick'];

	for ($i = 0; $i < $theText; $i++) {
	  
	}
	$sql = "INSERT INTO chatScript VALUES(NULL".",'".$theText."','".$theNick."')";
	$result = $conn->query($sql);

	if($result == TRUE){
	  echo "New record created succesfully";
	} else{
	  echo "Error: ".$sql."<br>".$conn->error;
	}

	echo "<br>";
	$html = "<div id='result'>".$theText."</div>";
	echo $html;
	$conn->close();
?>
</body>
</html>
