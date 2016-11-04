<?php 
$isUpdate = false;

if(isset($post['user_cv']['db'])) {
    $strReferTable = TABLE_USER_CV;

    $referNode = $post[$strReferTable];
    $referNode["db"]['ui'] = $user_insert_id;

    if(isset($referNode["db"])) {

        if(isset($referNode["db"]["category"]) ) {
            $referNode["db"]["category"] = implode(',', $referNode["db"]["category"]);
        }

        if(isset($referNode["db"]["location"])) {
            $referNode["db"]["location"] = implode(',', $referNode["db"]["location"]);
        }

        if(isset($referNode["db"]["level"]) ) {
            $referNode["db"]["level"] = implode(',', $referNode["db"]["level"]);
        }

         if(isset($referNode["db"]["lang"]) ) {
            $referNode["db"]["lang"] = implode(',', $referNode["db"]["lang"]);
        }

        if(isset($referNode["db"]["type"]) ) {
            $referNode["db"]["type"] = implode(',', $referNode["db"]["type"]);
        }

        if(isset($referNode["db"]["s1"])) {
            $strSalary = str_replace(',','', $referNode["db"]["s1"]);
            $strSalary = str_replace('.','', $referNode["db"]["s1"]);
            $referNode["db"]["s1"] = intval($strSalary);
        }

        if(isset($referNode["db"]["salary"]) && $referNode["db"]["salary"] == 2 ) {
            $referNode["db"]["s2"] = intval($referNode["db"]["s1"])*EXCHANGECURRENCY;
        }
        elseif(isset($referNode["db"]["s2"]) && isset($referNode["db"]["s1"])) {
            $referNode["db"]["s2"] = intval($referNode["db"]["s1"])/EXCHANGECURRENCY;
        }

        
        if($db->db_insert($referNode["db"], $strReferTable)) {
     
            $information[$strReferTable] = $referNode;
			$isUpdate = true;
     		
        } elseif($db->db_update($referNode["db"], $strReferTable, array("ui" => $user_insert_id))) {

            #update row referTable
            foreach ($referNode["db"] as $key => $value) {
                $information[$strReferTable]["db"][$key] = $value;
            }
			$isUpdate = true;
        }

        if($isUpdate == true){
            $_SESSION["userlog"]["cv"] = $information["user_cv"]["db"];
        }


    }
}

if($isUpdate) {
    saveXMLFile($file, $information);
}