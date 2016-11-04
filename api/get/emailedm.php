<?php
try{
    if(isset($url_data[3]) && $url_data[3] ) {
       
        $strWhere = null;
        $strOrder = null;
        $strLimit = null;
        $id = intval($url_data[3]);
        $strWhere = " AND b.id=".$id;
        $strQuery = "SELECT *
                        FROM email_edm AS b
                        WHERE 1= 1 {$strWhere} {$strOrder} {$strLimit}";

        $dataResponse = $db->db_array($strQuery);
        $code = 200;
        
    }
    else {
        # Get list news
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY b.id DESC ";

        $get = isset($_GET) ? $_GET : null;

        // $post = isset($_POST)?$_POST:null;
        if (isset($get["name"])) {
            $name = trim($get["name"]);
            $name = explode(' ', $name);
            if($name) {
                foreach ($name as $key => $value) {
                    if($value) {
                        $strWhere .= " AND b.name LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["email"])) {
            $email = trim($get["email"]);
            $email = explode(' ', $email);
            if($email) {
                foreach ($email as $key => $value) {
                    if($value) {
                        $strWhere .= " AND b.email LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["company"])) {
            $company = trim($get["company"]);
            $company = explode(' ', $company);
            if($company) {
                foreach ($company as $key => $value) {
                    if($value) {
                        $strWhere .= " AND b.company LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND b.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND b.cr <= " . $get["to"];
        }

        if(isset($get["limit"]) && $get["limit"]){
            $strLimit .= " LIMIT 0,".intval($get["limit"]);
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;

        $strQuery = "SELECT *
                        FROM email_edm AS b
                        WHERE 1= 1 {$strWhere} {$strOrder} {$strLimit}";
        $dataResponse = $db->objJson($strQuery);
    }

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
