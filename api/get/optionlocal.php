<?php
require dirname(__FILE__) . '/country.php';
$dataResponse = null;

$appliedStatus = array();
foreach ($language["appliedStatus"] as $key => $value) {
    array_push($appliedStatus, array("id"=>$key, "ti"=>$value));
}

$jobLevelOption = array();
foreach ($language["jobLevelOption"] as $key => $value) {
    array_push($jobLevelOption, array("id"=>$key, "ti"=>$value));
}

$jobTimeOption = array();
foreach ($language["jobTimeOption"] as $key => $value) {
    array_push($jobTimeOption, array("id"=>$key, "ti"=>$value));
}

$languageOption = array();
foreach ($language["langOption"] as $key => $value) {
    array_push($languageOption, array("id"=>$key, "ti"=>$value));
}

$currencyOption = array();
foreach ($language["currencyOption"] as $key => $value) {
    array_push($currencyOption, array("id"=>$key, "ti"=>$value));
}

$degreesOption = array();
foreach ($language["degreesOption"] as $key => $value) {
    array_push($degreesOption, array("id"=>$key, "ti"=>$value));
}

$userType = array();
foreach ($language["userTypeOption"] as $key => $value) {
    array_push($userType, array("id"=>$key, "ti"=>$value));
}

$location = array();
foreach ($language["locationOption"] as $key => $value) {
    array_push($location, array("id"=>$key, "ti"=>$value));
}

$monthOption = array();
foreach ($language["monthOption"] as $key => $value) {
    array_push($monthOption, array("id"=>$key, "ti"=>$value));
}

$dayOption = array();
foreach ($language["dayOption"] as $key => $value) {
    array_push($dayOption, array("id"=>$key, "ti"=>$value));
}

$country = array();
foreach ($countryArray as $key => $value) {
    array_push($country, array("id"=>$key, "ti"=>$value));
}

$countryShort = array();
foreach ($countryShortArray as $key => $value) {
    array_push($countryShort, array("id"=>$key, "ti"=>$value));
}
$serviceCategory = array();
foreach ($language["serviceCategory"] as $key => $value) {
    array_push($serviceCategory, array("id"=>$key, "ti"=>$value));
}


$companySizeOption = array();
foreach ($language["companySizeOption"] as $key => $value) {
    array_push($companySizeOption, array("id"=>$key, "ti"=>$value));
}

$salary = array();
foreach ($language["salaryOption"] as $key => $value) {
    array_push($salary, array("id"=>$key, "ti"=>$value));
}

$pageOption = array();
foreach ($language["pageOption"] as $key => $value) {
    array_push($pageOption, array("id"=>$key, "ti"=>$value));
}

$menuStatusOption = array();
foreach ($language["statusOption"]["menu"] as $key => $value) {
    array_push($menuStatusOption, array("id"=>$key, "ti"=>$value));
}

$orderStatusOption = array();
foreach ($language["statusOption"]["order"] as $key => $value) {
    array_push($orderStatusOption, array("id"=>$key, "ti"=>$value));
}

$blogStatusOption = array();
foreach ($language["statusOption"]["blog"] as $key => $value) {
    array_push($blogStatusOption, array("id"=>$key, "ti"=>$value));
}

$jobStatusOption = array();
foreach ($language["statusOption"]["job"] as $key => $value) {
    array_push($jobStatusOption, array("id"=>$key, "ti"=>$value));
}

$cvStatusOption = array();
foreach ($language["statusOption"]["cv"] as $key => $value) {
    array_push($cvStatusOption, array("id"=>$key, "ti"=>$value));
}

$userStatusOption = array();
foreach ($language["statusOption"]["user"] as $key => $value) {
    array_push($userStatusOption, array("id"=>$key, "ti"=>$value));
}

$promoStatusOption = array();
foreach ($language["statusOption"]["promo"] as $key => $value) {
    array_push($promoStatusOption, array("id"=>$key, "ti"=>$value));
}


$statusPageHtml = array();
foreach ($language["statusOption"]["pageHtml"] as $key => $value) {
    array_push($statusPageHtml, array("id"=>$key, "ti"=>$value));
}

$fbStatusOption = array();
foreach ($language["statusOption"]["facebook"] as $key => $value) {
    array_push($fbStatusOption, array("id"=>$key, "ti"=>$value));
}

$categoryShowItemOption = array();
foreach ($language["categoryShowItemOption"] as $key => $value) {
    array_push($categoryShowItemOption, array("id"=>$key, "ti"=>$value));
}

$yearOfExperienceOption = array();
foreach ($language["yearOfExperienceOption"] as $key => $value) {
    array_push($yearOfExperienceOption, array("id"=>$key, "ti"=>$value));
}

$dataResponse["dropdown"] = array(
        "country" => $country,
        "countryShort" => $countryShort,
        "appliedStatus" =>$appliedStatus,
        "service" => $language["service"],
        "paymentMethod" => $language["paymentMethodOption"],
        "serviceCategory"=>$serviceCategory,
        "menuStatus" => $menuStatusOption,
        "orderStatus" => $orderStatusOption,
        "blogStatus" => $blogStatusOption,
        "fbStatus" => $fbStatusOption,
        "categoryShowItemOption" => $categoryShowItemOption,
        "degrees" => $degreesOption,
        "jobLevel" => $jobLevelOption,
        "jobTime" => $jobTimeOption,
        "pageHtml" => $statusPageHtml,
        "monthTime" => $monthOption,
        "dayTime" => $dayOption,
        "currency" => $currencyOption,
        "languageOption" => $languageOption,
        "yearOfExperience" => $yearOfExperienceOption,
        "jobStatus" => $jobStatusOption,
        "cvStatus" => $cvStatusOption,
        "promoStatus" => $promoStatusOption,
        "userStatus" => $userStatusOption,
        "userType" => $userType,
        "location"=> $location,
        "salary"=>$salary,
        "companySize" => $companySizeOption,
        "pageOption" => $pageOption
    );




#init category into localoption
$strSelect = "id, im, ti_{$langcode} AS ti, url, link, opp, pa, ism, ct, so, nv, st ";
$strQueryCategory = "SELECT {$strSelect} FROM ".TABLE_CATEGORY." WHERE st > 0 ORDER BY so";
$menuTable = $db->objJson($strQueryCategory);

if($menuTable) {
    $menuList = array();
    $menuRoot = array();
    $menuStructure = array();
    if($menuTable) {
        foreach ($menuTable as $key => $value) {
            $menuList[intval($value["id"])] = strval($value["ti"]);
            if(isset($value["pa"]) && intval($value["pa"] == 0 )) {
                array_push($menuRoot, $value );
                $sub = arrSearch($menuTable, "pa=={$value["id"]}");
                $subMenu1 = array();
                if($sub) {
                    foreach ($sub as $k => $v) {
                        $sub1 = arrSearch($menuTable, "pa=={$v["id"]}");
                        if($sub1) {
                            $subMenu2 = array();
                            foreach ($sub1 as $m=>$n ) {
                                array_push($subMenu2, $n );
                            }
                            $v["sub"] = $subMenu2;
                        }
                        array_push($subMenu1, $v );
                    }
                    $value["sub"]= $subMenu1;
                }
                array_push($menuStructure, $value );
            }
        }
    }
    $dataResponse["dropdown"]["menuList"] = $menuList;
    $dataResponse["dropdown"]["menuRoot"] = $menuRoot;
    $dataResponse["dropdown"]["menuStructure"] = $menuStructure;
}

if($sessionUserId) {
    #get your page/company
    $strSelect = " , (SELECT COUNT(j.id) FROM ".TABLE_JOB." AS j WHERE j.ci={$sessionUserId} ) AS total_job , ";

    $strSelect .= " (SELECT COUNT(jd.id) FROM ".TABLE_JOB_APPLIED." AS jd WHERE jd.ei={$sessionUserId} ) AS total_applied ";


    $strQueryCompany = "SELECT c.* $strSelect
            FROM ".TABLE_COMPANY." AS c
            WHERE c.ui={$sessionUserId}";

    $yourCompany = $db->objJson($strQueryCompany);
    $dataResponse["dropdown"]["yourCompany"] = $yourCompany;
}

if(isset($_SESSION["adminlog"]["permission"]) ) {
    $strSelect = "u.id AS i, u.email AS e, u.username AS u, u.im AS im,
            u.name AS n, u.gender AS g, u.dob AS d, u.address AS ad, u.city AS ci, u.type AS t,
            u.status AS s, FROM_UNIXTIME(u.created, '%d-%m-%Y') AS c, um.permission AS pe, um.id AS umi ";
    $strQuery = "SELECT {$strSelect} FROM ".TABLE_USER." AS u, ".TABLE_USER_MANAGER." AS um WHERE u.id = um.user_id";
    $dataResponse["dropdown"]["userManager"] = $db->objJson($strQuery);
}

?>
