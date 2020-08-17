<?php
include("../../dbconnector.php");
function getclass($conn){
	$sql = "SELECT classid from class where status=\"1\"";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	return json_encode($data);
}
function getteacher($conn){
	$sql = "SELECT id from user where role = \"teacher\"";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	return json_encode($data);
}

function getstudent($conn,$class){
	$sql = "SELECT studentID from student where class = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s",$class);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	return json_encode($data);
}
if(isset($_GET["getclass"])){
	echo getclass($conn);
}
else if (isset($_GET["getteacher"])){
	echo getteacher($conn);
}
else if (isset($_GET["class"])){
	echo getstudent($conn,$_GET["class"]);
}
else {
	echo "{}";
}
?>