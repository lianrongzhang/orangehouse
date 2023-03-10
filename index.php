<?php
session_start();
$_SESSION['role'] = 'guest';
?>
<html>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

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
			padding: 10px 23px;
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
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 20px;
			margin: 5px;
			width: 75%;
			border: 2px solid #f6f6f6;
			-webkit-transition: all 0.5s ease-in-out;
			-moz-transition: all 0.5s ease-in-out;
			-ms-transition: all 0.5s ease-in-out;
			-o-transition: all 0.5s ease-in-out;
			transition: all 0.5s ease-in-out;
			-webkit-border-radius: 5px 5px 5px 5px;
			border-radius: 5px 5px 5px 5px;
		}
		input[type=password] {
			background-color: #f6f6f6;
			border: none;
			color: #0d0d0d;
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 20px;
			margin: 5px;
			width: 75%;
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
	<head>
		<title>???????????????</title>
	</head>

	<body>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				<br>
					<h1>???????????????</h1>
							<form method="post">
							<input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
							<input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
							<input type="submit" id="login" name="login" class="fadeIn fourth" value="login">
							<input type="button" id="register" name="register" class="fadeIn fourth" value="register" onclick="location.href='register.php'">
							</form>
<?php
$conn = new mysqli("localhost","root","root","Talen");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = $conn->query($query);
	if($result->num_rows > 0) {
		$value = 1;
		$_SESSION['role'] = 'user';
	} 
	else {
		$value = 0;
	}
}
?>
<script>
var value = <?php echo $result->num_rows;?>;
if(value == 1){
	Swal.fire({
		title : 'Success!',
		text : 'You have successfully logged in.',
		icon : 'success',
	}).then(function(){
		window.location = "main.php"
	});

}
if(value == 0){
	Swal.fire({
		title : 'Error!',
		text : 'Invalid username or password !!',
		icon : 'error'
	})
}
</script>
			</div>
		</div>
	</body>
</html>
