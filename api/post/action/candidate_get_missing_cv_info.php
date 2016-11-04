<?php 
$infoUser           = isset($information["userinfo"]["db"]) ? $information["userinfo"]["db"] : null;
$missingData        = 0;
$missingDataContent = '';

if($infoUser):

foreach ($infoUser as $key => $value) {
    if(!$value || count($value) == 0 || $value == "0000-00-00"){
        if($key != "username" && $key != "is_newletter" && $key != "jobleft" && $key != "is_received_email" && $key != "page" && $key != "category" && $key != "category" && $key != "city" && $key != "skype" && $key != "facebook" && $key != "deactive" && $key != "dayleft"){
            
            $keyset = $key;
            switch ($key) {
                case 'im':
                    $key = $language["profilePicture"];
                    break;
                case 'dob':    
                    $key = $language["bod"];
                break;

                case 'gender':    
                    $key = $language["gender"];
                break;

                case 'phone':    
                    $key = $language["phone"];
                break;

                case 'address':    
                    $key = $language["address"];
                break;

                case 'keyword':    
                    $key = $language["keyword"];
                break;

                case 'experience':    
                    $key = $language["experience"];
                break;

                case 'skill':    
                    $key = $language["fillJobSkill"];
                break;

                default:
                    $key = $key;
                    break;
            }
            $missingDataContent[$keyset] = $key;
            $missingData ++;
        }
    }
}

endif;
$cvInfo          = isset($information["user_cv"]) ? $information["user_cv"] : null;
if($cvInfo){

    foreach ($cvInfo["db"] as $key => $value) {
        if(!isset($value) || count($value) == 0){
            if($key != "username" && $key != "is_newletter" && $key != "keyword"  && $key != "jobleft" && $key != "is_received_email" && $key != "page" && $key != "category" && $key != "category" && $key != "city" && $key != "skype" && $key != "facebook" && $key != "deactive" && $key != "dayleft"){
                $keyset = $key;

                switch ($key) {
                    case 'im':
                        $key = $language["profilePicture"];
                        break;

                    case 'dob':    
                        $key = $language["bod"];
                    break;

                    case 'address':    
                        $key = $language["address"];
                    break;

                    case 'experience':    
                        $key = $language["experience"];
                    break;

                    case 'about':    
                        $key = $language["aboutme"];
                    break;

                    case 'skill':    
                        $key = $language["fillJobSkill"];
                    break;

                    default:
                        $key = $key;
                        break;
                }

                $missingDataContent[$keyset] = $key;
                $missingData ++;
            }
        }
    }

}

if($missingData > 0){
    $_SESSION["userlog"]["missingData"] = $missingDataContent;
}