<script id="jobSearchAdvance" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-12"><p class="text-bold">{{d.l10n.total}}: <span class="text-color3" data-total-item></span> <span class="text-lowercase">{{e.tabName}}<span> </div>
    <div class="col-sm-12">
        <div class="filter-hori"
                      data-copy-template
                      data-view-template=".filter-hori"
                      data-elm-data='{"totalNumber":"data-total-item","titleName":"{{d.l10n.peopleAppliedJob}}'
                      data-template-id="entryCmpFilterJobHorizontalOther">&nbsp;</div>
    </div>
</div>
</script>

<script id="entryCmpPostJob" type="text/x-handlebars-template">
{{#xif " this.u.usersub.id && (this.u.usersub.id != this.e.pid)" }}
    <!-- Warning invalid post job -->
    <div class="user-donot-access"
        data-elm-data='{"managejob":"1"}'
        data-copy-template
        data-view-template=".user-donot-access"
        data-template-id="entryUserNotifyDonotAccess"></div>
{{else}}
    <form method="post" class="form-horizontal post-form post-form-signup">
        <div class="row m-b-10 header-update">
            <div class="col-sm-9">
                <div data-post-job class="cmp-more no-border no-padding">
                    <span class="company-header-job-post"
                            data-copy-template
                            data-elm-data='{"create":"1","update":"1","postjob":"1","current":"{{e.pid}}"}'
                            data-option-local="companyInfomation"
                            data-view-template=".company-header-job-post" data-template-id="entryCmpCurrentPage"></span>

                    <span class="t-s-18 text-color1 text-bold no-margin">{{#if i.db.id}} {{d.l10n.updateJob}} {{else}} {{d.l10n.postNewJob}} {{/if}}</span>

                    {{#unless u.usersub}}
                    <a href="/<?=$seo_name["page"]["user"];?>?manage=postjob"
                            class="btn bg-color7 form-add btn-add-a-item btn-change-page pull-right"
                            data-button-magic
                            data-view-template-local="true"
                            data-view-template="[data-quick-view-item]"
                            data-elm-data='{"urlRedirect":"/{{u.userinfo.db.username}}"}'
                            data-view-template-local="true"
                            data-view-template="[data-quick-view-item]"
                            data-template-id="entryPostJobOptionCompany">
                            <span class="fa fa-retweet"></span> <span class="hidden-sm hidden-xs text-uppercase text-bold">{{d.l10n.changePage}}</span>
                        </a>
                    {{/unless}}

                    <a  href="#"
                        class="pull-right text-color2"
                        data-template-id="popupHowtoCreateAPage"
                        data-elm-data='{"youtube":"VTGwP7pB9xg"}'
                        data-view-template="[data-quick-view-item]"
                        data-view-template-local="true"
                        data-button-magic>
                       <span>{{d.l10n.howtopostajob}}</span>
                    </a>


                </div>
            </div>

            <div class="col-sm-9 block">
                <div class="hidden">

                    <input type="text"
                    class="form-control"
                    name="db.ui"
                    value="{{u.userinfo.db.id}}">

                    <input type="text"
                    class="form-control"
                    name="db.id"
                    value="{{i.db.id}}">

                    <input type="text"
                    class="form-control"
                    name="updateNode"
                    value="db">

                    <input type="text"
                    class="form-control"
                    id="lat"
                    name="db.lat"
                    value="{{i.db.lat}}">

                    <input type="text"
                    class="form-control"
                    id="lng"
                    name="db.lng"
                    value="{{i.db.lng}}">

                    <input type="text"
                    class="form-control"
                    id="lo"
                    name="db.lo"
                    value="{{i.db.lo}}">

                </div>
                
                <div class="m-b-10">
                    <div class="block-title bg-color5 text-uppercase text-bold">
                        <label>{{d.l10n.generalInformation}}</label>
                    </div>
                    <div class="block-content">
                        <div class="form-group hidden">
                            <label class="col-sm-2 control-label col-xs-12">
                            {{d.l10n.company}}
                            </label>
                            <div class="col-sm-10">
                                <span class="select-wrapper">
                                    <select name="db.ci"
                                        data-validate
                                        data-required="{{d.l10n.require}}"
                                        data-dropdown
                                        {{#if e.pid}}
                                        data-index-value="{{e.pid}}"
                                        {{else}}
                                        data-index-value="{{i.db.ci}}"
                                        {{/if}}
                                        data-str-key="id"
                                        data-str-value="name"
                                        data-option-local-json="yourCompany"
                                        class="form-control">
                                    </select>
                                </span>
                                <span class="error">{{d.l10n.require}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">{{d.l10n.workingLocation}} <span class="require">*</span></label>
                            <div class="col-sm-10 col-xs-12 item-view-location"
                                    data-view-list-by-handlebar
                                    data-init-button-magic=".item [data-button-magic]"
                                    data-url="<?=APIGETCOMPANY;?>/{{e.pid}}/location/{{u.userinfo.db.id}}"
                                    data-method="get"
                                    data-show-page="10"
                                    data-show-item="20"
                                    data-elm-data='{"location_id":"{{i.db.location_id}}"}'
                                    data-show-all="false"
                                    data-scroll-view="false"
                                    data-template-id="viewItemCmpLocationSelect">
                                    <div class="view-items row" data-radio data-content>
                                        <div class="style-loadding">...</div>
                                    </div>
                                    <span class="error">{{d.l10n.require}}</span>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10 col-xs-12">
                                <span class="btn bg-color1 add_location input-sm"
                                    data-button-magic
                                    data-view-template-local="true"
                                    data-view-template="[data-quick-view-item1]"
                                    data-elm-data='{"company_id":"{{e.pid}}"}'
                                    data-template-id="entryUserFormCmpLocation">
                                    <i class="fa fa-plus"></i> 
                                    <span>{{d.l10n.btnAddAddress}}</span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-2 control-label col-xs-12">{{d.l10n.jobTitle}} <span class="require">*</span></label>
                              <div class="col-sm-10 col-xs-12">
                              <input  type="text"
                                    name="db.ti"
                                    value="{{i.db.ti}}"
                                    placeholder="{{d.l10n.typeYourPositionYouLookingFor}}"
                                    data-validate
                                    data-required="{{d.l10n.require}}"
                                    class="form-control job-title">
                                    <span class="error"></span>
                              </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-2 control-label col-xs-12">{{d.l10n.jobExpires}} <span class="require">*</span></label>
                              <div class="col-sm-10 col-xs-12">
                               
                                    <input type="text"
                                      name="db.de"
                                      data-validate
                                      data-required="{{d.l10n.requireContent}}"
                                      {{#if i.db.id}}
                                      {{#xif " this.i.db.de && this.i.db.de !== '00-00-0000'"}}
                                      value="{{{formatDayDMY i.db.de}}}"
                                      {{/xif}}
                                      {{else}}
                                      value="{{{formatDate u.userinfo.db.dayleft '%d-%M-%Y'}}}"
                                      {{/if}}
                                      data-date-picker=""
                                      data-format="DD-MM-YYYY"
                                      data-single-date-picker="true"
                                      class="form-control">
                                       
                                    <span class="error"></span>
                              </div>
                        </div>


                        <input name="db.ca" value="{{e.cat}}" type="hidden" />
                        
                        <div class="form-group from-salary">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.jobSalary}} <span class="require">*</span>
                            </label>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control salary-input"
                                            name="db.s1"
                                            value="{{formatCurrency i.db.s1}}"
                                            data-validate
                                            data-required="{{d.l10n.require}}"
                                            onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                                            onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); } else if(event.which ==13) { $(this).trigger('change'); }"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                                            placeholder="{{d.l10n.from}}">
                               <span class="error"></span>

                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control salary-input"
                                            name="db.s2"
                                            value="{{formatCurrency i.db.s2}}"
                                            data-validate
                                            data-required="{{d.l10n.require}}"
                                            onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                                            onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); } else if(event.which ==13) { $(this).trigger('change'); }"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                                            placeholder="{{d.l10n.to}}">
                                        <span class="error"></span>

                                    </div>
                                    <div class="col-xs-4">
                                       <span class="select-wrapper">
                                        <select name="db.sa"
                                            type="select"
                                            data-required="{{d.l10n.require}}"
                                            data-dropdown
                                            data-index-value="{{i.db.sa}}"
                                            data-option-local-json="currency"
                                            class="form-control">
                                        </select>
                                      </span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="checkbox edit-show text-color3 text-bold check-nego">
                                    <input name="db.sn"
                                           type="checkbox"
                                           {{#xif " this.i.db.sn == 1 "}}
                                           checked="checked"
                                           {{/xif}}
                                           value="1">
                                    <span class="checkbox-style text-color3"></span>{{d.l10n.negotiable}}
                                </label>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.employeeFrom}} <span class="require">*</span>
                            </label>
                            <div data-checkbox-validate class="col-sm-10 col-xs-12">
                                {{#each dropdown.countryShort}}
                                <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../i.db.co this.id}}">
                                    <input class="b-r-4"
                                    name="db.co.{{this.id}}"
                                    type="checkbox"
                                    data-key-name="db.co"
                                    {{checkboxValue ../../i.db.co this.id}}
                                    value="{{this.id}}">
                                    <span class="checkbox-style"></span>
                                    <span class="tx">{{this.ti}}</span>
                                </div>
                                {{/each}}
                                <span class="error">{{d.l10n.require}}</span>
                            </div>
                        </div>
                   </div>
                </div>

                <div class="m-b-10">
                   <div class="block-title bg-color5 text-uppercase text-bold">
                       <label>{{d.l10n.jobInformation}}</label>
                   </div>
                   <div class="block-content">
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.jobLevel}} <span class="require">*</span>
                            </label>
                            <div data-checkbox-validate class="col-sm-10 col-xs-12">
                                {{#each dropdown.jobLevel}}
                                <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../i.db.le this.id}}">
                                    <input class="b-r-4"
                                    name="db.le.{{this.id}}"
                                    type="checkbox"
                                    data-key-name="db.le"
                                    {{checkboxValue ../../i.db.le this.id}}
                                    value="{{this.id}}">
                                    <span class="checkbox-style"></span>
                                    <span class="tx">{{this.ti}}</span>
                                </div>

                                {{/each}}
                                <span class="error">{{d.l10n.require}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.yearOfExperience}} <span class="require">*</span>
                            </label>
                            <div data-checkbox-validate class="col-sm-10 col-xs-12">
                                {{#each dropdown.yearOfExperience}}
                                <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../i.db.ex this.id}}">
                                    <input class="b-r-4"
                                    name="db.ex.{{this.id}}"
                                    type="checkbox"
                                    data-key-name="db.ex"
                                    {{checkboxValue ../../i.db.ex this.id}}
                                    value="{{this.id}}">
                                    <span class="checkbox-style"></span>
                                    <span class="tx">{{this.ti}}</span>
                                </div>
                                {{/each}}
                                <span class="error">{{d.l10n.require}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.jobType}} <span class="require">*</span>
                            </label>
                            <div data-checkbox-validate class="col-sm-10 col-xs-12">
                                {{#each dropdown.jobTime}}
                                <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../i.db.ty this.id}}">
                                    <input class="b-r-4"
                                    name="db.ty.{{this.id}}"
                                    type="checkbox"
                                    data-key-name="db.ty"
                                    {{checkboxValue ../../i.db.ty this.id}}
                                    value="{{this.id}}">
                                    <span class="checkbox-style"></span>
                                    <span class="tx">{{this.ti}}</span>
                                </div>
                                {{/each}}
                                <span class="error">{{d.l10n.require}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.language}} <span class="require">*</span>
                            </label>
                            <div data-checkbox-validate class="col-sm-10 col-xs-12">
                                {{#each dropdown.languageOption}}
                                <div class="checkbox btn-checkbox b-r-4 {{checkboxValue ../../i.db.la this.id}}">
                                    <input class="b-r-4"
                                    name="db.la.{{this.id}}"
                                    type="checkbox"
                                    data-key-name="db.la"
                                    {{checkboxValue ../../i.db.la this.id}}
                                    value="{{this.id}}">
                                    <span class="checkbox-style"></span>
                                    <span class="tx">{{this.ti}}</span>
                                </div>
                                {{/each}}
                                <span class="error">{{d.l10n.require}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                               <p> {{d.l10n.jobSkill}}</p>
                            </label>
                            <div class="col-sm-10 col-xs-12">
                                
                                <textarea
                                name="more.requirement"
                                data-required="{{d.l10n.require}}"
                                class="form-control more">{{i.more.requirement}}</textarea>
                                <span class="error"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.jobDescription}}
                            </label>
                            <div class="col-sm-10 col-xs-12">
                                <textarea
                                name="more.description"
                                data-required="{{d.l10n.require}}"
                                class="form-control more">{{i.more.description}}</textarea>
                                <span class="error"></span>
                                <span class="text-color1">*</span> <span class="t-s-12">{{d.l10n.jobDescriptionNote}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.jobConditionAndBenefit}}
                            </label>
                            <div class="col-sm-10 col-xs-12">
                                <textarea
                                name="more.benefit"
                                data-required="{{d.l10n.require}}"
                                class="form-control more">{{i.more.benefit}}</textarea>
                                <span class="error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                               <p> {{d.l10n.keyword}}</p>
                            </label>
                            <div class="col-sm-10 col-xs-12">
                                
                                <textarea
                                name="more.keyword"
                                data-required="{{d.l10n.require}}"
                                class="form-control more skill-tag">{{i.more.keyword}}</textarea>
                                <span class="error"></span>

                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 col-xs-12">
                                {{{d.l10n.keywordJobSkill}}}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label col-xs-12">
                                {{d.l10n.status}}
                            </label>
                            <div class="col-sm-2">
                              <span class="select-wrapper">
                               <select  type="select"
                                    name="db.st"
                                    data-dropdown
                                    placeholder="2"
                                    data-index-value="{{#if i.db.st}}{{i.db.st}}{{else}}2{{/if}}"
                                    data-option-local-json="jobStatus"
                                    data-object-init='{"id":"", "ti":""}'
                                    class="form-control">
                                </select>
                              </span>
                            </div>
                        </div>
                   </div>

                </div>

                <div class="form-group">
                    <div class="btn-action">
                      <div class="action-content">
                        <div class="col-sm-12 text-right">
                            <a href="<?="/".$seo_name["page"]["user"]."?manage=jobs"?>" class="btn text-uppercase text-bold bg-color5 m-r-10"><i class="fa fa-times"></i> {{d.l10n.btnCancel}}</a>
                            
                            {{#if i.db.id}}
                            <a class="btn bg-color2 m-r-10" target="_blank" href="<?="/".$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}"><i class="fa fa-eye"></i> {{d.l10n.view}}</a>
                            {{/if}}

                            <button type="submit"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTJOB?>"
                            data-show-success=".alert-footer.alert"
                            data-show-errors=".alert-footer.alert-error"
                            data-show-hide=",[data-modal-quick-view]"
                            data-redirect="<?="/".$seo_name["page"]["user"]."?manage=jobs"?>"
                            class="btn bg-color1 text-uppercase text-bold"
                            value="{{#if i.db.id}} {{d.l10n.btnUpdate}} {{else}} {{d.l10n.btnSaveAndPost}} {{/if}}">
                            <i class="fa fa-check"></i> <span>{{#if i.db.id}}{{d.l10n.btnSave}}{{else}}{{d.l10n.btnSaveAndPost}}{{/if}}</span>
                            </button>

                        </div>
                      </div>
                    </div>
                </div>

                {{#if e.autofilejob}}
                <div class="block m-b-10 no-m-top hidden">
                    <div class="header-tab block-title bg-color1 text-uppercase">
                        <label>{{d.l10n.autoFieldContent}}</label>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                           <span class="select-wrapper">
                            <select name="autofilejob"
                                class="form-control"
                                data-dropdown
                                data-option-from-json="<?=APIGETMENU;?>"
                                data-option-local-json="menuStructure"
                                data-dropdown-relative="jobsuggest"
                                data-params-relative="jobsuggest="
                                data-params="opp=3"
                                data-object-init='{"id":"", "ti":"{{d.l10n.categoryOption}}"}'
                                data-target-append=".multiselect-category">
                                <option value="">{{d.l10n.categoryOption}}</option>
                            </select>
                          </span>

                        </div>
                        <div class="form-group">
                           <span class="select-wrapper">
                            <select class="form-control"
                                name="jobsuggest"
                                type="select-from-json"
                                data-params="jobsuggest"
                                data-dropdown
                                data-option-from-json="<?=APIGETCATEGORY;?>">
                                <option value="">{{d.l10n.jobPositionRequired}}</option>
                            </select>
                          </span>
                        </div>
                        <div class="form-group no-m-bottom">
                            <button class="btn bg-color1 text-uppercase w-100">{{d.l10n.fastField}}</button>
                        </div>

                    </div>
                </div>
                {{/if}}

            </div>

            <div class="col-sm-3">
                <div class="user-menu-action"
                        data-elm-data='{"managejob":"1"}'
                        data-copy-template
                        data-view-template=".user-menu-action"
                        data-template-id="entryUserMenuSetting"></div>
            </div>
            
        </div>
    </form>
{{/xif}}
</script>

<script id="entryUserManageJob" type="text/x-handlebars-template">
<div class="row jobs-management">
    <div class="col-sm-9">
        <div class="item-view-more side-bar"
            data-view-list-by-handlebar
            data-init-button-magic=".item [data-button-magic]"
            data-init-objects="userManageJob"
            data-url="<?=APIGETJOB;?>"
            {{#if u.usersub.id}}
            data-params="uid={{u.userinfo.db.id}}&cid={{u.usersub.id}}&ne=1"
            {{else}}
            data-params="uid={{u.userinfo.db.id}}&ne=1"
            {{/if}}
            data-method="get"
            data-show-page="10"
            data-show-item="20"
            data-show-all="false"
            data-scroll-view="false"
            data-form-filter=".form-filter"
            data-is-reload-page="true"
            data-reload-base-on-id="id"
            data-reload-base-set-params="listID"
            data-reload-url="<?=APIGETJOBLISTID?>"
            data-template-id="{{#if e.lineLayout}}viewItemJobCmpLine{{else}}viewItemJobCmp{{/if}}">

            <div class="row admin-title">
                <div class="col-sm-12">
                    <h2 class="pull-left text-color1">{{d.l10n.jobManage}} (<span data-total-item></span>) </h2>

                    <a class="btn bg-color3 form-add btn-add-a-item"
                        {{#if u.usersub.id}}
                        href="/<?=$seo_name["page"]["user"];?>?manage=postjob&pid={{u.usersub.id}}"
                        {{else}}
                        data-button-magic
                        {{/if}}
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-elm-data='{"urlRedirect":"/{{u.userinfo.db.username}}"}'
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="entryPostJobOptionCompany">
                        <span class="icon-file-text2"></span> <span class="hidden-sm text-uppercase text-bold">{{d.l10n.btnPostJob}}</span>
                    </a>

                    <a class="btn bg-color1 form-add btn-add-a-item" href="<?="/{$seo_name["page"]["user"]}?manage=userapply"?>" class="">
                     <span class="fa fa-users"></span> <span class="hidden-sm text-uppercase text-bold">{{#if e.newapplicant}}( {{e.newapplicant}} {{d.l10n.new}} ) {{/if}} {{d.l10n.jobApplications}} </span>

                    </a>

                    <a class="pull-right btn bg-color7 {{#if e.lineLayout}}active{{/if}}" href="/<?=$seo_name["page"]["user"];?>?manage=jobs&line=1"><i class="fa fa-list"></i></a>
                    <a class="pull-right btn bg-color7 {{#unless e.lineLayout}}active{{/unless}} m-r-10" href="/<?=$seo_name["page"]["user"];?>?manage=jobs"><i class="fa fa-list-alt"></i></a>

                </div>
            </div>
            <div class="filter-hori"
              data-copy-template
              data-view-template=".filter-hori"
              data-elm-data='{"totalNumber":"data-total-item","titleName":"<?=$language["peopleAppliedJob"]?>"}'
              data-template-id="entryCmpFilterJobHorizontal">&nbsp;</div>

            <div class="view-items" data-content><div class="style-loadding">...</div></div>

            <div class="no-data">
                <div class="no-data-content">{{d.l10n.noJobPosted}}</div>
            </div>

            <div class="row admin-title">
                <div class="col-sm-9">
                    <div data-footer></div>
                </div>
                <div class="col-sm-3 text-right">
                    <a class="btn bg-color3 form-add btn-add-a-item"
                        {{#if u.usersub.id}}
                        href="/<?=$seo_name["page"]["user"];?>?manage=postjob&pid={{u.usersub.id}}"
                        {{else}}
                        data-button-magic
                        {{/if}}
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-elm-data='{"urlRedirect":"/{{u.userinfo.db.username}}"}'
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="entryPostJobOptionCompany">
                        <span class="icon-file-text2"></span> <span class="hidden-sm text-uppercase text-bold">{{d.l10n.btnPostJob}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 hidden-xs">
        <div class="user-menu-action"
            data-elm-data='{"managejob":"1"}'
            data-copy-template
            data-view-template=".user-menu-action"
            data-template-id="entryUserMenuSetting"></div>

        <div class="admin-title hidden">
            <button class="btn btn-block bg-color2 text-uppercase">
            {{d.l10n.btnUpgrateAccountVip}}
            </button>
        </div>
        
        <div class="list-side-r">
            <h2 class="title-box text-color2">{{d.l10n.appliedLast}}</h2>
            <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-object="userManageApplied"
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETUSERACTION;?>"
                {{#if u.usersub.id}}
                data-params="uid={{u.userinfo.db.id}}&cid={{u.usersub.id}}&action=userapply&limit=5"
                {{else}}
                data-params="uid={{u.userinfo.db.id}}&action=userapply&limit=5"
                {{/if}}
                data-elm-data='{"userapply":"1", "userManageAction":"1"}'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-is-reload-page="false"
                data-scroll-view="false"
                data-ignore-hash="true"
                data-template-id="userManageAppliedManage" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
            <div class="">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=usersave" class="btn btn-block bg-color3 text-uppercase btn-save transition">{{d.l10n.viewMore}}</a>
            </div>
        </div>

        <div class="list-side-r">
            <h2 class="title-box text-color2">{{d.l10n.savedLast}}</h2>
            <div class="item-view-more" 
                data-view-list-by-handlebar
                data-init-object="userManageSaved"
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETUSERACTION;?>"
                data-params="uid={{u.userinfo.db.id}}&action=usersave&limit=5"
                data-elm-data='{"usersave":"1"}'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="true"
                data-scroll-view="false"
                data-ignore-hash="true"
                data-is-reload-page="false"
                data-reload-base-on-id="ui"
                data-reload-base-set-params="listID"
                data-reload-url="<?=APIGETUSERLISTID?>"
                data-template-id="entryCvItem">
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
            <div class="">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=usersave" class="btn btn-block bg-color2 text-uppercase btn-save transition">{{d.l10n.viewMore}}</a>
            </div>
        </div> 

    </div>
</div>
</script>

<script id="jobsAdd" type="text/x-handlebars-template">
<div class="modal-dialog modal-menu-edit">
    <div class="modal-content">
        <div class="modal-header">
            <div class="admin-title">
                {{#if e.modalClose}}
                <h2>{{d.l10n.suggestedJobs}}</h2>
                {{else}}
                <h2>{{d.l10n.jobManage}} :: {{d.l10n.btnAdd}}</h2>
                {{/if}}
            </div>
            <span class="icon-cancel-circle icon-lg1 position-right"
                data-closet-toggle-class="in"
                data-object=".modal"
                data-empty-object="{{#if e.modalClose}}{{e.modalClose}}{{else}}[data-quick-view-item]{{/if}}"></span>
        </div>
        <div class="modal-body">
            <form method="post"
                class="form-horizontal post-form post-form-signup">
                <div class="hidden">
                    {{#if e.jobSuggest}}
                        <input type="text"
                          class="form-control"
                          name="updateNode"
                          value="jobSuggest">
                        <input type="text"
                          class="form-control"
                          name="id"
                          value="{{e.itemId}}">
                        <input type="text"
                          class="form-control"
                          name="db.id"
                          value="{{i.db.id}}">
                    {{else}}
                        <input type="text"
                        class="form-control"
                        name="db.ui"
                        value="{{u.userinfo.db.id}}">
                        <input type="text"
                        class="form-control"
                        name="db.id"
                        value="{{i.db.id}}">
                        <input type="text"
                        class="form-control"
                        name="updateNode"
                        value="db">
                    {{/if}}
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.title}}
                    </label>
                    <div class="col-sm-10">
                        <input  type="text"
                        name="db.ti"
                        value="{{i.db.ti}}"
                        data-validate
                        data-required="{{d.l10n.requireTitle}}"
                        class="form-control">
                        <span class="error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobTime}}
                    </label>
                    <div class="col-sm-10">
                        <select name="db.ty"
                            type="select"
                            data-validate
                            data-required="{{d.l10n.requireTitle}}"
                            data-dropdown
                            data-index-value="{{i.db.ty}}"
                            data-option-local-json="jobTime"
                            class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobLevel}}
                    </label>
                    <div class="col-sm-10">
                        <select name="db.le"
                            type="select"
                            data-validate
                            data-required="{{d.l10n.requireTitle}}"
                            data-dropdown
                            data-index-value="{{i.db.le}}"
                            data-option-local-json="jobLevel"
                            data-object-init='{"id":"", "ti":"{{d.l10n.jobLevel}}"}'
                            class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.yearOfExperience}}
                    </label>
                    <div class="col-sm-10">
                        <select  type="select"
                            name="db.ex"
                            data-dropdown
                            data-index-value="{{i.db.ex}}"
                            data-option-local-json="yearOfExperience"
                            data-object-init='{"id":"", "ti":"{{d.l10n.optional}}"}'
                            class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobCategories}}
                    </label>
                    <div class="col-sm-10">
                        <select name="categorylist"
                            class="form-control"
                            data-multiselect-box
                            data-multiselect-box-max="3"
                            data-multi-selected="{{i.db.ca}}"
                            data-key-name="db.ca"
                            data-validate
                            data-required="{{d.l10n.requireContent}}"
                            data-dropdown
                            data-option-from-json="<?=APIGETMENU;?>"
                            data-option-local-json="menuStructure"
                            data-params="opp=3"
                            data-object-init='{"id":"", "ti":"{{d.l10n.categoryOption}}"}'
                            data-target-append=".multiselect-category">
                            <option value="">{{d.l10n.categoryOption}}</option>
                        </select>
                        <div data-show-options-list class="multiselect-category"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobLocations}}
                    </label>
                    <div class="col-sm-10">
                        <select name="locationlist"
                            class="form-control"
                            data-multiselect-box
                            data-multiselect-box-max="3"
                            data-multi-selected="{{i.db.lo}}"
                            data-key-name="db.lo"
                            data-validate
                            data-required="{{d.l10n.requireContent}}"
                            data-dropdown
                            data-option-local-json="location"
                            data-option-from-json="<?=APIGETLOCATION;?>"
                            data-object-init='{"id":"", "ti":"{{d.l10n.jobLocations}}"}'
                            data-target-append=".multiselect-location">
                            <option value="">{{d.l10n.optLocation}}</option>
                        </select>
                        <div data-show-options-list class="multiselect-location"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobSalary}}
                    </label>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-xs-4">
                                <input type="text" class="form-control"
                                    name="db.s1"
                                    value="{{formatCurrency i.db.s1}}"
                                    data-validate
                                    data-required="{{d.l10n.requireTitle}}"
                                    onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                                    onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); }"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                                    placeholder="{{d.l10n.from}}">
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="form-control"
                                    name="db.s2"
                                    value="{{formatCurrency i.db.s2}}"
                                    data-validate
                                    data-required="{{d.l10n.requireTitle}}"
                                    onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                                    onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); }"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                                    placeholder="{{d.l10n.to}}">
                            </div>
                            <div class="col-xs-4">
                                <select name="db.sa"
                                    type="select"
                                    data-validates
                                    data-required="{{d.l10n.requireTitle}}"
                                    data-dropdown
                                    data-index-value="{{i.sa}}"
                                    data-option-local-json="currency"
                                    class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="checkbox edit-show">
                            <input name="db.sn"
                                   type="checkbox"
                                   {{#xif " this.i.db.sn==1 "}}
                                   checked="checked"
                                   {{/xif}}
                                   value="1">
                            <span class="checkbox-style"></span> {{d.l10n.negotiable}}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobNumber}}
                    </label>
                    <div class="col-sm-10">
                        <input  type="text"
                        name="more.number"
                        value="{{i.more.number}}"
                        data-validate
                        data-required="{{d.l10n.requireTitle}}"
                        class="form-control">
                        <span class="error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobDescription}}
                    </label>
                    <div class="col-sm-10">
                        <textarea
                        name="more.description"
                        data-validate
                        data-required="{{d.l10n.requireContent}}"
                        class="form-control more">{{i.more.description}}</textarea>
                        <span class="error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobRequirement}}
                    </label>
                    <div class="col-sm-10">
                        <textarea
                        name="more.requirement"
                        data-validate
                        data-required="{{d.l10n.requireContent}}"
                        class="form-control more">{{i.more.requirement}}</textarea>
                        <span class="error"></span>
                    </div>
                </div>
                {{#unless e.jobSuggest}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.language}}
                    </label>
                    <div class="col-sm-10">
                        <select type="select"
                            name="db.la"
                            data-dropdown
                            data-index-value="{{i.db.la}}"
                            data-option-local-json="languageOption"
                            data-object-init='{"id":"", "ti":"{{d.l10n.requireLanguage}}"}'
                            class="form-control">
                        </select>
                        <span class="error"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        {{d.l10n.jobExpires}}
                    </label>
                    <div class="col-sm-10">
                        <input type="text"
                            name="db.de"
                            data-validate
                            data-required="{{d.l10n.requireContent}}"
                            {{#xif " this.i.db.de && this.i.db.de !== '0000-00-00'"}}
                            value="{{i.db.de}}"
                            {{/xif}}
                            data-date-picker=""
                            data-format="YYYY-MM-DD"
                            data-single-date-picker="true"
                            data-show-dropdowns="true"
                            class="form-control">
                        <span class="error"></span>
                    </div>
                </div>
                {{/unless}}
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        {{#if e.jobSuggest}}
                            <button type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="{{e.urlPost}}"
                                data-show-success=".alert-footer.alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-show-hide=",[data-quick-view-item1]"
                                data-refress-list=".modal .item-menu-suggest"
                                class="btn btn-primary"
                                value="{{#if i.db.ti}} {{d.l10n.btnUpdate}} {{else}} {{d.l10n.btnAdd}} {{/if}}"><i class="fa fa-check"></i> <span>{{#if i.db.ti}} {{d.l10n.btnUpdate}} {{else}} {{d.l10n.btnAdd}} {{/if}}</span></button>
                        {{else}}
                        <button type="submit"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTJOB?>"
                            data-show-success=".alert-footer.alert"
                            data-show-errors=".modal.signin-missing-session"
                            data-show-hide=",[data-modal-quick-view]"
                            {{#if e.urlRedirect}}
                            data-redirect="{{e.urlRedirect}}"
                            {{/if}}
                            data-refress-list=".user-manage-feature [data-view-list-by-handlebar]"
                            class="btn btn-primary"
                            value="{{#if i.db.ti}} {{d.l10n.btnUpdate}} {{else}} {{d.l10n.btnAdd}} {{/if}}"><i class="fa fa-check"></i> <span>{{#if i.db.ti}} {{d.l10n.btnUpdate}} {{else}} {{d.l10n.btnAdd}} {{/if}}</span></button>
                        {{/if}}
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-10">
                    <div class="alert text-left" data-fade="2000">
                        <div class="sms-content"></div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <span class="btn btn-default" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]">Close</span>
                </div>
            </div>
        </div>
    </div>
</div>
</script>
<script id="entryJobItem" type="text/x-handlebars-template">
<div class="item item-blog item-status-{{i.st}}">
    <div class="row">
        <div class="col-xs-5">
            <div class="row">
                <div class="col-xs-3">{{i.id}}</div>
                <div class="col-xs-9">{{i.ti}}</div>
            </div>
        </div>
        <div class="col-xs-2">
            <span>{{{textFromDropdownLocal i.le 'jobLevel' 'id' 'ti'}}}</span>
        </div>
        <div class="col-xs-2">
            <div class="c-list">{{{textFromDropdownLocal i.ca 'menuList' ''}}}</div>
        </div>
        <div class="col-xs-2">
            {{#xif " this.i.st > 0 "}}
            <span>{{{textFromDropdownLocal i.st 'jobStatus' 'id' 'ti'}}}</span>
            {{else}}
            {{d.l10n.draft}}
            {{/xif}}
        </div>
        <div class="col-xs-1 btn-control text-right">
            {{#if e.adminList}}
            <span class="otooltip">
                <span
                    class="icon-pencil icon-lg"
                    data-button-magic
                    data-method="get"
                    data-ajax-url="<?=APIGETJOB?>/{{i.id}}"
                    data-view-template="[data-quick-view-item]"
                    data-elm-data='{"adminList":1}'
                data-template-id="entryJobView"></span>
                <span class="otooltip-content otooltip-r">{{{d.l10n.reviewPost}}}</span>
            </span>
            {{else}}
            <span
                class="icon-pencil icon-lg"
                title="Edit id {{i.id}}"
                data-button-magic
                data-method="get"
                data-ajax-url="<?=APIGETJOB?>/{{i.id}}"
                data-view-template="[data-quick-view-item]"
            data-template-id="jobsAdd"></span>
            <span
                class="icon-bin icon-lg"
                title="Delete"
                data-button-magic
                data-confirm="true"
                data-method="post"
                data-format-json="true"
                data-params='{ "id":"{{i.id}}"}'
                data-ajax-url="<?=APIPOSTBLOGDEL?>"
            data-refress-list=".item-view-more"> </span>
            {{/if}}
        </div>
    </div>
</div>
</script>
<script id="entryJobView" type="text/x-handlebars-template">
    <div class="cmp-more">
        <label class="text-color1 j-stitle t-s-18">General information</label>

        <div class="j-view-option row">
            <div class="col-sm-3"> <label>{{d.l10n.jobTitle}}</label></div>
            <div class="col-sm-9"> <span>{{i.db.ti}}</span></div>
        </div>
        <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.jobLocations}}</label></div>
            <div class="col-sm-9">
              <span class="c-list">
                  {{{textFromDropdownLocal i.db.lo 'locationOption' ''}}}
              </span>
            </div>
        </div>
        <div class="j-view-option row hidden">
            <div class="col-sm-3"> <label>{{d.l10n.jobNumber}}</label></div>
            <div class="col-sm-9"> <span>{{i.more.number}}</span></div>
        </div>

        <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.jobCategories}}</label></div>
            <div class="col-sm-9">
                <span class="c-list">
                  {{{textFromDropdownLocal i.db.ca 'menuList' ''}}}
                </span>
            </div>
        </div>

        <div class="j-view-option row">
            <div class="col-sm-3">
                <label>{{d.l10n.jobSalary}}</label>
            </div>
            <div class="col-sm-9">
              <span class="text-color3 text-bold">
                  {{#xif " this.i.db.sn==1"}}
                      {{d.l10n.negotiable}}
                  {{else}}
                      {{#xif " this.i.db.sa==1"}}
                          {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
                      {{else}}
                          {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
                      {{/xif}}
                  {{/xif}}
              <span>
            </div>
        </div>
    </div>
    <div class="cmp-more">
        <label class="text-color1 j-stitle t-s-18">{{d.l10n.jobInformation}}</label>

            <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.jobLevel}}</label></div>
            <div class="col-sm-9">
                <span class="c-list">{{{textFromDropdownLocal i.db.le 'jobLevelOption' ''}}}</span>
            </div>
        </div>


            <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.experienceWork}}</label></div>
            <div class="col-sm-9">
                <span class="c-list">{{{textFromDropdownLocal i.db.ex 'yearOfExperienceOption' ''}}}</span>
            </div>
        </div>

        <div class="j-view-option row">
            <div class="col-sm-3"> <label>{{d.l10n.jobTime}}</label></div>
            <div class="col-sm-9">
                <span class="c-list">{{{textFromDropdownLocal i.db.ty 'jobTimeOption' ''}}}</span>
            </div>
        </div>
        <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.language}} </label></div>
            <div class="col-sm-9">
                <span class="c-list">{{{textFromDropdownLocal i.db.la 'langOption' ''}}}</span>
            </div>
        </div>
            <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.jobRequirement}}</label></div>
            <div class="col-sm-9">
                <p class="textarea-content">{{addCommaSpace i.more.requirement}}</p>
            </div>
        </div>

        <div class="j-view-option row">
            <div class="col-sm-3"><label>{{d.l10n.jobDescription}}</label></div>
            <div class="col-sm-9">
                <p class="textarea-content">{{i.more.description}}</p>
            </div>
        </div>
    </div>
</script>
<script id="viewItemJobAction" type="text/x-handlebars-template">
<div class="item item-cv u-s-j">
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class="j-level text-color2 t-s-16">
                <span class="c-list">{{{textFromDropdownLocal i.db.le 'jobLevelOption' '' ''}}}</span> <span class="t-s-16 text-color4"> - {{{textFromDropdownLocal i.db.lo 'location' 'id' 'ti'}}}</span>
            </div>
            <a class="j-title text-color1" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}">
               {{i.db.ti}}
            </a>

            <strong class="text-color3 t-s-16">
                {{#xif " this.i.db.sn==1"}}
                    {{d.l10n.negotiable}}
                {{else}}
                    {{#xif " this.i.db.sa==1"}}
                        {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
                    {{else}}
                        {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
                    {{/xif}}
                {{/xif}}
            </strong>

            <p class="c-list">
              {{{textFromDropdownLocal i.db.ex 'yearOfExperienceOption' '' ''}}}
            </p>
            <div>
                <span>{{d.l10n.postby}}</span> <label class="text-color2">{{i.cmp.name}}</label>
            </div>
            {{#if e.savejob}}
            <div class="i-info-detail">
                <p class="hidden-more">{{{shortenText i.more.description 250}}}</p>
                <div class="view-more">
                    <div class="more-detail">
                        <h3 class="text-color2">{{d.l10n.jobDescription}}</h3>
                        <p class="textarea-content">{{{i.more.description}}}</p>
                    </div>
                    <div class="more-detail">
                        <h3 class="text-color2">{{d.l10n.jobRequirement}}</h3>
                        <p class="textarea-content">{{addCommaSpace i.more.requirement}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-more bg-g-white" data-closet-toggle-class="active" data-object=".item-cv" >
                <a href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.db.ti i.db.id}}}" class="btn view-less text-uppercase"><strong>+ {{d.l10n.viewMore}}</strong></a>
            </div>
            {{/if}}
        </div>
        <div class="col-xs-12 col-sm-3">
            {{#if e.savejob}}
                <div class="btn-block show-unsave show-unsave-apply-{{i.jo}} {{#xSubString i.jo u.appliedjob.strjo ','}}active{{/xSubString}}">
                    <span class="btn btn-block bg-color3 text-uppercase  btn-unsave disabled">
                        <span class="icon-checkmark1"></span> {{d.l10n.btnApply}}
                    </span>
                    <span class="btn btn-block bg-color3 text-uppercase btn-save"
                        data-elm-data='{
                            "toggle":".show-unsave-apply-{{i.jo}},active",
                            "db":{
                                "jo":"{{i.jo}}",
                                "ui":"{{u.userinfo.db.id}}",
                                "co":"{{u.userinfo.db.id}}_{{i.jo}}",
                                "ei":"{{i.ui}}"
                            }
                        }'
                        data-button-magic
                        data-view-template-local="true"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="entryUserApplyPopup">{{d.l10n.btnApply}}</span>
                </div>
                <div class="btn-block show-unsave show-unsave-{{i.jo}} {{#xSubString i.jo u.savedjob.strjo ','}}active{{/xSubString}}">

                    <span class="btn btn-default btn-block btn-unsave text-uppercase"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSERACTION?>/unsavejob"
                        data-success-toggle-class=".show-unsave-{{i.jo}},active"
                        data-params='{ "db":{"jo":"{{i.jo}}", "ui":"{{u.userinfo.db.id}}","co":"{{u.userinfo.db.id}}_{{i.jo}}"} }'
                        data-redirects="."><i class="fa fa-heart-o"></i> <span>{{d.l10n.btnUnFavorite}}</span></span>
                    <span class="btn btn-block bg-color2 btn-save text-uppercase"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSERACTION?>/savejob"
                        data-params='{ "db":{"jo":"{{i.jo}}", "ui":"{{u.userinfo.db.id}}","co":"{{u.userinfo.db.id}}_{{i.jo}}"} }'
                        data-success-toggle-class=".show-unsave-{{i.jo}},active"
                        data-show-errors=".modal.signin-missing-session"
                        data-show-hide=""
                        data-redirects="."><i class="fa fa-heart"></i> {{d.l10n.btnFavorite}}</span>
                </div>
                {{#if i.cmp.im}}
                <div class="img btn-block hidden-xs hidden">
                    <figure>
                        <a href="{{#if i.cmp.username}}{{i.cmp.username}}{{else}}#{{/if}}">
                            <img alt="{{i.cmp.name}}"
                            data-img="/<?=FOLDERIMAGEUSER?>{{i.cmp.im}}"
                            src="/media/images/style/ajax-loader.gif"
                            class="image-load">
                        </a>
                    </figure>
                </div>
                {{/if}}
            {{else}}
                {{#if e.applyjob}}
                    {{#xif " this.i.st > 0 " }}
                        <div class="btn btn-default btn-block hidden">
                            {{{textFromDropdownLocal i.st 'appliedStatus' 'id' 'ti'}}}
                        </div>
                    {{else}}

                    {{/xif}}
                    <div class="j-time-abs">
                        {{d.l10n.applied}}: {{{formatDate i.cr '%d-%M-%Y'}}}
                    </div>
                {{/if}}
            {{/if}}
        </div>
    </div>
</div>
</script>
<script id="viewItemJobCmp" type="text/x-handlebars-template">
<div class="item i-blog {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}  ">
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class=" text-color5">
                {{{textFromDropdownLocal i.db.le 'jobLevel' 'id' 'ti'}}}
            </div>
            <a class="j-title text-color1" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?statistics=1">
            {{#xif ' this.i.db.st == 1'}}
                <span class="btn bg-color3 small-padding t-s-11">{{d.l10n.deActivated}}</span>
            {{else}}
                <span class="btn bg-color2 small-padding t-s-11">{{d.l10n.active}}</span>
            {{/xif}}

            {{i.db.ti}}
            
            {{#xif ' this.i.ne > 0 '}}
             - <span class="text-color2 t-s-16 text-capitalize">( {{i.ne}} {{d.l10n.new}} {{#xif " this.i.ne == 1 "}} {{d.l10n.applicant}} {{else}} {{d.l10n.applicants}} {{/xif}} )</span>
            {{/xif}}

            </a>
            <p class="text-salary">
                <strong class="text-bold">
                {{#xif " this.i.db.sn==1"}}
                    {{d.l10n.negotiable}}
                {{else}}
                    {{#xif " this.i.db.sa==1"}}
                        {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
                    {{else}}
                        {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
                    {{/xif}}
                {{/xif}}
                </strong>
            </p>
            <p>


            <span class="text-color3 text-bold t-s-16">{{i.vi}}</span> {{d.l10n.viewed}} - <span class="text-color3 text-bold t-s-16">{{#if i.userapplied.total}}{{i.userapplied.total}}{{else}}0{{/if}}</span> {{d.l10n.applied}}
            

            </p>
        </div>
        <div class="col-xs-2 col-sm-3 text-right hidden-xs">
            <a title="{{d.l10n.btnEdit}}" class="btn bg-color4 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}" href="/<?=$seo_name["page"]["user"];?>?manage=postjob&jid={{i.db.id}}&pid={{i.ci}}&statistics=1"><span class="fa fa-pencil"></span></a>
            <a title="{{d.l10n.applicants}}" class="btn bg-color4 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?statistics=1"><span class="icon-users"> </span></a>
            <a title="{{d.l10n.viewJob}}" class="btn bg-color4 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?view=1"><i class="fa fa-eye"> </i></a>
            
        </div>
    </div>
    <hr class="m-t-10 m-b-10">
    <div class="row hidden-xs">
        <div class="col-sm-3 col-xs-6">
            <label>{{d.l10n.city}}</label>
        </div>
        <div class="col-sm-9 col-xs-6">
            {{{textFromDropdownLocal i.db.lo 'location' 'id' 'ti'}}}
        </div>
    </div>

    {{#xif ' this.i.ex > 0 '}}
    <div class="row hidden-xs">
        <div class="col-sm-3 col-xs-6">
            <label>{{d.l10n.yearOfExperience}}<label>
        </div>
        <div class="col-sm-9 col-xs-6">
            {{{textFromDropdownLocal i.ex 'yearOfExperience' 'id' 'ti'}}}
        </div>
    </div>
    {{/xif}}
    <div class="row hidden-xs">
        
        <div class="col-sm-3 col-xs-12">
            <label>{{d.l10n.jobSkill}}<label>
        </div>
        <div class="col-sm-9 col-xs-12">
            <p class="textarea-content no-white-space">{{{shortenText i.more.requirement 150}}}</p>
        </div>
    </div>
    <div class="row hidden-xs">
        <div class="col-sm-3 col-xs-12">
            <label>{{d.l10n.jobDescription}}<label>
        </div>
        <div class="col-sm-9 col-xs-12">
            <p class="textarea-content no-white-space">{{{shortenText i.more.description 150}}}</p>
        </div>
    </div>
    <div class="row hidden-xs">
        <div class="col-sm-3 col-xs-6">
            <label>{{d.l10n.jobPreferredlanguage}}<label>
        </div>
        <div class="col-sm-9 col-xs-6">
            {{i.more.preferredLanguage}}
        </div>
    </div>
    <div class="row hidden-xs">
        
        <div class="col-sm-3 col-xs-12">
            <label>{{d.l10n.keyword}}<label>
        </div>
        <div class="col-sm-9 col-xs-12">
            <p class="textarea-content no-white-space">{{addCommaSpace i.more.keyword}}</p>
        </div>
    </div>
        
    <div class="row hidden-xs">
        <div class="col-sm-3 col-xs-6"></div>
        <div class="col-sm-9 col-xs-6"></div>
    </div>
</div>
</script>
<script id="viewItemJobCmpLine" type="text/x-handlebars-template">
    <div class="item i-blog i-line-layout t-s-14 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}  ">
        <div class="row">
            <div class="col-sm-3">
                <a href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?statistics=1">
                 <span class="t-s-11 c-list">{{{textFromDropdownLocal i.db.le 'jobTimeOption' '' ''}}}</span>
                 <br>
                 <span class="text-color1 text-bold t-s-16">
                 {{#xif ' this.i.db.st == 1'}}
                    <span class="btn bg-color3 small-padding t-s-11">{{d.l10n.deActivated}}</span>
                 {{else}}
                    <span class="btn bg-color2 small-padding t-s-11">{{d.l10n.active}}</span>
                 {{/xif}}
                   
                  {{i.db.ti}} </span>
                
                </a>
                <br>
                <span class="text-bold text-color3">{{i.vi}}</span> <span class="t-s-11">{{d.l10n.viewed}}</span>
                -
                <span class="text-bold text-color3">{{#if i.userapplied.total}}{{i.userapplied.total}}{{else}}0{{/if}} </span><span class="t-s-11">{{d.l10n.applied}}</span>
                
            </div>

            <div class="col-sm-3">
                 <span class="t-s-11 c-list"> {{{textFromDropdownLocal i.db.lo 'locationOption' '' ''}}} </span>
                
                {{{formatDate i.db.cr '%d-%M-%Y'}}}

            </div>

            <div class="col-sm-4 text-bold text-left">
                {{#xif " this.i.db.sn==1"}}
                    {{d.l10n.negotiable}}
                {{else}}
                    {{#xif " this.i.db.sa==1"}}
                        {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
                    {{else}}
                        {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
                    {{/xif}}
                {{/xif}}
                
                {{#xif ' this.i.ne > 0 '}}
                <br><span class="text-color2 text-capitalize">( {{i.ne}} {{d.l10n.new}} {{#xif " this.i.ne == 1 "}} {{d.l10n.applicant}} {{else}} {{d.l10n.applicants}} {{/xif}} )</span>
                {{/xif}}
            </div>

            <div class="col-sm-2">
                <a title="{{d.l10n.viewJob}}" class="pull-right btn bg-color4 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?view=1" >
                    <span class="fa fa-eye"> </span>
                </a>
                <a title="{{d.l10n.btnEdit}}" class="pull-right btn bg-color4 m-r-10 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}" href="/<?=$seo_name["page"]["user"];?>?manage=postjob&jid={{i.db.id}}&pid={{i.ci}}&statistics=1">
                    <span class="fa fa-pencil"></span>
                </a>
                <a title="{{d.l10n.applicants}}" class="pull-right btn bg-color4 m-r-10 {{#xif ' this.i.ne > 0 '}} bg-grey-color3 {{/xif}}" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?statistics=1" >
                    <span class="icon-users"> </span>
                </a>
                
            </div>
        </div>
    </div>
</script>

<script id="viewItemJobCmpLeft" type="text/x-handlebars-template">
<div class="item i-blog no-m-top i-search">
    <div class="j-search m-b-10">
       <div class="j-title transition">
           <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?statistics=1">
              <div class="j-level text-color2 no-margin">{{{textFromDropdownLocal i.db.ty 'jobTime' 'id' 'ti'}}}</div>
              <div class="j-name transition no-margin">{{i.db.ti}}</div>
           </a>
       </div>

        <strong class="text-color3">{{#xif " this.i.db.sn==1"}}
            {{d.l10n.negotiable}}
        {{else}}
            {{#xif " this.i.db.sa==1"}}
                {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
            {{else}}
                {{formatCurrency i.db.s1}} - {{formatCurrency i.db.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
            {{/xif}}
        {{/xif}}</strong>
        <p class="text-salary">{{{textFromDropdownLocal i.db.ex 'yearOfExperience' 'id' 'ti'}}}</p>
        <p class="text-address"><p class="text-address">{{{textFromDropdownLocal i.db.lo 'location' 'id' 'ti'}}}</p></p>
    </div>
</div>
</script>

<script id="viewItemJobSearch" type="text/x-handlebars-template">
    <div class="item i-blog no-m-top i-search transition status-{{i.st}}">
        <div class="img i-center">
            <figure>
                <a href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}}">
                    {{#if i.im}}
                    <img alt="{{i.na}}" class="image-load b-r-4" data-img="/<?=FOLDERIMAGECOMPANY?>thumbnail/{{i.im}}" src="/media/images/style/ajax-loader.gif" >
                    {{else}}
                    <img alt="{{i.na}}" class="image-load b-r-4" data-img="/media/images/style/user.png" src="/media/images/style/ajax-loader.gif" >
                    {{/if}}
                </a>
            </figure>
        </div>
        <div class="trans transition"></div>
        <div class="c-t-s-j transition">
        <div class="j-search">

            <div class="j-title transition" >
                <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}}">
                   <div class="j-level text-color2 no-margin short-text c-list">{{{textFromDropdownLocal i.ty 'jobTimeOption' '' ''}}}</div>
                   <div class="j-name transition short-text">{{i.ti}}</div>
                </a>
            </div>
           <a href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}}">
            <p class="text-salary short-text">

                <strong class="text-color3">
                {{#xif " this.i.sn==1"}}
                    {{d.l10n.negotiable}}
                {{else}}
                    {{#xif " this.i.sa==1"}}
                        {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
                    {{else}}
                        {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
                    {{/xif}}
                {{/xif}}
                </strong>
            </p>
            <p class="text-postby short-text"><span class="text-color4">{{d.l10n.postby}} </span><span class="text-color2 j-level">{{i.na}}</span></p>
            <p class="text-address short-text">{{i.address}}</p>
            <p class="text-address short-text c-list">{{{textFromDropdownLocal i.lo 'locationOption' '' ''}}}</p>
            </a>

            </div>

            <a target="_blank" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}}" class="btn btn-block bg-color1 text-uppercase btn-save transition hidden">{{d.l10n.viewMore}}</a>
        
            <div class="hidden">
            <div class="button-function job-button-{{i.id}} j-u-function"
                data-copy-template=""
                data-view-template=".job-button-{{i.id}}"
                data-elm-data='{    "actual_link":"/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}}",
                                    "job_link":"/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.ti i.id}}", 
                                    "uidview":"",
                                    "pid":"{{i.ci}}",
                                    "ei":"{{i.ui}}",
                                    "id":"{{i.id}}"}' 
                data-template-id="entryUserJobFunctionBasic">

            </div>
            </div>
       


        </div>
    </div>
</script>
<script id="entryJobStatistics" type="text/x-handlebars-template">
    <div class="block-title bg-color3 text-uppercase">
        <span>{{d.l10n.statistics}}</span>
    </div>
    <div class="block-content">
        <ul>
            <li>
                {{e.viewed}} {{d.l10n.viewed}}
            </li>
            <li>
               {{#if e.applied}}{{e.applied}}{{else}}0{{/if}}</span> {{d.l10n.applied}}
            </li>
            
       </ul>
    </div>
</script>
