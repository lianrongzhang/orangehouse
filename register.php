<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
  		<title>Registration</title>
	</head>
		<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			height: 100vh;
		}
		h1 {
			text-align: center;
			font-size: 35px;
			font-weight: 600;
			text-transform: uppercase;
			margin: 350px 0px 20px 0px;
		}
		div {
			text-align: center;
		}
		a {
			color: #92badd;
			display:inline-block;
			text-decoration: none;
			font-weight: 400;
		}
		input[type=button] {
			background-color: #56baed;
			border: none;
			color: white;
			padding: 5px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			text-transform: uppercase;
			font-size: 13px;
			box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
			border-radius: 5px 5px 5px 5px;
			margin: 10px 10px 10px 10px;
		}
		input[type=submit] {
			background-color: #56baed;
			border: none;
			color: white;
			padding: 5px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			text-transform: uppercase;
			font-size: 13px;
			box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
			border-radius: 5px 5px 5px 5px;
			margin: 10px 10px 10px 10px;
		}
		</style>
	<body>
  		<h1>Registration</h1>
		<div>
			<form method="post" class="a"  action="register.php">
				<label for="username">Username :</label>
    				<input type="text"class="form-control-m" id="username" name="username" required><br>
				<br>
				<label for="password">Password :</label>
    				<input type="password"class="form-control-m" id="password" name="password" required><br>
				<br>
				<label for="password_confirmation">Password Confirmation :</label>
				<input type="password"class="form-control-m" id="password_confirmation" name="password_confirmation" required><br>
				<br>
				<input type="submit" value="Register">
				<input type="button" value="back" onclick="window.location.href='index.php'">
			<?php if (isset($_GET['error']) && $_GET['error'] == 'username_taken'): ?>
    				<p style="color: red;">That username is already taken</p>
			<?php endif; ?>
			<?php if (isset($_GET['error']) && $_GET['error'] == 'password_mismatch'): ?>
    				<p style="color: red;">The passwords you entered do not match</p>
			<?php endif; ?>
			<?php if(isset($_GET['success']) && $_GET['success'] == '1'): ?>
				<p style="color: green;">You have successfully registered</p>
			<?php endif; ?>
			</form>
		</div>
	</body>
</html>
<?php
require('db_config.php');
$DB =  new FRUIT_DB();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {
	if($_POST['password'] == $_POST['password_confirmation']) {
		$username = $DB->connect->real_escape_string($_POST['username']);
		$password = $DB->connect->real_escape_string($_POST['password']);
		$query = "SELECT * FROM users WHERE username='$username'";
		$result = $DB->connect->query($query);
		if ($result->num_rows > 0) {
			header('Location: register.php?error=username_taken');
			exit;
		}
		else {
			$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
			$result = $DB->connect->query($query);
			header('Location: register.php?success=1');
			exit;
		}
	} else {
		header('Location: register.php?error=password_mismatch');
	}
}
?>

