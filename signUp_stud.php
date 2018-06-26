<?php
  header('content-type: text/html; charset=utf-8');
  include "forSendingMail.php";
  $sendmail = new Sendmail();
  $con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

   mysqli_query($con, "set session character_set_connection=utf8;");
   mysqli_query($con, "set session character_set_results=utf8;");
   mysqli_query($con, "set session character_set_client=utf8;");
    mysql_query("set names utf8");


  $userID = $_POST["userID"];
  $userPassword = $_POST["userPassword"];
  $userPasswordCheck = $_POST["userPasswordCheck"];
  $name = $_POST["userName"];
  $studentNumber = $_POST["studentNumber"];
  $department = $_POST["department"];
  $mail = $_POST["mail"];
  $phone = $_POST["phone"];
  
  /*password check*/
  if ($userPassword != $userPasswordCheck){
    echo ("<script>alert(\"비밀번호를 확인하십시오.\");</script>");
  echo("<script>location.replace('register_stud.html');</script>");
    exit();
  }

  /*ID check*/
  $checkID = "SELECT * FROM Students WHERE ID='$userID'";
  $checkResult = $con->query($checkID);
  if ($checkResult->num_rows == 1){
    echo ("<script>alert(\"아이디가 중복되어 사용하실 수 없습니다.\");</script>");
  echo("<script>location.replace('register_stud.html');</script>");
    exit();
  }
  
  /*insert data*/
  $signUp = "INSERT INTO Students (ID, PW, name, department, studentNumber, mail, phoneNumber) VALUES ('$userID', '$userPassword', '$name', '$department', '$studentNumber', '$mail', '$phone')";
  $checkSignUp = $con->query($signUp);
  if ($checkSignUp){
    echo "comeplete";
  }
  
  /*send mail*/
  $from="RentalService";
  $subject="인증 메일 입니다.";
  $body="http://106.10.43.197/verify.php?u_id=$userID        해당 URL을 실행하면 인증이 완료됩니다.";
  $cc="";
  $bcc="";

  $sendmail->send_mail($mail,$from, $subject, $body, $cc, $bcc);
  echo ("<script>alert(\"Signed up\");</script>");
  echo("<script>location.replace('login.html');</script>");

  
?>