<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
include ("../db_config.php");
$DB = new FRUIT_DB ();
session_start();
if(!isset ($_SESSION['role']) ||  $_SESSION['role']!='user'){
	http_response_code(403);
	die();
}
$fruit = array(array());
$conn = new mysqli('localhost','root','root',"Talen");

$sql = 'select * from fruit';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$fruit = $result->fetch_all(MYSQLI_ASSOC);
?>
<html>
	<head>
		<title>水果資料表</title>
		<style>
			h2{
				text-align: center;
			}
			table, th, td {
				text-align: center;
				border-spacing: 1px;
				border: 1px solid black;
				font-size: 16px;
				padding: 5px;
			}
			.container{
				max-width: 2000px;
				width: 100%;
				height: 100%;
			}
			.left{
				width: 30%;
				height: 100%;
				float: left;
				text-align: left;
			}
			.right{
				width: 65%;
				height: 100%;
				float: right;
				text-align: left;
			}
			.print{
			}
			body{
				background-color: #F5F5F5;
			}
			select {
				background-color: #F5F5F5;
				width: auto;
				height: 2em;
				padding: 3px;
				position: relative;
				border-radius: 5px;
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
					<div class="form-group">
					<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;水果資料表</h3>
					<form method="post" action="index.php" enctype="multipart/form-data">
						水果編號: <input type="text" name="fruit_id"class="form-control-m" pattern="[0-9]{2}-[0-9]{3}-[0-9]{3}-[0-9]{2}"placeholder="YY-YYY-YYY-YY" >&nbsp;&nbsp;
						<input type="submit" name="search"onclick=location.replace("http://localhost/Talen/fruit/index.php") class="btn btn-outline-dark btn-sm"value="查詢"><br>
					<br>
						水果名稱: <input type="text"class="form-control-m" name="fruit_name" maxlength="12"><br>
					<br>
						水果供應商名稱: <select name="fruit_supplier_name">
<?php
$DB->select("supplier_name","supplier","supplier_flag");
?>
								</select><br>
					<br/>
						數量: <input type="number" id="fruit_amount"class="form-control-m" name="fruit_amount" max="999999"><br>
					<br/>
						單位: <input type="text" id="fruit_unit"class="form-control-m" name="fruit_unit" maxlength="4" ><br>
					<br/>
						進貨單價: <input type="number" id="fruit_purchase_price"class="form-control-m" step="0.01"name="fruit_purchase_price"min="0.01" max="999999" ><br>
					<br/>
						現有價值小計: <input type="number"class="form-control-m" id="fruit_value" step="0.01"name="fruit_value"min="0.01" max="999999" ><br>
					<br/>
						公司內存放位置: <input type="text"class="form-control-m" name="fruit_location" maxlength="12"><br>
					<br/>
						進貨日期: <input type="datetime"class="form-control-m" id="fruit_purchase_date"name="fruit_purchase_date"  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"placeholder="YYYY-MM-DD"><br>
					<br/>
						開始促銷日期: <input type="datetime"class="form-control-m"id="fruit_promotion_date" name="fruit_promotion_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"placeholder="YYYY-MM-DD" ><br>
					<br/>
						該丟棄之日期: <input type="datetime"class="form-control-m"id="fruit_discard_date" name="fruit_discard_date"  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"placeholder="YYYY-MM-DD"><br>
					<br/>
						<input type="submit" name="add" class="btn btn-outline-dark btn-sm" value="新增">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="delete"class="btn btn-outline-dark btn-sm" value="刪除">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="update"class="btn btn-outline-dark btn-sm" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" name="reload"class="btn btn-outline-dark btn-sm" value="重整" onclick=location.replace("/Talen/fruit/index.php")>
					</form>
					</div>
				</div>
				<div class="right">
					<div class="print">
<?php



$DB-> get_all_fruit();



if (isset($_POST['add'])){
	$count = 0;
	if($_POST['fruit_id'] == "" || $_POST['fruit_name'] == "" || $_POST['fruit_supplier_name'] == "" || $_POST['fruit_amount'] == "" || $_POST['fruit_unit'] == "" || $_POST['fruit_purchase_price'] == "" || $_POST['fruit_value'] == "" || $_POST['fruit_location'] == "" || $_POST['fruit_purchase_date'] == "" || $_POST['fruit_promotion_date'] == "" || $_POST['fruit_discard_date'] == ""){
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入完整資料',showConfirmButton: false,timer: 3000})</script>";
	}
	else{
		for($i = 0; $i < count($fruit); $i++){
			if($_POST['fruit_id'] == $fruit[$i]['fruit_id']){
				$count++;
			}
		}
		if($count==0){
			$INPUT = [];
			foreach (array_values ($DB->fruit_schema) as $val)
				if ($val != "fruit_flag")
					$INPUT[] = $_POST[$val];
			$INPUT[] = "0";
			$DB->add_fruit($INPUT);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'新增成功',showConfirmButton: false})</script>";
			echo "<script>setTimeout(function(){location.replace('/Talen/fruit/index.php')}, 1500);</script>";
		}
		else{
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '水果編號已存在',showConfirmButton: false,timer:3000})</script>";
		}
	}
}



if (isset($_POST['delete'])){
	if($_POST['fruit_id'] == "")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入水果編號',showConfirmButton: false,timer: 3000,})</script>";
	else{
		$INPUT = [];
		$INPUT[] = "1";
		$INPUT[] = $_POST["fruit_id"];
		$DB->del_fruit($INPUT);
		echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'刪除成功',showConfirmButton: false})</script>";
		echo "<script>setTimeout(function(){location.replace('/Talen/fruit/index.php')}, 1500);</script>";
	}
}



if (isset($_POST['update'])){
	if($_POST['fruit_id']=="")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入水果編號',showConfirmButton: false,timer:3000})</script>";
	else{
		if($_POST['fruit_name'] == "" && $_POST['fruit_supplier_name'] == "" && $_POST['fruit_amount'] == "" && $_POST['fruit_unit'] == "" && $_POST['fruit_purchase_price'] == "" && $_POST['fruit_value'] == "" && $_POST['fruit_location'] == "" && $_POST['fruit_purchase_date'] == "" && $_POST['fruit_promotion_date'] == "" && $_POST['fruit_discard_date'] == "")
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入欲修改之資料',showConfirmButton: false,timer:3000})</script>";
		else{
			if($_POST['fruit_name'] != "")
				echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '水果名稱不可修改',showConfirmButton: false,timer:3000})</script>";
			else if($_POST['fruit_supplier_name']!="")
				echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '供應商不可修改',showConfirmButton: false,timer:3000})</script>";
			else{
				$INPUT = [];
				foreach (array_values ($DB->fruit_schema) as $val)
					if ($val != "fruit_flag"&& $val != "fruit_id"&&!empty($_POST[$val]))
						$INPUT[$val] = $_POST[$val];
				$DB->update_fruit($INPUT, $_POST['fruit_id']);
				echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'修改成功',showConfirmButton: false})</script>";
				echo "<script>setTimeout(function(){location.replace('/Talen/fruit/index.php')}, 1500);</script>";
			}
		}
	}
}



if(isset($_POST['search'])){
		if($_POST['fruit_id']== "" && $_POST['fruit_name'] == "" && $_POST['fruit_supplier_name'] == "" && $_POST['fruit_amount'] == "" && $_POST['fruit_unit'] == "" && $_POST['fruit_purchase_price'] == "" && $_POST['fruit_value'] == "" && $_POST['fruit_location'] == "" && $_POST['fruit_purchase_date'] == "" && $_POST['fruit_promotion_date'] == "" && $_POST['fruit_discard_date'] == "")
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入欲查詢資料',showConfirmButton: false,timer:3000})</script>";
		else{
			$INPUT = [];
			foreach (array_values ($DB->fruit_schema) as $val)
				if ($val != "fruit_flag" && !empty($_POST[$val]))
					$INPUT[$val] = $_POST[$val];
			$DB->get_fruit($INPUT);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'查詢成功',showConfirmButton: false,timer:3000})</script>";
		}

}

?>
					</div>
						<br/>
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
	style.innerHTML = 'table, th, td {text-align: center;padding:5px;border-collapse:collapse;border-spacing: 1px;border: 2px solid black; font-size: 17px;}';
	printWindow.document.head.appendChild(style);
	printWindow.print();
	printWindow.close();
}


document.getElementById('fruit_amount').addEventListener('change', function() {
	var fruitUnit = document.getElementById('fruit_amount').value;
	var fruitPurchasePrice = document.getElementById('fruit_purchase_price').value;
	var fruitValue = fruitUnit * fruitPurchasePrice;
	document.getElementById('fruit_value').value = fruitValue.toFixed(2);
});

document.getElementById('fruit_purchase_price').addEventListener('change', function() {
	var fruitUnit = document.getElementById('fruit_amount').value;
	var fruitPurchasePrice = document.getElementById('fruit_purchase_price').value;
	var fruitValue = fruitUnit * fruitPurchasePrice;
	document.getElementById('fruit_value').value = fruitValue.toFixed(2);
});
document.getElementById("fruit_purchase_date").addEventListener("change",function(){
	var fruit_purchase_date = document.getElementById("fruit_purchase_date").value;
	fruit_purchase_date = new Date(fruit_purchase_date);
	document.getElementById("fruit_promotion_date").addEventListener("change",function(){
		var fruit_promotion_date = document.getElementById("fruit_promotion_date").value;
		fruit_promotion_date = new Date(fruit_promotion_date);
		if(fruit_promotion_date < fruit_purchase_date){
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: '開始促銷日期不得早於進貨日期',
				showConfirmButton: false,
				timer: 5000,
			})
			document.getElementById("fruit_promotion_date").value = "";
		}
	});
	document.getElementById("fruit_discard_date").addEventListener("change",function(){
		var fruit_discard_date = document.getElementById("fruit_discard_date").value;
		fruit_discard_date = new Date(fruit_discard_date);
		if(fruit_discard_date < fruit_purchase_date){
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: '該丟棄之日期不得早於進貨日期',
				showConfirmButton: false,
				timer: 5000,
			})
			document.getElementById("fruit_discard_date").value = "";
		}
	});
});
$document.getElementById("Form").addEventListener("submit",function(){
	window.location.reload();
});
</script>

