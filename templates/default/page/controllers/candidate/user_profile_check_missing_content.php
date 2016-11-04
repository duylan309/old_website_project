<?php
$missingData = 0;
$missingDataContent = null;

if($isCvOfUser):

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
            $missingDataContent[$keyset] = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].'<span class="text-capitalize">'.$key.'</span></a>';
            $missingData ++;
        }
    }
}

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

                    case 'keyword':    
                        $key = $language["keyword"];
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

                $missingDataContent[$keyset] = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].'<span class="">'.$key.'</span></a>';
                $missingData ++;
            }
        }
    }

}

if(!isset($cvInfo["db"]['category'])){
    $missingData ++;
    $missingDataContent["category"]    = '<a class="need-fill text-capitalize" href="/user"> <span class="text-capitalize">'.$language['jobFillIndustriesInterestIn'].'</span></a>';
}
if(!isset($cvInfo["db"]['title'])){
    $missingData ++;
    $missingDataContent["title"]       = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobTitle'].'</span></a>';
}

if(!isset($cvInfo["db"]['level'])){
    $missingData ++;
   $missingDataContent["level"]       = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobLevel'].'</span></a>';
}

if(!isset($cvInfo["db"]['experience'])){
    $missingData ++;
   $missingDataContent["experience"]  = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobExperience'].'</span></a>';
}

// if(!isset($cvInfo["db"]['location'])){
//     $missingData ++;
//     $missingDataContent["location"]    = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJoblocation'].'</span></a>';
// }  

if(!isset($cvInfo["db"]['skill'])){
    $missingData ++;
    $missingDataContent["skill"]       = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobSkill'].'</span></a>';    
} 

if(!isset($cvInfo["db"]['about'])){
    $missingData ++;
    $missingDataContent["about"]       = '<a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].' <span class="text-capitalize">'.$language['fillJobSkill'].'</span></a>';    
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

// if(!isset($infoUser['facebook'])){
//     $missingDataContent["facebook"]    = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' facebook</a>';
// }

if(!isset($cvInfoEducation)){
    $missingDataContent["education"]   = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' '.$language['fillJobEducationHistory'].'</a>';
}  

if(!isset($cvInfoWork)){
    $missingDataContent["workhistory"] = '<a class="need-fill" href="/user">'.$language["pleaseFillYour"].' '.$language['fillJobWorkHistory'].'</a>';
}
endif;