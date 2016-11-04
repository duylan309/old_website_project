<?php
$fileUser = FOLDERUSER."{$sessionUserId}.xml";

if(is_file($fileUser)) {
    $cvInfoPage = simplexml_load_file($fileUser);
    $cvInfoPage = json_encode($cvInfoPage);
    $cvInfoPage = json_decode($cvInfoPage, true);
}
$cvInfo = isset($cvInfoPage["user_cv"]) ? $cvInfoPage["user_cv"] : null;

$infoUser   = $cvInfoPage["userinfo"]["db"];
$seekerId   = $infoUser["id"];
$isCvOfUser = $seekerId == $sessionUserId ? true : false;

$missingData = 0;
$missingDataContent;

if($isCvOfUser):

foreach ($infoUser as $key => $value) {
    if(!$value || count($value) == 0 || $value == "0000-00-00"){
        if($key != "username" && $key != "facebook" && $key != "dayleft" && $key != "skype" && $key != "is_newletter" && $key != "category" && $key != "category" && $key != "city"){

            $keyset = $key;
            switch ($key) {
                case 'im':
                    $key = $language["profilePicture"];
                    break;

                case 'dob':
                    $key = $language["bod"];
                break;

                default:
                    $key = $key;
                    break;
            }
            $missingDataContent[$keyset] = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].'<span class="text-capitalize">'.$key.'</span></a>';
            $missingData ++;
        }
    }
}

if($cvInfo){

    foreach ($cvInfo["db"] as $key => $value) {
        if(!isset($value) || count($value) == 0){
            if($key != "username" && $key != "facebook" && $key != "skype"){
                $keyset = $key;
                $missingDataContent[$keyset] = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].'<span class="text-capitalize">'.$key.'</span></a>';
                $missingData ++;
            }
        }
    }

}

if(!isset($cvInfo["db"]['category'])){
    $missingData ++;
    $missingDataContent["category"]    = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['jobFillIndustriesInterestIn'].'</span></a>';
}
if(!isset($cvInfo["db"]['title'])){
    $missingData ++;
    $missingDataContent["title"]       = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobTitle'].'</span></a>';
}

if(!isset($cvInfo["db"]['level'])){
    $missingData ++;
   $missingDataContent["level"]       = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobLevel'].'</span></a>';
}

if(!isset($cvInfo["db"]['experience'])){
    $missingData ++;
   $missingDataContent["experience"]  = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobExperience'].'</span></a>';
}

if(!isset($cvInfo["db"]['location'])){
    $missingData ++;
    $missingDataContent["location"]    = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJoblocation'].'</span></a>';
}

if(!isset($cvInfo["db"]['skill'])){
    $missingData ++;
    $missingDataContent["skill"]       = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobSkill'].'</span></a>';
}


if($missingData > 0):

echo '<div class="missing-data cmp-more">
      <div class="sms-content">
      <div class="header-error"><label class="text-color3">'.$language["youAreMissingData"].'</label></div>
      <ul>';

foreach ($missingDataContent as $key => $value) {
    echo '<li>'.$value.'</li>';
}

echo '</ul></div></div>';
endif;

if(!isset($cvInfoEducation)){
    $missingDataContent["education"]   = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' '.$language['fillJobEducationHistory'].'</a>';
}

if(!isset($cvInfoWork)){
    $missingDataContent["workhistory"] = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' '.$language['fillJobWorkHistory'].'</a>';
}
endif;
$linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($infoUser["name"]))) );


require dirname(__FILE__) . "/../../views/candidate/user_profile_update.php";


?>
