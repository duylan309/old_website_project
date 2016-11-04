<?php
function get_string_between($string,$delim){
	$string = explode($delim, $string, 3); // also, we only need 2 items at most
    return isset($string[1]) ? $string[1] : '';
}

function mysql_unreal_escape_string($string) {
    $characters = array('x00', 'n', 'r', '\\', '\'', '"','x1a');
    $o_chars = array("\x00", "\n", "\r", "\\", "'", "\"", "\x1a");
    for ($i = 0; $i < strlen($string); $i++) {
        if (substr($string, $i, 1) == '\\') {
            foreach ($characters as $index => $char) {
                if ($i <= strlen($string) - strlen($char) && substr($string, $i + 1, strlen($char)) == $char) {
                    $string = substr_replace($string, $o_chars[$index], $i, strlen($char) + 1);
                    break;
                }
            }
        }
    }
    return $string;
}

function response($data, $code, $message, $errors) {
	$response = array(
		"data" => $data,
		"code" => $code,
		"message" => $message,
		"errors" => $errors,
	);
	header("Content-type: application/json; charset=utf-8");
	echo json_encode($response, true);
}

function urlFriendly($str){
	return preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($str))) );
}

function getDateTime($ptime){
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}


function saveXMLFile($file, $information) {
	if (!$file || !$information) {
		return false;
	}
	try {
		$xml = Array2XML::createXML("information", $information);
		$xml->save($file);
		return true;
	} catch (Exception $ex) {
		return false;
	}
}

function saveJSONFile($file, $data) {
	if (!$file || !$data) {
		return false;
	}
	try {
		$fp = fopen($file, 'w');
		fwrite($fp, json_encode($data));
		fclose($fp);
		return true;
	} catch (Exception $ex) {
		//var_dump($ex);
		return false;
	}
}

function getDirectorySize( $path )
{
    if( !is_dir( $path ) ) {
        return 0;
    }
    $path   = strval( $path );
    $io     = popen( "ls -ltrR {$path} |awk '{print \$5}'|awk 'BEGIN{sum=0} {sum=sum+\$1} END {print sum}'", 'r' );
    //$io = popen('/usr/bin/du -sk '.$path, 'r');
    $size   = intval( fgets( $io, 80 ) );
    pclose( $io );
    return $size;
}

function readImageDir($path_dir) {
	if (!is_dir($path_dir)) {
		return false;
	}

	$folder = opendir($path_dir); // Use 'opendir(".")' if the PHP file is in the same folder as your images. Or set a relative path 'opendir("../path/to/folder")'.
	$pic_types = array("jpg", "jpeg", "gif", "png");
	$video_types = array("mp4");
	$index["image"] = array();
	$index["video"] = array();
	while ($file = readdir($folder)) {
		if (in_array(substr(strtolower($file), strrpos($file, ".") + 1), $pic_types)) {
			array_push($index["image"], $file);
		}
		if (in_array(substr(strtolower($file), strrpos($file, ".") + 1), $video_types)) {
			array_push($index["video"], $file);
		}
	}
	closedir($folder);
	return $index;
}

function readImageInfoInDir($path_dir) {
	if (!is_dir($path_dir)) {
		return false;
	}

	$folder = opendir($path_dir); // Use 'opendir(".")' if the PHP file is in the same folder as your images. Or set a relative path 'opendir("../path/to/folder")'.
	$pic_types = array("jpg", "jpeg", "gif", "png");

	$files = array();
	while ($file = readdir($folder)) {
		if (in_array(substr(strtolower($file), strrpos($file, ".") + 1), $pic_types)) {
			$fileDetail = array('file'=>$path_dir."/".$file, 'name'=>$file, 'size'=>round((filesize($path_dir."/".$file)/1000),0).' KB' );
			array_push($files, $fileDetail);
		}
	}
	closedir($folder);
	return $files;
}

function deleteDirectory($dir) {
	if (!file_exists($dir)) {
		return true;
	}

	if (!is_dir($dir) || is_link($dir)) {
		return unlink($dir);
	}

	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') {
			continue;
		}

		if (!deleteDirectory($dir . "/" . $item)) {
			chmod($dir . "/" . $item, 0777);
			if (!deleteDirectory($dir . "/" . $item)) {
				return false;
			}

		}
	}
	return rmdir($dir);
}

function strDate($int) {
	if ($int) {
		return date("d-m-Y", $int);
	}

	return null;
}

function nicetime($date) {
	if (empty($date)) {
		return "No date provided";
	}
	$periods = array("sec", "min", "hr", "day", "week", "month", "year", "decade");
	$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

	$now = time();
	$unix_date = strtotime($date);

	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}

	// is it future date or past date
	if ($now > $unix_date) {
		$difference = $now - $unix_date;
		$tense = "ago";
	} else {
		$difference = $unix_date - $now;
		$tense = "from now";
	}

	for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if ($difference != 1) {
		$periods[$j] .= "s";
	}
	return "$difference $periods[$j] {$tense}";
}

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}

	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function htmlListOption($obj) {
	$strOption = '';
	if ($obj):
		foreach ($obj as $key => $value) {
			$strOption .= ' <option value="' . $key . '">' . $value . '</option>';
		}
	endif;
	return $strOption;
}

function htmlListOptionGroup($obj) {
	global $language;
	$strOption = '';
	if ($obj):
		foreach ($obj as $key => $value) {
			if (is_array($value)) {
				$strOption .= '<optgroup label="' . $key . '">';
				foreach ($value as $key1 => $value1) {
					$strOption .= ' <option value="' . $key1 . '">' . $value1 . '</option>';
				}
				$strOption .= '</optgroup>';
			}
		}
	endif;
	return $strOption;
}

function uploadImage($file, $strOldFile, $path, $user_id = null, $size=10000000) {

	$validextensions = array("jpeg", "jpg", "png");
	
	if(is_array($file)){
		$temporary = explode(".", $file["name"]);
	}else{
		die();
	}

	$file_extension = strtolower($temporary[1]);
	// $file_extension = strtolower(end($temporary));

	if (($file["size"] < $size) && in_array($file_extension, $validextensions)) {
		if ($file["error"] > 0) {
			return array("code" => 404, 'message' => $file["error"]);
		} else {
			$oldFile = $path . $strOldFile;
			if (is_file($oldFile)) {
				unlink($oldFile);
			}
			$sourcePath = $file['tmp_name']; // Storing source path of the file in a variable
			
			$getNewName = explode(".", $file["name"]);
			$file["name"] = urlFriendly($getNewName[0]).'.'.$getNewName[1];
			
			$fileName = $user_id . "_" . $file["name"];

			$targetPath = $path . $fileName; // Target path where file is to be stored

			move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
			return array("code" => 200, "message" => "Image Uploaded Successfully...!", "file" => $fileName);
		}
	} else {
		return array("code" => 404, "message" => "***Invalid file Size or Type***");
	}
}

function uploadImageBase64($base64_str_image, $str_path, $image_name, $image_size, $user_id = null, $size=10000000,$imgMaxWidthThumb = 200,$imgMaxHeightThumb = 200) {
    $image_array["code"] = 500;

	if($base64_str_image && $image_size && !empty($base64_str_image) ){
	  $img_type = '';
	  if($image_size < $size){
	    $base_to_php = explode(',', $base64_str_image);
	    if(trim($base_to_php[0]) == "data:image/png;base64" ){
	      $img_type="png";
	      $img_type_format = 'image/png';
	    }elseif(trim($base_to_php[0]) == "data:image/jpg;base64" ){
	      $img_type="jpg";
	      $img_type_format = 'image/jpeg';
	    }elseif(trim($base_to_php[0]) == "data:image/jpeg;base64" ){
	      $img_type="jpg";
	      $img_type_format = 'image/jpeg';
	    }elseif(trim($base_to_php[0]) == "data:image/gif;base64" ){
	      $img_type="gif";
	      $img_type_format = 'image/gif';
	    }
	    
	    if($user_id){
	    	$image_name = $user_id.'_'.urlFriendly($image_name).'.'.$img_type;
	    }else{
	    	$image_name = time().'_'.urlFriendly($image_name).'.'.$img_type;
	    }

	    if(file_put_contents($str_path.$image_name, base64_decode($base_to_php[1]))){
			
			list($imgWidth, $imgHeight) = getimagesize($str_path.$image_name);
	   		
	   		if(ImageResize($str_path.$image_name, $img_type_format, $imgWidth, $imgHeight, $imgMaxWidthThumb, $imgMaxHeightThumb, $str_path.'thumbnail/'.$image_name)){
				$image_array["code"] = 200;	    		
				$image_array["image_name"] = $image_name;	    		
	   		}else{
				$image_array["code"] = 500;	    		
    		}

	    }else{
			$image_array["code"] = 500;	    		
			
	    }
	    
	  }else{
			$image_array["code"] = 500;	    		
	  }

	}

	return $image_array;

}



function ImageResize($src, $type, $w, $h, $maxwidth, $maxheight,$new_src = NULL){
    
    /* Calculate new image size*/
    
    $newSize = scaleImage($w,$h,$maxwidth,$maxheight);
    $width   = $newSize[0];
    $height  = $newSize[1];

    /* set new file name */

    if($new_src != NULL){
    	$path = $new_src;
    }else{
    	$path = $src;
 	}
    $ratio = max($width/$w, $height/$h);
    $h = ceil($height / $ratio);
    $x = ($w - $width / $ratio) / 2;
    $w = ceil($width / $ratio);
   
    /* Save image */
    if($type=='image/jpeg')
    {
        $imgString = file_get_contents($src);
        $imageSet = imagecreatefromstring($imgString);
        $imageSet = rorataImage($src,$imageSet);
     
        if($imageSet["change"] == 1){
        	$tmp      = imagecreatetruecolor($width, $height);
        	imagecopyresampled($tmp, $imageSet["image"], 0, 0, $x, 0, $width, $height, $w, $h);
		}else{
			$tmp      = imagecreatetruecolor($height, $width);
       	    imagecopyresampled($tmp, $imageSet["image"], 0, 0, $x, 0, $height, $width, $h, $w);
		}
		imagejpeg($tmp, $path, 100);
    }
    else if($type=='image/png')
    {
        $imageSet = imagecreatefrompng($src);
        // var_dump($imageSet);
       // $imageSet = rorataImage($src,$imageSet);
      	
	 	$tmp = imagecreatetruecolor($width, $height);
    	imagealphablending($tmp, false);
    	imagesavealpha($tmp, true);
    	imagecopyresampled($tmp, $imageSet, 0, 0, $x, 0, $width, $height, $w, $h);
		

        imagepng($tmp, $path, 0);
    }
    else if($type=='image/gif')
    {
        $imageSet = imagecreatefromgif($src);
       
    	$tmp = imagecreatetruecolor($width, $height);
    	$transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
    	imagefill($tmp, 0, 0, $transparent);
    	imagealphablending($tmp, true); 
    	imagecopyresampled($tmp, $imageSet, 0, 0, $x, 0, $width, $height, $w, $h);
		imagegif($tmp, $path);
    }
    else
    {
        return false;
    }

    return true;
    imagedestroy($imageSet);
    imagedestroy($tmp);
}

function rorataImage($src,$image){

	$exif = exif_read_data($src);
	$img['change'] = 1;
	$img['image']  = $image;

    if (!empty($exif['Orientation'])) {
	    switch ($exif['Orientation']) {
		    case 3:
			    $img['image'] = imagerotate($image, 180, 0);
			    $img['change'] = 1;
			    break;
		    case 6:
		    	$img['image'] = imagerotate($image, -90, 0);
		   	 	$img['change'] = 2;
		   	 	break;
		    case 8:
		    	$img['change'] = 2;
		    	$img['image'] = imagerotate($image, 90, 0);
		    	break;
	    }
    }

    return $img;
}

function scaleImage($x,$y,$cx,$cy) {
    //Set the default NEW values to be the old, in case it doesn't even need scaling
    list($nx,$ny)=array($x,$y);
     
    //If image is generally smaller, don't even bother
    if ($x>=$cx || $y>=$cx) {
             
        //Work out ratios
        if ($x>0) $rx=$cx/$x;
        if ($y>0) $ry=$cy/$y;
         
        //Use the lowest ratio, to ensure we don't go over the wanted image size
        if ($rx>$ry) {
            $r=$ry;
        } else {
            $r=$rx;
        }
         
        //Calculate the new size based on the chosen ratio
        $nx=intval($x*$r);
        $ny=intval($y*$r);
    }    
     
    //Return the results
    return array($nx,$ny);
}



function fixFilesArray(&$files)
{
    $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);

    foreach ($files as $key => $part) {
        // only deal with valid keys and multiple files
        $key = (string) $key;
        if (isset($names[$key]) && is_array($part)) {
            foreach ($part as $position => $value) {
                $files[$position][$key] = $value;
            }
            // remove old key reference
            unset($files[$key]);
        }
    }
}

// kill charater vn
function endcode_vn($str)
{
	if(!$str) return false;
	$unicode = array(
		'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),
		'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),
		'd'=>array('đ'),
		'D'=>array('Đ'),
		'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),
		'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),
		'i'=>array('í','ì','ỉ','ĩ','ị'),
		'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
		'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),
		'O'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),
		'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),
		'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),
		'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
		'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ')
		);

	foreach($unicode as $nonUnicode=>$uni)
	{
		$str = str_replace($uni,$nonUnicode,$str);
	}
	return $str;
}

function multiUploadFile($files, $validextensions , $path, $filterFile) {
	$validextensions = $validextensions? $validextensions : array("size"=>100000, "type" => array("jpeg", "jpg", "png") );
	
	if(!isset($validextensions["size"]) || !isset($validextensions["type"] ) || !$path )
	{
		return array("code" => 404, "message" => "file do not validate");
	}

	if($files) {
		fixFilesArray($files);
		foreach ($files as $key => $file) {
			// $temporary = explode(".", $file["name"]);
		    $temporary = explode(".", $file['name']);
		    $temporary[0] = str_replace(" ","-", $temporary[0]);
			
			$file_extension = end($temporary);
			$file_extension = strtolower($file_extension);

			if($file["size"] < $validextensions["size"] && in_array($file_extension, $validextensions["type"]))
		    {
		    	if ($file["error"] > 0) {
					// do something error file;
				} else {
					if($filterFile) {
						#echo 1;
						if(in_array($file['name'], $filterFile)) {
							$sourcePath = $file['tmp_name']; // Storing source path of the file in a variable
							$getNewName = explode(".", $file["name"]);
							$file["name"] = str_replace(" ","-",$getNewName[0]).'.'.$getNewName[1];
							$targetPath = $path."/".$file['name']; // Target path where file is to be stored
							move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
						}

						list($imgWidth, $imgHeight) = getimagesize($targetPath);

						if(($imgWidth > imgMaxWidth) || ($imgHeight > imgMaxHeight)){
							ImageResize($targetPath, $file["type"],$imgWidth,$imgHeight, imgMaxWidth, imgMaxHeight);
						}

					}
					else {
						#echo 2;
						$sourcePath = $file['tmp_name']; // Storing source path of the file in a variable

						$getNewName = explode(".", $file["name"]);
						$file["name"] = str_replace(" ","-",$getNewName[0]).'.'.$getNewName[1];
						
						#echo $file["name"];
						$targetPath = $path."/".$file["name"]; // Target path where file is to be stored
						# echo $sourcePath;
						move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file

						list($imgWidth, $imgHeight) = getimagesize($targetPath);

						if(($imgWidth > imgMaxWidth) || ($imgHeight > imgMaxHeight)){
							ImageResize($targetPath, $file["type"],$imgWidth,$imgHeight, imgMaxWidth, imgMaxHeight);
						}
					}
				}
		    }
		}
	} else {
		return false;
	}
}

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
	foreach ($array as $a) {
		try {
			
			if (eval("return $expression;")) {
				$result[] = $a;
			}
		
		} catch (Exception $ex) {
		}
	}

	return $result;
}
//ex: phn_arr_search ( $data, "age>=30" );

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function encrypt($data, $key) {
   $salt = '01267543789cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=ThU@l@t0dAy';
   $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
   return $encrypted;
}
function decrypt($data, $key) {
   $salt = '01267543789cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=ThU@l@t0dAy';
   $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
   return $decrypted;
}


?>
