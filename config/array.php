<?php

function sortByFunc(&$arr, $func) {
	$tmpArr = array();
	foreach ($arr as $k => &$e) {
		$tmpArr[] = array('f' => $func($e), 'k' => $k, 'e' => &$e);
	}
	sort($tmpArr);
	$arr = array();
	foreach ($tmpArr as &$fke) {
		$arr[$fke['k']] = &$fke['e'];
	}
}

usort($your_data, "cmp");

/*~~~~~~~~~~~~~~~~~~ multi array sort ~~~~~~~~~~~~~~~~~~*/
function multiArrayMsort($array, $cols) {
	$colarr = array();
	foreach ($cols as $col => $order) {
		$colarr[$col] = array();
		foreach ($array as $k => $row) {$colarr[$col]['_' . $k] = strtolower($row[$col]);}
	}
	$params = array();
	foreach ($cols as $col => $order) {
		$params[] = &$colarr[$col];
		$params = array_merge($params, (array) $order);
	}
	call_user_func_array('array_multisort', $params);
	$ret = array();
	$keys = array();
	$first = true;
	foreach ($colarr as $col => $arr) {
		foreach ($arr as $k => $v) {
			if ($first) {$keys[$k] = substr($k, 1);}
			$k = $keys[$k];
			if (!isset($ret[$k])) {
				$ret[$k] = $array[$k];
			}

			$ret[$k][$col] = $array[$k][$col];
		}
		$first = false;
	}
	return $ret;
}
//ex:$arr2 = multiArrayMsort($arr1, array('name'=>SORT_DESC, 'id'=>SORT_DESC));

/*~~~~~~~~~~~~~~~~~~ array search ~~~~~~~~~~~~~~~~~~*/

function arrSearch($array, $expression) {
	$result = array();
	$expression = preg_replace("/([^\s]+?)(=|<|>|!)/", "\$a['$1']$2", $expression);
	try {
	    foreach ($array as $a) {
			if (eval("return $expression;")) {
				$result[] = $a;
			}
		}
	} catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	return $result;
}
//ex: phn_arr_search ( $data, "age>=30" );
?>
