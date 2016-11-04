<?php
if($table) {

	$strQueryUpdate = "SELECT * FROM {$table} WHERE id={$id} LIMIT 0,1";
	$rowUpdate = $db->db_array($strQueryUpdate);

	if($rowUpdate) {
		
		$strOldFile = isset($rowUpdate["im"]) && $rowUpdate["im"] ? $rowUpdate["im"] : null;
		$maxSize    = isset($maxSize) && $maxSize ? $maxSize : maxSizeUpload;
		
		$getfiles   = $_FILES['file'];

		$img        = uploadImage($getfiles, $strOldFile, $strPath, $id, $maxSize);

		$code    = $img["code"];

		if (isset($img["code"]) && $img["code"]==200 ) {
			// $message = '<div class="sms-content">'.$img["message"].'</div>';
			list($imgWidth, $imgHeight) = getimagesize($strPath.$img["file"]);
			
			if($img){
				# THUMBNAIL
				if($imgWidth > imgMaxWidthThumb && $imgHeight > imgMaxHeightThumb){
					ImageResize($strPath.$img["file"], $getfiles["type"],$imgWidth,$imgHeight, imgMaxWidthThumb, imgMaxHeightThumb,$strPath.'thumbnail/'.$img["file"]);
				}else{
					copy($strPath.$img["file"],$strPath.'thumbnail/'.$img["file"]);
				}
		
			}

			if ($db->db_update(array("im" => $img["file"]), $table, array("id" => $id)) ) {
			
				if(($imgWidth > imgMaxWidth) || ($imgHeight > imgMaxHeight)){
					ImageResize($strPath.$img["file"], $getfiles["type"],$imgWidth,$imgHeight, imgMaxWidth, imgMaxHeight);
				}

               	// save file detail
                $fileInfo = $strXML . $id . ".xml";

				if (is_file($fileInfo)) {
					$information = simplexml_load_file($fileInfo);
					$information = json_encode($information);
					$information = json_decode($information, true);
				}

				if( $url_data[3] === "user" ) {
					$information["userinfo"]["db"]["im"] = $img["file"];
					$_SESSION["userlog"]["im"] = $img["file"];
				}
                else {
                	$information["db"]["im"] = $img["file"];
                }
			
				if (saveXMLFile($fileInfo, $information)) {
					$code = 200;
					$message = '<div class="alert-footer alert in"><div class="sms-content">'.$language["uploadImgSuccess"].'</div></div>';

					$dataResponse = $img;
				} else {
					$code = 501;
					$message = '<div class="alert-footer alert-error in" data-fade="4500"><div class="sms-content">'.$language["uploadImgErrors"].'</div></div>';

				}
            }
		}else{
			$code = 501;
			$message = '<div class="alert-footer alert-error in" data-fade="4500"><div class="sms-content">'.$language["uploadImgErrors"].'</div></div>';
		}
	}
} elseif (is_file($file)) {
	
	$itemList = simplexml_load_file($file);
	$itemList = json_encode($itemList);
	$itemList = json_decode($itemList, true);
	$node = 'id_' . $id;
	$rowUpdate = isset($itemList["table"][$node]) ? $itemList["table"][$node] : null;
	
	if ($rowUpdate) {
		$strOldFile = isset($rowUpdate["im"]) && $rowUpdate["im"] ? $rowUpdate["im"] : null;
		$maxSize = isset($maxSize) && $maxSize ? $maxSize:100000;
		
		$img = uploadImage($_FILES["file"], $strOldFile, $strPath, $id, $maxSize);
		list($imgWidth, $imgHeight) = getimagesize($strPath.$img["file"]);
		if($img){
			# THUMBNAIL
			if($imgWidth > imgMaxWidthThumb && $imgHeight > imgMaxHeightThumb){
				ImageResize($strPath.$img["file"], $_FILES["file"]["type"],$imgWidth,$imgHeight, imgMaxWidthThumb, imgMaxHeightThumb,$strPath.'thumbnail/'.$img["file"]);
			}else{
				copy($strPath.$img["file"],$strPath.'thumbnail/'.$img["file"]);
			}		
		
		}
		if (isset($img)) {

			$code = $img["code"];
			$message = $img["message"];
			if (isset($img["file"])) {
				# echo 1;
				
				if(($imgWidth > imgMaxWidth) || ($imgHeight > imgMaxHeight)){
					# ImageResize($strPath.$img["file"], $_FILES["file"]["type"],$imgWidth,$imgHeight, imgMaxWidth, imgMaxHeight);
					ImageResize($strPath.$img["file"], $_FILES["file"]["type"],$imgWidth,$imgHeight, imgMaxWidth, imgMaxHeight);
				}

				$rowUpdate["im"] = $img["file"];
				$itemList["table"][$node] = $rowUpdate;
				// save item to file
				if (saveXMLFile($file, $itemList)) {
					// save file detail
					$fileInfo = $strXML . $id . ".xml";

					if (is_file($fileInfo)) {
						$information = simplexml_load_file($fileInfo);
						$information = json_encode($information);
						$information = json_decode($information, true);
					}

					$information["db"] = $rowUpdate;

					if (saveXMLFile($fileInfo, $information)) {
						$code = 200;
						$message = '<div class="alert-footer alert in"><div class="sms-content">'.$language["uploadImgSuccess"].'</div></div>';
						$dataResponse = $img;
					} else {
						$code = 501;
						$errors = '<div class="alert-footer alert in"><div class="sms-content">'.$language["unknownErrors"].'</div></div>';

					}
				} else {
					$code = 404;
					$message = '<div class="alert-footer alert-error in" data-fade="4500"><div class="sms-content">'.$language["uploadImgErrors"].'</div></div>';

				}
			}
		} else {
			$code = 404;
			$message = '<div class="alert-footer alert-error in" data-fade="4500"><div class="sms-content">'.$language["uploadImgErrors"].'</div></div>';
		}

	} else {
		$code = 501;
		$errors = "Not found ITEM";
	}

	$itemList["table"][$node] = $rowUpdate;

} elseif (isset($fileInfo) && is_file($fileInfo)){ # update $fileInfo banner
	
	$information = simplexml_load_file($fileInfo);
	$information = json_encode($information);
	$information = json_decode($information, true);
	# var_dump($information);

	if($url_data[3]) {
		$strOldFile = isset($information[$url_data[3]]) && $information[$url_data[3]] ? $information[$url_data[3]] : null;
		$maxSize = isset($maxSize) && $maxSize ? $maxSize:100000;
		$img = uploadImage($_FILES["file"], $strOldFile, $strPath, $id, $maxSize);
		list($imgWidth, $imgHeight) = getimagesize($strPath.$img["file"]);

		if($img){
			if($imgWidth > imgMaxWidthThumb && $imgHeight > imgMaxHeightThumb){
				ImageResize($strPath.$img["file"], $_FILES["file"]["type"],$imgWidth,$imgHeight, imgMaxWidthThumb, imgMaxHeightThumb,$strPath.'thumbnail/'.$img["file"]);
			}else{
				copy($strPath.$img["file"],$strPath.'thumbnail/'.$img["file"]);
			}
		}

		$code = $img["code"];
		$message = $img["message"];
		if (isset($img["code"]) && $img["code"]==200 ) {

			if(($imgWidth > imgMaxWidth) || ($imgHeight > imgMaxHeight)){
				ImageResize($strPath.$img["file"], $_FILES["file"]["type"],$imgWidth,$imgHeight, imgMaxWidth, imgMaxHeight);
			}

			$information[$url_data[3]] = $img["file"];

			#update to database
			if(isset($tableInfo)){
				if($tableInfo == TABLE_PAGEHTML){
					$db->db_update(array("image" => $img["file"]), $tableInfo, array("id" => $id));
				}elseif($tableInfo == TABLE_COMPANY){
					$db->db_update(array("facebook_cover" => $img["file"]), $tableInfo, array("id" => $id));
				}else{
					$db->db_update(array("im_banner" => $img["file"]), $tableInfo, array("id" => $id));
				}
			}

			if (saveXMLFile($fileInfo, $information)) {
				$code = 200;
				$message = $language["uploadImgSuccess"];
				$message = '<div class="alert-footer alert in"><div class="sms-content">'.$language["uploadImgSuccess"].'</div></div>';

				$dataResponse = $img;
			} else {
				$code = 501;
				$errors = '<div class="alert-footer alert in"><div class="sms-content">'.$language["unknownErrors"].'</div></div>';

			}
		}
	}

}  else {
	$code = 501;
	$errors = "Not found ITEM";
}
?>
