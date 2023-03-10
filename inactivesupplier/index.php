<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                <title>靜止供應商資料表</title>
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
				font-size:20px;
				padding:5px;
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
                                width: 60%;
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
                                         <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;靜止供應商資料表</h3>
                                        <form method="post" action="index.php" enctype="multipart/form-data">
						供應商統一編號 : <select name="supplier_id">
<?php
$DB->select_ina("supplier_id", "supplier","supplier_flag");
?>
						</select>&nbsp;&nbsp;
                                                <input type="submit" class="btn btn-outline-dark btn-sm"name="search" value="查詢"><br>
                                        <br>
                                                <input type="submit" class="btn btn-outline-dark btn-sm"name="recover" value="復原">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" class="btn btn-outline-dark btn-sm"name="refresh" value="重整" onclick=location.replace("/Talen/inactivesupplier/index.php")>
                                        </form>
                                </div>
				<div class="right">
					<div class="print">
<?php
$DB->get_all_del_supplier();
if(isset($_POST['recover'])){
	if($_POST['supplier_id'] == "")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請選擇供應商編號',showConfirmButton: false,timer: 3000})</script>";
	else{
		$INPUT = [];
		$INPUT[] = "0";
		$INPUT[] = $_POST['supplier_id'];
		$DB->rec_supplier($INPUT);
		echo "<script>Swal.fire({icon: 'success',title: 'Success',text: '復原成功',showConfirmButton: false})</script>";
		echo "<script>setTimeout(function(){location.replace('/Talen/inactivesupplier/index.php')}, 1500);</script>";
	}
}
if(isset($_POST['search'])){
	if($_POST['supplier_id']=="")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請選擇供應商編號',showConfirmButton: false,timer: 3000})</script>";
	else{	
        	$DB->get_del_supplier($_POST['supplier_id']);
		echo "<script>Swal.fire({icon: 'success',title: 'Success',text: '查詢成功',showConfirmButton: false,timer:3000})</script>";
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
	style.innerHTML = 'table, th, td {text-align: center;border-collapse:collapse;border-spacing: 2px;padding:5px;border: 2px solid black; font-size: 30px;}';
	printWindow.document.head.appendChild(style);
	printWindow.print();
	printWindow.close();
}
</script>

