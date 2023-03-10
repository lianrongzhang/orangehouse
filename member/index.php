<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
require ("../db_config.php");
$DB = new FRUIT_DB ();
session_start();
if(!isset ($_SESSION['role']) ||  $_SESSION['role']!='user'){
	http_response_code(403);
	die();
}
$member = array(array());
$conn = new mysqli('localhost','root','root',"Talen");

$sql = 'select * from member';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_all(MYSQLI_ASSOC);
?>
<html>

	<head>
		<title>會員資料表</title>
		<style>
			div{
				text-align: left- center;
			}
		h2{
				text-align:left-center;
			}
			table, th, td {
				text-align: center;
				border-spacing: 1px;
				border: 1px solid black;
				font-size: 18px;
				padding: 3px;
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
					   <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;會員資料表</h3>
					<form method="post" action="index.php" enctype="multipart/form-data">
						會員身份證字號 : <input type="text"pattern="[A-Z]{1}[0-9]{9}" class="form-control-m"name="member_id" maxlength="10">&nbsp;&nbsp;
						<input type="submit" class="btn btn-outline-dark btn-sm"name="search" value="查詢"><br>
					<br>
						姓名 : <input type="text" name="member_name"class="form-control-m" maxlength="12"><br>
					<br>
						電話 : <input type="text"name="member_tel"class="form-control-m" maxlength="16"><br>
					<br>
						手機 : <input type="text"name="member_phone"class="form-control-m" maxlength="16"><br>
					<br>
						Email : <input type="email"name="member_email"class="form-control-m" maxlength="36"><br>
					<br>
						是否加入東海水果公司之 Line :   <select name="member_has_Line">
										<option value="">請選擇</option>
										<option value="是">是</option>
										<option value="否">否</option>
										</select><br>
					<br>
						地址 : <input type="text"name="member_address" class="form-control-m"maxlength="60"><br>
					<br>
						年齡 : <input type="number"name="member_age" class="form-control-m"min="0" max="9999"><br>
					<br>
						照片: <input type="file" name="member_photo" class="form-control-m"accept="image/*"><br>
					<br>
						<input type="submit" name="add" class="btn btn-outline-dark btn-sm" value="新增">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="delete" class="btn btn-outline-dark btn-sm" value="刪除">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="update" class="btn btn-outline-dark btn-sm" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" name="refresh" value="重整"class="btn btn-outline-dark btn-sm" onclick=location.replace("/Talen/member/index.php")>
					</form>
				</div>
				
				<div class="middle">
					<div class="print">
<?php
$DB->get_all_member ();

if (isset($_POST['add'])) {
	$count = 0;
	if($_POST['member_id'] == "" || $_POST['member_name'] == "" || $_POST['member_tel'] == "" || $_POST['member_phone'] == "" || $_POST['member_email'] == "" || $_POST['member_has_Line'] == "" || $_POST['member_address'] == "" || $_POST['member_age'] == "" || $_FILES['member_photo']['name'] == ""){
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請填寫完整資料',showConfirmButton: false,timer: 3000,})</script>";
	}
	else{
		for($i = 0; $i < count($member); $i++){
			if($_POST['member_id'] == $member[$i]['member_id']){
				$count++;
			}
		}
		if($count==0){
			$INPUT = [];
			foreach (array_values ($DB->member_schema) as $val)
				if ($val != "member_flag"){
					if($val == "member_photo"&&!empty($_FILES["member_photo"]["name"])){
						$image_name = mysqli_real_escape_string($DB->connect, $_FILES["member_photo"]["name"]);
						move_uploaded_file($_FILES['member_photo']['tmp_name'], "/srv/http/Talen/member/upload/" . $image_name);
						$INPUT[] = $image_name;
					}
					else
						$INPUT[] = $_POST[$val];
				}
			array_push($INPUT,0);
			$DB->add_member ($INPUT);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'新增成功',showConfirmButton: false})</script>";
			echo "<script>setTimeout(function(){location.replace('/Talen/member/index.php')}, 1500);</script>";

		}
		else{
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '會員已存在',showConfirmButton: false,timer:3000})</script>";
		}

	}

}
if (isset($_POST['delete'])) {
	if($_POST['member_id']=='')
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入會員身分證字號',showConfirmButton: false,timer:3000})</script>";
	else{
		$INPUT = [];
		array_push($INPUT,"1");
		array_push($INPUT,$_POST["member_id"]);
		$DB->del_member($INPUT);
		echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'刪除成功',showConfirmButton: false})</script>";
		echo "<script>setTimeout(function(){location.replace('/Talen/member/index.php')}, 1500);</script>";
	}
}




if (isset($_POST['update'])){
	if($_POST['member_id']=="")
		echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入會員身分證字號',showConfirmButton: false,timer:3000})</script>";
	else{
		if($_POST['member_name'] == "" && $_POST['member_tel'] == "" && $_POST['member_phone'] == "" && $_POST['member_email'] == "" && $_POST['member_has_Line'] == "" && $_POST['member_address'] == "" && $_POST['member_age'] == "" && $_FILES['member_photo']['name'] == "")
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入欲修改之資料',showConfirmButton: false,timer:3000})</script>";
		else{
			$INPUT = [];
			foreach (array_values ($DB->member_schema) as $val)
				if ($val != "member_flag"&&$val != "member_id"&&!empty($_POST[$val]))
					$INPUT[$val] = $_POST[$val];
			$DB->update_member($INPUT,$_POST["member_id"]);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'修改成功',showConfirmButton: false})</script>";
			echo "<script>setTimeout(function(){location.replace('/Talen/member/index.php')}, 1500);</script>";
		}
	}
}


if(isset($_POST['search'])){
		if($_POST['member_id']=="" && $_POST['member_name'] == "" && $_POST['member_tel'] == "" && $_POST['member_phone'] == "" && $_POST['member_email'] == "" && $_POST['member_has_Line'] == "" && $_POST['member_address'] == "" && $_POST['member_age'] == "" && $_FILES['member_photo']['name'] == "")
			echo "<script>Swal.fire({icon: 'error',title: 'Error',text: '請輸入欲查詢資料',showConfirmButton: false,timer:3000})</script>";
		else{
			$INPUT = [];
			foreach (array_values ($DB->member_schema) as $val)
				if ($val != "member_flag" && !empty($_POST[$val]))
					$INPUT[$val] = $_POST[$val];
			$DB->get_member($INPUT);
			echo "<script>Swal.fire({icon: 'success',title: 'Success',text:'查詢成功',showConfirmButton: false,timer:3000})</script>";
		}

}
?>
					</div>
					<br/>
					<input  type="button" onclick=printDiv() class="btn btn-outline-dark btn-sm"value="列印">
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
	style.innerHTML = 'table, th, td {text-align: center;border-collapse:collapse;border-spacing: 1px;border: 1px solid black;padding:5px; font-size: 18px;}';
	printWindow.document.head.appendChild(style);
	printWindow.print();
	printWindow.close();
}
</script>
