<?php
header('content-type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");
mysql_query("set names utf8");
session_start();
$id = $_SESSION['studid'];
$sql = "SELECT * FROM Students WHERE ID='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc(); 
$idx = $row['idx'];
$room = $_POST["building"];
$date = $_POST["date"];
$time_start = $_POST["time_start"];
$time_end = $_POST["time_end"];
$capability = $_POST["capability"];
$purpose = $_POST["purpose"];
$ps = $_POST["ps"];

$sql = "INSERT INTO Applicants (room_idx, student_idx, date, start, end, purpose, capability, ps) VALUES ('$room', '$idx', '$date', '$time_start', '$time_end', '$purpose', '$capability', '$ps')";
//$sql = "INSERT INTO Applicants (date, start, end, purpose, capability, ps) VALUES ('$date', '$time_start', '$time_end', '$purpose', '$capability', '$ps')";
$checkSignUp = $con->query($sql);
if ($checkSignUp){
	echo ("<script>alert(\"Your application is complete.\");</script>");
	echo ("<script>location.replace('student.php');</script>");
}

?>