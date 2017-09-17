<!DOCTYPE HTML>
<html>
<head>
	<title>PHP MYSQL Test</title>
	<style>
		table, th, td{
			border: 1px solid black;
		}
	</style>
</head>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "starwars25m";
$dbname = "chat";

$conn = new mysqli($servername, $username, $password, $dbname);

if(function_exists('mysqli_connect')){
	echo "Mysqli exists";
}
if($conn->connect_error){
	die("<br>Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM chatScript";
$result = $conn->query($sql);

if($result->num_rows > 0){
		echo "<table><tr><th>pk_Id</th><th>theText</th><th>theNick</th></tr>";
	while($row = $result->fetch_assoc()){
		echo "<tr><td>".$row["pk_Id"]."</td><td>".$row["theText"]."</td><td>".$row["theNick"]."</td></tr>";
	}
	echo "</table>";
}
else{
	echo "0 results";
}
$conn->close();
?>
</body>
</html>
