<?php
header('content-type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");
mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");
mysql_query("set names utf8");

$idx = $_GET["idx"];
$sql = "SELECT * FROM Applicants WHERE idx='$idx'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$room_idx = $row['room_idx'];
$student_idx = $row['student_idx'];
$date = $row['date'];
$tstart = $row['start'];
$tend = $row['end'];
$purpose = $row['purpose'];
$capability = $row['capability'];
$ps = $row['ps'];
$agree = $row['agree'];

$room_sql = "SELECT * FROM Room WHERE idx='$room_idx'";
$room_result = $con->query($room_sql);
$r = $room_result->fetch_assoc();

$building = $r['building'];
$room_name = $r['room_name'];
$max_capability = $r['maximum_capability'];
$table_chair = $r['table_chair'];
$room_ps = $r['ps'];

?>

<!DOCTYPE HTML>
<html>
<head>

<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>Apply_details</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
<style>
#second { position:absolute;margin-top:25px;width:100%;text-align: center;}
</style>

</head>
<body>
<div data-role="page" id="room_detail" >
  <div data-role="header" data-position="fixed">
    <a href="#" data-icon="back" data-rel="back" data-direction="reverse">Back</a>
    <h1>대여 신청 정보</h1>
  </div>
  
  <div data-role="content">
  
	<h2 align="center"><?=$building?> <?=$room_name?></h2><br>

  
	<div>
		<h3 style="margin:10px">  강의실 정보</h3>
		<ul style="list-style-type:disc">
		  <li><b>최대수용인원 :  </b> <?=$max_capability?></li>
		  <li><b>테이블 및 의자 수 </b><p style="margin:0"><?=$table_chair?></p></li>
		  <li><b>기타 특이사항  </b><p style="margin:0"><?=$room_ps?></p></li>
		</ul>
	</div>
	
	<br>

	<div>
		<h3 style="margin:10px">  나의 신청 정보</h3>
		<ul style="list-style-type:circle">
		  <li><b>사용 인원 : </b><?=$capability?></li>
		  <li><b>대여 날짜 : </b><?=$date?></li>
		  <li><b>대여 시간 : </b><?=$tstart?> ~ <?=$tend?></li>
		  <li><b>대여 목적 : </b><p style="margin:0"><?=$purpose?></p></li>
		  <li><b>기타 특이사항 </b><p style="margin:0"><?=$ps?></p></li>
		</ul>
	</div>
	
	<br><br><br>

	<div align="center">
		<a href="cancel.php?idx=<?=$idx?>" data-role="button" data-inline="true" data-theme="b">신청 취소</a>
	</div>
  </div>
  <div data-role="footer" data-position="fixed">
    <h2>부산대학교 강의실 대여 앱</h2>
  </div>
</div>
</body>
</html>