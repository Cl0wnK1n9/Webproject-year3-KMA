<!DOCTYPE html>
<html lang="en">
	<head>
		<title> Login </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">  
		<script type="text/javascript" src="vendor/bootstrap.js"></script>
		<!-- <script type="text/javascript" src="1.js"></script> -->
		<link rel="stylesheet" href="vendor/bootstrap.css">
		<link rel="stylesheet" href="vendor/font-awesome.css">
		<link rel="stylesheet" href="css/login.css">
	</head>
	<body style="background-image: url('images/bg-01.jpg')">
	<?php		
		include("./dbconnector.php");
		session_start();
		
		$sql = "SELECT password,username FROM user WHERE id=? and password=? and role=? limit 1";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("sss", $id,$password, $role);
				
		if(isset($_SESSION["id"]) and isset($_SESSION["username"]) and isset($_SESSION["password"]) and isset($_SESSION['role'])){
			/* debug: echo "Jump 1";*/
			$id= $_SESSION["id"];
			$password= $_SESSION["password"];
			$role= $_SESSION["role"];
			$stmt->execute();
			$result = $stmt->get_result();
			$data = $result->fetch_all(MYSQLI_ASSOC);
			if (!sizeof($data)){
					echo "<b style='color:red'>Username/password incorrect</b>";
				}
				else{
					if ($data[0]["password"]==$password){
						$_SESSION["username"]=$data[0]["username"];
						$_SESSION["password"]=$password;
						$_SESSION["role"]=$role;
						$_SESSION["id"]=$id;
						header("Location:./index.php");
					}
					else{
						echo "<b style='color:red'>Username/password incorrect</b>";
					}
				}
			$stmt->close();
		}
		else{
			session_destroy();
			session_start();
			if(isset($_POST["id"]) and isset($_POST["password"]) and isset($_POST["role"])){
				/*debug: echo "Jump 2";*/
				$id= $_POST["id"];
				$password= $_POST["password"];
				$role = $_POST["role"];
				$stmt->execute();
				$result = $stmt->get_result();
				$data = $result->fetch_all(MYSQLI_ASSOC);
				if (!sizeof($data)){
					echo "<b style='color:red'>ID/password incorrect</b>";
				}
				else{
					if ($data[0]["password"]==$password){
						$_SESSION["username"]=$data[0]["username"];
						$_SESSION["password"]=$password;
						$_SESSION["id"]=$id;
						$_SESSION["role"]=$role;
						header("Location:./index.php");
					}
					else{
						echo "<b style='color:red'>Username/password incorrect</b>";
					}
				}
				$stmt->close();
			}
		}
		$conn->close();
	?>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-6 push-lg-3">
				<div class="login-content card">
					<h2>Welcome to <br> <span style="color: red">A</span><span style="color: yellow">B</span><span style="color: green">C</span></h2>
					<form action="#" method="POST">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-12 form-control-label">Username </label><br>
							<div class="col-sm-12">
								<input type="text" class="form-control input" name="id" placeholder="Your ID">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-12">Password</label><br>
							<div class="col-sm-12">
								<input type="password" class="form-control input" name="password" placeholder="Password">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12">Role</label><br>
							<div class="col-sm-12 box">
								<select name="role" >
									<option value="teacher">Teacher</option>
									<option value="administrator">Admin</option>
									<option value="student">Student</option>
								</select>
								
								
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary" onclick="check()">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<footer>Trung Tâm Tiếng Anh ABC - Học Viện KMA</footer>
	</body>
</html>