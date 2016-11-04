<script id="entryAdminLogin" type="text/x-handlebars-template">
    <form method="post" class="post-form" data-hidden-info-from-ajax>
        <div class="error login-failed"><div class="sms-content"></div></div>
        <div class="form-group">
            <input type="text"
                   name="db.email"
                   class="form-control"
                   data-validate
                   data-required="{{d.l10n.email}}"
                   placeholder="{{d.l10n.email}}">
            <span class="error"></span>
        </div>
        <div class="form-group">
            <input type="password"
                   name="db.password"
                   class="form-control"
                   data-validate data-min-length="6"
                   data-required="{{d.l10n.requirePassword}}"
                   data-pattern-message="{{d.l10n.requirePasswordRule}}"
                   placeholder="{{d.l10n.password}}">
            <span class="error"></span>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <input type="submit"
                           data-button-magic
                           data-params-form=".post-form"
                           data-format-json="true"
                           data-ajax-url="/api/post/signinadmin"
                           data-redirect="."
                           data-show-errors=".login-failed"
                           class="btn btn-primary"
                           value="<?=$language["signin"]?>">
                </div>
            </div>
        </div>
    </form>
</script>

<script id="entryAdminManageContactus" type="text/x-handlebars-template">
    <div class="item-view-contact-list admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        data-init-object="adminManageContact"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-elm-data='{"adminList":1}'
        data-template-id="entryContactusItem" >

        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="admin-title">
                    <h2>Manager Contact Info</h2>
                </div>
           </div>
           <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form
                    action="/<?=$seo_name["page"]["admin"]?>?fun=contact"
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
        <table class="table table-bordered">
            <colgroup>
                <col class="col-sm-5">
                <col class="col-sm-3">
                <col class="col-sm-2">
                <col class="col-sm-1">
                <col class="col-sm-1">
            </colgroup>
            <thead>
                <tr class="b-b">
                    <th colspan="5">
                        <form class="form-filter o-hidden" data-waiting="500">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <input type="text" name="na"
                                                data-compare="text in"
                                                data-key="st"
                                                placeholder="{{d.l10n.fullname}}"
                                                class="form-control">
                                        </div>
                                        <div class="col-xs-5">
                                            <input type="text" name="em"
                                                data-compare="text in"
                                                data-key="em"
                                                placeholder="{{d.l10n.email}}"
                                                class="form-control">
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" name="nu"
                                                data-compare="text in"
                                                data-key="nu"
                                                placeholder="{{d.l10n.phone}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" name="su"
                                                data-compare="text in"
                                                data-key="su"
                                                placeholder="{{d.l10n.title}}"
                                                class="form-control"></div>
                                <div class="col-xs-2"><label>{{d.l10n.date}}</label></div>
                                <div class="col-xs-1">
                                    <select name="st"
                                        data-dropdown
                                        data-compare="equal"
                                        data-key="st"
                                        data-status-option="contact"
                                        data-object-init='{"id":"", "ti":"Status"}'
                                        class="form-control">
                                    </select>
                                </div>
                                <div class="col-xs-1"></div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="view-items" data-content="">
            </tbody>
        </table>
        <div data-footer></div>
    </div>
</script>
<script id="entryContactusView" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{i.su}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <table class="table">
                    <colgroup>
                        <col class="col-xs-2">
                        <col class="col-xs-10">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>{{d.l10n.fullname}}</td>
                            <td>{{i.na}}</td>
                        </tr>
                        <tr>
                            <td>{{d.l10n.email}}</td>
                            <td>{{i.em}}</td>
                        </tr>
                        <tr>
                            <td>{{d.l10n.phone}}</td>
                            <td>{{i.nu}}</td>
                        </tr>
                        <tr>
                            <td>{{d.l10n.title}}</td>
                            <td>{{i.su}}</td>
                        </tr>
                        <tr>
                            <td>{{d.l10n.message}}</td>
                            <td>{{i.me}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</script>
<script id="entryContactusItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>
            <div class="row">
                <div class="col-xs-4 short-text"><a href="/<?=$seo_name["page"]["admin"]?>?fun=contact&detail={{i.id}}">{{i.na}}</a></div>
                <div class="col-xs-5 short-text">{{i.em}}</div>
                <div class="col-xs-3">{{i.nu}}</div>
            </div>
        </td>
        <td>
            <a href="#" data-button-magic
                data-method="get"
                data-ajax-url="<?=APIGETCONTACTUS?>/{{i.id}}"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryContactusView">
                <label>{{i.su}}</label>
                <p class="textarea-content">{{i.me}}</p>
            </a>
        </td>
        <td>
            <div>{{{formatDate i.cr '%d-%M-%Y'}}}</div>
        </td>
        <td>
            <form class="post-form">
                <div class="hidden">
                    <input name="db.id" value="{{i.id}}">
                    <input name="employmentAction" value="applied">
                    <span data-button-magic data-button-submit-form
                        data-params-form=".post-form"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTCONTACTUS?>"
                        data-refress-lists=".item-view-contact-list"> </span>
                </div>
                <div class="form-group">
                    <select name="db.st" class="form-control"
                        data-trigger-click="[data-button-submit-form]"
                        data-index-select-box="{{i.st}}">
                        {{#each d.l10n.statusOption.contact}}
                            <option value="{{@key}}">{{this}}</option>
                        {{/each}}
                    </select>
                </div>
            </form>
        </td>
        <td>
            <div class="text-right">
                <span
                    class="icon-bin icon-lg"
                    title="Delete"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    data-params='{ "id":"{{i.id}}", "updateNode":"del"}'
                    data-ajax-url="<?=APIPOSTCONTACTUS?>"
                    data-refress-list=".item-view-contact-list"> </span>
            </div>
        </td>
    </tr>
</script>

<script id="entryAdminConfig" type="text/x-handlebars-template">
    <div data-ui-tabs
        data-ignore-hash="false"
        data-tab-class="ui-tabs"
        data-mobile-title="tab-title">
        <div class="product-des">
            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.about}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="description">
                        <div class="form-group">
                            <label>{{d.l10n.description}} VN</label>
                            <div class="form-control-static">{{{i.config.description.vi}}}</div>
                            <div class="edit-show">
                                <textarea name="description.vi"
                                    class="form-control mce-editor">{{{i.config.description.vi}}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.description}} EN</label>
                            <div class="form-control-static">{{{i.config.description.en}}}</div>
                            <div class="edit-show">
                                <textarea name="description.en"
                                    class="form-control mce-editor">{{{i.config.description.en}}}</textarea>
                            </div>
                        </div>

                        <div class="edit-show form-group">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                data-redirects="."
                                data-show-success=".alert"
                                data-show-errors=".popup.signin-missing-session"
                                class="btn btn-primary"
                                value="{{d.l10n.btnUpdate}}">
                        </div>
                    </form>
                </div>
            </div>

            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.pageNotfound}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="pageNotfound">
                        <div class="form-group">
                            <label>{{d.l10n.pageNotfound}} VN</label>
                            <div class="form-control-static">{{{i.config.pageNotfound.vi}}}</div>
                            <div class="edit-show">
                                <textarea name="pageNotfound.vi"
                                    class="form-control mce-editor">{{{i.config.pageNotfound.vi}}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.pageNotfound}} EN</label>
                            <div class="form-control-static">{{{i.config.pageNotfound.en}}}</div>
                            <div class="edit-show">
                                <textarea name="pageNotfound.en"
                                    class="form-control mce-editor">{{{i.config.pageNotfound.en}}}</textarea>
                            </div>
                        </div>

                        <div class="edit-show form-group">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                data-redirects="."
                                data-show-success=".alert"
                                data-show-errors=".popup.signin-missing-session"
                                class="btn btn-primary"
                                value="{{d.l10n.btnUpdate}}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.configFooter}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="footer">
                        <div class="form-group">
                            <label>{{d.l10n.configFooter}} VI</label>
                            <div class="form-control-static">{{{i.config.footer.vi}}}</div>
                            <div class="edit-show">
                                <textarea name="footer.vi"
                                    class="form-control mce-editor">{{{i.config.footer.vi}}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.configFooter}} EN</label>
                            <div class="form-control-static">{{{i.config.footer.en}}}</div>
                            <div class="edit-show">
                                <textarea name="footer.en"
                                    class="form-control mce-editor">{{{i.config.footer.en}}}</textarea>
                            </div>
                        </div>

                        <div class="edit-show form-group">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                data-redirects="."
                                data-show-success=".alert"
                                data-show-errors=".popup.signin-missing-session"
                                class="btn btn-primary"
                                value="{{d.l10n.btnUpdate}}">
                        </div>
                    </form>
                </div>
            </div>

            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">Job Right On Search Page</h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="jobright">
                        <div class="form-group">
                            <label>Job Status</label>
                            <div class="form-control-static">Job Status</div>
                            <div class="edit-show">
                                <input class="form-control"
                                        type="checkbox"
                                        name="jobright.status"
                                        {{#if  i.config.jobright.status}}
                                        {{#xif ' this.i.config.jobright.status==1 '}}
                                            checked="checked"
                                        {{/xif}}
                                        {{/if}}
                                        value="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Job Id</label>
                            <div class="form-control-static">Job Id</div>
                            <div class="edit-show">
                                <input class="form-control"
                                        type="text"
                                        name="jobright.jobid"
                                        value="{{i.config.jobright.jobid}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Job link</label>
                            <div class="form-control-static">Job link</div>
                            <div class="edit-show">
                                <input class="form-control"
                                        type="text"
                                        name="jobright.joblink"
                                        value="{{i.config.jobright.joblink}}">
                            </div>
                        </div>

                        <div class="edit-show form-group">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                data-redirects="."
                                data-show-success=".alert"
                                data-show-errors=".popup.signin-missing-session"
                                class="btn btn-primary"
                                value="{{d.l10n.btnUpdate}}">
                        </div>
                    </form>
                </div>
            </div>

            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.paymentMethod}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="paymentcontent">
                        <div class="form-group">
                            <label>Transfer to bank VN</label>
                            <div class="form-control-static">{{{i.config.paymentcontent.tranfer.vi}}}</div>
                            <div class="edit-show">
                                <textarea name="paymentcontent.tranfer.vi"
                                    class="form-control mce-editor">{{{i.config.paymentcontent.tranfer.vi}}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Transfer to bank EN</label>
                            <div class="form-control-static">{{{i.config.paymentcontent.tranfer.en}}}</div>
                            <div class="edit-show">
                                <textarea name="paymentcontent.tranfer.en"
                                    class="form-control mce-editor">{{{i.config.paymentcontent.tranfer.en}}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cash On Delivery VN</label>
                            <div class="form-control-static">{{{i.config.paymentcontent.cod.vi}}}</div>
                            <div class="edit-show">
                                <textarea name="paymentcontent.cod.vi"
                                    class="form-control mce-editor">{{{i.config.paymentcontent.cod.vi}}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cash On Delivery EN</label>
                            <div class="form-control-static">{{{i.config.paymentcontent.cod.en}}}</div>
                            <div class="edit-show">
                                <textarea name="paymentcontent.cod.en"
                                    class="form-control mce-editor">{{{i.config.paymentcontent.cod.en}}}</textarea>
                            </div>
                        </div>

                        <div class="edit-show form-group">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                data-redirects="."
                                data-show-success=".alert"
                                data-show-errors=".popup.signin-missing-session"
                                class="btn btn-primary"
                                value="{{d.l10n.btnUpdate}}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.configSocialLink}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="post-form edit-add-item edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="social">
                        <div class="form-group">
                            <label>Skype</label>
                            <div class="form-control-static">{{i.config.social.skype}}</div>
                            <input type="text" name="social.skype" class="form-control" value="{{i.config.social.skype}}">
                        </div>
                        <div class="form-group">
                            <label>Facebook link</label>
                            <div class="form-control-static">{{i.config.social.facebook}}</div>
                            <input type="text" name="social.facebook" class="form-control" value="{{i.config.social.facebook}}">
                        </div>
                        <div class="form-group">
                            <label>Hotline</label>
                            <div class="form-control-static">{{i.config.social.hotline}}</div>
                            <input type="text" name="social.hotline" class="form-control" value="{{i.config.social.hotline}}">
                        </div>

                        <div class="fieldset">
                            <div class="edit-show form-group">
                                <input type="submit"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                    data-redirect="."
                                    data-show-success=".alert"
                                    data-show-errors=".alert"
                                    class="btn btn-primary"
                                    value="{{d.l10n.btnUpdate}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.configMeta}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="post-form  edit-add-item edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="seo">
                        <div class="form-group">
                            <label>Google Analytics Code</label>
                            <div class="form-control-static">{{i.config.seo.googleAnalyticsCode}}</div>
                            <textarea name="seo.googleAnalyticsCode"
                                    class="form-control">{{i.config.seo.googleAnalyticsCode}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.title}} VI</label>
                            <div class="form-control-static">{{i.config.seo.title.vi}}</div>
                            <input name="seo.title.vi" class="form-control" value="{{i.config.seo.title.vi}}" />
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.title}} EN</label>
                            <div class="form-control-static">{{i.config.seo.title.en}}</div>
                            <input name="seo.title.en" class="form-control" value="{{i.config.seo.title.en}}" />
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.description}} VI</label>
                            <div class="form-control-static">{{i.config.seo.description.vi}}</div>
                            <textarea name="seo.description.vi"
                                    class="form-control">{{i.config.seo.description.vi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.description}} EN</label>
                            <div class="form-control-static">{{i.config.seo.description.en}}</div>
                            <textarea name="seo.description.en"
                                    class="form-control">{{i.config.seo.description.en}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.keyword}} VN</label>
                            <div class="form-control-static">{{i.config.seo.keyword.vi}}</div>
                            <textarea name="seo.keyword.vi"
                                    class="form-control">{{i.config.seo.keyword.vi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{d.l10n.keyword}} EN</label>
                            <div class="form-control-static">{{i.config.seo.keyword.en}}</div>
                            <textarea name="seo.keyword.en"
                                    class="form-control">{{i.config.seo.keyword.en}}</textarea>
                        </div>
                        <div class="fieldset">
                            <div class="edit-show form-group">
                                <input type="submit"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                    data-redirect="."
                                    data-show-success=".alert"
                                    data-show-errors=".popup.signin-missing-session"
                                    class="btn btn-primary"
                                    value="{{d.l10n.btnUpdate}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.email}}</h3>
                <div class="tab-content">
                    <form method="post"
                        class="post-form edit-add-item edit-disabled edit-enabled">
                        <input type="hidden" name="config.type" value="email">
                        <div class="row form-group">
                            <div class="col-xs-6">
                                <label>{{d.l10n.emailContactSender}}</label>
                                <div class="form-control-static">{{i.config.email.contactSender}}</div>
                                <input name="email.contactSender"
                                    class="form-control"
                                    data-validate
                                    data-required="{{d.l10n.requireEmail}}"
                                    data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                                    data-pattern-message="{{d.l10n.requireEmailRule}}"
                                    value="{{i.config.email.contactSender}}" />
                            </div>
                            <div class="col-xs-6">
                                <label>{{d.l10n.emailContact}}</label>
                                <div class="form-control-static">{{i.config.email.contact}}</div>
                                <input name="email.contact"
                                    class="form-control"
                                    data-validate
                                    data-required="{{d.l10n.requireEmail}}"
                                    data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                                    data-pattern-message="{{d.l10n.requireEmailRule}}"
                                    value="{{i.config.email.contact}}" />
                            </div>
                        </div>

                        <div class="fieldset">
                            <div class="edit-show form-group">
                                <input type="submit"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                    data-redirect="."
                                    data-show-success=".alert"
                                    data-show-errors=".popup.signin-missing-session"
                                    class="btn btn-primary"
                                    value="{{d.l10n.btnUpdate}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</script>
<script id="entryAdminManageImage" type="text/x-handlebars-template">
    <div class="admin-title">
        <h2>{{d.l10n.manageImage}} </h2>
        {{e.queryString}}
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="makeFolder">
                <form method="post" action="?manage=image&dir" data-form-validate >
                    <div class="form-group">
                        <input type="hidden" name="root" value="">
                        <input  type="text"
                                name="title"
                                data-validate
                                data-required="{{d.l10n.requireTitle}}"
                                data-pattern-message="{{d.l10n.requireFolderNameRule}}"
                                data-pattern="^[a-zA-Z0-9]*[a-zA-Z]+[a-zA-Z0-9]*$"
                                placeholder="{{d.l10n.folderName}}"
                                class="form-control">
                        <span class="error"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="{{d.l10n.btnAdd}}" data-button-upload class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="item-view-slide-image admin-list"
                data-view-list-by-handlebar
                data-ignore-hash="true"
                data-init-button-magic=".item-view-slide-image [data-button-magic]"
                data-url="<?=APIGETUPLOADFILE?>"
                data-params="dir={{e.queryString}}"
                data-method="GET"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-template-id="entrySlideItem" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
        </div>
    </div>
</script>
<script id="entryAdminManageCategory" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-url="<?=APIGETCATEGORY;?>"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="manageCategoryItem">
        <div class="admin-title">
            <h2>{{d.l10n.categoryManage}}</h2>
        </div>
        <div class="head-title">
            <div class="row">
                <div class="col-xs-5">
                    <div class="row">
                        <label class="col-xs-2">{{d.l10n.id}}</label>
                        <label class="col-xs-10">{{d.l10n.title}} ({{d.l10n.titleSecond}}) / url</label>
                    </div>
                </div>
                <div class="col-xs-3"><label>{{d.l10n.categoryRoot}}</label></div>
                <div class="col-xs-2"><label>{{d.l10n.status}}</label></div>
                <div class="col-xs-1"><label>{{d.l10n.order}}</label></div>
                <div class="col-xs-1 text-right"><label>&nbsp;</label></div>
            </div>
        </div>
        <div class="content-filter">
            <form class="form-filter">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <input type="text"
                                        name="id"
                                        data-compare="equal"
                                        placeholder="#"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <input type="text"
                                        name="ti"
                                        data-compare="text in"
                                        placeholder="{{d.l10n.title}}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <select name="pa"
                                data-dropdown
                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                data-option-local-json="menuStructure"
                                data-compare="equal"
                                data-option-base-on-url="pa"
                                class="form-control">
                                <option value="">{{d.l10n.viewAll}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <select name="st"
                                data-dropdown
                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                data-option-local-json="blogStatus"
                                data-compare="equal"
                                data-option-base-on-url="st"
                                class="form-control">
                                <option value="">{{d.l10n.viewAll}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="view-items" data-content><div class="style-loadding">...</div></div>
        <div class="row">
            <div class="col-xs-10">
                <div data-footer></div>
            </div>
            <div class="col-xs-2 text-right">
                <button class="btn btn-warning form-add btn-add-a-item"
                data-button-magic
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="manageCategoryAdd">{{d.l10n.btnAdd}} + </button>
            </div>
        </div>
    </div>
</script>

<script id="manageCategoryItem" type="text/x-handlebars-template">
    <div class="item item-blog item-status-{{i.st}}">
        <div class="row">
            <div class="col-xs-5">
                <div class="row">
                    <div class="col-xs-2">{{i.id}}</div>
                    <div class="col-xs-10">
                        {{i.ti}}
                        {{#if i.ti1}}<span>({{i.ti1}})</span>{{/if}}
                        <span> / {{i.url}}</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                {{#xif " this.i.pa > 0 "}}
                <span class="text-array text-array-category">
                {{{textFromDropdownLocal i.pa 'menuList' ''}}}
                </span>
                {{else}}
                    {{d.l10n.categoryRoot}}
                {{/xif}}
            </div>
            <div class="col-xs-2">
                {{#if i.st}}
                <span>{{{textFromDropdownLocal i.st 'blogStatus' 'id' 'ti'}}}</span>
                {{/if}}
            </div>
            <div class="col-xs-1">
                <span>{{i.so}}</span>
            </div>
            <div class="col-xs-1 btn-control text-right">
                <span
                    class="icon-pencil icon-lg"
                    title="Edit id {{i.id}}"
                    data-button-magic
                    data-method="get"
                    data-ajax-url="<?=APIGETCATEGORY?>/{{i.id}}"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="manageCategoryEdit"></span>
                <span
                    class="icon-bin icon-lg"
                    title="Delete"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    data-params='{ "id":"{{i.id}}", "uid":"{{u.userinfo.db.id}}", "updateNode":"del"}'
                    data-ajax-url="<?=APIPOSTCATEGORY?>"
                    data-refress-list=".item-view-more"> </span>
            </div>
        </div>
    </div>
</script>

<script id="manageCategoryAdd" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.menuManage}} :: {{d.l10n.btnAdd}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <form class="form-horizontal post-form">
                    <div class="hidden">
                        <input type="text"
                                class="form-control"
                                name="updateNode"
                                value="db">
                        <input type="text"
                                class="form-control"
                                name="db.uid"
                                value="{{u.userinfo.db.id}}">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.title}} VI
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="db.ti_vi"
                                    value="{{i.db.ti_vi}}"
                                    data-validate
                                    data-required="{{d.l10n.requireTitle}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.title}} EN
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="db.ti_en"
                                    value="{{i.db.ti_en}}"
                                    data-validate
                                    data-required="{{d.l10n.requireTitle}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.titleUrl}}
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="db.url"
                                    data-validate
                                    data-server="<?=APIPOSTCATEGORYURL?>"
                                    data-params='{"id":"-1" }'
                                    data-key = "url"
                                    data-required="{{d.l10n.requireContent}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.externalLink}}
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="db.link"
                                    data-validate
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.page}}
                        </label>
                        <div class="col-sm-10">
                            <select name="db.opp"
                                data-validate
                                data-required="{{d.l10n.requireContent}}"
                                data-dropdown
                                data-dropdown-relative="db.pa"
                                data-params="opp="
                                data-option-local-json="pageOption"
                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                class="form-control">
                                <option value="">{{d.l10n.viewAll}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.rootMenu}}
                        </label>
                        <div class="col-sm-10">
                            <select name="db.pa"
                                    type="select-from-json"
                                    data-dropdown
                                    data-option-from-json="<?=APIGETCATEGORY;?>"
                                    data-option-local-json="menuStructure"
                                    data-object-init='{"id":"0", "ti":"{{d.l10n.rootMenu}}"}'
                                    class="form-control">
                                    <option value="">{{d.l10n.rootMenu}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.content}}
                        </label>
                        <div class="col-sm-10">
                            <textarea name="db.ct"
                                    class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.order}}
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="db.so"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.navMenu}}
                        </label>
                        <div class="col-sm-10">
                            <label class="checkbox">
                                <input name="db.ism" type="checkbox" value="1">
                                <span class="checkbox-style"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.status}}
                        </label>
                        <div class="col-sm-10">
                            <select name="db.st"
                                data-dropdown
                                data-option-local-json="menuStatus"
                                class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCATEGORY?>"
                                data-show-success=".modal-footer .alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-redirect="."
                                class="btn btn-primary"
                                value="{{d.l10n.btnAdd}}">
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
                        <span class="btn btn-default"
                            data-closet-toggle-class="in"
                            data-object=".modal"
                            data-empty-object="[data-quick-view-item]">Close</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="manageCategoryEdit" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.update}}: {{i.db.ti_vi}} / {{i.db.ti_en}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>

            <div class="modal-body">
                <div data-ui-tabs
                    data-ignore-hash="true"
                    data-tab-class="ui-tabs"
                    data-mobile-title="tab-title">
                    <div class="product-des">
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.general}}</h3>
                            <div class="tab-content">
                                <!-- update image -->
                                <div class="update-item-image"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"/api/post/image/category",
                                    "urlPostDel":"/api/post/imagedelete",
                                    "imgName":"{{i.db.im}}",
                                    "maxSize":"500000",
                                    "imgPath":"<?=FOLDERIMAGECATEGORY?>",
                                    "module":"category",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-item-image"
                                    data-template-id="entryItemImage">
                                </div>
                                <form class="form-horizontal post-form">
                                    <div class="hidden">
                                        <input type="hidden"
                                            name="updateNode"
                                            value="db"
                                            class="form-control">
                                        <input type="hidden"
                                            name="db.id"
                                            value="{{i.db.id}}"
                                            class="form-control">
                                        <input type="hidden"
                                                value="{{u.userinfo.db.id}}"
                                                name="db.uid"
                                                class="form-control" />

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.title}} VI
                                        </label>
                                        <div class="col-sm-10">
                                            <input  type="text"
                                                    name="db.ti_vi"
                                                    value="{{i.db.ti_vi}}"
                                                    data-validate
                                                    data-required="{{d.l10n.requireTitle}}"
                                                    class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.title}} EN
                                        </label>
                                        <div class="col-sm-10">
                                            <input  type="text"
                                                    name="db.ti_en"
                                                    value="{{i.db.ti_en}}"
                                                    data-validate
                                                    data-required="{{d.l10n.requireTitle}}"
                                                    class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.titleUrl}}
                                        </label>
                                        <div class="col-sm-10">
                                            <input  type="text"
                                                    name="db.url"
                                                    value="{{i.db.url}}"
                                                    data-server="<?=APIPOSTCATEGORYURL?>"
                                                    data-params='{"id":{{i.db.id}} }'
                                                    data-key = "url"
                                                    data-validate
                                                    data-required="{{d.l10n.requireContent}}"
                                                    class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            <span class="otooltip"><span class="icon-info">&nbsp;</span><span class="otooltip-content otooltip-l">{{{d.l10n.externalLinkNote}}}</span></span>{{d.l10n.externalLink}}
                                        </label>
                                        <div class="col-sm-10">
                                            <input  type="text"
                                                    name="db.link"
                                                    value="{{i.db.link}}"
                                                    data-validate
                                                    class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.page}}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="db.opp"
                                                data-validate
                                                data-required="{{d.l10n.requireContent}}"
                                                data-dropdown
                                                data-dropdown-relative="db.pa"
                                                data-params="opp="
                                                data-option-local-json="pageOption"
                                                data-object-init='{"id":"0", "ti":"{{d.l10n.viewAll}}"}'
                                                data-index-value="{{i.db.opp}}"
                                                class="form-control">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.rootMenu}}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="db.pa"
                                                    type="select-from-json"
                                                    data-dropdown
                                                    data-option-from-json="<?=APIGETCATEGORY;?>"
                                                    data-option-local-json="menuStructure"
                                                    data-object-init='{"id":"0", "ti":"{{d.l10n.rootMenu}}"}'
                                                    data-index-value="{{i.db.pa}}"
                                                    class="form-control">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.content}}
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="db.ct"
                                                    class="form-control">{{i.db.ct}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.order}}
                                        </label>
                                        <div class="col-sm-10">
                                            <input  type="text"
                                                    name="db.so"
                                                    value="{{i.db.so}}"
                                                    class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{d.l10n.navMenu}}</label>
                                        <div class="col-sm-10">
                                            <label class="checkbox">
                                                <input name="db.ism" type="checkbox" value="1" {{#xif  " this.i.db.ism == 1 && '1' === '1' " }} checked {{/xif}}>
                                                <span class="checkbox-style"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.status}}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="db.st"
                                                data-validate
                                                data-required="{{d.l10n.requireContent}}"
                                                data-dropdown
                                                data-object-init='{"id":"", "ti":"{{d.l10n.status}}"}'
                                                data-option-local-json="menuStatus"
                                                data-index-value="{{i.db.st}}"
                                                class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTCATEGORY?>"
                                                data-show-success=".modal-footer .alert"
                                                data-show-errors=".modal.signin-missing-session"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.content}}</h3>
                            <div class="tab-content">
                                <form class="form-horizontal post-form">
                                   
                                    <input type="hidden"
                                                value="{{u.userinfo.db.id}}"
                                                name="db.uid"
                                                class="form-control" />

                                    <?=$templatesView["hiddenInputMore"]?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.description}} VI
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description.vi"
                                                    class="form-control mce-editor">{{i.more.description.vi}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.description}} EN
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description.en"
                                                    class="form-control mce-editor">{{i.more.description.en}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTCATEGORY?>"
                                                data-show-success=".modal-footer .alert"
                                                data-show-errors=".modal.signin-missing-session"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php if(isset($templatesView["slide"]) && $templatesView["slide"]) {
                            # End Slide image tab content
                        ?>
                        <div class="item-content"
                                    data-remove-view-list="data-view-list-by-handlebar-in-tab"
                                    data-view-list="[data-view-list-by-handlebar-in-tab]">
                            <h3 class="icon tab-title">{{d.l10n.imageSlide}}( < 500kb )</h3>
                            <div class="tab-content">
                                <div class="item-view-slide-image admin-list"
                                    data-view-list-by-handlebar-in-tab
                                    data-ignore-hash="true"
                                    data-init-button-magic=".item-view-slide-image [data-button-magic]"
                                    data-url="<?=APIGETSLIDE?>/category/{{i.db.id}}"
                                    data-method="get"
                                    data-show-page="10"
                                    data-show-item="20"
                                    data-show-all="false"
                                    data-scroll-view="false"
                                    data-template-id="entrySlideItem" >
                                    <div class="view-items" data-content><div class="style-loadding">...</div></div>
                                    <div data-footer></div>
                                </div>

                                <div class="update-slide-image"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"<?=APIPOSTSLIDE?>/category",
                                    "maxSize":"500000",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-slide-image"
                                    data-template-id="entrySlideImage">
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        # End Slide image tab content
                        # Begin moreDetail tab content
                        ?>
                        <?php if(isset($templatesView["moreDetail"]) && $templatesView["moreDetail"]) {?>
                        <div class="item-content"
                                    data-remove-view-list="data-view-list-by-handlebar-in-tab"
                                    data-view-list="[data-view-list-by-handlebar-in-tab]">
                            <h3 class="icon tab-title">{{d.l10n.moreDetail}}</h3>
                            <div class="tab-content">
                                <div class="item-view-more admin-list"
                                    data-view-list-by-handlebar-in-tab
                                    data-ignore-hash="true"
                                    data-elm-data='{"urlGet":"<?=APIGETCATEGORY?>","urlPost":"<?=APIPOSTCATEGORY?>", "itemId":"{{i.db.id}}"}'
                                    data-init-button-magic=".item-menu-detail [data-button-magic]"
                                    data-url="<?=APIGETCATEGORY?>/{{i.db.id}}?detail"
                                    data-method="get"
                                    data-show-page="10"
                                    data-show-item="20"
                                    data-show-all="false"
                                    data-scroll-view="false"
                                    data-template-id="entryItemMoreDetail" >
                                    <div class="view-items" data-content><div class="style-loadding">...</div></div>
                                    <div data-footer></div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-default form-add btn-add-a-item"
                                        data-button-magic
                                        data-elm-data='{"urlGet":"<?=APIGETCATEGORY?>", "urlPost":"<?=APIPOSTCATEGORY?>", "itemId":"{{i.db.id}}"}'
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item1]"
                                        data-template-id="entryItemMoreDetailForm">{{d.l10n.btnAdd}} + </button>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        # End moreDetail tab content
                        # Begin Seo tab content
                        ?>
                        <?php if(isset($templatesView["seo"]) && $templatesView["seo"]) {?>
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.seo}}</h3>
                            <div class="tab-content">
                                <div class="update-seo-item"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"<?=APIPOSTCATEGORY?>",
                                    "title":{
                                        "vi":"{{i.meta.title.vi}}",
                                        "en":"{{i.meta.title.en}}"
                                    },
                                    "keyword":{
                                        "vi":"{{i.meta.keyword.vi}}",
                                        "en":"{{i.meta.keyword.en}}"
                                    },
                                    "desc":{
                                        "vi":"{{i.meta.desc.vi}}",
                                        "en":"{{i.meta.desc.en}}"
                                    },
                                    "ui":"{{u.userinfo.db.id}}",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-seo-item"
                                    data-template-id="entrySeoItem">
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        # End Seo tab content
                        # Begin Column tab content
                        /*?>
                        <?php if(isset($templatesView["configColumn"]) && $templatesView["configColumn"]) {?>
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.configColumnMenu}}</h3>
                            <div class="tab-content">
                                <form class="form-horizontal post-form">
                                    <div class="hidden">
                                        <input type="text"
                                            name="updateNode"
                                            value="column"
                                            class="form-control">
                                    </div>
                                    <?=$templatesView["configColumn"]?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTCATEGORY?>"
                                                data-show-success=".modal-footer .alert"
                                                data-show-errors=".modal.signin-missing-session"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        }*/
                        # End Column tab content
                        ?>
                        {{#xif  " this.i.db.opp == 3 " }}
                        <div class="item-content"
                                data-remove-view-list="data-view-list-by-handlebar-in-tab"
                                data-view-list="[data-view-list-by-handlebar-in-tab]">
                            <h3 class="icon tab-title">{{d.l10n.suggestedJobs}}</h3>
                            <div class="tab-content">
                                <div class="item-view-more item-menu-suggest admin-list"
                                    data-view-list-by-handlebar-in-tab
                                    data-ignore-hash="true"
                                    data-elm-data='{"urlGet":"<?=APIGETCATEGORY?>","urlPost":"<?=APIPOSTCATEGORY?>", "itemId":"{{i.db.id}}"}'
                                    data-init-button-magic=".item-menu-suggest [data-button-magic]"
                                    data-url="<?=APIGETCATEGORY?>/{{i.db.id}}?jobSuggest"
                                    data-method="get"
                                    data-show-page="10"
                                    data-show-item="20"
                                    data-show-all="false"
                                    data-scroll-view="false"
                                    data-template-id="entryJobSuggestItem" >
                                    <div class="head-title">
                                        <div class="row">
                                            <div class="col-xs-5"><label>{{d.l10n.title}}</label></div>
                                            <div class="col-xs-3"><label>{{d.l10n.jobLevel}}</label></div>
                                            <div class="col-xs-3"><label>{{d.l10n.category}}</label></div>
                                            <div class="col-xs-1 text-right"><label>&nbsp;</label></div>
                                        </div>
                                    </div>
                                    <div class="content-filter">
                                        <form class="form-filter">
                                            <div class="row">
                                                <div class="col-xs-5">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <div class="form-group">
                                                                <input type="text"
                                                                    name="id"
                                                                    data-compare="equal"
                                                                    placeholder="#"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <div class="form-group">
                                                                <input type="text"
                                                                    name="ti"
                                                                    data-compare="text in"
                                                                    placeholder="{{d.l10n.title}}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <select name="le"
                                                                type="select"
                                                                data-validate
                                                                data-required="{{d.l10n.requireTitle}}"
                                                                data-dropdown
                                                                data-option-local-json="jobLevel"
                                                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                                                data-compare="in"
                                                                data-option-base-on-url="le"
                                                                class="form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <select name="cat"
                                                            data-dropdown
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                                            data-option-local-json="menuStructure"
                                                            data-params="opp=3"
                                                            data-compare="in"
                                                            data-option-base-on-url="cat"
                                                            class="form-control">
                                                            <option value="">{{d.l10n.viewAll}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="view-items" data-content>
                                        <div class="style-loadding">...</div>
                                    </div>
                                    <div data-footer></div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-default form-add btn-add-a-item"
                                        data-button-magic
                                        data-elm-data='{
                                            "urlGet":"<?=APIGETCATEGORY?>",
                                            "urlPost":"<?=APIPOSTCATEGORY?>",
                                            "itemId":"{{i.db.id}}",
                                            "modalClose":"[data-quick-view-item1]",
                                            "jobSuggest":"true"
                                        }'
                                        data-view-template-local="true"
                                        data-view-template="[data-quick-view-item1]"
                                        data-template-id="jobsAdd">{{d.l10n.btnAdd}} + </button>
                                </div>
                            </div>
                        </div>
                        {{/xif}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="alert text-left" data-fade="2000">
                            <div class="sms-content"></div>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <span class="btn btn-default"
                            data-closet-toggle-class="in"
                            data-object=".modal"
                            data-empty-object="[data-quick-view-item]">{{d.l10n.btnClose}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<!-- User Applicant manager-->
<script id="entryAdminManageApplicant" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-init-object="adminManageUser"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="manageApplicantItem">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.userManage}} (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form="" action="/<?=$seo_name["page"]["admin"]?>?fun=user" method="post" class="post-form form-inline text-right">
                    <div class="form-group">
                        <label>From</label>
                        <input type="text" name="dayFrom" value="{{e.dayFrom}}" data-date-picker="" data-format="YYYY-MM-DD" data-single-date-picker="true" data-show-dropdowns="true" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="text" name="dayTo" value="{{e.dayTo}}" data-date-picker="" data-format="YYYY-MM-DD" data-single-date-picker="true" data-show-dropdowns="true" class="form-control">
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsives">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-1">
                    <col class="col-sm-3">
                    <col class="col-sm-2">
                    <col class="col-sm-3">
                    <col class="col-sm-2">
                    <col class="col-sm-1">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter" data-waiting="500">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="text"
                                            name="i"
                                            data-compare="equal"
                                            placeholder="#"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text"
                                            name="email"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.email}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text"
                                            name="name"
                                            data-key="n"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.fullname}}"
                                            class="form-control">
                                    </div>

                                    <div class="col-xs-3">
                                        <select name="ci"
                                                class="form-control"
                                                data-key="ci"
                                                data-compare="equal"
                                                data-required="{{d.l10n.require}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                data-dropdown
                                                data-option-local-json="location">
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                        {{d.l10n.timeCreated}}
                                    </div>
                                    <div class="col-xs-1">
                                        <a href="/<?=$seo_name["page"]["admin"]?>?fun=user&last_signin={{e.last_signin}}">Sign in time</a>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="view-items" data-content="">
                </tbody>
            </table>
        </div>
        <div class="p-10">
            <div data-footer=""></div>
        </div>
    </div>
</script>
<script id="manageApplicantItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>{{i.i}}</td>
        <td>{{i.e}}</td>
        <td>
            <a href="/<?=$seo_name["page"]["admin"]?>?fun=user&view={{i.i}}" class="text-color2">{{i.n}}</a>
            <br/>
            {{#xif  " this.i.g == 1 " }}
                {{d.l10n.male}}
            {{else}}
                {{d.l10n.female}}
            {{/xif}}
            <br/>
            {{i.d}}
        </td>
        <td>{{i.ad}} - {{{textFromDropdownLocal i.ci 'location' 'id' 'ti'}}}</td>
        <td>{{i.c}}</td>
        <td>
            <div class="btn-control text-right">
                <p class="t-s-11 text-color2">{{formatLatestDay i.last_signin}}</p>
            </div>
        </td>
    </tr>
</script>

<script id="entryViewApplicantDetail" type="text/x-handlebars-template">
    <a data-back-button
        {{#if e.referer}}
        href="{{e.referer}}"
        {{else}}
        href="/<?=$seo_name["page"]["user"]?>?manage=checkout"
        {{/if}}
        class="t-back text-color2">
        <i class="fa fa-caret-left"></i> Quay lai
    </a>
    <div class="view-cv-detail admin-view-cv-detail"
        data-elm-data='{"adminview":"1"}'
        data-copy-template
        data-option-local="cvDetail"
        data-view-template=".view-cv-detail"
        data-template-id="entryCvView"></div>
</script>

<!-- User Employment manager-->
<script id="entryAdminManageEmployment" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-init-object="adminManageEmployment"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="manageEmploymentItem">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.company}} (<span data-total-item></span>) 
                    <a  class="btn bg-color1"
                    data-template-id="entrySignupWithPromoCodeAdmin"
                    data-view-template="[data-quick-view-item]"
                    data-view-template-local="true"
                    data-button-magic
                    href="#">{{d.l10n.promoCode}}</a>

                    <a class="btn bg-color2" href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&last_signin={{e.last_signin}}">Latest Sign In</a>
                </header>
                <p class="t-s-16"> <a href="#">Like: <span class="text-bold text-color1">{{e.totalLike}}</span></a> - 
                    <a href="#">Interview: <span class="text-bold text-color2">{{e.totalInterview}}</span></a> - 
                    <a href="#">Hired: <span class="text-bold text-color3">{{e.totalHire}}</span></a> - 
                    <a href="#">Deny: <span class="text-bold text-color5">{{e.totalDeny}}</span></a></p>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form="" action="/<?=$seo_name["page"]["admin"]?>?fun=cmp" method="post" class="post-form form-inline text-right">
                    <!-- <div class="form-group">
                        <select name="ci"
                            class="form-control"
                            data-key="ci"
                            data-compare="equal"
                            data-required="{{d.l10n.require}}"
                            data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                            data-dropdown
                            data-index-value="{{e.ci}}"
                            data-option-local-json="location">
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label>From</label>
                        <input type="text"
                            name="dayFrom"
                            value="{{e.dayFrom}}"
                            data-date-picker=""
                            data-format="YYYY-MM-DD"
                            data-single-date-picker="true"
                            data-show-dropdowns="true"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="text"
                            name="dayTo"
                            value="{{e.dayTo}}"
                            data-date-picker=""
                            data-format="YYYY-MM-DD"
                            data-single-date-picker="true"
                            data-show-dropdowns="true" class="form-control">
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsives">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-1">
                    <col class="col-sm-4">
                    <col class="col-sm-2">
                    <col class="col-sm-2 hidden">
                    <col class="col-sm-4">
                    <col class="col-sm-1">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter" data-waiting="100">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="text"
                                            name="i"
                                            data-compare="equal"
                                            placeholder="#"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text"
                                            name="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.name}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text"
                                            name="ep"
                                            data-key="ep"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.email}}/ {{d.l10n.phone}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2 hidden">
                                        <div class="form-group">
                                            <select name="ci"
                                                    class="form-control"
                                                    data-key="ci"
                                                    data-compare="equal"
                                                    data-required="{{d.l10n.require}}"
                                                    data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                    data-dropdown
                                                    data-option-local-json="location">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row text-center">
                                            <div class="col-xs-4">
                                                {{d.l10n.timeCreated}}
                                            </div>
                                            <div class="col-xs-4">
                                                Page/Job
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <select name="s"
                                                        data-dropdown
                                                        data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                                        data-option-local-json="userStatus"
                                                        data-compare="equal"
                                                        data-option-base-on-url="s"
                                                        class="form-control">
                                                        <option value="">{{d.l10n.viewAll}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-1 text-right">
                                        <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&dayleft={{e.dayleft}}">dayleft</a>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="view-items" data-content="">
                </tbody>
            </table>
        </div>
        <div class="p-10">
            <div data-footer=""></div>
        </div>
    </div>
</script>
<script id="manageEmploymentItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>{{i.id}}</td>
        <td class="short-text">
            <a class="text-color3" href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.id}}"><span class="text-color2 text-bold">( {{i.totalCandidates}} )</span> {{i.na}}</a>
            {{#if i.company_name}}<br><span class="t-s-14 b-r-4 bg-color5">&nbsp;&nbsp;{{i.company_name}}&nbsp;&nbsp;</span>{{/if}}
            <p class="t-s-12"> 
                <span class="text-color1 text-bold">{{i.totalLike}}</span> {{d.l10n.btnLike}} &nbsp;&nbsp;-&nbsp;&nbsp;    
                <span class="text-color1 text-bold">{{i.totalInterview}}</span> {{d.l10n.btnInterview}}   &nbsp;&nbsp;-&nbsp;&nbsp;   
                <span class="text-color1 text-bold">{{i.totalHire}}</span> {{d.l10n.btnHire}} &nbsp;&nbsp;-&nbsp;&nbsp;   
                <span class="text-color1 text-bold">{{i.totalDeny}}</span> {{d.l10n.btnDeny}} <p>
            <p class="t-s-11 text-color2">{{formatLatestDay i.last_signin}}</p>
            
        </td>
        <td>
            <p>{{i.e}}</p>
            <p><a href="tel:{{i.p}}">{{i.p}}</p>
        </td>
        <td class="hidden">{{i.ad}} - {{{textFromDropdownLocal i.ci 'location' 'id' 'ti'}}}</td>
        <td>
            <div class="row-xs-4 text-center">
                <div class="col-xs-4">
                    {{{formatDate i.cr '%d-%M-%Y'}}}
                </div>
                <div class="col-xs-4">
                    {{i.pa}} / {{i.jl}}
                </div>
                <div class="col-xs-4">
                    {{#if i.s}}
                    <span>{{{textFromDropdownLocal i.s 'userStatus' 'id' 'ti'}}}</span>
                    {{/if}}
                </div>
            </div>

        </td>
        <td>
            <div class="btn-control text-right">
                {{#xif ' this.i.tc < 0 '}}
                    <span class="text-color3 text-bold">{{d.l10n.expired}}</span>
                {{else}}
                    {{{formatDate i.dl '%d-%M-%Y'}}}
                {{/xif}}
                <p class="t-s-11 text-color2">{{formatDayLeft i.dl}}</p>

            </div>
        </td>
    </tr>
</script>

<script id="entryViewEmploymentDetail" type="text/x-handlebars-template">
    <div class="row ">
        <div class="col-sm-3 col-lg-2">
            <div class="user-employment-action"
                data-elm-data='{
                    "id":"{{i.userinfo.db.id}}",
                    "title":"{{i.userinfo.db.name}}",
                    "deactive":"{{i.userinfo.db.deactive}}",
                    "{{e.view}}":"1"
                }'
                data-copy-template
                data-view-template=".user-employment-action"
                data-template-id="entryViewEmploymentFunction"></div>
        </div>
        <div class="col-sm-9 col-lg-10">
            {{#xif ' this.e.view== "checkout" '}}
            <div class="user-employment-checkout"
                data-elm-data='{
                    "formAction":"/<?=$seo_name["page"]["admin"]?>?fun=cmp&view=1",
                    "formActionClass":"hidden",
                    "strUrlList":"<?=APIGETCHECKOUT?>?uid={{i.userinfo.db.id}}"
                }'
                data-copy-template
                data-view-template=".user-employment-checkout"
                data-template-id="entryAdminManageCheckout"></div>
            {{/xif}}

            {{#xif ' this.e.view== "blog" '}}
            <div class="user-employment-blog"
                data-elm-data='{
                    "formAction":"/<?=$seo_name["page"]["admin"]?>?fun=cmp&view=1",
                    "formActionClass":"hidden",
                    "strUrlList":"<?=APIGETBLOG?>?uid={{i.userinfo.db.id}}"
                }'
                data-copy-template
                data-view-template=".user-employment-blog"
                data-template-id="entryAdminManageBlogUser"></div>
            {{/xif}}

            {{#xif ' this.e.view== "info" '}}
            <div class="user-employment-profile"
                data-elm-data='{

                }'
                data-google-map-in-template="google-map-profile"
                data-option-local="employmentDetail"
                data-copy-template
                data-view-template=".user-employment-profile"
                data-template-id="entryViewEmploymentProfile">
            </div>

            {{/xif}}

            {{#xif ' this.e.view== "promocode" '}}
            <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-init-object="userAppliedPromocode"
                data-url="<?=APIGETPROMOAPPLIED;?>"
                data-params="uid={{i.userinfo.db.id}}"
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-template-id="entryPromoAppliedItem" >
                <div class="head-title">
                    <div class="row">
                        <div class="col-xs-3"><label>{{d.l10n.promoCode}}</label></div>
                        <div class="col-xs-6"><label>{{d.l10n.servicePackage}}</label></div>
                        <div class="col-xs-3"><label>Date Applied</label></div>
                    </div>
                </div>
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
            {{/xif}}

            {{#xif ' this.e.view== "page" '}}
            <div class="cmp-manage-page "
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-init-object="userCompany"
                data-url="<?=APIGETCOMPANY;?>"
                data-params="uid={{i.userinfo.db.id}}"
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-template-id="entryViewCmpPageItem" >
                <div class="view-items" data-content><div class="style-loadding">...</div></div>
                <div data-footer></div>
            </div>
            {{/xif}}

            {{#xif ' this.e.view== "jobs" '}}
                {{#if e.jobDetail}}
                    <div data-ui-tabs
                        data-ignore-hash="true"
                        data-tab-class="ui-tabs"
                        data-mobile-title="tab-title">
                            <div class="product-des">
                                <div class="item-content current">
                                    <h3 class="icon tab-title">{{d.l10n.content}}</h3>
                                    <div class="tab-content">
                                        <div class="user-employment-jobdetail"
                                            data-elm-data='{
                                            }'
                                            data-google-map-in-template="google-map-profile"
                                            data-option-local="jobDetail"
                                            data-copy-template
                                            data-view-template=".user-employment-jobdetail"
                                            data-template-id="entryJobView">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-content current">
                                    <h3 class="icon tab-title">{{d.l10n.applied}}</h3>
                                    <div class="tab-content">
                                        <div class="item-view-more"
                                            data-view-list-by-handlebar
                                            data-init-button-magic=".item [data-button-magic]"
                                            data-init-object="viewAppliedCv"
                                            data-url="/api/get/useraction?uid={{i.userinfo.db.id}}&jid={{e.jobDetail}}&action=userapply"
                                            data-elm-data='{

                                            }'
                                            data-method="get"
                                            data-show-page="10"
                                            data-show-item="20"
                                            data-show-all="false"
                                            data-scroll-view="false"
                                            data-form-filter=".form-filter"
                                            data-is-reload-page="true"
                                            data-reload-base-on-id="ui"
                                            data-reload-base-set-params="listID"
                                            data-reload-url="/api/get/userlistid"
                                            data-template-id="entryCvItemActionApplied">
                                            <form class="form-filter">
                                               <div class="row">
                                                    <div class="col-sm-4">
                                                         <div class="header-nav-in t-s-16 "><label><?=$language["total"]?>:</label> <span class="text-bold text-color3" data-total-item></span> <?=$language["peopleAppliedJob"]?></div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <input class="form-control"
                                                            name="title"
                                                            data-compare="text in"
                                                            data-key="na"
                                                            placeholder="{{d.l10n.placeholderSearchCv}}">
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <select name="loc"
                                                            data-compare="text in"
                                                            data-key="lo"
                                                            class="form-control"
                                                            type="select"
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.locationSearch}}"}'
                                                            data-dropdown
                                                            data-option-local-json="location">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">

                                                        <select name="ex"
                                                            class="form-control"
                                                            data-compare="equal"
                                                            data-key="e"
                                                            type="select"
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.experienceWork}}"}'
                                                            data-dropdown
                                                            data-option-local-json="yearOfExperience">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <select name="la"
                                                            data-compare="text in"
                                                            data-key="la"
                                                            class="form-control"
                                                            type="select"
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.language}}"}'
                                                            data-dropdown
                                                            data-option-local-json="languageOption">
                                                        </select>
                                                    </div>
                                               </div>
                                            </form>
                                            <div data-content class="view-items m-t-10"></div>
                                            <div class="no-data">
                                                <div class="no-data-content">{{d.l10n.noAppliedForThisJob}}</div>
                                            </div>
                                            <div data-footer></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                {{else}}
                    {{#if i.totalJob}}
                    <div class="admin-manage-job"
                        data-elm-data='{
                            "formAction":"/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.userinfo.db.id}}&view=jobs",
                            "formActionClass":"hidden",
                            "strUrlList":"<?=APIGETJOB?>?uid={{i.userinfo.db.id}}"
                        }'
                        data-copy-template=""
                        data-view-template=".admin-manage-job"
                        data-template-id="entryManageJobs">
                    </div>
                    {{else}}
                    <div class="no-data-content">did not find job from this company.</div>
                    {{/if}}
                {{/if}}
            {{/xif}}
        </div>
    </div>
</script>
<script id="entryViewEmploymentProfile" type="text/x-handlebars-template">
    <div class="cmp-more no-m-top emp-info">
        <table class="w-100">
            <colgroup>
            <col class="col-xs-4 col-sm-3">
            <col class="col-xs-8 col-sm-9">
            </colgroup>
            <tbody>
                <tr>
                    <td colspan="2"><label class="text-color1 j-stitle t-s-18 ">{{d.l10n.generalInfo}}</label></td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.avatar}}</strong></td>
                    <td>
                        <div class="image-preview transition b-r-4 v-center m-b-10">
                            {{#if i.userinfo.db.im}}
                                {{#if e.cmpid}}
                                <img src="/<?=FOLDERIMAGECOMPANY?>{{i.userinfo.db.im}}">
                                {{else}}
                                <img src="/<?=FOLDERIMAGEUSER?>{{i.userinfo.db.im}}">
                                {{/if}}
                            {{else}}
                                <img src="/media/images/style/user.png">
                            {{/if}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.coverphoto}}</strong></td>
                    <td>
                        <div class="update-banner-image-setting m-b-10">
                            <div class="image-preview transition b-r-4 v-center">
                                {{#if e.cmpid}}
                                    {{#if i.companybanner}}
                                    <img src="/<?=FOLDERIMAGECOMPANY?>{{i.companybanner}}">
                                    {{else}}
                                    <img src="/media/images/style/cover-default.jpg">
                                    {{/if}}
                                {{else}}
                                    {{#if i.userbanner}}
                                    <img src="/<?=FOLDERIMAGEUSER?>{{i.userbanner}}">
                                    {{else}}
                                    <img src="/media/images/style/cover-default.jpg">
                                    {{/if}}
                                {{/if}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.companyName}}</strong></td>
                    <td><p>{{i.userinfo.db.name}}</p></td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.jobCategories}}</strong></td>
                    <td>
                        <p class="c-list">{{{textFromDropdownLocal i.userinfo.db.category 'menuList' ''}}}</p>
                    </td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.companySize}}</strong></td>
                    <td><p>{{{textFromDropdownLocal i.userinfo.db.size 'companySize' 'id' 'ti'}}}</p></td>
                </tr>
                {{#unless e.cmpid}}
                <tr>
                    <td><strong>{{d.l10n.email}}</strong></td>
                    <td><p>{{i.userinfo.db.email}}</p></td>
                </tr>
                {{/unless}}
                <tr>
                    <td><strong>{{d.l10n.phone}}</strong></td>
                    <td><a href="tel:{{i.userinfo.db.phone}}">{{i.userinfo.db.phone}}</a></td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.address}}</strong></td>
                    <td><p>{{i.userinfo.db.address}}</p></td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.city}}</strong></td>
                    <td><p>{{{textFromDropdownLocal i.userinfo.db.city 'locationOption' '' ''}}}</p></td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.website}}</strong></td>
                    <td><p>{{i.userinfo.db.website}}</p></td>
                </tr>
                <tr>
                    <td><strong>{{d.l10n.facebook}}</strong></td>
                    <td><p>{{i.userinfo.db.facebook}}</p></td>
                </tr>
                {{#if e.cmpid}}
                <tr>
                    <td><strong>{{d.l10n.addressUrl}}</strong></td>
                    <td><a href="{{d.l10n.siteurl}}{{i.userinfo.db.url}}">{{d.l10n.siteurl}}{{i.userinfo.db.url}}</a></td>
                </tr>
                {{/if}}
            </tbody>
        </table>
    </div>

    <div class="cmp-more">
        <div class="row">
            <div class="col-sm-3">
                <label class="text-color1 j-stitle t-s-18">{{d.l10n.about}}</label>
            </div>
            <div class="col-sm-9">
                <div>{{{i.more.about}}}</div>
            </div>
        </div>
    </div>
    <div class="cmp-more">
        <div class="row">
            <div class="col-sm-3">
                <label class="text-color1 j-stitle t-s-18">{{d.l10n.whyWorkUs}}</label>
            </div>
            <div class="col-sm-9">
                <div>{{{i.more.whyworkus}}}</div>
            </div>
        </div>
    </div>
    {{#if i.latlng}}
    <div class="cmp-more">
        <div class="row">
            <div class="col-sm-3">
                <label>{{d.l10n.map}}</label>
            </div>
            <div class="col-sm-9">
                <div class="row home-google-map">
                    <div data-google-map="google-map-profile"
                        data-map-point="#google-location .point"
                        data-latitude="{{i.latlng.lat}}"
                        data-longitude="{{i.latlng.lng}}"
                        data-zoom="8"
                        data-roadmap="true"
                        data-map-point-sms=".msm-content"></div>
                    <ul id="google-location" class="hidden">
                        <li class="point"
                            data-latitude="{{i.latlng.lat}}"
                            data-longitude="{{i.latlng.lng}}"
                            data-id="id">
                            <div class="msm-content">
                                <div class="msm-content-detail" data-copy-obj=".header-profile .col-sm-10">
                                    ...
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div id="google-map-profile" style="width: 100%; height: 280px;">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
    {{/if}}
</script>
<script id="entryViewEmploymentFunction" type="text/x-handlebars-template">
    <div class="block">
        <div class="block-title bg-color2 text-uppercase text-bold">
            <span>{{e.title}}</span>
        </div>
        <div class="block-content">
            <ul>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{e.id}}" class="{{#if e.info}}active{{/if}}">General</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{e.id}}&view=page" class="{{#if e.page}}active{{/if}}">Page CMP</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{e.id}}&view=jobs" class="{{#if e.jobs}}active{{/if}}">Jobs</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{e.id}}&view=blog" class="{{#if e.blog}}active{{/if}}">Blog</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{e.id}}&view=checkout" class="{{#if e.checkout}}active{{/if}}">Payments</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{e.id}}&view=promocode" class="{{#if e.promocode}}active{{/if}}">Applied Code</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="block">
        <div class="block-title bg-color2 text-uppercase text-bold">
            Admin Action
        </div>
        <div class="block-content">
             {{#if u.adminlog.permission }}
            <span class="btn btn-block bg-color3 text-uppercase"
                data-button-magic
                data-ajax-url="<?=APIPOSTADMINACTIVE?>"
                {{#xif ' this.e.deactive == 2' }}
                data-params='{
                    "db":{
                        "uid":"{{e.id}}",
                        "deactive":"0"
                    },
                    "mod":"lockaccount"
                }'
                {{else}}
                data-params='{
                    "db":{
                        "uid":"{{e.id}}",
                        "deactive":"2"
                    },
                    "mod":"lockaccount"
                }'
                {{/xif}}
                data-format-json="true"
                data-method="post"
                data-redirect="."
                data-template-id="entryMakeAdminManageForm">
                    {{#xif ' this.e.deactive == 2' }}Unlock Account{{else}}Lock Account{{/xif}}
                </span>
            {{/if}}
            {{#xif ' this.u.adminlog.permission == 100 '}}
            <span class="btn btn-block btn-default"
                data-button-magic
                data-ajax-url="<?=APIGETUSERMANAGER?>/{{e.id}}"
                data-method="get"
                data-elm-data='{
                    "user_id":"{{e.id}}"
                }'
                data-view-template-local="false"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryMakeAdminManageForm">Make admin website</span>
            {{/xif}}
        </div>
    </div>
</script>


<script id="entryAdminViewItemJob" type="text/x-handlebars-template">
    <div class="item i-blog">
        <div class="i-search transition status-{{i.db.st}}">
           <div class="j-title transition">
               <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.db.ui}}&view=jobs&detail={{i.db.id}}">
                  <div class="j-level text-color2 no-margin c-list">{{{textFromDropdownLocal i.db.ty 'jobTimeOption' '' ''}}}</div>
                  <div class="j-name transition no-margin">{{i.db.ti}}</div>
               </a>
           </div>

            <strong class="text-color3">
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
            <p class="text-salary">{{{textFromDropdownLocal i.db.ex 'yearOfExperience' 'id' 'ti'}}}</p>
            {{#if e.showCmp}}
            <p class="text-postby short-text">
                <span class="text-color4">{{d.l10n.postby}}</span>
                <span class="text-color2 j-level">{{i.cmp.name}}</span>
            </p>
            {{/if}}
            <p class="text-address"><p class="text-address c-list">{{{textFromDropdownLocal i.db.lo 'locationOption' '' ''}}}</p></p>
        </div>
    </div>
</script>

<script id="entryEmploymentDetail" type="text/x-handlebars-template">
    entryEmploymentDetail
</script>

<script id="entryAdminManageJobs" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-url="<?=APIGETJOB;?>"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-elm-data='{"adminList":1}'
        data-template-id="entryJobItem" >
        <div class="admin-title">
            <h2>{{d.l10n.jobManage}}</h2>
        </div>
        <div class="head-title">
            <div class="row">
                <div class="col-xs-5"><label>{{d.l10n.title}}</label></div>
                <div class="col-xs-2"><label>{{d.l10n.jobLevel}}</label></div>
                <div class="col-xs-2"><label>{{d.l10n.category}}</label></div>
                <div class="col-xs-2"><label>{{d.l10n.status}}</label></div>
                <div class="col-xs-1 text-right"><label>&nbsp;</label></div>
            </div>
        </div>
        <div class="content-filter">
            <form class="form-filter">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <input type="text"
                                        name="id"
                                        data-compare="equal"
                                        placeholder="#"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="form-group">
                                    <input type="text"
                                        name="ti"
                                        data-compare="text in"
                                        placeholder="{{d.l10n.title}}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <select name="le"
                                    type="select"
                                    data-validate
                                    data-required="{{d.l10n.requireTitle}}"
                                    data-dropdown
                                    data-option-local-json="jobLevel"
                                    data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                    data-compare="in"
                                    data-option-base-on-url="le"
                                    class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <select name="ca"
                                data-dropdown
                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                data-option-local-json="menuStructure"
                                data-params="opp=3"
                                data-compare="in"
                                data-key="ca"
                                data-option-base-on-url="cat"
                                class="form-control">
                                <option value="">{{d.l10n.viewAll}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <select name="st"
                                data-dropdown
                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                data-option-local-json="jobStatus"
                                data-compare="equal"
                                data-option-base-on-url="st"
                                class="form-control">
                                <option value="">{{d.l10n.viewAll}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="view-items" data-content><div class="style-loadding">...</div></div>
    </div>
</script>


<script id="entryManageJobs" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        data-init-object="manageJobs"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-elm-data='{"adminList":"1", "linkDetail":"/<?=$seo_name["page"]["admin"]?>?fun=checkout"}'
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="entryRowJob" >

        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.jobManage}} (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form
                    {{#if e.formAction}}
                    action="{{e.formAction}}"
                    {{else}}
                    action="/<?=$seo_name["page"]["admin"]?>?fun=jobs"
                    {{/if}}
                    method="post"
                    class="post-form form-inline text-right {{e.formActionClass}}">
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
        <div class="table-responsives m-t-10">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-1">
                    <col class="col-sm-3">
                    <col class="col-sm-2">
                    <col class="col-sm-1">
                    <col class="col-sm-2">
                    <col class="col-sm-3">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter o-hidden" data-waiting="500">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <input class="form-control"
                                            data-compare="equal"
                                            name="id"
                                            data-key="id"
                                            placeholder="{{d.l10n.id}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control"
                                            name="ti"
                                            data-compare="text in"
                                            data-key="ti"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.jobTitle}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control"
                                            name="na"
                                            data-compare="text in"
                                            data-key="na"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.companyName}}">
                                    </div>
                                    <div class="col-sm-1">
                                        <select name="location"
                                                class="form-control"
                                                data-key="lo"
                                                data-compare="in"
                                                data-required="{{d.l10n.require}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                data-dropdown
                                                data-option-local-json="location">
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="cat"
                                            data-dropdown
                                            data-object-init='{"id":"", "ti":"{{d.l10n.jobCategories}}"}'
                                            data-option-local-json="menuStructure"
                                            data-params="opp=3"
                                            data-compare="in"
                                            data-key="ca"
                                            data-option-base-on-url="cat"
                                            class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                {{d.l10n.jobExpires}}
                                            </div>
                                            <div class="col-xs-6">
                                                {{d.l10n.jobSalary}}
                                            </div>
                                        </div>
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
    </div>
</script>

<script id="entryRowJob" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>
            <p>{{i.id}} <span
                class="btn-xs bg-color7 p-5 fa fa-pencil"
                title="Edit id {{i.id}}"
                data-button-magic
                data-method="get"
                data-ajax-url="<?=APIGETJOB?>/{{i.id}}"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryJobEdit"></span></p>
            
        </td>
        <td>
            <p class="text-bold">
                <a class="text-color1" href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.ui}}&view=jobs&detail={{i.id}}" href="#"><span class="text-bold text-color2">( {{i.total_applied}} )</span> - <span class="text-color3">({{i.vi}})</span> {{i.ti}}</a>
            </p>
           
        </td>
        <td>
            <p class="short-text">
                <a class="text-color3" href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.ui}}">{{i.na}}</a>
            </p>
        </td>
        <td>
            <p class="c-list">{{{textFromDropdownLocal i.lo 'locationOption' ''}}}</p>
        </td>
        <td>
            <p class="c-list">{{{textFromDropdownLocal i.ca 'menuList' ''}}}</p>
        </td>
        <td>
            <div class="row">
                <div class="col-xs-6">
                    <p>{{i.de}}</p>
                </div>
                <div class="col-xs-6">
                    {{#xif " this.i.sn==1"}}
                        {{d.l10n.negotiable}}
                    {{else}}
                        {{#xif " this.i.sa==1"}}
                            {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 1 'currency' 'id' 'ti'}}}
                        {{else}}
                            {{formatCurrency i.s1}} - {{formatCurrency i.s2}} {{{textFromDropdownLocal 2 'currency' 'id' 'ti'}}}
                        {{/xif}}
                    {{/xif}}
                </div>
            </div>
        </td>
    </tr>
</script>

<script id="entryAdminManagePromo" type="text/x-handlebars-template">
    <div class="item-view-promo-list admin-list"
        data-view-list-by-handlebar
        data-init-button-magic=".item-view-promo-list [data-button-magic]"
        data-init-object="userManagePromoCode"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-elm-data='{"adminList":1}'
        data-template-id="entryPromoItem" >
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="admin-title">
                    <h2>Manager Promocode</h2>
                </div>
           </div>
           <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form
                    action="/<?=$seo_name["page"]["admin"]?>?fun=promo"
                    method="post"
                    class="post-form form-inline text-right {{e.formActionClass}}">
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
        <table class="table table-bordered">
            <colgroup>
                <col class="col-xs-1">
                <col class="col-xs-1">
                <col class="col-xs-2">
                <col class="col-xs-4">
                <col class="col-xs-2">
                <col class="col-xs-2">
            </colgroup>
            <thead>
                <tr class="b-b">
                    <th colspan="5">
                        <form class="form-filter o-hidden text-center" data-waiting="500">
                            <div class="">
                                <div class="col-xs-1"></div>

                                <div class="col-xs-1">
                                    <select name="status"
                                        data-validate
                                        data-required="{{d.l10n.requireContent}}"
                                        data-dropdown
                                        data-compare="equal"
                                        data-key="t"
                                        data-object-init='{"id":"", "ti":"{{d.l10n.status}}"}'
                                        data-option-local-json="promoStatus"
                                        data-index-value="{{i.status}}"
                                        class="form-control">
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control"
                                        data-compare="equal"
                                        name="code"
                                        data-key="c"
                                        placeholder="Code">
                                </div>
                                <div class="col-xs-4 text-left">Note</div>

                                <div class="col-xs-2">
                                    <select name="service"
                                        data-validate
                                        data-required="{{d.l10n.requireContent}}"
                                        data-dropdown
                                        data-compare="equal"
                                        data-key="s"
                                        data-str-key="id"
                                        data-str-value="title"
                                        data-object-init='{"id":"", "title":"{{d.l10n.servicePackage}}"}'
                                        data-option-local-json="service"
                                        data-index-value="{{i.status}}"
                                        class="form-control">
                                    </select>
                                </div>
                                <div class="col-xs-2">{{d.l10n.timeCreated}}</div>
                                
                                
                            </div>
                        </form>
                    </th>
                </tr>
            </thead>

            <tbody class="view-items" data-content>

            </tbody>

        </table>
        <div class="row">
            <div class="col-xs-10">
                <div data-footer></div>
            </div>
            <div class="col-xs-2 text-right">
                <button class="btn btn-warning form-add btn-add-a-item"
                data-button-magic
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="managePromoGenerate">{{d.l10n.btnAdd}} + </button>
            </div>
        </div>
    </div>
</script>
<script id="entryPromoItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td class="col-xs-1">
            <div class="text-right">
                {{#xif ' this.i.t==1'}}
                <span
                    class="btn btn-xs bg-color3 text-uppercase"
                    data-button-magic
                    data-method="post"
                    data-ajax-url="<?=APIPOSTPROMO?>"
                    data-params='{"db":{"id":"{{i.i}}","status":"2"}}'
                    data-format-json="true"
                    data-refress-list=".item-view-promo-list">Active</span>
                {{/xif}}
            </div>
        </td>
        <td class="col-xs-1">
            <strong class="text-color{{i.t}}">
               {{{textFromDropdownLocal i.t 'promoStatus' 'id' 'ti'}}}
            </strong>
        </td>
        <td class="col-xs-2">
            <div>{{i.c}}<br><span class="text-color3">{{i.na}}</span></div>
        </td>
        <td class="col-xs-4">
            <div>
            <form class="post-form form-inline o-hidden" data-waiting="500">
                <input type="hidden" value="{{i.i}}" name="db.id">
                <input  type="text" 
                        name="db.note"
                        value="{{i.n}}"
                        data-server="<?=APIPOSTPROMO?>"
                        data-params='{"db":{"id":"{{i.i}}"}}'
                        class="form-control"
                        style="width:80%">

                <input type="submit"
                        data-button-magic
                        data-params-form=".post-form"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTPROMO?>"
                        data-show-success=".modal-footer .alert"
                        data-show-errors=".modal.signin-missing-session"
                        data-redirect="."
                        class="btn btn-xs bg-color1"
                        value="{{d.l10n.btnSave}}">

            </form>
            </div>
        </td>
        <td class="col-xs-2">
            <div>{{{textFromDropdownLocal i.s 'service' 'id' 'title'}}}</div>
        </td>

        <td class="col-xs-2">
            <div>{{{formatDate i.r '%d-%M-%Y'}}}</div>
        </td>
        
        
        
    </tr>
</script>

<script id="managePromoAdd" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.promoManage}} :: {{d.l10n.btnAdd}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <form class="form-horizontal post-form">
                    <div class="hiddens">
                        {{#if i.db.id}}
                            <input type="hidden" name="db.id" value="{{i.db.id}}">
                        {{/if}}
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.promoCode}}
                        </label>
                        <div class="col-sm-10">
                            {{#if i.db.code}}
                                <span class="form-control disabled">{{i.db.code}}</span>
                            {{else}}
                            <input  type="text" name="db.code"
                                    data-validate
                                    data-required="{{d.l10n.promoCode}}"
                                    data-server="/api/post/promocode"
                                    data-params='{"id":"-1" }'
                                    data-key = "code"
                                    class="form-control">
                            <span class="error"></span>
                            {{/if}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.promoService}}
                        </label>
                        <div class="col-sm-10">
                            <select name="db.service_id"
                                class="form-control"
                                type="select"
                                data-validate
                                data-required="Please option Service"
                                data-str-key="id"
                                data-str-value="title"
                                data-index-value="{{i.db.service_id}}"
                                data-dropdown
                                data-object-init='{"id":"", "title":"{{d.l10n.optional}}"}'
                                data-option-local-json="service">
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.status}}
                        </label>
                        <div class="col-sm-10">
                            <div class="option-inline">
                                <label class="radio">
                                    <input type="radio"
                                      name="db.status"
                                      data-validate
                                      data-required="{{d.l10n.requireStatus}}"
                                      data-hidden-message="true"
                                      {{#xif  " this.i.db.status == 1 " }}
                                      checked="checked"
                                      {{/xif}}
                                      value="1">
                                    <span class="radio-style"></span>{{d.l10n.Off}}
                                    <span class="error"></span>
                                </label>
                            </div>
                            <div class="option-inline">
                                <label class="radio">
                                    <input type="radio"
                                      name="db.status"
                                      data-validate
                                      data-required="{{d.l10n.requireStatus}}"
                                      data-hidden-message="true"
                                      {{#xif  " this.i.db.status == 2 " }}
                                      checked="checked"
                                      {{/xif}}
                                      value="2">
                                  <span class="radio-style"></span>{{d.l10n.On}}
                                  <span class="error"></span>
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTPROMO?>"
                                data-show-success=".modal-footer .alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-redirect="."
                                class="btn btn-primary"
                                value="{{#if i.db.id}}{{d.l10n.update}}{{else}}{{d.l10n.btnAdd}}{{/if}}">
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
                        <span class="btn btn-default"
                            data-closet-toggle-class="in"
                            data-object=".modal"
                            data-empty-object="[data-quick-view-item]">Close</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<script id="managePromoGenerate" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.promoManage}} :: generate</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <form class="form-horizontal post-form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            So luong
                        </label>
                        <div class="col-sm-10">
                            <input  type="text" name="db.number"
                                    data-validate
                                    data-required="{{d.l10n.require}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            So luong
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="db.note"
                                    data-validate
                                    placeholder="Note..."
                                    data-required="please input number"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.promoService}}
                        </label>
                        <div class="col-sm-10">
                            <select name="db.service_id"
                                class="form-control"
                                type="select"
                                data-validate
                                data-required="Please option Service"
                                data-str-key="id"
                                data-str-value="title"
                                data-index-value="{{i.db.service_id}}"
                                data-dropdown
                                data-object-init='{"id":"", "title":"{{d.l10n.optional}}"}'
                                data-option-local-json="service">
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTPROMO?>"
                                data-show-success=".modal-footer .alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-redirect="."
                                class="btn btn-primary"
                                value="Generate">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</script>
<script id="entryJobSuggestItem" type="text/x-handlebars-template">
<div class="item item-blog item-status-{{i.st}}">
    <div class="row">
        <div class="col-xs-5">
            <div class="row">
                <div class="col-xs-3">{{i.id}}</div>
                <div class="col-xs-9">{{i.db.ti}}</div>
            </div>
        </div>
        <div class="col-xs-3">
            <span>{{{textFromDropdownLocal i.db.le 'jobLevel' 'id' 'ti'}}}</span>
        </div>
        <div class="col-xs-3">
            <div class="c-list">{{{textFromDropdownLocal i.db.ca 'menuList' ''}}}</div>
        </div>
        <div class="col-xs-1 btn-control text-right">
            <span
                class="icon-pencil icon-lg"
                title="Edit id {{i.id}}"
                data-elm-data='{
                    "urlGet":"<?=APIGETCATEGORY?>",
                    "urlPost":"<?=APIPOSTCATEGORY?>",
                    "itemId":"{{e.itemId}}",
                    "modalClose":"[data-quick-view-item1]",
                    "jobSuggest":"true"
                }'
                data-button-magic
                data-method="get"
                data-ajax-url="<?=APIGETCATEGORY?>/{{e.itemId}}?jobSuggestId={{i.id}}"
                data-view-template="[data-quick-view-item1]"
            data-template-id="jobsAdd"></span>
            <span
                class="icon-bin icon-lg"
                title="Delete"
                data-button-magic
                data-confirm="true"
                data-method="post"
                data-format-json="true"
                data-params='{ "id":"{{e.itemId}}","delId":"{{i.id}}", "updateNode":"jobSuggest"}'
                data-ajax-url="<?=APIPOSTCATEGORY?>"
            data-refress-list=".item-view-more"> </span>
        </div>
    </div>
</div>
</script>

<script id="entryAdminManageCheckout" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-init-object="userManageCheckout"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-elm-data='{"adminList":"1", "linkDetail":"/<?=$seo_name["page"]["admin"]?>?fun=checkout"}'
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="entryCheckoutItem" >
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.paymentsHistory}} (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form
                    {{#if e.formAction}}
                    action="{{e.formAction}}"
                    {{else}}
                    action="/<?=$seo_name["page"]["admin"]?>?fun=checkout"
                    {{/if}}
                    method="post"
                    class="post-form form-inline text-right {{e.formActionClass}}">
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

        <div class="table-responsives">
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
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter o-hidden" data-waiting="500">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <input class="form-control"
                                            data-compare="equal"
                                            name="id"
                                            data-key="id"
                                            placeholder="{{d.l10n.id}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="service"
                                            data-validate
                                            data-required="{{d.l10n.requireContent}}"
                                            data-dropdown
                                            data-compare="equal"
                                            data-key="si"
                                            data-str-key="id"
                                            data-str-value="title"
                                            data-object-init='{"id":"", "title":"{{d.l10n.servicePackage}}"}'
                                            data-option-local-json="service"
                                            class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        {{d.l10n.servicePrice}}
                                    </div>
                                    <div class="col-sm-2">
                                        {{d.l10n.date}}
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="pm"
                                            data-validate
                                            data-required="{{d.l10n.requireContent}}"
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
                                            data-required="{{d.l10n.requireContent}}"
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
    </div>
</script>

<!-- news manager-->
<script id="manageNewsItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>
            <label>{{i.id}}</label>
        </td>
        <td>
            <span class="title">{{i.ti}}</span>
        </td>
        <td>
            <span class="c-list">
                {{{textFromDropdownLocal i.me 'menuList' ''}}}
            </span>
        </td>
        <td>
            {{#if i.st}}
            <span>{{{textFromDropdownLocal i.st 'blogStatus' 'id' 'ti'}}}</span>
            {{/if}}
        </td>
        <td>
            {{{formatDate i.cr '%Y-%M-%d'}}}
        </td>
        <td>
            <div class="text-right">
                <span
                    class="icon-pencil icon-lg"
                    title="Edit id {{i.id}}"
                    data-button-magic
                    data-method="get"
                    data-ajax-url="<?=APIGETNEWS?>/{{i.id}}"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entryNewsEdit"></span>
                <span
                    class="icon-bin icon-lg"
                    title="Delete"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    data-params='{ "id":"{{i.id}}", "uid":"{{u.userinfo.db.id}}", "updateNode":"del"}'
                    data-ajax-url="<?=APIPOSTNEWS?>"
                    data-refress-list=".item-view-more"> </span>
            </div>
        </td>
    </tr>
</script>
<script id="entryAdminManageNews" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{else}}
        data-url="/api/get/news"
        {{/if}}
        data-init-object="adminManageUser"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="manageNewsItem">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.blogManage}} (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form="" action="/<?=$seo_name["page"]["admin"]?>?fun=news" method="post" class="post-form form-inline text-right">
                    <div class="form-group">
                        <label>From</label>
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
                        <label>To</label>
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

        <div class="table-responsives">
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
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter" data-waiting="500">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="text"
                                            name="i"
                                            data-compare="equal"
                                            placeholder="#"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text"
                                            name="ti"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.title}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <select name="ci"
                                                class="form-control"
                                                data-key="ca"
                                                data-compare="equal"
                                                data-required="{{d.l10n.require}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.category}}"}'
                                                data-dropdown
                                                data-option-local-json="menuStructure">
                                        </select>
                                    </div>

                                    <div class="col-xs-2">
                                        {{d.l10n.status}}
                                    </div>
                                    <div class="col-xs-2">
                                        {{d.l10n.timeCreated}}
                                    </div>
                                    <div class="col-xs-1">
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="view-items" data-content>
                </tbody>
            </table>
            <div class="row">
            <div class="col-xs-10">
                <div data-footer></div>
            </div>
            <div class="col-xs-2 text-right">
                <button class="btn btn-warning form-add btn-add-a-item"
                data-button-magic
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryNewsAdd">{{d.l10n.btnAdd}} + </button>
            </div>
        </div>
        </div>
    </div>
</script>

<script id="entryNewsForm" type="text/x-handlebars-template">
    <form method="post"
        class="form-horizontal post-form">
        <div class="hidden">
            <input type="text"
                class="form-control"
                name="db.ui"
                value="{{u.userinfo.db.id}}">
            <input type="text"
                class="form-control"
                name="updateNode"
                value="db">
            {{#if e.db.id}}
            <input type="text"
                class="form-control"
                name="db.id"
                value="{{e.db.id}}">
            {{/if}}
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.title}} VI
            </label>
            <div class="col-sm-10">
                <input  type="text"
                    name="db.ti_vi"
                    {{#if e.db.ti_vi}}
                    value="{{e.db.ti_vi}}"
                    {{/if}}
                    data-validate
                    data-required="{{d.l10n.requireTitle}}"
                    class="form-control">
                <span class="error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.title}} EN
            </label>
            <div class="col-sm-10">
                <input
                    type="text"
                    name="db.ti_en"
                    {{#if e.db.ti_en}}
                    value="{{e.db.ti_en}}"
                    {{/if}}
                    class="form-control">
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.category}}
            </label>
            <div class="col-sm-10">
                <select name="menulist"
                        class="form-control"
                        data-multiselect-box
                        data-multi-selected="{{e.db.me}}"
                        data-key-name="db.me"
                        data-validate
                        data-required="{{d.l10n.requireContent}}"
                        data-dropdown
                        data-option-from-json="<?=APIGETMENU;?>"
                        data-option-local-json="menuStructure"
                        data-params="opp=2"
                        data-object-init='{"id":"", "ti":"{{d.l10n.categoryOption}}"}'
                        data-target-append=".multiselect-category">
                        <option value="">{{d.l10n.categoryOption}}</option>
                </select>
                <div data-show-options-list class="multiselect-category"></div>
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.content}} VI
            </label>
            <div class="col-sm-10">
                <textarea
                    name="db.co_vi"
                    class="form-control">{{#if e.db.co_vi}}{{e.db.co_vi}}{{/if}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.content}} EN
            </label>
            <div class="col-sm-10">
                <textarea
                    name="db.co_en"
                    class="form-control">{{#if e.db.co_en}}{{e.db.co_en}}{{/if}}</textarea>
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <label class="col-sm-2 control-label">{{d.l10n.upcomingEvent}}</label>
            <div class="col-sm-10">
                <input  type="text"
                        name="db.up"
                        {{#xif " this.e.db.up !== '0000-00-00'"}}
                        value="{{e.db.up}}"
                        {{/xif}}
                        data-date-picker
                        data-format="YYYY-MM-DD"
                        data-single-date-picker="true"
                        data-show-dropdowns="true"
                        class="form-control">
                <span class="error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.status}}
            </label>
            <div class="col-sm-10">
                <select name="db.st"
                    data-validate
                    data-required="{{d.l10n.requireContent}}"
                    data-dropdown
                    data-object-init='{"id":"", "ti":"{{d.l10n.status}}"}'
                    data-option-local-json="blogStatus"
                    {{#if e.db.st}}
                    data-index-value="{{e.db.st}}"
                    {{/if}}
                    class="form-control">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="submit"
                    data-button-magic
                    data-params-form=".post-form"
                    data-format-json="true"
                    data-ajax-url="<?=APIPOSTNEWS?>"
                    data-show-success=".modal-footer .alert"
                    data-show-errors=".modal.signin-missing-session"
                    data-redirects="."
                    class="btn btn-primary"
                    {{#if e.db.id}}
                    value="{{d.l10n.btnUpdate}}"
                    {{else}}
                    value="{{d.l10n.btnAdd}}"
                    {{/if}}>
            </div>
        </div>
    </form>
</script>

<script id="entryNewsAdd" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>News::{{d.l10n.btnAdd}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <div class="update-news-form"
                    data-copy-template
                    data-elm-data='{"":""}'
                    data-view-template=".update-news-form"
                    data-template-id="entryNewsForm">
                </div>
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

<script id="entryNewsEdit" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.btnUpdate}}::{{i.db.ti_vi}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <div data-ui-tabs
                    data-tab-class="ui-tabs"
                    data-mobile-title="tab-title">
                    <div class="product-des">
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.general}}</h3>
                            <div class="tab-content">
                                <div class="update-item-image"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"/api/post/image/news",
                                    "urlPostDel":"/api/post/imagedelete",
                                    "imgName":"{{i.db.im}}",
                                    "maxSize":"100000",
                                    "imgPath":"<?=FOLDERIMAGENEWS?>",
                                    "module":"blog",
                                    "ui":"{{u.userinfo.db.id}}",
                                    "disabledDelete":"1",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-item-image"
                                    data-template-id="entryItemImage">
                                </div>
                                <div class="update-news-form"
                                    data-copy-template
                                    data-elm-data='{
                                        "db":{
                                            "id":"{{i.db.id}}",
                                            "ti_vi":"{{i.db.ti_vi}}",
                                            "ti_en":"{{i.db.ti_en}}",
                                            "me":"{{i.db.me}}",
                                            "co_vi":"{{i.db.co_vi}}",
                                            "co_en":"{{i.db.co_en}}",
                                            "up":"{{i.db.up}}",
                                            "st":"{{i.db.st}}"
                                        }}'
                                    data-view-template=".update-news-form"
                                    data-template-id="entryNewsForm">
                                </div>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.content}}</h3>
                            <div class="tab-content">
                                <form class="form-horizontal post-form">
                                    <div class="hidden">
                                        <input  type="text"
                                                    name="db.ui"
                                                    value="{{u.userinfo.db.id}}"
                                                    class="form-control">
                                        <input  type="text"
                                                    name="db.id"
                                                    value="{{i.db.id}}"
                                                    class="form-control">
                                        <input  type="text"
                                                    name="db.type"
                                                    value="more"
                                                    class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.description}} VI
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description.vi"
                                                    class="form-control mce-editor">{{i.more.description.vi}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.description}} EN
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description.en"
                                                    class="form-control mce-editor">{{i.more.description.en}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTNEWS?>"
                                                data-show-success=".modal-footer .alert"
                                                data-show-errors=".modal.signin-missing-session"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.seo}}</h3>
                            <div class="tab-content">
                                <div class="update-seo-item"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"<?=APIPOSTNEWS?>",
                                    "title":{
                                        "vi":"{{i.meta.title.vi}}",
                                        "en":"{{i.meta.title.en}}"
                                    },
                                    "keyword":{
                                        "vi":"{{i.meta.keyword.vi}}",
                                        "en":"{{i.meta.keyword.en}}"
                                    },
                                    "desc":{
                                        "vi":"{{i.meta.desc.vi}}",
                                        "en":"{{i.meta.desc.en}}"
                                    },
                                    "ui":"{{u.userinfo.db.id}}",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-seo-item"
                                    data-template-id="entrySeoItem">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<script id="entryMakeAdminManageForm" type="text/x-handlebars-template">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="admin-title">
                <h2>Make manager website</h2>
            </div>
            <span class="icon-cancel-circle icon-lg1 position-right"
                  data-closet-toggle-class="in"
                  data-object=".modal"
                  data-empty-object="[data-quick-view-item]"></span>
        </div>
        <div class="modal-body">
            <form method="post" class="form-horizontal post-form">
                <div class="hidden">
                    <input type="hidden"
                        name="db.id"
                        value="{{i.id}}">
                    <input type="hidden"
                        name="db.user_id"
                        data-validate
                        data-required="Title"
                        value="{{e.user_id}}">
                    <input type="hidden"
                        name="mod"
                        value="manager">
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <div class="control-label">{{#if i.id}}Permission currency{{else}}Option{{/if}}</div>
                    </div>
                    <div class="col-sm-3">
                        <select  type="select"
                            name="db.permission"
                            data-dropdown
                            data-validate
                            data-required="{{d.l10n.title}}"
                            data-index-value="{{i.permission}}"
                            data-status-option="manager"
                            data-object-init='{"id":"", "ti":"Manager Permission option"}'
                            class="form-control"></select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <div class="control-label">{{d.l10n.password}}</div>
                    </div>
                    <div class="col-sm-3">
                        <input type="text"
                            name="db.password"
                            data-validate
                            data-required="{{d.l10n.password}}"
                            class="form-control">
                        <span class="error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-9">
                        <input type="submit"
                            class="btn bg-color3 text-uppercase"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-method="post"
                            data-ajax-url="<?=APIPOSTADMINACTIVE?>"
                            data-show-success=".alert-footer.alert"
                            data-show-errors=".alert-footer.alert-error"
                            data-redirect="/<?=$seo_name["page"]["admin"]?>?fun=managerweb"
                            {{#if i.id}}
                            value="{{d.l10n.btnUpdate}}"
                            {{else}}
                            value="Make manager website"
                            {{/if}}>
                        <span class="btn btn-default text-color3"
                            data-closet-toggle-class="in"
                            data-object=".modal"
                            data-empty-object="[data-quick-view-item]">{{d.l10n.btnClose}}</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</script>
<script id="entryAdminManagerWebsite" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-init-object="adminManagerWebsite"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="entryAdminManagerItem">
        <div class="row">
            <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10 text-uppercase">
                User manage website (<span data-total-item></span>)
            </header>
        </div>
        <div class="table-responsives">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-1">
                    <col class="col-sm-2">
                    <col class="col-sm-3">
                    <col class="col-sm-3">
                    <col class="col-sm-2">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter" data-waiting="500">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="text"
                                            name="i"
                                            data-compare="equal"
                                            placeholder="#"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text"
                                            name="email"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.email}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text"
                                            name="name"
                                            data-key="n"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.fullname}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-3">
                                        <select name="ci"
                                                class="form-control"
                                                data-key="ci"
                                                data-compare="equal"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                data-dropdown
                                                data-option-local-json="location">
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                        <select name="pe"
                                                class="form-control"
                                                data-key="pe"
                                                data-compare="equal"
                                                data-object-init='{"id":"", "ti":"Permission"}'
                                                data-dropdown
                                                data-status-option="manager">
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="view-items" data-content="">
                </tbody>
            </table>
            <div class="p-10">
                <div data-footer=""></div>
            </div>
        </div>
    </div>
</script>
<script id="entryAdminManagerItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>{{i.i}}</td>
        <td>{{i.e}}</td>
        <td>
            {{#xif ' this.i.t==1 '}}
            <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.i}}" class="text-color2">{{i.n}}</a>
            {{else}}
            <a href="/<?=$seo_name["page"]["admin"]?>?fun=user&view={{i.i}}" class="text-color2">{{i.n}}</a>
            {{/xif}}
        </td>
        <td>{{i.ad}} - {{{textFromDropdownLocal i.ci 'location' 'id' 'ti'}}}</td>
        <td><p class="text-center">{{i.pe}}</p></td>
        <td>
            <div class="text-right">
                <span
                    class="icon-bin icon-lg"
                    title="Delete"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    data-params='{
                        "id":"{{i.umi}}",
                        "uid":"{{i.i}}",
                        "mod":"removemanager"
                    }'
                    data-ajax-url="<?=APIPOSTADMINACTIVE?>"
                    data-refress-list="[data-view-list-by-handlebar]"> </span>
            </div>
        </td>
    </tr>
</script>

<script id="entryAdminManageDaskboard" type="text/x-handlebars-template">
    <div class="row">
        <div class="col-sm-6">
            <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-init-object="adminManageCheckout"
                data-elm-data='{"adminList":"1", "linkDetail":"/<?=$seo_name["page"]["admin"]?>?fun=checkout"}'
                data-method="get"
                data-show-page="10"
                data-show-item="20"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-template-id="entryCheckoutItem" >
                <table class="table table-bordered">
                    <colgroup>
                        <col class="col-sm-1">
                        <col class="col-sm-3">
                        <col class="col-sm-2">
                        <col class="col-sm-2">
                        <col class="col-sm-2">
                        <col class="col-sm-2">
                    </colgroup>
                    <tbody class="view-items" data-content>
                    </tbody>
                </table>
                <div data-footer></div>
            </div>
        </div>
    </div>
</script>

<script id="itemHistorySearch" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>
            {{#xif ' this.i.ui > 0'}}
                #{{i.ui}}
            {{else}}
                Guest
            {{/xif}}
        </td>
        <td>
            <p>{{i.title}}</p>
            <p>{{i.sa}}</p>
        </td>
        <td>
            <p>{{textFromDropdownLocal i.loc 'location' 'id' 'ti'}}</p>

        </td>
        <td>
            {{#xif " this.i.cat > 0 "}}
            <p class="c-list">
            {{{textFromDropdownLocal i.cat 'menuList' ''}}}
            </p>
            {{/xif}}
        </td>
        <td>
            <div class="row">
                <div class="col-xs-4">
                    <p class="c-list">{{{textFromDropdownLocal i.le 'jobLevelOption' ''}}}</p>
                </div>
                <div class="col-xs-4">
                    <p class="c-list">{{{textFromDropdownLocal i.ty 'jobTimeOption' ''}}}</p>
                </div>
                <div class="col-xs-4">
                    {{i.la}}
                </div>
            </div>
        </td>
    </tr>
</script>
<script id="entryAdminManageHistorySearch" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-init-object="manageHistorySearch"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-elm-data='{"adminList":"1"}'
        data-method="get"
        data-show-page="10"
        data-show-item="15"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="itemHistorySearch" >
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    History search (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form
                    {{#if e.formAction}}
                    action="{{e.formAction}}"
                    {{else}}
                    action="/<?=$seo_name["page"]["admin"]?>?fun=history"
                    {{/if}}
                    method="post"
                    class="post-form form-inline text-right {{e.formActionClass}}">
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

        <div class="table-responsives">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-4">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="5">
                            <form class="form-filter o-hidden" data-waiting="500">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select name="page"
                                                data-compare="equal"
                                                data-key="page"
                                                data-option-base-on-url="page"
                                                class="form-control">
                                                <option value="">Search</option>
                                                <option value="1">Jobs</option>
                                                <option value="2">Applicant</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control"
                                            name="title"
                                            data-compare="in"
                                            data-key="ti"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.jobTitle}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="location"
                                                data-key="loc"
                                                data-compare="in"
                                                data-required="{{d.l10n.require}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                data-dropdown
                                                data-option-local-json="location"
                                                class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="cat"
                                            data-dropdown
                                            data-object-init='{"id":"", "ti":"{{d.l10n.jobCategories}}"}'
                                            data-option-local-json="menuStructure"
                                            data-params="opp=3"
                                            data-compare="in"
                                            data-key="ca"
                                            data-option-base-on-url="cat"
                                            class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <select name="level"
                                                    type="select"
                                                    data-dropdown
                                                    data-option-local-json="jobLevel"
                                                    data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                                    data-compare="in"
                                                    data-key="le"
                                                    data-option-base-on-url="level"
                                                    class="form-control"></select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select name="typelist"
                                                    data-dropdown
                                                    data-option-local-json="jobTime"
                                                    data-object-init='{"id":"", "ti":"{{d.l10n.optType}}"}'
                                                    data-compare="in"
                                                    data-key="ca"
                                                    data-option-base-on-url="ty"
                                                    class="form-control">
                                            </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select name="la"
                                                        data-dropdown
                                                        data-option-local-json="languageOption"
                                                        data-object-init='{"id":"", "ti":"{{d.l10n.optLanguage}}"}'
                                                        data-compare="in"
                                                        data-key="la"
                                                        data-option-base-on-url="la"
                                                        class="form-control">
                                                </select>
                                            </div>
                                        </div>
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
    </div>
</script>

<script id="entryAdminChangePassword" type="text/x-handlebars-template">
    <form method="post" class="form-horizontal post-form">
        <div class="hidden">
            <input type="text"
                    class="form-control"
                    name="mod"
                    value="password">
            <input type="text"
                    class="form-control"
                    name="db.id"
                    value="{{u.adminlog.id}}">
            <input type="text"
                    class="form-control"
                    name="db.user_id"
                    value="{{u.adminlog.user_id}}">
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="cmp-more">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{d.l10n.passwordCurrent}}</label>
                        <div class="col-sm-8">
                            <input type="password"
                                name="password.passwordOld"
                                data-validate data-min-length="6"
                                data-required="{{d.l10n.requirePassword}}"
                                data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{d.l10n.passwordNew}}</label>
                        <div class="col-sm-8">
                            <input type="password"
                                name="password.passwordNew"
                                data-validate
                                data-min-length="6"
                                data-required="{{d.l10n.requirePassword}}"
                                data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                data-compare="#accountPasswordConfirm"
                                data-compare-message="Password don't match"
                                id="accountPasswordNew"
                                class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{d.l10n.passwordConfirm}}</label>
                        <div class="col-sm-8">
                            <input type="password"
                                name="password.passwordConfirm"
                                data-validate
                                data-required="{{d.l10n.requirePassword}}"
                                data-compare="#accountPasswordNew"
                                data-compare-message="Password don't match"
                                id="accountPasswordConfirm"
                                class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit"
                              class="btn btn-primary bg-color1"
                              data-button-magic
                              data-params-form=".post-form"
                              data-format-json="true"
                              data-ajax-url="<?=APIPOSTADMINACTIVE?>"
                              data-show-success=".alert-footer.alert"
                              data-show-errors=".alert-footer.alert-error"
                              data-trigger-click=".user-update-row-password [data-closet-toggle-class]"
                              value="{{d.l10n.btnUpdate}}"> {{d.l10n.btnUpdate}} </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</script>
<script id="entryAdminManageCmpPage" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-init-object="adminManageCmpPage"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="entryCmpPageItem">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.company}} (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form="" action="/<?=$seo_name["page"]["admin"]?>?fun=cmp" method="post" class="post-form form-inline text-right">
                    <!-- <div class="form-group">
                        <select name="ci"
                            class="form-control"
                            data-key="ci"
                            data-compare="equal"
                            data-required="{{d.l10n.require}}"
                            data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                            data-dropdown
                            data-index-value="{{e.ci}}"
                            data-option-local-json="location">
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label>From</label>
                        <input type="text"
                            name="dayFrom"
                            value="{{e.dayFrom}}"
                            data-date-picker=""
                            data-format="YYYY-MM-DD"
                            data-single-date-picker="true"
                            data-show-dropdowns="true"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="text"
                            name="dayTo"
                            value="{{e.dayTo}}"
                            data-date-picker=""
                            data-format="YYYY-MM-DD"
                            data-single-date-picker="true"
                            data-show-dropdowns="true" class="form-control">
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsives">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-1">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-1">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="7">
                            <form class="form-filter" data-waiting="100">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="text"
                                            name="i"
                                            data-compare="equal"
                                            placeholder="#"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text"
                                            name="na"
                                            key="na"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.name}}"
                                            class="form-control">
                                    </div>

                                    <div class="col-xs-2">
                                        <select name="ca"
                                            data-dropdown
                                            data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                            data-option-local-json="menuStructure"
                                            data-params="opp=3"
                                            data-compare="in"
                                            data-key="ca"
                                            data-option-base-on-url="ca"
                                            class="form-control">
                                            <option value="">{{d.l10n.viewAll}}</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text"
                                            name="ep"
                                            data-key="ep"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.phone}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <select name="ci"
                                                    class="form-control"
                                                    data-key="ci"
                                                    data-compare="equal"
                                                    data-required="{{d.l10n.require}}"
                                                    data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                    data-dropdown
                                                    data-option-local-json="location">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group hidden">
                                            <select name="s"
                                                data-dropdown
                                                data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                                data-option-local-json="userStatus"
                                                data-compare="equal"
                                                data-option-base-on-url="s"
                                                class="form-control">
                                                <option value="">{{d.l10n.viewAll}}</option>
                                            </select>
                                        </div>
                                        {{d.l10n.timeCreated}}
                                    </div>
                                    <div class="col-xs-1 text-right">
                                        
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="view-items" data-content="">
                </tbody>
            </table>
        </div>
        <div class="p-10">
            <div data-footer=""></div>
        </div>
    </div>
</script>



<script id="entryViewCmpPageDetail" type="text/x-handlebars-template">
    <div class="row ">
        <div class="col-sm-3 col-lg-2">
            <div class="user-employment-action"
                data-elm-data='{
                    "pid":"{{e.pid}}",
                    "title":"{{i.userinfo.db.name}}",
                    "deactive":"{{i.userinfo.db.deactive}}",
                    "{{e.view}}":"1"
                }'
                data-copy-template
                data-view-template=".user-employment-action"
                data-template-id="entryViewCmpPageFunction"></div>
        </div>
        <div class="col-sm-9 col-lg-10">
            <!-- General info company -->
            {{#xif ' this.e.view== "info" '}}
            <div class="user-employment-profile"
                data-elm-data='{
                    "cmpid":"{{e.pid}}"
                }'
                data-google-map-in-template="google-map-profile"
                data-option-local="employmentDetail"
                data-copy-template
                data-view-template=".user-employment-profile"
                data-template-id="entryViewEmploymentProfile">
            </div>
            {{/xif}}
            {{#xif ' this.e.view== "blog" '}}
            <div class="user-employment-blog"
                data-elm-data='{
                    "formAction":"/<?=$seo_name["page"]["admin"]?>?fun=cmp&view=1",
                    "formActionClass":"hidden",
                    "strUrlList":"<?=APIGETBLOG?>?uid={{i.userinfo.db.id}}"
                }'
                data-copy-template
                data-view-template=".user-employment-blog"
                data-template-id="entryAdminManageBlogUser"></div>
            {{/xif}}
            {{#xif ' this.e.view== "jobs" '}}
                {{#if e.jobDetail}}
                    <div data-ui-tabs
                        data-ignore-hash="true"
                        data-tab-class="ui-tabs"
                        data-mobile-title="tab-title">
                            <div class="product-des">
                                <div class="item-content current">
                                    <h3 class="icon tab-title">{{d.l10n.content}}</h3>
                                    <div class="tab-content">
                                        <div class="user-employment-jobdetail"
                                            data-elm-data='{
                                            }'
                                            data-google-map-in-template="google-map-profile"
                                            data-option-local="jobDetail"
                                            data-copy-template
                                            data-view-template=".user-employment-jobdetail"
                                            data-template-id="entryJobView">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-content current">
                                    <h3 class="icon tab-title">{{d.l10n.applied}}</h3>
                                    <div class="tab-content">
                                        <div class="item-view-more"
                                            data-view-list-by-handlebar
                                            data-init-button-magic=".item [data-button-magic]"
                                            data-init-object="viewAppliedCv"
                                            data-url="/api/get/useraction?uid={{i.userinfo.db.id}}&jid={{e.jobDetail}}&action=userapply"
                                            data-elm-data='{

                                            }'
                                            data-method="get"
                                            data-show-page="10"
                                            data-show-item="20"
                                            data-show-all="false"
                                            data-scroll-view="false"
                                            data-form-filter=".form-filter"
                                            data-is-reload-page="true"
                                            data-reload-base-on-id="ui"
                                            data-reload-base-set-params="listID"
                                            data-reload-url="/api/get/userlistid"
                                            data-template-id="entryCvItemActionApplied">
                                            <form class="form-filter">
                                               <div class="row">
                                                    <div class="col-sm-4">
                                                         <div class="header-nav-in t-s-16 "><label><?=$language["total"]?>:</label> <span class="text-bold text-color3" data-total-item></span> <?=$language["peopleAppliedJob"]?></div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <input class="form-control"
                                                            name="title"
                                                            data-compare="text in"
                                                            data-key="na"
                                                            placeholder="{{d.l10n.placeholderSearchCv}}">
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <select name="loc"
                                                            data-compare="text in"
                                                            data-key="lo"
                                                            class="form-control"
                                                            type="select"
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.locationSearch}}"}'
                                                            data-dropdown
                                                            data-option-local-json="location">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">

                                                        <select name="ex"
                                                            class="form-control"
                                                            data-compare="equal"
                                                            data-key="e"
                                                            type="select"
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.experienceWork}}"}'
                                                            data-dropdown
                                                            data-option-local-json="yearOfExperience">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <select name="la"
                                                            data-compare="text in"
                                                            data-key="la"
                                                            class="form-control"
                                                            type="select"
                                                            data-object-init='{"id":"", "ti":"{{d.l10n.language}}"}'
                                                            data-dropdown
                                                            data-option-local-json="languageOption">
                                                        </select>
                                                    </div>
                                               </div>
                                            </form>
                                            <div data-content class="view-items m-t-10"></div>
                                            <div class="no-data">
                                                <div class="no-data-content">{{d.l10n.noAppliedForThisJob}}</div>
                                            </div>
                                            <div data-footer></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                {{else}}
                    <div class="admin-manage-job"
                        data-elm-data='{
                            "formAction":"/<?=$seo_name["page"]["admin"]?>?fun=cmp&cid={{i.userinfo.db.id}}&view=jobs",
                            "formActionClass":"hidden",
                            "strUrlList":"<?=APIGETJOB?>?cid={{i.userinfo.db.id}}"
                        }'
                        data-copy-template
                        data-view-template=".admin-manage-job"
                        data-template-id="entryManageJobs">
                    </div>
                {{/if}}
            {{/xif}}
        </div>
    </div>
</script>

<script id="entryViewCmpPageFunction" type="text/x-handlebars-template">
    <div class="block">
        <div class="block-title bg-color2 text-uppercase text-bold">
            <span>{{e.title}}</span>
        </div>
        <div class="block-content">
            <ul>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmppage&pid={{e.pid}}" class="{{#if e.info}}active{{/if}}">{{d.l10n.general}}</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmppage&pid={{e.pid}}&view=jobs" class="{{#if e.jobs}}active{{/if}}">Jobs</a>
                </li>
                <li>
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmppage&pid={{e.pid}}&view=blog" class="{{#if e.blog}}active{{/if}}">Blog</a>
                </li>
            </ul>
        </div>
    </div>
</script>

<script id="entryViewCmpPageItem" type="text/x-handlebars-template">
    <div class="item b-r-4">
        <div class="row">
           <div class="col-sm-2">
                <a href="/{{i.us}}">
                    {{#if i.im}}
                    <img alt="{{i.na}}" class="image-load b-r-4" src="/<?=FOLDERIMAGECOMPANY?>{{i.im}}" >
                    {{else}}
                    <img alt="{{i.na}}" class="image-load b-r-4" src="/media/images/style/user.png" >
                    {{/if}}
                </a>
           </div>
           <div class="col-sm-9">
                <div class="content">
                    <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmppage&pid={{i.id}}">
                        <p class="text-bold t-s-21 m-t-5">
                            <span class="text-color1">{{i.na}} </span>
                            <span class="c-list">{{{textFromDropdownLocal i.ca 'menuList' ''}}}</span>
                            <span class="t-s-12"> - {{{textFromDropdownLocal i.ci 'locationOption' ''}}}</span>
                        </p>
                        <p class=""><i class="fa fa-caret-up t-s-1"></i>{{{d.l10n.siteurl}}}{{i.us}}</p>
                        <p class=""><i class="fa fa-map-marker"></i> {{i.ad}}, {{{textFromDropdownLocal i.ci 'locationOption' ''}}}</p>
                        <p class=""><i class="fa fa-calendar"></i> {{{formatDate i.cr '%d-%M-%Y at %H:%m'}}} </p>
                        <p class=""><i class="fa fa-suitcase"></i> {{d.l10n.jobs}}</p>
                     </a>
                </div>
           </div>
        </div>
    </div>
</script>

<script id="entryCmpPageItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>{{i.id}}</td>
        <td>
            <a class="text-color3" href="/<?=$seo_name["page"]["admin"]?>?fun=cmppage&pid={{i.id}}">{{i.na}}</a>
            <p>
                {{#if i.us}}
                <a class="text-color2" href="/{{i.us}}">{{i.us}}</a>
                {{else}}
                <a class="text-color2" href="/<?=$seo_name["page"]["cmp"]?>/{{i.id}}{{urlFriendly i.na}}">View</a>
                {{/if}}
            </p>
            <p>
                <a href="/<?=$seo_name["page"]["admin"]?>?fun=cmp&uid={{i.ui}}"> {{i.n}}</a>
            </p>
        </td>
        <td>
            <p class="c-list">{{{textFromDropdownLocal i.ca 'menuList' ''}}}</p>
            {{#if i.s}}
            <span class="t-s-11 text-color2">{{{textFromDropdownLocal i.s 'userStatus' 'id' 'ti'}}}</span>
            {{/if}}
        </td>
        <td>
            <p>{{i.e}}</p>
            <p><a href="tel:{{i.p}}">{{i.p}}</p>
        </td>
        <td>{{i.ad}} - {{{textFromDropdownLocal i.ci 'location' 'id' 'ti'}}}</td>
        <td>
            <div class="btn-control">
                {{#xif ' this.i.tc < 0 '}}
                    <span class="text-color3 text-bold">{{d.l10n.expired}}</span>
                {{else}}
                    {{{formatDate i.cr '%d-%M-%Y'}}}
                {{/xif}}
            </div>
        </td>
        <td>
            <div class="btn-control">
                <span   class="icon-pencil icon-lg"
                        title="Edit id {{i.id}}"
                        data-button-magic
                        data-method="get"
                        data-ajax-url="<?=APIGETCOMPANY?>/{{i.id}}"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="manageCompanyEdit"></span>   
            </div>

        </td>
    </tr>
</script>

<script id="manageCompanyEdit" type="text/x-handlebars-template">
<div class="modal-dialog modal-menu-edit">
    <div class="modal-content">
        <div class="modal-header">
            <div class="admin-title">
                <h2>{{d.l10n.update}}: {{i.db.name}}</h2>
            </div>

            <span class="icon-cancel-circle icon-lg1 position-right"
                  data-closet-toggle-class="in"
                  data-object=".modal"
                  data-empty-object="[data-quick-view-item]"></span>
        </div>

        <div class="modal-body">
            <div data-ui-tabs
                data-ignore-hash="true"
                data-tab-class="ui-tabs"
                data-mobile-title="tab-title">
                <div class="product-des">
                    <div class="item-content">
                        <h3 class="icon tab-title m-b-10">{{d.l10n.general}}</h3>
                        <div class="tab-content m-t-15">
                            <div class="update-form-general"
                                data-copy-template
                                data-elm-data='{
                                    "db" : {
                                        "id":"{{i.db.id}}",
                                        "ui":"{{i.db.ui}}",
                                        "name":"{{i.db.name}}",
                                        "url":"{{i.db.url}}",
                                        "im":"{{i.db.im}}",
                                        "im_banner":"{{i.db.im_banner}}",
                                        "category":"{{i.db.category}}",
                                        "phone":"{{i.db.phone}}",
                                        "address":"{{i.db.address}}",
                                        "city":"{{i.db.city}}",
                                        "lat":"{{i.db.lat}}",
                                        "lng":"{{i.db.lng}}",
                                        "website":"{{i.db.website}}",
                                        "about":"{{convertString i.more.about}}",
                                        "facebook":"{{i.db.facebook}}",
                                        "facebook_cover":"{{i.pagecmpfacebookcover}}",
                                        "size":"{{i.size}}",
                                        "fbnewfeed":"{{i.db.fb_load_newfeed}}",
                                        "fbphoto":"{{i.db.fb_load_photo}}"
                                    }
                                }'
                                data-view-template=".update-form-general"
                                data-template-id="entryCompanyForm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</script>

<script id="entryCompanyForm" type="text/x-handlebars-template">
<form class="post-form form-horizontal user-manage-feature">
    <div class="hidden">
        <input  name="updateNode"
                value="db"
                data-validate
                data-required="{{d.l10n.require}}"
                class="form-control">
        
        {{#if e.db.id}}
        <input  name="db.id"
                value="{{e.db.id}}"
                class="form-control">
        {{/if}}
        
        <input  name="db.facebookfill"
                value="0"
                class="form-control">

        <input  name="db.ui"
                value="{{e.db.ui}}"
                class="form-control">    

    </div>
    
    <!-- update image -->
    <div class="update-item-image"
        data-copy-template
        data-elm-data='{"urlPost":"/api/post/image/pagecmpfacebookcover",
        "urlPostDel":"/api/post/imagedelete",
        "imgName":"{{e.db.facebook_cover}}",
        "maxSize":"500000",
        "imgPath":"<?=FOLDERIMAGECOMPANYFACEBOOK?>",
        "module":"image",
        "itemId":"{{e.db.id}}"}'
        data-view-template=".update-item-image"
        data-template-id="entryItemImage">
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.companyName}}</label>
        <div class="col-sm-10 ">
            <input  name="db.name"
                value="{{e.db.name}}"
                data-validate
                data-required="{{d.l10n.require}}"
                class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.addressUrl}}</label>
        <div class="col-sm-10 ">
            <input  type="text"
                name="db.url"
                value="{{e.db.url}}"
                data-validate
                data-server="<?=APIPOSTURL?>"
                {{#if e.db.id}}
                data-params='{"hid":"{{e.db.id}}"}'
                {{else}}
                data-params='{"hid":"-1"}'
                {{/if}}
                data-key = "url"
                placeholder="{{d.l10n.addressUrl}}"
                data-required="{{d.l10n.require}}"
                class="form-control">
            <span class="error"></span>
            <span class="t-s-12 text-italic">{{d.l10n.urlSample}}</span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.categoryOption}}</label>
        <div class="col-sm-10 ">
            {{#each dropdown.menuStructure}}
                {{#xif ' this.opp == 3 '}}
                <div class="col-sm-4 {{checkboxValue ../../e.db.category this.id}}">
                    <input class="b-r-4"
                           name="db.category.{{this.id}}"
                           type="checkbox"
                           data-key-name="db.category"
                           {{checkboxValue ../../e.db.category this.id}}
                           value="{{this.id}}">
                    <span>{{this.ti}} - {{this.id}}</span>
                </div>
                {{/xif}}
            {{/each}}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.phone}}</label>
        <div class="col-sm-10 ">
            <input  name="db.phone"
                value="{{e.db.sort}}"
                class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.address}}</label>
        <div class="col-sm-8 ">
            <input  name="db.address"
                    value="{{e.db.address}}"
                    class="form-control">
        </div>
        <div class="col-sm-2 ">
            <select name="db.city"
                class="form-control m-b-10"
                type="select-from-json"
                data-dropdown-relative="db.city"
                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                data-dropdown
                data-params="district="
                data-index-value="{{e.db.city}}"
                data-option-local-json="location"
                data-option-from-json="<?=APIGETLOCATION;?>">
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.website}}</label>
        <div class="col-sm-10 ">
            <input name="db.website"
                value="{{e.db.website}}"
                placeholder="{{d.l10n.website}}"
                class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.facebook}}</label>
        <div class="col-sm-10 ">
            <input name="db.facebook"
                value="{{e.db.facebook}}"
                placeholder="{{d.l10n.facebook}}"
                class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <div class="row">
            <div class="col-sm-1">
                <label class="checkbox">
                    <input name="db.fb_load_newfeed"
                       type="checkbox"
                       {{#if e.db.fbnewfeed}}
                       {{#xif ' this.e.db.fbnewfeed==1 '}}
                       checked="checked"
                       {{/xif}}
                       {{/if}}
                       value="1">
                    <span class="checkbox-style"></span>

                </label>
            </div>
            <div class="col-sm-11">
                 <span class="info">{{d.l10n.loadFacebookNewfeed}}</span>
            </div></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <div class="row">
            <div class="col-sm-1">
                <label class="checkbox">
                    <input name="db.fb_load_photo"
                       type="checkbox"
                       {{#if e.db.fbphoto}}
                       {{#xif " this.e.db.fbphoto==1 "}}
                       checked="checked"
                       {{/xif}}
                       {{/if}}
                       value="1">
                    <span class="checkbox-style"></span>

                </label>
            </div>
            <div class="col-sm-11">
               <span class="info">{{d.l10n.loadFacebookPhoto}}</span>
</div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.about}}</label>
        <div class="col-sm-10 ">
            <textarea   name="more.about"
                        class="form-control mce-editor">
                {{{reconvertString e.db.about}}}
            </textarea>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input type="submit"
                data-button-magic
                data-params-form=".post-form"
                data-format-json="true"
                data-ajax-url="<?=APIPOSTCOMPANY?>"
                data-show-success=".alert-footer.alert"
                data-show-errors=".alert-footer.alert-error"
                class="btn btn-primary"
                {{#if e.db.id}}
                value="{{d.l10n.btnUpdate}}"
                {{else}}
                data-redirect="."
                value="{{d.l10n.btnAdd}}"
                {{/if}}>
        </div>
    </div>
</form>  
</script>

<script id="entryAdminManageBlogUser" type="text/x-handlebars-template">
    <div class="item-view-more side-bar"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-option-local="userBlog"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="viewItemBlog">
        <div class="view-items" data-content></div>
    </div>
</script>
<script id="viewItemBlog" type="text/x-handlebars-template">
    <div class="item item-blog item-status-{{i.st}}">
        <div class="row">
            <div class="col-xs-1">
                <p>{{i.id}}</p>
            </div>
            <div class="col-xs-6">
                <span>{{i.nf}}</span>
            </div>
        </div>
    </div>
</script>

<script id="entryAdminManagePagehtml" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{else}}
        data-url="/api/get/pagehtml"
        {{/if}}
        data-init-object="adminManageUser"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="managePagehtmlItem">
        <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
            Manage Page HTML (<span data-total-item></span>)
        </header>

        <div class="table-responsives">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                    <col class="col-sm-2">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter o-hidden" data-waiting="500">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input class="form-control"
                                            data-compare="equal"
                                            name="id"
                                            data-key="id"
                                            placeholder="{{d.l10n.title}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control"
                                            name="title"
                                            data-compare="in"
                                            data-key="ti"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.searchJob}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="level"
                                            type="select"
                                            data-validate
                                            data-required="{{d.l10n.requireTitle}}"
                                            data-dropdown
                                            data-option-local-json="jobLevel"
                                            data-object-init='{"id":"", "ti":"{{d.l10n.viewAll}}"}'
                                            data-compare="in"
                                            data-key="le"
                                            data-option-base-on-url="level"
                                            class="form-control hidden"></select>
                                        {{d.l10n.sort}}
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="location"
                                                class="form-control"
                                                data-key="lo"
                                                data-compare="in"
                                                data-required="{{d.l10n.require}}"
                                                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                                                data-dropdown
                                                data-option-local-json="location">
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="cat"
                                            data-dropdown
                                            data-object-init='{"id":"", "ti":"{{d.l10n.jobCategories}}"}'
                                            data-option-local-json="menuStructure"
                                            data-params="opp=3"
                                            data-compare="in"
                                            data-key="ca"
                                            data-option-base-on-url="cat"
                                            class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        {{d.l10n.jobSalaryMin}}
                                    </div>

                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="view-items" data-content>
                </tbody>
            </table>
            <div class="row">
            <div class="col-xs-10">
                <div data-footer></div>
            </div>
            <div class="col-xs-2 text-right">
                <button class="btn btn-warning form-add btn-add-a-item"
                data-button-magic
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryPagehtmlAdd">{{d.l10n.btnAdd}} + </button>
            </div>
        </div>
        </div>
    </div>
</script>

<script id="entryPagehtmlForm" type="text/x-handlebars-template">
<form class="post-form form-horizontal user-manage-feature">
    <div class="hidden">
        <input  name="updateNode"
            value="db"
            data-validate
            data-required="{{d.l10n.require}}"
            class="form-control">
        {{#if e.db.id}}
        <input  name="db.id"
            value="{{e.db.id}}"
            class="form-control">
        {{/if}}
    </div>
    
    <!-- update image -->
   
    <div class="update-item-image"
        data-copy-template
        data-elm-data='{"urlPost":"/api/post/image/pagehtml",
        "urlPostDel":"/api/post/imagedelete",
        "imgName":"{{e.db.image}}",
        "maxSize":"500000",
        "imgPath":"<?=FOLDERUPLOAD?>",
        "module":"image",
        "itemId":"{{e.db.id}}"}'
        data-view-template=".update-item-image"
        data-template-id="entryItemImage">
    </div>
     

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.title}} VI</label>
        <div class="col-sm-10 ">
            <input  name="db.ti_vi"
                value="{{e.db.ti_vi}}"
                data-validate
                data-required="{{d.l10n.require}}"
                class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.title}} EN</label>
        <div class="col-sm-10 ">
            <input  name="db.ti_en"
                value="{{e.db.ti_en}}"
                data-validate
                data-required="{{d.l10n.require}}"
                class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.addressUrl}}</label>
        <div class="col-sm-10 ">
            <input  type="text"
                name="db.url"
                value="{{e.db.url}}"
                data-validate
                data-server="<?=APIPOSTURL?>"
                {{#if e.db.id}}
                data-params='{"hid":"{{e.db.id}}"}'
                {{else}}
                data-params='{"hid":"-1"}'
                {{/if}}
                data-key = "url"
                placeholder="{{d.l10n.addressUrl}}"
                data-required="{{d.l10n.require}}"
                class="form-control">
            <span class="error"></span>
            <span class="t-s-12 text-italic">{{d.l10n.urlSample}}</span>
        </div>
    </div>

     <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.sort}}</label>
        <div class="col-sm-10 ">
            <input  name="db.sort"
                value="{{e.db.sort}}"
                class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.status}}
        </label>
        <div class="col-sm-10">
          <span class="select-wrapper">
           <select  type="select"
                name="db.status"
                data-dropdown
                placeholder="2"
                data-index-value="{{#if e.db.status}}{{e.db.status}}{{else}}2{{/if}}"
                data-option-local-json="pageHtml"
                data-object-init='{"id":"", "ti":""}'
                class="form-control">
            </select>
          </span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">ID</label>
        <div class="col-sm-10 ">
            <input  name="db.jobid"
                    value="{{e.db.jobid}}"
                    class="form-control">
        </div>
    </div>

    <hr/>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.searchJob}}</label>
        <div class="col-sm-10 ">
            <input name="db.subject"
                value="{{e.db.subject}}"
                placeholder="{{d.l10n.placeholderSearchJob}}"
                class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.jobSalaryMin}}</label>
        <div class="col-sm-10 ">
            <input name="db.sa"
                value="{{e.db.sa}}"
                onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); }"
                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.optCity}}</label>
        <div class="col-sm-10 ">
            <select name="db.lo"
                class="form-control m-b-10"
                type="select-from-json"
                data-dropdown-relative="db.di"
                data-object-init='{"id":"", "ti":"{{d.l10n.optCity}}"}'
                data-dropdown
                data-params="district="
                data-index-value="{{e.db.lo}}"
                data-option-local-json="location"
                data-option-from-json="<?=APIGETLOCATION;?>">
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.optDistrict}}</label>
        <div class="col-sm-10 ">
            <select name="db.di"
                class="form-control m-b-10"
                type="select-from-json"
                data-dropdown
                data-option-from-json="<?=APIGETDISTRICT?>"
                data-params="district={{e.db.lo}}"
                data-object-init='{"id":"", "ti":"{{d.l10n.optDistrict}}"}'
                data-index-value="{{e.db.di}}">
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.optNationality}}</label>
        <div class="col-sm-10 ">
            <select name="db.nat"
                class="form-control"
                data-dropdown
                data-option-local-json="countryShort"
                data-index-value="{{e.db.nat}}"
                data-object-init='{"id":"", "ti":"{{d.l10n.optNationality}}"}'
                data-target-append=".multiselect-category">
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.categoryOption}}</label>
        <div class="col-sm-10 ">
            <select name="db.ca"
                class="form-control m-b-10"
                data-dropdown
                data-option-from-json="<?=APIGETMENU;?>"
                data-option-local-json="menuStructure"
                data-params="opp=3"
                data-index-value="{{e.db.ca}}"
                data-object-init='{"id":"", "ti":"{{d.l10n.categoryOption}}"}'
                data-target-append=".multiselect-category">
            </select>
        </div>
    </div>
    <hr/>
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.jobType}}
        </label>
        <div class="col-sm-10">
            <span class="select-wrapper">
                <select name="typelist"
                   class="form-control"
                   data-multiselect-box
                   data-multiselect-box-max="5"
                   data-multi-selected="{{e.db.ty}}"
                   data-key-name="db.ty"
                   data-required="{{d.l10n.require}}"
                   data-dropdown
                   data-option-local-json="jobTime"
                   data-object-init='{"id":"", "ti":"{{d.l10n.optType}}"}'
                   data-target-append=".multiselect-time">
                   <option value="">{{d.l10n.optType}}</option>
                </select>
            </span>
           <span class="error">{{d.l10n.require}}</span>
           <div data-show-options-list class="multiselect-time"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.jobLevel}}
        </label>
        <div class="col-sm-10">
            <span class="select-wrapper">
                <select name="levellist"
                    class="form-control"
                    data-multiselect-box
                    data-multiselect-box-max="5"
                    data-multi-selected="{{e.db.le}}"
                    data-key-name="db.le"
                    data-required="{{d.l10n.require}}"
                    data-dropdown
                    data-option-local-json="jobLevel"
                    data-object-init='{"id":"", "ti":"{{d.l10n.optLevel}}"}'
                    data-target-append=".multiselect-level">
                    <option value="">{{d.l10n.optLevel}}</option>
                </select>
            </span>
            <span class="error">{{d.l10n.require}}</span>
            <div data-show-options-list class="multiselect-level"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.yearOfExperience}}
        </label>
        <div class="col-sm-10">
            <span class="select-wrapper">
                <select name="explist"
                       class="form-control"
                       data-multiselect-box
                       data-multiselect-box-max="5"
                       data-multi-selected="{{e.db.ex}}"
                       data-key-name="db.ex"
                       data-required="{{d.l10n.require}}"
                       data-dropdown
                       data-option-local-json="yearOfExperience"
                       data-object-init='{"id":"", "ti":"{{d.l10n.optExperience}}"}'
                       data-target-append=".multiselect-exp">
                       <option value="">{{d.l10n.optExperience}}</option>
                </select>
            </span>
           <span class="error">{{d.l10n.require}}</span>
           <div data-show-options-list class="multiselect-exp"></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.language}}
        </label>
        <div class="col-sm-10">
           <span class="select-wrapper">
            <select name="langlist"
                    class="form-control"
                    data-multiselect-box
                    data-multiselect-box-max="3"
                    data-multi-selected="{{e.db.la}}"
                    data-key-name="db.la"
                    data-required="{{d.l10n.require}}"
                    data-dropdown
                    data-option-local-json="languageOption"
                    data-object-init='{"id":"", "ti":"{{d.l10n.optLanguage}}"}'
                    data-target-append=".multiselect-lang">
                    <option value="">{{d.l10n.optLanguage}}</option>
            </select>
          </span>
           <span class="error">{{d.l10n.require}}</span>
            <div data-show-options-list class="multiselect-lang"></div>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input type="submit"
                data-button-magic
                data-params-form=".post-form"
                data-format-json="true"
                data-ajax-url="<?=APIPOSTPAGEHTML?>"
                data-show-success=".alert-footer.alert"
                data-show-errors=".alert-footer.alert-error"
                class="btn btn-primary"
                {{#if e.db.id}}
                value="{{d.l10n.btnUpdate}}"
                {{else}}
                data-redirect="."
                value="{{d.l10n.btnAdd}}"
                {{/if}}>
        </div>
    </div>
</form>
</script>

<script id="managePagehtmlItem" type="text/x-handlebars-template">
    <tr class="b-b">
        <td>
            <p>{{i.ti}}</p>
        </td>
        <td>
            <p>{{i.subject}}</p>
        </td>
        <td>
            <p class="c-list hidden">{{{textFromDropdownLocal i.le 'jobLevelOption' ''}}}</p>
            {{i.sort}}
        </td>
        <td>
            <p class="c-list">{{{textFromDropdownLocal i.lo 'locationOption' ''}}}</p>
        </td>
        <td>
            <p class="c-list">{{{textFromDropdownLocal i.ca 'menuList' ''}}}</p>
        </td>
        <td>
            <div class="row">
                <div class="col-xs-8">
                    <p>{{i.sa}}</p>
                </div>
                <div class="col-xs-4 text-right">
                    <span
                        class="icon-pencil icon-lg"
                        title="Edit id {{i.id}}"
                        data-button-magic
                        data-method="get"
                        data-ajax-url="<?=APIGETPAGEHTML?>/{{i.id}}"
                        data-view-template="[data-quick-view-item]"
                        data-template-id="managePagehtmlEdit"></span>
                    <span
                        class="icon-bin icon-lg"
                        title="Delete"
                        data-button-magic
                        data-confirm="true"
                        data-method="post"
                        data-format-json="true"
                        data-params='{ "id":"{{i.id}}", "uid":"{{u.userinfo.db.id}}", "updateNode":"del"}'
                        data-ajax-url="<?=APIPOSTPAGEHTML?>"
                        data-refress-list=".item-view-more"> </span>
                </div>
            </div>
        </td>
    </tr>
</script>
<script id="entryPagehtmlAdd" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>PageHTML::{{d.l10n.btnAdd}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <div class="update-modal-form"
                    data-copy-template
                    data-view-template=".update-modal-form"
                    data-template-id="entryPagehtmlForm">
                </div>
            </div>
        </div>
    </div>
</script>

<script id="managePagehtmlEdit" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.update}}: {{i.db.ti_vi}} / {{i.db.ti_en}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
                <div data-ui-tabs
                    data-ignore-hash="true"
                    data-tab-class="ui-tabs"
                    data-mobile-title="tab-title">
                    <div class="product-des">
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.general}}</h3>
                            <div class="tab-content">
                                <div class="update-form-general"
                                    data-copy-template
                                    data-elm-data='{
                                        "db" : {
                                            "id":"{{i.db.id}}",
                                            "ti_vi":"{{i.db.ti_vi}}",
                                            "ti_en":"{{i.db.ti_en}}",
                                            "title":"{{i.db.title}}",
                                            "url":"{{i.db.url}}",
                                            "subject":"{{i.db.subject}}",
                                            "ca":"{{i.db.ca}}",
                                            "lo":"{{i.db.lo}}",
                                            "di":"{{i.db.di}}",
                                            "nat":"{{i.db.nat}}",
                                            "le":"{{i.db.le}}",
                                            "ex":"{{i.db.ex}}",
                                            "la":"{{i.db.la}}",
                                            "sa":"{{i.db.sa}}",
                                            "ty":"{{i.db.ty}}",
                                            "status":"{{i.db.status}}",
                                            "sort":"{{i.db.sort}}",
                                            "image":"{{i.pagehtml}}",
                                            "jobid":"{{i.db.jobid}}"
                                        }
                                    }'
                                    data-view-template=".update-form-general"
                                    data-template-id="entryPagehtmlForm">
                                </div>
                            </div>
                        </div>

                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.content}}</h3>
                            <div class="tab-content">
                                <form class="form-horizontal post-form">
                                    <?=$templatesView["hiddenInputMore"]?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.description}} VI
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description.vi"
                                                    class="form-control mce-editor">{{i.more.description.vi}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.description}} EN
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description.en"
                                                    class="form-control mce-editor">{{i.more.description.en}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTPAGEHTML?>"
                                                data-show-success=".alert-footer.alert"
                                                data-show-errors=".alert-footer.alert-error"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.seo}}</h3>
                            <div class="tab-content">
                                <div class="update-seo-item"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"<?=APIPOSTPAGEHTML?>",
                                    "title":{
                                        "vi":"{{i.meta.title.vi}}",
                                        "en":"{{i.meta.title.en}}"
                                    },
                                    "keyword":{
                                        "vi":"{{i.meta.keyword.vi}}",
                                        "en":"{{i.meta.keyword.en}}"
                                    },
                                    "desc":{
                                        "vi":"{{i.meta.desc.vi}}",
                                        "en":"{{i.meta.desc.en}}"
                                    },
                                    "ui":"{{u.userinfo.db.id}}",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-seo-item"
                                    data-template-id="entrySeoItem">
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<script id="entryAdminManageEmailEdm" type="text/x-handlebars-template">
<div class="item-view-more admin-list"
    data-view-list-by-handlebar
    data-init-button-magic="[data-button-magic]"
    {{#if e.strUrlList}}
    data-url="{{e.strUrlList}}"
    {{else}}
    data-url="/api/get/emailedm"
    {{/if}}
    data-init-object="adminManageUser"
    data-method="get"
    data-show-page="10"
    data-show-item="50"
    data-show-all="false"
    data-scroll-view="false"
    data-form-filter=".form-filter"
    data-template-id="managePageEmailEdm">
    <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
        Manage Email EDM (<span data-total-item></span>)
    </header>

    <div class="table-responsives">
        <table class="table table-bordered">
            <colgroup>
                <col class="col-sm-3">
                <col class="col-sm-3">
                <col class="col-sm-3">
                <col class="col-sm-1">
                <col class="col-sm-2">
            </colgroup>
            <thead>
                <tr class="b-b">
                    <th colspan="6">
                        <form class="form-filter o-hidden" data-waiting="500">
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text"
                                            name="name"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.name}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text"
                                            name="email"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.email}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text"
                                            name="company"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.company}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-1">
                                     {{d.l10n.date}}
                                </div>
                                <div class="col-sm-2">
                                    Click / {{d.l10n.date}}
                                </div>
                               

                            </div>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody class="view-items" data-content>
            </tbody>
        </table>
        <div class="row">
        <div class="col-xs-10">
            <div data-footer></div>
        </div>
        <div class="col-xs-2 text-right">
            <button class="btn btn-warning form-add btn-add-a-item"
            data-button-magic
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
            data-template-id="entrySendEdmAdd">Send Email</button>
        </div>
    </div>
    </div>
</div>
</script>   
<script id="managePageEmailEdm" type="text/x-handlebars-template">
<tr class="b-b">
    <td>{{i.name}}<span class="text-color2 t-s-11"><br>{{i.note}}</span></td>
    <td>{{i.email}}</td>
    <td>{{i.company}}</td>
    <td>{{{formatDate i.cr '%d-%M-%Y'}}}</td>
    <td><strong class="text-color3">{{i.action_click}}</strong> / 
    {{#xif ' this.i.action_click_date == 0 '}}
        ------
    {{else}}
    {{{formatDate i.action_click_date '%d-%M-%Y'}}}
    {{/xif}}   
    </td>
    <td>
        <span class="icon-pencil icon-lg" 
            data-button-magic
            data-template-id="entrySendEdmAdd" 
            data-view-template="[data-quick-view-item1]" 
            data-ajax-url="/api/get/emailedm/{{i.id}}" 
            data-method="get" title="Edit id {{i.id}}"></span>
    </td>
</tr>   
</script>  

<script id="entrySendEdmAdd" type="text/x-handlebars-template">
<div class="modal-dialog modal-menu-edit">
    <div class="modal-content">
        <div class="modal-header">
            <div class="admin-title">
                <h2>Send Email EDM</h2>
            </div>
            <span class="icon-cancel-circle icon-lg1 position-right"
                  data-closet-toggle-class="in"
                  data-object=".modal"
                  data-empty-object="[data-quick-view-item]"></span>
        </div>
        <div class="modal-body">
            <div class="update-news-form"
                data-copy-template
                data-elm-data='{ "db":{
                        "id":"{{i.id}}",
                        "name":"{{i.name}}",
                        "email":"{{i.email}}",
                        "company":"{{i.company}}"
                    }}'
                data-view-template=".update-news-form"
                data-template-id="entrySendEmailEdmForm">
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-10">
                    <div class="alert text-left" data-fade="2000">
                        <div class="sms-content"></div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <span class="btn btn-default"
                    data-closet-toggle-class="in"
                    data-object=".modal"
                    data-empty-object="[data-quick-view-item]">Close</span>

               </div>
            </div>
        </div>
    </div>
</div>  
</script>
<script id="entrySendEmailEdmForm" type="text/x-handlebars-template">
    <form method="post"
        class="form-horizontal post-form">
        <div class="hidden">
            <input type="text"
                class="form-control"
                name="updateNode"
                value="db">
            {{#if e.db.id}}
            <input type="text"
                class="form-control"
                name="db.id"
                value="{{e.db.id}}">
            {{/if}}
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.name}} 
            </label>
            <div class="col-sm-10">
                <input  type="text"
                    name="db.name"
                    {{#if e.db.name}}
                    value="{{e.db.name}}"
                    {{/if}}
                    data-validate
                    data-required="{{d.l10n.require}}"
                    class="form-control">
                <span class="error">{{d.l10n.require}}</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.email}}
            </label>
            <div class="col-sm-10">
               <input   name="db.email"
                        class="form-control"
                        {{#if e.db.email}}
                        value="{{e.db.email}}"
                        {{/if}}
                        data-validate
                        data-required="{{d.l10n.requireEmail}}"
                        data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                        data-pattern-message="{{d.l10n.requireEmailRule}}"
                        value="{{i.config.email.contactSender}}" />
                <span class="error">{{d.l10n.require}}</span>

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.companyName}}
            </label>
            <div class="col-sm-10">
                <input  type="text"
                        name="db.company"
                        data-validate
                        data-required="{{d.l10n.require}}"
                        {{#if e.db.company}}
                        value="{{e.db.company}}"
                        {{/if}}
                        class="form-control">
                <span class="error">{{d.l10n.require}}</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                Note
            </label>
            <div class="col-sm-10">
                <input  type="text"
                        name="db.note"
                        data-required="{{d.l10n.require}}"
                        {{#if e.db.note}}
                        value="{{e.db.note}}"
                        {{/if}}
                        class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                {{#if e.db.id}}
                
                <input type="submit"
                    data-button-magic
                    data-params-form=".post-form"
                    data-format-json="true"
                    data-ajax-url="<?=APIPOSTSENDEMAILEDM?>"
                    data-show-success=".modal-footer .alert"
                    data-show-errors=".modal.signin-missing-session"
                    data-redirect="."
                    class="btn btn-primary"
                    value="{{d.l10n.btnUpdate}}">

                <input type="submit"
                    data-button-magic
                    data-params-form=".post-form"
                    data-format-json="true"
                    data-ajax-url="<?=APIPOSTSENDEMAILEDM?>?resend"
                    data-show-success=".modal-footer .alert"
                    data-show-errors=".modal.signin-missing-session"
                    data-redirect="."
                    name="db.resend"
                    class="btn bg-color2 text-uppercase"
                    value="resend">    

                {{else}}
                    <input type="submit"
                    data-button-magic
                    data-params-form=".post-form"
                    data-format-json="true"
                    data-ajax-url="<?=APIPOSTSENDEMAILEDM?>"
                    data-show-success=".modal-footer .alert"
                    data-show-errors=".modal.signin-missing-session"
                    data-redirect="."
                    class="btn btn-primary"
                    value="{{d.l10n.send}}">
                {{/if}}
                
            </div>
        </div>
    </form>
</script>     
<script id="AdminDaskboardJob" type="text/x-handlebars-template">
    <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
        Jobs
    </header>
    <div class="table-responsive">
        <table class="table table-bordered">
            <colgroup class="row">
                <col class="col-sm-2">
                <col class="col-sm-4">
                <col class="col-sm-4">
            </colgroup>
            <tr>
                <th>{{d.l10n.id}}</th>
                <th>
                    <p>{{d.l10n.title}}</p>
                </th>
                <th>{{d.l10n.company}}</th>
            </tr>
        {{#each i}}
            <tr>
                <td>{{this.id}}</td>
                <td>
                    <strong class="short-text">{{this.ti}}</strong>
                    <p class="c-list short-text">
                    {{{textFromDropdownLocal this.ca 'menuList' ''}}}
                    </p>
                </td>
                <td class="short-text">
                    <span>{{this.na}}</span>
                    <p class="short-text">{{../d.l10n.city}}: {{{textFromDropdownLocal this.lo 'locationOption' ''}}}</p>
                </td>
               
            </tr>
        {{/each}}
        </table>
    </div>
</script>
<script id="AdminDaskboardEmployment" type="text/x-handlebars-template">
    <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
        Employment
    </header>
    <div class="table-responsive">
        <table class="table table-bordered">
            <colgroup class="row">
                <col class="col-sm-1">
                <col class="col-sm-3">
                <col class="col-sm-2">
                <col class="col-sm-3">
                <col class="col-sm-3">
            </colgroup>
            <tr>
                <th>{{d.l10n.id}}</th>
                <th>{{d.l10n.name}}</th>
                <th>{{d.l10n.address}}</th>
                <th>{{d.l10n.status}}</th>
                <th>{{d.l10n.expired}}</th>
            </tr>
        {{#each i}}
            <tr>
                <td>{{this.id}}</td>
                <td>
                    <p class="short-text">{{this.na}}</p>
                    <p class="short-text">{{this.ep}}</p>
                </td>
                <td class="short-text">
                    <p class="short-text">{{this.ad}}</p>
                    <p class="short-text">{{../d.l10n.city}}: {{{textFromDropdownLocal this.ci 'locationOption' ''}}}</p>
                </td>
                <td>
                    <span>{{{textFromDropdownLocal this.s 'userStatus' 'id' 'ti'}}}</span>
                </td>
                <td>
                    <p>{{#xif ' ../this.tc < 0 '}}
                        <span class="text-color3 text-bold">{{../d.l10n.expired}}</span>
                    {{else}}
                        {{{formatDate this.dl '%d-%M-%Y'}}}
                    {{/xif}}
                    </p>

                    <p class="t-s-11 text-color2">{{formatDayLeft this.dl}}</p>
                </td>
            </tr>
        {{/each}}
        </table>
    </div>
</script>
<script id="AdminDaskboardUser" type="text/x-handlebars-template">
    <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
        Applicant
    </header>
    <div class="table-responsive">
        <table class="table table-bordered">
            <colgroup class="row">
                <col class="col-sm-2">
                <col class="col-sm-4">
                <col class="col-sm-4">
                <col class="col-sm-2">
            </colgroup>
            <tr>
                <th>{{d.l10n.id}}</th>
                <th>{{d.l10n.email}}</th>
                <th>{{d.l10n.fullname}}</th>
                <th>{{d.l10n.timeCreated}}</th>
            </tr>
        {{#each i}}
            <tr>
                <td>{{this.i}}</td>
                <td><span title="{{this.e}}">{{shortenText this.e 20}}</span></td>
                <td>
                    <p>{{this.n}}</p>
                </td>
                <td>
                    <p>{{this.c}}</p>
                </td>
            </tr>
        {{/each}}
        </table>
    </div>
</script>

<script id="AdminDaskboardContact" type="text/x-handlebars-template">
    <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
        Contact
    </header>
    <div class="table-responsive">
        <table class="table table-bordered">
            <colgroup class="row">
                <col class="col-sm-1">
                <col class="col-sm-2">
                <col class="col-sm-2">
                <col class="col-sm-6">
            </colgroup>
            <tr>
                <th class="short-text">{{d.l10n.name}}</th>
                <th>{{d.l10n.email}}</th>
                <th>{{d.l10n.phone}}</th>
                <th>{{d.l10n.message}}</th>
            </tr>
        {{#each i}}
            <tr>
                <td class="short-text">{{this.na}}</td>
                <td class="short-text"><span title="{{this.em}}">{{shortenText this.em 20}}</span></td>
                <td>{{this.nu}}</td>
                <td class="short-text">{{this.me}}</td>
            </tr>
        {{/each}}
        </table>
    </div>
</script>

<script id="entrySignupWithPromoCodeAdmin" type="text/x-handlebars-template">
<div class="modal-dialog modal-signup">
  <div class="modal-content">
    <div class="modal-body p-20 modal-signin">
      <span class="position-right"
        data-closet-toggle-class="in"
        data-object=".modal"
      data-empty-object="[data-quick-view-item]"><i class="fa fa-times-circle"></i></span>
      <div class="block text-center">
        <div class="block-title cmp-more text-uppercase text-bold no-m-bottom hidden">
          <p class="t-s-18 text-color3">{{d.l10n.enterActivationCode}}</p>
        </div>
        <div class="block-content no-border">
          <form class="post-form">
            <div class="hidden">
              <input type="hidden" name="signupWithPromocode" value="1">
            </div>
            
            <div class="form-group">
              <label class="col-sm-12 control-label">
                Company Id
              </label>
              <div class="col-sm-12">
                <input type="text" name="db.ui"
                data-validate
                data-required="{{d.l10n.required}}"
                class="form-control text-center">
                <span class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-12 control-label">
                {{d.l10n.ActivationCodeContent}}
              </label>
              <div class="col-sm-12">
                <input type="text" name="db.pr"
                data-validate
                data-required="{{d.l10n.requiredPromoCode}}"
                class="form-control text-center">
                <span class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit"
                data-button-magic
                data-params-form=".post-form"
                data-format-json="true"
                data-ajax-url="<?=APIPOSTPROMOAPPLIED?>"
                data-show-success=".alert-footer.alert"
                data-show-errors=".alert-footer.alert-error"
                data-redirect="."
                class="btn bg-color3 m-t-10 form-control text-bold text-uppercase"
                value="{{d.l10n.btnSubmitCode}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnSubmit}}</span></button>
              </div>
            </div>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</script>
<script id="entryManageJobsApply" type="text/x-handlebars-template">
    <div class="item-view-more"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-init-object="manageJobs"
        {{#if e.strUrlList}}
        data-url="{{e.strUrlList}}"
        {{/if}}
        data-elm-data='{"adminList":"1", "linkDetail":"/<?=$seo_name["page"]["admin"]?>?fun=checkout"}'
        data-method="get"
        data-show-page="10"
        data-show-item="40"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-template-id="entryRowJobApply">

        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
                    {{d.l10n.jobManage}} (<span data-total-item></span>)
                </header>
            </div>
            <div class="col-xs-12 col-sm-8">
                <form data-change-to-submit-form
                    {{#if e.formAction}}
                    action="{{e.formAction}}"
                    {{else}}
                    action="/<?=$seo_name["page"]["admin"]?>?fun=jobs"
                    {{/if}}
                    method="post"
                    class="post-form form-inline text-right {{e.formActionClass}}">
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
        <div class="table-responsives m-t-10">
            <table class="table table-bordered">
                <colgroup>
                    <col class="col-sm-1">
                    <col class="col-sm-3">
                    <col class="col-sm-3">
                    <col class="col-sm-3">
                    <col class="col-sm-2">
                </colgroup>
                <thead>
                    <tr class="b-b">
                        <th colspan="6">
                            <form class="form-filter o-hidden" data-waiting="500">
                                <div class="row">
                                    <div class="col-sm-1">
                                       
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control"
                                            name="name"
                                            data-compare="text in"
                                            data-key="name"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.name}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control"
                                            name="company_name"
                                            data-compare="text in"
                                            data-key="company_name"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.companyName}}">
                                    </div>
                                    <div class="col-sm-3">
                                         <input class="form-control"
                                            name="t"
                                            data-compare="text in"
                                            data-key="t"
                                            data-option-base-on-url="title"
                                            placeholder="{{d.l10n.jobTitle}}">
                                    </div>
                                    <div class="col-sm-2">
                                        {{d.l10n.date}}
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
    </div>
</script>

<script id="entryRowJobApply" type="text/x-handlebars-template">
    <tr class="b-b">
        <td align="right">
            <div    class="img-xs-thumbnail img-with-css b-cover transition c-center b-r-4" 
                    style="background:url({{#if i.im}}<?=FOLDERIMAGEUSER?>thumbnail/{{i.im}}{{else}}'media/images/style/user-profile.png'{{/if}}) no-repeat"></div>
        </td>
        <td>
            <p>
                <span class="text-bold">{{i.name}}</span><br>
                <span class="t-s-12 text-color2">{{i.email}}</span><br>
                <span class="t-s-12">{{i.phone}}</span>
            </p>
           
        </td>
        <td>
            <span class="text-bold text-color3">{{i.company_name}}</span>
        </td>
        <td>
            <p class="short-text text-color1">
                {{i.t}}
            </p>
        </td>
        
        <td>
            {{{formatDate i.cr '%d-%M-%Y'}}}<br>
            <span class="t-s-12 text-color2">{{formatLatestDay i.cr}}</span>
        </td>
    </tr>
</script>



<script id="entryJobEdit" type="text/x-handlebars-template">
<div class="modal-dialog modal-menu-edit">
    <div class="modal-content">
        <div class="modal-header">
            <div class="admin-title">
                <h2>{{d.l10n.update}}: {{i.db.name}}</h2>
            </div>

            <span class="icon-cancel-circle icon-lg1 position-right"
                  data-closet-toggle-class="in"
                  data-object=".modal"
                  data-empty-object="[data-quick-view-item]"></span>
        </div>

        <div class="modal-body">
            <div data-ui-tabs
                data-ignore-hash="true"
                data-tab-class="ui-tabs"
                data-mobile-title="tab-title">
                <div class="product-des">
                    <div class="item-content">
                        <h3 class="icon tab-title m-b-10">{{d.l10n.general}}</h3>
                        <div class="tab-content m-t-15">
                            <div class="update-form-general">
                                {{#if i.db.id}}
                                <form class="post-form form-horizontal user-manage-feature">
                                    <div class="hidden">
                                        <input  name="updateNode"
                                                value="db"
                                                data-validate
                                                data-required="{{d.l10n.require}}"
                                                class="form-control">
                                        
                                        
                                        <input  name="db.id"
                                                value="{{i.db.id}}"
                                                class="form-control">

                                        <input  name="db.ui"
                                                value="{{i.db.ui}}"
                                                class="form-control"> 

                                        <input  name="db.ci"
                                                value="{{i.db.ci}}"
                                                class="form-control"> 

                                        <input  name="db.ca" value="{{i.db.ca}}" class="form-control"> 
                                        <input  name="db.lo" value="{{i.db.lo}}" class="form-control"> 
                                        <input  name="db.ty" value="{{i.db.ty}}" class="form-control"> 
                                        <input  name="db.le" value="{{i.db.le}}" class="form-control"> 
                                        <input  name="db.ex" value="{{i.db.ex}}" class="form-control"> 
                                        <input  name="db.co" value="{{i.db.co}}" class="form-control"> 
                                        <input  name="db.la" value="{{i.db.la}}" class="form-control"> 
                                        <input  name="db.s1" value="{{i.db.s1}}" class="form-control"> 
                                        <input  name="db.s2" value="{{i.db.s2}}" class="form-control"> 
                                        <input  name="db.st" value="{{i.db.st}}" class="form-control"> 

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{d.l10n.jobTitle}}</label>
                                        <div class="col-sm-10 ">
                                            <input  name="db.ti"
                                                value="{{i.db.ti}}"
                                                data-validate
                                                data-required="{{d.l10n.require}}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{d.l10n.jobTitle}}</label>
                                        <div class="col-sm-10 ">
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

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{d.l10n.jobDescription}}</label>
                                        <div class="col-sm-10 ">
                                            <textarea   name="more.description"
                                                        class="form-control more">{{i.more.description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{d.l10n.jobRequirement}}</label>
                                        <div class="col-sm-10 ">
                                            <textarea   name="more.requirement"
                                                        class="form-control more">{{i.more.requirement}}</textarea>
                                        </div>
                                    </div>
                                   
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label">{{d.l10n.jobConditionAndBenefit}}</label>
                                        <div class="col-sm-10 ">
                                            <textarea   name="more.benefit"
                                                        class="form-control more">{{i.more.benefit}}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <input type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTJOB?>"
                                                data-show-success=".alert-footer.alert"
                                                data-show-errors=".alert-footer.alert-error"
                                                class="btn btn-primary"
                                                {{#if i.db.id}}
                                                value="{{d.l10n.btnUpdate}}"
                                                {{else}}
                                                data-redirect="."
                                                value="{{d.l10n.btnAdd}}"
                                                {{/if}}>
                                        </div>
                                    </div>
                                </form> 
                               {{/if}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</script>
<script id="entryAdminManageMessages" type="text/x-handlebars-template">
<div class="item-view-more admin-list"
    data-view-list-by-handlebar
    data-init-button-magic="[data-button-magic]"
    {{#if e.strUrlList}}
    data-url="{{e.strUrlList}}"
    {{else}}
    data-url="/api/get/message_admin"
    {{/if}}
    data-init-object="adminManageUser"
    data-method="get"
    data-show-page="10"
    data-show-item="50"
    data-show-all="false"
    data-scroll-view="false"
    data-form-filter=".form-filter"
    data-template-id="managePageMessages">
    <header class="h-tt p-10 h-tt text-color1 text-bold t-s-19 p-b-10">
        Manage Messages (<span data-total-item></span>)
    </header>

    <div class="table-responsives">
        <table class="table table-bordered">
            <colgroup>
                <col class="col-sm-2">
                <col class="col-sm-2">
                <col class="col-sm-2">
                <col class="col-sm-5">
                <col class="col-sm-1">
            </colgroup>
            <thead>
                <tr class="b-b">
                    <th colspan="6">
                        <form class="form-filter o-hidden" data-waiting="500">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text"
                                            name="sender"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.sender}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text"
                                            name="receiver"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.receiver}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text"
                                            name="subject"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.subjectmessage}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-5">
                                     <input type="text"
                                            name="message"
                                            data-key="e"
                                            data-compare="text in"
                                            placeholder="{{d.l10n.content}}"
                                            class="form-control">
                                </div>
                                <div class="col-sm-1">
                                     {{d.l10n.date}}
                                </div>
                            </div>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody class="view-items" data-content>
            </tbody>
        </table>
        <div class="row">
        <div class="col-xs-10">
            <div data-footer></div>
        </div>
    </div>
    </div>
</div>
</script>  

<script id="managePageMessages" type="text/x-handlebars-template">
    <tr class="b-b">
        {{#xif ' this.i.sender_id == this.i.user_id '}}
            <td><span class="text-bold text-color2">{{i.user_name}}</span></td>
            <td><span class="text-bold text-color3">{{i.company_name}}</span></td>
        {{else}}
            <td><span class="text-bold text-color3">{{i.company_name}}</span></td>
            <td><span class="text-bold text-color2">{{i.user_name}}</span></td>
        {{/xif}}
        <td><p>{{i.subject}}</p></td>
        <td><p>{{i.message}}</p></td>
        <td>{{{formatDate i.created_date '%d-%M-%Y'}}}</td>
    </tr>
</script>