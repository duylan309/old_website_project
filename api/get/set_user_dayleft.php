<?php 
try{

	if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
			$strSelect = "user.*";

			$strWhere = "WHERE user.type = 1 ";

			$strLimit = null;

			$strQuery = "   SELECT $strSelect
			                FROM ".TABLE_USER." AS user 
			                {$strJoin}
			                {$strWhere} 
			                ORDER BY user.id ASC {$strLimit} ";

			$listArray = $db->db_arrayList($strQuery);	

			if($listArray){
				foreach ($listArray as $value) {
					$strQueryJob = "SELECT COUNT(job.id) AS total
					                FROM ".TABLE_JOB." AS job 
					                WHERE job.ui = {$value['id']}";

					$total = $db->db_array($strQueryJob);	
					if($value['status'] == 2){
						$rest_job = (5 - $total['total']) < 0 ? 0 : 5 - $total['total'];
					}else if($value['status'] == 3){
						$rest_job = 0;
					}else{
						$rest_job = -1;
					}
					
					if($rest_job != -1){
						$fileUser     = FOLDERUSER.$value["id"].".xml";
			     	    if(is_file($fileUser)){

                         	if ($db->db_update(array('jobleft'=>$rest_job), TABLE_USER, array("id" => $value['id']))) {
                         		$fileInfo     = simplexml_load_file($fileUser);
                         		$information  = json_encode($fileInfo);
                         		$information  = json_decode($information, true);
                         		$information["userinfo"]["db"]["jobleft"] = $rest_job;
                         		saveXMLFile($fileUser, $information);
                         	}
			     	    }	
					}
					
				}
			}

	}else{
		die();
	}

}catch (Exception $ex) {
   $code = 501;
   $message = $ex;
   $errors = $language["unknownErrors"];
}