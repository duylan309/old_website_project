<div class="col-sm-6">
    <div class="message-compose">
        <form data-submit-message method="post" class="form-horizontal post-form">
            <div class="hidden">
                <input data-user-id name="db.user_id" type="text" value="<?=isset($userinfo["db"]["id"]) ? intval($userinfo["db"]["id"]) : "" ?>">
                <input data-sender-id name="db.sender_id" type="text" value="<?=isset($sessionUserId) ? intval($sessionUserId) : "" ?>">
                <input data-receiver-id name="db.receiver_id" type="text" value="<?=isset($userinfo["db"]["id"]) ? intval($userinfo["db"]["id"]) : "" ?>">
                <input name="db.employer_id" type="text" value="<?=$sessionUserId?>">
                <input name="updateNode" type="text" value="db">
                <input name="action" type="text" value="send">
            </div>

            <div class="block transition">
                <div class="block-title bg-color5 text-uppercase text-bold">
                    <span><?=$language['writemessages']?></span>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-sm-11 col-sm-offset-1">
                            <div class="company-list form-group"
                                data-copy-template
                                data-view-template=".company-list" 
                                data-template-id="selectCompanyOption"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <img    class="img-responsive b-r-4"
                                    user-thumbnail
                                    width="50"
                                    height="50"
                                    src="<?=isset($userinfo["db"]["im"]) ? FOLDERIMAGEUSER.$userinfo["db"]["im"] : UDATAIMAGE."style/user-profile.png" ?>" />
                        </div>
                        <div class="col-sm-11">
                            <div class="form-group">
                                <input  data-receiver-message
                                        type="text" 
                                        class="form-control"
                                        value="<?=isset($userinfo["db"]["name"]) ? $userinfo["db"]["name"] : "" ?>"
                                        data-validate
                                        data-required="<?=$language["require"]?>"
                                        data-request-window-loaded
                                        disabled
                                        name="db.receiver"
                                        placeholder="<?=$language['selectreceiver']?>" />
                                <span class="error"><?=$language["require"]?></span>
                            </div>        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-11 col-sm-offset-1">
                            <div class="form-group">
                                <input  class="form-control"
                                        type="text" 
                                        value=""
                                        data-subject
                                        data-validate
                                        data-required="<?=$language["require"]?>"
                                        name="db.subject"
                                        placeholder="<?=$language['subjectmessage']?>" />
                                <span class="error"><?=$language["require"]?></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-11 col-sm-offset-1">
                            <div class="form-group">
                                <textarea   name="db.message"
                                            data-required="<?=$language['require']?>"
                                            data-validate
                                            data-message
                                            placeholder="<?=$language['typeamessage']?>"
                                            data-required="<?=$language["require"]?>"
                                            class="form-control more"></textarea>
                                <span class="error"><?=$language["require"]?></span>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1">
                            <button class="bg-color1 btn m-r-10"
                                    type="submit"
                                    data-submit
                                    class="btn bg-color1 text-uppercase"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTMESSAGES?>"
                                    data-show-success=".message-report"
                                    data-show-errors=".message-report"
                                    value="{{d.l10n.btnSave}}">
                                <i class="fa fa-send"></i> <span><?=$language['send']?></span>
                            </button>

                            <button class="bg-color2 btn hidden">
                                <i class="fa fa-save"></i> <span><?=$language['btnSave']?></span>
                            </button>
                        </div>

                        <div class="col-sm-6 text-right">
                            <button data-reset type="reset" value="Reset" class="bg-color5 btn">
                                <i class="fa fa-trash"></i> <span><?=$language["btnDelete"]?></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>    
        </form>
    </div>
    
    <div class="message-report alert" data-fade="4500">
        <div class="sms-content">
            
        </div>
    </div>

</div>


<div class="col-sm-3">
    <div class="item-view-more message-candidate"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-url="<?=APIGETUSERACTION;?>"
        data-params="uid=<?=$sessionUserId?>&action=userapplicants"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-elm-data='{"selected":"<?=$uid?>"}'
        data-form-filter=".filter-form"
        data-is-reload-page="true"
        data-reload-base-on-id="ui"
        data-reload-base-set-params="listID"
        data-reload-url="<?=APIGETUSERLISTID?>"
        data-template-id="entrySelectUserMessage">
        <div class="block transition">
           
            <div class="block-title bg-color2 text-uppercase text-bold">
                <span><?=$language['allCandidates']?></span>
            </div>
               
            <div class="block-content no-padding">
               
                <div class="filter-list">
                    <form class="post-form filter-form header-filter-h no-padding">
                        <div class="filter filter-list">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input name="na"
                                        data-compare="text in"
                                        data-key="na"
                                        placeholder="<?=$language['searchMessageInboxCandidate']?>"
                                        class="form-control m-b-10">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="view-items" data-content>
                    <div class="style-loadding">...</div>
                </div>
            </div>
        </div>    
    
        <div class="no-data">
            <div class="no-data-content"><?=$language['noDataFound']?></div>
        </div>

        <div data-footer></div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var $url = '<?=APIGETUSERACTION?>';
    var $submit = 0;
    $("[data-receiver-message]").autocomplete({
        source: function( request, response ) {
                  
                    var $data = {
                        "uid": "<?=$sessionUserId?>",
                        "action": "userapplicants",
                        "search": request.term
                    };
                   
                    $.ajax({
                        type: 'GET',
                        url:  '<?=APIGETUSERACTION?>',
                        data: $data,
                        success: function($dataresult) {
                           
                            var $getdata = $dataresult.data;
                            var $listApplicants = [];
                            console.log($getdata);
                            if($getdata != null){
                                Object.keys($getdata).forEach(function(key){
                                $listApplicants.push({ "name":$getdata[key].name,
                                                       "image":$getdata[key].im,
                                                       "id":$getdata[key].ui});
                                });
                                
                                response($listApplicants);
                            }
                        },
                        error: function($dataresult) {
                            console.log($dataresult);
                        }
                    });

                },
        change: function ( event, ui ) { 
            if(ui.item != null){
                $("[data-receiver-message]").val(ui.item.name).closest('.form-group').removeClass('invalid');
                $("[data-receiver-id],[data-user-id]").val(ui.item.id);

                var $image = ui.item.image;
                if($image!='' && $image != null){
                    $image = '<?=FOLDERIMAGEUSER?>'+ui.item.image;
                }else{
                    $image = '<?=UDATAIMAGE?>style/user-profile.png';
                }
                $("[user-thumbnail]").attr("src",$image); 
                $submit = 1;
            }else{
                if($submit == 0){
                    $('[data-receiver-message]').val('').closest('.form-group').addClass('invalid');
                    $('[data-receiver-message]').next('.error').html("<?=$language['cannotfindreceiver']?>");
                    $("[user-thumbnail]").attr("src",'<?=UDATAIMAGE?>style/user-profile.png'); 
                    $("[data-receiver-id],[data-user-id]").val('');
                }
                $submit = 0;
            }
            return false;
        },    
        select: function( event, ui ) {
            if(ui.item != null){
                $("[data-receiver-message]").val(ui.item.name).closest('.form-group').removeClass('invalid');
                $("[data-receiver-id],[data-user-id]").val(ui.item.id);

                var $image = ui.item.image;
                if($image!='' && $image != null){
                    $image = '<?=FOLDERIMAGEUSER?>'+ui.item.image;
                }else{
                    $image = '<?=UDATAIMAGE?>style/user-profile.png';
                }
                $("[user-thumbnail]").attr("src",$image); 
                $submit = 1;
            }else{
                if($submit == 0){
                    $('[data-receiver-message]').val('').closest('.form-group').addClass('invalid');
                    $('[data-receiver-message]').next('.error').html("<?=$language['cannotfindreceiver']?>");
                    $("[user-thumbnail]").attr("src",'<?=UDATAIMAGE?>style/user-profile.png'); 
                    $("[data-receiver-id],[data-user-id]").val('');
                }
                $submit = 0;
            }
            return false;
        },    
        delay: 200,
        minLength: 0,
        autoFocus: true,
        
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        var $image = item.image;
        if($image!='' && $image != null){
            $image = '<?=FOLDERIMAGEUSER?>'+item.image;
        }else{
            $image = '<?=UDATAIMAGE?>style/user-profile.png';
        }
        return $( "<li>" )
        .append( '<img width="20" height" src="'+$image+'"> ' + item.name + '')
        .appendTo( ul );
    };

    // Choose Candidate
    $(document).on('click','[data-candidate-message]',function() {
        var $name = $(this).attr("data-name");
        var $id   = $(this).attr("data-id");

        $("[data-receiver-message]").val($name);
        $("[data-receiver-id],[data-user-id]").val($id);

        var $image = $(this).attr("data-image");
        if($image!='' && $image != null){
            $image = '<?=FOLDERIMAGEUSER?>'+$image;
        }else{
            $image = '<?=UDATAIMAGE?>style/user-profile.png';
        }
        $("[user-thumbnail]").attr("src",$image);
        $('[data-candidate-message]').removeClass('selected');
        $(this).addClass('selected');
        $submit = 1;

    });

    $('[data-reset],[data-submit]').click(function() {
        var $error = $('[data-submit-message]').find('.form-group.invalid').length;
        if($error == 0){
            $(".message-report.alert").addClass('loading').find('.sms-content').html('<span class="style-loadding"></span> <span><?=$language["sending"]?></span>');
            $( document ).ajaxStop(function() {
                $(".message-report.alert").removeClass('loading');
            })
        }
        $("[data-receiver-message],[data-user-id],[data-receiver-id],[data-subject],[data-message]").val("");
        var $image = '<?=UDATAIMAGE?>style/user-profile.png';
        $("[user-thumbnail]").attr("src",$image);
        $submit = 1;
    });

    

});
</script>