<?php
   header('content-type: text/html; charset=utf-8');
  
   $con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");
   mysqli_query($con, "set session character_set_connection=utf8;");
   mysqli_query($con, "set session character_set_results=utf8;");
   mysqli_query($con, "set session character_set_client=utf8;");
   mysql_query("set names utf8");

  $userID = $_POST["userID"];
  $userPassword = $_POST["userPassword"];
  $userPasswordCheck = $_POST["userPasswordCheck"];
  $name = $_POST["userName"];
  $phone = $_POST["phone"];
  $building = $_POST["building"];

  /*password check*/
  if ($userPassword != $userPasswordCheck){
    echo "check the password";
    exit();
  }

  /*ID check*/
  $checkID = "SELECT * FROM Managers WHERE ID='$userID'";
  $checkResult = $con->query($checkID);
  if ($checkResult->num_rows == 1){
    echo "duplicated ID";
    exit();
  }
  
  /*insert data*/
  $signUp = "INSERT INTO Managers (ID, PW, name, phoneNumber, building) VALUES ('$userID', '$userPassword', '$name', '$phone', '$building')";
  $checkSignUp = $con->query($signUp);
   
  echo ("<script>alert(\"Signed up\");</script>");
  echo("<script>location.replace('login.html');</script>");

  
?>