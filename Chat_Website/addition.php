<!DOCTYPE HTML>
<html>
<head>
	<title>Addition</title>
	<link rel="stylesheet" href="css/addition_style.css" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
	$number1; $number2;
	$number1 = $_GET['number1'];
	$number2 = $_GET['number2'];	
	if(!$_GET['number1'] && !$_GET['number2']){
		$number1 = 0;
		$number2 = 0;
		echo "Number 1 = 0";
	}
	$html = '<form name="form" action="" method="get">';
	$html .= '<input type="integer" class="text_input" name="number1" id="number1" value='.$number1.' />';
	$html .= "<br><br>";
	$html .= '<input type="integer" class="text_input" name="number2" id="number2" value='.$number2.' />';
	$html .= "<br><br>";
	$html .= '<input type="submit" class="button" name="my_form_submit_button" value="Add numbers"/>';
	$html .= "</form>";
	echo $html;
	$number1 = $_GET['number1'];
	$number2 = $_GET['number2'];
	echo "<br>";
	$html = "<div id='result'>".($number1+$number2)."</div>";
	echo $html;	
?>
</body>
</html>
