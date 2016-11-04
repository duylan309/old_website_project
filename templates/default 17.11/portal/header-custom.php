 {{#if userAccess.userinfo}}
        <div class="welcome">
        {{#if userAccess.userinfo.db.name}}
            {{#xif " this.userAccess.userinfo.db.type==1 "}}
               
                <a href="<?="/{$seo_name["page"]["user"]}?manage=postjob";?>"
                    class="btn bg-color3 form-add btn-add-a-item text-uppercase text-bold hidden-xs"
                    data-button-magics
                    data-elm-data='{"urlRedirect":"/{{userAccess.userinfo.db.username}}"}'
                    data-view-template-local="true"
                    data-elm-data='{
                         "missingSession":"true",
                         "hideObj":"[data-quick-view-item1]"
                    }'
                    data-show-success=".alert-footer.alert"
                    data-show-errors=".alert-footer.alert-error"
                    data-show-errors-template="entrySigninPopup"
                    data-view-template="[data-quick-view-item1]"
                    data-template-id="jobsAdd"><span class="icon-file-text2"></span> <span>{{defineVariable.l10n.btnPostJob}}</span></a>

                <a {{#if userAccess.userinfo.db.username }}
                   href="<?="/{$seo_name["page"]["user"]}?manage=postjob";?>"
                   {{else}}
                   href="/<?=$seo_name["page"]["cmp"]?>/{{userAccess.userinfo.db.id}}{{urlFriendly userAccess.userinfo.db.name}}"
                   {{/if}}
               >

                   {{#if userAccess.userinfo.db.im}}
                       <span class="icon-avatar">
                           <img src="/<?=FOLDERIMAGEUSER?>{{userAccess.userinfo.db.im}}">
                       </span> 
                   {{else}}
                       <span class="icon-avatar">
                           <i class="fa fa-user"></i>
                       </span>
                   {{/if}}

                <a href="/{{#if userAccess.userinfo.db.username}}{{userAccess.userinfo.db.username}} {{else}}/<?=$seo_name["page"]["cmp"]?>/{{userAccess.userinfo.db.id}}{{{urlFriendly userAccess.userinfo.db.name}}}{{/if}}" class="{{#if elmData.pageOfUser}}active{{/if}}">
                    {{defineVariable.l10n.mypage}} &nbsp;&nbsp;|
                </a>

                <a href="<?="/{$seo_name["page"]["user"]}?manage=jobs"?>" class="{{#if elmData.jobs }}active{{/if}}">
                    {{defineVariable.l10n.jobs}} <strong class="text-color2">({{userAccess.totalJob}})</strong> &nbsp;&nbsp;|
                </a>

                <a href="<?="/{$seo_name["page"]["user"]}?manage=userapply"?>" class="{{#if elmData.userapply}}active{{/if}}">
                    {{defineVariable.l10n.jobApplications}} &nbsp;&nbsp;|
                </a>
  
                <a href="<?="/{$seo_name["page"]["user"]}?manage=info"?>">
                    {{defineVariable.l10n.setting}} &nbsp;&nbsp;|
                </a>


                <span class="otooltip hidden">
                    

                        <span class="name-u-top short-text hidden">{{userAccess.userinfo.db.name}}</span> <i class="fa fa-caret-down"></i></a>


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
                    data-redirect="/">{{defineVariable.l10n.signout}}</a>

            {{else}}
                <span class="otooltip">
                    <a href="/<?=$seo_name["page"]["cv"]?>/{{userAccess.userinfo.db.id}}{{{urlFriendly userAccess.userinfo.db.name}}}">
                    {{#if userAccess.userinfo.db.im}}
                        <span class="icon-avatar">
                            <img src="/<?=FOLDERIMAGEUSER?>{{userAccess.userinfo.db.im}}">
                        </span>
                    {{else}}
                        <span class="icon-avatar">
                            <i class="fa fa-user"></i>
                        </span>    
                    {{/if}}

                    <a href="{{#if userAccess.userinfo.db.username}}{{userAccess.userinfo.db.username}} {{else}}/<?=$seo_name["page"]["cv"]?>/{{userAccess.userinfo.db.id}}{{{urlFriendly userAccess.userinfo.db.name}}}{{/if}}" class="{{#if elmData.pageOfUser}}active{{/if}}">
                       {{defineVariable.l10n.mypage}} &nbsp;&nbsp;|
                    </a>

                    <a href="<?="/{$seo_name["page"]["user"]}?manage=jobsave"?>" class="{{#if elmData.jobsave}}active{{/if}}">
                       {{defineVariable.l10n.jobs}} &nbsp;&nbsp;|
                    </a>

                    <a href="<?="/{$seo_name["page"]["user"]}?manage=info"?>">
                       {{defineVariable.l10n.setting}} &nbsp;&nbsp;|
                    </a>

                    <span class="name-u-top hidden">{{userAccess.userinfo.db.name}}</span> <i class="fa fa-caret-down hidden "></i></a>
                    
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
                    data-redirect="/">{{defineVariable.l10n.signout}}</a>
                
            {{/xif}}



        {{else}}
            <a href="<?="/{$seo_name["page"]["user"]}";?>">{{defineVariable.l10n.pleaseUpdateInfomation}}</a>
        {{/if}}
        </div>
    {{else}}
        <div class="welcome">
            <a href="/emp" class="btn bg-color3 text-bold"><i class="fa fa-file-text-o"></i> {{defineVariable.l10n.btnPostJob}}</a>

            <a href="/rg"
                class="btn bg-color6">{{defineVariable.l10n.signup}}</a>

            <a href="/user?manage=company#group-view=2"
                    class="btn bg-color6"
                    data-button-magic
                    data-elm-data='{"urlRedirect":"."}'
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entrySigninPopup"><i class="fa fa-lock"></i>&nbsp; {{defineVariable.l10n.signin}}</a>
            <a href="#"
                    class="btn bg-color6 hidden"
                    data-button-magic
                    data-elm-data='{"urlRedirect":"."}'
                    data-view-template-local="true"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entrySignupWithPromoCode">Promocode</a>
        </div>
    {{/if}}