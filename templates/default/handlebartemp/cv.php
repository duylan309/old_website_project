<script id="entryCvItem" type="text/x-handlebars-template">
    <div class="item bg-grey-color1 cv-less">
        <div class="row">
            <div class="col-xs-4 col-sm-4">
                <div class="img b-r-4 pr-div-small i-center">
                    <figure>
                        <a href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}">
                        
                        {{#if i.db.im}}    
                            <img alt="" class="image-load" data-img="/<?=FOLDERIMAGEUSER?>{{i.db.im}}" src="/media/images/style/user.png">
                        {{else}}
                            <img alt="" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">

                        {{/if}} 

                        </a>
                    </figure>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 short-text">
                <a class="text-color1 text-color1 text-bold" href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}">{{i.db.name}}</a>
                <p class="short-text text-bold"> {{i.db.title}}</p>
                <p class="u-age short-text c-list">{{{textFromDropdownLocal i.db.level 'jobLevel' 'id' 'ti'}}}</p>
                <p class="u-age hidden"> {{{getOldFromYMD i.db.dob}}} {{d.l10n.yearsold}}</p>
            </div>
        </div>
    </div>
</script>

<script id="entryCvItemActionApplied" type="text/x-handlebars-template">
<div class="item item-cv cv-applied {{#xif ' this.i.jas == 0 ' }} item-new {{else}} {{/xif}}">
    <div class="row">
        <div thumbnail-user class="col-xs-3 col-sm-1">
            <div class="img i-center pr-div b-cover b-r-4 m-b-5">
                <figure>
                    <a {{#if e.linkMore}}
                            href="{{e.linkMore}}cid={{i.db.id}}&pid={{i.pid}}&uname={{i.db.name}}"
                        {{else}}
                           href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}"
                        {{/if}}
                        >
                        {{#if i.db.im}}
                        <img alt="" class="image-load" data-img="/<?=FOLDERIMAGEUSER?>{{i.db.im}}" src="/media/images/style/user.png">
                        {{else}}
                        <img alt="" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">

                        {{/if}}
                    </a>
                </figure>
            </div>
        </div>
        <div data-user-content-column class="col-xs-9 col-sm-7">
            <div class="row">
                <div class="col-sm-12">
                    
                    <p class="hidden">
                    {{#if i.db.country}}
                        <span class="flag-icon flag-icon-{{i.db.country}}"></span> -
                    {{/if}}
                    <span class="u-age"> {{{getOldFromYMD i.db.dob}}} {{d.l10n.yearsold}} -
                    {{#xif " this.i.db.gender == 1 "}}
                        {{d.l10n.male}}
                    {{else}}
                        {{d.l10n.female}}
                    {{/xif}}</span>
                    </p>

                    <h3 class="no-margin">
                        <a class="text-color1 text-color1 text-bold u-name"
                            {{#if e.linkMore}}
                                href="{{e.linkMore}}cid={{i.db.id}}&pid={{i.pid}}&uname={{i.db.name}}"
                            {{else}}
                               href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}"
                            {{/if}} >
                            {{i.db.name}} <span class="item-show-new text-color2">( {{d.l10n.new}} )</span>
                        </a>

                    </h3>


                    {{#if i.t}}
                    <div class="view-action">
                        <span class="text-cap">{{d.l10n.jobApplied}}: <a class="text-color3 text-bold" href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.t i.jid}}}">{{i.t}}</a></strong>
                    </div>
                    {{/if}}

                    <span><i class="fa fa-envelope"></i> {{i.ue}} <label>-</label> <i class="fa fa-phone"></i> {{i.up}} <label>-</label> <i class="fa fa-map-marker"></i> {{{textFromDropdownLocal i.uci 'location' 'id' 'ti'}}} </span> <br>
                    <p class="hidden-xs short-text">{{{shortenText i.s 150}}}</p>

                </div>
            </div>
        </div>
        <div data-user-action class="col-sm-4 text-right pull-right">
            <div class="user-action">
                <span class="show-unsave employer-action-status m-t-10 show-unsave-{{i.ui}} employer-action{{i.employer_status}}">
                    <span class="btn btn-xs bg-color7 btn-unsave hidden"
                         data-button-magic
                         data-method="post"
                         data-format-json="true"
                         data-ajax-url="<?=APIPOSTUSERACTION?>"
                         data-success-toggle-class=".show-unsave-{{i.ui}},employer-action1"
                         data-params='{ "employmentAction":"unsaveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                         data-redirects="."><span class="">{{d.l10n.btnUnLike}}</span></span>
                    
                    <span class="btn btn-xs btn-employer-action bg-color7 btn-save"
                         data-button-magic
                         data-method="post"
                         data-format-json="true"
                         data-ajax-url="<?=APIPOSTUSERACTION?>"
                         data-params='{ "employmentAction":"saveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                         data-success-toggle-class=".show-unsave-{{i.ui}},employer-action1"
                         data-show-errors=".modal.signin-missing-session"
                         data-show-hide=""
                         data-redirects="."><span class="">{{d.l10n.btnLike}}</span></span>

                    <span class="btn btn-xs btn-employer-action bg-color7 btn-interview"
                         data-button-magic
                         data-method="post"
                         data-format-json="true"
                         data-ajax-url="<?=APIPOSTUSERACTION?>"
                         data-params='{ "employmentAction":"interview", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                         data-success-toggle-class=".show-unsave-{{i.ui}},employer-action3"
                         data-show-errors=".modal.signin-missing-session"
                         data-show-hide=""
                         data-redirects="."><span class="">{{d.l10n.btnInterview}}</span></span>

                    <span class="btn btn-xs btn-employer-action bg-color7 btn-hire"
                         data-button-magic
                         data-method="post"
                         data-format-json="true"
                         data-ajax-url="<?=APIPOSTUSERACTION?>"
                         data-params='{ "employmentAction":"hire", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                         data-success-toggle-class=".show-unsave-{{i.ui}},employer-action4"
                         data-show-errors=".modal.signin-missing-session"
                         data-show-hide=""
                         data-redirects="."><span class="">{{d.l10n.btnHire}}</span></span> 

                    <span class="btn btn-xs btn-employer-action bg-color7 btn-deny"
                         data-button-magic
                         data-method="post"
                         data-format-json="true"
                         data-ajax-url="<?=APIPOSTUSERACTION?>"
                         data-params='{ "employmentAction":"deny", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                         data-success-toggle-class=".show-unsave-{{i.ui}},employer-action5"
                         data-show-errors=".modal.signin-missing-session"
                         data-show-hide=""
                         data-redirects="."><span class="">{{d.l10n.btnDeny}}</span></span>               
                
                </span>

            </div>
            <div class="form-group m-b-10 action-favorite hidden">
                <div class="otooltip">
                    <span class="btn btn-xs bg-color2 text-uppercase m-b-10">{{d.l10n.contact}}</span>
                    <div class="otooltip-content otooltip-r">

                        <div class="btn"
                            data-button-magic
                            data-elm-data='{"to":"{{i.ui}}","im":"{{i.db.im}}","name":"{{i.db.name}}","dob":"{{i.db.dob}}","gender":"{{i.db.gender}}","phone":"{{i.db.phone}}"}'
                            data-view-template-local="true"
                            data-view-template="[data-quick-view-item]"
                            data-template-id="entryPopupContact">{{d.l10n.sendCall}}</div>
                        <div class="btn"
                            data-button-magic
                            data-elm-data='{"to":"{{i.ui}}"}'
                            data-view-template-local="true"
                            data-view-template="[data-quick-view-item]"
                            data-template-id="entryPopupSendmessage">{{d.l10n.sendMessage}}</div>
                        <div class="btn"
                            data-button-magic
                            data-elm-data='{"to":"{{i.ui}}"}'
                            data-view-template-local="true"
                            data-view-template="[data-quick-view-item]"
                            data-template-id="entryPopupInterview">{{d.l10n.sendInterview}}</div>
                    </div>
                </div>
            </div>
            <p><span class="t-s-12 text-italic">{{d.l10n.jobAppliedDate}}</span> <label class="t-s-12 text-bold">{{{formatDate i.cr '%d-%M-%Y'}}}</label></p>
            <a href="#" data-btn-send-message
                class="btn-xs hidden-xs"
                data-button-magic
                data-elm-data='{"db": { "employer_id" : "{{e.employer_id}}","company_id"  : "{{e.company_id}}", "user_id" : "{{i.db.id}}", "sender_id" : "{{e.employer_id}}", "receiver_id" : "{{i.db.id}}", "user_name" : "{{i.db.name}}", "user_image" : "{{i.db.im}}" } }'
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryFormSendMessagePopup"><i class="fa fa-envelope"></i> <span><?=$language["sendMessage"]?></span></a>
        </div>
    </div>

    <div class="bg-g-white btn-more-white" data-closet-toggle-class="active" data-object=".item-cv">

    </div>
    <div class="view-more" data-object=".item-cv" data-closet-toggle-class="active" data-add-attr="data-closet-toggle-class">
        <div class="j-view-option row">
            <label class="col-sm-12 col-xs-12 text-bold">{{d.l10n.questionOne}}</label>
            <span class="col-sm-12 col-xs-12"><i class="fa fa-caret-right text-color3"></i> {{i.aw1}}</span>
        </div>
        <div class="j-view-option row hidden">
            <label class="col-sm-12 col-xs-12">{{d.l10n.questionTwo}}</label>
            <span class="col-sm-12 col-xs-12"><i class="fa fa-caret-right text-color3"></i> {{i.aw2}}</span>
        </div>
        <div class="j-view-option row hidden">
            <label class="col-xs-3 col-sm-3">{{d.l10n.jobLevel}}</label>
            <span class="col-xs-9 col-sm-9">{{{textFromDropdownLocal i.l 'jobLevel' 'id' 'ti'}}}</span>
        </div>
        <div class="j-view-option row">
            <label class="col-xs-6 col-sm-3">{{d.l10n.yearOfExperience}}</label>
            <span class="col-xs-6 col-sm-9">{{{textFromDropdownLocal i.e 'yearOfExperience' 'id' 'ti'}}}</span>
        </div>
        <div class="j-view-option row">
            <label class="col-xs-6 col-sm-3">{{d.l10n.salaryExpect}}</label>
            <span class="col-xs-6 col-sm-9 text-color3">
                 {{formatCurrency i.s1}} {{{textFromDropdownLocal i.sa 'currency' 'id' 'ti'}}}
            </span>
        </div>
        <div class="j-view-option row hidden">
            <label class="col-xs-6 col-sm-3">{{d.l10n.jobLocations}}</label>
            <div class="col-sm-6 c-list">{{{textFromDropdownLocal i.lo 'location' 'id' 'ti'}}}</div>
        </div>
        <div class="j-view-option row hidden">
            <label class="col-xs-3 col-sm-3">{{d.l10n.keySkills}}</label>
            <p class="col-xs-9 col-sm-9 textarea-content">{{i.s}}</p>
        </div>
    </div>
    <div class="bg-more">
            <a {{#if e.linkMore}}
                href="{{e.linkMore}}cid={{i.db.id}}&pid={{i.pid}}&uname={{i.db.name}}"
            {{else}}
                href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}"
            {{/if}}
            class="btn view-less text-uppercase"><strong>+ {{d.l10n.viewMore}}</strong></a>
    </div>
</div>

</script>
<script id="entryCvItemAction" type="text/x-handlebars-template">
    <div class="item item-cv">
        <div class="row">
            <div class="col-xs-2 col-sm-1">
                <div class="img i-center pr-div b-cover b-r-4">
                    <figure>
                        <a {{#if e.linkMore}}
                            href="{{e.linkMore}}cid={{i.db.id}}"
                            {{else}}
                            href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}"
                            {{/if}}
                        >

                        {{#if i.db.im}}
                            <img alt="" class="image-load" data-img="/<?=FOLDERIMAGEUSER?>{{i.db.im}}" src="/media/images/style/user.png">
                        {{else}}
                            <img alt="" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                        {{/if}}

                        </a>
                    </figure>
                </div>

            </div>
            <div class="col-xs-10 col-sm-11">
                <div class="row">
                    <div class="col-sm-7">
                        {{#if i.db.country}}
                            <span class="flag-icon flag-icon-{{i.db.country}}"></span> -
                        {{/if}}
                        
                        <span class="u-age"> {{{getOldFromYMD i.db.dob}}} {{d.l10n.yearsold}} -
                        {{#xif " this.i.db.gender == 1 "}}
                            {{d.l10n.male}}
                        {{else}}
                            {{d.l10n.female}}
                        {{/xif}}</span>

                        <h3 class="no-margin">
                            <a class="text-color1 text-color1 text-bold u-name" href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}">{{i.db.name}}</a>
                        </h3>
                        <!-- JOB APPLIED -->
                        {{#if i.jt}}
                        <div class="view-action">
                            <strong>{{d.l10n.jobApplied}}: <a class="text-color3" href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.jt i.ji}}}">{{i.jt}}</a></strong>
                        </div>
                        {{/if}}
                        <span>{{{textFromDropdownLocal i.l 'jobLevel' 'id' 'ti'}}} | {{{textFromDropdownLocal i.l 'yearOfExperience' 'id' 'ti'}}} | {{i.t}} </span> |
                        <span>{{{shortenText i.s 150}}}</span>
                    </div>
                    <div class="col-sm-5 text-right">
                        <div class="form-group m-b-10 action-favorite">
                            <span class="show-unsave employer-action-status m-t-10 show-unsave-{{i.ui}} employer-action{{i.employer_status}}">
                                <span class="btn btn-xs bg-color7 btn-unsave hidden"
                                     data-button-magic
                                     data-method="post"
                                     data-format-json="true"
                                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                                     data-success-toggle-class=".show-unsave-{{i.ui}},employer-action1"
                                     data-params='{ "employmentAction":"unsaveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                     data-redirects="."><span class="">{{d.l10n.btnUnLike}}</span></span>
                                
                                <span class="btn btn-xs btn-employer-action bg-color7 btn-save"
                                     data-button-magic
                                     data-method="post"
                                     data-format-json="true"
                                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                                     data-params='{ "employmentAction":"saveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                     data-success-toggle-class=".show-unsave-{{i.ui}},employer-action1"
                                     data-show-errors=".modal.signin-missing-session"
                                     data-show-hide=""
                                     data-redirects="."><span class="">{{d.l10n.btnLike}}</span></span>

                                <span class="btn btn-xs btn-employer-action bg-color7 btn-interview"
                                     data-button-magic
                                     data-method="post"
                                     data-format-json="true"
                                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                                     data-params='{ "employmentAction":"interview", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                     data-success-toggle-class=".show-unsave-{{i.ui}},employer-action3"
                                     data-show-errors=".modal.signin-missing-session"
                                     data-show-hide=""
                                     data-redirects="."><span class="">{{d.l10n.btnInterview}}</span></span>

                                <span class="btn btn-xs btn-employer-action bg-color7 btn-hire"
                                     data-button-magic
                                     data-method="post"
                                     data-format-json="true"
                                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                                     data-params='{ "employmentAction":"hire", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                     data-success-toggle-class=".show-unsave-{{i.ui}},employer-action4"
                                     data-show-errors=".modal.signin-missing-session"
                                     data-show-hide=""
                                     data-redirects="."><span class="">{{d.l10n.btnHire}}</span></span> 

                                <span class="btn btn-xs btn-employer-action bg-color7 btn-deny"
                                     data-button-magic
                                     data-method="post"
                                     data-format-json="true"
                                     data-ajax-url="<?=APIPOSTUSERACTION?>"
                                     data-params='{ "employmentAction":"deny", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                     data-success-toggle-class=".show-unsave-{{i.ui}},employer-action5"
                                     data-show-errors=".modal.signin-missing-session"
                                     data-show-hide=""
                                     data-redirects="."><span class="">{{d.l10n.btnDeny}}</span></span>               
                            
                            </span>

                            <!--   <div class="show-unsave m-b-10 show-unsave-{{i.ui}} {{#xSubString i.ui u.saveuser.strui ','}}active{{/xSubString}}">
                                    <span class="btn btn-xs btn-default bg-color7 btn-block m-t-5 btn-unsave"
                                        data-button-magic
                                        data-method="post"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSERACTION?>"
                                        data-success-toggle-class=".show-unsave-{{i.ui}},active"
                                        data-params='{ "employmentAction":"unsaveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                        data-redirects="."><span class="hidden-xs">{{d.l10n.btnUnLike}}</span></span>
                                   
                                    <span class="btn btn-xs btn-default bg-color4 btn-save"
                                        data-button-magic
                                        data-method="post"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTUSERACTION?>"
                                        data-params='{ "employmentAction":"saveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                        data-success-toggle-class=".show-unsave-{{i.ui}},active"
                                        data-show-errors=".modal.signin-missing-session"
                                        data-show-hide=""
                                        data-redirects="."><span class="hidden-xs">{{d.l10n.btnLike}}</span></span>
                                </div> -->
                           
                            <div class="otooltip">

                                <span class="btn btn-block bg-color2 text-uppercase m-b-10 btn-contact">{{d.l10n.contact}}</span>

                                <div class="otooltip-content otooltip-r">


                                    <div class="btn"
                                        data-button-magic
                                        data-elm-data='{"to":"{{i.ui}}","im":"{{i.db.im}}","name":"{{i.db.name}}","dob":"{{i.db.dob}}","gender":"{{i.db.gender}}","phone":"{{i.db.phone}}"}'
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item]"
                                        data-template-id="entryPopupContact">{{d.l10n.sendCall}}</div>
                                    <div class="btn"
                                        data-button-magic
                                        data-elm-data='{"to":"{{i.ui}}"}'
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item]"
                                        data-template-id="entryPopupSendmessage">{{d.l10n.sendMessage}}</div>
                                    <div class="btn"
                                        data-button-magic
                                        data-elm-data='{"to":"{{i.ui}}"}'
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item]"
                                        data-template-id="entryPopupInterview">{{d.l10n.sendInterview}}</div>
                                </div>
                            </div>
                        </div>

                        {{#if e.userManageAction}}
                        <form class="post-form">
                            <div class="hidden">
                                <input name="db.id" value="{{i.jai}}">
                                <input name="db.jo" value="{{i.ji}}">
                                <input name="db.ei" value="{{u.userinfo.db.id}}">
                                <input name="employmentAction" value="applied">
                                <span data-button-magic data-button-submit-form
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTUSERACTION?>"
                                    data-redirect=".">&nbsp;</span>
                            </div>
                            <div class="form-group btn-action-cv">
                                <select name="db.st" class="form-control"
                                    data-trigger-click="[data-button-submit-form]"
                                    data-index-select-box="{{i.jas}}">
                                <option value="0">{{d.l10n.applied}}</option>
                                {{#each d.l10n.appliedStatus}}
                                    <option value="{{@key}}">{{this}}</option>
                                {{/each}}
                                </select>
                            </div>
                        </form>
                        {{else}}
                            <div class="show-unsave hidden show-unsave-{{i.ui}} {{#xSubString i.ui u.saveuser.strui ','}}active{{/xSubString}}">
                                <span class="btn btn-default btn-block btn-unsave"
                                    data-button-magic
                                    data-method="post"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTUSERACTION?>"
                                    data-success-toggle-class=".show-unsave-{{i.ui}},active"
                                    data-params='{ "employmentAction":"unsaveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                    data-redirects="."><span class="icon-heart-broken"></span> <span class="hidden-xs">{{d.l10n.btnUnsave}}</span></span>
                                <span class="btn btn-block bg-color3 btn-save text-uppercase"
                                    data-button-magic
                                    data-method="post"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTUSERACTION?>"
                                    data-params='{ "employmentAction":"saveuser", "db":{"fo":"{{u.userinfo.db.id}}", "ui":"{{i.ui}}","co":"{{u.userinfo.db.id}}_{{i.ui}}"} }'
                                    data-success-toggle-class=".show-unsave-{{i.ui}},active"
                                    data-show-errors=".modal.signin-missing-session"
                                    data-show-hide=""
                                    data-redirects="."><span class="icon-heart"></span> <span class="hidden-xs">{{d.l10n.btnSave}}</span></span>
                            </div>
                        {{/if}}
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-g-white btn-more-white" data-closet-toggle-class="active" data-object=".item-cv">

        </div>
        <div class="view-more" data-object=".item-cv" data-closet-toggle-class="active" data-add-attr="data-closet-toggle-class">
            <div class="j-view-option row">
                <label class="col-xs-3 col-sm-3">{{d.l10n.jobexpect}}</label>
                <span class="col-xs-9 col-sm-9"><strong>{{i.t}}</strong></span>
            </div>
            <div class="j-view-option row">
                <label class="col-xs-3 col-sm-3">{{d.l10n.jobLevel}}</label>
                <span class="col-xs-9 col-sm-9">{{{textFromDropdownLocal i.l 'jobLevel' 'id' 'ti'}}}</span>
            </div>
            <div class="j-view-option row">
                <label class="col-xs-3 col-sm-3">{{d.l10n.yearOfExperience}}</label>
                <span class="col-xs-9 col-sm-9">{{{textFromDropdownLocal i.e 'yearOfExperience' 'id' 'ti'}}}</span>
            </div>
            <div class="j-view-option row">
                <label class="col-xs-3 col-sm-3">{{d.l10n.salaryExpect}}</label>
                <span class="col-xs-9 col-sm-9 text-color3">
                     {{formatCurrency i.s1}} {{{textFromDropdownLocal i.sa 'currency' 'id' 'ti'}}}
                </span>
            </div>
            <div class="j-view-option row">
                <label class="col-xs-3 col-sm-3">{{d.l10n.jobLocations}}</label>
                <div class="col-sm-9 c-list">{{{textFromDropdownLocal i.lo 'location' 'id' 'ti'}}}</div>
            </div>
            <div class="j-view-option row">
                <label class="col-xs-3 col-sm-3">{{d.l10n.keySkills}}</label>
                <p class="col-xs-9 col-sm-9 textarea-content">{{i.s}}</p>
            </div>
        </div>
        <div class="bg-more">
            <a  {{#if e.linkMore}}
                href="{{e.linkMore}}cid={{i.db.id}}"
                {{else}}
                href="/<?=$seo_name["page"]["cv"]?>/{{{urlFriendly i.db.name i.db.id}}}"
                {{/if}}
                class="btn view-less text-uppercase"><strong>+ {{d.l10n.viewMore}}</strong></a>
        </div>
    </div>
</script>

<script id="entryCvView" type="text/x-handlebars-template">
 <div class="item item-cv cv-applied">
     <div class="row">
        <div thumbnail-user class="col-xs-3 col-sm-1">
            {{#if i.userinfo.db.im}}
                <div class="pr-div b-cover b-r-4 m-b-5" style="background:url('/<?=FOLDERIMAGEUSER?>{{i.userinfo.db.im}}') no-repeat;"></div>
            {{else}}
                <div class="pr-div b-cover b-r-4 m-b-5" style="background:url('/media/images/style/user.png') no-repeat;"></div>
            {{/if}}
        </div>
        <div data-user-content-column="" class="col-xs-9 col-sm-7">
            <div class="c-t-cv">
                <strong class="u-age"> {{{getOldFromYMD i.userinfo.db.dob}}} {{d.l10n.yearsold}}</strong>
                <h3 class="text-color1 no-margin u-name"> {{i.userinfo.db.name}}</h3>
                <div class="row">
                    <label class="col-sm-4 no-margin hidden">{{d.l10n.jobTitle}}</label>
                    <div class="col-sm-12">
                        <span class="c-list text-color3 text-bold"> {{i.user_cv.db.title}}</span>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-4 no-margin hidden">{{d.l10n.experienceWork}}</label>
                    <div class="col-sm-12">
                        {{{textFromDropdownLocal i.user_cv.db.ex 'yearOfExperience' 'id' 'ti'}}}
                    </div>
                </div>
            </div>
        </div>
        <div data-user-action class="col-sm-4 text-right pull-right">
            <div class="button-function"
                data-copy-template
                data-view-template=".button-function"
                data-elm-data='{"fo":"{{u.userinfo.db.id}}","ui":"{{i.userinfo.db.id}}","im":"{{i.userinfo.db.im}}","name":"{{i.userinfo.db.name}}","dob":"{{i.userinfo.db.dob}}","gender":"{{i.userinfo.db.gender}}","phone":"{{i.userinfo.db.phone}}","employer_status":"{{i.employer_status}}" }'
                data-template-id="entryUserCvFunction">&nbsp;</div>

            <a href="#" data-btn-send-message
                class="btn-xs"
                data-button-magic
                data-elm-data='{"db": { "employer_id" : "{{u.userinfo.db.id}}","company_id"  : "", "user_id" : "{{i.userinfo.db.id}}", "sender_id" : "{{u.userinfo.db.id}}", "receiver_id" : "{{i.userinfo.db.id}}", "user_name" : "{{i.userinfo.db.name}}", "user_image" : "{{i.userinfo.db.im}}" } }'
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryFormSendMessagePopup"><i class="fa fa-envelope"></i> <span><?=$language["sendMessage"]?></span></a>
        </div>
         
    </div>
 </div>
 <h3 class="t-s-17 hidden">{{d.l10n.generalInfo}}</h3>
 <div class="cmp-more">
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.fullname}}</label>
         <span class="col-xs-8 col-sm-9">{{i.userinfo.db.name}}</span>
     </div>
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.bod}}</label>
         <span class="col-xs-8 col-sm-9">{{#if i.userinfo.db.day}}{{{textFromDropdownLocal i.userinfo.db.day 'dayTime' 'id' 'ti'}}} {{{textFromDropdownLocal i.userinfo.db.month 'monthTime' 'id' 'ti'}}} , {{i.userinfo.db.year}}{{/if}} </span>
     </div>
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.gender}}</label>
         <span class="col-xs-8 col-sm-9">
            {{#xif " this.i.userinfo.db.gender == 1 "}}
                                {{d.l10n.male}}
                            {{else}}
                                {{d.l10n.female}}
                            {{/xif}}
        </span>
     </div>
     <div class="j-view-option row hidden">
         <label class="col-xs-4 col-sm-3">{{d.l10n.cv}}</label>
         <a class="col-xs-8 col-sm-9" href="#">{{d.l10n.download}}</a>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.address}}</label>
         <span class="col-xs-8 col-sm-9">{{i.userinfo.db.address}}

         {{#xif " this.d.l10n.langcode == 'en' "}}
            {{#if i.userinfo.db.city_text_en}}, {{i.userinfo.db.city_text_en}}{{/if}}
         {{else}}
            {{#if i.userinfo.db.city_text_vi}}, {{i.userinfo.db.city_text_vi}}{{/if}}
         {{/xif}}    

         {{#if i.userinfo.db.country}}, {{{textFromDropdownLocal i.userinfo.db.country 'country' 'id' 'ti'}}}{{/if}}
         </span>
     </div>
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.phone}}</label>
         <span class="col-xs-8 col-sm-9">{{i.userinfo.db.phone}}</span>
     </div>
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.email}}</label>
         <span class="col-xs-8 col-sm-9">{{i.userinfo.db.email}}</span>
     </div>
     {{#if i.userinfo.db.skype}}
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.skype}}</label>
         <span class="col-xs-8 col-sm-9">{{i.userinfo.db.skype}}</span>
     </div>
     {{/if}}
     {{#if i.userinfo.db.facebook}}
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.facebook}}</label>
         <span class="col-xs-8 col-sm-9">{{i.userinfo.db.facebook}}</span>
     </div>
     {{/if}}
 </div>

 <h3 class="t-s-17 hidden m-l-10">{{d.l10n.workInfomation}}</h3>
 <div class="cmp-more">
     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.jobTitle}}</label>
         <span class="col-xs-8 col-sm-9 text-color2 text-bold">{{i.user_cv.db.title}}</span>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.experienceWork}}</label>
         <span class="col-xs-8 col-sm-9">
         {{{textFromDropdownLocal i.user_cv.db.experience 'yearOfExperience' 'id' 'ti'}}}</span>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.jobCategoriesWantToJoin}}</label>
         <p class="col-xs-8 col-sm-9">
             <span class="c-list view-local-category"
             data-copy-template
             data-view-template=".view-local-category"
             data-elm-data='{"key":"","value":"","obj":"menuList","str":"{{i.user_cv.db.category}}"}'
             data-template-id="entryViewLocalOption">&nbsp;</span>
         </p>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.jobLevel}}</label>
         <span class="col-xs-8 col-sm-9 c-list">{{{textFromDropdownLocal i.user_cv.db.level 'jobLevelOption' '' ''}}}</span>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.jobTime}}</label>
         <span class="col-xs-8 col-sm-9 c-list">{{{textFromDropdownLocal i.user_cv.db.type 'jobTimeOption' '' ''}}}</span>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.languageISpeak}}</label>
         <span class="col-xs-8 col-sm-9 c-list">{{{textFromDropdownLocal i.user_cv.db.lang 'langOption' '' ''}}}</span>
     </div>

     <div class="j-view-option row">
         <label class="col-xs-4 col-sm-3">{{d.l10n.salaryExpect}}</label>
         <span class="col-xs-8 col-sm-9 text-color3 text-bold">
            {{formatCurrency i.user_cv.db.s1}} {{{textFromDropdownLocal i.user_cv.db.salary 'currency' 'id' 'ti'}}}
            </span>
     </div>

     <div class="j-view-option row hidden">
         <label class="col-xs-4 col-sm-3">{{d.l10n.location}}</label>
         <p class="col-xs-8 col-sm-9">
         {{{textFromDropdownLocal i.user_cv.db.location 'locationOption' '' ''}}}
         </p>
     </div>
</div>

<div class="cmp-more">
    
    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-3">{{d.l10n.aboutme}}</label>
        <p class="textarea-content col-xs-12 col-sm-9">{{#if i.user_cv.db.about}}{{i.user_cv.db.about}}{{else}}...{{/if}}</p>
    </div>

    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-3">{{d.l10n.keySkills}}</label>
        <p class="textarea-content col-xs-12 col-sm-9">{{#if i.user_cv.db.skill}}{{i.user_cv.db.skill}}{{else}}...{{/if}}</p>
    </div>

</div>

<div class="cmp-more">
     <div class="j-view-option row m-b-30 m-t-15">
         <label class="col-xs-12 col-sm-3">{{d.l10n.employmentHistory}}</label>
         <div class="col-xs-12 col-sm-9">
            <div class="item-view-experience"
                 data-view-list-by-handlebar
                 data-elm-data = '{"onlyView":"1"}'
                 data-init-button-magic=".item [data-button-magic]"
                 data-url="<?=APIGETUSERINFO?>/{{i.userinfo.db.id}}/experience"
                 data-method="get"
                 data-show-page="10"
                 data-show-item="20"
                 data-show-all="false"
                 data-scroll-view="false"
                 data-template-id="viewItemWorkExperience">
                    <div class="view-items" data-content>
                        <div class="style-loadding">...</div>
                    </div>
            </div>
         </div>
     </div>

     <div class="j-view-option row m-t-30 m-b-15">
         <label class="col-xs-12 col-sm-3">{{d.l10n.educationHistory}}</label>
         <div class="col-xs-12 col-sm-9">
             <div class="item-view-education"
                 data-view-list-by-handlebar
                 data-elm-data = '{"onlyView":"1"}'
                 data-init-button-magic=".item [data-button-magic]"
                 data-url="<?=APIGETUSERINFO?>/{{i.userinfo.db.id}}/education"
                 data-method="get"
                 data-show-page="10"
                 data-show-item="20"
                 data-show-all="false"
                 data-scroll-view="false"
                 data-template-id="viewItemWorkEducation">
                 <div class="view-items" data-content>
                    <div class="style-loadding">...</div>
                 </div>
             </div>
         </div>
     </div>
</div>


<div class="cmp-more">
    <div class="row">
        <div class="col-sm-3 text-left">
            <label class="text-bold">{{d.l10n.reviewcomment}}</label>
        </div>
        <div class="col-sm-9">
            {{#if e.isTypeOfView}}
                {{#xif ' this.e.isTypeOfView == 1 '}}
                    <div class="item-view-comment"
                         data-view-list-by-handlebar
                         data-init-button-magic="[comment-row] [data-button-magic]"
                         data-url="<?=APIGETCOMMENT?>/{{u.userinfo.db.id}}?uid={{i.userinfo.db.id}}&pid={{e.pid}}&action=view"
                         data-method="get"
                         data-show-page="10"
                         data-show-item="20"
                         data-show-all="false"
                         data-scroll-view="false"
                         data-template-id="viewItemComment">
                            <div class="view-items" data-content>
                                <div class="style-loadding">...</div>
                            </div>
                    </div>
                {{else}}
                    <div class="item-view-comment"
                         data-view-list-by-handlebar
                         data-init-button-magic="[comment-row] [data-button-magic]"
                         data-url="<?=APIGETCOMMENT?>/{{u.userinfo.db.id}}?uid={{i.userinfo.db.id}}&pid={{e.pid}}&action=view"
                         data-method="get"
                         data-show-page="10"
                         data-show-item="20"
                         data-show-all="false"
                         data-scroll-view="false"
                         data-template-id="viewItemComment">
                            <div class="view-items" data-content>
                                <div class="style-loadding">...</div>
                            </div>
                    </div>
                {{/xif}}
            {{/if}}
            
            {{#if e.isComment }}
            <div class="comment-form">
                <form method="post" class="form-horizontal post-form">
                    <div class="hidden">
                        <input name="db.uid" type="text" value="{{i.userinfo.db.id}}">
                        <input name="db.eid" type="text" value="{{u.userinfo.db.id}}">
                        <input name="action" type="text" value="comment">
                        <input name="updateNode" type="text" value="db">
                    </div>
                    <div class="cmp-more no-margin">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input  data-rate-star
                                            data-required="{{d.l10n.require}}"
                                            data-validate
                                            type="hidden"
                                            value=""
                                            name="db.rate">

                                    <div class="star-rating">
                                        <label>{{d.l10n.rate}}</label>
                                        <i data-star="1" class="fa fa-star-o"></i>
                                        <i data-star="2" class="fa fa-star-o"></i>
                                        <i data-star="3" class="fa fa-star-o"></i>
                                        <i data-star="4" class="fa fa-star-o"></i>
                                        <i data-star="5" class="fa fa-star-o"></i>
                                    </div>
                                    <span class="error">{{d.l10n.require}}</span>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea   name="db.content"
                                                data-validate
                                                data-message
                                                placeholder="{{d.l10n.typeacomment}}"
                                                data-required="{{d.l10n.require}}"
                                                class="form-control more-sm"></textarea>
                                    <span class="error">{{d.l10n.require}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <button class="bg-color1 btn"
                                        type="submit"
                                        data-submit
                                        class="btn bg-color1 text-uppercase"
                                        data-button-magic
                                        data-params-form=".post-form"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTCOMMENT?>"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        data-show-hide=",[data-modal-quick-view]"
                                        data-redirect="."
                                        value="{{d.l10n.btnPost}}"><span>{{d.l10n.btnPost}}</span>
                                </button>
                            </div>
                            <div class="col-xs-5 text-right">
                                <label>{{d.l10n.sendCommentAs}}</label>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <div comment-list-company class="company-list no-margin"
                                        data-copy-template
                                        data-elm-data='{"company_id":"{{e.pid}}"}'
                                        data-view-template=".company-list" 
                                        data-template-id="selectCompanyOptionComment"></div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
            {{/if}}  
        </div>
    </div>
</div>


{{#if u.adminlog.permission}}
<span class="btn bg-color3 text-uppercase"
    data-button-magic
    data-ajax-url="<?=APIPOSTADMINACTIVE?>"
    {{#xif ' this.i.userinfo.db.deactive == 2' }}
    data-params='{
        "db":{
            "uid":"{{i.userinfo.db.id}}",
            "deactive":"0"
        },
        "mod":"lockaccount"
    }'
    {{else}}
    data-params='{
        "db":{
            "uid":"{{i.userinfo.db.id}}",
            "deactive":"2"
        },
        "mod":"lockaccount"
    }'
    {{/xif}}
    data-format-json="true"
    data-method="post"
    data-redirect="."
    data-template-id="entryMakeAdminManageForm">
        {{#xif ' this.i.userinfo.db.deactive == 2' }}Unlock Account{{else}}Lock Account{{/xif}}
    </span>
{{/if}}

{{#if u.adminlog.permission}}
{{#xif ' this.u.adminlog.permission == 100 '}}
<span class="btn btn-default"
    data-button-magic
    data-ajax-url="<?=APIGETUSERMANAGER?>/{{i.userinfo.db.id}}"
    data-elm-data='{ "user_id":"{{i.userinfo.db.id}}"}'
    data-method="get"
    data-view-template-local="false"
    data-view-template="[data-quick-view-item]"
    data-template-id="entryMakeAdminManageForm">Make admin website</span>
{{/xif}}
{{/if}}
</script>
