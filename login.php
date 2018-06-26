<!DOCTYPE HTML>
<html>
<head> <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
</head>
<body>


<?php
  $con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

  $userID = $_POST["id"];
  $userPassword = $_POST["password"];
  $identity = $_POST["identity"];
  $sql = "";
  if ($identity == "m"){
	$sql = "SELECT * FROM Managers WHERE ID = '$userID'";
  }
  else {
	$sql = "SELECT * FROM Students WHERE ID = '$userID'";
  }
  $result = $con->query($sql);

  
	if($result->num_rows==1){
	  $row = $result->fetch_assoc();
		if($row['PW'] == $userPassword){
			if($row['status'] == 'Y'){		
				session_start();
				if ($identity == "s"){
					$_SESSION['studid'] = $userID;
					echo("<script>location.replace('student.php');</script>");
				}
				else {
					$_SESSION['managerid'] = $userID;
					header('Location:Manager.php');//페이지 이동
				}
			}
			else {
				echo ("<script>alert(\"접근이 거부된 회원입니다.\");</script>");
  echo("<script>location.replace('login.html');</script>");
			}
	        }
		else{
echo ("<script>alert(\"wrong id or pw\");</script>");
  echo("<script>location.replace('login.html');</script>");

			
		}
	}
	else {
		echo ("<script>alert(\"wrong id or pw\");</script>");
  echo("<script>location.replace('login.html');</script>");


	}

?>
</body>
</html>
