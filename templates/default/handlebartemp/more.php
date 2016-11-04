<script id="entryCvItemApplied" type="text/x-handlebars-template">
    <div class="item bg-grey-color1 cv-less">
        <div class="row">
            <div class="col-xs-4 col-sm-4">
                <div class="img b-r-4 pr-div-small i-center">
                    <figure>
                        <a href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.t i.ji}}}?statistics=1&cid={{i.db.id}}&uname={{i.db.name}}">
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
                <a  class="text-color1 text-color1 text-bold" 
                    href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.t i.ji}}}?statistics=1&cid={{i.db.id}}&uname={{i.db.name}}">
                    {{i.db.name}}
                </a>
                <p class="short-text text-bold"> {{i.db.title}}</p>
                <p class="u-age short-text c-list">{{{textFromDropdownLocal i.db.level 'jobLevel' 'id' 'ti'}}}</p>
                <p class="u-age hidden"> {{{getOldFromYMD i.db.dob}}} {{d.l10n.yearsold}}</p>
            </div>
        </div>
    </div>
</script>
<script id="userManageAppliedManage" type="text/x-handlebars-template">
    <div class="item bg-grey-color1 cv-less">
        <div class="row">
            <div class="col-xs-4 col-sm-4">
                <div class="img b-r-4 pr-div-small i-center">
                    <figure>
                        <a href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.t i.ji}}}?statistics=1&cid={{i.ui}}&uname={{i.name}}">
                        {{#if i.im}}    
                            <img alt="" class="image-load" data-img="/<?=FOLDERIMAGEUSER?>{{i.im}}" src="/media/images/style/user.png">
                        {{else}}
                            <img alt="" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">

                        {{/if}} 

                        </a>
                    </figure>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 short-text">
                <a  class="text-color1 text-color1 text-bold" 
                    href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.t i.ji}}}?statistics=1&cid={{i.ui}}&uname={{i.name}}">
                    {{i.name}}
                </a>
                <p class="short-text text-bold">{{i.title}} - <span class="u-age short-text c-list">{{{textFromDropdownLocal i.l 'jobLevel' 'id' 'ti'}}}</span></p>
                <p class="u-age short-text c-list">{{i.t}}</p>
            </div>
        </div>
    </div>
</script>
<script id="entryCmpUpdateInfoVersion2" type="text/x-handlebars-template">
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
                            <span class="btn p-r-10">www.thue.today/</span>
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
                <div data-radio class="edit-show">
                    {{#each dropdown.menuStructure}}
                        {{#xif ' this.opp == 3 '}}
                        <label class="no-margin no-padding p-r-10">
                            <input
                            type="radio"
                            value="{{this.id}}"
                            name="db.category.{{this.is}}"
                            {{checkRadioValue ../../i.db.category this.id}}
                            data-validate
                            data-required>
                            <div class="radio-select b-r-4 m-b-5">
                            <p>{{this.ti}}</p>
                            </div>
                        </label>
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
                        <div class="col-xs-offset-2 col-xs-10 text-right">

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
                <div class="col-xs-offset-2 col-xs-10">
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
<script id="entryUserJobFunctionBasic" type="text/x-handlebars-template">
    {{#if u.userinfo}}
        {{#xif ' this.u.userinfo.db.type == 2 '}}
        <div class="j-user-function m-t-5">
            <div class="btn-applied-save text-uppercase">
                {{#if u.user_cv}}
                <div class="btn-block btn-apply show-unsave show-unsave-apply-{{e.id}} {{#xSubString e.id u.appliedjob.strjo ','}}active{{/xSubString}}">
                    <span class="btn btn-block bg-color5 text-uppercase  btn-unsave disabled">
                        <i class="fa fa-check-circle-o"></i> {{d.l10n.btnApplied}}
                    </span>

                    <span class="btn btn-apply btn-block bg-color5 text-uppercase btn-save"
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
                <span class="btn btn-apply-without-cv btn-block bg-color5 text-uppercase btn-save"
                        data-elm-data='{
                            "cvPopup":"true",
                            "hiddenMenuLeft":"1"
                        }'
                        data-button-magic
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="entryUserUpdateCV"><i class="fa fa-file-text-o"></i>  {{d.l10n.btnApply}}</span>
                {{/if}}

                <div class="btn-block hidden btn-favorite show-unsave show-unsave-{{e.id}} {{#xSubString e.id u.savedjob.strjo ','}}active{{/xSubString}}">
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

                    <span class="btn btn-block bg-color2 btn-save text-uppercase hidden"
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
               
            </div>
        </div>
        {{else}}
            {{#xif ' this.e.ei == this.u.userinfo.db.id'}}
               
                <div class="j-user-function m-t-5 text-right">
                    <a href="/<?=$seo_name["page"]["user"];?>?manage=postjob&jid={{e.id}}&pid={{e.pid}}"
                        class="btn bg-color4"
                        data-button-magics
                        data-method="get"
                        data-ajax-url="<?=APIGETJOB?>/{{e.id}}"
                        data-elm-data='{"urlRedirect":"."}'
                        data-view-template="[data-quick-view-item]"
                        data-template-id="jobsAdd"><span class="fa fa-pencil"></span></a>
                    <a href="{{e.job_link}}" class="btn bg-color4"><i class="fa fa-eye"></i></a> 

                    
                </div>

            {{/xif}}
        {{/xif}}
    {{else}}

        <div class="j-user-function m-t-5">
 
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
                class="btn btn-block btn-apply-without-signin bg-color5 btn-save text-uppercase">
                    <i class="fa fa-file-text-o"></i> {{d.l10n.btnApplyNow}}
            </a>

           </div>
    {{/if}}
</script>

<script id="viewItemJobRightSearch" type="text/x-handlebars-template">
<div class="item i-blog no-m-top i-search">
    <div class="j-search m-b-10">
        <div class="t-s-11 text-color4 no-margin c-list">{{{textFromDropdownLocal i.ty 'jobTimeOption' '' ''}}}</div>

        <div class="j-title transition">
           <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}} {{#if e.userManageJobInSide}}?statistics=1{{/if}}">
              <div class="j-name transition no-margin">{{i.ti}}</div>
           </a>
        </div>
        
        <strong class="text-color3 t-s-12">{{#xif " this.i.sn==1"}}
            {{d.l10n.negotiable}}
        {{else}}
            {{#xif " this.i.sa==1"}}
                {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
            {{else}}
                {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
            {{/xif}}
        {{/xif}}</strong>
        
        <p class="text-salary hidden">{{{textFromDropdownLocal i.ex 'yearOfExperience' 'id' 'ti'}}}</p>
        <p class="text-postby short-text">
            <span class="text-color4">{{d.l10n.postby}}</span>
            <span class="text-color2 j-level">{{i.na}}</span>
        </p>
        <p class="text-address"><p class="text-address c-list">{{{textFromDropdownLocal i.lo 'locationOption' '' ''}}}</p></p>
    </div>
</div>
</script>

<script id="viewBannerHomeVersion2" type="text/x-handlebars-template">
<div class="banner-left v-center">
    <div class="t-t">
            {{{d.l10n.homeBannerContent}}}
        <form   class="form-inline s-b-form"
                action="/<?=$seo_name["page"]["search"]?>">
            <div class="form-group">
                <input  type="hidden" name="distinct" value="1">
                <input  class="form-control i-p-t"
                        name="title" value=""
                        placeholder="{{#if e.searchSeeker}}{{d.l10n.placeholderSearchCv}}{{else}}{{d.l10n.placeholderSearchJob}}{{/if}}" >
                
                <span class="select-wrapper">
                    <select name="loc"
                        class="form-control "
                        type="select"
                        data-validate
                        data-required="{{d.l10n.optCity}}"
                        data-object-init='{"id":"", "ti":"{{d.l10n.locationSearch}}"}'
                        data-dropdown
                        data-index-value="{{#if i.db.ci}}{{i.db.ci}}{{else}}30{{/if}}"
                        data-option-local-json="location"
                        data-option-from-json="<?=APIGETLOCATION;?>">
                        <option value="">{{d.l10n.optCity}}</option>
                    </select>
                </span>

            </div>
            <div class="form-group">
                <button class="btn bg-color3 text-uppercase"><span class="icon-search icon-search1 hidden-xs"> </span> <span class=" hidden-sm hidden-lg">{{d.l10n.btnSearch}}</span></button>
            </div>

            <div class="clearfix"></div>
            <div class="form-group m-t-10 w-100">
                <a class="btn bg-color6 text-uppercase b-r-4 btn-block btn-search-map" 
                    href="/<?=$seo_name["page"]["search"]?>?map=view">
                   <i class="fa fa-map-marker"></i> {{d.l10n.searchByMap}}
                </a>
            </div>
        </form>
    </div>
</div>
</script>

<script id="viewListHtmContentHome" type="text/x-handlebars-template">
    <div class="col-sm-4 {{#xif ' this.e.active== this.i.url ' }}current{{/xif}}">
        <a href="/{{i.url}}">   
            {{#xif " this.e.la == 'en' "}}
                {{i.ti_en}}
            {{else}}
                {{i.ti_vi}}
            {{/xif}}
        </a>
    </div>
</script>

<script id="viewSearchCategory" type="text/x-handlebars-template">
{{#each dropdown.menuStructure}}
    {{#xif ' this.opp == 3 '}}
    <label class="checkbox">
        <input name="cati[]"
               type="checkbox"
               {{checkboxValue ../../e.selected this.id}}
               value="{{this.id}}">
        <span class="checkbox-style"></span>
        <span>{{this.ti}}</span>
    </label>
    {{/xif}}
{{/each}}
</script>

<script id="viewSearchCategorySection" type="text/x-handlebars-template">
{{#each dropdown.menuStructure}}
    {{#xif ' this.opp == 3 '}}
    <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../e.selected this.id}}">
        <input  class="b-r-4"
                name="cati[]"
               {{checkboxValue ../../e.selected this.id}}
                type="checkbox"
                value="{{this.id}}">
        <span class="checkbox-style"></span>
        <span class="tx">{{this.ti}}</span>
    </div>

    {{/xif}}
{{/each}}
</script>

<script id="viewItemJobSuggestSmall" type="text/x-handlebars-template">
<div class="item i-blog no-m-top i-search">
    <div class="j-search m-b-10">
        <div class="t-s-11 text-color4 no-margin c-list">{{{textFromDropdownLocal i.ty 'jobTimeOption' '' ''}}}</div>

        <div class="j-title transition">
           <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}} {{#if e.userManageJobInSide}}?statistics=1{{/if}}">
              <div class="j-name transition no-margin">{{i.ti}}</div>
           </a>
        </div>
        <strong class="text-color3">{{#xif " this.i.sn==1"}}
            {{d.l10n.negotiable}}
        {{else}}
            {{#xif " this.i.sa==1"}}
                {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
            {{else}}
                {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
            {{/xif}}
        {{/xif}}</strong>
        <p class="text-salary hidden">{{{textFromDropdownLocal i.ex 'yearOfExperience' 'id' 'ti'}}}</p>
        {{#if e.showCmp}}
        <p class="text-postby short-text">
            <span class="text-color4">{{d.l10n.postby}}</span>
            <span class="text-color2 j-level">{{i.na}}</span>
        </p>
        {{/if}}
        <p class="text-address"><p class="text-address c-list">{{{textFromDropdownLocal i.lo 'locationOption' '' ''}}}</p></p>
    </div>
</div>
</script>

<script id="entryUserManageMessages" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-3">
        <div class="user-menu-action"
             data-elm-data='{"messages":"1"}'
             data-copy-template
             data-view-template=".user-menu-action"
             data-template-id="entryUserMenuSetting"></div>
    </div>
    <div class="col-sm-9">
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
            data-template-id="entryCheckoutItem">

            <div data-messages class="table-responsive p-10">
                <table class="table table-bordered">
                    <colgroup>
                        <col class="col-sm-1">
                        <col class="col-sm-3">
                        <col class="col-sm-7">
                        <col class="col-sm-1">
                    </colgroup>
                    <thead>
                        <tr class="b-b bg-grey-color1">
                            <th></th>
                            <th>{{d.l10n.name}}</th>
                            <th>{{d.l10n.description}}</th>
                            <th>{{d.l10n.date}}</th>
                        </tr>
                       
                    </thead>
                    <tbody class="view-items" data-content>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</script>

<script id="entrySelectUserMessage" type="text/x-handlebars-template">
<div data-candidate-message
    class="item user-message b-b {{#if e.selected}}{{#xif ' this.e.selected == this.i.db.id '}}selected{{/xif}}{{/if}}"
    data-name="{{i.db.name}}"
    data-id="{{i.db.id}}"
    data-image="{{i.db.im}}">
    <div class="row">
        <div class="col-xs-1 col-sm-1">
            <div class="img i-center pr-div b-cover b-r-4">
                <figure>
                    <a href="#">
                        {{#if i.db.im}}
                        <img alt="" class="image-load" data-img="/<?=FOLDERIMAGEUSER?>{{i.db.im}}" src="/media/images/style/user.png">
                        {{else}}
                        <img alt="" class="image-load" data-img="/media/images/style/user-profile.png" src="/media/images/style/user-profile.png">
                        {{/if}}
                    </a>    
                </figure>
            </div>
        </div>
        <div class="col-xs-11 col-sm-11">
            <h3 class="no-margin text-color1 t-s-14">
                {{i.db.name}} <span class="item-show-new text-color2">( {{d.l10n.new}} )</span>
            </h3>
        </div>
    </div>
</div>
</script>

<script id="selectCompanyOption" type="text/x-handlebars-template">
 <div class="select-wrapper b-r-4 no-margin w-100">
    <select name="db.company_id"
        data-dropdown
        data-validate
        data-required="{{d.l10n.require}}"
        data-str-key="id"
        data-str-value="name"
        data-index-value="{{#if e.company_id}}{{e.company_id}}{{/if}}"
        data-option-local-json="yourCompany"
        data-object-init='{"id":"", "name":"{{d.l10n.company}}"}'
        class="form-control">
    </select>
</div>
<span class="error">{{d.l10n.require}}</span>
</script>

<script id="entryLoadMessage" type="text/x-handlebars-template">
<tr data-message-item 
    class="user-message b-b {{#if e.page}}{{else}}{{#xif ' this.i.status == 0 '}}new{{/xif}}{{/if}}">
    <td size-action class="col-sm-1">
        <label class="checkbox">
            <input  name="db.mid.{{i.id}}"
                    type="checkbox"
                    data-key-name="db.mid"
                    value="{{i.id}}.{{i.employer_id}}.{{i.user_id}}.{{i.company_id}}">
            <span class="checkbox-style"></span>
        </label>
    </td>
    <td size-action class="col-sm-1">
        {{#xif ' this.e.action == "trash" '}}
        <i class="fa fa-trash text-color4"></i>
        {{else}}
        <div class="btn-favorite show-unfavorite-{{i.id}} {{#xif ' this.i.important == 1 '}}active{{/xif}}">
            <span class="unfavorite text-color2"
                    data-button-magic
                    data-method="post"
                    data-format-json="true"
                    data-ajax-url="<?=APIPOSTMESSAGES?>"
                    data-success-toggle-class=".show-unfavorite-{{i.id}},active"
                    data-params='{  "db":{  "employer_id" : "{{i.employer_id}}",
                                            "company_id"  : "{{i.company_id}}",  
                                            "user_id"     : "{{i.user_id}}",
                                            "sender_id"   : "{{i.sender_id}}",
                                            "receiver_id" : "{{i.receiver_id}}",
                                            "message_id"  : "{{i.id}}" },
                                    "action" : "unimportant" 
                                }'
                    data-show-success=".alert-footer.alert"
                    data-show-errors=".alert-footer.alert-error"
                    data-show-errors-template="entrySigninPopup"
                    data-view-template="[data-quick-view-item1]"
                    data-redirects="."><i class="fa fa-star"></i></span>
            <span class="favorite"
                    data-button-magic
                    data-method="post"
                    data-format-json="true"
                    data-ajax-url="<?=APIPOSTMESSAGES?>"
                    data-params='{  "db":{  "employer_id" : "{{i.employer_id}}",
                                            "company_id"  : "{{i.company_id}}",  
                                            "user_id"     : "{{i.user_id}}",
                                            "sender_id"   : "{{i.sender_id}}",
                                            "receiver_id" : "{{i.receiver_id}}",
                                            "message_id"  : "{{i.id}}" },
                                    "action" : "important" 
                                }'
                    data-success-toggle-class=".show-unfavorite-{{i.id}},active"
                    data-show-success=".alert-footer.alert"
                    data-show-errors=".alert-footer.alert-error"
                    data-show-errors-template="entrySigninPopup"
                    data-view-template="[data-quick-view-item1]"

                    data-show-hide=""
                    data-redirects="."><i class="fa fa-star-o"></i></span>
        </div>
        {{/xif}}
    </td>
    <td>
        <div class="row">
                 
                {{#xif ' this.e.type == 1 '}}
                <!-- <div class="img i-center pr-div b-cover b-r-4 no-shadow">
                    <figure>
                        <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                        
                            {{#if i.user_image}}
                            <img alt="{{i.user_name}}" class="image-load" data-img="/{{e.imagefolder}}{{i.user_image}}" src="/media/images/style/user.png">
                            {{else}}
                            <img alt="{{i.user_name}}" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                            {{/if}}
                        </a>    
                    </figure>
                </div> -->
                {{else}}
                <div class="col-sm-2">
                    <div class="img i-center pr-div b-cover b-r-4 no-shadow">
                        <figure>
                            <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    
                                {{#if i.company_image}}
                                <img alt="{{i.company_name}}" class="image-load" data-img="/{{e.imagefolder}}{{i.company_image}}" src="/media/images/style/user.png">
                                {{else}}
                                <img alt="{{i.company_name}}" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                                {{/if}}
                            </a>    
                        </figure>
                    </div>
                </div>
                {{/xif}}
                       
            <div class="col-sm-10 short-text">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    {{#xif ' this.e.action == "sent" '}}
                        {{d.l10n.to}}: 
                    {{/xif}}
                    {{#xif ' this.e.type == 1 '}}
                        {{i.user_name}} 
                    {{else}}
                        {{i.company_name}}
                    {{/xif}}
                    {{#xif ' i.total_reply > 0 '}}({{i.total_reply}}){{/xif}}
                </a>
            </div>
        </div>    
    </td>
    <td>
        <div class="row">
            {{#xif ' this.e.type == 1 '}}
            <div class="col-sm-1">
                <div class="img i-center pr-div b-cover b-r-4 no-shadow">
                    <figure>
                        <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                            {{#if i.company_image}}
                            <img alt="{{i.company_name}}" class="image-load" data-img="/<?=FOLDERIMAGECOMPANY?>thumbnail/{{i.company_image}}" src="/media/images/style/user.png">
                            {{else}}
                            <img alt="{{i.company_name}}" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                            {{/if}}
                        </a>
                    </figure>
                </div>
            </div>
            {{/xif}}
            <div class="col-sm-11 short-text">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    {{#xif ' this.i.message_id !=0 '}}RE: {{/xif}}{{i.subject}} - <span class="text-color4">{{{shortenText i.message 70}}}</span>
                </a>
            </div>
        </div>
    </td>
    
    <td class="col-sm-2">{{{formatDate i.created_date '%d-%M-%Y'}}}</td>
</tr>
</script>

<script id="entryLoadMessageMobile" type="text/x-handlebars-template">
<div data-message-item
     class="user-message b-b {{#if e.page}}{{else}}{{#xif ' this.i.status == 0 '}}new{{/xif}}{{/if}}">
    
    <div class="row">
        <div image-thumbnail-mobile class="col-xs-2">
            {{#xif ' this.e.type == 1 '}}
            <div class="img i-center pr-div b-cover b-r-4 no-shadow">
                <figure>
                    <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    
                        {{#if i.user_image}}
                        <img alt="{{i.user_name}}" class="image-load" data-img="/{{e.imagefolder}}{{i.user_image}}" src="/media/images/style/user.png">
                        {{else}}
                        <img alt="{{i.user_name}}" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                        {{/if}}
                    </a>    
                </figure>
            </div>
            {{else}}
            <div class="img i-center pr-div b-cover b-r-4 no-shadow">
                <figure>
                    <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
            
                        {{#if i.company_image}}
                        <img alt="{{i.company_name}}" class="image-load" data-img="/{{e.imagefolder}}{{i.company_image}}" src="/media/images/style/user.png">
                        {{else}}
                        <img alt="{{i.company_name}}" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                        {{/if}}
                    </a>    
                </figure>
            </div>
            {{/xif}}
        </div>
        <div class="col-xs-7">
            {{#xif ' this.e.type == 1 '}}
            <div class="short-text">
                <a  href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    <span class="text-color4 t-s-11">{{d.l10n.to}}:</span> <span class="text-bold t-s-11 text-color2">{{i.company_name}}</span>
                </a>
            </div>
            {{/xif}}
            <div class="short-text">
                <a  href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    <span class="text-bold text-color1">{{#xif ' this.e.action == "sent" '}}
                        {{d.l10n.to}}: 
                    {{/xif}}

                    {{#xif ' this.e.type == 1 '}}
                        {{i.user_name}} 
                    {{else}}
                        {{i.company_name}}
                    {{/xif}}
                    </span> -
                    <span>{{#xif ' this.i.message_id !=0 '}}RE: {{/xif}}{{i.subject}}</span>
                    {{#xif ' i.total_reply > 0 '}}({{i.total_reply}}){{/xif}}
                </a>
            </div>
            <div class="short-text">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=view&mid={{i.id}}{{#if e.page}}&type=sent{{/if}}">
                    
                    <p class="text-color4 t-s-11">{{{shortenText i.message 70}}}</p>
                </a>
            </div>

        </div>
        <div class="col-xs-3 text-right">
            <span class="t-s-11 text-color4">{{{formatDate i.created_date '%d-%M-%Y'}}}</span>
            {{#xif ' this.e.action == "trash" '}}
            <i class="fa fa-trash text-color4"></i>
            {{else}}
            <div class="btn-favorite show-unfavorite-{{i.id}} {{#xif ' this.i.important == 1 '}}active{{/xif}}">
                <span class="unfavorite text-color2"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTMESSAGES?>"
                        data-success-toggle-class=".show-unfavorite-{{i.id}},active"
                        data-params='{  "db":{  "employer_id" : "{{i.employer_id}}",
                                                "company_id"  : "{{i.company_id}}",  
                                                "user_id"     : "{{i.user_id}}",
                                                "sender_id"   : "{{i.sender_id}}",
                                                "receiver_id" : "{{i.receiver_id}}",
                                                "message_id"  : "{{i.id}}" },
                                        "action" : "unimportant" 
                                    }'
                        data-show-success=".alert-footer.alert"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-errors-template="entrySigninPopup"
                        data-view-template="[data-quick-view-item1]"
                        data-redirects="."><i class="fa fa-star"></i></span>
                <span class="favorite"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTMESSAGES?>"
                        data-params='{  "db":{  "employer_id" : "{{i.employer_id}}",
                                                "company_id"  : "{{i.company_id}}",  
                                                "user_id"     : "{{i.user_id}}",
                                                "sender_id"   : "{{i.sender_id}}",
                                                "receiver_id" : "{{i.receiver_id}}",
                                                "message_id"  : "{{i.id}}" },
                                        "action" : "important" 
                                    }'
                        data-success-toggle-class=".show-unfavorite-{{i.id}},active"
                        data-show-success=".alert-footer.alert"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-errors-template="entrySigninPopup"
                        data-view-template="[data-quick-view-item1]"

                        data-show-hide=""
                        data-redirects="."><i class="fa fa-star-o"></i></span>
            </div>
            {{/xif}}
        </div>
    </div>
</div>
</script>
<script id="entryFormSendMessagePopup" type="text/x-handlebars-template">
<div class="modal-dialog modal-signup" data-send-message-popup>
    <div class="modal-content p-10">
        <div class="modal-header">
            <div class="title text-center">
                <h4 class="text-color1 t-s-20 text-bold no-margin">{{d.l10n.writemessages}}</h4>
            </div>
            <span class="position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"><i class="fa fa-times-circle"></i></span>
        </div>
        <div class="modal-body modal-signin p-10">
            <div class="row">
                <div class="col-sm-12">
                    <div class="message-compose">
                        <form method="post" class="form-horizontal post-form">
                            <div class="hidden">
                                <input data-user-id name="db.user_id" type="text" value="{{e.db.user_id}}">
                                <input data-sender-id name="db.sender_id" type="text" value="{{e.db.employer_id}}">
                                <input data-receiver-id name="db.receiver_id" type="text" value="{{e.db.receiver_id}}">
                                <input name="db.employer_id" type="text" value="{{e.db.employer_id}}">
                                <input name="updateNode" type="text" value="db">
                                <input name="action" type="text" value="send">
                            </div>
                            <div class="block transition">
                                
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <div class="company-list form-group"
                                            data-copy-template
                                            data-elm-data='{"company_id":"{{e.db.company_id}}"}'
                                            data-view-template=".company-list"
                                        data-template-id="selectCompanyOption"></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-2">
                                        {{#if e.db.user_image}}
                                        <img    class="img-responsive b-r-4"
                                        user-thumbnail
                                        width="50"
                                        height="50"
                                        src="/<?=FOLDERIMAGEUSER?>{{e.db.user_image}}" />
                                        {{else}}
                                        <img alt="" class="img-responsive b-r-4" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                                        {{/if}}
                                        
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input  data-receiver-message
                                            type="text"
                                            class="form-control"
                                            value="{{e.db.user_name}}"
                                            data-validate
                                            data-required="{{d.l10n.require}}"
                                            data-request-window-loaded
                                            disabled
                                            name="db.receiver"
                                            placeholder="{{d.l10n.selectreceiver}}" />
                                            <span class="error">{{d.l10n.require}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <div class="form-group">
                                            <input  class="form-control"
                                            type="text"
                                            value=""
                                            data-subject
                                            data-validate
                                            data-required="{{d.l10n.require}}"
                                            name="db.subject"
                                            placeholder="{{d.l10n.subjectmessage}}" />
                                            <span class="error">{{d.l10n.require}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <div class="form-group">
                                            <textarea  name="db.message"
                                            data-required="{{d.l10n.require}}"
                                            data-validate
                                            data-message
                                            placeholder="{{d.l10n.typeamessage}}"
                                            data-required="{{d.l10n.require}}"
                                            class="form-control more"></textarea>
                                            <span class="error">{{d.l10n.require}}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-2 col-xs-6">
                                        <button class="bg-color1 btn m-r-10"
                                        type="submit"
                                        data-submit
                                        class="btn bg-color1 text-uppercase"
                                        data-button-magic
                                        data-params-form=".post-form"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTMESSAGES?>"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        data-show-hide=",[data-modal-quick-view]"
                                        value="{{d.l10n.btnSave}}">
                                        <i class="fa fa-send"></i> <span>{{d.l10n.send}}</span>
                                        </button>
                                        <button class="bg-color2 btn hidden">
                                        <i class="fa fa-save"></i> <span>{{d.l10n.btnSave}}</span>
                                        </button>
                                    </div>
                                    <div class="col-sm-5 text-right col-xs-6">
                                        <button data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]" data-reset type="reset" value="Reset" class="bg-color5 btn">
                                        <i class="fa fa-times"></i> <span>{{d.l10n.btnCancel}}</span>
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    
                    <div class="message-report alert" data-fade="4500">
                        <div class="sms-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</script>

<script id="viewItemBlogFbThue" type="text/x-handlebars-template">
<div class="item i-blog">
    <div class="sortcontent">
        <div class="fb-img image-load" style="background:url({{i.full_picture}}) no-repeat;-webkit-background-size: cover;-o-background-size: cover;background-size: cover;background-position:center center">
          <div class="action text-left">
           <span>{{i.likes.summary.total_count}} {{#xif ' this.i.likes.summary.total_count>1 '}} {{d.l10n.likes}} {{else}} {{d.l10n.like}} {{/xif}}</span>
           <span>{{i.comments.summary.total_count}} {{#xif ' this.i.comments.summary.total_count>1 '}} {{d.l10n.comments}} {{else}} {{d.l10n.comment}} {{/xif}}</span>
           <span>{{#if i.shares.count}} {{i.shares.count}} {{else}} 0 {{/if}} {{#xif ' this.i.shares.count>1 '}} {{d.l10n.shares}} {{else}} {{d.l10n.share}} {{/xif}}</span>
          </div>  
        </div>
        <p class="textarea-content m-t-15">{{{i.message}}}</p>
    </div>
</div>
</script>


<script id="entryCmpPageSimpleListMobile" type="text/x-handlebars-template">
{{#each dropdown.yourCompany}}
<li>
    <div class="row">
        <div class="col-sm-1 col-xs-2 text-center">
            
            <span class="icon-avatar">
                <a href="/{{this.url}}">
                 {{#if this.im}}
                       <img alt="{{this.name}}" class="image-load b-r-4 " src="/<?=FOLDERIMAGECOMPANY?>{{this.im}}" >
                    {{else}}
                       <img alt="{{this.name}}" class="image-load b-r-4 " src="/media/images/style/user.png" >
                    {{/if}}
                </a>
            </span>
        </div>
        <div class="col-sm-11 col-xs-10">
            <a href="/{{this.url}}"><span>{{this.name}}</span></a>
        </div>
    </div>
</li>
{{/each}}
</script>

<script id="viewItemJobSearchBrand" type="text/x-handlebars-template">
<div class="item i-blog no-m-top i-search transition status-{{i.st}}">
    <div class="img i-center">
        <figure>
            <a href="/{{i.us}}/<?=$seo_name["page"]["jobs"]?>">
                {{#if i.im}}
                <img alt="{{i.na}}" class="image-load b-r-4" data-img="/<?=FOLDERIMAGECOMPANY?>thumbnail/{{i.im}}" src="/media/images/style/ajax-loader.gif" >
                {{else}}
                <img alt="{{i.na}}" class="image-load b-r-4" data-img="/media/images/style/user.png" src="/media/images/style/ajax-loader.gif" >
                {{/if}}
            </a>
        </figure>
    </div>
    <div class="c-t-s-j transition">
        <div class="j-search short-text">
            <a class="short-text" href="//{{i.us}}/<?=$seo_name["page"]["jobs"]?>">
                <p class="short-text t-s-16 text-color1 text-bold"><span>{{i.na}}</span></p>
                <p class="short-text text-color2 t-s-12 c-list short-text">{{{textFromDropdownLocal i.ca 'menuList' ''}}}</p>
                <p class="short-text text-color4 t-s-11">{{i.total_jobs}} {{#xif ' this.i.total_jobs > 1 '}}{{d.l10n.jobpositions}}{{else}}{{d.l10n.jobposition}}{{/xif}}</p>
            </a>
        </div>
    </div>
</div>
</script>

<script id="viewItemComment" type="text/x-handlebars-template">
<span class="comment-jump" id="{{i.id}}"></span>
<div comment-row  class="row">
    <div class="col-xs-1">
        <div class="img i-center pr-div b-cover b-r-4 no-shadow">
            <figure>
                <a href="/{{i.company_url}}">
                    {{#if i.company_image}}
                    <img alt="{{i.company_name}}" class="image-load" data-img="/<?=FOLDERIMAGECOMPANY?>thumbnail/{{i.company_image}}" src="/media/images/style/user.png">
                    {{else}}
                    <img alt="{{i.company_name}}" class="image-load" data-img="/media/images/style/user.png" src="/media/images/style/user.png">
                    {{/if}}
                </a>
            </figure>
        </div>
    </div>
    <div class="col-xs-11">
        <p class="text-bold text-color1 t-s-16">{{i.company_name}}</p>
        <div class="star-rating-cv">{{{getRatingStar i.rate}}} - {{{formatDate i.created_date '%d-%M-%Y at %H:%m'}}}</div>
        <div class="textarea-content">{{i.content}}</div>
        {{#if u.userinfo.db.id}}
            {{#xif ' this.u.userinfo.db.id == this.i.eid'}}
                <div class="text-right text-color4 comment-action">
                    <span class="btn"
                        data-button-magic
                        data-method="get"
                        data-elm-data='{"company_id":"{{i.company_id}}"}'
                        data-ajax-url="<?=APIGETCOMMENT?>/{{u.userinfo.db.id}}?uid={{i.uid}}&pid={{i.pid}}&comment_id={{i.id}}&action=view"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="entryUserFormMessageEdit"><i class="fa fa-pencil"></i> <span> {{d.l10n.btnEdit}}</span> </span>
                    
                    <span class="btn"
                        data-confirm="true"
                        data-confirm-content="{{d.l10n.confirmDeleteContent}}"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTCOMMENT?>/{{u.userinfo.db.id}}?uid={{i.userinfo.db.id}}"
                        data-params='{  "db": {"current_id": "{{u.userinfo.db.id}}", 
                                               "{{u.userinfo.db.id}}" : "{{i.id}}.{{i.eid}}.{{i.uid}}.{{i.pid}}",
                                               "updateNode": "db"},
                                        "action" :"delete"  }'
                        data-refress-list=".item-view-comment"><i class="fa fa-trash-o"></i> <span> {{d.l10n.btnDelete}}</span> </span>
                </div>
            {{/xif}}
        {{/if}}
    </div>
</div>
</script>
<script id="entryUserFormMessageEdit" type="text/x-handlebars-template">
<form class="post-form user-manage-feature form-horizontal modal-dialog popup-history popup-location-company">
    <div class="modal-content">
        <div class="modal-header">
            <div class="hidden">
               <input name="db.uid" type="text" value="{{i.uid}}">
               <input name="db.eid" type="text" value="{{u.userinfo.db.id}}">
               <input name="db.pid" type="text" value="{{i.pid}}">
               <input name="action" type="text" value="comment">
               <input name="db.comment_id" type="type" value="{{i.id}}">
               <input name="updateNode" type="text" value="db">
            </div>
            <div class="title">
                <h3 class="text-color2">{{d.l10n.location}}</h3>
            </div>
            <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3">
                    {{d.l10n.content}}
                </label>
                <div class="col-sm-9">
                    <textarea name="db.content"
                        data-required="{{d.l10n.require}}"
                        data-validate
                        data-message
                        placeholder="{{d.l10n.typeamessage}}"
                        data-required="{{d.l10n.require}}"
                        class="form-control more-sm">{{{i.content}}}</textarea>
                        <span class="error">{{d.l10n.require}}</span>
                </div>
            </div>
        </div>

        <div class="modal-footer">

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
                    data-refress-list=".item-view-comment"
                    value="{{d.l10n.btnSave}}">
                    <i class="fa fa-save"></i> <span>{{d.l10n.btnSave}}</span>
            </button>
            
            <span data-closet-toggle-class="in"
                data-object=".modal"
                data-empty-object="[data-quick-view-item1]"
                class="btn bg-color5 text-uppercase">
                {{d.l10n.btnCancel}}
            </span>

        </div>
    </div>
</form>
</script>

<script id="selectCompanyOptionComment" type="text/x-handlebars-template">
 <div class="select-wrapper b-r-4 no-margin w-100">
    <select name="db.pid"
        data-dropdown
        data-validate
        data-required="{{d.l10n.require}}"
        data-str-key="id"
        data-str-value="name"
        data-index-value="{{#if e.company_id}}{{e.company_id}}{{/if}}"
        data-option-local-json="yourCompany"
        class="form-control">
    </select>
</div>
<span class="error">{{d.l10n.require}}</span>
</script>

