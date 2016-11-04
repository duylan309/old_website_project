<div class="j-detail j-u-detail <?=$isJobOfUser ? 'm-t-15' : ''?>">
    <div class="row cmp">
        <?php

        if(isset($_GET["statistics"]) && $_GET["statistics"]==1):
            $getUrl = APIGETUSERACTION."?uid={$sessionUserId}&jid={$jid}&action=userapply";
            $paramUrl = "&var=window.viewAppliedCv";
            $hidden_applied = "hidden";

        endif;?>

        <div class="col-sm-3 <?=$hidden_left?>">
              <?php require_once dirname(__FILE__) . "/employer_view/job_view_left.php";?>
        </div>


        <div class="col-xs-12 col-sm-9">

              <?php require_once dirname(__FILE__) . "/employer_view/job_view_menu_breadcrumb.php";?>
              <?php require_once dirname(__FILE__) . "/employer_view/job_view_header.php";?>
              <?php require_once dirname(__FILE__) . "/employer_view/job_view_title_section.php";?>
             
              <?php require_once dirname(__FILE__) . "/candidate_view/job_view_header.php";?>
              <?php require_once dirname(__FILE__) . "/candidate_view/job_view_title_section.php";?>

              <?php require_once dirname(__FILE__) . "/employer_candidate_view/job_view_content_detail.php";?>
        
        </div>

        <div class="col-xs-12 col-sm-3 <?=$hidden_right?>">
            <?php require_once dirname(__FILE__) . "/candidate_view/job_view_right.php";?>
        </div>
    </div>

</div>