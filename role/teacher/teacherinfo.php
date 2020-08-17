<?php
	session_start();
	include("../getinfo.php");
	if (isset($_GET["table"]) and isset($_GET["param"])){
	
		$table = $_GET["table"];
		$param = $_GET["param"];
		if (isset($_GET["s"])){
			$value = $_GET["s"];
			echo searching($table,$param,$value);		
		}
		else if (isset($_GET["value"])){
			$value = $_GET["value"];
			echo get_info($table,$param,$value);
		}
	}
	else{
	echo json_encode(array("id"=>$_SESSION['id']));
	}
?>
