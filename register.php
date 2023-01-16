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
		a {
			color: #92badd;
			display:inline-block;
			text-decoration: none;
			font-weight: 400;
		}

		h2 {
			text-align: center;
			font-size: 16px;
			font-weight: 600;
			text-transform: uppercase;
			display:inline-block;
			margin: 40px 8px 10px 8px;
			color: #cccccc;
		}
		.wrapper {
			display: flex;
			align-items: center;
			flex-direction: column;
			justify-content: center;
			width: 100%;
			min-height: 100%;
			padding: 20px;
		}

		#formContent {
			-webkit-border-radius: 10px 10px 10px 10px;
			border-radius: 10px 10px 10px 10px;
			background: #fff;
			padding: 30px;
			width: 90%;
			max-width: 450px;
			position: relative;
			padding: 0px;
			-webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
			box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
			text-align: center;
		}

		#formFooter {
			background-color: #f6f6f6;
			border-top: 1px solid #dce8f1;
			padding: 25px;
			text-align: center;
			-webkit-border-radius: 0 0 10px 10px;
			border-radius: 0 0 10px 10px;
		}




		h2.inactive {
			color: #cccccc;
		}

		h2.active {
			color: #0d0d0d;
			border-bottom: 2px solid #5fbae9;
		}




		input[type=submit], input[type=reset]  {
			background-color: #56baed;
			border: none;
			color: white;
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			text-transform: uppercase;
			font-size: 13px;
			-webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
			box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
			-webkit-border-radius: 5px 5px 5px 5px;
			border-radius: 5px 5px 5px 5px;
			margin: 10px 10px 10px 10px;
			-webkit-transition: all 0.3s ease-in-out;
			-moz-transition: all 0.3s ease-in-out;
			-ms-transition: all 0.3s ease-in-out;
			-o-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}
		input[type=button]{
			background-color: #56baed;
			border: none;
			color: white;
			padding: 10px 25px;
			text-align: center;
			text-decoration: none;
			text-transform: uppercase;
			font-size: 13px;
			-webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
			box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
			-webkit-border-radius: 5px 5px 5px 5px;
			border-radius: 5px 5px 5px 5px;
			margin: 10px 10px 10px 10px;
			-webkit-transition: all 0.3s ease-in-out;
			-moz-transition: all 0.3s ease-in-out;
			-ms-transition: all 0.3s ease-in-out;
			-o-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
			background-color: #39ace7;
		}

		input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
			-moz-transform: scale(0.95);
			-webkit-transform: scale(0.95);
			-o-transform: scale(0.95);
			-ms-transform: scale(0.95);
			transform: scale(0.95);
		}

		input[type=text] {
			background-color: #f6f6f6;
			border: none;
			color: #0d0d0d;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 5px;
			width: 85%;
			border: 2px solid #f6f6f6;
			-webkit-transition: all 0.5s ease-in-out;
			-moz-transition: all 0.5s ease-in-out;
			-ms-transition: all 0.5s ease-in-out;
			-o-transition: all 0.5s ease-in-out;
			transition: all 0.5s ease-in-out;
			-webkit-border-radius: 5px 5px 5px 5px;
			border-radius: 5px 5px 5px 5px;
		}

		input[type=text]:focus {
			background-color: #fff;
			border-bottom: 2px solid #5fbae9;
		}

		input[type=text]:placeholder {
			color: #cccccc;
		}




		.fadeInDown {
			-webkit-animation-name: fadeInDown;
			animation-name: fadeInDown;
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
		}

		@-webkit-keyframes fadeInDown {
			0% {
				opacity: 0;
				-webkit-transform: translate3d(0, -100%, 0);
				transform: translate3d(0, -100%, 0);
			}
			100% {
				opacity: 1;
				-webkit-transform: none;
				transform: none;
			}
		}

		@keyframes fadeInDown {
			0% {
				opacity: 0;
				-webkit-transform: translate3d(0, -100%, 0);
				transform: translate3d(0, -100%, 0);
			}
			100% {
				opacity: 1;
				-webkit-transform: none;
				transform: none;
			}
		}

		@-webkit-keyframes fadeIn {
				from {
					opacity:0;
				}
				to {
					opacity:1;
				}
		}
		@-moz-keyframes fadeIn {
				from {
					opacity:0; }
				to { opacity:1;
				}
		}
		@keyframes fadeIn {
				from {
					opacity:0;
				}
				to {
					opacity:1;
				}
		}

		.fadeIn {
			opacity:0;
			-webkit-animation:fadeIn ease-in 1;
			-moz-animation:fadeIn ease-in 1;
			animation:fadeIn ease-in 1;
			-webkit-animation-fill-mode:forwards;
			-moz-animation-fill-mode:forwards;
			 animation-fill-mode:forwards;
			-webkit-animation-duration:1s;
			-moz-animation-duration:1s;
			animation-duration:1s;
		}

		.fadeIn.first {
			-webkit-animation-delay: 0.4s;
			-moz-animation-delay: 0.4s;
			animation-delay: 0.4s;
		}

		.fadeIn.second {
			-webkit-animation-delay: 0.6s;
			-moz-animation-delay: 0.6s;
			animation-delay: 0.6s;
		}

		.fadeIn.third {
			-webkit-animation-delay: 0.8s;
			-moz-animation-delay: 0.8s;
			animation-delay: 0.8s;
		}

		.fadeIn.fourth {
			-webkit-animation-delay: 1s;
			-moz-animation-delay: 1s;
			animation-delay: 1s;
		}

		.underlineHover:after {
			display: block;
			left: 0;
			bottom: -10px;
			width: 0;
			height: 2px;
			background-color: #56baed;
			content: "";
			transition: width 0.2s;
		}

		.underlineHover:hover {
			color: #0d0d0d;
		}

		.underlineHover:hover:after{
			width: 100%;
		}




		*:focus {
			outline: none;
		}

		#icon {
			width:60%;
		}
	</style>
	<body>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				<br>
  					<h1>Registration</h1>
						<form method="post" action="register.php">
<?php if (isset($_GET['error']) && $_GET['error'] == 'username_taken'): ?>
<div class="alert alert-danger" role="alert">That username is already taken</div>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 'password_mismatch'): ?>
<div class="alert alert-danger" role="alert">The passwords you entered do not match</div>
<?php endif; ?>
<?php if(isset($_GET['success']) && $_GET['success'] == '1'): ?>
<div class="alert alert-success" role="alert">You have successfully registered</div>
<?php endif; ?>
    							<input type="text"class="fadeIn second" id="username" name="username" required placeholder="Username"><br>
    							<input type="text"class="fadeIn third" id="password" name="password" required placeholder="Password"><br>
							<input type="text"class="fadeIn fourth" id="password_confirmation" name="password_confirmation" required placeholder="Password Comfirmation"><br>
							<input type="submit" class="fadeIn fourth"value="Register">
							<input type="button" class="fadeIn fourth"value="back" onclick="window.location.href='index.php'">
						</form>
			</div>
		</div>
	</body>
</html>
