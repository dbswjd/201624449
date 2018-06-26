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
	
	$room = $_GET['room'];
	$sql = "SELECT * FROM Room WHERE idx='$room'";
	$result = $con->query($sql);
	if($row = $result->fetch_assoc()){
		echo ("<h4>대여 가능 시간</h4><p>".$row['rental_hour_start']." ~ ".$row['rental_hour_end']."</p>");
		echo ("<h4>최대수용인원     <span>".$row['maximum_capability']."</span></h4>");
		echo ("<h4>의자 및 테이블 개수</h4><p>".$row['table_chair']."</p>");
		echo ("<h4>특이사항</h4><p>".$row['ps']."</p>");
	}
?>


		


</body>
</html>

