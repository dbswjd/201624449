<?php
header('content-type: text/html; charset=utf-8');

$connect = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

session_start();

$id = $_REQUEST[u_id];
$sql = "UPDATE Students SET status='Y', certification='Y' WHERE ID='$id'";
$result = $connect->query($sql);

if ($result){
	echo "인증되었습니다. ";
}
?>