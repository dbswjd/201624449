<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

<?php
	header('content-type: text/html; charset=utf-8');
	$con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

	mysqli_query($con, "set session character_set_connection=utf8;");
	mysqli_query($con, "set session character_set_results=utf8;");
	mysqli_query($con, "set session character_set_client=utf8;");
	mysql_query("set names utf8");
	
	$building = $_GET['building'];
	$date = $_GET['date'];
	$sql = "SELECT * FROM Applicants WHERE room_idx='$building' AND date='$date'";
	$result = $con->query($sql);
	if($row = $result->fetch_assoc()){
		echo ("<p style=\"color:#ff8566; margin:3px; margin-bottom:10px; font-size:15px;\">대여할 수 없는 날짜입니다. 다른 날짜를 선택해 주십시오.</p>");
	}
	else {
		echo ("<p style=\"color:#70db70; margin:3px; margin-bottom:10px; font-size:15px;\">대여 가능한 날짜입니다.</p>");
	}
?>

</body>
</html>

