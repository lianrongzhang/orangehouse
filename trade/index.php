<?php
include("../db_config.php");
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
		<title>交易資料表</title>
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
				 <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交易資料表</h3>
				<form method="post" action="index.php" enctype="multipart/form-data">
					交易編號：<select name="trade_number">
<?php
$DB->select("trade_number", "trade","trade_flag");
?>
						</select>&nbsp;&nbsp;
					<input type="submit" class="btn btn-outline-dark btn-sm"name="search" value="查詢"><br>
				<br>
					水果編號：<select class="form-select form-select-sm" name="trade_fruit_id" ><br>
<?php
$DB->select("fruit_id","fruit","fruit_flag");
?>
						</select><br>
				<br>
					水果名稱：<select name="trade_fruit_name"><br>
<?php
$DB->select("fruit_name","fruit","fruit_flag");
?>
						</select><br>
				<br>
					會員身分證字號：<select name="trade_member_id">
<?php
$DB->select("member_id","member","member_flag");
?>
							</select><br>
				<br>
					水果供應商名稱：<select name="trade_supplier_name"><br>
<?php
$DB->select("supplier_name","supplier","supplier_flag");
?>
						</select><br>
				<br>
					購買數量：<input type="number" id="tradeamount" name="trade_amount" maxlength="6"><br>
				<br>
					出售單價：<input type="number" id="tradeprice" name="trade_price" maxlength="8"><br>
				<br>
					總金額：<input type="number" id ="tradetotalprice" name="trade_totalPrice" maxlength="8"><br>
				<br>
					交易日期：<input type="datetime" name="trade_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="YYYY-MM-DD"><br>
				<br>
					預計交運日期：<input type="datetime" name="trade_expected_deliver_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="YYYY-MM-DD"><br>
				<br>
					實際交運日期：<input type="datetime" name="trade_actual_deliver_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="YYYY-MM-DD"><br>
				<br>
						<input type="submit" class="btn btn-outline-dark btn-sm"id='add'name="add" value="新增">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" class="btn btn-outline-dark btn-sm"id='delete'name="delete" value="刪除">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" class="btn btn-outline-dark btn-sm"id='update'name="update" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
						<input type="button" class="btn btn-outline-dark btn-sm"id='reload'name="reload" value="重整" onclick=location.replace("/Talen/trade/index.php")>
				</form>
			</div>
			<div class="right">
				<div class="print">
<?php
$DB->get_all_trade();
if (isset($_POST['add'])) {
	$INPUT = [];
	foreach (array_values ($DB->trade_schema) as $val)
		if ($val != "trade_flag")
			$INPUT[] = $_POST[$val];
	array_push($INPUT, 0);
	$DB->add_trade ($INPUT);

}
if (isset($_POST['delete'])) {
	$INPUT = [];
	array_push($INPUT,"1");
	array_push($INPUT,$_POST["trade_number"]);
	$DB->del_trade($INPUT);
}
if (isset($_POST['update'])&&isset($_POST['trade_number'])) {
	$INPUT = [];
	foreach (array_values ($DB->trade_schema) as $val)
		if ($val != "trade_flag"&&$val != "trade_fruit_id"&&$val!="trade_member_id"&&$val!="trade_supplier_name"&&!empty($_POST[$val]))
			$INPUT[$val] = $_POST[$val];
	$DB->update_trade($INPUT,$_POST["trade_number"]);
}
if(isset($_POST['search'])&&isset($_POST['trade_number'])){
	$DB->get_trade($_POST["trade_number"]);
}
?>
				</div>
				<br>
				<input  class="btn btn-outline-dark btn-sm"type="button" onclick=printDiv() value="列印">
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
	style.innerHTML = 'table, th, td {text-align: center;border-collapse:collapse;border-spacing: 2px;border: 2px solid black; font-size: 18px;}';
	printWindow.document.head.appendChild(style);
	printWindow.print();
	printWindow.close();
}
document.getElementById('tradeamount').addEventListener('change', function() {
	var tradeAmount = document.getElementById('tradeamount').value;
	var tradePrice = document.getElementById('tradeprice').value;
	var tradeTotalPrice = tradeAmount * tradePrice;
	document.getElementById('tradetotalprice').value = tradeTotalPrice;
});
document.getElementById('tradeprice').addEventListener('change', function() {
	var tradeAmount = document.getElementById('tradeamount').value;
	var tradePrice = document.getElementById('tradeprice').value;
	var tradeTotalPrice = tradeAmount * tradePrice;
	document.getElementById('tradetotalprice').value = tradeTotalPrice;
});
</script>

