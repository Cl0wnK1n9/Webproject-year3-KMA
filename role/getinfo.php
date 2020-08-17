<?php
	function get_info($table,$param_name,$param_value){
		include("D:/xampp/htdocs/KMA/dbconnector.php");
		$sql = "SELECT * from $table where $param_name=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s",$param_value);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);
		$stmt->close();
		return json_encode($data);
	}
	
	function searching($table,$param_name,$param_value){
		$param_value = "%$param_value%";
		include("D:/xampp/htdocs/KMA/dbconnector.php");
		$sql = "SELECT * from $table where $param_name like ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s",$param_value);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);
		$stmt->close();
		$i = 0;
		for ($i; $i<sizeof($data);$i++){
			$data[$i]["password"]="****************";
		}
		return json_encode($data);
	}
?>