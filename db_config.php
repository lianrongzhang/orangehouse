<?php

class  FRUIT_DB{
	var $host = "127.0.0.1";
	var $user = "root";
	var $pass = "root";
	var $db = "Talen";

	//MySQL=======================================================================================

	var $connect,$result;

	function __construct(){
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$this->connect = new mysqli($this->host,$this->user,$this->pass, $this->db);
		$this->connect->set_charset('utf8mb4');
	}

	//fruit=======================================================================================
	var $fruit_schema = [
		"水果編號" => "fruit_id",
		"水果名稱" => "fruit_name",
		"供應商名稱" => "fruit_supplier_name",
		"數量" => "fruit_amount",
		"單位" => "fruit_unit",
		"進貨單價" => "fruit_purchase_price",
		"現價小計" => "fruit_value",
		"存放位置" => "fruit_location",
		"進貨日期" => "fruit_purchase_date",
		"促銷日期" => "fruit_promotion_date",
		"丟棄日期" => "fruit_discard_date",
		"旗號" => "fruit_flag"
	];

	function add_fruit($info){
		$sql = "INSERT INTO fruit VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->connect->prepare($sql);
		$stmt->bind_param("ssssssssssss", ...$info);

		if(!$stmt->execute())
			echo "MySQL error, " . $stmt-error . "<br />";

	}

	function del_fruit ($info) {
		$sql = "update fruit set fruit_flag=? where fruit_id=?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", ...$info);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}


	function update_fruit($info,$fruit_id){
		$sql = "update fruit set ";
		$counter = 0;
		$Key = [];
		$param = [];
		foreach($info as $key => $val){
			$Key[] = $key;
			$param[] = $val;
		}
		foreach($Key as $key)
			$sql .= ($counter++ == 0)? ((string)$key)."=?":",".((string)$key)."=?";
		$sql .= " where fruit_id=?";
		$param[] = $fruit_id;
		$counter = count($param);
		$stmt = $this->connect->prepare($sql);
		$stmt->bind_param(str_repeat("s",$counter), ...$param);
		if(!$stmt -> execute())
			echo "MySQL error, ". $stmt->error . "<br />";
	}

	function get_all_fruit(){
		$sql = "select * from fruit where fruit_flag = 0";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->fruit_schema),
			$this->result,
			"資料庫內容"
		);
	}
	function get_all_del_fruit(){
		$sql = "select * from fruit where fruit_flag = 1";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->fruit_schema),
			$this->result,
			"資料庫內容"
		);
	}
	
	function get_fruit($fruit_id){
		$sql = "select * from fruit where fruit_id = ? and fruit_flag = 0";
		$stmt = $this->connect->prepare($sql);
		$stmt->bind_param("s",$fruit_id);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->fruit_schema),
			$this->result
		);
	}
	function get_del_fruit($fruit_id){
                $sql = "select * from fruit where fruit_id = ? and fruit_flag = 1";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("s",$fruit_id);

                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";

                $this->result = $stmt->get_result();
                $this->displayTable(
                        array_keys($this->fruit_schema),
                        $this->result
                );
        }
	function rec_fruit($info){
                $sql = "update fruit set fruit_flag= ? where fruit_id = ?";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("ss",...$info);
                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";


        }
	
	

	//member ====================================================================================================

	var $member_schema =[
		"會員身分證字號" => "member_id",
		"姓名" => "member_name",
		"電話" => "member_tel",
		"手機" => "member_phone",
		"信箱" => "member_email",
		"是否加line" => "member_has_Line",
		"地址" => "member_address",
		"年齡" => "member_age",
		"照片" => "member_photo",
		"旗號" => "member_flag"
	];


	function add_member ($info) {
		$sql = "INSERT INTO member VALUES (?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ssssssssss", ...$info);

		if (!$stmt->execute ())
			echo "MySQL error, " . $stmt->error . "<br />";
	}

	function del_member ($info) {
		$sql = "UPDATE member set member_flag=? WHERE member_id=?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", ...$info);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}

	function update_member ($info, $member_id) {
		$sql = "UPDATE member SET ";
		$counter = 0;
		$Key = [];
		$param = [];
		foreach ($info as $key => $val) {
			$Key[] = $key;
			$param[] = (string) $val;
		}
		foreach ($info as $key => $val)
			$sql .= ($counter++ == 0)? ((string)$key)."=?":",".((string)$key)." =?";
		$sql .= " WHERE member_id=?";
		$param[] = $member_id;
		$counter = count ($param);
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param (str_repeat("s",$counter), ...$param);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function get_member($member_id){
		$sql = "select * from member where member_id = ? and member_flag = 0";
		$stmt = $this->connect->prepare($sql);
		$stmt->bind_param("s",$member_id);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displaymember(
			array_keys($this->member_schema),
			$this->result
		);
	}
	function get_all_member(){
		$sql = "select * from member where member_flag = 0";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displaymember(
			array_keys($this->member_schema),
			$this->result,
			"資料庫內容"
		);
	}
	function get_del_member($member_id){
                $sql = "select * from member where member_id = ? and member_flag = 1";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("s",$member_id);

                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";

                $this->result = $stmt->get_result();
                $this->displaymember1(
                        array_keys($this->member_schema),
                        $this->result
                );

	}
	function get_all_del_member(){
		$sql = "select * from member where member_flag = 1";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displaymember1(
			array_keys($this->member_schema),
			$this->result,
			"資料庫內容"
		);
	}
	function rec_member($info){
                $sql = "update member set member_flag= ? where member_id = ?";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("ss",...$info);
                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";


        }

	//supplier ========================================================================================

	var $supplier_schema =[
		"供應商統一編號" => "supplier_id",
		"名稱" => "supplier_name",
		"電話" => "supplier_tel",
		"地址" => "supplier_address",
		"負責人" => "supplier_CEO",
		"Email" => "supplier_email",
		"旗號" => "supplier_flag"
	];

	function add_supplier ($info) {
		$sql = "INSERT INTO supplier VALUES (?,?,?,?,?,?,?)";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("sssssss", ...$info);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function del_supplier ($info) {
		$sql = "update supplier set supplier_flag=? where supplier_id=?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", ...$info);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function update_supplier ($info, $supplier_id) {
		$sql = "update supplier set ";
		$counter = 0;
		$Key = [];
		$param = [];
		foreach ($info as $key => $val) {
			$Key[] = $key;
			$param[] = (string) $val;
		}
		foreach ($info as $key => $val)
			$sql .= ($counter++ == 0)? ((string)$key)."=?":",".((string)$key)." =?";
		$sql .= " where supplier_id=?";
		$param[] = $supplier_id;
		$counter = count ($param);
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param (str_repeat("s",$counter), ...$param);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function get_all_supplier(){
		$sql = "select * from supplier where supplier_flag = 0";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->supplier_schema),
			$this->result,
			"資料庫內容"
		);
	}
	function get_all_del_supplier(){
		$sql = "select * from supplier where supplier_flag = 1";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->supplier_schema),
			$this->result,
			"資料庫內容"
		);
	}
	function get_supplier($supplier_id){
		$sql = "select * from supplier where supplier_id = ? and supplier_flag = 0";
		$stmt = $this->connect->prepare($sql);
		$stmt->bind_param("s",$supplier_id);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->supplier_schema),
			$this->result
		);
	}
	function get_del_supplier($supplier_id){
                $sql = "select * from supplier where supplier_id = ? and supplier_flag = 1";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("s",$supplier_id);

                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";

                $this->result = $stmt->get_result();
                $this->displayTable(
                        array_keys($this->supplier_schema),
                        $this->result
                );
        }
	function rec_supplier($info){
                $sql = "update supplier set supplier_flag= ? where supplier_id = ?";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("ss",...$info);
                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";


        }
	//trade =====================================================================================

	var $trade_schema = [
		"水果編號" => "trade_fruit_id",
		"水果名稱" => "trade_fruit_name",
		"會員身分證字號" => "trade_member_id",
		"水果供應商名稱" => "trade_supplier_name",
		"購買數量" => "trade_amount",
		"出售單價" => "trade_price",
		"總金額" => "trade_totalPrice",
		"交易日期" => "trade_date",
		"預計交運日期" => "trade_expected_deliver_date",
		"實際交運日期" => "trade_actual_deliver_date",
		"旗號" => "trade_flag"
	];
	var $trade_schema1 = [
		"交易編號"=> "trade_number",
		"水果編號" => "trade_fruit_id",
		"水果名稱" => "trade_fruit_name",
		"會員身分證字號" => "trade_member_id",
		"水果供應商名稱" => "trade_supplier_name",
		"購買數量" => "trade_amount",
		"出售單價" => "trade_price",
		"總金額" => "trade_totalPrice",
		"交易日期" => "trade_date",
		"預計交運日期" => "trade_expected_deliver_date",
		"實際交運日期" => "trade_actual_deliver_date",
		"旗號" => "trade_flag"
	];

	function add_trade ($info) {
		$sql = "INSERT INTO trade(trade_fruit_id,trade_fruit_name,trade_member_id,trade_supplier_name,trade_amount,trade_price,trade_totalPrice,trade_date,trade_expected_deliver_date,trade_actual_deliver_date,trade_flag) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("sssssssssss", ...$info);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
		$sql = "update fruit set fruit_amount = fruit_amount - ?  where fruit_id = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", $info[4], $info[0]);
		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
		$sql = "update fruit set fruit_value = fruit_amount * fruit_purchase_price  where fruit_id = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("s", $info[0]);
		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function del_trade ($info) {
		$sql = "UPDATE trade SET trade_flag=? WHERE trade_number=?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", ...$info);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
		
		$sql = "select trade_amount,trade_fruit_id from trade where trade_number = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("s", $info[1]);
		$stmt->execute ();
		$tmp = $stmt->get_result ()->fetch_assoc();
		
		$sql = "update fruit set fruit_amount = fruit_amount + ?  where fruit_id = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", $tmp['trade_amount'], $tmp['trade_fruit_id']);
		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
		$sql = "update fruit set fruit_value = fruit_amount * fruit_purchase_price  where fruit_id = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("s", $tmp['trade_fruit_id']);
		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function update_trade ($info, $trade_number) {
		$sql = "UPDATE trade SET ";
		$counter = 0;
		$Key = [];
		$param = [];
		foreach ($info as $key => $val) {
			$Key[] = $key;
			$param[] = (string) $val;
		}
		foreach ($info as $key => $val)
			$sql .= ($counter++ == 0)? ((string)$key)."=?":",".((string)$key)." =?";
		$sql .= " WHERE trade_number=?";
		$param[] = $trade_number;
		$counter = count ($param);
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param (str_repeat("s",$counter), ...$param);

		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
	}
	function get_trade($trade_id){
		$sql = " select * from trade where trade_number = ? and trade_flag = 0";
		$stmt = $this->connect->prepare($sql);
		$stmt->bind_param("s",$trade_id);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->trade_schema1),
			$this->result
		);
	}
	function get_del_trade($trade_id){
                $sql = "select * from trade where trade_number = ? and trade_flag = 1";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("s",$trade_id);

                if(!$stmt->execute())
                        echo "MySQL error, " .$stmt->error . "<br />";

                $this->result = $stmt->get_result();
                $this->displayTable(
                        array_keys($this->trade_schema1),
                        $this->result
                );
        }
	function get_all_trade(){
		$sql = "select * from trade where trade_flag = 0";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->trade_schema1),
			$this->result,
			"資料庫內容"
		);
	}
	function get_all_del_trade(){
		$sql = "select * from trade where trade_flag = 1";
		$stmt = $this->connect->prepare($sql);

		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";

		$this->result = $stmt->get_result();
		$this->displayTable(
			array_keys($this->trade_schema1),
			$this->result,
			"資料庫內容"
		);
	}
	function rec_trade($info){
                $sql = "update trade set trade_flag= ? where trade_number = ?";
                $stmt = $this->connect->prepare($sql);
                $stmt->bind_param("ss",...$info);
                if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";
		$sql = "select trade_amount,trade_fruit_id from trade where trade_number = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("s", $info[1]);
		$stmt->execute ();
		$tmp = $stmt->get_result ()->fetch_assoc();
		$sql = "update fruit set fruit_amount = fruit_amount - ?  where fruit_id = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("ss", $tmp['trade_amount'], $tmp['trade_fruit_id']);
		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}
		$sql = "update fruit set fruit_value = fruit_amount * fruit_purchase_price  where fruit_id = ?";
		$stmt = $this->connect->prepare ($sql);
		$stmt->bind_param ("s", $tmp['trade_fruit_id']);
		if (!$stmt->execute ()) {
			echo "MySQL error, " . $stmt->error . "<br />";
		}

	}
	function select($column,$table,$flag){
		$sql = "select $column from $table where $flag=0";
		$stmt = $this->connect->prepare($sql);
		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";
		$this->result = $stmt->get_result();
		echo "<option value = ''>請選擇 </option>";
		while($row = $this->result->fetch_assoc()){
			echo "<option value = ".$row[$column].">".$row[$column]."</option>";
		}
	}
	function select_ina($column,$table,$flag){
		$sql = "select $column from $table where $flag = 1";
		$stmt = $this->connect->prepare($sql);
		if(!$stmt->execute())
			echo "MySQL error, " .$stmt->error . "<br />";
		$this->result = $stmt->get_result();
		echo "<option value = ''>請選擇 </option>";
		while($row = $this->result->fetch_assoc()){
			echo "<option value = ".$row[$column].">".$row[$column]."</option>";
		}
		echo "</select>";
	}

	private function displayTable($headings, $result, $title = "查詢結果") {
		if ( !is_array($headings) ) {
			return false;
		}
		$counter = count($headings);
		echo "<h3>".$title."</h3>";
		echo "<table>\n";
		echo "<tr>\n";
		foreach($headings as $heading) {
			if($counter!=1)
				echo "<th>" . $heading . "</th>\n";
			$counter--;
		}
		$counter = count($headings);
		$tmp = $counter;
		echo "</tr>\n";
		echo "<tbody>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>\n";
			foreach($row as $data) {
				if($counter!=1)
					echo "<td>" . $data . "</td>\n";
				$counter--;
			}
			echo "</tr>\n";
			$counter = $tmp;
		}
		echo "</tbody>\n";
		echo "</table>\n";
		return true;
	}
	private function displaymember($headings, $result, $title = "查詢結果") {
		if ( !is_array($headings) ) {
			return false;
		}
		$counter = count($headings);
		echo "<h3>".$title."</h3>";
		echo "<table>\n";
		echo "<tr>\n";
		foreach($headings as $heading) {
			if($counter!=1)
				echo "<th>" . $heading . "</th>\n";
			$counter--;
		}
		$counter = count($headings);
		$tmp = $counter;
		echo "</tr>\n";
		echo "<tbody>";
		$counter1 = 0;
		while($row = $result->fetch_assoc()) {
			echo "<tr>\n";
			foreach($row as $data) {
				if($counter!=1){
					if($counter1 == 8){
						echo "<td><img src=\"./upload/".$data."\" style=\"max-width:200px;height:auto\"></td>";
					}
					else{
						echo "<td>" . $data . "</td>\n";
					}
				}
				$counter--;
				$counter1++;
			}
			echo "</tr>\n";
			$counter = $tmp;
			$counter1 = 0;
		}
		echo "</tbody>\n";
		echo "</table>\n";
		return true;
	}
	private function displaymember1($headings, $result, $title = "查詢結果") {
		if ( !is_array($headings) ) {
			return false;
		}
		$counter = count($headings);
		echo "<h3>".$title."</h3>";
		echo "<table>\n";
		echo "<tr>\n";
		foreach($headings as $heading) {
			if($counter!=1)
				echo "<th>" . $heading . "</th>\n";
			$counter--;
		}
		$counter = count($headings);
		$tmp = $counter;
		echo "</tr>\n";
		echo "<tbody>";
		$counter1 = 0;
		while($row = $result->fetch_assoc()) {
			echo "<tr>\n";
			foreach($row as $data) {
				if($counter!=1){
					if($counter1 == 8){
						echo "<td><img src=\"../member/upload/".$data."\" style=\"max-width:200px;height:auto\"></td>";
					}
					else{
						echo "<td>" . $data . "</td>\n";
					}
				}
				$counter--;
				$counter1++;
			}
			echo "</tr>\n";
			$counter = $tmp;
			$counter1 = 0;
		}
		echo "</tbody>\n";
		echo "</table>\n";
		return true;
	}

}

?>
