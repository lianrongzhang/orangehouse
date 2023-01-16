<?php
include 'db_config.php';
$DB = new FRUIT_DB();
session_start();
if(!isset ($_SESSION['role']) ||  $_SESSION['role']!='user'){
	http_response_code(403);
	die();
}
?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
		<title>東海水果行</title>
			<style>
				div {
					text-align: center;
				}
				h2 {
					text-align: center;
				}
				body{
					background-color: #ECEFF1;
				}
				
		</style>
	</head>

	<body>
		<br>
			<h2>東海水果行管理選單</h2>
		<br>
		<br>
				<div>
					<div class="btn-group">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">水果資料表</button>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/Talen/fruit/">Fruit</a></li>
							<li><a class="dropdown-item" href="/Talen/inactivefruit/">InactiveFruit</a></li>
						</ul>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<div class="btn-group">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">會員資料表</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="/Talen/member/">Member</a></li>
								<li><a class="dropdown-item" href="/Talen/inactivemember/">InactiveMember</a></li>
							</ul>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<div class="btn-group">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">供應商資料表</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="/Talen/supplier/">Supplier</a></li>
								<li><a class="dropdown-item" href="/Talen/inactivesupplier/">InactiveSupplier</a></li>
							</ul>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<div class="btn-group">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">交易資料表</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="/Talen/trade/">Trade</a></li>
								<li><a class="dropdown-item" href="/Talen/inactivetrade/">InactiveTrade</a></li>
							</ul>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<input type="submit"id="logout" name="logout" value="登出" class="btn btn-secondary dropdown-toggle">
<script>
var btn = document.getElementById('logout');
btn.addEventListener('click', function() {
	Swal.fire({
		title: 'Warning',
		text: "Are you sure you want to logout ?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Confirm'
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				title : 'Success!',
				text : 'You have been logged out.',
				icon : 'success'
			}).then(function() {
					window.location = "index.php";
				});
		}
	})
});
</script>
<?php
if(isset($_POST['logout'])){
session_unset('value');
session_destroy();
exit;
}
?>
				</div>
				<br>
				<div>
					<form method="post">
<?php
for($i=0;$i<10;$i++){
	echo "<button name=" . $i . ">" . $i . "</button>";
}
?>	
					</form>
<?php
for ($i = 0; $i < 10; $i++)
	if(isset($_POST['0' + $i]))
		echo '1' + $i;
?>
    				</div>
    </body>
</html>

