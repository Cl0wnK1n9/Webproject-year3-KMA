<?php
			if(!isset($_SESSION) and !isset($_SESSION["username"]) and !isset($_SESSION["password"]) and !isset($_SESSION["role"])){
				header("Location: http://127.0.0.1/KMA/Login.php");	
			}
			else if ($_SESSION["role"]!="administrator"){
				header("Location: http://127.0.0.1/KMA/Index.php");	
			}
?>