<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
include('../db_config.php');
$DB = new FRUIT_DB();
session_start();
if(!isset ($_SESSION['role']) ||  $_SESSION['role']!='user'){
	http_response_code(403);
	die();
}
$supplier = array(array());
$conn = new mysqli('localhost','root','root',"Talen");

$sql = 'select * from supplier';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$supplier = $result->fetch_all(MYSQLI_ASSOC);
?>
<html>
	<head>
		<title>供應商資料表</title>
		<style>
			div{
				text-align: left-center;
			}
			h2{
				text-align: left-center;
			}
			table, th, td {
				text-align: center;
				border-spacing: 1px;
				border: 1px solid black;
				font-size: 18px;
				padding : 5px;
			}
			body{
				background-color: #F5F5F5;
			}
			.container {
				max-width: 2000px;
				width: 100%;
				height: 100%;
			}
			.left {
				width: 30%;
				height: 100%;
				float: left;
			}
			.right {
				width: 65%;
				height: 100%;
				float: right;
			}
			.print{
			}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #CFD8DC">
  			<div class="container-fluid">
    				<div class="collapse navbar-collapse" id="navbarNavDropdown">
      					<ul class="navbar-nav">
        					<li class="nav-item">
          						<a class="nav-link active" aria-current="page" href="/Talen/main.php">Home</a>
        					</li>&nbsp;
        					<li class="nav-item dropdown">
          						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Fruit</a>
          						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            							<li><a class="dropdown-item" href="/Talen/fruit/">Fruit</a></li>
            							<li><a class="dropdown-item" href="/Talen/inactivefruit/">InactiveFruit</a></li>
          						</ul>
        					</li>
        					
						<li class="nav-item dropdown">
          						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Member</a>
          						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            							<li><a class="dropdown-item" href="/Talen/member/">Member</a></li>
            							<li><a class="dropdown-item" href="/Talen/inactivemember/">InactiveMember</a></li>
          						</ul>
        					</li>
	
						<li class="nav-item dropdown">
          						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Supplier</a>
          						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            							<li><a class="dropdown-item" href="/Talen/supplier/">Supplier</a></li>
            							<li><a class="dropdown-item" href="/Talen/inactivesupplier/">InactiveSupplier</a></li>
          						</ul>
        					</li>
        					
						<li class="nav-item dropdown">
          						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Trade</a>
          						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            							<li><a class="dropdown-item" href="/Talen/trade/">Trade</a></li>
            							<li><a class="dropdown-item" href="/Talen/inactivetrade/">InactiveTrade</a></li>
          						</ul>
        					</li>
      					</ul>
    				</div>
  			</div>
		</nav>
		<div class="container">
			<br>
				<div class="left">
					 <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供應商資料表</h3>
					<form method="post" action="index.php" enctype="multipart/form-data">
						供應商統一編號 : <input type="text" maxlength="8" name="supplier_id" pattern="\d{8}">&nbsp;
						<input type="submit" class="btn btn-outline-dark btn-sm"name="search" value="查詢"><br>

					<br>
						名稱 : <input type="text" maxlength="12" name="supplier_name" ><br>
					<br>
						電話 : <input type="tel" maxlength="16" name="supplier_tel" pattern="\d{10}"><br>
					<br>
						地址 : <input type="text" maxlength="60" name="supplier_address" ><br>
					<br>
						負責人 : <input type="text" maxlength="12" name="supplier_CEO" maxlength="12"><br>
					<br>
						Email : <input type="email" maxlength="36" name="supplier_email"><br>
					<br>
						<input class="btn btn-outline-dark btn-sm"type="submit" name="add" value="新增">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="btn btn-outline-dark btn-sm"type="submit" name="delete" value="刪除">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="btn btn-outline-dark btn-sm"type="submit" name="update" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="btn btn-outline-dark btn-sm"type="button" name="refresh" value="重整" onclick=location.replace("/Talen/supplier/index.php")>
					</form>
				</div>
				
				<div class="right">
					<div class="print">
<?php
$DB->get_all_supplier();
if (isset($_POST['add'])) {
	$count = 0;
	if($_POST['supplier_id'] == "" || $_POST['supplier_name'] == "" || $_POST['supplier_tel'] == "" || $_POST['supplier_address'] == "" || $_POST['supplier_CEO'] == "" || $_POST['supplier_email'] == ""){
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入完整資料',showConfirmButton: false,timer: 3000})</script>";
	}
	else{
		for($i = 0; $i < count($supplier); $i++){
			if($_POST['supplier_id'] == $supplier[$i]['supplier_id']){
				$count++;
			}
		}
		if($count==0){
			$INPUT = [];
			foreach (array_values ($DB->supplier_schema) as $val)
				if ($val != "supplier_flag")
					$INPUT[] = $_POST[$val];
			array_push($INPUT, 0);
			$DB->add_supplier ($INPUT);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'新增成功',showConfirmButton: false})</script>";
			echo "<script>setTimeout(function(){location.replace('/Talen/supplier/index.php')}, 1500);</script>";
		}
		else{
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '供應商編號重複',showConfirmButton: false,timer: 3000,})</script>";
		}
	}
}
if (isset($_POST['delete'])) {
	if($_POST['supplier_id']=="")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入供應商編號',showConfirmButton: false,timer: 3000,})</script>";
	else{
		$INPUT = [];
		array_push($INPUT,"1");
		array_push($INPUT,$_POST["supplier_id"]);
		$DB->del_supplier($INPUT);
		echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'刪除成功',showConfirmButton: false})</script>";
		echo "<script>setTimeout(function(){location.replace('/Talen/supplier/index.php')}, 1500);</script>";

	}
}
if (isset($_POST['update'])){
	if($_POST['supplier_id']=="")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入供應商編號',showConfirmButton: false,timer:3000})</script>";
	else{
		if($_POST['supplier_name'] == "" && $_POST['supplier_tel'] == "" && $_POST['supplier_address'] == "" && $_POST['supplier_CEO'] == "" && $_POST['supplier_email'] == "")
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入欲修改之資料',showConfirmButton: false,timer:3000})</script>";
		else{
			if($_POST['supplier_name'] != "")
				echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '供應商名稱不可修改',showConfirmButton: false,timer:3000})</script>";
			else{
				$INPUT = [];
				foreach (array_values ($DB->supplier_schema) as $val)
					if ($val != "supplier_flag"&&!empty($_POST[$val]))
						$INPUT[$val] = $_POST[$val];
				$DB->update_supplier($INPUT,$_POST["supplier_id"]);
				echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'修改成功',showConfirmButton: false})</script>";
				echo "<script>setTimeout(function(){location.replace('/Talen/supplier/index.php')}, 1500);</script>";
			}
		}

	}
}
if(isset($_POST['search'])){
		if($_POST['supplier_id'] == "" && $_POST['supplier_name'] == "" && $_POST['supplier_tel'] == "" && $_POST['supplier_address'] == "" && $_POST['supplier_CEO'] == "" && $_POST['supplier_email'] == "")
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入欲查詢資料',showConfirmButton: false,timer:3000})</script>";
		else{
			$INPUT = [];
			foreach (array_values ($DB->supplier_schema) as $val)
				if ($val != "supplier_flag" && !empty($_POST[$val]))
					$INPUT[$val] = $_POST[$val];
			$DB->get_supplier($INPUT);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'查詢成功',showConfirmButton: false,timer:3000})</script>";
		}
}
?>

					</div>
					<br>
					<input class="btn btn-outline-dark btn-sm" type="button" onclick=printDiv() value="列印">
				</div>
		</div>
	</body>
</html>
<script>
function printDiv() {
	var divToPrint = document.getElementsByClassName("print")[0];
	var printWindow = window.open();
	printWindow.document.write(divToPrint.outerHTML);
	printWindow.document.close();
	printWindow.focus();
	var link = document.createElement("link");
        link.innerHTML = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">'
        printWindow.document.head.appendChild(link);
	var style = printWindow.document.createElement("style");
	style.innerHTML = 'table, th, td {text-align: center;border-collapse:collapse;border-spacing: 2px;padding:5px;border: 2px solid black; font-size: 20px;}';
	printWindow.document.head.appendChild(style);
	printWindow.print();
	printWindow.close();
}
</script>
