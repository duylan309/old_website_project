<script type="text/x-handlebars-template" id="entryUserViewDayLeft">
    <a href="/<?=$seo_name["page"]["user"]?>?manage=promoapplied" class="text-bold"> <i class="fa fa-calendar-o"></i>
        <span>
        {{#if u.userinfo.db.dayleftshow}}
            {{u.userinfo.db.dayleftshow}} days left
        {{else}}
            {{d.l10n.AccountOutOfDate}}
        {{/if}}
        </span>
    </a>
</script>
<script type="text/x-handlebars-template" id="entryUserDeactive">
<div class="u-signup in">
    <div class="modal-signup">
        <div class="modal-content">
            <div class="modal-body p-30 modal-signin">
                <div class="form-group" style="margin-bottom:10px">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="title">
                                <h3 class="no-margin t-s-18 text-color3"> {{d.l10n.deactiveHeader}}</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 t-s-12">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            {{d.l10n.deactiveContentNote}}<br>
                            {{d.l10n.deactiveContentNoteLine2}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="btn bg-color2" href="/<?=$seo_name['page']['user']?>?manage=info">{{d.l10n.btnActive}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group m-t-15">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center">
                    <a href="/<?=$seo_name['page']['employer'] ?>" class="text-color3 no-margin text-uppercase t-s-12 text-bold text-underline"> {{d.l10n.help}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
</script>

<script type="text/x-handlebars-template" id="entryUserNotifyUpgradeAccount">
    <div class="row expired-container">
        <div class="col-xs-12 col-sm-1"><i class="fa fa-warning text-color3"></i></div>
        <div class="col-xs-12 col-sm-6">
        <h1 class="text-bold">{{d.l10n.accountExpired}}</h1>
        <p>{{{d.l10n.accountExpiredContent}}}</p>
        </div>
    </div>
</script>

<script type="text/x-handlebars-template" id="entryUserUpdateRow">
    <form class="form-horizontal post-form edit-disabled">
        <div class="hidden">
            <input type="text"
                    class="form-control"
                    name="updateNode"
                    value="db">
            <input type="text"
                    class="form-control"
                    name="db.id"
                    value="{{u.userinfo.db.id}}">
        </div>
        <div class="form-group">
            <div class="col-sm-3 col-xs-4 form-control-setting">
               {{e.label}}
            </div>
            <div class="col-sm-6 col-xs-5">
                <div class="form-control-static" data-key="{{e.key}}">
                    {{e.value}} 

                    {{#xif " this.u.userinfo.db.type==1 "}}
                    {{#if e.is_received_email}}
                        <br>
                        {{#xif ' this.e.is_received_email == 1 '}}
                        <i class="fa fa-check text-color1"></i> 
                        <span class="text-color4">{{d.l10n.allowReceiveEmailFromApplicant}}</span>
                        {{else}}
                        <span class="text-color4">{{d.l10n.doNotallowReceiveEmailFromApplicant}}</span>
                        {{/xif}}
                    {{/if}}
                    {{/xif}}
                
                </div>

                <div class="edit-show">
                    <input type="text"
                        name="{{e.key}}"
                        class="form-control m-b-5"
                        {{#if e.validate}}
                            data-validate
                            {{#if e.require}}
                                data-required="{{e.require}}"
                            {{/if}}

                            {{#if e.pattern}}
                                
                                {{#if e.pattern.min }}
                                    data-min-length="{{e.pattern.min}}"
                                {{/if}}
                                
                                {{#if e.pattern.max }}
                                    data-min-length="{{e.pattern.max}}"
                                {{/if}}
                               
                                {{#if e.pattern.str}}
                                    data-pattern="{{e.pattern.str}}"
                                {{else}}

                                     {{#if e.pattern}}
                                        data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                                    {{/if}}
                                   
                                    {{#if e.pattern.noSpecialCharacter}}
                                        data-pattern="^((?![/,\,<,>]).)*$"
                                    {{/if}}

                                {{/if}}
                               
                                data-pattern-message="{{e.patternMessage}}"
                            {{/if}}
                           
                            {{#if e.server}}
                                data-server="{{e.server.url}}"
                                data-params='{"{{e.server.params.key}}":"{{e.server.params.value}}"}'
                                data-key = "{{e.server.keyname}}"
                            {{/if}}
                        
                        {{/if}}

                        value="{{e.value}}">
                     
                    {{#xif " this.u.userinfo.db.type==1 "}} 
                    {{#if e.validate}}
                        {{#if e.pattern}}
                            {{#if e.pattern}}
                                    <label class="checkbox">
                                        <input type="checkbox" 
                                                value="1" 
                                                name="db.is_received_email"
                                                {{#if e.is_received_email}}
                                                {{#xif ' this.e.is_received_email == 1 '}}
                                                checked="checked"
                                                {{/xif}}
                                                {{/if}}>
                                        <span class="checkbox-style"></span>
                                        <span>{{d.l10n.allowReceiveEmailFromApplicant}}</span>
                                </label>
                            {{/if}}
                        {{/if}}
                    {{/if}}
                    {{/xif}}

                    <div class="m-t-15">
                        <button type="submit"
                            class="btn bg-color1 text-uppercase"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTUSEREDIT?>"
                            data-show-success="{{e.showSuccess}}"
                            data-show-errors=".alert-footer.alert-error"
                            {{#if e.triggerClick}}
                            data-trigger-click="{{e.triggerClick}}"
                            {{/if}}
                            {{#if e.updateStaticInfo}}
                            data-update-static-info="{{e.updateStaticInfo}}"
                            {{/if}}
                            {{#if e.urlRedirect}}
                            data-redirect="{{e.urlRedirect}}"
                            {{/if}}
                            value="{{d.l10n.btnUpdate}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
                        <span class="btn bg-color5 text-uppercase"
                            data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"><i class="fa fa-times"></i> <span>{{d.l10n.btnClose}}</span></span>
                    </div>
                    <div class="alert" data-fade="4500"><div class="sms-content"></div></div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-3">
                <div class="form-control-static text-right">
                    <span class="text-color4 b-edit"
                        data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"><i class="fa fa-pencil"></i> {{d.l10n.btnEdit}}</span>
                </div>
            </div>
        </div>
    </form>
</script>
<script id="entryUserJobFunction" type="text/x-handlebars-template">
    {{#if u.userinfo}}
        {{#xif ' this.u.userinfo.db.type == 2 '}}
        <div class="j-user-function">
            <div class="btn-applied-save text-uppercase">
                {{#if u.user_cv}}
                <div class="btn-block btn-apply show-unsave show-unsave-apply-{{e.id}} {{#xSubString e.id u.appliedjob.strjo ','}}active{{/xSubString}}">
                    <span class="btn btn-block bg-color3 text-uppercase  btn-unsave disabled">
                        <i class="fa fa-check-circle-o"></i> {{d.l10n.btnApplied}}
                    </span>

                    <span class="btn btn-apply btn-block bg-color3 text-uppercase btn-save"
                        data-elm-data='{
                            "toggle":".show-unsave-apply-{{e.id}},active",
                            "db":{
                                "jo":"{{e.id}}",
                                "ui":"{{u.userinfo.db.id}}",
                                "co":"{{u.userinfo.db.id}}_{{e.id}}",
                                "ei":"{{e.ei}}",
                                "company_id":"{{e.pid}}"
                            }
                        }'
                        data-button-magic
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="entryUserApplyPopup"><i class="fa fa-file-text-o"></i>  {{d.l10n.btnApply}}</span>
                </div>
                {{else}}
                <span class="btn btn-apply-without-cv btn-block bg-color3 text-uppercase btn-save"
                        data-elm-data='{
                            "cvPopup":"true",
                            "hiddenMenuLeft":"1"
                        }'
                        data-button-magic
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="entryUserUpdateCV"><i class="fa fa-file-text-o"></i>  {{d.l10n.btnApply}}</span>
                {{/if}}

                <div class="btn-block btn-favorite show-unsave show-unsave-{{e.id}} {{#xSubString e.id u.savedjob.strjo ','}}active{{/xSubString}}">
                    <span class="btn btn-default btn-block btn-unsave"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSERACTION?>/unsavejob"
                        data-success-toggle-class=".show-unsave-{{e.id}},active"
                        data-params='{ "db":{"jo":"{{e.id}}", "ui":"{{u.userinfo.db.id}}","co":"{{u.userinfo.db.id}}_{{e.id}}"} }'
                        data-elm-data='{
                             "missingSession":"true",
                             "hideObj":"[data-quick-view-item1]"
                        }'
                        data-show-success=".alert-footer.alert"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-errors-template="entrySigninPopup"
                        data-view-template="[data-quick-view-item1]"
                        data-redirects="."><i class="fa fa-heart-o"></i> <span>{{d.l10n.btnUnLike}}</span></span>

                    <span class="btn btn-block bg-color2 btn-save text-uppercase"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSERACTION?>/savejob"
                        data-params='{ "db":{"jo":"{{e.id}}", "ui":"{{u.userinfo.db.id}}","co":"{{u.userinfo.db.id}}_{{e.id}}"} }'
                        data-success-toggle-class=".show-unsave-{{e.id}},active"

                        data-elm-data='{
                             "missingSession":"true",
                             "hideObj":"[data-quick-view-item1]"
                        }'
                        data-show-success=".alert-footer.alert"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-errors-template="entrySigninPopup"
                        data-view-template="[data-quick-view-item1]"

                        data-show-hide=""
                        data-redirects="."><i class="fa fa-heart"></i> {{d.l10n.btnLike}}</span>
                </div>
                <span class="btn btn-share btn-block bg-color1 text-uppercase"
                    data-button-magic
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-elm-data='{"actual_link":"{{e.actual_link}}"}'
                    data-template-id="entryItemShareLink"><span class="icon-share2"></span> {{d.l10n.btnShareThisJob}}</span>
            </div>
        </div>
        {{else}}
            {{#xif ' this.e.ei == this.u.userinfo.db.id'}}
               
                <div class="j-user-function text-right">
                    <a href="/<?=$seo_name["page"]["user"];?>?manage=postjob&jid={{e.id}}&pid={{e.pid}}"
                        class="btn bg-color4"
                        data-button-magics
                        data-method="get"
                        data-ajax-url="<?=APIGETJOB?>/{{e.id}}"
                        data-elm-data='{"urlRedirect":"."}'
                        data-view-template="[data-quick-view-item]"
                        data-template-id="jobsAdd"><span class="fa fa-pencil"></span></a>
                    <a href="{{e.job_link}}" class="btn bg-color4"><i class="fa fa-eye"></i></a> 

                    <a class="btn bg-color1"
                    data-button-magic
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-elm-data='{"actual_link":"{{e.actual_link}}"}'
                    data-template-id="entryItemShareLink"><span class="icon-share2"></span></a>   
                </div>

            {{/xif}}
        {{/xif}}
    {{else}}

        <div class="j-user-function">

            <a  data-button-magic
                data-elm-data='{"urlRedirect":"."}'
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entrySigninPopup"
                class="btn btn-block btn-apply bg-color3 btn-save text-uppercase hidden"><i class="fa fa-file-text-o"></i> {{d.l10n.btnApplyNow}}</a>
            
            <a  data-button-magic
                data-elm-data='{
                        "toggle":".show-unsave-apply-{{e.id}},active",
                        "urlRedirect":".",
                        "job":{
                            "jo":"{{e.id}}",
                            "ei":"{{e.ei}}",
                            "company_id":"{{e.pid}}"
                        }
                    }'
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryUserApplyPopupWithoutLogin"
                class="btn btn-block btn-apply-without-signin bg-color3 btn-save text-uppercase">
                    <i class="fa fa-file-text-o"></i> {{d.l10n.btnApplyNow}}
            </a>

            <span class="btn btn-block btn-share bg-color1 text-uppercase"
                data-button-magic
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-elm-data='{"actual_link":"{{e.actual_link}}"}'
                data-template-id="entryItemShareLink"><span class="icon-share2"></span> {{d.l10n.btnShareThisJob}}</span>
            </div>
    {{/if}}
</script>
<script id="entryUserApplyPopup" type="text/x-handlebars-template">
  <div class="modal-dialog modal-signup applyjob">
        <div class="modal-content">
            <div class="modal-body p-30 modal-signin">
                <span class="position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"><i class="fa fa-times-circle"></i></span>
                <div class="title">
                    <p class="m-b-20 text-center text-color1 text-bold t-s-18">{{d.l10n.formApplyHeaderTitle}}</p>
                </div>
                <form class="post-form">
                    <div class="error login-failed"><div class="sms-content"></div></div>
                    <div class="hidden">
                        <input name="db.jo" value="{{e.db.jo}}">
                        <input name="db.ui" value="{{e.db.ui}}">
                        <input name="db.co" value="{{e.db.co}}">
                        <input name="db.ei" value="{{e.db.ei}}">
                        <input name="db.company_id" value="{{e.db.company_id}}">
                    </div>
                    
                    <div class="form-group">
                        <label>
                            {{d.l10n.questionOne}}
                        </label>
                         <textarea type="text"
                               name="db.ti"
                               class="form-control more"
                               data-validate
                               data-required="{{d.l10n.require}}"> </textarea>
                        <span class="error"></span>
                    </div>
                    <div class="form-group hidden">
                        <label>
                            {{d.l10n.questionTwo}}
                        </label>
                        <textarea type="text"
                               name="db.de"
                               class="form-control more"
                               data-required="{{d.l10n.require}}"> </textarea>
                        <span class="error"></span>
                    </div>
                    <div class="form-group m-t-10">
                        <div class="row">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit"
                                        data-button-magic
                                        data-params-form=".post-form"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSERACTION?>/applyjob"
                                        {{#if e.toggle}}
                                        data-success-toggle-class="{{e.toggle}}"
                                        {{/if}}

                                        data-elm-data='{
                                             "missingSession":"true",
                                             "hideObj":"[data-quick-view-item1]"
                                        }'
                                        data-show-hide=",[data-modal-quick-view]"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"

                                        data-show-errors-template="entrySigninPopup"
                                        data-view-template="[data-quick-view-item1]"
                                        class="btn btn-block bg-color3 text-uppercase"
                                        value="apply"><i class="fa fa-check-circle"></i> <span>{{d.l10n.btnFinish}}</span></button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</script>

<script id="entryUserCvFunction" type="text/x-handlebars-template">
{{#if u.userinfo}}
    {{#xif ' this.u.userinfo.db.type == 1 '}}
    <div class="j-user-function action-favorite">
        {{#if e.employer_status}}
        <div class="user-action">
            <span class="show-unsave employer-action-status m-t-10 show-unsave-{{e.ui}} employer-action{{e.employer_status}}">
                
                <span class="btn btn-xs bg-color7 btn-unsave hidden"
                     data-button-magic
                     data-method="post"
                     data-format-json="true"
                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                     data-success-toggle-class=".show-unsave-{{e.ui}},employer-action1"
                     data-params='{ "employmentAction":"unsaveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{e.ui}}","co":"{{u.userinfo.db.id}}_{{e.ui}}"} }'
                     data-redirects="."><span class="">{{d.l10n.btnUnLike}}</span></span>
                
                <span class="btn btn-xs btn-employer-action bg-color7 btn-save"
                     data-button-magic
                     data-method="post"
                     data-format-json="true"
                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                     data-params='{ "employmentAction":"saveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{e.ui}}","co":"{{u.userinfo.db.id}}_{{e.ui}}"} }'
                     data-success-toggle-class=".show-unsave-{{e.ui}},employer-action1"
                     data-show-errors=".modal.signin-missing-session"
                     data-show-hide=""
                     data-redirects="."><span class="">{{d.l10n.btnLike}}</span></span>

                <span class="btn btn-xs btn-employer-action bg-color7 btn-interview"
                     data-button-magic
                     data-method="post"
                     data-format-json="true"
                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                     data-params='{ "employmentAction":"interview", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{e.ui}}","co":"{{u.userinfo.db.id}}_{{e.ui}}"} }'
                     data-success-toggle-class=".show-unsave-{{e.ui}},employer-action3"
                     data-show-errors=".modal.signin-missing-session"
                     data-show-hide=""
                     data-redirects="."><span class="">{{d.l10n.btnInterview}}</span></span>

                <span class="btn btn-xs btn-employer-action bg-color7 btn-hire"
                     data-button-magic
                     data-method="post"
                     data-format-json="true"
                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                     data-params='{ "employmentAction":"hire", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{e.ui}}","co":"{{u.userinfo.db.id}}_{{e.ui}}"} }'
                     data-success-toggle-class=".show-unsave-{{e.ui}},employer-action4"
                     data-show-errors=".modal.signin-missing-session"
                     data-show-hide=""
                     data-redirects="."><span class="">{{d.l10n.btnHire}}</span></span> 

                <span class="btn btn-xs btn-employer-action bg-color7 btn-deny"
                     data-button-magic
                     data-method="post"
                     data-format-json="true"
                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                     data-params='{ "employmentAction":"deny", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{e.ui}}","co":"{{u.userinfo.db.id}}_{{e.ui}}"} }'
                     data-success-toggle-class=".show-unsave-{{e.ui}},employer-action5"
                     data-show-errors=".modal.signin-missing-session"
                     data-show-hide=""
                     data-redirects="."><span class="">{{d.l10n.btnDeny}}</span></span>               
            
            </span>

        </div>
        {{/if}}

    </div>
    {{else}}
      
        {{#xif ' this.e.fo==this.u.userinfo.db.id '}}

            <div class="j-user-function">
                <a class="btn btn-default btn-block"
                    href="/<?=$seo_name["page"]["user"];?>"><span class="fa fa-pencil"></span> <span>{{d.l10n.btnEditProfile}}</span></a>
            </div>

        {{/xif}}

    {{/xif}}

{{/if}}

</script>
<script id="entryItemShareLink" type="text/x-handlebars-template">
    <div class="modal-dialog modal-signup sharing-social">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title text-center">
                    <h3 class="text-color3 text-bold no-m-bottom t-s-21">{{d.l10n.btnShareThisJob}}</h3>
                    <p class="">{{d.l10n.shareJobContent}}</p>
                </div>
                <span class="fa fa-times-circle text-color2 t-s-21 icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body social-share-job share-social-button">
                <a  class="btn fb"
                    data-share-to="https://www.facebook.com/sharer/sharer.php?u="
                    data-share-link="{{e.actual_link}}"
                    data-href="{{e.actual_link}}" 
                    data-center="true"
                    href="#">

                    <i class="fa fa-facebook-square"></i> Facebook <span class="clearfix"></span></a>
                <a class="btn li" 
                    data-share-to="https://www.linkedin.com/shareArticle?mini=true&url="
                    data-share-link="{{e.actual_link}}"
                    data-center="true"
                    href="#"><i class="fa fa-linkedin-square"></i> Linkedin <span class="clearfix"></span></a>
                <a class="btn go" 
                    data-share-to="https://plus.google.com/share?url="
                    data-share-link="{{e.actual_link}}"
                    data-center="true"
                    href="#"><i class="fa fa-google-plus-square"></i> Google + <span class="clearfix"></span></a>
             
                <a class="btn tw" 
                    data-share-to="https://twitter.com/intent/tweet?source="
                    data-share-link="{{e.actual_link}}"
                    data-center="true"
                    href="#"><i class="fa fa-twitter-square"></i> Twitter <span class="clearfix"></span></a>
                <a class="btn en"
                    data-center="true"
                    href="mailto:?subject={{d.l10n.headerEmailSocial}}&body={{e.actual_link}}"><i class="fa fa-envelope-square"></i> Email <span class="clearfix"></span></a>


            </div>

        </div>
    </div>
</script>

<script id="entryUserSearch" type="text/x-handlebars-template">
    <form class="form-inline"
        {{#if e.searchSeeker}}
        action="/<?=$seo_name["page"]["searchcv"]?>"
        {{else}}
        action="/<?=$seo_name["page"]["search"]?>"
        {{/if}}
        >

        <div class="form-group">
            <input type="hidden" value="1" name="distinct">

            <input class="form-control" id="searchbar" data-list="Ada, Java, JavaScript, Brainfuck, LOLCODE, Node.js, Ruby on Rails"
            name="title" value="{{e.title}}"

            {{#if e.linkSearch}}

                {{#xif " this.e.linkSearch == 1 "}}
                   placeholder="{{d.l10n.placeholderSearchCv}}" >
                {{else}}
                   placeholder="{{d.l10n.placeholderSearchJob}}" >
                {{/xif}}
            {{else}}
                placeholder="{{#if e.searchSeeker}}{{d.l10n.placeholderSearchCv}}{{else}}{{d.l10n.placeholderSearchJob}}{{/if}}" >
            {{/if}}

            <span class="select-wrapper">

            <select name="loc"
                    class="form-control"
                    type="select"
                    data-validate
                    data-required="{{d.l10n.optCity}}"
                    data-object-init='{"id":"", "ti":"{{d.l10n.locationSearch}}"}'
                    data-dropdown
                    data-index-value="{{e.loc}}"
                    data-option-local-json="location"
                    data-option-from-json="<?=APIGETLOCATION;?>">
                    <option value=""><i class="fa fa-user"></i> {{d.l10n.optCity}}</option>
            </select>
            </span>
        </div>
        <div class="form-group">
            <button class="btn bg-color3 text-uppercase"><span class="icon-search icon-search1"> </span> <span class="hidden-xs hidden-sm"></span></button>
        </div>

        {{#if e.linkSearch}}

            {{#xif " this.e.linkSearch == 1 "}}
                <a class="btn bg-color5 m-l-5 form-add btn-add-a-item text-uppercase text-bold hidden" href="/<?=$seo_name["page"]["search"]?>?distinct=1">{{d.l10n.findJob}}</a>
            {{else}}
                <a class="btn bg-color5 m-l-5 form-add btn-add-a-item text-uppercase text-bold hidden" href="/<?=$seo_name["page"]["searchcv"]?>">{{d.l10n.findCv}}</a>
            {{/xif}}


         {{/if}}
    </form>

</script>
<script id="entryUserSearchAdvance" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-3">
        <div class="user-menu-action user-menu-header-h"
             data-elm-data='{"{{e.headId}}" : "1",
                             "totalapp"          : "{{ e.totalapp }}",
                             "totalsaved"        : "{{ e.totalsaved }}" }'

             data-copy-template
             data-view-template=".user-menu-action"
             data-template-id="entryUserMenuAction"></div>

    </div>
    <div class="col-sm-9">
    <div class="filter-hori"
      data-copy-template
      data-view-template=".filter-hori"
      data-template-id="entryCmpFilterHorizontal">&nbsp;</div>
    </div>
</div>
</script>

<script id="entryUserHeader" type="text/x-handlebars-template">
    {{#if u.userinfo}}
        <div class="welcome">
        {{#if u.userinfo.db.name}}
            {{#xif " this.u.userinfo.db.type==1 "}}

                <a href="<?="/{$seo_name["page"]["user"]}?manage=postjob";?>"
                    class="btn bg-color3 form-add btn-add-a-item text-uppercase text-bold hidden-xs"
                    data-button-magics
                    data-elm-data='{"urlRedirect":"/{{u.userinfo.db.username}}"}'
                    data-view-template-local="true"
                    data-elm-data='{
                         "missingSession":"true",
                         "hideObj":"[data-quick-view-item1]"
                    }'
                    data-show-success=".alert-footer.alert"
                    data-show-errors=".alert-footer.alert-error"
                    data-show-errors-template="entrySigninPopup"
                    data-view-template="[data-quick-view-item1]"
                    data-template-id="jobsAdd"><span class="icon-file-text2"></span> <span>{{d.l10n.btnPostJob}}</span></a>

                <a {{#if u.userinfo.db.username }}
                   href="<?="/{$seo_name["page"]["user"]}?manage=postjob";?>"
                   {{else}}
                   href="/<?=$seo_name["page"]["cmp"]?>/{{urlFriendly u.userinfo.db.name u.userinfo.db.id}}"
                   {{/if}}
               >

                   {{#if u.userinfo.db.im}}
                       <span class="icon-avatar">
                           <img src="/<?=FOLDERIMAGEUSER?>{{u.userinfo.db.im}}">
                       </span>
                   {{else}}
                       <span class="icon-avatar">
                           <i class="fa fa-user"></i>
                       </span>
                   {{/if}}

                <a href="/{{#if u.userinfo.db.username}}{{u.userinfo.db.username}} {{else}}<?=$seo_name["page"]["cmp"]?>/{{{urlFriendly u.userinfo.db.name u.userinfo.db.id}}}{{/if}}" class="{{#if e.pageOfUser}}active{{/if}}">
                    {{d.l10n.mypage}} &nbsp;&nbsp;|
                </a>

                <a href="<?="/{$seo_name["page"]["user"]}?manage=jobs"?>" class="{{#if e.jobs }}active{{/if}}">
                    {{d.l10n.jobs}} <strong class="text-color2">({{u.totalJob}})</strong> &nbsp;&nbsp;|
                </a>

                <a href="<?="/{$seo_name["page"]["user"]}?manage=userapply"?>" class="{{#if e.userapply}}active{{/if}}">
                    {{d.l10n.jobApplications}} &nbsp;&nbsp;|
                </a>

                <a href="<?="/{$seo_name["page"]["user"]}?manage=info"?>">
                    {{d.l10n.setting}} &nbsp;&nbsp;|
                </a>


                <span class="otooltip hidden">


                        <span class="name-u-top short-text hidden">{{u.userinfo.db.name}}</span> <i class="fa fa-caret-down"></i></a>


                    <span class="otooltip-content otooltip-r">
                        <div class="u-menu-dropdown"
                            data-copy-template
                            data-view-template=".u-menu-dropdown"
                            data-template-id="entryUserMenu">
                        </div>
                    </span>
                </span>

                <a href="#"
                    class=" "
                    data-button-magic
                    data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                    data-redirect="/">{{d.l10n.signout}}</a>

            {{else}}
                <span class="otooltip">
                    <a href="/<?=$seo_name["page"]["cv"]?>{{{urlFriendly u.userinfo.db.name u.userinfo.db.id}}}">
                    {{#if u.userinfo.db.im}}
                        <span class="icon-avatar">
                            <img src="/<?=FOLDERIMAGEUSER?>{{u.userinfo.db.im}}">
                        </span>
                    {{else}}
                        <span class="icon-avatar">
                            <i class="fa fa-user"></i>
                        </span>
                    {{/if}}

                    <a href="/{{#if u.userinfo.db.username}}{{u.userinfo.db.username}} {{else}}<?=$seo_name["page"]["cv"]?>/{{{urlFriendly u.userinfo.db.name u.userinfo.db.id}}}}{{/if}}" class="{{#if e.pageOfUser}}active{{/if}}">
                       {{d.l10n.mypage}} &nbsp;&nbsp;|
                    </a>

                    <a href="<?="/{$seo_name["page"]["user"]}?manage=jobsave"?>" class="{{#if e.jobsave}}active{{/if}}">
                       {{d.l10n.jobs}} &nbsp;&nbsp;|
                    </a>

                    <a href="<?="/{$seo_name["page"]["user"]}?manage=info"?>">
                       {{d.l10n.setting}} &nbsp;&nbsp;|
                    </a>

                    <span class="name-u-top hidden">{{u.userinfo.db.name}}</span> <i class="fa fa-caret-down hidden "></i></a>

                    <span class="otooltip-content otooltip-r u-h-dropdown hidden ">
                        <div class="u-menu-dropdown hidden "
                            data-elm-data = '{"top":"1"}'
                            data-copy-template
                            data-view-template=".u-menu-dropdown"
                            data-template-id="entryUserMenu">
                        </div>
                    </span>
                </span>

                <a href="#"
                    class=" "
                    data-button-magic
                    data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                    data-redirect="/">{{d.l10n.signout}}</a>

            {{/xif}}



        {{else}}
            <a href="<?="/{$seo_name["page"]["user"]}";?>">{{d.l10n.pleaseUpdateInfomation}}</a>
        {{/if}}
        </div>
    {{else}}
        <div class="welcome">
            <a href="/emp" class="btn bg-color3 text-bold"><i class="fa fa-file-text-o"></i> {{d.l10n.btnPostJob}}</a>

            <a href="/rg"
                class="btn bg-color6">{{d.l10n.register}}</a>

            <a href="/user?manage=company#group-view=2"
                    class="btn bg-color6"
                    data-button-magic
                    data-elm-data='{"urlRedirect":"."}'
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entrySigninPopup"><i class="fa fa-lock"></i>&nbsp; {{d.l10n.signin}}</a>
            <a href="#"
                    class="btn bg-color6 hidden"
                    data-button-magic
                    data-elm-data='{"urlRedirect":"."}'
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entrySignupWithPromoCode">Promocode</a>
        </div>
    {{/if}}
</script>

<script id="entryPromoApplied" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                data-elm-data='{"promoapplied":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">
            <div class="user-applied-promocode"
                data-copy-template
                data-view-template=".user-applied-promocode"
                data-template-id="entryPromoAppliedForm"></div>
            <div class="item-view-more table-promocode"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETPROMOAPPLIED;?>"
                data-params="uid={{u.userinfo.db.id}}"
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-template-id="entryPromoAppliedItem" >
                <div class="block activation-table">
                    <div class="row cmp-more bg-color1 no-m-bottom">
                        <div class="col-xs-4 col-sm-2"><label>{{d.l10n.date}}</label></div>
                        <div class="col-xs-3 col-sm-3 hidden-xs"><label>{{d.l10n.code}}</label></div>
                        <div class="col-xs-8 col-sm-4"><label>{{d.l10n.servicePackage}}</label></div>
                        <div class="col-xs-2 col-sm-2 hidden-xs text-center"><label>{{d.l10n.status}}</label></div>
                    </div>
                </div>
                <div class="view-items block-content" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
        </div>
    </div>
</script>
<script id="entryPromoAppliedItem" type="text/x-handlebars-template">
<div class="item">
    <div class="row">
        <div class="col-xs-4 col-sm-2">
            <div>{{{formatDate i.cr '%d-%M-%Y'}}}</div>
        </div>
        <div class="col-xs-3 col-sm-3 hidden-xs"><div>{{i.c}}</div></div>
        <div class="col-xs-8 col-sm-4"><div>{{{textFromDropdownLocal i.s 'service' 'id' 'title'}}}</div></div>
        <div class="col-xs-2 col-sm-2 hidden-xs text-center text-bold"><span class="text-color2">{{d.l10n.activated}}</span></div>
    </div>
</div>
</script>
<script id="entryPromoAppliedForm" type="text/x-handlebars-template">

    <div class="row m-b-20">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="block text-center">
                <div class="block-title cmp-more text-uppercase text-bold no-m-bottom hidden">
                     <p class="t-s-18 text-color3">{{d.l10n.enterActivationCode}}</p>
                </div>
                <div class="block-content border b-r-4">
                    <form class="post-form m-b-15">
                        <div class="hidden">
                            <input type="hidden" name="db.ui" value="{{u.userinfo.db.id}}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 control-label">
                                <p class="">{{d.l10n.ActivationCodeContent}}</p>

                            </div>
                            <div class="col-sm-12">
                                <input  type="text" name="db.pr"
                                data-validate
                                placeholder=""
                                data-required="{{d.l10n.promoCodeError}}"
                                class="form-control text-center">
                                <span class="error"></span>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTPROMOAPPLIED?>"
                                data-show-success=".alert-footer.alert"
                                data-show-errors=".alert-footer.alert-error"
                                data-redirects="."
                                class="btn bg-color3 m-t-10 btn-block"
                                value="{{d.l10n.btnSubmit}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSubmit}}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</script>

<script id="entryUserCheckout" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-init-object="userManageCheckout"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-elm-data='{"savejob":"1"}'
        data-method="get"
        data-show-page="10"
        data-show-item="10"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="entryCheckoutItem" >
        <div class="row">
            <div class="col-sm-3">
                <div class="user-menu-action"
                    data-elm-data='{"checkout":"1"}'
                    data-copy-template
                    data-view-template=".user-menu-action"
                    data-template-id="entryUserMenuSetting"></div>
            </div>
            <div class="col-sm-9">

                <div class="listdatas bg-color4 filter-date-setting">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                           <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                                {{d.l10n.paymentsHistory}} (<span data-total-item></span>)
                           </header>
                       </div>
                       <div class="col-xs-12 col-sm-8">
                            <form data-change-to-submit-form
                                action="/user?manage=checkout"
                                method="post"
                                class="post-form form-inline text-right">
                                <div class="form-group">
                                    <label>{{d.l10n.from}}</label>
                                    <input type="text"
                                        name="dayFrom"
                                        {{#if e.dayFrom}}
                                        value="{{e.dayFrom}}"
                                        {{/if}}
                                        data-date-picker
                                        data-format="YYYY-MM-DD"
                                        data-single-date-picker="true"
                                        data-show-dropdowns="true"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{d.l10n.to}}</label>
                                    <input type="text"
                                        name="dayTo"
                                        {{#if e.dayTo}}
                                        value="{{e.dayTo}}"
                                        {{/if}}
                                        data-date-picker
                                        data-format="YYYY-MM-DD"
                                        data-single-date-picker="true"
                                        data-show-dropdowns="true"
                                        class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="b-b"></div>

                    <div class="table-responsive p-10">
                        <table class="table table-bordered">
                            <colgroup>
                                <col class="col-sm-1">
                                <col class="col-sm-3">
                                <col class="col-sm-2">
                                <col class="col-sm-2">
                                <col class="col-sm-2">
                                <col class="col-sm-2">
                            </colgroup>
                            <thead>
                                <tr class="b-b bg-grey-color1">
                                    <th>{{d.l10n.id}}</th>
                                    <th>{{d.l10n.servicePackage}}</th>
                                    <th>{{d.l10n.servicePrice}}</th>
                                    <th>{{d.l10n.date}}</th>
                                    <th>{{d.l10n.paymentMethod}}</th>
                                    <th class="text-right">{{d.l10n.status}}</th>
                                </tr>
                                <tr class="b-b">
                                    <th colspan="6">
                                        <form class="form-filter" data-waiting="500">
                                            <div class="row">
                                                <div class="col-sm-2 col-sm-offset-8">
                                                    <select name="pm"
                                                        data-validate
                                                        data-required="{{d.l10n.require}}"
                                                        data-dropdown
                                                        data-compare="equal"
                                                        data-key="pm"
                                                        data-str-key="id"
                                                        data-str-value="title"
                                                        data-object-init='{"id":"", "title":"Payment Method"}'
                                                        data-option-local-json="paymentMethod"
                                                        data-index-value="{{i.pm}}"
                                                        class="form-control">
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select name="ps"
                                                        data-validate
                                                        data-required="{{d.l10n.require}}"
                                                        data-dropdown
                                                        data-compare="equal"
                                                        data-key="ps"
                                                        data-object-init='{"id":"", "ti":"{{d.l10n.status}}"}'
                                                        data-option-local-json="orderStatus"
                                                        data-index-value="{{i.ps}}"
                                                        class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="view-items" data-content>
                            </tbody>
                        </table>

                    </div>
                    <div class="p-10">
                        <div data-footer></div>
                    </div>
                <div>
            </div>
        </div>
    </div>
</script>

<script id="entryUserInfoSetting" type="text/x-handlebars-template">
   <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                data-elm-data='{"info":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">
            <div class="setting-b cmp-more no-m-top">
                <header class="h-tt text-color1 text-bold t-s-19 b-b p-b-10 text-capitalize">{{d.l10n.accountInformation}}</header>
                {{#if u.usersub.id}}
                <!-- Usersub-->

                <div class="user-update-row-name"
                    data-elm-data='{
                        "key":"db.name",
                        "ajaxUrlPost":"<?=APIPOSTUSERSUB?>",
                        "value":"{{u.usersub.subname}}",
                        "label":"{{d.l10n.fullname}}",
                        "showSuccess":".alert-footer.alert",
                        "updateStaticInfo":".form-control-static",
                        "triggerClick": ".user-update-row-name [data-closet-toggle-class]"
                    }'
                    data-copy-template
                    data-view-template=".user-update-row-name"
                    data-template-id="entryUserUpdateRow">
                </div>

                <form method="post" class="form-horizontal post-form edit-disabled form-group user-update-row-password">
                    <div class="hidden">
                        <input type="text"
                                class="form-control"
                                name="updateNode"
                                value="password">
                        <input type="text"
                                class="form-control"
                                name="db.id"
                                value="{{u.usersub.subid}}">
                    </div>
                    <div class="row">
                        <span class="col-sm-3 col-xs-4 form-control-setting">{{d.l10n.password}}</span>
                        <div class="col-sm-6 col-xs-5">
                            <div class="form-control-static">******</div>
                            <div class="edit-show">
                                <div class="form-group">
                                    <label class="col-sm-4">{{d.l10n.passwordCurrent}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                            name="password.passwordOld"
                                            data-validate data-min-length="6"
                                            data-required="{{d.l10n.require}}"
                                            data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                            class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">{{d.l10n.passwordNew}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                            name="password.passwordNew"
                                            data-validate
                                            data-min-length="6"
                                            data-required="{{d.l10n.require}}"
                                            data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                            data-compare="#accountPasswordConfirm"
                                            data-compare-message="{{d.l10n.matchPassword}}"
                                            id="accountPasswordNew"
                                            class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">{{d.l10n.passwordConfirm}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                            name="password.passwordConfirm"
                                            data-validate
                                            data-required="{{d.l10n.require}}"
                                            data-compare="#accountPasswordNew"
                                            data-compare-message="{{d.l10n.matchPassword}}"
                                            id="accountPasswordConfirm"
                                            class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button type="submit"
                                          class="btn bg-color1"
                                          data-button-magic
                                          data-params-form=".post-form"
                                          data-format-json="true"
                                          data-ajax-url="<?=APIPOSTUSERSUB?>"
                                          data-show-success=".alert-footer.alert"
                                          data-show-errors=".alert-footer.alert-error"
                                          data-trigger-click=".user-update-row-password [data-closet-toggle-class]"
                                          value="{{d.l10n.btnUpdate}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span> </button>
                                        <span class="btn bg-color5"
                                            data-closet-toggle-class="edit-enabled"
                                            data-object=".edit-disabled"><i class="fa fa-times"></i> <span>{{d.l10n.btnClose}}</span> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <div class="form-control-static text-right">
                                <span class="text-color4 b-edit"
                                    data-closet-toggle-class="edit-enabled"
                                    data-object=".edit-disabled"><i class="fa fa-pencil"></i> {{d.l10n.btnEdit}}</span>
                            </div>
                        </div>
                    </div>

                </form>

                {{else}}
                <!-- User Normal-->

                <div class="form-group form-horizontal">
                    <div class="row">
                        <div class="col-sm-3 col-xs-4 form-control-setting">{{d.l10n.avatar}}</div>
                        <div class="col-sm-9 col-xs-8">
                            <div class="update-item-image-setting"
                                data-copy-template
                                data-elm-data='{"urlPost":"/api/post/image/user",
                                "urlPostDel":"/api/post/imagedelete",
                                "imgName":"{{u.userinfo.db.im}}",
                                "maxSize":"500000",
                                "imgPath":"<?=FOLDERIMAGEUSER?>",
                                "module":"user",
                                "ui":"{{u.userinfo.db.id}}",
                                "disabledDelete":"1",
                                "nocol":"1",
                                "itemId":"{{u.userinfo.db.id}}"}'
                                data-view-template=".update-item-image-setting"
                                data-template-id="entryItemImageSetting">
                            </div>
                        </div>

                    </div>
                </div>

                {{#xif " this.u.userinfo.db.type==1 "}}
                <div class="form-group form-horizontal hidden">
                    <div class="row">
                        <div class="col-sm-3 col-xs-4 form-control-setting">{{d.l10n.coverphoto}}</div>
                        <div class="col-sm-9 col-xs-8">
                            <div class="update-banner-image-setting"
                                data-copy-template
                                data-elm-data='{"urlPost":"/api/post/image/userbanner",
                                "urlPostDel":"/api/post/imagedelete",
                                "imgName":"{{e.userBaner}}",
                                "maxSize":"2000000",
                                "imgPath":"<?=FOLDERIMAGEUSER?>",
                                "module":"banner",
                                "ui":"{{u.userinfo.db.id}}",
                                "disabledDelete":"1",
                                "nocol":"1",
                                "itemId":"{{u.userinfo.db.id}}"}'
                                data-view-template=".update-banner-image-setting"
                                data-template-id="entryItemImageSetting">
                            </div>
                        </div>

                    </div>
                </div>
                {{/xif}}

                <div class="user-update-row-name"
                    data-elm-data='{
                        "key":"db.name",
                        "value":"{{u.userinfo.db.name}}",
                        "label":"{{d.l10n.fullname}}",
                        "showSuccess":".alert-footer.alert",
                        "updateStaticInfo":".form-control-static",
                        "triggerClick": ".user-update-row-name [data-closet-toggle-class]"
                    }'
                    data-copy-template
                    data-view-template=".user-update-row-name"
                    data-template-id="entryUserUpdateRow">
                    </div>

                <div class="user-update-row-email"
                    data-elm-data='{
                        "key":"db.email",
                        "value":"{{u.userinfo.db.email}}",
                        "label":"{{d.l10n.email}}",
                        "showSuccess":".alert-footer.alert",
                        "validate":"true",
                        "require":"{{d.l10n.requireEmail}}",
                        "pattern": {
                            "email":"true",
                            "message":"{{d.l10n.requireEmailRule}}",
                            "min":"2"
                        },
                        "urlRedirect" : ".",
                        "is_received_email": "{{u.userinfo.db.is_received_email}}",
                        "updateStaticInfo":".form-control-static",
                        "triggerClick": ".user-update-row-email [data-closet-toggle-class]"
                    }'
                    data-copy-template
                    data-view-template=".user-update-row-email"
                    data-template-id="entryUserUpdateRow"></div>

                {{#xif " this.u.userinfo.db.type==1 "}}
                <div class="form-group b-b m-b-10">
                    <div class="row">
                        <label class="col-sm-3 col-xs-4 form-control-setting">{{{d.l10n.EmailReceiveApplicant}}}</label>

                        <div class="col-sm-9 col-xs-8">
                            <div class="item-view-receive-email"
                                data-view-list-by-handlebar
                                data-init-button-magic=".item [data-button-magic]"
                                data-url="<?=APIGETEMAIL?>/{{u.userinfo.db.id}}"
                                data-method="get"
                                data-show-page="10"
                                data-show-item="20"
                                data-show-all="false"
                                data-scroll-view="false"
                                data-template-id="viewItemUserReceiveEmail" >
                                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                            </div>

                            <span class="btn bg-color1 add_receive_email input-sm m-b-10"
                                data-button-magic
                                data-view-template-local="true"
                                data-view-template="[data-quick-view-item1]"
                                data-elm-data='{"user_id":"{{u.userinfo.db.id}}"}'
                                data-template-id="entryUserFormAddReceiveEmail"><i class="fa fa-plus"></i> <span>{{d.l10n.btnAddEmail}}</span></span>
                        </div>
                    </div>
                    
                </div>
                {{/xif}}
                <form method="post" class="form-horizontal post-form edit-disabled form-group user-update-row-password">
                    <div class="hidden">
                        <input type="text"
                                class="form-control"
                                name="updateNode"
                                value="password">
                        <input type="text"
                                class="form-control"
                                name="db.id"
                                value="{{u.userinfo.db.id}}">
                    </div>
                    <div class="row">
                        <span class="col-sm-3 col-xs-4 form-control-setting">{{d.l10n.password}}</span>
                        <div class="col-sm-6 col-xs-5">
                            <div class="form-control-static">******</div>
                            <div class="edit-show">
                                <div class="form-group">
                                    <label class="col-sm-4">{{d.l10n.passwordCurrent}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                            name="password.passwordOld"
                                            data-validate data-min-length="6"
                                            data-required="{{d.l10n.require}}"
                                            data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                            class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">{{d.l10n.passwordNew}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                            name="password.passwordNew"
                                            data-validate
                                            data-min-length="6"
                                            data-required="{{d.l10n.require}}"
                                            data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                            data-compare="#accountPasswordConfirm"
                                            data-compare-message="{{d.l10n.matchPassword}}"
                                            id="accountPasswordNew"
                                            class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">{{d.l10n.passwordConfirm}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"
                                            name="password.passwordConfirm"
                                            data-validate
                                            data-required="{{d.l10n.require}}"
                                            data-compare="#accountPasswordNew"
                                            data-compare-message="{{d.l10n.matchPassword}}"
                                            id="accountPasswordConfirm"
                                            class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button type="submit"
                                          class="btn bg-color1"
                                          data-button-magic
                                          data-params-form=".post-form"
                                          data-format-json="true"
                                          data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                          data-show-success=".alert-footer.alert"
                                          data-show-errors=".popup.signin-missing-session"
                                          data-trigger-click=".user-update-row-password [data-closet-toggle-class]"
                                          value="{{d.l10n.btnSave}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span> </button>
                                        <span class="btn bg-color5"
                                            data-closet-toggle-class="edit-enabled"
                                            data-object=".edit-disabled"><i class="fa fa-times"></i> <span>{{d.l10n.btnClose}}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <div class="form-control-static text-right">
                                <span class="text-color4 b-edit"
                                    data-closet-toggle-class="edit-enabled"
                                    data-object=".edit-disabled"><i class="fa fa-pencil"></i> {{d.l10n.btnEdit}}</span>
                            </div>
                        </div>
                    </div>

                </form>
                {{#if u.userinfo}}
                {{#xif " this.u.userinfo.db.type == 1"}}

                <form method="post" class="form-horizontal post-form edit-disabled form-group user-update-row-facebook hidden">
                    <div class="hidden">

                        <input type="text"
                                class="form-control"
                                name="updateNode"
                                value="db">

                        <input type="text"
                                class="form-control"
                                name="db.id"
                                value="{{u.userinfo.db.id}}">
                    </div>
                    <div class="row">
                        <span class="col-sm-3 col-xs-4 form-control-setting">{{d.l10n.facebook}}</span>
                        <div class="col-sm-7">
                            <div class="form-control-static" data-key="db.facebook">{{#if u.userinfo.db.facebook}}{{u.userinfo.db.facebook}}{{else}} {{/if}}</div>
                            <div class="edit-show">

                                <div class="row">
                                        <div class="col-sm-12  m-b-10">
                                            <input type="text"
                                                class="form-control"
                                                name="db.facebook"
                                                value="{{u.userinfo.db.facebook}}">
                                            <span class="error"></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <label class="checkbox">
                                                        <input name="db.fb_load_newfeed"
                                                           type="checkbox"
                                                           {{#xif " this.u.userinfo.db.fb_load_newfeed == 2 "}}
                                                           checked="checked"
                                                           {{/xif}}
                                                           value="2">
                                                        <span class="checkbox-style"></span>

                                                    </label>
                                                </div>
                                                <div class="col-sm-11">
                                                     <span class="info">{{d.l10n.loadFacebookNewfeed}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <label class="checkbox">
                                                        <input name="db.fb_load_photo"
                                                           type="checkbox"
                                                           {{#xif " this.u.userinfo.db.fb_load_photo == 2 "}}
                                                           checked="checked"
                                                           {{/xif}}
                                                           value="2">
                                                        <span class="checkbox-style"></span>

                                                    </label>
                                                </div>
                                                <div class="col-sm-11">
                                                   <span class="info">{{d.l10n.loadFacebookPhoto}}</span>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <button type="submit"
                                              class="btn btn-primary bg-color1"
                                              data-button-magic
                                              data-params-form=".post-form"
                                              data-format-json="true"
                                              data-update-static-info=".form-control-static"
                                              data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                              data-show-success=".alert-footer.alert"
                                              data-show-errors=".popup.signin-missing-session"
                                              data-trigger-click=".user-update-row-facebook [data-closet-toggle-class]"
                                              value="{{d.l10n.btnUpdate}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span> </button>

                                            <span class="btn btn-default text-color3"
                                                data-closet-toggle-class="edit-enabled"
                                                data-object=".edit-disabled"><i class="fa fa-times"></i> {{d.l10n.btnClose}}</span>
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-control-static text-right">
                                <span class="text-color4 b-edit"
                                    data-closet-toggle-class="edit-enabled"
                                    data-object=".edit-disabled"><i class="fa fa-pencil"></i> {{d.l10n.btnEdit}}</span>
                            </div>
                        </div>
                    </div>
                </form>
                {{/xif}}
                {{/if}}
                <div class="user-update-row-deactive form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-4 form-control-setting text-color3">{{d.l10n.deactiveAccount}}</div>
                        <div class="col-sm-9 col-xs-8">
                            <div class="show-unsave {{#xif ' this.u.userinfo.db.deactive==1 '}} active {{/xif}}">
                                {{#xif " this.u.userinfo.db.type==1 "}}
                                <div class="btn-save btn-deactive m-t-10">
                                    <span class="btn p-5 bg-color3"
                                        data-button-magic
                                        data-method="post"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                        data-params='{
                                            "updateNode":"db",
                                            "db":{"id":"{{u.userinfo.db.id}}",
                                            "deactive":"1"}
                                        }'
                                        data-success-toggle-class=".user-update-row-deactive .show-unsave,active"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        ><span>{{d.l10n.btnDeactive}}</span></span>

                                    <div class="info">{{d.l10n.deactiveContent}}</div>
                                </div>

                                <div class="btn-unsave m-t-10">
                                    <span class="btn bg-color2 p-5"
                                        data-button-magic
                                        data-method="post"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                        data-params='{
                                            "updateNode":"db",
                                            "db":{"id":"{{u.userinfo.db.id}}",
                                            "deactive":"0"}
                                        }'
                                        data-success-toggle-class=".user-update-row-deactive .show-unsave,active"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        ><span>{{d.l10n.btnActive}}</span></span>

                                    <div class="info">{{d.l10n.activeContent}}</div>
                                </div>
                                {{else}}
                                <div class="btn-save btn-deactive m-t-10">
                                    <span class="btn p-5 bg-color3"
                                        data-button-magic
                                        data-method="post"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                        data-params='{
                                            "updateNode":"db",
                                            "refertable":"<?=TABLE_USER_CV?>",
                                            "<?=TABLE_USER_CV?>":{
                                                "db":{
                                                    "ui":"{{u.userinfo.db.id}}",
                                                    "deactive":"1"
                                                }
                                            },
                                            "db":{
                                                "id":"{{u.userinfo.db.id}}",
                                                "deactive":"1"}
                                            }'
                                        data-success-toggle-class=".user-update-row-deactive .show-unsave,active"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        ><span>{{d.l10n.btnDeactive}}</span></span>

                                    <div class="info">{{d.l10n.deactiveContent}}</div>
                                </div>

                                <div class="btn-unsave m-t-10">
                                    <span class="btn bg-color2 p-5"
                                        data-button-magic
                                        data-method="post"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                        data-params='{
                                            "updateNode":"db",
                                            "refertable":"<?=TABLE_USER_CV?>",
                                            "<?=TABLE_USER_CV?>":{
                                                "db":{
                                                    "ui":"{{u.userinfo.db.id}}",
                                                    "deactive":"0"
                                                }
                                            },
                                            "db":{
                                                "id":"{{u.userinfo.db.id}}",
                                                "deactive":"0"}
                                            }'
                                        data-success-toggle-class=".user-update-row-deactive .show-unsave,active"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        ><span>{{d.l10n.btnActive}}</span></span>

                                    <div class="info hidden">{{d.l10n.activeContent}}</div>
                                </div>
                                {{/xif}}
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-4">

                        </div>
                    </div>
                </div>
                <!-- End User Normal-->
                {{/if}}
            </div>
        </div>
    </div>
</script>

<script id="entryUserMenuSetting" type="text/x-handlebars-template">
{{#unless e.hiddenMenu}}
<div class="block transition">
    <div class="block-title bg-color5 text-uppercase text-bold">
        <span>{{d.l10n.dashboard}}</span>
    </div>
    <div class="block-content">
{{/unless}}
        <ul class="">
    {{#xif " this.u.userinfo.db.type==1 "}}
        {{#if u.usersub.id}}
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&pid={{u.usersub.id}}" class="{{#if e.page }}active{{/if}}"><i class="fa fa-building-o"></i> <span>{{d.l10n.pages}}</span></a>
            </li>
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobs" class="{{#if e.managejob }}active{{/if}}"><i class="fa fa-suitcase"></i> <span>{{d.l10n.jobs}}</span></a>
            </li>
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=userapply" class="{{#if e.userapply }}active{{/if}}"><i class="fa fa-files-o"></i> <span>{{d.l10n.applications}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=usersave" class="{{#if e.usersave }}active{{/if}}"><i class="fa fa-heart"></i> <span>{{d.l10n.btnLike}}</span></a>
            </li>
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=info" class="{{#if e.info }}active{{/if}}"><i class="fa fa-gears"></i> <span>{{d.l10n.accountSettting}}</span></a>
            </li>
       
        {{else}}

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&setting=info" class="{{#if e.page }}active{{/if}}"><i class="fa fa-building-o"></i> <span>{{d.l10n.pages}}</span></a>
            </li>

            <li class="no-hover hidden-xs">
                <ul class="company-list-top"
                    data-copy-template
                    {{#unless e.mobile}}
                    data-elm-data='{"create":"1","update":"1","postjob":"1","mobile":"1"}'
                    {{else}}
                    data-elm-data='{"create":"1","update":"1","postjob":"1"}'
                    {{/unless}}
                    data-view-template=".company-list-top" data-template-id="entryCmpPageSimpleList"></ul>
            </li>

            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>
    
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobs" class="{{#if e.managejob }}active{{/if}}"><i class="fa fa-suitcase"></i> <span>{{d.l10n.jobs}}</span></a>
            </li>

            {{#unless e.mobile}}
            <li class="hidden-xs">
                <a href="/<?=$seo_name["page"]["user"];?>?manage=postjob"
                    data-button-magic
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-elm-data='{"urlRedirect":"/{{u.userinfo.db.username}}"}'
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entryPostJobOptionCompany">
                   <i class="fa no-shadow">&nbsp;</i> <span>{{d.l10n.postNewJob}}</span>
                </a>
            </li>
            {{/unless}}

            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages" class="{{#if e.inbox }}active{{/if}}"><i class="fa fa-envelope"></i> <span>{{d.l10n.messages}}</span></a>
            </li>
            {{#unless e.hiddenMenu}}
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=compose" class="{{#if e.compose }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.writemessages}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=sent" class="{{#if e.sent }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.sentmessages}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=important" class="{{#if e.important }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.importantmessages}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=trash" class="{{#if e.trash }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.trashmessages}}</span></a>
            </li>
            {{/unless}}

            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>
           
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=userapply" class="{{#if e.userapply }}active{{/if}}"><i class="fa fa-files-o"></i> <span>{{d.l10n.applications}}</span></a>
            </li>

            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=usersave" class="{{#if e.usersave }}active{{/if}}"><i class="fa fa-heart"></i> <span>{{d.l10n.btnLike}}</span></a>
            </li>

            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=interview" class="{{#if e.interview }}active{{/if}}"><i class="fa fa-heart"></i> <span>{{d.l10n.btnInterview}}</span></a>
            </li>

            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=hire" class="{{#if e.hire }}active{{/if}}"><i class="fa fa-heart"></i> <span>{{d.l10n.btnHire}}</span></a>
            </li>

            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=deny" class="{{#if e.deny }}active{{/if}}"><i class="fa fa-heart"></i> <span>{{d.l10n.btnDeny}}</span></a>
            </li>


            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>
           
            {{#unless e.hiddenMenu}}
            <li class="hidden-xs">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=usersub" class="{{#if e.usersub }}active{{/if}}"><i class="fa fa-users"></i> <span>{{d.l10n.admin}}</span></a>
            </li>
            <li class="hidden-xs">
                <a href="/<?=$seo_name["page"]["user"];?>?manage=usersub&add">
                   <i class="fa no-shadow">&nbsp;</i> <span>{{d.l10n.addAdmin}}</span>
                </a>
            </li>
            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>
            {{/unless}}

            
            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=checkout" class="{{#if e.checkout }}active{{/if}}"><i class="fa fa-shopping-cart"></i> <span>{{d.l10n.paymentsHistory}}</span></a>
            </li>
            {{#unless e.mobile}}
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=promoapplied" class="{{#if e.promoapplied }}active{{/if}}"><i class="fa fa-code"></i> <span>{{d.l10n.ActivationCode}}</span></a>
            </li>
            {{/unless}}
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=info" class="{{#if e.info }}active{{/if}}"><i class="fa fa-gears"></i> <span>{{d.l10n.accountSettting}}</span></a>
            </li>
        {{/if}}
    {{/xif}}
    {{#xif " this.u.userinfo.db.type==2 "}}

            <li class="">
                <a href="/<?=$seo_name['page']['cv']?>/{{urlFriendly this.u.userinfo.db.name this.u.userinfo.db.id}}" class="short-text {{#if e.profile }}active{{/if}}"><i class="fa fa-user"></i> <span>{{this.u.userinfo.db.name}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>" class="{{#if e.updateProfile }}active{{/if}}"><i class="fa no-shadow">&nbsp;</i> <span>{{d.l10n.btnUpdateProfile}}</span></a>
            </li>

            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages" class="{{#if e.inbox }}active{{/if}}"><i class="fa fa-envelope"></i> <span>{{d.l10n.messages}}</span></a>
            </li>
            {{#unless e.hiddenMenu}}
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=sent" class="{{#if e.sent }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.sentmessages}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=important" class="{{#if e.important }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.importantmessages}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=trash" class="{{#if e.trash }}active{{/if}}"><i class="fa no-shadow"></i> <span>{{d.l10n.trashmessages}}</span></a>
            </li>
            {{/unless}}
            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>
            
            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobsuggest" class="{{#if e.suggested }}active{{/if}}"><i class="fa fa-file"></i> <span>{{d.l10n.suggestion}}</span></a>
            </li>

            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobapply" class="{{#if e.applyjob }}active{{/if}}"><i class="fa fa-file"></i> <span>{{d.l10n.jobApplied}}</span></a>
            </li>

            <li>
               <a href="/<?=$seo_name["page"]["user"]?>?manage=jobsave" class="{{#if e.savejob }}active{{/if}}"><i class="fa fa-heart"></i> <span>{{d.l10n.jobSaved}}</span></a>
            </li>

            <li class="b-b m-b-10 m-t-10 m-h-1 no-padding">&nbsp;</li>
            
            <li>
                <a href="/<?=$seo_name["page"]["user"]?>?manage=info" class="{{#if e.info }}active{{/if}}"><i class="fa fa-gears"></i> <span>{{d.l10n.accountSettting}}</span></a>
            </li>

            <li class="hidden">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=notify" class="{{#if e.checkout }}active{{/if}}">{{d.l10n.notification}}/span> </strong><</a>
            </li>

    {{/xif}}
        </ul>
{{#unless e.hiddenMenu}}
    </div>
</div>
{{/unless}}
</script>

<script id="entryCheckoutItem" type="text/x-handlebars-template">
    <tr class="b-b">
       <td><a class="text-bold text-color3"
            {{#if e.linkDetail}}
            href="{{e.linkDetail}}&view={{i.id}}"
            {{else}}
            href="/<?=$seo_name["page"]["user"]?>?manage=checkout&view={{i.id}}"
            {{/if}}>{{i.id}}</a></td>
       <td class="text-bold text-color1">{{{textFromDropdownLocal i.si 'service' 'id' 'title'}}}</td>
       <td>{{formatCurrency i.am}}</td>
       <td>{{{formatDate i.cr '%d-%M-%Y'}}}</td>
       <td>{{{textFromDropdownLocal i.pm 'paymentMethod' 'id' 'title'}}}</td>
       <td class="text-right">
            <p>{{{textFromDropdownLocal i.ps 'orderStatus' 'id' 'ti'}}}</p>
            {{#xif ' this.u.adminlog.permission == 100 && this.i.ai > 0'}}
            <p>{{{textFromDropdownLocal i.ai 'userManager' 'i' 'n'}}}</p>
            {{/xif}}
       </td>

    </tr>
</script>

<script id="entryCheckoutViewDetail" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                data-elm-data='{"checkout":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">
            <div class="user-view-checkout"
                data-copy-template
                data-option-local="viewCheckoutDetail"
                data-view-template=".user-view-checkout"
                data-template-id="entryViewCheckoutDetail"></div>
        </div>
    </div>
</script>

<script id="entryViewCheckoutDetail" type="text/x-handlebars-template">
    <div class="listdatas bg-color4">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="h-tt p-10 b-b">
                    <a
                        {{#if e.referer}}
                        href="{{e.referer}}"
                        {{else}}
                        href="/<?=$seo_name["page"]["user"]?>?manage=checkout"
                        {{/if}}
                        class="t-back text-color2">
                        <i class="fa fa-caret-left"></i> Quay lai
                    </a>
                    <h1 class="text-color1 text-bold t-s-19 no-margin p-5">Lịch Sử Giao Dịch</h1>
               </div>
           </div>
        </div>
        <div class="p-10">
            <div class="pm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-color1 text-bold">Thông tin đơn </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{d.l10n.companyName}}</div>
                    <div class="col-sm-10">
                        <label>{{i.info.name}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        Business Category
                    </div>
                    <div class="col-sm-10">
                        <label class="c-list">{{{textFromDropdownLocal i.info.category 'menuList' ''}}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{d.l10n.phone}}</div>
                    <div class="col-sm-10">
                        <label>{{i.info.phone}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{d.l10n.email}}</div>
                    <div class="col-sm-10">
                        <label>{{i.info.email}}</label>
                    </div>
                </div>
                <div class="row m-b-10">
                    <div class="col-sm-2">{{d.l10n.address}}</div>
                    <div class="col-sm-10">
                        <label>{{i.info.address}} - {{{textFromDropdownLocal i.info.city 'location' 'id' 'ti'}}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-bold bg-gr-n-b">
                                <tr>
                                    <th>Dịch vụ</th>
                                    <th>Thời hạn</th>
                                    <th class="text-right">Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="b-b">
                                    <td class="col-sm-4 text-color3 text-bold">
                                    {{i.service.title}}</td>
                                    <td>
                                        {{i.service.day}} Day
                                    </td>
                                    <td class="text-right">
                                        {{formatCurrency i.order.am}} VND
                                    </td>
                                </tr>
                                <tr class="b-b">
                                    <td>&nbsp;</td>
                                    <td class="text-right">Tổng cộng (chưa VAT):</td>
                                    <td class="text-right">{{formatCurrency i.order.am}} VND</td>
                                </tr>
                                <tr class="b-b">
                                    <td>&nbsp;</td>
                                    <td class="text-right">VAT:</td>
                                    <td class="text-right">1,000 VND</td>
                                </tr>
                                <tr class="b-b">
                                    <td>&nbsp;</td>
                                    <td class="text-right text-bold">Thành tiền:</td>
                                    <td class="text-right text-bold text-color3">{{formatCurrency i.order.am}} VND</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        Phương thức thanh
                    </div>
                    <div class="col-sm-10">
                        <label>{{{textFromDropdownLocal i.order.pm 'paymentMethod' 'id' 'title'}}}</label>
                        {{#if i.order.no}} ({{i.order.no}}){{/if}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        Mã số
                    </div>
                    <div class="col-sm-10">
                        <label style="text-color1">{{i.order.id}}</label>
                    </div>
                </div>
                {{#xif ' this.u.adminlog.permission == 100 && this.i.order.ps < 5 '}}
                <form method="post" class="form-horizontal post-form edit-disabled form-group">
                <div class="row">
                    <div class="col-sm-2">
                        {{d.l10n.status}}
                    </div>
                    <div class="col-sm-3">
                        <div class="form-control-static">
                            <label class="text-color3">{{{textFromDropdownLocal i.order.ps 'orderStatus' 'id' 'ti'}}}</label>
                            <div class="hidden">
                                <input type="hidden" name="mod" value="checkout">
                                <input type="hidden" name="db.id" value="{{i.order.id}}">
                                <input type="hidden" name="db.ai" value="{{u.adminlog.id}}">
                            </div>
                        </div>

                        <div class="edit-show">
                            <select  type="select"
                                name="db.ps"
                                data-dropdown
                                data-index-value="{{i.order.ps}}"
                                data-status-option="order"
                                class="form-control"></select>
                            <textarea class="form-control m-t-15" name="db.no" placeholder="note">{{i.order.no}}</textarea>
                            <div class="m-t-15">
                                <button type="submit"
                                    class="btn bg-color3 text-uppercase"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTADMINACTIVE?>"
                                    data-show-success=".alert-footer.alert"
                                    data-show-errors=".alert-footer.alert-error"
                                    data-redirect="."
                                    data-trigger-click=".user-update-row-username [data-closet-toggle-class]"
                                    value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>
                                <span class="btn btn-default text-color3"
                                    data-closet-toggle-class="edit-enabled"
                                    data-object=".edit-disabled">{{d.l10n.btnClose}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-control-static text-right">
                            <span class="text-color4 b-edit" data-closet-toggle-class="edit-enabled" data-object=".edit-disabled"><i class="fa fa-pencil"></i> Edit</span>
                        </div>
                    </div>
                </div>
                </form>
                {{else}}
                <div class="row">
                    <div class="col-sm-2">
                        {{d.l10n.status}}
                    </div>
                    <div class="col-sm-10">
                        <label class="text-color3">{{{textFromDropdownLocal i.order.ps 'orderStatus' 'id' 'ti'}}}</label>
                    </div>
                </div>
                {{/xif}}
                {{#xif ' this.u.adminlog.permission == 100 && this.i.order.ai > 0'}}
                <div class="row">
                    <div class="col-sm-2">
                        Latest update
                    </div>
                    <div class="col-sm-10">
                        {{{textFromDropdownLocal i.order.ai 'userManager' 'i' 'n'}}}
                    </div>
                </div>
                {{/xif}}
                <div class="row b-b m-b-10">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-8">&nbsp;</div>
                    <div class="col-sm-2"><button class="btn bg-grey-color1 text-bold f-s-17 w-100">In Hóa đơn</button></div>
                    <div class="col-sm-2"><button class="btn bg-color3 text-bold f-s-17 w-100">Hoàn tất</button></div>
                </div>

            </div>
        </div>
    </div>
</script>


<script id="entryUserUpdateCV" type="text/x-handlebars-template">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
                <div class="cv-update-entry"
                    {{#if e.hiddenMenuLeft}}
                    data-elm-data='{"urlRedirect":".","cvPopup":"true","hiddenMenuLeft":"1"}'
                    {{else}}
                    data-elm-data='{"urlRedirect":".","cvPopup":"true"}'
                    {{/if}}
                    data-copy-template
                    data-view-template=".modal-body .cv-update-entry"
                    data-template-id="entryUserUpdate"></div>
            </div>
        </div>
    </div>
</script>
<script id="entryUserUpdate" type="text/x-handlebars-template">
    {{#xif " this.u.userinfo.db.type==2 "}}
    <div class="row m-t-15">
        <div class="col-sm-3 {{#if e.hiddenMenuLeft}}hidden{{/if}}">
            <div class="user-menu-action"
                    data-elm-data='{"updateProfile":"1"}'
                    data-copy-template
                    data-view-template=".user-menu-action"
                    data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="{{#if e.hiddenMenuLeft}}col-sm-12 popup-cv{{else}}col-sm-9{{/if}}">
            <div class="t-s-21 text-bold bg-color7 p-10 b-r-4 p-l-20 text-capitalize">{{d.l10n.updateYourProfile}}</div>
            <form class="row form-horizontal post-form edit-disabled edit-enabled">
                <div class="col-sm-12">
                    <div class="form-horizontal">
                        <div class="cmp-more">
                            <div class="hidden">
                                <input type="text"
                                        class="form-control"
                                        name="updateNode"
                                        value="db">
                                <input type="text"
                                        class="form-control"
                                        name="db.id"
                                        value="{{u.userinfo.db.id}}">

                                <input type="text"
                                    class="form-control"
                                    name="refertable"
                                    value="user_cv">
                                <input type="text"
                                        class="form-control"
                                        name="user_cv.db.ui"
                                        value="{{u.userinfo.db.id}}">
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">{{d.l10n.avatar}}</label>
                                <div class="col-sm-9">
                                    <div class="update-item-image-setting in"
                                        data-copy-template
                                        data-elm-data='{"urlPost":"/api/post/image/user",
                                        "urlPostDel":"/api/post/imagedelete",
                                        "imgName":"{{u.userinfo.db.im}}",
                                        "maxSize":"<?=maxSizeUpload?>",
                                        "imgPath":"<?=FOLDERIMAGEUSER?>",
                                        "module":"user",
                                        "ui":"{{u.userinfo.db.id}}",
                                        "disabledDelete":"1",
                                        "nocol":"1",
                                        "itemId":"{{u.userinfo.db.id}}"}'
                                        data-view-template=".update-item-image-setting"
                                        data-template-id="entryItemImageSetting">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">{{d.l10n.fullname}} <span class="require">*</span></label>
                                <div class="col-sm-5">
                                    <div class="form-control-static">{{u.userinfo.db.name}}</div>
                                    <div class="edit-show">
                                        <input type="text"
                                        name="db.name"
                                        class="form-control"
                                        value="{{u.userinfo.db.name}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p class="form-control-static">
                                        {{#xif  " this.u.userinfo.db.gender == 1 " }}
                                        {{d.l10n.male}}
                                        {{else}}
                                        {{d.l10n.female}}
                                        {{/xif}}
                                    </p>
                                    <div class="edit-show">
                                        <div class="option-inline">
                                            <label class="radio">
                                                <input type="radio"
                                                  name="db.gender"
                                                  data-validate
                                                  data-required="{{d.l10n.requireStatus}}"
                                                  data-hidden-message="true"
                                                  {{#xif  " this.u.userinfo.db.gender == 1 " }}
                                                  checked="checked"
                                                  {{/xif}}
                                                  value="1">
                                                <span class="radio-style"></span>{{d.l10n.male}}
                                                <span class="error"></span>
                                            </label>
                                        </div>
                                        <div class="option-inline">
                                            <label class="radio">
                                                <input type="radio"
                                                  name="db.gender"
                                                  data-validate
                                                  data-required="{{d.l10n.requireStatus}}"
                                                  data-hidden-message="true"
                                                  {{#xif  " this.u.userinfo.db.gender == 2 " }}
                                                  checked="checked"
                                                  {{/xif}}
                                                  value="2">
                                              <span class="radio-style"></span>{{d.l10n.female}}
                                              <span class="error"></span>
                                          </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3">{{d.l10n.bod}} <span class="require">*</span></label>

                                <div class="{{#if e.hiddenMenuLeft}}col-sm-5{{else}}col-sm-9{{/if}}">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">
                                            <span class="select-wrapper">
                                            <select name="db.day"
                                                data-validate
                                                data-required="{{d.l10n.require}}"
                                                data-dropdown
                                                data-params="country="
                                                data-index-value="{{u.userinfo.db.day}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optDay}}"}'
                                                data-option-local-json="dayTime"
                                                class="form-control">
                                                <option value="">{{d.l10n.optDay}}</option>
                                            </select>
                                            </span>
                                            <span class="error">{{d.l10n.require}}</span>
                                        </div>    
                                        <div class="col-sm-4 col-xs-4">
                                            <span class="select-wrapper">
                                            <select name="db.month"
                                                data-validate
                                                data-required="{{d.l10n.require}}"
                                                data-dropdown
                                                data-params="country="
                                                data-index-value="{{u.userinfo.db.month}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optMonth}}"}'
                                                data-option-local-json="monthTime"
                                                class="form-control">
                                                <option value="">{{d.l10n.optMonth}}</option>
                                            </select>
                                            </span>
                                            <span class="error">{{d.l10n.require}}</span>
                                        </div>
                                        <div class="col-sm-4 col-xs-4">
                                            <input  type="text"
                                                    value="{{u.userinfo.db.year}}"
                                                    name="db.year"
                                                    data-validate
                                                    data-required="{{d.l10n.require}}"
                                                    data-min-length="2"
                                                    data-pattern="^[0-9-+\s()]*$" data-min-length="9" data-max-length="20"
                                                    data-pattern-message="{{d.l10n.requirePhoneRule}}"
                                                    placeholder="{{d.l10n.optYear}}"
                                                    data-show-dropdowns="true"
                                                    class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">{{d.l10n.email}} <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.userinfo.db.email}}</div>
                                    <input type="text"
                                        class="form-control"
                                        name="db.email"
                                        value="{{u.userinfo.db.email}}"
                                        data-validate data-min-length="2"
                                        data-required="{{d.l10n.requireEmail}}"
                                        data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                                        data-pattern-message="{{d.l10n.requireEmailRule}}">
                                    <span class="error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">{{d.l10n.phone}} <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.userinfo.db.phone}}</div>
                                    <input type="text"
                                        class="form-control"
                                        name="db.phone"
                                        value="{{u.userinfo.db.phone}}"
                                        data-validate
                                        data-min-length="2"
                                        data-required="{{d.l10n.require}}"
                                        data-pattern="^[0-9-+\s()]*$" data-min-length="9" data-max-length="20"
                                        data-pattern-message="{{d.l10n.requirePhoneRule}}">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">{{d.l10n.address}}</label>

                                <div class="col-sm-9">
                                    <input type="text"
                                        name="db.address"
                                        id="autocomplete"
                                        placeholder="{{d.l10n.optAddress}}"
                                        value="{{u.userinfo.db.address}}"
                                        class="form-control"
                                        data-required="{{d.l10n.require}}">
                                    <span class="error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 hidden-xs">
                                </label>
                                <div class="col-sm-6">
                                    <span class="select-wrapper">
                                    <select name="db.country"
                                        data-required="{{d.l10n.require}}"
                                        data-dropdown
                                        data-dropdown-relative-body
                                        data-dropdown-relative="db.city"
                                        data-params="country="
                                        data-index-value="{{#if u.userinfo.db.country}}{{u.userinfo.db.country}}{{else}}vn{{/if}}"
                                        data-object-init='{"id":"", "ti":"{{d.l10n.optCountry}}"}'
                                        data-option-local-json="country"
                                        class="form-control">
                                        <option value="">{{d.l10n.optCoutry}}</option>
                                    </select>
                                    </span>
                                    <span class="error">{{d.l10n.require}}</span>
                                </div>
                                <div class="col-sm-3">
                                    <span class="select-wrapper">

                                        <select name="db.city"
                                                type="select-from-json"
                                                data-dropdown
                                                data-required="{{d.l10n.require}}"
                                                data-option-from-json="<?=APIGETCITY?>"
                                                data-params="country={{#if u.userinfo.db.country}}{{u.userinfo.db.country}}{{else}}vn{{/if}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                data-index-value="{{#if u.userinfo.db.city}}{{u.userinfo.db.city}}{{else}}0{{/if}}"
                                                class="form-control">
                                                <option value="">{{d.l10n.optCity}}</option>
                                        </select>


                                    </span>
                                    <span class="error">{{d.l10n.require}}</span>
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label class="col-sm-3">
                                    Skype
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.userinfo.db.skype}}</div>
                                    <input type="text"
                                        class="form-control"
                                        name="db.skype"
                                        value="{{u.userinfo.db.skype}}">
                                    <span class="error"></span>
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label class="col-sm-3">
                                    Facebook
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.userinfo.db.facebook}}</div>
                                    <input type="text"
                                        class="form-control"
                                        name="db.facebook"
                                        value="{{u.userinfo.db.facebook}}">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="cmp-more">
                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.jobTitle}} <span class="require">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.user_cv.db.title}}</div>
                                    <input type="text"
                                        class="form-control job-title"
                                        data-validate
                                        data-required="{{d.l10n.require}}"
                                        placeholder="{{d.l10n.typeYourPositionYouLookingFor}}"
                                        name="user_cv.db.title"
                                        value="{{u.user_cv.db.title}}">
                                    <span class="error"></span>
                                    <span class="t-s-12">{{d.l10n.exJobTitle}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.yearOfExperience}} <span class="require">*</span>
                                </label>    
                                <div class="col-sm-9">
                                    <div class="form-control-static">
                                        {{{textFromDropdownLocal u.user_cv.db.experience 'yearOfExperience' 'id' 'ti'}}}
                                    </div>
                                    <div data-radio class="edit-show">
                                        {{#each dropdown.yearOfExperience}}
                                            <label>
                                                <input
                                                type="radio"
                                                value="{{this.id}}"
                                                name="user_cv.db.experience"
                                                {{checkRadioValue ../../u.user_cv.db.experience this.id}}
                                                data-validate
                                                data-required>
                                                <div class="radio-select b-r-4 m-b-10">
                                                <p>{{this.ti}}</p>
                                                </div>
                                            </label>
                                        {{/each}}
                                        <span class="error">{{d.l10n.require}}</span>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.jobCategoriesWantToJoin}} <span class="require">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static c-list">
                                        {{{textFromDropdownLocal u.userinfo.db.category 'menuList' ''}}}
                                    </div>
                                    <div data-checkbox-validate class="edit-show">
                                      {{#each dropdown.menuStructure}}
                                        {{#xif ' this.opp == 3 '}}
                                        <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../u.user_cv.db.category this.id}}">
                                            <input class="b-r-4"
                                            name="user_cv.db.category.{{this.id}}"
                                            type="checkbox"
                                            data-key-name="user_cv.db.category"
                                            {{checkboxValue ../../u.user_cv.db.category this.id}}
                                            value="{{this.id}}">
                                            <span class="checkbox-style"></span>
                                            <span class="tx">{{this.ti}}</span>
                                        </div>
                                        {{/xif}}
                                        {{/each}}
                                        <span class="error">{{d.l10n.require}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 hidden">
                                    <span class="select-wrapper">
                                        <select name="locationlist"
                                                class="form-control"
                                                data-multiselect-box
                                                data-multiselect-box-max="3"
                                                data-multi-selected="{{u.user_cv.db.location}}"
                                                data-key-name="user_cv.db.location"
                                                data-required="{{d.l10n.require}}"
                                                data-dropdown
                                                data-option-local-json="location"
                                                data-option-from-json="<?=APIGETLOCATION;?>"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.jobLocations}}"}'
                                                data-target-append=".multiselect-location">
                                                <option value="">{{d.l10n.optLocation}}</option>
                                        </select>
                                    </span>
                                    <span class="error">{{d.l10n.require}}</span>
                                    <div data-show-options-list class="multiselect-location"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.jobType}} <span class="require">*</span>
                                </label>
                                <div data-checkbox-validate class="col-sm-9">
                                    {{#each dropdown.jobTime}}
                                    <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../u.user_cv.db.type this.id}}">
                                        <input class="b-r-4"
                                        name="user_cv.db.type.{{this.id}}"
                                        type="checkbox"
                                        data-key-name="user_cv.db.type"
                                        {{checkboxValue ../../u.user_cv.db.type this.id}}
                                        value="{{this.id}}">
                                        <span class="checkbox-style"></span>
                                        <span class="tx">{{this.ti}}</span>
                                    </div>
                                    {{/each}}
                                    <span class="error">{{d.l10n.require}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.jobLevel}} <span class="require">*</span>
                                </label>
                                <div data-checkbox-validate class="col-sm-9">
                                    {{#each dropdown.jobLevel}}
                                    <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../u.user_cv.db.level this.id}}">
                                        <input class="b-r-4"
                                        name="user_cv.db.level.{{this.id}}"
                                        type="checkbox"
                                        data-key-name="user_cv.db.level"
                                        {{checkboxValue ../../u.user_cv.db.level this.id}}
                                        value="{{this.id}}">
                                        <span class="checkbox-style"></span>
                                        <span class="tx">{{this.ti}}</span>
                                    </div>
                                    {{/each}}
                                    <span class="error">{{d.l10n.require}}</span>

                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.languages}}
                                </label>
                                <div data-checkbox-validate class="col-sm-9">
                                    <div class="form-control-static">
                                        {{{textFromDropdownLocal u.user_cv.db.lang 'languageOption' 'id' 'ti'}}}
                                    </div>
                                    
                                    {{#each dropdown.languageOption}}
                                    <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../u.user_cv.db.lang this.id}}">
                                        <input class="b-r-4"
                                        name="user_cv.db.lang.{{this.id}}"
                                        type="checkbox"
                                        data-key-name="user_cv.db.lang"
                                        {{checkboxValue ../../u.user_cv.db.lang this.id}}
                                        value="{{this.id}}">
                                        <span class="checkbox-style"></span>
                                        <span class="tx">{{this.ti}}</span>
                                    </div>
                                    {{/each}}
                                    <span class="error">{{d.l10n.require}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.salaryExpect}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.user_cv.db.salary}}</div>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control"
                                                name="user_cv.db.s1"
                                                value="{{formatCurrency u.user_cv.db.s1}}"
                                                data-required="{{d.l10n.require}}"
                                                onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                                                onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); }"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                                                placeholder="">
                                                <span class="error"></span>
                                        </div>
                                        <div class="col-xs-4">
                                            <span class="select-wrapper">
                                            <select name="user_cv.db.salary"
                                                type="select"
                                                data-required="{{d.l10n.require}}"
                                                data-dropdown
                                                data-index-value="{{#if u.user_cv.db.salary}}{{u.user_cv.db.salary}}{{else}}1{{/if}}"
                                                data-option-local-json="currency"
                                                class="form-control">
                                            </select>
                                            </span>
                                            <span class="error">{{d.l10n.require}}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.aboutme}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.user_cv.db.about}}</div>
                                    <textarea
                                        name="user_cv.db.about"
                                        data-required="{{d.l10n.require}}"
                                        class="form-control more">{{u.user_cv.db.about}}</textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.keySkills}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.user_cv.db.skill}}</div>
                                    <textarea
                                        name="user_cv.db.skill"
                                        data-required="{{d.l10n.require}}"
                                        class="form-control more">{{u.user_cv.db.skill}}</textarea>
                                    <span class="error"></span>
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label class="col-sm-3">
                                    {{d.l10n.keyword}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-static">{{u.user_cv.db.keyword}}</div>
                                    <textarea
                                        name="user_cv.db.keyword"
                                        data-required="{{d.l10n.require}}"
                                        class="form-control more skill-tag">{{u.user_cv.db.keyword}}</textarea>
                                    <span class="error"></span>
                                </div>
                                <div class="col-sm-9 col-sm-offset-3 m-t-5">
                                    {{{d.l10n.keywordJobSkill}}}
                                </div>
                            </div>
                            
                            <div class="form-group m-t-b-30">
                                <label class="col-sm-3">
                                    {{d.l10n.employmentHistory}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="item-view-experience"
                                        data-view-list-by-handlebar
                                        data-init-button-magic=".item [data-button-magic]"
                                        data-url="<?=APIGETUSERINFO;?>/{{u.userinfo.db.id}}/experience"
                                        data-method="get"
                                        data-show-page="10"
                                        data-show-item="20"
                                        data-show-all="false"
                                        data-scroll-view="false"
                                        data-template-id="viewItemWorkExperience" >
                                        <div class="view-items" data-content><div class="style-loadding">...</div></div>
                                    </div>

                                    <span class="btn btn-xs bg-color1 text-uppercase"
                                        data-button-magic
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item1]"
                                        data-elm-data=''
                                        data-template-id="entryUserFormExperience">{{d.l10n.btnAdd}} + </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">
                                    {{d.l10n.educationHistory}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="item-view-education"
                                        data-view-list-by-handlebar
                                        data-init-button-magic=".item [data-button-magic]"
                                        data-url="<?=APIGETUSERINFO;?>/{{u.userinfo.db.id}}/education"
                                        data-method="get"
                                        data-show-page="10"
                                        data-show-item="20"
                                        data-show-all="false"
                                        data-scroll-view="false"
                                        data-template-id="viewItemWorkEducation" >
                                        <div class="view-items" data-content><div class="style-loadding">...</div></div>
                                    </div>
                                    <span class="btn btn-xs bg-color1 text-uppercase"
                                        data-button-magic
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item1]"
                                        data-elm-data=''
                                        data-template-id="entryUserFormEducation">{{d.l10n.btnAdd}} + </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 text-right">
                    <div class="btn-action">
                        <div class="action-content">
                            <div class="col-sm-12 text-right">
                                {{#unless e.cvPopup}}
                                <a href="/<?=$seo_name['page']['cv']?>/{{urlFriendly this.u.userinfo.db.name this.u.userinfo.db.id}}" class="btn bg-color5 text-uppercase"><i class="fa fa-times"></i> {{d.l10n.btnCancel}}</a>
                                {{/unless}}
                                <button type="submit"
                                class="btn bg-color1 text-uppercase"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTUSEREDIT?>"
                                data-show-success=".alert-footer.alert"
                                data-show-errors=".alert-footer.alert-error"
                                {{#if e.urlRedirect}}
                                data-redirect="{{e.urlRedirect}}"
                                {{/if}}
                                value="{{d.l10n.btnSave}}">
                                <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span>    
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{else}}
{{/xif}}
</script>
<script id="entryCmpUpdateMoreAbout" type="text/x-handlebars-template">
    <form method="post" class="form-horizontal post-form emp-more edit-disabled">
        <div class="hidden">
            <input name="db.ui" type="text" value="{{u.userinfo.db.id}}">
            <input name="db.id" type="text" value="{{i.db.id}}">
            <input name="updateNode" type="text" value="more">
        </div>
        <div class="cmp-more {{#xif ' this.e.showElement == 0 '}} hidden {{/xif}}">
            <div class="form-group emp-info no-m-bottom">
                <label class="col-sm-2 control-label text-left text-color1 t-s-18 hidden">{{d.l10n.aboutus}}</label>
                <div class="col-sm-12">
                    
                    <div class="form-control-static no-padding textarea-content" data-key="more.about">{{i.more.about}}</div>
                    <div class="edit-show">
                        <textarea type="text"
                            name="more.about"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            class="form-control more">{{i.more.about}}</textarea>
                        <span class="error"></span>
                    </div>

                    <div class="form-control-static no-padding profile-edit-button">
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            class="btn bg-color4 text-uppercase"><i class="fa fa-pencil"></i></span>
                    </div>

                    <div class="edit-show m-t-15">
                        <button type="submit"
                              class="btn bg-color3 text-uppercase"
                              data-button-magic
                              data-params-form=".post-form"
                              data-format-json="true"
                              data-ajax-url="<?=APIPOSTCOMPANY?>"
                              {{#if e.triggerClick}}
                              data-trigger-click="{{e.triggerClick}}"
                              {{/if}}
                              data-show-success=".alert-footer.alert"
                              data-show-errors=".alert-footer.alert-error"
                              data-update-static-info=".form-control-static"
                              value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            class="btn bg-color2 text-uppercase">{{d.l10n.btnClose}}</span>
                    </div>
                </div>

            </div>
        </div>
    </form>
</script>
<script id="entryCmpUpdateMoreWorkUs" type="text/x-handlebars-template">
    <form method="post" class="form-horizontal post-form emp-more edit-disabled">
        <div class="hidden">
            <input name="db.ui" type="text" value="{{u.userinfo.db.id}}">
            <input name="db.id" type="text" value="{{i.db.id}}">
            <input name="updateNode" type="text" value="more">
        </div>
        <div class="cmp-more">
            <div class="form-group emp-info">
                <label class="col-sm-2 control-label text-left text-color1 t-s-18">{{d.l10n.workWithUs}}</label>
                <div class="col-sm-10">
                    <div class="form-control-static textarea-content" data-key="more.whyworkus">{{{i.more.whyworkus}}}</div>
                    <div class="edit-show">
                        <textarea type="text"
                            name="more.whyworkus"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            class="form-control more">{{i.more.whyworkus}}</textarea>
                        <span class="error"></span>
                    </div>

                    <div class="form-control-static profile-edit-button">
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            class="btn bg-color4 text-uppercase"><i class="fa fa-pencil"></i> {{d.l10n.btnEditContent}}</span>
                    </div>

                    <div class="edit-show m-t-15">
                        <button type="submit"
                              class="btn bg-color3 text-uppercase"
                              data-button-magic
                              data-params-form=".post-form"
                              data-format-json="true"
                              data-ajax-url="<?=APIPOSTCOMPANY?>"
                              {{#if e.triggerClick}}
                              data-trigger-click="{{e.triggerClick}}"
                              {{/if}}
                              data-show-success=".alert-footer.alert"
                              data-show-errors=".alert-footer.alert-error"
                              data-update-static-info=".form-control-static"
                              value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            class="btn bg-color2 text-uppercase">{{d.l10n.btnClose}}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</script>
<script id="entryCmpUpdateInfo" type="text/x-handlebars-template">
    <form method="post" class="form-horizontal post-form edit-disabled {{#if e.create}}edit-enabled{{/if}} emp-info">
        <div class="hidden">

            <input type="text"
                    name="updateNode"
                    value="db"
                    class="form-control">

            <input type="text"
                    name="db.ui"
                    value="{{u.userinfo.db.id}}"
                    class="form-control">

            <input type="text"
                    name="db.id"
                    value="{{i.db.id}}"
                    class="form-control">

            <input type="text"
                    id="lat"
                    name="db.lat"
                    value="{{i.db.lat}}"
                    class="form-control">

            <input type="text"
                    id="lng"
                    name="db.lng"
                    value="{{i.db.lng}}"
                    class="form-control">  

            <input type="text"
                    id="facebookfill"
                    name="db.facebookfill"
                    value="0"
                    class="form-control">  

            <input type="text"
                    name="fb.facebook_id"
                    value=""
                    class="form-control">                        

        </div>


        <header class="h-tt text-color5 text-bold t-s-18 p-b-20 text-capitalize">
            {{d.l10n.fillCmpInformationManual}}
        </header>

        {{#if i.db.id}}

        {{#if e.create}}
        <div class="form-group">
                <div class="col-sm-2 col-xs-12 form-control-setting">{{d.l10n.avatar}}</div>
                <div class="col-sm-10 col-xs-12">
                    <div class="update-item-image-setting"
                        data-copy-template
                        data-elm-data='{"urlPost":"/api/post/image/company",
                        "urlPostDel":"/api/post/imagedelete",
                        "imgName":"{{i.db.im}}",
                        "maxSize":"500000",
                        "imgPath":"<?=FOLDERIMAGECOMPANY?>",
                        "module":"company",
                        "ui":"{{u.userinfo.db.id}}",
                        "disabledDelete":"1",
                        "nocol":"1",
                        "itemId":"{{i.db.id}}"}'
                        data-view-template=".update-item-image-setting"
                        data-template-id="entryItemImageSetting">
                    </div>
                </div>

        </div>

        <div class="form-group">
                <div class="col-sm-2 col-xs-12 form-control-setting">{{d.l10n.coverphoto}}</div>
                <div class="col-sm-10 col-xs-12">
                    <div class="update-banner-image-setting"
                        data-copy-template
                        data-elm-data='{"urlPost":"/api/post/image/companybanner",
                        "urlPostDel":"/api/post/imagedelete",
                        "imgName":"{{i.companybanner}}",
                        "maxSize":"2000000",
                        "imgPath":"<?=FOLDERIMAGECOMPANY?>",
                        "module":"banner",
                        "ui":"{{u.userinfo.db.id}}",
                        "disabledDelete":"1",
                        "nocol":"1",
                        "itemId":"{{i.db.id}}"}'
                        data-view-template=".update-banner-image-setting"
                        data-template-id="entryItemImageSetting">
                    </div>
                </div>

        </div>
        {{/if}}

        {{/if}}


        <div class="form-group facebook-autocomplete hidden">
            <div class="col-sm-2 col-xs-12 form-control-setting">{{d.l10n.avatar}}</div>
            <div class="col-sm-10 col-xs-12">
                <div class="update-item-image-setting">
                    <div class="image-preview transition b-r-4 b-cover v-center ">
                        <img class="img-responsive" src="">
                        <input 
                            type="hidden"
                            name="fb.im"
                            value="" />
                    </div>
                </div>
            </div>    
        </div>

        <div class="form-group facebook-autocomplete hidden">
            <div class="col-sm-2 col-xs-12 form-control-setting">{{d.l10n.coverphoto}}</div>
            <div class="col-sm-10 col-xs-12">
                <div class="update-banner-image-setting">
                    <div class="image-preview transition b-r-4 b-cover v-center banner-setting">
                        <img class="img-responsive"  src="">
                        <input 
                            type="hidden"
                            name="fb.im_banner"
                            value="" />
                    </div>
                </div>
            </div>    
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label">
                {{d.l10n.pageName}} <span class="require">*</span>
            </label>
            <div class="col-sm-10 col-xs-12">
              <div class="form-control-static" data-key="db.name">{{i.db.name}}</div>
              <div class="edit-show">
                  <input type="text"
                    name="db.name"
                    data-validate
                    data-required="{{d.l10n.require}}"
                    value="{{i.db.name}}"
                    class="form-control">
                    <span class="error"></span>

              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label">
                {{d.l10n.pageUrl}} <span class="require">*</span>
            </label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-control-static c-list">
                   <i class="fa fa-caret-up text-color1"></i> {{d.l10n.siteurl}}{{i.db.url}}
                </div>
                <div class="edit-show">
                    <div class="">
                        <div class="col-sm-2 col-xs-4" style="padding:0 20px 0 0">
                            <span class="btn p-r-10 add-link">www.thue.today/</span>
                        </div>
                        <div class="col-sm-10 col-xs-8" style="padding-right:0">
                            <input  type="text"
                                name="db.url"
                                value="{{i.db.url}}"
                                data-validate
                                data-required="{{d.l10n.require}}"
                                data-server="<?=APIPOSTURL?>"
                                data-min-length="6"
                                data-pattern="^((?![/,\,<,>,[ ]).)*$"
                                {{#if i.db.id}}
                                data-params='{"cid":"{{i.db.id}}", "uid":"{{u.userinfo.db.id}}"}'
                                {{else}}
                                data-params='{"cid":"-1", "uid":"{{u.userinfo.db.id}}"}'
                                {{/if}}
                                data-key = "url"
                                class="form-control">
                            <span class="error">{{d.l10n.minUrlError}}</span>
                            <span class="t-s-11">{{d.l10n.minUrl}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label">
            {{d.l10n.jobCategories}} <span class="require">*</span>
            </label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-control-static c-list">
                    {{{textFromDropdownLocal i.db.category 'menuList' ''}}}
                </div>
                <div data-checkbox-validate class="edit-show">
                    {{#each dropdown.menuStructure}}
                        {{#xif ' this.opp == 3 '}}
                        <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../i.db.category this.id}}">
                            <input class="b-r-4"
                                   name="db.category.{{this.id}}"
                                   type="checkbox"
                                   data-key-name="db.category"
                                   {{checkboxValue ../../i.db.category this.id}}
                                   value="{{this.id}}">
                            <span class="checkbox-style"></span>
                            <span class="tx">{{this.ti}}</span>
                        </div>
                        {{/xif}}
                    {{/each}}
                    <span class="error">{{d.l10n.require}}</span>
                </div>
            </div>
        </div>

        <div class="form-group hidden">
            <label class="col-sm-2 col-xs-12 control-label">{{d.l10n.companySize}}</label>
            <div class="col-sm-10 col-xs-12">
                <p class="form-control-static">
                    <span>{{{textFromDropdownLocal i.db.size 'companySize' 'id' 'ti'}}}</span>
                </p>
                <span class="select-wrapper">
                <select
                    class="form-control"
                    name="db.size"
                    type="select"
                    data-dropdown
                    data-index-value="{{i.db.size}}"
                    data-option-local-json="companySize">
                </select>
                </span>
            </div>
        </div>

        <div class="form-group edit-show">
            <label class="col-sm-2 col-xs-12 control-label">{{d.l10n.phone}}</label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-control-static">{{i.db.phone}}</div>
                <input type="text"
                    class="form-control"
                    name="db.phone"
                    value="{{i.db.phone}}"
                    data-min-length="2"
                    data-required="{{d.l10n.requirePhone}}"
                    data-pattern="^[0-9-+\s().]*$" data-min-length="9" data-max-length="20"
                    data-pattern-message="{{d.l10n.requirePhoneRule}}">
                <span class="error"></span>
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label">{{d.l10n.mainaddress}} <span class="require">*</span></label>
            <div class="col-sm-6 col-xs-12">
                <p class="form-control-static">{{i.db.address}}, {{#if e.en}} {{i.db.district_text_en}}, {{else}} {{i.db.district_text_vi}} {{/if}} {{{textFromDropdownLocal i.db.city 'location' 'id' 'ti'}}}</p>
                <div class="form-group p-l-r-10 no-m-bottom">
                    <input type="text"
                        id="autocomplete"
                        name="db.address"
                        value="{{i.db.address}}"
                        class="form-control"
                        data-validate
                        placeholder="{{d.l10n.optAddress}}"
                        data-required="{{d.l10n.require}}">

                    <span class="error">{{d.l10n.require}}</span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group p-l-r-10 no-m-bottom">
                    <span class="select-wrapper">
                    <select name="db.city"
                        data-validate
                        data-required="{{d.l10n.require}}"
                        data-dropdown
                        data-index-value="{{#if i.db.city}}{{i.db.city}}{{else}}30{{/if}}"
                        data-object-init='{"id":"", "ti":"{{d.l10n.optCountry}}"}'
                        data-option-local-json="location"
                        class="form-control">
                        <option value="">{{d.l10n.optCoutry}}</option>
                    </select>
                    </span>
                    <span class="error">{{d.l10n.require}}</span>
                </div>
            </div>
        </div>

        {{#if i.db.id}}
        <div class="form-group">
            <label class="col-sm-2">{{d.l10n.address}}</label>

            <div class="col-sm-10">
                <div class="item-view-location"
                    data-view-list-by-handlebar
                    data-init-button-magic=".item [data-button-magic]"
                    data-url="<?=APIGETCOMPANY;?>/{{i.db.id}}/location/{{u.userinfo.db.id}}"
                    data-method="get"
                    data-show-page="10"
                    data-show-item="20"
                    data-show-all="false"
                    data-scroll-view="false"
                    data-template-id="viewItemCmpLocation" >
                    <div class="view-items" data-content><div class="style-loadding">...</div></div>
                </div>

                <span class="btn bg-color1 add_location input-sm"
                    data-button-magic
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item1]"
                    data-elm-data='{"company_id":"{{i.db.id}}"}'
                    data-template-id="entryUserFormCmpLocation"><i class="fa fa-plus"></i> <span>{{d.l10n.btnAddAddress}}</span></span>
            </div>
        </div>
        {{/if}}

        <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label">
                {{d.l10n.website}}
            </label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-control-static">{{i.db.website}}</div>
                <input type="text"
                    class="form-control"
                    name="db.website"
                    value="{{i.db.website}}">
                <span class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label">
                Facebook
            </label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-control-static">{{i.db.facebook}}</div>
               
                <div class="edit-show">
                    <div class="row">
                        
                        <div class="col-sm-12">
                            <input type="text"
                                class="form-control"
                                name="db.facebook"
                                value="{{i.db.facebook}}">
                            <span class="error"></span>
                            <span class="t-s-11">{{d.l10n.facebookEg}}</span>
                        </div>
                    </div>
                </div>    
            </div>
        </div>

        <div class="form-group edit-show {{#if i.db.id }}{{else}}hidden{{/if}}">
            <label class="col-sm-2 col-xs-12 control-label">
            </label>
            <div class="col-sm-10 col-xs-12">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <label class="checkbox">
                            <input name="db.fb_load_newfeed"
                                   type="checkbox"
                                   {{#if i.db.fb_load_newfeed}}
                                   {{#xif ' this.i.db.fb_load_newfeed == 1 '}}
                                   checked="checked"
                                   {{/xif}}
                                   {{/if}}
                                   value="1">
                            <span class="checkbox-style"></span>&nbsp;&nbsp;&nbsp;
                            <span> {{d.l10n.loadFacebookNewfeed}}</span>
                        </label>
                        <span class="error"></span>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <label class="checkbox">
                            <input name="db.fb_load_photo"
                                   type="checkbox"
                                   {{#if i.db.fb_load_newfeed}}
                                   {{#xif ' this.i.db.fb_load_photo == 1 '}}
                                   checked="checked"
                                   {{/xif}}
                                   {{/if}}
                                   value="1">
                            <span class="checkbox-style"></span>&nbsp;&nbsp;&nbsp;
                            <span> {{d.l10n.loadFacebookPhoto}}</span>
                        </label>
                        <span class="error"></span>

                   </div>
                </div>
            </div>
        </div>


        {{#if e.create}}
        <div class="form-group emp-info">
            <label class="col-sm-2 control-label text-left">{{d.l10n.aboutus}}</label>
            <div class="col-sm-10">
                <div class="form-control-static">{{{i.more.about}}}</div>
                <div class="edit-show">
                    <textarea type="text"
                        name="more.about"
                        data-required="{{d.l10n.require}}"
                        class="form-control more">{{i.more.about}}</textarea>
                    <span class="error"></span>
                </div>
            </div>
        </div>

        <div class="form-group emp-info hidden">
            <label class="col-sm-2 control-label text-left">{{d.l10n.workWithUs}}</label>
            <div class="col-sm-10">
                <div class="form-control-static">{{{i.more.whyworkus}}}</div>
                <div class="edit-show">
                    <textarea type="text"
                        name="more.whyworkus"
                        data-required="{{d.l10n.require}}"
                        class="form-control more">{{i.more.whyworkus}}</textarea>
                    <span class="error"></span>
                </div>
            </div>
        </div>

        {{/if}}



        <div class="form-group">
            {{#if e.create}}
                <div class="btn-action">
                    <div class="action-content">
                        <div class="col-xs-12 text-right">

                            <div class="edit-show">

                                <a href="<?=$seo_name["page"]["user"]?>?manage=pagecmp" class="btn bg-color7 text-uppercase"><i class="fa fa-times"></i> {{d.l10n.btnCancel}}</a>
                                <button type="reset"
                                    class="btn bg-color5 text-uppercase">
                                  <i class="fa fa-eraser"></i>  {{d.l10n.btnClear}}
                                </button>    

                                <button type="submit"
                                    class="btn bg-color1 text-uppercase"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTCOMPANY?>"
                                    {{#if e.triggerClick}}
                                    data-trigger-click="{{e.triggerClick}}"
                                    {{/if}}
                                    {{#if e.urlRedirect}}
                                    data-redirect= "{{e.urlRedirect}}"
                                    {{/if}}
                                    data-show-success=".alert-footer.alert"
                                    data-show-errors=".alert-footer.alert-error"
                                    value="{{d.l10n.btnSave}}">
                                <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            {{else}}
                <div class="col-xs-12">
                    <div class="form-control-static profile-edit-button">
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            class="btn bg-color4 text-uppercase"><i class="fa fa-pencil"></i> </span>
                    </div>
                    <div class="edit-show">
                        <button type="submit"
                          class="btn bg-color1 text-uppercase"
                          data-button-magic
                          data-params-form=".post-form"
                          data-format-json="true"
                          data-ajax-url="<?=APIPOSTCOMPANY?>"
                          {{#if e.triggerClick}}
                          data-trigger-click="{{e.triggerClick}}"
                          {{/if}}
                          {{#if e.urlRedirect}}
                          data-redirect= "{{e.urlRedirect}}"
                          {{/if}}
                          data-show-success=".alert-footer.alert"
                          data-show-errors=".alert-footer.alert-error"
                          value="{{d.l10n.btnSave}}">
                        <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span>
                        </button>
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            class="btn bg-color7 text-uppercase"><i class="fa fa-times"></i> {{d.l10n.btnCancel}}</span>
                    </div>
                </div>
            {{/if}}

        </div>
    </form>
</script>

<script id="entryUserFormEducation" type="text/x-handlebars-template">
    <form class="post-form form-horizontal modal-dialog popup-history">
        <div class="modal-content">
            <div class="modal-header">
                <div class="hidden">
                    <input type="text" name="updateNode" value="education">
                    <input type="text" name="db.id" value="{{u.userinfo.db.id}}">
                    <input type="text" name="education.id" value="{{i.id}}">
                </div>
                <div class="title">
                    <h3 class="text-color2">{{d.l10n.educationHistory}}</h3>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"></span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.schoolName}}
                    </label>
                    <div class="col-sm-9">
                        <input type="text"
                            name="education.school"
                            value="{{i.school}}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.degrees}}
                    </label>
                    <div class="col-sm-9">
                        <input type="text"
                            name="education.degrees"
                            class="form-control"
                            value="{{i.degrees}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.fieldofstudy}}
                    </label>
                    <div class="col-sm-9">
                        <input type="text"
                            name="education.fieldofstudy"
                            class="form-control"
                            value="{{i.fieldofstudy}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 hidden-xs"></label>
                    <label class="col-sm-1">
                        {{d.l10n.from}}
                    </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control"
                            name="education.from"
                            value="{{i.from}}"
                            placeholder="{{d.l10n.from}}"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            data-format="YYYY"
                            data-show-dropdowns="true">
                    </div>
                    <label class="col-sm-1">
                        {{d.l10n.to}}
                    </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control"
                            name="education.to"
                            placeholder="{{d.l10n.to}}"
                            value="{{i.to}}"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            data-format="YYYY"
                            data-show-dropdowns="true">

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit"
                      class="btn bg-color1 text-uppercase"
                      data-button-magic
                      data-params-form=".post-form"
                      data-format-json="true"
                      data-ajax-url="<?=APIPOSTUSEREDIT?>"
                      data-show-success=".alert-footer.alert"
                      data-show-errors=".popup.signin-missing-session"
                      data-show-hide=".alert, [data-quick-view-item1]"
                      data-refress-list=".item-view-education"
                      value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>

                    <span data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"
                            class="btn bg-color5 text-uppercase">{{d.l10n.btnCancel}}</span>


            </div>
        </div>
    </form>
</script>
<script id="entryUserFormExperience" type="text/x-handlebars-template">
    <form class="post-form form-horizontal modal-dialog popup-history">
        <div class="modal-content">
            <div class="modal-header">
                <div class="hidden">
                    <input type="text" name="updateNode" value="experience">
                    <input type="text" name="db.id" value="{{u.userinfo.db.id}}">
                    <input type="text" name="experience.id" value="{{i.id}}">
                </div>
                <div class="title">
                    <h3 class="text-color2">{{d.l10n.employmentHistory}}</h3>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"></span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.jobTitle}}
                    </label>
                    <div class="col-sm-8">
                        <input type="text"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            name="experience.title"
                            placeholder="{{d.l10n.typeYourPositionHere}}"
                            class="form-control"
                            value="{{i.title}}">
                    </div>
                </div>

                <div class="form-group hidden">
                    <label class="col-sm-3">
                        {{d.l10n.jobLevel}}
                    </label>
                    <div class="col-sm-8">
                        <select name="experience.level"
                                type="select"
                                data-required="{{d.l10n.require}}"
                                data-dropdown
                                placeholder="{{d.l10n.typeYourPositionHere}}"
                                data-index-value="{{i.level}}"
                                data-option-local-json="jobLevel"
                                data-object-init='{"id":"", "ti":"{{d.l10n.level}}"}'
                                class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.companyName}}
                    </label>
                    <div class="col-sm-8">
                        <input type="text"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            name="experience.cmpname"
                            placeholder="{{d.l10n.requireCmpName}}"
                            class="form-control"
                            value="{{i.cmpname}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 hidden-xs"></label>
                    <label class="col-sm-1">
                        {{d.l10n.city}}
                    </label>
                    <div class="col-sm-3">
                        <input type="text"
                            name="experience.city"
                            class="form-control"
                            value="{{i.city}}">
                    </div>
                    <label class="col-sm-1">
                        {{d.l10n.country}}
                    </label>
                    <div class="col-sm-3">
                        <input type="text"
                            name="experience.country"
                            class="form-control"
                            value="{{i.country}}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 hidden-xs"></label>
                    <label class="col-sm-1">
                        {{d.l10n.from}}
                    </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"
                            name="experience.from"
                            value="{{i.from}}"
                            placeholder="{{d.l10n.from}}"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            data-format="YYYY"
                            data-single-date-picker="true"
                            data-show-dropdowns="true">
                    </div>
                    <label class="col-sm-1">
                        {{d.l10n.to}}
                    </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"
                            name="experience.to"
                            value="{{i.to}}"
                            placeholder="{{d.l10n.to}}"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            data-format="YYYY"
                            data-single-date-picker="true"
                            data-show-dropdowns="true">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit"
                      class="btn bg-color1 text-uppercase"
                      data-button-magic
                      data-params-form=".post-form"
                      data-format-json="true"
                      data-ajax-url="<?=APIPOSTUSEREDIT?>"
                      data-show-hide=".alert, [data-quick-view-item1]"
                      data-refress-list=".item-view-experience"
                      data-show-errors=".popup.signin-missing-session"
                      value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>

                 <span data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"
                            class="btn bg-color5 text-uppercase">{{d.l10n.btnCancel}}</span>

            </div>
        </div>
    </form>
</script>
<script id="viewItemWorkExperience" type="text/x-handlebars-template">
    <div class="item item-history b-r-4">
        <div class="row">
            <div class="col-xs-9">
                <p>{{i.title}}</p>
                <p><strong class="text-color2">{{i.cmpname}}</strong> - <span class="t-s-12 text-italic">{{i.city}}</span></p>
                <p class="t-s-12 text-color4">{{i.from}} - {{i.to}}</p>
            </div>
            <div class="col-xs-3">
                <div class="text-right">
                {{#unless e.onlyView}}
                    <span class="btn"
                        data-button-magic
                        data-method="get"
                        data-ajax-url="<?=APIGETUSERINFO?>/{{u.userinfo.db.id}}/experience/{{i.id}}"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="entryUserFormExperience"><i class="fa fa-pencil"></i> <span>{{d.l10n.btnEdit}}</span></span>
                    <span class="btn"
                        data-button-magic
                        data-confirm="true"
                        data-confirm-content="{{d.l10n.confirmDeleteContent}}"
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                        data-params='{"db":{"id":"{{u.userinfo.db.id}}"} , "updateNode":"experience", "experience":{"del":"{{i.id}}"} }'
                        data-refress-list=".item-view-experience"><i class="fa fa-trash-o"></i> <span>{{d.l10n.btnDelete}}</span> </span>
                 {{/unless}}
                </div>

            </div>
        </div>
    </div>
</script>
<script id="viewItemWorkEducation" type="text/x-handlebars-template">
    <div class="item item-history b-r-4">
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                <p>{{i.fieldofstudy}}</p>
                <p><strong class="text-color2">{{i.school}}</strong> - <span class="t-s-12 text-italic">{{i.degrees}}</span></p>
                <p class="t-s-12"><strong>{{i.from}}</strong> - <strong>{{i.to}}</strong></p>
            </div>

            <div class="col-sm-3 col-xs-12">
                <div class="text-right">
                 {{#unless e.onlyView}}

                    <span class="btn"
                        data-button-magic
                        data-method="get"
                        data-ajax-url="<?=APIGETUSERINFO?>/{{u.userinfo.db.id}}/education/{{i.id}}"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="entryUserFormEducation"><i class="fa fa-pencil"></i> <span>{{d.l10n.btnEdit}}</span> </span>
                    <span class="btn"
                        data-button-magic
                        data-confirm="true"
                        data-confirm-content="{{d.l10n.confirmDeleteContent}}"
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                        data-params='{"db":{"id":"{{u.userinfo.db.id}}"} , "updateNode":"education", "education":{"del":"{{i.id}}"} }'
                        data-refress-list=".item-view-education"><i class="fa fa-trash-o"></i> <span>{{d.l10n.btnDelete}}</span> </span>
                {{/unless}}
                </div>
            </div>
        </div>
    </div>
</script>

<script id="viewItemCmpLocationSelect" type="text/x-handlebars-template">
<div class="col-xs-6 col-sm-4">
    <div class="relative">
        <label class="w-100">
            
            <input  data-required 
                    type="radio"
                    {{#if e.location_id}}
                    {{#xif ' this.e.location_id == this.i.id '}}
                    checked
                    {{/xif}}
                    {{/if}}
                    name="db.location_id" value="{{i.id}}">  
            
            <div lo="{{i.city}}" lat="{{i.lat}}" lng="{{i.lat}}" class="location-select b-r-4 m-b-10">        
                <p class="text-bold short-text">{{i.location_name}}</p>
                <p class="t-s-12 text-color4 short-text text-italic"><i class="fa fa-map-marker text-color4 t-s-12"></i> {{i.address}}, {{{textFromDropdownLocal i.city 'location' 'id' 'ti'}}}</p>
            </div>
            
        </label>
    </div>
</div>  
</script>

<script id="viewItemCmpLocationStatic" type="text/x-handlebars-template">
<div class="item item-history item-cmp-location no-padding no-bg no-border">
    <div class="row">
        <div class="col-xs-9">
            <p class="text-bold">{{i.location_name}}</p>
            <p class="t-s-12 text-color4"><i class="fa fa-map-marker t-s-12 text-color4"></i> {{i.address}}, {{{textFromDropdownLocal i.city 'location' 'id' 'ti'}}}</p>
        </div>
    </div>
</div>        
</script>

<script id="viewItemCmpLocation" type="text/x-handlebars-template">
    <div class="item item-history item-cmp-location b-r-4">
        <div class="row">
            <div class="col-xs-9">
                <p><span class="text-bold">{{i.location_name}}</span> - <span class="text-italic text-color4 t-s-12"><i class="fa fa-map-marker"></i> {{i.address}}, {{{textFromDropdownLocal i.city 'location' 'id' 'ti'}}}</span></p>
            </div>

            <div class="col-xs-3 text-right t-s-12">
                <div class="text-right text-color4 action-button">
                 {{#unless e.onlyView}}

                    <span class="btn edit_location"
                        data-button-magic
                        data-method="get"
                        data-elm-data='{"company_id":"{{i.company_id}}"}'
                        data-ajax-url="<?=APIGETCOMPANY?>/{{i.company_id}}/location/{{u.userinfo.db.id}}/{{i.id}}"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="entryUserFormCmpLocation"><i class="fa fa-pencil"></i> <span> {{d.l10n.btnEdit}}</span> </span>
                    
                    <span class="btn"
                        data-confirm="true"
                        data-confirm-content="{{d.l10n.confirmDeleteContent}}"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTCOMPANY?>"
                        data-params='{"db":{"ui":"{{u.userinfo.db.id}}"} , "updateNode":"location", "location":{"del":"{{i.id}}","company_id":"{{i.company_id}}"} }'
                        data-refress-list=".item-view-location"><i class="fa fa-trash-o"></i> <span> {{d.l10n.btnDelete}}</span> </span>
               
                {{/unless}}
                </div>
            </div>
        </div>

    </div>
</script>

<script id="entryUserMenuAction" type="text/x-handlebars-template">
   {{#if u.userinfo}}

   {{#xif ' this.u.userinfo.db.type == 2 '}}

      <div class="user-menu-action"
                data-elm-data='{"{{#if e.applyjob}}applyjob{{else}}savejob{{/if}}":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuSetting"></div>

    {{else}}

      <div class="block-hori">
          <ul>
              <li class="{{#if e.userapply }}active{{/if}}">
                  <a href="<?="/{$seo_name["page"]["user"]}"?>?manage=userapply">
                      {{d.l10n.all}} (<span class="text-bold">{{#xif " e.totalapp == 0 " }}0{{else}}{{e.totalapp}}{{/xif}}</span>)
                  </a>
              </li>

              <li class="{{#if e.usersave }}active{{/if}}">
                  <a href="<?="/{$seo_name["page"]["user"]}"?>?manage=usersave">
                      {{d.l10n.btnLike}} (<span class="text-bold">{{#xif " e.totalsaved == 0 " }}0{{else}}{{e.totalsaved}}{{/xif}}</span>)
                  </a>
              </li>
              <li class="{{#if e.interview}}active{{/if}}">
                  <a href="<?="/{$seo_name["page"]["user"]}"?>?manage=interview" class="">
                      {{d.l10n.btnInterview}} (<span class="text-bold">{{#xif " e.totalinterview == 0 " }}0{{else}}{{e.totalinterview}}{{/xif}}</span>)
                  </a>
              </li>
              <li class="{{#if e.hire}}active{{/if}}">
                  <a href="<?="/{$seo_name["page"]["user"]}"?>?manage=hire" class="">
                      {{d.l10n.btnHire}} (<span class="text-bold">{{#xif " e.totalhire == 0 " }}0{{else}}{{e.totalhire}}{{/xif}}</span>)
                  </a>
              </li>
              <li class="{{#if e.deny}}active{{/if}}">
                  <a href="<?="/{$seo_name["page"]["user"]}"?>?manage=deny" class="">
                      {{d.l10n.btnDeny}} (<span class="text-bold">{{#xif " e.totaldeny == 0 " }}0{{else}}{{e.totaldeny}}{{/xif}}</span>)
                  </a>
              </li>
          </ul>
      </div>

      {{/xif}}
{{/if}} 
</script>

<script id="entryCmpUserApplied" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">

            <div class="user-menu-action"
                data-elm-data='{"userapply":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuAction"></div>

            <div class="block-search-advance m-t-15"
                data-copy-template
                {{#if e.viewCV}}
                data-elm-data='
                    {"submitUrl":"/<?=$seo_name["page"]["user"]?>?manage=usersave"
                }'
                {{/if}}
                data-view-template=".block-search-advance"
                data-template-id="entryUserSearchAdvance">
            </div>
        </div>

        <div class="col-sm-9">
            {{#if e.viewCV}}
                <div class="view-cv-detail"
                    data-option-local="cvDetail"
                    data-copy-template
                    data-view-template=".view-cv-detail"
                    data-template-id="entryCvView">
                </div>
            {{else}}
            <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETUSERACTION;?>"
                data-params="uid={{u.userinfo.db.id}}&action=userapply"
                data-elm-data='{
                    "userapply":"1", "userManageAction":"1",
                    "linkMore":"<?=$seo_name["page"]["user"]?>?manage=userapply&"
                }'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".filter-form"
                data-is-reload-page="true"
                data-reload-base-on-id="ui"
                data-reload-base-set-params="listID"
                data-reload-url="<?=APIGETUSERLISTID?>"
                data-template-id="entryCvItemAction" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div class="no-data">
                    <div class="no-data-content">{{d.l10n.noDataFound}}</div>
                </div>
                <div data-footer></div>
            </div>
            {{/if}}
        </div>
    </div>
</script>

<script id="entryCmpUserSaved" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                data-elm-data='{"usersave":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuAction">
            </div>
            <div class="block-search-advance m-t-15"
                data-copy-template
                {{#if e.viewCV}}
                data-elm-data='{"submitUrl":"/<?=$seo_name["page"]["user"]?>?manage=usersave"}'
                {{/if}}
                data-view-template=".block-search-advance"
                data-template-id="entryUserSearchAdvance">
            </div>
        </div>
        <div class="col-sm-9">
            {{#if e.viewCV}}
                <div class="view-cv-detail"
                    data-option-local="cvDetail"
                    data-copy-template
                    data-view-template=".view-cv-detail"
                    data-template-id="entryCvView">
                </div>
            {{else}}
            <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETUSERACTION;?>"
                data-params="uid={{u.userinfo.db.id}}&action=usersave"
                data-elm-data='{
                    "usersave":"1",
                    "linkMore":"<?=$seo_name["page"]["user"]?>?manage=usersave&"
                }'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".filter-form"
                data-is-reload-page="true"
                data-reload-base-on-id="ui"
                data-reload-base-set-params="listID"
                data-reload-url="<?=APIGETUSERLISTID?>"
                data-template-id="entryCvItemAction" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div class="no-data">
                    <div class="no-data-content">{{d.l10n.noDataFound}}</div>
                </div>
                <div data-footer></div>
            </div>
            {{/if}}
        </div>
    </div>
</script>

<script id="entryCmpUserDenied" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                data-elm-data='{"userdeny":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuAction"></div>
            <div class="block-search-advance m-t-15"
                data-copy-template
                {{#if e.viewCV}}
                data-elm-data='{"submitUrl":"/<?=$seo_name["page"]["user"]?>?manage=usersave"}'
                {{/if}}
                data-view-template=".block-search-advance"
                data-template-id="entryUserSearchAdvance">
            </div>
        </div>
        <div class="col-sm-9">
            <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETUSERACTION;?>"
                data-params="uid={{u.userinfo.db.id}}&action=userdeny"
                data-elm-data='{
                    "userdeny":"1",
                    "linkMore":"<?=$seo_name["page"]["user"]?>?manage=userdeny&"
                }'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-object-reverse="true"
                data-is-reload-page="true"
                data-reload-base-on-id="ui"
                data-reload-base-set-params="listID"
                data-reload-url="<?=APIGETUSERLISTID?>"
                data-template-id="entryCvItemAction" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
        </div>
    </div>
</script>

<script id="entryCmpUserHired" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                data-elm-data='{"userhire":"1"}'
                data-copy-template
                data-view-template=".user-menu-action"
                data-template-id="entryUserMenuAction"></div>
        </div>
        <div class="col-sm-9">
            <div class="item-view-more m-t-15"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETUSERACTION;?>"
                data-params="uid={{u.userinfo.db.id}}&action=userhire"
                data-elm-data='{
                    "userhire":"1",
                    "userManageAction":"1",
                    "linkMore":"<?=$seo_name["page"]["user"]?>?manage=userdeny&"
                }'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-object-reverse="true"
                data-is-reload-page="true"
                data-reload-base-on-id="ui"
                data-reload-base-set-params="listID"
                data-reload-url="<?=APIGETUSERLISTID?>"
                data-template-id="entryCvItemAction" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
        </div>
    </div>
</script>

<script id="viewItemCmpAction" type="text/x-handlebars-template">
Action {{elmData}}
</script>
<script id="entryUserManageJobsave" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-object-init="jobSaved"
        data-url="<?=APIGETUSERACTION;?>"
        data-params="uid={{u.userinfo.db.id}}&action=savejob"
        data-elm-data='{"savejob":"1"}'
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-is-reload-page="true"
        data-reload-base-on-id="jo"
        data-reload-base-set-params="listID"
        data-reload-url="<?=APIGETJOBLISTID?>"
        data-template-id="viewItemJobAction" >
        <div class="row">
            <div class="col-sm-9">

                <div class="job-header-search"
                     data-copy-template
                     data-elm-data='{"tabName":"{{d.l10n.jobFavorited}}","submitUrl":"{{e.submitUrl}}"}'
                     data-view-template=".job-header-search"
                     data-template-id="jobSearchAdvance"></div>

                <div class="view-items" data-content><div class="style-loadding">...</div></div>

                <div class="no-data">
                    <div class="no-data-content">{{d.l10n.noSaveJobContent}}</div>
                </div>

                <div data-footer></div>
            </div>
            <div class="col-sm-3">
                <div class="user-menu-action"
                    data-elm-data='{"savejob":"1"}'
                    data-copy-template
                    data-view-template=".user-menu-action"
                    data-template-id="entryUserMenuAction"></div>
            </div>
        </div>
    </div>
</script>
<script id="entryUserManageJobapply" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-object-init="jobApplied"
        data-url="<?=APIGETUSERACTION;?>"
        data-params="uid={{u.userinfo.db.id}}&action=applyjob"
        data-elm-data='{"applyjob":"1"}'
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-object-reverse="true"
        data-is-reload-page="true"
        data-reload-base-on-id="jo"
        data-reload-base-set-params="listID"
        data-reload-url="<?=APIGETJOBLISTID?>"
        data-template-id="viewItemJobAction" >
        <div class="row">
            <div class="col-sm-9">

                <div class="job-header-search"
                     data-copy-template
                     data-elm-data='{"tabName":"{{d.l10n.jobApplied}}","submitUrl":"{{e.submitUrl}}"}'
                     data-view-template=".job-header-search"
                     data-template-id="jobSearchAdvance"></div>

                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div class="no-data">
                    <div class="no-data-content">{{d.l10n.noAppliedJobContent}}</div>
                </div>
                <div data-footer></div>
            </div>
            <div class="col-sm-3">
                <div class="user-menu-action"
                    data-elm-data='{"applyjob":"1"}'
                    data-copy-template
                    data-view-template=".user-menu-action"
                    data-template-id="entryUserMenuAction"></div>
            </div>
        </div>
    </div>
</script>

<script id="entryCmpInfoSide" type="text/x-handlebars-template">
    <div class="block-content">
        <div class="cmp-logo m-b-10">
            <div class="img-p"
                style="background:url('/<?=FOLDERIMAGEUSER?>{{i.userinfo.db.im}}') no-repeat;
                -webkit-background-size: cover;
                -o-background-size: cover;
                background-size: cover;?>"> &nbsp; </div>
        </div>

        <label class="text-color1 t-s-19 no-margin">{{i.userinfo.db.name}}</label>
        <div class="m-b-20">
            <label class="no-margin text-color1">{{d.l10n.companySize}}</label>
            <p>{{{textFromDropdownLocal i.userinfo.db.size 'companySize' 'id' 'ti'}}}</p>
        </div>
        <div class="m-b-20">
            <label class="no-margin text-color1">{{d.l10n.address}}</label>
            <p>{{i.userinfo.db.address}} - {{{textFromDropdownLocal i.userinfo.db.city 'location' 'id' 'ti'}}}</p>
        </div>
        <div class="m-b-20">
            <label class="no-margin text-color1">{{d.l10n.email}}</label>
            <p>{{i.userinfo.db.email}}</p>
        </div>
        <div class="m-b-20">
            <label class="no-margin text-color1">{{d.l10n.phone}}</label>
            <p>{{i.userinfo.db.phone}}</p>
        </div>
        {{#if i.userinfo.db.website}}
        <div class="m-b-20">
            <label class="no-margin text-color1">{{d.l10n.website}}</label>
            <p class="short-text"><a target="b_lank" href="{{i.db.website}}">{{i.userinfo.db.website}}</a></p>
        </div>
        {{/if}}
        {{#if i.userinfo.db.facebook}}
        <div class="m-b-20">
            <label class="no-margin text-color1">Facebook</label>
            <p class="short-text"><a target="b_lank" href="{{i.userinfo.db.facebook}}">{{i.userinfo.db.facebook}}</a></p>
        </div>
        {{/if}}
        {{#xif " this.i.userinfo.db.id==this.u.userinfo.db.id "}}
            <a href="/{{i.userinfo.db.username}}#default=null&tab=1" class="btn btn-block bg-color3 text-uppercase btn-save transition">{{d.l10n.btnEdit}}</a>
        {{else}}
            <a href="/{{i.userinfo.db.username}}" class="btn btn-block bg-color3 text-uppercase btn-save transition">{{d.l10n.viewMore}}</a>
        {{/xif}}
    </div>
</script>

<script id="entryCmpPageListBigBox" type="text/x-handlebars-template">
{{#each dropdown.yourCompany}}
<div class="item b-r-4">
    <div class="row">
       <div class="col-sm-2">
            {{#if ../e.setting}}
                <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&setting=info&pid={{this.id}}">
            {{else}}
                <a href="/{{this.url}}">
            {{/if}}
                {{#if this.im}}
                <img alt="{{this.name}}" class="image-load b-r-4" src="/<?=FOLDERIMAGECOMPANY?>{{this.im}}" >
                {{else}}
                <img alt="{{this.name}}" class="image-load b-r-4" src="/media/images/style/user.png" >
                {{/if}}
            </a>
       </div>
       <div class="col-sm-9">
            <div class="content">
                    <p class="t-s-21 m-t-5">
                        <span class="text-bold text-color1">{{this.name}} </span>
                        <span class="c-list t-s-12"> - {{{textFromDropdownLocal this.category 'menuList' ''}}}</span>
                        <span class="t-s-12"> - {{{textFromDropdownLocal this.city 'locationOption' ''}}}</span>
                    </p>
                    <p class=""><i class="fa fa-caret-up t-s-1"></i>{{{../d.l10n.siteurl}}}{{this.url}}</p>
                    <p class=""><i class="fa fa-map-marker"></i>
                        {{this.address}},

                        {{#if ../e.en}}
                            {{this.district_text_en}}
                        {{else}}
                            {{this.district_text_vi}}
                        {{/if}}

                        , {{{textFromDropdownLocal this.city 'locationOption' ''}}}</p>
                    <p class=""><i class="fa fa-calendar"></i> {{{formatDate this.created '%d-%M-%Y at %H:%m'}}} </p>
                    <p class=""><i class="fa fa-suitcase"></i> {{this.total_job}} {{../d.l10n.jobs}}</p>
                 </a>
            </div>
       </div>
       <div class="col-sm-1">
            <a href="/{{this.url}}" title="{{../d.l10n.siteurl}}{{this.url}}" class="btn bg-color1 m-b-10"><i class="fa fa-caret-up t-s-18"></i></a>

            <a class="btn bg-color5 hidden m-b-10" title="{{../d.l10n.btnUpdate}}" href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&setting=info&pid={{this.id}}">
                <i class="fa fa-suitcase t-s-11"></i>
            </a>

            <a class="btn bg-color4" title="{{../d.l10n.btnUpdate}}" href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&setting=info&pid={{this.id}}">
                <i class="fa fa-pencil"></i>
            </a>



            <div class="fa fa-angle-right hidden transition"></div>
        </div>
    </div>
</div>
{{/each}}
<div class="item b-r-4 col-sm-12 c-center add-div">
    <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&create=1" class="btn form-add btn-add-a-item" data-button-magics="" data-view-template-local="true" data-view-template="[data-quick-view-item]" data-elm-data='{"urlRedirect":"/user?manage=jobs"}' data-template-id="jobsAdd">
        <i class="fa fa-file-o"></i>
        <p class="text-bold text-uppercase"><i class="fa fa-plus"></i> {{d.l10n.createAPage}}</p>
    </a>
</div>
</script>

<script id="entryCmpPageSetting" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-9">
        <div class="pagecmp-b no-m-top">
            <div class="cmp-manage-page">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-uppercase text-bold t-s-16 m-b-15">
                            <span class="t-s-21 text-color1 m-r-10">{{d.l10n.managePages}}</span>
                            <a href="<?=$seo_name["page"]["user"]?>?manage=pagecmp&create=1"
                            class="btn form-add btn-add-a-item bg-color5"
                            data-button-magics=""
                            data-view-template-local="true"
                            data-view-template="[data-quick-view-item]"
                            data-elm-data='{"urlRedirect":"/user?manage=jobs"}'
                            data-template-id="jobsAdd">
                             <i class="fa fa-plus t-s-11 "></i> {{d.l10n.createAPage}}
                            </a>
                        </div>

                        <div class="company-list"
                            data-copy-template
                            data-option-local="yourCompany"
                            data-elm-data='{"create":"1","setting":"1","{{d.l10n.langcode}}":"1"}'
                            data-view-template=".company-list" data-template-id="entryCmpPageListBigBox"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="user-menu-action"
             data-elm-data='{"page":"1"}'
             data-copy-template
             data-view-template=".user-menu-action"
             data-template-id="entryUserMenuSetting"></div>
    </div>
</div>
</script>

<script id="entryCmpCurrentPage" type="text/x-handlebars-template">
    <a href="#">
        {{#if i.db.im}}
            <img alt="{{i.db.name}}" class="image-load b-r-4 " src="/<?=FOLDERIMAGECOMPANY?>{{i.db.im}}" >
        {{else}}
            <img alt="{{i.db.name}}" class="image-load b-r-4 " src="/media/images/style/user.png" >
        {{/if}}

        <span class="t-s-18">{{i.db.name}}</span> <i class="fa fa-angle-right t-s-16"></i>
    </a>
</script>

<script id="entryCmpPageSimpleList" type="text/x-handlebars-template">
    {{#each dropdown.yourCompany}}
    <li>
        <a class="short-text" href="/{{this.url}}">
        {{#if this.im}}
            <img alt="{{this.name}}" class="image-load b-r-4 " src="/<?=FOLDERIMAGECOMPANY?>{{this.im}}" >
        {{else}}
            <img alt="{{this.name}}" class="image-load b-r-4 " src="/media/images/style/user.png" >
        {{/if}}

        <span>{{this.name}}</span>
         </a>
    </li>
    {{/each}}

    {{#unless e.mobile}}
    <li>
        <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&create=1"
            data-button-magics=""
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
            data-elm-data='{"urlRedirect":"/user?manage=jobs"}'
            data-template-id="jobsAdd">
        <i class="fa no-shadow">&nbsp;</i>    <span>{{d.l10n.createAPage}}</span>
        </a>
    </li>
    {{/unless}}
</script>

<script id="entryCmpPageList" type="text/x-handlebars-template">
    <ul>
    {{#each dropdown.yourCompany}}
        <li class="cmp-more text-center">
            <div class="cmp-thumb-box c-center">
                <div class="img">
                    {{#if ../e.postjob}}
                        <a href="/<?=$seo_name["page"]["user"]?>?manage=postjob&pid={{this.id}}">
                    {{else}}
                        <a href="/{{this.url}}">
                    {{/if}}

                        {{#if this.im}}
                            <img alt="{{this.name}}" class="image-load full-width b-r-4 " src="/<?=FOLDERIMAGECOMPANY?>{{this.im}}" >
                        {{else}}
                            <img alt="{{this.name}}" class="image-load full-width b-r-4 " src="/media/images/style/user.png">
                        {{/if}}
                    </a>
                </div>
            </div>
            <div class="title">
                {{#if ../e.postjob}}
                    <a class="t-s-14 text-bold" href="/<?=$seo_name["page"]["user"]?>?manage=postjob&pid={{this.id}}">{{this.name}}</a>
                {{else}}
                    <a class="t-s-14 text-bold"  href="/{{this.url}}">{{this.name}} </a>
                {{/if}}
            </div>
        </li>
    {{/each}}
            <li class="cmp-more text-center bg-color7">
                <div class="cmp-thumb-box c-center">
                    <div class="img">
                        <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&create=1" data-button-magics="" data-view-template-local="true" data-view-template="[data-quick-view-item]" data-elm-data='{"urlRedirect":"/user?manage=jobs"}' data-template-id="jobsAdd">
                            <i class="fa fa-file-o"></i>
                        </a>
                    </div>
                </div>
                <div class="title">
                    <a href="<?=$seo_name["page"]["user"]?>?manage=pagecmp&create=1" data-button-magics="" data-view-template-local="true" data-view-template="[data-quick-view-item]" data-elm-data='{"urlRedirect":"/user?manage=jobs"}' data-template-id="jobsAdd">
                <i class="fa fa-plus t-s-11"></i> {{d.l10n.createAPage}}</p>
            </a>
                </div>
        </li>
        <div class="clearfix"></div>
    </ul>
</script>

<script id="entryCmpEditInfo" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-9">
        <div class="t-s-21 text-bold bg-color7 p-10 b-r-4 p-l-20">{{d.l10n.updateInformation}}</div>
       
        <div class="company-create cmp-more"
            data-copy-template
            data-elm-data='{"create":"1","update":"1"}'
            data-option-local="companyInfomation"
            data-view-template=".company-create" data-template-id="entryCmpUpdateInfo"></div>
            
    </div>
    <div class="col-sm-3">
        <div class="user-menu-action"
             data-elm-data='{"page":"1"}'
             data-copy-template
             data-view-template=".user-menu-action"
             data-template-id="entryUserMenuSetting"></div>
    </div>
</div>
</script>

<script id="entryCmpCreate" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-9">
        <div class="pagecmp-b no-m-top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="t-s-21 text-bold bg-color7 p-10 b-r-4 p-l-20">
                        {{d.l10n.createAPage}}
                        <div class="guidelines pull-right t-s-14">
                            <a  href="#"
                                data-template-id="popupHowtoCreateAPage"
                                data-elm-data='{"youtube":"a0lq9JLlzR8"}'
                                data-view-template="[data-quick-view-item]"
                                data-view-template-local="true"
                                data-button-magic>
                                {{d.l10n.howtocreateapage}}
                            </a>

                            <a  href="#"
                                data-template-id="popupWhatIsPage"
                                data-view-template="[data-quick-view-item]"
                                data-view-template-local="true"
                                data-button-magic>
                                {{d.l10n.whatisapage}}
                            </a>
                        </div>
                    </div>
                    
                    <div class="company-create cmp-more">
                        <div class="form-horizontal">
                        <header class="h-tt text-color5 text-bold t-s-16 p-b-20 text-capitalize">
                        <i class="fa fa-facebook-square text-facebook"></i> {{d.l10n.autoFillCmpFacebookHeader}}
                        </header>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 text-left">
                                {{d.l10n.facebookFanpage}}
                            </label>
                            <div class="col-sm-8 col-xs-12">
                              <div class="edit-show">
                                  <input data-facebook-url type="text"
                                    name="db.facebook"
                                    value=""
                                    placeholder="{{d.l10n.searchFacebookFanpage}}"
                                    class="form-control auto-fill-facebook"
                                    data-placement="bottom"
                                    data-toggle="popover"
                                    data-content="{{{d.l10n.pleaseTypeYourFacebookFanpage}}}"
                                    >
                                    <span class="error">{{d.l10n.require}}</span>
                                    <span class="t-s-11">{{d.l10n.facebookEg}}</span>
                              </div>
                            </div>
                            <div class="col-sm-2">
                                <div id="FbAutocomplete" class="btn bg-color2 text-uppercase btn-block">
                                    <span>{{d.l10n.btnAutoFill}}</span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="cmp-more no-facebook-fanpage text-center">
                        <div class="btn bg-color1">{{d.l10n.idonothavefacebook}}</div>
                    </div>
                    <div class="company-create company-create-info cmp-more"
                        data-copy-template
                        data-elm-data='{"create":"1","update":"1"}'
                        data-view-template=".company-create-info" data-template-id="entryCmpUpdateInfo"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="user-menu-action"
             data-elm-data='{"page":"1"}'
             data-copy-template
             data-view-template=".user-menu-action"
             data-template-id="entryUserMenuSetting"></div>
    </div>
</div>
</script>

<script id="entryPostJobOptionCompany" type="text/x-handlebars-template">
    {{#if e.nopopup}}
        <div class="no-pop-up">
    {{/if}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-30 modal-signin">
                {{#if e.nopopup}}
                    <a class="position-right btn bg-color7 b-r-4" href="/<?=$seo_name["page"]["user"]?>?manage=jobs"><i class="fa fa-times"></i> <span class="hidden-xs">{{d.l10n.btnCancel}}</span></a>
                {{else}}
                    <span class="position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"><i class="fa fa-times-circle"></i></span>
                {{/if}}

                <div class="header t-s-21 text-color1 text-bold text-capitalize b-b m-b-10 p-b-10">{{d.l10n.choosePage}}</div>
                <div class="company-list-post-job"
                    data-copy-template
                    data-elm-data='{"create":"1","update":"1","postjob":"1"}'
                    data-view-template=".company-list-post-job" data-template-id="entryCmpPageList"></div>
            </div>
        </div>
    </div>
    {{#if e.nopopup}}
        </div>
    {{/if}}
</script>

<script id="entryCmpCreateWarning" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                 data-elm-data='{"page":"1"}'
                 data-copy-template
                 data-view-template=".user-menu-action"
                 data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">

            <div class="company-setting cmp-more no-m-top"
                data-copy-template
                data-elm-data='{"create":"1"}'
                data-view-template=".company-setting" data-template-id="entryUserNotifyCreateCmpWarning"></div>

        </div>
    </div>
</script>

<script type="text/x-handlebars-template" id="entryUserNotifyCreateCmpWarning">
    <div class="row expired-container">
        <div class="col-xs-12 col-sm-1"><i class="fa fa-warning text-color3"></i></div>
        <div class="col-xs-12 col-sm-6">
        <h1 class="text-bold">{{d.l10n.pageLimit}}</h1>
        
        {{{d.l10n.contentWarningPageLimt}}}
       
        <a  class="btn bg-color2 text-uppercase text-bold m-t-10" 
            href="/{{d.l10n.employerlink}}">
            {{d.l10n.upgrade}}
        </a> 
    
        </div>
    </div>
</script>

<script id="entryCmpPostJobWarning" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                 data-elm-data='{"page":"1"}'
                 data-copy-template
                 data-view-template=".user-menu-action"
                 data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">

            <div class="company-setting cmp-more no-m-top"
                data-copy-template
                data-elm-data='{"create":"1"}'
                data-view-template=".company-setting" data-template-id="entryUserNotifyWarningPostJob"></div>

        </div>
    </div>
</script>

<script type="text/x-handlebars-template" id="entryUserNotifyWarningPostJob">
    <div class="row expired-container">
        <div class="col-xs-12 col-sm-1"><i class="fa fa-warning text-color3"></i></div>
        <div class="col-xs-12 col-sm-6">
        <h1 class="text-bold">{{d.l10n.limitJobsPost}}</h1>
       
        {{{d.l10n.limitJobsPostWarningContent}}}
        
        <a  class="btn bg-color2 text-uppercase text-bold m-t-10" 
            href="/{{d.l10n.employerlink}}">
            {{d.l10n.upgrade}}
        </a> 
        <a  class="btn bg-color3 text-uppercase text-bold m-t-10" 
            href="/<?=$seo_name["page"]["user"]?>?manage=promoapplied">
            {{d.l10n.ActivationCode}}
        </a>
        </div>
    </div>
</script>

<script id="entryCmpFilterHorizontal" type="text/x-handlebars-template">
<form class="post-formilter header-filter-h filter-form" data-change-to-submit-form-local>
    <div class="filter filter-list">
        <div class="row">
            <div class="col-sm-4">

                <input class="form-control"
                    name="title"
                    data-compare="text in"
                    data-key="na"
                    value=""
                    placeholder="{{d.l10n.placeholderSearchCv}}">
            </div>

            <div class="col-sm-2 form-group">
                <span class="select-wrapper">
                    <select name="ex"
                    class="form-control"
                    data-compare="equal"
                    data-key="e"
                    type="select"
                    data-object-init='{"id":"", "ti":"{{d.l10n.experience}}"}'
                    data-dropdown
                    data-option-local-json="yearOfExperience">
                        <option value="">{{d.l10n.yearOfExperienceOption}}</option>
                    </select>
                </span>

            </div>

            <div class="col-sm-3 form-group">
                <span class="select-wrapper">
                    <select name="la"
                    data-compare="text in"
                    data-key="la"
                    class="form-control"
                    type="select"
                    data-object-init='{"id":"", "ti":"{{d.l10n.language}}"}'
                    data-dropdown
                    data-index-value=""
                    data-option-local-json="languageOption">
                        <option value="">{{d.l10n.languageOption}}</option>
                    </select>
                </span>

            </div>

            <div class="col-sm-3 form-group">
                <span class="select-wrapper">

                   <select name="country"
                       data-dropdown
                       data-compare="text in"
                       data-key="uco"

                       data-params="country="
                       data-index-value=""
                       data-object-init='{"id":"", "ti":"{{d.l10n.optCountry}}"}'
                       data-option-local-json="countryShort"
                       class="form-control">
                       <option value="">{{d.l10n.optCoutry}}</option>
                   </select>
                </span>
            </div>
       </div>
    </div>
</form>
</script>
<script id="entryCmpFilterJobHorizontal" type="text/x-handlebars-template">
    <div class="filter-list">
        <form class="post-form form-filter header-filter-h">
            <div class="filter filter-list">
                <div class="row">
                    <div class="col-sm-4">
                        <input name="ti"
                            data-compare="text in"
                            data-key="ti"
                            placeholder="{{d.l10n.placeholderSearchJob}}"
                            class="form-control m-b-10">
                    </div>
                    <div class="col-sm-3 form-group">
                        <div class="select-wrapper">
                            <select name="ci"
                                data-compare="in"
                                data-key="ci"
                                data-dropdown
                                data-str-key="id"
                                data-str-value="name"
                                data-option-local-json="yourCompany"
                                data-object-init='{"id":"", "name":"{{d.l10n.company}}"}'
                                class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 form-group">
                        <div class="select-wrapper">
                            <select name="ca"
                                data-compare="in"
                                data-key="ca"
                                data-dropdown
                                data-option-from-json="<?=APIGETMENU;?>"
                                data-option-local-json="menuStructure"
                                data-params="opp=3"
                                data-object-init='{"id":"", "ti":"{{d.l10n.jobCategories}}"}'
                                class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2 form-group hidden">
                        <div class="select-wrapper">
                            <select name="lo"
                                data-compare="in"
                                data-key="lo"
                                data-dropdown
                                data-option-local-json="location"
                                data-option-from-json="<?=APIGETLOCATION;?>"
                                data-object-init='{"id":"", "ti":"{{d.l10n.location}}"}'
                                class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2 form-group">
                        <div class="select-wrapper">
                            <select name="ty"
                                data-compare="equal"
                                data-key="ty"
                                data-dropdown
                                data-option-local-json="jobTime"
                                data-object-init='{"id":"", "ti":"{{d.l10n.jobTime}}"}'
                                class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</script>

<script id="entryCmpFilterJobHorizontalOther" type="text/x-handlebars-template">
<form class="post-form form-filter header-filter-h">
    <div class="filter filter-list">
        <div class="row">
            <div class="col-sm-4 form-group">
                <input class="form-control"
                    data-compare="text in"
                    data-key="na"
                    name="ti"
                    placeholder="{{d.l10n.placeholderSearchJob}}">
            </div>

            <div class="col-sm-3 form-group">
                <span class="select-wrapper">
                    <select name="cat"
                        data-compare="text in"
                        data-key="ca"
                        class="form-control"
                        data-dropdown
                        data-option-from-json="<?=APIGETMENU;?>"
                        data-option-local-json="menuStructure"
                        data-params="opp=3"
                        data-object-init='{"id":"", "ti":"{{d.l10n.optInsdustry}}"}'
                        data-target-append=".multiselect-category">
                        <option value="">{{d.l10n.optInsdustry}}</option>
                    </select>
                </span>
            </div>

            <div class="col-sm-3 form-group">
                <span class="select-wrapper">
                    <select name="loc"
                        data-compare="text in"
                        data-key="lo"
                        class="form-control"
                        type="select"
                        data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                        data-dropdown
                        data-option-local-json="location"
                        data-option-from-json="<?=APIGETLOCATION;?>">
                        <option value="">{{d.l10n.optCity}}</option>
                         <span class="error"></div>
                    </select>
                </span>
            </div>

            <div class="col-sm-2 form-group hidden">
                <span class="select-wrapper">
                    <select name="ex[]"
                        data-compare="text in"
                        data-key="ex"
                        class="form-control"
                        data-dropdown
                        data-option-local-json="yearOfExperience"
                        data-object-init='{"id":"", "ti":"{{d.l10n.experience}}"}'
                        data-target-append=".multiselect-category">
                        <option value="">{{d.l10n.yearOfExperienceOption}}</option>
                    </select>
                </span>
            </div>

            <div class="col-sm-2 form-group">
                <span class="select-wrapper">
                    <select name="la"
                        data-compare="text in"
                        data-key="la"
                        class="form-control"
                        data-dropdown
                        data-option-local-json="languageOption"
                        data-object-init='{"id":"", "ti":"{{d.l10n.optLanguage}}"}'>
                        <option value="">{{d.l10n.optLanguage}}</option>
                         <span class="error"></div>
                    </select>
                </span>
            </div>

            <div class="form-group p-10 hidden">
                {{#each d.l10n.yearOfExperienceOption}}
                <label class="checkbox">
                    <input name="ex[]"
                           data-key="e"
                           data-key-name="e-{{@key}}"
                           data-compare="checkin"
                           type="checkbox"
                           value="{{@key}}">
                    <span class="checkbox-style"></span>
                    <span>{{this}}</span>
                </label>
                {{/each}}
            </div>
            <div class="head-title-bar p-10 hidden">{{d.l10n.jobPreferredlanguage}}</div>
            <div class="form-group p-10 hidden">
                {{#each d.l10n.languageOption}}
                <label class="checkbox">
                    <input name="la[]"
                           data-key="l"
                           data-key-name="l-{{@key}}"
                           data-compare="checkin"
                           type="checkbox"
                           value="{{@key}}">
                    <span class="checkbox-style"></span>
                    <span>{{this}}</span>
                </label>
                {{/each}}
            </div>
        </div>
    </div>
</form>
</script>

<script id="entryFormLinkCityDistrict" type="text/x-handlebars-template">
<div class="select-wrapper">
    <select name="loc"
        data-validate
        data-dropdown
        data-dropdown-relative-body
        data-dropdown-relative="di"
        data-params="district="
        data-index-value="{{e.loc}}"
        data-object-init='{"id":"", "ti":"{{d.l10n.optCountry}}"}'
        data-option-local-json="location"
        class="form-control">
        <option value="">{{d.l10n.optCountry}}</option>
    </select>
</div>

<div class="select-wrapper">
    <select name="di"
            type="select-from-json"
            data-dropdown
            data-option-from-json="<?=APIGETDISTRICT?>"
            data-params="district={{e.loc}}"
            data-object-init='{"id":"0", "ti":"{{d.l10n.optDistrict}}"}'
            data-index-value="{{e.di}}"
            class="form-control district_class">
            <option value="">{{d.l10n.optDistrict}}</option>
    </select>
</div>
</script>
<script id="entryUsersub" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                 data-elm-data='{"usersub":"1"}'
                 data-copy-template
                 data-view-template=".user-menu-action"
                 data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">
            {{#if e.add}}
                <div class="t-s-21 text-bold bg-color7 p-10 b-r-4 p-l-20">{{d.l10n.addAdmin}}</div>

                <div class="usersub-form cmp-more"
                     data-elm-data='{"page":"1"}'
                     data-copy-template
                     data-view-template=".usersub-form"
                     data-template-id="entryUsersubFrom"></div>
            {{else}}
                {{#if e.update}}
                    <div class="t-s-21 text-bold bg-color7 p-10 b-r-4 p-l-20">{{d.l10n.updateAdmin}}</div>
                    <div class="usersub-form cmp-more"
                         data-elm-data='{
                                "db":{
                                    "id":"{{i.db.id}}",
                                    "name":"{{i.db.name}}",
                                    "username":"{{i.db.username}}",
                                    "cid":"{{i.db.cid}}"
                                }
                            }'
                         data-copy-template
                         data-view-template=".usersub-form"
                         data-template-id="entryUsersubFrom"></div>
                {{else}}
                    <div class="item-view-more table-promocode"
                        data-view-list-by-handlebar=""
                        data-init-button-magic=".item-view-more [data-button-magic]"
                        data-init-object="manageUsersub"
                        data-url="{{e.strUrlList}}"
                        data-method="get"
                        data-show-page="10"
                        data-show-item="10"
                        data-show-all="false"
                        data-scroll-view="false"
                        data-form-filter=".form-filter"
                        data-template-id="entryUsersubItem">

                        <div class="block activation-table">
                            <div class="row cmp-more bg-color5 no-m-bottom no-m-top">
                                <div class="col-xs-2">
                                    <label>{{d.l10n.name}}</label>
                                </div>
                                <div class="col-xs-3">
                                    {{d.l10n.username}}
                                </div>
                                <div class="col-xs-3">
                                    {{d.l10n.company}}
                                </div>
                                <div class="col-xs-2 text-center">
                                    {{d.l10n.timeCreated}}
                                </div>
                                <div class="col-xs-1 text-right">
                                    &nbsp;
                                </div>
                            </div>
                        </div>            

                        <div class="view-items block-content" data-content>
                            <div class="style-loadding"></div>
                        </div>  

                        
                    </div>
                {{/if}}
            {{/if}}
        </div>
    </div>
</script>
<script id="entryUsersubItem" type="text/x-handlebars-template">
<div class="item">
    <div class="row">
        <div class="col-xs-2">
            {{i.name}}
        </div>
        <div class="col-xs-3">
            {{i.username}}
        </div>
        <div class="col-xs-3">
           <div class="company-list-top"><img class="image-load b-r-4" src="/<?=FOLDERIMAGECOMPANY?>thumbnail/{{i.cim}}"> {{i.cname}}</div>
        </div>
        <div class="col-xs-3">
            {{{formatDate i.created '%d-%M-%Y'}}}
        </div>
        <div class="col-xs-1 text-right">
             <a href="/<?=$seo_name["page"]["user"]?>?manage=usersub&add={{i.id}}" class="btn">
             <i class="fa fa-pencil"></i>
             </a>
        </div>
    </div>
</div>

</script>
<script id="entryUsersubFrom" type="text/x-handlebars-template">
    <form class="form-horizontal post-form edit-disabled edit-enabled emp-info">
        <div class="hidden">
            <input  name="updateNode"
                value="db"
                data-validate
                data-required="{{d.l10n.require}}"
                class="form-control">
            <input  name="db.uid"
                value="{{u.userinfo.db.id}}"
                data-validate
                data-required="{{d.l10n.require}}"
                class="form-control">

            {{#if e.db.id}}
            <input  name="db.id"
                value="{{e.db.id}}"
                class="form-control">
            {{/if}}
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">{{d.l10n.fullname}}</label>
            <div class="col-sm-10 ">
                <input name="db.name"
                    value="{{e.db.name}}"
                    data-validate
                    data-required="{{d.l10n.name}}"
                    class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">{{d.l10n.username}}</label>
            <div class="col-sm-10 ">
                <input name="db.username"
                    value="{{e.db.username}}"
                    data-validate
                    data-required="{{d.l10n.username}}"
                    class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">{{d.l10n.password}}</label>
            <div class="col-sm-10 ">
                <input name="db.password"
                    value="{{e.db.password}}"
                    data-validate
                    data-required="{{d.l10n.password}}"
                    class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">{{d.l10n.company}}</label>
            <div class="col-sm-10 ">
                <span class="select-wrapper">
                    <select name="db.cid"
                        data-server="<?=APIPOSTUSERSUB?>"
                        data-format-json="true"
                        data-params-second='{
                            "db":{
                                "id":"{{e.db.id}}",
                                "uid":"{{u.userinfo.db.id}}"
                            },
                            "updateNode":"checkcid"
                        }'
                        data-key = "cid"
                        type="select"
                        data-validate
                        data-required="{{d.l10n.company}}"
                        data-str-value="name"
                        data-str-key="id"
                        data-object-init='{"id":"", "name":"{{d.l10n.company}}"}'
                        data-dropdown
                        data-index-value="{{e.db.cid}}"
                        data-option-local-json="yourCompany"
                        class="form-control">
                    </select>
                </span>        
            </div>
        </div>

        <div class="form-group">
            <div class="btn-action">
               <div class="action-content">
                    <div class="col-sm-10 col-sm-offset-2 text-right">
                        <div class="edit-show">
                        <a class="btn bg-color7 text-uppercase" href="/<?=$seo_name["page"]["user"]?>?manage=usersub">
                            <i class="fa fa-times"></i> {{d.l10n.btnCancel}}
                        </a>
                        <button type="submit"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTUSERSUB?>"
                            data-show-success=".alert-footer.alert"
                            data-show-errors=".alert-footer.alert-error"
                            class="btn bg-color1"
                            {{#if e.db.id}}
                            value="{{d.l10n.btnSave}}"
                            {{else}}
                            data-redirect="."
                            value="{{d.l10n.btnAdd}}"
                            {{/if}}><i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span>
                            </button>
                        </div>
                   </div> 
                </div>
                
            </div>
        </div>

    </form>
</script>

<script id="entryUsersubSignin" type="text/x-handlebars-template">
<div class="modal-dialog modal-signup">
    <div class="modal-content">
        <div class="modal-body p-30 modal-signin">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title company-list-top m-b-10">
                    <h3 class="no-margin text-uppercase t-s-16"><img class="image-load b-r-4" src="{{e.cim}}" />  {{d.l10n.administration}}</h3>
                  </div>
                </div>
              </div>
            </div>
            <form class="post-form">
                <div class="hidden">
                    <input  name="updateNode"
                        value="signin"
                        data-validate
                        data-required="{{d.l10n.require}}"
                        class="form-control">
                    <input  name="cid"
                        value="{{e.cid}}"
                        data-validate
                        data-required="{{d.l10n.require}}"
                        class="form-control">
                </div>

                <div class="login-error login-failed" data-fade="4500">
                  <div class="sms-content"></div>
                </div>
                <div class="form-group">
                   <input name="username"
                        data-validate
                        placeholder="{{d.l10n.optUsername}}"
                        data-required="{{d.l10n.require}}"
                        class="form-control">
                    <span class="error"></span>
                </div>
                <div class="form-group m-b-5" >
                    <input name="password"
                        type="password"
                        placeholder="{{d.l10n.optPassword}}"
                        data-validate
                        data-required="{{d.l10n.require}}"
                        class="form-control">
                    <span class="error"></span>
                </div>
                <div class="form-group m-t-15">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTUSERSUB?>"
                                data-show-success=".alert-footer.alert"
                                data-show-errors=".alert-footer.alert-error"
                                class="btn btn-block bg-color2 text-uppercase form-control"
                                value="{{d.l10n.signin}}"}}> <i class="fa fa-sign-in fa-fw"></i> <span>{{d.l10n.signin}}</span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</script>
<script id="viewListHtmContent" type="text/x-handlebars-template">
    <li class="{{#xif ' this.e.active== this.i.url ' }}current{{/xif}}">
        <a href="/{{i.url}}">   
            {{#xif " this.e.la == 'en' "}}
                {{i.ti_en}}
            {{else}}
                {{i.ti_vi}}
            {{/xif}}
        </a>
    </li>
</script>
<script id="entryUserNotifyDonotAccess" type="text/x-handlebars-template">
    <div class="row m-b-10 header-update">
        <div class="col-sm-3">
            <div class="user-menu-action"
                    data-elm-data='{"managejob":"1"}'
                    data-copy-template
                    data-view-template=".user-menu-action"
                    data-template-id="entryUserMenuSetting"></div>
        </div>
        <div class="col-sm-9">
        entryUserNotifyDonotAccess
        </div>
    </div>
</script>

<script id="entryUserFormCmpLocation" type="text/x-handlebars-template">
    <form class="post-form user-manage-feature form-horizontal modal-dialog popup-history popup-location-company">
        <div class="modal-content">
            <div class="modal-header">
                <div class="hidden">
                    <input type="text" name="updateNode" value="location">
                    <input type="text" name="db.ui" value="{{u.userinfo.db.id}}">
                    <input type="text" name="location.id" value="{{i.id}}">
                    <input type="text" name="location.company_id" value="{{e.company_id}}">
                    <input type="text" name="location.lat" value="{{i.lat}}" id="lat_location">
                    <input type="text" name="location.lng" value="{{i.lng}}" id="lng_location">
                </div>
                <div class="title">
                    <h3 class="text-color2">{{d.l10n.location}}</h3>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"></span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.locationName}}
                    </label>
                    <div class="col-sm-9">
                        <input type="text"
                            data-validate
                            name="location.location_name"
                            value="{{i.location_name}}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.address}}
                    </label>
                    <div class="col-sm-6">
                        <input type="text"
                            id="autocomplete_add_location"
                            data-validate
                            name="location.address"
                            placeholder="{{d.l10n.optAddress}}"
                            value="{{i.address}}"
                            class="form-control">
                    </div>
                
                    <div class="col-sm-3">
                        <span class="select-wrapper">
                            <select name="location.city"
                                data-validate
                                data-required="{{d.l10n.require}}"
                                data-dropdown
                                data-index-value="{{#if i.city}}{{i.city}}{{else}}30{{/if}}"
                                data-object-init='{"id":"", "ti":"{{d.l10n.optCountry}}"}'
                                data-option-local-json="location"
                                class="form-control">
                                <option value="">{{d.l10n.optCoutry}}</option>
                            </select>
                        </span>
                        <span class="error">{{d.l10n.require}}</span>
                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button type="submit"
                      class="btn bg-color1 text-uppercase"
                      data-button-magic
                      data-params-form=".post-form"
                      data-format-json="true"
                      data-ajax-url="<?=APIPOSTCOMPANY?>"
                      data-show-success=".alert-footer.alert"
                      data-show-errors=".popup.signin-missing-session"
                      data-show-hide=".alert, [data-quick-view-item1]"
                      data-refress-list=".item-view-location"
                      value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>

                    <span data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"
                            class="btn bg-color5 text-uppercase">{{d.l10n.btnCancel}}</span>


            </div>
        </div>
    </form>
</script>

