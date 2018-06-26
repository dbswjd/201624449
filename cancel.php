<!DOCTYPE HTML>
<html>
<head>

<?php
header('content-type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");
mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");
mysql_query("set names utf8");

$idx = $_GET["idx"];
$sql = "DELETE FROM Applicants WHERE idx='$idx'";
$result = $con->query($sql);
if ($result){
	echo ("<script>alert(\"취소되었습니다.\");</script>");
	Header("Location:student.php");
}

?>

</head>
<body>
</body>
</html>
