<html>
	<head>
		<title>ABC english center</title>
	</head>
	<body>
	<?php
			session_start();
			include("./dbconnector.php");
			if(!isset($_SESSION) or !isset($_SESSION["username"]) or !isset($_SESSION["password"]) or !isset($_SESSION["role"]) or isset($_GET['logout'])){
				session_destroy();
				header("Location: http://127.0.0.1/KMA/Login.php");	
			}
			else{
				$button = "<button class=\"btnlogin\" onclick=\"window.location='./?logout=1'\">Log out</button>";
				$role=$_SESSION["role"];
				if($role=="administrator"){
					$file_dir = "./role/admin/admin.html";
				}
				else if($role=="teacher"){
					$file_dir = "./role/teacher/teacher.html";
				}
			else {
				$file_dir = "./role/student/student.html";
			}
			}
			include($file_dir);
		?>
	</body>
</html>