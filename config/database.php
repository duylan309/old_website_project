<?php

class Database {
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	function __construct() {
		require_once "connect.php";
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	function db_close() {
		mysql_close();
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
// set utf8
	function db_utf8() {
		mysql_query('SET NAMES utf8');
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
// replace query
	function db_query($strQuery) {
		mysql_query('SET NAMES utf8');
		return mysql_query($strQuery);
	}

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
//free $result
	function db_freeQuery($result) {
		if ($result) {
			return mysql_free_result($result);
		}

		return NULL;
	}

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	//  used to for query statement have result only one line data
	function db_array($strQuery) {
		$result = $this->db_query($strQuery);
		if($result) {
			$row = mysql_fetch_assoc($result);
			$this->db_freeQuery($result);
			return $row;
		}
		return array();
	}

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	//update datarow
	function db_update($array, $table, $id_array) {
		$key = array_keys($array);
		$val = array_values($array);

		$col = count($array);
		$i = 0;
		while ($i < $col) {
			if($val[$i] != '' || $val[$i] == 0){
				$set_update[] = $key[$i] . "='" . $val[$i] . "'";
			}
			$i++;	
		}
		$set_update = implode(',', $set_update);

		$key_id = array_keys($id_array);
		$val_id = array_values($id_array);

		for($i=0; $i<count($key_id); $i++) {
			if($val_id[$i] != '' || $val_id[$i] == 0){
				$set_id[] = $key_id[$i] . "='" . $val_id[$i] . "'";
			}
		}

		$str = "UPDATE $table SET $set_update WHERE ".implode(" AND ", $set_id);
		# echo $str;
		return $this->db_query($str);
	}

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	//insert datarow
	function db_insert($array, $table) {
		unset($array['id']);
		$key = array_keys($array);
		$val = array_values($array);

		$key = implode(",", $key);
		$val = implode("','", $val);
		$str = "INSERT INTO $table ($key) values ('$val')";
		# echo $str;
		return $this->db_query($str);
	}

	function db_insert_return_id($array, $table) {
		$key = array_keys($array);
		$val = array_values($array);

		$key = implode(",", $key);
		$val = implode("','", $val);
		$str = "INSERT INTO $table ($key) values ('$val')";

		if($this->db_query($str)){
			return mysql_insert_id();
		}else{
			return false;
		}

	}



	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	//delete datarow
	function db_delete($table, $id) {
		$key_id = array_keys($id);
		$val_id = array_values($id);

		$set_id = $key_id[0] . "='" . $val_id[0] . "'";

		$str = "DELETE FROM $table WHERE $set_id";

		return $this->db_query($str);
	}
	//delete datarow
	function db_delete_where($table, $array) {
		$where  = " 1 = 1 ";
		if($array && count($array)){

			foreach($array as $key => $value){
				$where .= " AND ".$key." = '". $value ."'" ;
			}

		}

		$str = "DELETE FROM $table WHERE $where";

	    return $this->db_query($str);
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	// get total row is queried
	function db_rows($result) {
		if ($result) {
			return mysql_num_rows($result);
		}

		return NULL;
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
//get total colum is queried
	function db_cols($result) {
		if ($result) {
			return mysql_num_fields($result);
		}

		return NULL;
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
// get index in table begin imlement range k
	function db_dataSeek($result, $start) {
		return mysql_data_seek($result, $start);
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
// return values of select from table to array
	function db_arrayList($str) {
		$this->db_utf8();
		$result = $this->db_query($str);
		$col = $this->db_cols($result);
		$row = $this->db_rows($result);
		$list_db = null;
		for ($i = 0; $i < $col; $i++) {
			$name = mysql_field_name($result, $i);
			for ($j = 0; $j < $row; $j++) {
				$list_db[$j][$name] = mysql_result($result, $j, $i);
			}
		}
		$this->db_freeQuery($result);
		return $list_db;
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	// result is array which content is name of field
	function db_arrayFieldName($result) {
		$cols = $this->db_cols($result);
		$list = "";
		for ($i = 0; $i < $cols; $i++) {
			$list[$i] = mysql_field_name($result, $i);
		}
		return $list;
	}

	// JSON data
	function objJson($strQuery) {
		$fet = $this->db_query($strQuery);
		
		if (!$fet) {
			return null;
		}
		
		$json = array();
		
		while ($r = mysql_fetch_assoc($fet)) {
			$json[] = $r;
		}

		$this->db_freeQuery($fet);
		return $json;
	}

}

?>
