<?php
	session_start();
	include("../../role/checkrole/student.php");
	include("../../dbconnector.php");
	$return_data = array();
	$sql = "SELECT ID from user where username=?"; //get studentID
	$sql2 = "SELECT classID from class where studentID=?";// get ClassID
	$sql3 = "SELECT * FROM point where studentID=?"//get point
	
	$name = $_SESSION["username"];
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s",$name);
	$stmt->execute();
	$result = $stmt->get_result();
	$student_data = $result->fetch_all(MYSQLI_ASSOC);
	$studentID = $student_data[0]["studentID"];
	$stmt->close();
	
	$stmt = $conn->prepare($sql2);
	$stmt->bind_param("s",$studentID);
	$stmt->execute();
	$result = $stmt->get_result();
 	$class_data=$result->fetch_all(MYSQLI_ASSOC);
	$classID = $class_data[0]["classID"];
	$stmt->close();
	
	$stmt = $conn->prepare($sql3);
	$stmt->bind_param("s",$studentID);
	$stmt->execute();
	$result = $stmt->get_result();
 	$class_data=$result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
?>
