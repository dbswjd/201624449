<?php
header('content-type: text/html; charset=utf-8');

session_start();
$id = $_SESSION['studid'];
if (!$id) {
	echo ("<script>alert(\"세션이 만료되었습니다. 로그인 페이지로 이동합니다.\");</script>");
    echo("<script>location.replace('login.html');</script>");
}
$con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");
mysql_query("set names utf8");

$sql = "SELECT * FROM Students WHERE ID='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$warning = $row['warning']; 
$idx = $row['idx'];
$name = $row['name'];
?>

<!DOCTYPE HTML>
<html>
<head>

<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student_01</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>

<style>
  #second { position:absolute;margin-top:20px;width:100%;text-align: center;}

  
.mypage{
    overflow:hidden;
}
.mypage span{
	font-weight: normal;
}


.info {
    background:#d8d8d8d8;
    overflow:hidden;
}
.info h4 {
	font-size:16px;
    margin:0px;
    padding:5px;
    padding-bottom:0px;
}
.info p {
	font-size:16px;
    margin:0px;
    padding:5px;
}
.info span {
	font-size:16px;
    font-weight: normal;
}
</style>

<script>
function showUser(str){
	if (str == ""){
		document.getElementById("roomInfo").innerHTML = "";
		return;
	}else{               
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				document.getElementById("roomInfo").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "roomInfo.php?room="+str, true);
		xmlhttp.send();
	}
}

function isPossible(str){
	              
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			document.getElementById("possibility").innerHTML = this.responseText;
		}
	};
	
	var building = document.getElementById("building").value;
	xmlhttp.open("GET", "isPossible.php?date="+str+"&building="+building, true);
	xmlhttp.send();
	
}

</script>


</head>
<body>

<div data-role="page" id="Student_home" >
		<div data-role="header">
		  <h1>반갑습니다   <?=$name?> 님</h1>
		  <a href="login.html" data_role="button" class="ui-btn-right">Log out</a>
		</div>
		<div data-role="content">
			<div class="mypage" id="mypage">
				<h4>경고:  <span><?=$warning?><span></h4>
			</div>
			<a href="#Enrol_room" data-role="button">강의실 대여하기</a>
			<ul data-role="listview" id ="second">
				<li data-role="list-divider">History<p class="ui-li-aside">승인</p></li>	
				<?php
					$history = "SELECT * FROM Applicants WHERE student_idx='$idx' ORDER BY date";
					$his_result = $con->query($history);
					while( $r = $his_result->fetch_assoc() ){
						$room_idx = $r['room_idx'];
						$roomQuery = "SELECT * FROM Room WHERE idx='$room_idx'";
						$roomResult = $con->query($roomQuery);
						$room = $roomResult->fetch_assoc();
						echo("<li data-icon=\"false\"><a href=\"applyInfo.php?idx=".$r['idx']."\"><b>".$r['date']."</b> ".$room['building']." ".$room['room_name']."<p class=\"ui-li-aside\">".$r['agree']."</p></a></li>");
					}
				?>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed">
		  <h2>강의실 대여 앱</h2>
		</div>
</div>

<div data-role="page" id="Enrol_room">
        <div data-role="header" data-position="fixed">
            <a href="#" data-icon="back" data-rel="back" data-direction="reverse">Back</a>
            <h1>강의실 대여하기</h1>
            <a href="#Student_home" data-icon="home" data-iconpos="notext">Home</a>
        </div>
        <div data-role="content">
            <form name="room" method="post" action="apply.php">
                <div class="ui-body ui-body-b gap">

                    <label for="building" class="select">강의실</label>
                    <select name="building" id="building" onchange="showUser(this.value)" data-native-menu="false" data-mini="true" data-inline="true">
					<?php
						echo ("<option value=no>강의실</option>");
						header('content-type: text/html; charset=utf-8');
						$con = mysqli_connect("localhost", "root", "1whsql", "Rental_Place_Service");

						mysqli_query($con, "set session character_set_connection=utf8;");
						mysqli_query($con, "set session character_set_results=utf8;");
						mysqli_query($con, "set session character_set_client=utf8;");
						mysql_query("set names utf8");

						$sql = "SELECT * FROM Room ORDER BY building";
						$result = $con->query($sql);
						if ($result){
							while ($lec = $result->fetch_assoc()){
								echo ("<option value=".$lec['idx'].">".$lec['building']." ".$lec['room_name']."</option>");
							}
						}
						else {
							echo("<option value='-1'>no lecture room</option>");
 						}
					?>
                    </select>

					
					
					<div class="info" id="roomInfo">
					</div>
						
						
					<br>
					
                    <label for="date">대여 날짜 : </label>
                    <input type="date" name="date" id="date" onchange="isPossible(this.value)" data-mini="true" required/>
					<div id="possibility"></div>
					
					<label for="time_start">대여 시작 시간 : </label>
                    <input type="time" name="time_start" id="time_start" data-mini="true" required/>

                    <label for="time_end">대여 마감 시간 : </label>
                    <input type="time" name="time_end" id="time_end" data-mini="true" required/>

                    <label for="capability">사용인원 :</label>
                    <input type="text" placeholder="숫자만 입력해주세요" name="capability" id="capability" data-mini="true" required/>

                    <label for="purpose">대여 목적 :</label>
                    <input type="text" name="purpose" id="purpose" data-mini="true" required/>

                    <label for="ps">기타 특이사항 :</label>
                    <textarea cols="25" rows="5" name="ps" id="ps" data-mini="true"></textarea>
                   
                </div>
                <div class="ui-body">
                    <input type="button" class="ui-btn ui-shadow ui-corner-all ui-icon-arrow-r ui-btn-icon-right" id="btnEnrol" value="신청하기" onclick='submit();'/>
                </div>
            </form>
        </div>
        <div data-role="footer" data-position="fixed">
            <h4>Rental Place Service</h4>
        </div>
</div>
</body>
</html>

