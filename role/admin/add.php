<?php
include("../../dbconnector.php");

function adduser($conn,$id,$username,$password,$role){
	$query= "insert into user(id,username,password,role) values (?,?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ssss",$id,$username,$password,$role);
	$stmt->execute();
}

function addstudent($conn,$id){
	$query= "insert into student(studentID) values (?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s",$id);
	$stmt->execute();
}

function addclass($conn,$id,$teacherID,$start,$end,$schedule,$status){
	$query= "insert into class(classID,teacherID,start,end,schedule,status) values (?,?,?,?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ssssss",$id,$teacherID,$start,$end,$schedule,$status);
	$stmt->execute();
}

function updateclass($conn,$class,$studentID){
	$query= "UPDATE student set class = ? where studentID = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss",$class,$studentID);
	$stmt->execute();
}

function addGrade($conn,$classID,$studentID,$grade){
	$query= "INSERT into grade(StudentId,ClassId,Grade) values(?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sss",$studentID,$classID,$grade);
	$stmt->execute();
}

function updateStatusClass($conn,$class,$status){
	$query= "UPDATE class set status = ? where classID = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss",$status,$class);
	$stmt->execute();
}

function genID()
    {
        $characters = '0123456789';
        $randstring = '';
        for ($i = 0; $i < 6; $i++) {
            $randstring .= $characters[rand(0,6)];
        }
        return $randstring;
    }

//main
if(isset($_GET["action"])){
	$action = $_GET["action"];
	if ($action=="xxx"){
		$username = $_GET["username"];
		$password = $_GET["password"];
		$role = $_GET["role"];
		$ID = genID();
		adduser($conn,$ID,$username,$password,$role);
		if($role == "student"){
			addstudent($conn,$ID);
		}
	}else if ($action == "class"){
		$classid = $_GET["classid"];
		$teacherid = $_GET["teacherid"];
		$start = $_GET["start"];
		$end = $_GET["end"];
		$schedule = $_GET["schedule"];
		addclass($conn,$classid,$teacherid,$start,$end,$schedule,"1");
	}else if($action == "update"){
		$classid = $_GET["classid"];
		$studentid = $_GET["studentid"];
		updateclass($conn,$classid,$studentid);
	}else if($action == "status"){
		$classid = $_GET["classid"];
		$status = $_GET["status"];
		updateStatusClass($conn,$classid,$status);
	}else if($action=="grade"){
		$classid = $_GET["classid"];
		$studentid = $_GET["studentid"];
		$grade = $_GET["grade"];
		addGrade($conn,$classid,$studentid,$grade);
		echo "Success";
	}else{
		die();
	}
}else {
	echo "unknow action";
}
?>