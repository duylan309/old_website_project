<?php
try{
	if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
		$get_page = isset($_GET['section']) ? $_GET['section'] : null; 
		if($get_page == "candidate"){
			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
				
			$strSelect = "user.*,
						  YEAR(user.dob) AS year,
						  FROM_UNIXTIME(user.created, '%e/%m/%Y') AS date_created,
						  FROM_UNIXTIME(user.created, '%m') AS month_created";

			$strWhere = "WHERE user.type = 2 ";

			$strLimit = null;
			
			// $strJoin = "LEFT JOIN ".TABLE_USER_CV." AS user_cv
	  //                   ON user_cv.ui = user.id";

			$strQuery = "   SELECT $strSelect
			                FROM ".TABLE_USER." AS user 
			                {$strJoin}
			                {$strWhere} 
			                ORDER BY user.id ASC {$strLimit} ";

			$listArray = $db->db_arrayList($strQuery);

	        if($listArray){
	     	  
	     	    require dirname(__FILE__) . "/../helper/PHPExcel.php";
	     	    $objPHPExcel = new PHPExcel();
	     	    $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
	     	    $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);
	   			$objPHPExcel->getActiveSheet()->getStyle('A:M')->getAlignment()->setVertical('top');
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:M')->getAlignment()->setHorizontal('left');
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:M')->getAlignment()->setWrapText(true);
	     	    $objPHPExcel->setActiveSheetIndex(0)->setTitle($listArray[0]['month_created'])
	     	    ->setCellValue('A1', 'Id')
	        	->setCellValue('B1', 'Register Date')
	        	->setCellValue('C1', 'Name')
	        	->setCellValue('D1', 'Age')
	        	->setCellValue('E1', 'Phone')
	        	->setCellValue('F1', 'Address')
	        	->setCellValue('G1', 'Category')
	        	->setCellValue('H1', 'Education')
	        	->setCellValue('I1', 'Working History')
	        	->setCellValue('J1', 'Job Apply')
	        	->setCellValue('K1', 'Experience')
	        	->setCellValue('L1', 'Time')
	        	->setCellValue('M1', 'Level');
	     	    $sheet_count = -1;
	     	    $sheet_holder_month= 0;
	     	    $i = 2;

	     	    foreach ($listArray as $key => $value) {
		     	   	if(intval($value['month_created']) != intval($sheet_holder_month) && $value['created'] != 0){
		     	   		$sheet_holder_month = intval($value['month_created']);
		     	   		$sheet_count++;

		     	        if($sheet_count > 0 && $value['created'] != 0){
		     	        	
		     	        	// SET TOTAL
			     	   		$objPHPExcel->setActiveSheetIndex($sheet_count-1)
			     	   		->setCellValue('A'.$i, '')
			     	   		->setCellValue('B'.$i, '')
			     	   		->setCellValue('C'.$i, '')
		     	        	->setCellValue('D'.$i, '')
		     	        	->setCellValue('E'.$i, '')
		     	        	->setCellValue('F'.$i, '')
		     	        	->setCellValue('G'.$i, '')
		     	        	->setCellValue('H'.$i, '')
		     	        	->setCellValue('I'.$i, '')
		     	        	->setCellValue('J'.$i, '')
		     	        	->setCellValue('K'.$i, '')
		     	        	->setCellValue('L'.$i, '')
		     	        	->setCellValue('M'.$i, '')
    	     	        	->setCellValue('O1', 'Total')
    		     	   		->setCellValue('P1', $i-2);

		     	        	$objPHPExcel->createSheet();
		     	        	$objPHPExcel->setActiveSheetIndex($sheet_count)->setTitle($value['month_created'])
		     	        	->setCellValue('A1', 'Id')
		     	        	->setCellValue('B1', 'Register Date')
		     	        	->setCellValue('C1', 'Name')
		     	        	->setCellValue('D1', 'Age')
		     	        	->setCellValue('E1', 'Phone')
		     	        	->setCellValue('F1', 'Address')
		     	        	->setCellValue('G1', 'Category')
		     	        	->setCellValue('H1', 'Education')
		     	        	->setCellValue('I1', 'Working History')
		     	        	->setCellValue('J1', 'Job Apply')
		     	        	->setCellValue('K1', 'Experience')
		     	        	->setCellValue('L1', 'Time')
		     	        	->setCellValue('M1', 'Level');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:M')->getAlignment()->setHorizontal('left');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:M')->getAlignment()->setVertical('top');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
		     	   			$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getStyle('A:M')->getAlignment()->setWrapText(true);
		 	        			
		     	        	$i = 2;
		     	        }
					}	

	     	   	    $age = intval($value["year"]) != 0 ? intval(date('Y')) - intval($value["year"]) : null;
		     	   
		     	    // User information
	     	    	$job_string      = null;
	     	    	$user_education  = null;
	     	    	$user_experience = null;
	     	    	$user_experience_year = null;
	     	    	$user_time  = null;
		     	    $str_category   = null;
	     	    	$user_level = null;
		     	    
		     	    $fileUser     = FOLDERUSER.$value["id"].".xml";
		     	    if(is_file($fileUser)){
		     	    	$fileInfo     = simplexml_load_file($fileUser);
		     	    	$information = json_encode($fileInfo);
		     	    	$information = json_decode($information, true);
		     	   		
		     	   		$year_experience = isset($information['user_cv']["db"]['experience']) && $information['user_cv']["db"]['experience'] ? ( isset($language['yearOfExperienceOption'][$information['user_cv']["db"]['experience']]) ? $language['yearOfExperienceOption'][$information['user_cv']["db"]['experience']] : ''): '';

		     	    	// Get Job Applied
		     	    	if(isset($information['appliedjob']['strjo'])){
		     	    		$job_array = explode(',', $information['appliedjob']['strjo']);
		     	    		if($job_array!=0){
		     	    			foreach($job_array as $job){
		     	    				$fileJob     = FOLDERJOB.$job.".xml";
		     	    				$fileInfoJob = simplexml_load_file($fileJob);
		     	    				$informationJob = json_encode($fileInfoJob);
		     	    				$informationJob = json_decode($informationJob, true);

		     	    				$job_string .= '+ '.$informationJob["db"]["ti"].chr(10);
		     	    			}
		     	    		}
		     	    	}

		     	    	if(isset($information["user_cv"]['db']['category'])){
		     	    		$category_array = explode(',', $information["user_cv"]['db']['category']);
		     	    		foreach($category_array as $category){
		     	    			$str_category .= isset($language["categoriesOption"][$category]) ? '+ '.$language["categoriesOption"][$category].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Time
		     	    	if(isset($information["user_cv"]['db']['level'])){
		     	    		$level_array = explode(',', $information["user_cv"]['db']['level']);
		     	    		foreach($level_array as $level){
		     	    			$user_level .= isset($language["jobLevelOption"][$level]) ? '+ '.$language["jobLevelOption"][$level].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Level
		     	    	if(isset($information["user_cv"]['db']['type'])){
		     	    		$time_array = explode(',', $information["user_cv"]['db']['type']);
		     	    		foreach($time_array as $type){
		     	    			$user_time .= isset($language["jobTimeOption"][$type]) ? '+ '.$language["jobTimeOption"][$type].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Experience
		     	    	if(isset($information['experience'])){
		     	    		foreach($information['experience'] as $experience){
		     	    			$user_experience .= '+ '.$experience['cmpname'].'-'.$experience['title'].'- ('.$experience["from"].'-'.$experience["to"].')'.chr(10);
		     	    		}
		     	    	}

		     	    	// Get Education
		     	    	if(isset($information['education']) && count($information['education'])){
		     	    		foreach($information['education'] as $education){
		     	    			$fieldofstudy    = !is_array($education['fieldofstudy']) && isset($education['fieldofstudy']) ?  $education['fieldofstudy'] : '';
		     	    			$degrees    = !is_array($education['degrees']) && isset($education['degrees']) ?  $education['degrees'] : '';
		     	    			$school    = !is_array($education['school']) && isset($education['school']) ?  $education['school'] : '';
		     	    			$user_education .= '+ '.$school.'-'.$degrees.'-'.$fieldofstudy.'- ('.$education["from"].'-'.$education["to"].')'.chr(10);
		     	    		}
		     	    	}

		     	    }
		     	    
		     	    $link = SITEURL.$seo_name["page"]["cv"].'/'.urlFriendly($value['name']).'.'.$value['id'];

		     	    $objPHPExcel->setActiveSheetIndex($sheet_count)
		     	    ->setCellValue('A'.$i, $value["id"])
		     	    ->setCellValue('B'.$i, $value['date_created'])
		     	    ->setCellValue('C'.$i, $value['name'])
		     	    ->setCellValue('D'.$i, $age)
		     	    ->setCellValue('E'.$i, $value["phone"])
		     	    ->setCellValue('F'.$i, $value["address"])
		     	    ->setCellValue('G'.$i, $str_category)
		     	    ->setCellValue('H'.$i, $user_education)
		     	    ->setCellValue('I'.$i, $user_experience)
		     	    ->setCellValue('J'.$i, $job_string)
		     	    ->setCellValue('K'.$i, $year_experience)
		     	    ->setCellValue('L'.$i, $user_time)
		     	    ->setCellValue('M'.$i, $user_level);

		     	    $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getHyperlink()->setUrl($link);

		     	    if(count($listArray)-1 == $key ){
	     	        	// SET TOTAL
		     	   		$objPHPExcel->setActiveSheetIndex($sheet_count)
		     	   		->setCellValue('A'.$i, '')
		     	   		->setCellValue('B'.$i, '')
		     	   		->setCellValue('C'.$i, '')
	     	        	->setCellValue('D'.$i, '')
	     	        	->setCellValue('E'.$i, '')
	     	        	->setCellValue('F'.$i, '')
	     	        	->setCellValue('G'.$i, '')
	     	        	->setCellValue('H'.$i, '')
	     	        	->setCellValue('I'.$i, '')
	     	        	->setCellValue('J'.$i, '')
	     	        	->setCellValue('K'.$i, '')
	     	        	->setCellValue('L'.$i, '')
	     	        	->setCellValue('M'.$i, '')
	     	        	->setCellValue('O1', 'Total')
		     	   		->setCellValue('P1', $i-2);
	     	        }	

		     	    $i++;	
	     	   	
	     	   }
	     	   
	     	   header('Content-Type: application/vnd.ms-excel');
	     	   header('Content-Disposition: attachment;filename="candidates.xls"');
	     	   header('Cache-Control: max-age=0');
	     	   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     	   $writer->save('php://output');
	     	   exit();

	        }

		}elseif($get_page == "job"){

			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
				
			$strSelect = "job.*,
						  FROM_UNIXTIME(job.cr, '%e/%m/%Y') AS date_created,
						  FROM_UNIXTIME(job.cr, '%m') AS month_created ";

			$strLimit = null;
			
			$strQuery = "   SELECT $strSelect
			                FROM ".TABLE_JOB." AS job 
			                {$strJoin}
			                {$strWhere} 
			                ORDER BY job.cr ASC {$strLimit} ";

			$listArray = $db->db_arrayList($strQuery);

			if($listArray){
				require dirname(__FILE__) . "/../helper/PHPExcel.php";
	     	   
	     	    $objPHPExcel = new PHPExcel();
	     	    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
	     	    $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
	   			$objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setVertical('top');
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setHorizontal('left');
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setWrapText(true);
	     	    $objPHPExcel->setActiveSheetIndex(0)->setTitle($listArray[0]['month_created'])
    		    ->setCellValue('A1', 'Id')
        	   	->setCellValue('B1', 'Register Date')
        	   	->setCellValue('C1', 'Job Category')
        	   	->setCellValue('D1', 'Title')
        	   	->setCellValue('E1', 'Level')
        	   	->setCellValue('F1', 'Time')
        	   	->setCellValue('G1', 'Experience')
        	   	->setCellValue('H1', 'Page')
        	   	->setCellValue('I1', 'Total Applied');
	     	    $sheet_count = -1;
	     	    $sheet_holder_month= 0;
	     	    $i = 2;

	     	    foreach ($listArray as $key => $value) {
		     	   	if(intval($value['month_created']) != intval($sheet_holder_month) && $value['cr'] != 0){
		     	   		$sheet_holder_month = intval($value['month_created']);
		     	   		$sheet_count++;

		     	   		if($sheet_count > 0 && $value['cr'] != 0){
		     	        	
		     	        	// SET TOTAL
			     	   		$objPHPExcel->setActiveSheetIndex($sheet_count-1)
			     	   		->setCellValue('A'.$i, '')
			     	   		->setCellValue('B'.$i, '')
			     	   		->setCellValue('C'.$i, '')
		     	        	->setCellValue('D'.$i, '')
		     	        	->setCellValue('E'.$i, '')
		     	        	->setCellValue('F'.$i, '')
		     	        	->setCellValue('G'.$i, '')
		     	        	->setCellValue('H'.$i, '')
		     	        	->setCellValue('I'.$i, '')
		     	        	->setCellValue('J1', 'Total')
	     	        		->setCellValue('K1', $i-2);

		     	        	$objPHPExcel->createSheet();
		     	        	$objPHPExcel->setActiveSheetIndex($sheet_count)->setTitle($value['month_created'])
     	        		    ->setCellValue('A1', 'Id')
	     	        	   	->setCellValue('B1', 'Register Date')
	     	        	   	->setCellValue('C1', 'Job Category')
	     	        	   	->setCellValue('D1', 'Title')
	     	        	   	->setCellValue('E1', 'Level')
	     	        	   	->setCellValue('F1', 'Time')
	     	        	   	->setCellValue('G1', 'Experience')
	     	        	   	->setCellValue('H1', 'Page')
	     	        	   	->setCellValue('I1', 'Total Applied');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setHorizontal('left');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setVertical('top');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
		     	   			$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
				     	    $objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setWrapText(true);
		 	        			
		     	        	$i = 2;
		     	        }
					}	

	     	   	    // User information
	     	    	$job_string      = null;
	     	    	$job_experience_year = null;
	     	    	$job_time  = null;
	     	    	$job_level = null;
		     	    $job_experience = null;

		     	    $fileCompany     = FOLDERCOMPANY.$value["ci"].".xml";
		     	    if(is_file($fileCompany)){
		     	    	$fileInfo     = simplexml_load_file($fileCompany);
		     	    	$information = json_encode($fileInfo);
		     	    	$information = json_decode($information, true);

		     	   		// Get Job Category
		     	   		$category_array = explode(',',$information['db']['category']);
		     	   		$str_category   = '';
		     	   		foreach($category_array as $cat){
		     	   			if($cat != 0 && $cat){
		     	   				$str_category .= '+ '.$language['categoriesOption'][intval($cat)].chr(10);
		     	   			}
		     	   		}

		     	    	// Get Time
		     	    	if(isset($value['le'])){
		     	    		$level_array = explode(',', $value['le']);
		     	    		foreach($level_array as $level){
		     	    			$job_level .= isset($language["jobLevelOption"][$level]) ? '+ '.$language["jobLevelOption"][$level].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Level
		     	    	if(isset($value['ty'])){
		     	    		$time_array = explode(',', $value['ty']);
		     	    		foreach($time_array as $type){
		     	    			$job_time .= isset($language["jobTimeOption"][$type]) ? '+ '.$language["jobTimeOption"][$type].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Experience
		     	    	if(isset($value['ex'])){
		     	    		$experience_array = explode(',', $value['ex']);
		     	    		foreach($experience_array as $experience){
		     	    			$job_experience .= isset($language["yearOfExperienceOption"][$experience]) ? '+ '.$language["yearOfExperienceOption"][$experience].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get total Applied 
		     	    	$strQueryTotal = "  SELECT COUNT(job_applied.id) AS total
							                FROM ".TABLE_JOB_APPLIED." AS job_applied 
							               	WHERE job_applied.jo = {$value['id']}";
		               	$total_applied = $db->db_array($strQueryTotal);

		     	    }
		     	    

		     	    $link = SITEURL.$seo_name["page"]["job"].'/'.urlFriendly($value['ti']).'.'.$value['id'];

		     	    $objPHPExcel->setActiveSheetIndex($sheet_count)
		     	    ->setCellValue('A'.$i, $value["id"])
		     	    ->setCellValue('B'.$i, $value['date_created'])
		     	    ->setCellValue('C'.$i, $str_category)
		     	    ->setCellValue('D'.$i, $value['ti'])
		     	    ->setCellValue('E'.$i, $job_level)
		     	    ->setCellValue('F'.$i, $job_time)
		     	    ->setCellValue('G'.$i, $job_experience)
		     	    ->setCellValue('H'.$i, $information['db']['name'])
		     	    ->setCellValue('I'.$i, $total_applied['total']);

		     	    $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getHyperlink()->setUrl($link);

		     	    if(count($listArray)-1 == $key ){
	     	        	// SET TOTAL
		     	   		$objPHPExcel->setActiveSheetIndex($sheet_count)
		     	   		->setCellValue('A'.$i, '')
		     	   		->setCellValue('B'.$i, '')
		     	   		->setCellValue('C'.$i, '')
	     	        	->setCellValue('D'.$i, '')
	     	        	->setCellValue('E'.$i, '')
	     	        	->setCellValue('F'.$i, '')
	     	        	->setCellValue('G'.$i, '')
	     	        	->setCellValue('H'.$i, '')
	     	        	->setCellValue('I'.$i, '')
	     	        	->setCellValue('J1', 'Total')
	     	        	->setCellValue('K1', $i-2);
	     	        }	

		     	    $i++;	
	     	   	
	     	   }

	     	   header('Content-Type: application/vnd.ms-excel');
	     	   header('Content-Disposition: attachment;filename="jobs.xls"');
	     	   header('Cache-Control: max-age=0');
	     	   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     	   $writer->save('php://output');
	     	   exit();
	        
			}


		}elseif($get_page == "brand_page"){

			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
				
			$strSelect = "company.*,
						  FROM_UNIXTIME(company.created, '%e/%m/%Y') AS date_created,
						  FROM_UNIXTIME(company.created, '%m') AS month_created ";

			$strLimit = null;
			
			$strQuery = "   SELECT $strSelect
			                FROM ".TABLE_COMPANY." AS company 
			                {$strJoin}
			                {$strWhere} 
			                ORDER BY company.created ASC {$strLimit} ";

			$listArray = $db->db_arrayList($strQuery);

			if($listArray){
				require dirname(__FILE__) . "/../helper/PHPExcel.php";
	     	   
	     	    $objPHPExcel = new PHPExcel();
	     	    $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
	     	    $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);
	   			$objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setVertical('top');
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setHorizontal('left');
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setWrapText(true);
	     	    $objPHPExcel->setActiveSheetIndex(0)->setTitle($listArray[0]['month_created'])
    		    ->setCellValue('A1', 'Id')
        	   	->setCellValue('B1', 'Register Date')
        	   	->setCellValue('C1', 'Brand Name')
        	   	->setCellValue('D1', 'Category')
        	   	->setCellValue('E1', 'Facebook')
        	   	->setCellValue('F1', 'Address')
        	   	->setCellValue('G1', 'Total Job')
        	   	->setCellValue('H1', 'Total Applied');
	     	    $sheet_count = -1;
	     	    $sheet_holder_month= 0;
	     	    $i = 2;

	     	    foreach ($listArray as $key => $value) {
		     	   	if(intval($value['month_created']) != intval($sheet_holder_month) && $value['created'] != 0){
		     	   		$sheet_holder_month = intval($value['month_created']);
		     	   		$sheet_count++;

		     	   		if($sheet_count > 0 && $value['created'] != 0){
		     	        	
		     	        	// SET TOTAL
			     	   		$objPHPExcel->setActiveSheetIndex($sheet_count-1)
			     	   		->setCellValue('A'.$i, '')
			     	   		->setCellValue('B'.$i, '')
			     	   		->setCellValue('C'.$i, '')
		     	        	->setCellValue('D'.$i, '')
		     	        	->setCellValue('E'.$i, '')
		     	        	->setCellValue('F'.$i, '')
		     	        	->setCellValue('G'.$i, '')
		     	        	->setCellValue('H'.$i, '')
		     	        	->setCellValue('I1', 'Total')
	     	        		->setCellValue('J1', $i-2);

		     	        	$objPHPExcel->createSheet();
		     	        	$objPHPExcel->setActiveSheetIndex($sheet_count)->setTitle($value['month_created'])
		        		    		    ->setCellValue('A1', 'Id')
		        		        	   	->setCellValue('B1', 'Register Date')
		        		        	   	->setCellValue('C1', 'Brand Name')
		        		        	   	->setCellValue('D1', 'Category')
		        		        	   	->setCellValue('E1', 'Facebook')
		        		        	   	->setCellValue('F1', 'Address')
		        		        	   	->setCellValue('G1', 'Total Job')
		        		        	   	->setCellValue('H1', 'Total Applied');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setHorizontal('left');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setVertical('top');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
		     	   			$objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
				     	    $objPHPExcel->getActiveSheet()->getStyle('A:I')->getAlignment()->setWrapText(true);
		 	        			
		     	        	$i = 2;
		     	        }
					}	

	     	   	    // User information
	     	    	$total_applied_job = 0;
		     	    $fileCompany     = FOLDERCOMPANY.$value["id"].".xml";
		     	    if(is_file($fileCompany)){
		     	    	$fileInfo     = simplexml_load_file($fileCompany);
		     	    	$information = json_encode($fileInfo);
		     	    	$information = json_decode($information, true);

		     	   		// Get Job Category
		     	   		$str_category   = '';
		     	   		if(isset($information['db']['category']) && !empty($information['db']['category'])){
		     	   			$category_array = explode(',',$information['db']['category']);
		     	   			foreach($category_array as $cat){
		     	   				if($cat != 0 && $cat){
		     	   					$str_category .= isset($language['categoriesOption'][intval($cat)]) ? '+ '.$language['categoriesOption'][intval($cat)].chr(10) : '';
		     	   				}
		     	   			}
		     	   		}


		     	   		if(isset($information['totalJob']['strji'])){
		     	   			$job_array = explode(',', $information['totalJob']['strji']);
		     	    		foreach($job_array as $job){
    			     	    	// Get total Applied 
    			     	    	$strQueryTotal = "  SELECT COUNT(job_applied.id) AS total
    								                FROM ".TABLE_JOB_APPLIED." AS job_applied 
    								               	WHERE job_applied.jo = {$job}";
    			               	$total_applied = $db->db_array($strQueryTotal);
		     	    			$total_applied_job = $total_applied_job + $total_applied['total'];
		     	    		}
		     	   		}
		     	    }
		     	    

		     	    $link = SITEURL.$information['db']['url'];
		     	    $totalJob = isset($information['totalJob']['total']) ? $information['totalJob']['total'] : 0;
		     	    $facebook = isset($information['db']['facebook']) && $information['db']['facebook'] && !empty($information['db']['facebook']) ? stripcslashes($information['db']['facebook']) : '';
		     	    $objPHPExcel->setActiveSheetIndex($sheet_count)
		     	    ->setCellValue('A'.$i, $value["id"])
		     	    ->setCellValue('B'.$i, $value['date_created'])
		     	    ->setCellValue('C'.$i, $information['db']['name'])
		     	    ->setCellValue('D'.$i, $str_category)
		     	    ->setCellValue('E'.$i, $facebook)
		     	    ->setCellValue('F'.$i, $information['db']['address'])
		     	    ->setCellValue('G'.$i, $totalJob)
		     	    ->setCellValue('H'.$i, $total_applied_job);

		     	    $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getHyperlink()->setUrl($link);

		     	    if(count($listArray)-1 == $key ){
	     	        	// SET TOTAL
		     	   		$objPHPExcel->setActiveSheetIndex($sheet_count)
		     	   		->setCellValue('A'.$i, '')
		     	   		->setCellValue('B'.$i, '')
		     	   		->setCellValue('C'.$i, '')
	     	        	->setCellValue('D'.$i, '')
	     	        	->setCellValue('E'.$i, '')
	     	        	->setCellValue('F'.$i, '')
	     	        	->setCellValue('G'.$i, '')
	     	        	->setCellValue('H'.$i, '')
	     	        	->setCellValue('I1', 'Total')
	     	        	->setCellValue('J1', $i-2);
	     	        }	

		     	    $i++;	
	     	   	
	     	   }

	     	   header('Content-Type: application/vnd.ms-excel');
	     	   header('Content-Disposition: attachment;filename="brand_page.xls"');
	     	   header('Cache-Control: max-age=0');
	     	   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     	   $writer->save('php://output');
	     	   exit();
	        }

		}elseif($get_page == "history"){

			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
				
			$strSelect = "	user_search.*,
							MONTH(user_search.cr) AS month_created,
							DATE_FORMAT(user_search.cr,'%m-%d-%Y') AS date_created ";

			$strLimit = null;
			
			$strQuery = "   SELECT $strSelect
			                FROM ".TABLE_USER_SEARCH." AS user_search 
			                {$strJoin}
			                {$strWhere} 
			                ORDER BY user_search.cr ASC {$strLimit} ";
			$listArray = $db->db_arrayList($strQuery);

			if($listArray){
				require dirname(__FILE__) . "/../helper/PHPExcel.php";
	     	   
	     	    $objPHPExcel = new PHPExcel();
	     	    $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
	     	    $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold(true);
	   			$objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setVertical('top');
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setHorizontal('left');
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setWrapText(true);
	     	    $objPHPExcel->setActiveSheetIndex(0)->setTitle($listArray[0]['month_created'])
			    		    ->setCellValue('A1', 'Id')
			    		    ->setCellValue('B1', 'Date')
			        	   	->setCellValue('C1', 'User')
			        	   	->setCellValue('D1', 'Search')
			        	   	->setCellValue('E1', 'Salary')
			        	   	->setCellValue('F1', 'Category')
			        	   	->setCellValue('G1', 'Time')
			        	   	->setCellValue('H1', 'Level')
			        	   	->setCellValue('I1', 'Experience')
			        	   	->setCellValue('J1', 'Language');
	     	    $sheet_count = -1;
	     	    $sheet_holder_month= 0;
	     	    $i = 2;

	     	    foreach ($listArray as $key => $value) {
		     	   	if(intval($value['month_created']) != intval($sheet_holder_month) && $value['cr'] != 0){
		     	   		$sheet_holder_month = intval($value['month_created']);
		     	   		$sheet_count++;

		     	   		if($sheet_count > 0 && $value['cr'] != 0){
		     	        	
		     	        	// SET TOTAL
			     	   		$objPHPExcel->setActiveSheetIndex($sheet_count-1)
			     	   				    ->setCellValue('A1', 'Id')
			     	   				    ->setCellValue('B1', 'Date')
			     	   		    	   	->setCellValue('C1', 'User')
			     	   		    	   	->setCellValue('D1', 'Search')
			     	   		    	   	->setCellValue('E1', 'Salary')
			     	   		    	   	->setCellValue('F1', 'Category')
			     	   		    	   	->setCellValue('G1', 'Time')
			     	   		    	   	->setCellValue('H1', 'Level')
			     	   		    	   	->setCellValue('I1', 'Experience')
			     	   		    	   	->setCellValue('J1', 'Language')
		     	        				->setCellValue('K1', 'Total')
	     	        					->setCellValue('L1', $i-2);

		     	        	$objPHPExcel->createSheet();
		     	        	$objPHPExcel->setActiveSheetIndex($sheet_count)->setTitle($value['month_created'])
    		    		    		    ->setCellValue('A1', 'Id')
    		    		    		    ->setCellValue('B1', 'Date')
    		    		        	   	->setCellValue('C1', 'User')
    		    		        	   	->setCellValue('D1', 'Search')
    		    		        	   	->setCellValue('E1', 'Salary')
    		    		        	   	->setCellValue('F1', 'Category')
    		    		        	   	->setCellValue('G1', 'Time')
    		    		        	   	->setCellValue('H1', 'Level')
    		    		        	   	->setCellValue('I1', 'Experience')
    		    		        	   	->setCellValue('J1', 'Language');

		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setHorizontal('left');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setVertical('top');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
		     	   			$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold(true);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
				     	    $objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setWrapText(true);
		 	        			
		     	        	$i = 2;
		     	        }
					}	

	     	   	    // User information
	     	    	$total_applied_job = 0;
	     	    	$user_info = "Guest";
	     	    	$job_time  = null;
	     	    	$job_level = null;
		     	    $job_experience = null;
	     	   		$str_category   = '';

		     	    $fileUser     = FOLDERUSER.$value["ui"].".xml";
		     	    if(is_file($fileUser)){
		     	    	$fileInfo     = simplexml_load_file($fileUser);
		     	    	$information = json_encode($fileInfo);
		     	    	$information = json_decode($information, true);

		     	   		// Get Job Category
		     	   		if(isset($value['cat']) && !empty($value['cat'])){
		     	   			$category_array = explode(',',$value['cat']);
		     	   			foreach($category_array as $cat){
		     	   				if($cat != 0 && $cat){
		     	   					$str_category .= isset($language['categoriesOption'][intval($cat)]) ? '+ '.$language['categoriesOption'][intval($cat)].chr(10) : '';
		     	   				}
		     	   			}
		     	   		}


		     	   		$user_info = '+ '.$information["userinfo"]["db"]["id"].chr(10).'+ '.$information["userinfo"]["db"]["name"].chr(10).'+ '.$information["userinfo"]["db"]["email"].chr(10);
		     	    }
		     	    
		     	    // Get Time
		     	    if(isset($value['le'])){
		     	    	$level_array = explode(',', $value['le']);
		     	    	foreach($level_array as $level){
		     	    		$job_level .= isset($language["jobLevelOption"][$level]) ? '+ '.$language["jobLevelOption"][$level].chr(10) : '';
		     	    	}
		     	    }

		     	    // Get Level
		     	    if(isset($value['ty'])){
		     	    	$time_array = explode(',', $value['ty']);
		     	    	foreach($time_array as $type){
		     	    		$job_time .= isset($language["jobTimeOption"][$type]) ? '+ '.$language["jobTimeOption"][$type].chr(10) : '';
		     	    	}
		     	    }

		     	    // Get Experience
		     	    if(isset($value['ex'])){
		     	    	$experience_array = explode(',', $value['ex']);
		     	    	foreach($experience_array as $experience){
		     	    		$job_experience .= isset($language["yearOfExperienceOption"][$experience]) ? '+ '.$language["yearOfExperienceOption"][$experience].chr(10) : '';
		     	    	}
		     	    }

		     	    $objPHPExcel->setActiveSheetIndex($sheet_count)
					     	    ->setCellValue('A'.$i, $value["id"])
					     	    ->setCellValue('B'.$i, $value['date_created'])
					     	    ->setCellValue('C'.$i, $user_info)
					     	    ->setCellValue('D'.$i, $value["title"])
					     	    ->setCellValue('E'.$i, $value["sa"])
					     	    ->setCellValue('F'.$i, $str_category)
					     	    ->setCellValue('G'.$i, $job_time)
					     	    ->setCellValue('H'.$i, $job_level)
					     	    ->setCellValue('I'.$i, $job_experience)
					     	    ->setCellValue('J'.$i, $value["la"]);

		     	    if(count($listArray)-1 == $key ){
	     	        	// SET TOTAL
		     	   		$objPHPExcel->setActiveSheetIndex($sheet_count)
		     	   		->setCellValue('A'.$i, '')
		     	   		->setCellValue('B'.$i, '')
		     	   		->setCellValue('C'.$i, '')
	     	        	->setCellValue('D'.$i, '')
	     	        	->setCellValue('E'.$i, '')
	     	        	->setCellValue('F'.$i, '')
	     	        	->setCellValue('G'.$i, '')
	     	        	->setCellValue('H'.$i, '')
	     	        	->setCellValue('I1', 'Total')
	     	        	->setCellValue('J1', $i-2);
	     	        }	

		     	    $i++;	
	     	   	
	     	   }

	     	   header('Content-Type: application/vnd.ms-excel');
	     	   header('Content-Disposition: attachment;filename="search_history.xls"');
	     	   header('Cache-Control: max-age=0');
	     	   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     	   $writer->save('php://output');
	     	   exit();
	        }

		}elseif($get_page == "candidate_filter"){ #

			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
				
			$strLimit = null;
			
			$strSelect = "  user.*,
							job_applied.company_id AS company_id,
							job_applied.jo AS job_id,
							YEAR(user.dob) AS year,
							FROM_UNIXTIME(user.created, '%e/%m/%Y') AS date_created,
							FROM_UNIXTIME(user.created, '%m') AS month_created";
     
       
        	$strWhere = " WHERE user.id = user_saved.ui 
        					AND job_applied.ui = user_saved.ui";
          	
			#status = 1 / like
			#status = 3 / interview
			#status = 4 / hire
			#status = 5 / deny

			if(isset($_GET["status"]) && $_GET["status"]) {
                $strWhere .=" AND user_saved.status = {$_GET["status"]}";
            }else{
            	die();
            }

            $strLimit = null;
            if(isset($_GET["limit"]) && $_GET["limit"]) {
                $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
            }

            $strQuery = "   SELECT $strSelect
                            FROM ".TABLE_USER." AS user, 
                            	 ".TABLE_USER_SAVED." AS user_saved,
                            	 ".TABLE_JOB_APPLIED." AS job_applied
                            	 {$strWhere} 
                            	 GROUP BY job_applied.ui 
                            	 ORDER BY job_applied.id DESC 
                            	 {$strLimit}";

			$listArray = $db->db_arrayList($strQuery);

			if($listArray){
				
				require dirname(__FILE__) . "/../helper/PHPExcel.php";
	     	   
	     	    $objPHPExcel = new PHPExcel();
	     	    $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
	     	    $objPHPExcel->getActiveSheet()->getStyle("A1:N1")->getFont()->setBold(true);
	   			$objPHPExcel->getActiveSheet()->getStyle('A:N')->getAlignment()->setVertical('top');
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:N')->getAlignment()->setHorizontal('left');
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:N')->getAlignment()->setWrapText(true);
	     	    $objPHPExcel->setActiveSheetIndex(0)->setTitle($listArray[0]['month_created'])
			    		    ->setCellValue('A1', 'Id')
			    		    ->setCellValue('B1', 'Date')
			        	   	->setCellValue('C1', 'Name')
			        	   	->setCellValue('D1', 'Age')
			        	   	->setCellValue('E1', 'Phone')
			        	   	->setCellValue('F1', 'Address')
			        	   	->setCellValue('G1', 'Category')
			        	   	->setCellValue('H1', 'Education')
			        	   	->setCellValue('I1', 'Working History')
			        	   	->setCellValue('J1', 'Job Level')
			        	   	->setCellValue('K1', 'Experience')
			        	   	->setCellValue('L1', 'Time')
			        	   	->setCellValue('M1', 'Job Applied')
			        	   	->setCellValue('N1', 'Company Applied');
	     	    $sheet_count = -1;
	     	    $sheet_holder_month= 0;
	     	    $i = 2;

	     	    foreach ($listArray as $key => $value) {
		     	   	
		     	   	if(intval($value['month_created']) != intval($sheet_holder_month) && $value['created'] != 0){
		     	   		$sheet_holder_month = intval($value['month_created']);
		     	   		$sheet_count++;

		     	   		if($sheet_count > 0 && $value['created'] != 0){
		     	        	
		     	        	// SET TOTAL
			     	   		$objPHPExcel->setActiveSheetIndex($sheet_count-1)
     	   				    		    ->setCellValue('A1', 'Id')
     	   				    		    ->setCellValue('B1', 'Date')
     	   				        	   	->setCellValue('C1', 'Name')
     	   				        	   	->setCellValue('D1', 'Age')
     	   				        	   	->setCellValue('E1', 'Phone')
     	   				        	   	->setCellValue('F1', 'Address')
     	   				        	   	->setCellValue('G1', 'Category')
     	   				        	   	->setCellValue('H1', 'Education')
     	   				        	   	->setCellValue('I1', 'Working History')
     	   				        	   	->setCellValue('J1', 'Job Level')
     	   				        	   	->setCellValue('K1', 'Experience')
     	   				        	   	->setCellValue('L1', 'Time')
     	   				        	   	->setCellValue('M1', 'Job Applied')
     	   				        	   	->setCellValue('N1', 'Company Applied')
		     	        				->setCellValue('O1', 'Total')
	     	        					->setCellValue('P1', $i-2);

		     	        	$objPHPExcel->createSheet();
		     	        	$objPHPExcel->setActiveSheetIndex($sheet_count)->setTitle($value['month_created'])
    		    		    		    ->setCellValue('A1', 'Id')
     	   				    		    ->setCellValue('B1', 'Date')
     	   				        	   	->setCellValue('C1', 'Name')
     	   				        	   	->setCellValue('D1', 'Age')
     	   				        	   	->setCellValue('E1', 'Phone')
     	   				        	   	->setCellValue('F1', 'Address')
     	   				        	   	->setCellValue('G1', 'Category')
     	   				        	   	->setCellValue('H1', 'Education')
     	   				        	   	->setCellValue('I1', 'Working History')
     	   				        	   	->setCellValue('J1', 'Job Level')
     	   				        	   	->setCellValue('K1', 'Experience')
     	   				        	   	->setCellValue('L1', 'Time')
     	   				        	   	->setCellValue('M1', 'Job Applied')
     	   				        	   	->setCellValue('N1', 'Company Applied');

		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:N')->getAlignment()->setHorizontal('left');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:N')->getAlignment()->setVertical('top');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
		     	   			$objPHPExcel->getActiveSheet()->getStyle("A1:N1")->getFont()->setBold(true);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
  				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
				     	    $objPHPExcel->getActiveSheet()->getStyle('A:N')->getAlignment()->setWrapText(true);
		 	        			
		     	        	$i = 2;
		     	        }
					}	


	     	   	    // User information
	     	    	$age = intval($value["year"]) != 0 ? intval(date('Y')) - intval($value["year"]) : null;
		     	   
		     	    // User information
	     	    	$job_string      = null;
	     	    	$user_education  = null;
	     	    	$user_experience = null;
	     	    	$user_experience_year = null;
	     	    	$user_time  = null;
		     	    $str_category   = null;
	     	    	$user_level = null;
		     	    
		     	    $fileUser     = FOLDERUSER.$value["id"].".xml";
		     	    if(is_file($fileUser)){
		     	    	$fileInfo     = simplexml_load_file($fileUser);
		     	    	$information = json_encode($fileInfo);
		     	    	$information = json_decode($information, true);
		     	   		
		     	   		$year_experience = isset($information['user_cv']["db"]['experience']) && $information['user_cv']["db"]['experience'] ? ( isset($language['yearOfExperienceOption'][$information['user_cv']["db"]['experience']]) ? $language['yearOfExperienceOption'][$information['user_cv']["db"]['experience']] : ''): '';

		     	    	if(isset($information["user_cv"]['db']['category'])){
		     	    		$category_array = explode(',', $information["user_cv"]['db']['category']);
		     	    		foreach($category_array as $category){
		     	    			$str_category .= isset($language["categoriesOption"][$category]) ? '+ '.$language["categoriesOption"][$category].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Time
		     	    	if(isset($information["user_cv"]['db']['level'])){
		     	    		$level_array = explode(',', $information["user_cv"]['db']['level']);
		     	    		foreach($level_array as $level){
		     	    			$user_level .= isset($language["jobLevelOption"][$level]) ? '+ '.$language["jobLevelOption"][$level].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Level
		     	    	if(isset($information["user_cv"]['db']['type'])){
		     	    		$time_array = explode(',', $information["user_cv"]['db']['type']);
		     	    		foreach($time_array as $type){
		     	    			$user_time .= isset($language["jobTimeOption"][$type]) ? '+ '.$language["jobTimeOption"][$type].chr(10) : '';
		     	    		}
		     	    	}

		     	    	// Get Experience
		     	    	if(isset($information['experience'])){
		     	    		foreach($information['experience'] as $experience){
		     	    			$user_experience .= '+ '.$experience['cmpname'].'-'.$experience['title'].'- ('.$experience["from"].'-'.$experience["to"].')'.chr(10);
		     	    		}
		     	    	}

		     	    	// Get Education
		     	    	if(isset($information['education']) && count($information['education'])){
		     	    		foreach($information['education'] as $education){
		     	    			$fieldofstudy    = !is_array($education['fieldofstudy']) && isset($education['fieldofstudy']) ?  $education['fieldofstudy'] : '';
		     	    			$degrees    = !is_array($education['degrees']) && isset($education['degrees']) ?  $education['degrees'] : '';
		     	    			$school    = !is_array($education['school']) && isset($education['school']) ?  $education['school'] : '';
		     	    			$user_education .= '+ '.$school.'-'.$degrees.'-'.$fieldofstudy.'- ('.$education["from"].'-'.$education["to"].')'.chr(10);
		     	    		}
		     	    	}

		     	    }

		     	    $company_name = '';
		     	    $fileCompany     = FOLDERCOMPANY.$value["company_id"].".xml";
		     	    if(is_file($fileCompany)){
		     	    	$fileInfoCompany     = simplexml_load_file($fileCompany);
		     	    	$information_company = json_encode($fileInfoCompany);
		     	    	$information_company = json_decode($information_company, true);

		     	    	$company_name = $information_company["db"]["name"];
	     	    	}

	     	    	$fileJob     = FOLDERJOB.$value["job_id"].".xml";
		     	    if(is_file($fileJob)){
		     	    	$fileInfoJob     = simplexml_load_file($fileJob);
		     	    	$information_job = json_encode($fileInfoJob);
		     	    	$information_job = json_decode($information_job, true);

		     	    	$job_string      = $information_job["db"]["ti"];
	     	    	}

		     	    $link_job     = SITEURL.$seo_name["page"]["job"].'/'.urlFriendly($information_job["db"]['ti']).'.'.$information_job["db"]['id'];
		     	    $link_user    = SITEURL.$seo_name["page"]["cv"].'/'.urlFriendly($value['name']).'.'.$value['id'];
		     	    $link_company = SITEURL.$information_company["db"]["url"];


		     	    $objPHPExcel->setActiveSheetIndex($sheet_count)
					     	    ->setCellValue('A'.$i, $value["id"])
					     	    ->setCellValue('B'.$i, $value['date_created'])
					     	    ->setCellValue('C'.$i, $value['name'])
					     	    ->setCellValue('D'.$i, $age)
					     	    ->setCellValue('E'.$i, $value["phone"])
					     	    ->setCellValue('F'.$i, $value["address"])
					     	    ->setCellValue('G'.$i, $str_category)
					     	    ->setCellValue('H'.$i, $user_education)
					     	    ->setCellValue('I'.$i, $user_experience)
					     	    ->setCellValue('J'.$i, $user_level)
					     	    ->setCellValue('K'.$i, $year_experience)
					     	    ->setCellValue('L'.$i, $user_time)
					     	    ->setCellValue('M'.$i, $job_string)
					     	    ->setCellValue('N'.$i, $company_name);

		     	    $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getHyperlink()->setUrl($link_user);
		     	    $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getHyperlink()->setUrl($link_job);
		     	    $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getHyperlink()->setUrl($link_company);


		     	    if(count($listArray)-1 == $key ){
	     	        	// SET TOTAL
		     	   		$objPHPExcel->setActiveSheetIndex($sheet_count)
		     	   		->setCellValue('A'.$i, '')
		     	   		->setCellValue('B'.$i, '')
		     	   		->setCellValue('C'.$i, '')
		     	   		->setCellValue('D'.$i, '')
		     	   		->setCellValue('E'.$i, '')
		     	   		->setCellValue('F'.$i, '')
		     	   		->setCellValue('G'.$i, '')
		     	   		->setCellValue('H'.$i, '')
		     	   		->setCellValue('I'.$i, '')
		     	   		->setCellValue('J'.$i, '')
		     	   		->setCellValue('K'.$i, '')
		     	   		->setCellValue('L'.$i, '')
		     	   		->setCellValue('M'.$i, '')
		     	   		->setCellValue('N'.$i, '')
		     	   		->setCellValue('O1', 'Total')
	     	        	->setCellValue('P1', $i-2);
	     	        }	

		     	    $i++;	
	     	   	
	     	   }

	     	   #status = 1 / like
	     	   #status = 3 / interview
	     	   #status = 4 / hire
	     	   #status = 5 / deny
	     	    $name_title_excel = "";
				if(isset($_GET["status"]) && $_GET["status"]) {
					if($_GET["status"] == 1){
						$name_title_excel = "favorite";
					}else if($_GET["status"] == 3){
						$name_title_excel = "interview";
					}else if($_GET["status"] == 4){
						$name_title_excel = "hire";
					}else if($_GET["status"] == 5){
						$name_title_excel = "deny";
					}else{
						die();
					}
				}else{
					die();
				}


	     	   header('Content-Type: application/vnd.ms-excel');
	     	   header('Content-Disposition: attachment;filename="candidate_'.$name_title_excel.'.xls"');
	     	   header('Cache-Control: max-age=0');
	     	   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     	   $writer->save('php://output');
	     	   exit();
	        }

		}if($get_page == "employer"){
			$strSelect = null;
			$strWhere = null;
			$strLimit = null;
			$strJoin = null;
				
			$strSelect = "user.*,
						  YEAR(user.dob) AS year,
						  FROM_UNIXTIME(user.created, '%e/%m/%Y') AS date_created,
						  FROM_UNIXTIME(user.created, '%m') AS month_created,
						  FROM_UNIXTIME(user.dayleft,'%e/%m/%Y') AS date_expired,
						  FROM_UNIXTIME(user.last_signin,'%e/%m/%Y') AS last_signin ";

		    #status = 2 / Basic
			#status = 3 / Premium			  

			$strWhere = "WHERE user.type = 1 ";

			$strLimit = null;
			
			$strQuery = "   SELECT $strSelect
			                FROM ".TABLE_USER." AS user 
			                {$strJoin}
			                {$strWhere} 
			                ORDER BY user.id ASC {$strLimit} ";

			$listArray = $db->db_arrayList($strQuery);

	        if($listArray){
	     	  
	     	    require dirname(__FILE__) . "/../helper/PHPExcel.php";
	     	    $objPHPExcel = new PHPExcel();
	     	    $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
	     	    $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getFont()->setBold(true);
	   			$objPHPExcel->getActiveSheet()->getStyle('A:K')->getAlignment()->setVertical('top');
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:K')->getAlignment()->setHorizontal('left');
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	     	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	     	    $objPHPExcel->getActiveSheet()->getStyle('A:K')->getAlignment()->setWrapText(true);
	     	    $objPHPExcel->setActiveSheetIndex(0)->setTitle($listArray[0]['month_created'])
				     	    ->setCellValue('A1', 'Id')
				        	->setCellValue('B1', 'Register Date')
				        	->setCellValue('C1', 'Name')
				        	->setCellValue('D1', 'Phone')
				        	->setCellValue('E1', 'Email')
				        	->setCellValue('F1', 'Last Sign In')
				        	->setCellValue('G1', 'Day left')
				        	->setCellValue('H1', 'Package')
				        	->setCellValue('I1', 'Pages')
				        	->setCellValue('J1', 'Applicants')
				        	->setCellValue('K1', 'Jobs');
	     	    $sheet_count = -1;
	     	    $sheet_holder_month= 0;
	     	    $i = 2;

	     	    foreach ($listArray as $key => $value) {
		     	   	if(intval($value['month_created']) != intval($sheet_holder_month) && $value['created'] != 0){
		     	   		$sheet_holder_month = intval($value['month_created']);
		     	   		$sheet_count++;

		     	        if($sheet_count > 0 && $value['created'] != 0){
		     	        	
		     	        	// SET TOTAL
			     	   		$objPHPExcel->setActiveSheetIndex($sheet_count-1)
						     	   		->setCellValue('A'.$i, '')
						     	   		->setCellValue('B'.$i, '')
						     	   		->setCellValue('C'.$i, '')
					     	        	->setCellValue('D'.$i, '')
					     	        	->setCellValue('E'.$i, '')
					     	        	->setCellValue('F'.$i, '')
					     	        	->setCellValue('G'.$i, '')
					     	        	->setCellValue('H'.$i, '')
					     	        	->setCellValue('I'.$i, '')
					     	        	->setCellValue('J'.$i, '')
					     	        	->setCellValue('K'.$i, '')
			    	     	        	->setCellValue('L1', 'Total')
			    		     	   		->setCellValue('M1', $i-2);

		     	        	$objPHPExcel->createSheet();
		     	        	$objPHPExcel->setActiveSheetIndex($sheet_count)->setTitle($value['month_created'])
					     	        	->setCellValue('A1', 'Id')
							        	->setCellValue('B1', 'Register Date')
							        	->setCellValue('C1', 'Name')
							        	->setCellValue('D1', 'Phone')
							        	->setCellValue('E1', 'Email')
							        	->setCellValue('F1', 'Last Sign In')
							        	->setCellValue('G1', 'Day left')
							        	->setCellValue('H1', 'Package')
							        	->setCellValue('I1', 'Pages')
							        	->setCellValue('J1', 'Applicants')
							        	->setCellValue('K1', 'Jobs');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:K')->getAlignment()->setHorizontal('left');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A:K')->getAlignment()->setVertical('top');
		     	   			$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00abbe');
		     	   			$objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getFont()->setBold(true);
		     	  			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
				     	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
				     	    $objPHPExcel->getActiveSheet()->getStyle('A:K')->getAlignment()->setWrapText(true);
		 	        			
		     	        	$i = 2;
		     	        }
					}	

	     	   	    $age = intval($value["year"]) != 0 ? intval(date('Y')) - intval($value["year"]) : null;
		     	   
		     	    // User information
	     	    	$job_string           = null;
	     	    	$user_education       = null;
	     	    	$user_experience      = null;
	     	    	$user_experience_year = null;
	     	    	$user_time            = null;
		     	    $str_category         = null;
	     	    	$user_level           = null;
		     	    
		     	    $fileUser     = FOLDERUSER.$value["id"].".xml";
		     	   
		     	    if(is_file($fileUser)){
		     	    	$fileInfo     = simplexml_load_file($fileUser);
		     	    	$information  = json_encode($fileInfo);
		     	    	$information  = json_decode($information, true);
		     	   		
		     	    	

		     	    }
		     	    
		     	    $strQueryCompany    = " SELECT company.*
				     	                    FROM ".TABLE_COMPANY." AS company 
				     	                    WHERE company.ui = {$value["id"]}";

		     	    $listArrayCompany   = $db->db_arrayList($strQueryCompany);
		     	    $str_company = '';
		     	    if($listArrayCompany){
		     	    	foreach ($listArrayCompany as $key => $company_value) {
		     	    		$str_company = $company_value["name"] ? '+ '.$company_value["name"].chr(10) : '';
		     	    	}
		     	    }

		     	    $strQueryJob    = " SELECT COUNT(job.id) AS total_job
				     	                    FROM ".TABLE_JOB." AS job 
				     	                    WHERE job.ui = {$value["id"]}
				     	                    LIMIT 1";
		     	    $listArrayJob   = $db->db_array($strQueryJob);

		     	    $total_job = $listArrayJob["total_job"] ? $listArrayJob["total_job"] : 0;

		     	    $strQueryJobApplied    = " SELECT COUNT(job_applied.id) AS total_applicants
				     	                    FROM ".TABLE_JOB_APPLIED." AS job_applied
				     	                    WHERE job_applied.ei = {$value["id"]} LIMIT 1";

		     	    $listArrayJobApplied   = $db->db_array($strQueryJobApplied);
		     	    $total_applicants = $listArrayJobApplied["total_applicants"] ? $listArrayJobApplied["total_applicants"] : 0;

		     	    $objPHPExcel->setActiveSheetIndex($sheet_count)
					     	    ->setCellValue('A'.$i, $value["id"])
					     	    ->setCellValue('B'.$i, $value['date_created'])
					     	    ->setCellValue('C'.$i, $value['name'])
					     	    ->setCellValue('D'.$i, $value["phone"])
					     	    ->setCellValue('E'.$i, $value["email"])
					     	    ->setCellValue('F'.$i, $value["last_signin"])
					     	    ->setCellValue('G'.$i, $value["date_expired"])
					     	    ->setCellValue('H'.$i, $value["status"] == 2 || $value["status"] == 3 ? ( $value["status"] == 2 ? 'Standard' : 'Premium') : "")
					     	    ->setCellValue('I'.$i, $str_company)
					     	    ->setCellValue('J'.$i, $total_applicants)
					     	    ->setCellValue('K'.$i, $total_job);


		     	    if(count($listArray)-1 == $key ){
	     	        	// SET TOTAL
		     	   		$objPHPExcel->setActiveSheetIndex($sheet_count)
					     	   		->setCellValue('A'.$i, '')
					     	   		->setCellValue('B'.$i, '')
					     	   		->setCellValue('C'.$i, '')
				     	        	->setCellValue('D'.$i, '')
				     	        	->setCellValue('E'.$i, '')
				     	        	->setCellValue('F'.$i, '')
				     	        	->setCellValue('G'.$i, '')
				     	        	->setCellValue('H'.$i, '')
				     	        	->setCellValue('I'.$i, '')
				     	        	->setCellValue('J'.$i, '')
				     	        	->setCellValue('K'.$i, '')
				     	        	->setCellValue('L1', 'Total')
					     	   		->setCellValue('M1', $i-2);
	     	        }	

		     	    $i++;	
	     	   	
	     	   }
	     	   
	     	   header('Content-Type: application/vnd.ms-excel');
	     	   header('Content-Disposition: attachment;filename="employer.xls"');
	     	   header('Cache-Control: max-age=0');
	     	   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	     	   $writer->save('php://output');
	     	   exit();

	        }

		}else{
			die();
		}

    }else{
    	die();
    }

}catch (Exception $ex) {
   $code = 501;
   $message = $ex;
   $errors = $language["unknownErrors"];
}

?>