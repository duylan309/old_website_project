<script id="entryViewLocalOption" type="text/x-handlebars-template">
    {{{textFromDropdownLocal e.str e.obj e.key e.value}}}
</script>

<script id="entryCmpLogo" type="text/x-handlebars-template">
{{#if i.im}}
<div class="i-logo">
    <div class="img i-center">
        <figure>
            <a {{#if this.i.us}}
              href="/{{i.us}}"
              {{else}}
              href="/<?=$seo_name["page"]["cmp"]?>/{{urlFriendly i.na i.id}}"
              {{/if}}>
                <img class="image-load full-width"
                    data-img="/<?=FOLDERIMAGECOMPANY?>thumbnail/{{i.im}}"
                    src="/media/images/style/ajax-loader.gif" >
            </a>
        </figure>
    </div>
</div>
{{else}}
<div class="i-logo hidden">
    <div class="img i-center">
        <figure>
          {{i.na}}
        </figure>
    </div>
</div>
{{/if}}
</script>

<script id="viewItemPhotoFB" type="text/x-handlebars-template">

  <a href="{{i.link}}" data-lightbox data-title class="col-sm-3 img-b p-2 c-center">
    <i class="img" style="background:url({{i.images}}) no-repeat;background-size:cover"></i>
  </a>

</script>

<script id="entryPopupContactWebsite" type="text/x-handlebars-template">
    <div class="modal-dialog modal-contact-phone">
        <div class="modal-content">
            <div class="modal-body">
                <div class="focus"
                    data-copy-template
                    data-view-template=".modal-body .focus"
                    data-template-id="entryFormContact"></div>
            </div>
        </div>
    </div>
</script>
<script id="entrySaveData" type="text/x-handlebars-template">
<form method="post" class="post-form">
    <input type="hidden" name="db.me" value="{{e.strSearch}}">

    <div class="row">
      <div class="col-sm-12">
        <h1 class="t-s-18">{{d.l10n.headerSaveDataLine1}}<br>{{d.l10n.headerSaveDataLine2}}</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12 form-group">
            <label>{{d.l10n.yourName}}<span class="text-danger">*</span></label>
            <input type="text"
                   name="db.na"
                   class="form-control"
                   data-validate
                   data-required="Please input"
                   size="40">
            <span class="error"></span>
        </div>
        <div class="col-sm-12 form-group">
            <label>{{d.l10n.yourEmail}}<span class="text-danger">*</span></label>
            <input type="text"
                   name="db.em"
                   class="form-control"
                   data-validate
                   data-required="Please input"
                   data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                   data-pattern-message="Email don't validate"
                   size="40">
            <span class="error"></span>
        </div>

        <div class="col-sm-12 form-group">
            <label>{{d.l10n.yourNumber}}<span class="text-danger"></span></label>
            <input type="text"
                   name="db.nu"
                   class="form-control"
                   data-validate
                   data-required="Please input"
                   size="40">
            <span class="error"></span>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12 text-right">
            <button
               data-button-magic
               data-params-form=".post-form"
               data-format-json="true"
               data-redirect="."
               data-ajax-url="<?=APIPOSTSAVEDATA?>"
               data-show-hide="[data-modal-quick-view]"
               data-show-success=".alert-footer.alert"
               data-show-errors=".alert-footer.alert-error"
               class="btn bg-color1">{{d.l10n.done}}</button>
        </div>
    </div>
</form>
</script>
<script id="entryFormContact" type="text/x-handlebars-template">
    <form method="post" class="post-form">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label>{{d.l10n.yourName}}<span class="text-danger">*</span></label>
                <input type="text"
                       name="db.na"
                       class="form-control"
                       data-validate
                       data-required="Please input"
                       size="40">
            </div>
            <div class="col-sm-6 form-group">
                <label>{{d.l10n.yourEmail}}<span class="text-danger">*</span></label>
                <input type="text"
                       name="db.em"
                       class="form-control"
                       data-validate
                       data-required="Please input"
                       data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                       data-pattern-message="Email don't validate"
                       size="40">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label>{{d.l10n.yourNumber}}<span class="text-danger"></span></label>
                <input type="text"
                       name="db.nu"
                       class="form-control"
                       data-validate
                       data-pattern="^[0-9-+\s()]*$" data-min-length="9" data-max-length="30"
                       data-required="Please input"
                       size="40">
            </div>
            <div class="col-sm-6 form-group">
                <label>{{d.l10n.yourSubject}} <span class="text-danger"></span></label>
                <input type="text"
                       name="db.su"
                       size="40"
                       data-validate
                       data-required="Please input"
                       class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>{{d.l10n.yourRequirement}} <span class="text-danger">*</span></label>
            <textarea name="db.me"
                      class="form-control"
                      cols="40"
                      data-validate
                      data-required="Please input"
                      class="textarea textarea2"
                      rows="5"></textarea>
        </div>
        <div class="form-group">
          <input type="checkbox"
             name="captcha"
             value="1"
             data-validate
             class="form-control boxcaptcha"
             data-required="{{d.l10n.require}}">
          <div class="g-recaptcha-outer b-r-4" data-required="{{d.l10n.requireEmail}}">
              <div class="g-recaptcha-inner">
                  <div id="captcha" class="g-recaptcha" data-sitekey="<?=SITEKEYCAPTCHA?>"></div>
              </div>
          </div>
          <span class="error">{{d.l10n.require}}</span>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 text-right">
                <button type="reset"
                    class="btn bg-color5" >{{d.l10n.reset}}</button>
                    <button
                   data-button-magic
                   data-params-form=".post-form"
                   data-format-json="true"
                   data-ajax-url="<?=APIPOSTCONTACTUS?>"
                   data-show-hide=",[data-modal-quick-view]"
                   data-show-success=".alert-footer.alert"
                   data-show-errors=".alert-footer.alert-error"
                   class="btn bg-color2">{{d.l10n.send}}</button>
            </div>
        </div>
    </form>
</script>

<script id="entryPopupContact" type="text/x-handlebars-template">
    <div class="modal-dialog modal-contact-phone">
        <div class="modal-content">
            <div class="modal-body">
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="img">
                            <figure>
                                <a href="#">
                                    <img alt="{{e.name}}" class="image-load-finished" src="/<?=FOLDERIMAGEUSER?>{{e.im}}">
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <span> {{{getOldFromYMD e.dob}}} {{d.l10n.yearsold}} -
                        {{#xif " this.e.gender == 1 "}}
                            {{d.l10n.male}}
                        {{else}}
                            {{d.l10n.female}}
                        {{/xif}}</span>
                        <h2 class="text-color1 no-margin">{{e.name}}</h2>
                        <h1 class="text-color3 no-margin"><span class="icon-phone"> {{e.phone}}</h1>
                        <p data-button-magic
                              data-elm-data='{
                                      "to":"{{e.to}}"
                                  }'
                              data-view-template-local="true"
                              data-view-template="[data-quick-view-item]"
                              data-template-id="entryPopupSendmessage"><span class="icon-mail">&nbsp;</span>{{d.l10n.sendMessage}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<script id="entryPopupSendmessage" type="text/x-handlebars-template">
{{#if u.userinfo.db.id}}
    <form class="post-form modal-dialog modal-contact-message">
        <div class="hidden">
            <input type="hidden" name="mod"  value="message">
            <input type="hidden" name="db.to"  value="{{e.to}}">
            <input type="hidden" name="db.from"  value="{{u.userinfo.db.id}}">
        </div>
        <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-color1 no-margin">{{d.l10n.sendMessage}}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 text-center ">
                        <a href="#">
                            <img alt="{{u.userinfo.db.name}}" class="full-width" src="/<?=FOLDERIMAGEUSER?>{{u.userinfo.db.im}}">
                        </a>
                        <label>{{u.userinfo.db.name}}</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input name="db.ti" class="form-control" placeholder="{{d.l10n.title}}">
                        </div>
                        <div class="form-group">
                            <textarea name="db.content" class="form-control more" placeholder="{{d.l10n.content}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button class="btn bg-color3 text-uppercase"
                      data-button-magic
                       data-params-form=".post-form"
                       data-format-json="true"
                       data-ajax-url="<?=APIPOSTSENDMESSAGE?>"
                       data-show-hides=","
                       data-show-success="#message-from-ajax"
                       data-show-errors=".login-failed">{{d.l10n.sendMessage}}</button>
                </div>
            </div>
        </div>
    </form>
{{/if}}
</script>
<script id="entryPopupInterview" type="text/x-handlebars-template">
{{#if u.userinfo.db.id}}
    <form class="post-form modal-dialog modal-contact-message form-horizontal">
        <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
        <div class="hidden">
            <input type="hidden" name="mod"  value="interview">
            <input type="hidden" name="db.to"  value="{{e.to}}">
            <input type="hidden" name="db.from"  value="{{u.userinfo.db.id}}">
        </div>
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-color1 no-margin">{{d.l10n.sendInterview}}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 text-center ">
                        <a href="#">
                            <img alt="{{u.userinfo.db.name}}" class="full-width" src="/<?=FOLDERIMAGEUSER?>{{u.userinfo.db.im}}">
                        </a>
                        <label>{{u.userinfo.db.name}}</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        {{d.l10n.date}}
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="db.day" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-6 control-label">
                                        {{d.l10n.time}}
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="db.time" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                {{d.l10n.address}}
                            </div>
                            <div class="col-sm-9">
                                <input name="db.address" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                {{d.l10n.content}}
                            </div>
                            <div class="col-sm-9">
                                <textarea name="db.content" class="form-control more"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button class="btn bg-color3 text-uppercase"
                      data-button-magic
                       data-params-form=".post-form"
                       data-format-json="true"
                       data-ajax-url="<?=APIPOSTSENDMESSAGE?>"
                       data-show-hides=","
                       data-show-success="#message-from-ajax"
                       data-show-errors=".login-failed">{{d.l10n.sendInterview}}</button>
                </div>
            </div>
        </div>
    </form>
{{/if}}
</script>

<script id="entrySignin" type="text/x-handlebars-template">
<div class="modal-dialog modal-signup">
    <div class="modal-content">
        <div class="modal-body p-30 modal-signin">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title">
                    <h3 class="text-color1 no-margin text-uppercase t-s-21">{{d.l10n.signInHeader}}</h3>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <div class="title">
                    <p class="m-b-10 hidden">{{d.l10n.signinContent}}</p>
                  </div>
                </div>
                <div class="col-sm-6 t-s-12">
                </div>
              </div>
            </div>

            <form class="post-form">
                <div class="form-group hidden">
                  {{#if e.urlRedirectLink}}
                    <input type="text" name="urlRedirectLink" value="{{e.urlRedirectLink}}">
                  {{/if}}
                </div>
                <div class="login-error login-failed" data-fade="4500">
                  <div class="sms-content"></div>
                </div>
                <div class="form-group">
                    <input type="text"
                           name="email"
                           class="form-control"
                           data-validate
                           {{d.l10n.requireTitle}}
                           data-required="{{d.l10n.require}}"
                           data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                           data-pattern-message="{{d.l10n.requireEmailRule}}"
                           placeholder="{{d.l10n.email}}">
                    <span class="error"></span>
                </div>
                <div class="form-group m-b-5" >
                    <input type="password"
                           name="password"
                           class="form-control"
                           data-validate data-min-length="6"
                           data-required="{{d.l10n.require}}"
                           data-pattern-message="{{d.l10n.requirePasswordRule}}"
                           placeholder="{{d.l10n.password}}">
                    <span class="error"></span>
                </div>

                <div class="form-group m-t-15">
                    <div class="row">
                        <div class="col-xs-12">

                              <button type="submit"
                                   data-button-magic
                                   data-params-form=".post-form"
                                   data-format-json="true"
                                   data-ajax-url="<?=APIPOSTUSERSIGNIN?>"
                                  
                                   {{#if e.missingSession}}
                                   data-show-hide=",{{e.hideObj}}"
                                   {{else}}
                                      {{#if e.urlRedirect}}
                                        data-redirect="{{e.urlRedirect}}"
                                       {{else}}
                                       data-redirect="."
                                       {{/if}}
                                   {{/if}}

                                   data-elm-data='{
                                        "missingSession":"true",
                                        "hideObj":"[data-quick-view-item1]"
                                   }'
                                   data-show-hide=",[data-modal-quick-view]"
                                   data-show-success=".alert-footer.alert"
                                   data-show-errors=".login-error"
                                   class="btn btn-block bg-color2 text-uppercase form-control"
                                   value="{{d.l10n.signin}}">
                                   <i class="fa fa-sign-in fa-fw"></i> <span>{{d.l10n.signin}}</span>
                                   </button>
                                    <a class="btn btn-block text-uppercase facebook-color" onclick="loginFB();">
                                      <i class="fa fa-facebook-square"></i>&nbsp;Sign in with facebook
                                 </a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row t-s-12">
                        <div class="col-xs-6">
                            <span class="checkbox checkbox-left">
                                <input name="rememberlogin"
                                       type="checkbox"
                                       value="1">
                                <span class="checkbox-style"></span>
                                {{d.l10n.rememberLogin}}
                            </span>
                        </div>
                        <div class="col-xs-6 text-right">
                        <a href="/pw"
                             data-button-magics
                             data-view-template-local="true"
                             data-view-template="[data-quick-apply-job]"
                             data-template-id="entryFormForgotPassword">{{d.l10n.forgotPassword}}</a>
                        </div>
                    </div>
                </div>

                <div class="row t-s-11 m-b-15">
                    <div class="col-sm-12"><hr></div>
                </div>

                <div class="link-group register-text">
                    <div class="user-menu text-center">
                    <a href="/rg" class="text-bold " data-show-index="0">{{d.l10n.createAccount}}</a>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

</script>

<script id="entrySignup" type="text/x-handlebars-template">

    <div class="text-center m-b-20 hidden">
        {{#if e.employment}}
            <h3 class="text-color1 text-uppercase t-s-26">{{d.l10n.signupEmployerTitle}}</h3>
            <p class="hidden ">{{d.l10n.signupEmployerNote}}</p>
        {{/if}}
        {{#if e.seeker}}
            <h3 class="text-color1 text-uppercase t-s-26">{{d.l10n.signupSeekerTitle}}</h3>
            <p class="hidden">{{d.l10n.signupSeekerNote}}</p>
        {{/if}}
    </div>

    {{#if e.seeker}}
    <div class="block">
        <div class="text-center hidden">
            <div class="row">
                <div class="col-xs-offset-2 col-xs-8">
                  <hr/>
                </div>
            </div>
            {{d.l10n.signinFast}}
        </div>
    </div>
    {{/if}}

    <div class="block">

        {{#if e.seeker}}
          <div class="text-center bg-color2 text-uppercase tab-signup hidden">
            <div class="row">
                <div class="col-sm-12">
                    <a class="btn text-bold btn-block t-s-21" href="#">{{d.l10n.seekerperson}}</a>
                </div>

            </div>
        </div>
        {{else}}
             <div class="text-center bg-color2 text-uppercase tab-signup hidden">
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn text-bold btn-block t-s-21" href="#">{{d.l10n.employmentPage}}</a>
                </div>
            </div>
        </div>
        {{/if}}

        {{#if e.seeker}}
            <div class="u-form-signup in"
              data-copy-template=""
              data-elm-data='{"type":"{{e.type}}"}'
              data-view-template=".u-form-signup"
              data-template-id="entryFormSignupUser"></div>

        {{else}}

        <div class="cmp-more">
            <div class="u-form-signup in"
              data-copy-template=""
              data-elm-data='{"type":"{{e.type}}"}'
              data-view-template=".u-form-signup"
              data-template-id="entryFormSignup"></div>

        {{/if}}

        </div>
    </div>
</script>
<script id="entryFormSignupUser" type="text/x-handlebars-template">
<div class="form-group">
  <div class="row">
    <div class="col-sm-12">

      <div class="title text-center">
        <h3 class="text-color1 no-margin text-uppercase t-s-26"> {{d.l10n.signupSeekerTitle}}</h3>
        <p>{{d.l10n.signupSeekerContent}}</p>
      </div>
    </div>
  </div>
</div>
<div class="modal-signup">
    <div class="modal-content">
        <div class="modal-body p-30 modal-signin">
            <div class="form-group" style="margin-bottom:10px">
              <div class="row">
                <div class="col-sm-6">
                  <div class="title">
                      <h3 class="no-margin t-s-18"> {{d.l10n.signupforfree}}</h3>
                  </div>
                </div>
                <div class="col-sm-6 t-s-12">
                </div>
              </div>
            </div>

            <form method="post" class="post-form" data-hidden-info-from-ajax>
                <div class="error login-failed" data-fade="4500">
                   <div class="sms-content">&nbsp;</div>
                </div>
                <div class="hidden"><input type="radio" name="type" value="{{e.type}}" checked></div>

                <div class="form-group">
                    <input type="text"
                       name="name"
                       class="form-control"
                       data-validate
                       placeholder="{{d.l10n.fullname}}"
                       data-required="{{d.l10n.require}}">
                    <span class="error"></span>

                </div>

                <div class="form-group m-b-5" >
                    <input type="text"
                       name="email"
                       class="form-control"
                       data-validate
                       data-required="{{d.l10n.require}}"
                       data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                       data-pattern-message="{{d.l10n.requireEmailRule}}"
                       placeholder="{{d.l10n.email}}">
                    <span class="error"></span>
                </div>

                <div class="form-group m-b-5" >
                    <input type="password"
                           name="password"
                           class="form-control"
                           data-validate data-min-length="6"
                           data-required="{{d.l10n.require}}"
                           data-pattern-message="{{d.l10n.requirePasswordRule}}"
                           placeholder="{{d.l10n.password}}">
                    <span class="error"></span>
                </div>
                <div class="form-group m-b-5">
                  <input type="checkbox"
                     name="captcha"
                     value="1"
                     data-validate
                     class="form-control boxcaptcha"
                     data-required="{{d.l10n.require}}">
                  <div class="g-recaptcha-outer b-r-4" data-required="{{d.l10n.requireEmail}}">
                      <div class="g-recaptcha-inner">
                          <div id="captcha" class="g-recaptcha" data-sitekey="<?=SITEKEYCAPTCHA?>"></div>
                      </div>
                  </div>
                  <span class="error">{{d.l10n.require}}</span>
                </div>
                <div class="form-group m-t-15">
                    <div class="row">
                        <div class="col-xs-12">

                         <button type="submit"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTUSERSIGNUP?>"
                            data-redirect="/user"
                            data-show-success="#message-from-ajax"
                            data-show-errors=".login-failed"
                            data-special="showInfoPost"
                            data-element-value-input="[data-value-input]"
                            data-show-hide=".signup-info-review,[data-hidden-info-from-ajax]"
                            class="btn bg-color3 btn-block text-uppercase text-bold"
                            value="{{d.l10n.signup}}">
                            <i class="fa fa-sign-in fa-fw"></i> <span>{{d.l10n.signup}}</span>
                          </button>
                          <a class="btn btn-block text-uppercase facebook-color" onclick="loginFB();">
                                <i class="fa fa-facebook-square"></i>&nbsp;Sign up with facebook
                          </a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <p class="notice t-s-12">{{{d.l10n.signupNote}}}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="form-group m-t-15">
  <div class="row">
    <div class="col-sm-12">

      <div class="title text-center">
        <a href="/{{d.l10n.employerlink}}" class="text-color3 no-margin text-uppercase t-s-12 text-bold text-underline"> {{d.l10n.signupForCompany}}</a>
      </div>
    </div>
  </div>
</div>
</script>


<script id="entryFormSignup" type="text/x-handlebars-template">
    <form method="post" autocomplete="off" class="form-horizontal post-form post-form-signup" data-hidden-info-from-ajax>

        <div class="error login-failed"><div class="sms-content">&nbsp;</div></div>
        <div class="fieldset">
            <div class="t-t text-uppercase text-bold t-s-21 m-b-20 text-color1">
                  {{d.l10n.accountInformation}}
             </div>
            <div class="hidden"><input type="radio" name="type" value="{{e.type}}" checked></div>
            <div class="form-group">
                <label class="col-sm-3">{{d.l10n.fullname}}</label>
                <div class="col-sm-9">
                    <input type="text"
                       name="name"
                       class="form-control"
                       data-validate
                       data-required="{{d.l10n.require}}">
                    <span class="error"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3">{{d.l10n.email}}</label>
                <div class="col-sm-9">
                    <input type="text"
                       name="email"
                       class="form-control"
                       data-validate
                       data-required="{{d.l10n.requireEmail}}"
                       data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                       data-pattern-message="{{d.l10n.requireEmailRule}}">
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3">{{d.l10n.phone}}</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control"
                        name="phone"
                        data-validate data-min-length="2"
                        data-required="{{d.l10n.requirePhone}}"
                        data-pattern="^[0-9-+\s()]*$" data-min-length="9" data-max-length="20"
                        data-pattern-message="{{d.l10n.requirePhoneRule}}">
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-group hidden">
                <label class="col-sm-3">{{d.l10n.address}}</label>
                <div class="col-sm-9">
                    <input type="text"
                        name="address"
                        class="form-control"
                        data-required="{{d.l10n.requireAddress}}">
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3">{{d.l10n.password}}</label>
                <div class="col-sm-9">
                    <input type="password"
                       name="password"
                       class="form-control"
                       data-validate data-min-length="6"
                       data-required="{{d.l10n.requirePassword}}"
                       data-pattern-message="{{d.l10n.requirePasswordRule}}">
                    <span class="error"></span>
                </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3"></label>
              <div class="col-sm-9">
                <input type="checkbox"
                   name="captcha"
                   value="1"
                   data-validate
                   class="form-control boxcaptcha"
                   data-required="{{d.l10n.require}}">
                <div class="g-recaptcha-outer b-r-4" data-required="{{d.l10n.requireEmail}}">
                    <div class="g-recaptcha-inner">
                        <div id="captcha" class="g-recaptcha" data-sitekey="<?=SITEKEYCAPTCHA?>"></div>
                    </div>
                </div>
                <span class="error">{{d.l10n.require}}</span>
              </div>
            </div>

            {{#if e.payment}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit"
                               data-button-magic
                               data-params-form=".post-form"
                               data-format-json="true"
                               data-ajax-url="<?=APIPOSTUSERSIGNUP?>"
                               {{#if u.optionService.promo_code}}
                               data-redirect="<?=$seo_name["page"]["user"].'?manage=pagecmp'?>"
                               {{else}}
                               data-redirect="."
                               {{/if}}
                               data-show-success="#message-from-ajax"
                               data-show-errors=".login-failed"
                               data-special="showInfoPost"
                               data-element-value-input="[data-value-input]"
                               data-show-hide=".signup-info-review,[data-hidden-info-from-ajax]"
                               class="btn bg-color3 btn-block text-uppercase"
                               value="{{d.l10n.btnSubmit}}">
                               <i class="fa fa-check"></i> <span>{{d.l10n.btnSubmit}}</span>
                               </button>
                        </div>
                    </div>
                </div>
            </div>
            {{else}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <p class="notice t-s-12">{{{d.l10n.signupNote}}}</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit"
                               data-button-magic
                               data-params-form=".post-form"
                               data-format-json="true"
                               data-ajax-url="<?=APIPOSTUSERSIGNUP?>"
                               data-redirect="/user"
                               data-show-success="#message-from-ajax"
                               data-show-errors=".login-failed"
                               data-special="showInfoPost"
                               data-element-value-input="[data-value-input]"
                               data-show-hide=".signup-info-review,[data-hidden-info-from-ajax]"
                               class="btn bg-color3 btn-block text-uppercase text-bold"
                               value="{{d.l10n.signup}}">
                                <i class="fa fa-check"></i> <span>{{d.l10n.btnSubmit}}</span>
                               </button>
                        </div>

                        {{#xif ' this.e.type == 1 '}}
                          <div class="col-sm-6">
                              <p class="text-italic text-color3 p-5">{{{d.l10n.registerVip}}}</p>
                          </div>
                        {{/xif}}
                    </div>
                </div>
            </div>
            {{/if}}
             {{#xif ' this.e.type == 1 '}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 hidden">
                    <p class="notice text-italic text-color1">{{{d.l10n.freeDay}}}</p>
                </div>
            </div>
            {{/xif}}

        </div>
    </form>
</script>
<script id="entryViewUserInfo" type="text/x-handlebars-template">
    <div class="row">
        <label class="col-sm-3">
            {{#xif ' this.e.type == 2'}}{{d.l10n.fullname}}{{else}}{{d.l10n.companyName}}{{/xif}}
        </label>
        <div class="col-sm-9">
            {{u.userinfo.db.name}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-3">
            {{d.l10n.jobCategories}}
        </label>
        <div class="col-sm-9">
            <div class="c-list">{{{textFromDropdownLocal u.userinfo.db.category 'menuList' ''}}}</div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-3">
            {{d.l10n.email}}
        </label>
        <div class="col-sm-9">
            {{u.userinfo.db.email}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-3">
            {{d.l10n.phone}}
        </label>
        <div class="col-sm-9">
            {{u.userinfo.db.phone}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-3">
            {{d.l10n.address}}
        </label>
        <div class="col-sm-9">
            {{u.userinfo.db.address}} - {{{textFromDropdownLocal u.userinfo.db.city 'location' 'id' 'ti'}}}
        </div>
    </div>
    <div class="text-right">

        {{#xif " this.u.optionService.price > 0"}}
        <a href="/pm?step=2" class="btn bg-color3 text-bold">{{d.l10n.btnNext}}</a>
        {{else}}
        <a href="/<?=$seo_name["page"]["user"].'?manage=pagecmp'?>" class="btn bg-color3 text-bold">{{d.l10n.btnNext}}</a>
        {{/xif}}

   </div>
</script>
<script id="entryPaymentMethodOption" type="text/x-handlebars-template">
    {{#if u.optionService.id}}
    <form class="post-form form-horizontal">
        <div class="hidden">
            <input name="db.si" type="hidden" value="{{u.optionService.id}}">
            <input name="db.ui" type="hidden" value="{{u.userinfo.db.id}}">
            <input name="db.am" type="hidden" value="{{u.optionService.price}}">
            <input name="db.ps" type="hidden" value="1">
        </div>
        <header class="text-bold text-color1 b-b post-form col-sm-12 m-b-10 p-10">
            {{d.l10n.paymentMethod}}
        </header>
        <div class="clearfix"></div>
        <div class="payment-method">
            <div class="row form-group">
                <p class="text-warning p-10 hidden"> {{d.l10n.choosePaymentMethod}} </p>
                {{#each d.l10n.paymentMethodOption}}
                    <div class="col-xs-4 col-sm-4">
                        <div class="relative">
                            <label data-elm-data='{"pm":"{{this.id}}"}'
                                {{#if this.attr}} {{this.attr}} {{/if}}
                                class="img text-center">
                                <input type="radio"
                                    name="db.pm"
                                    value="{{this.id}}"
                                    data-validate
                                    data-required=" ">
                                <span class="style-radio bg-color4 b-r-4"></span>
                                <img alt="atm-payment" src="{{this.img}}" />
                                <span class="tt">{{this.title}}</span>
                            </label>
                        </div>
                    </div>
                {{/each}}
            </div>
            <div class="view-option-payment"><!--option payment--></div>
            <div class="row">
                <div class="col-sm-offset-6 col-sm-3">
                    <a href="/pm?step=1" class="btn bg-color3 text-bold btn-block">{{d.l10n.btnPrev}}</a>
                </div>
                <div class="col-sm-3">
                    <button class="btn bg-color3 text-bold btn-block"
                        data-button-magic
                        data-params-form=".post-form"
                        data-format-json="true"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-success=".alert-footer.alert"
                        data-ajax-url="<?=APIPOSTPAYMENT?>">
                        {{d.l10n.btnNext}}
                    </button>
                </div>
           </div>
        </div>
    </form>
    {{else}}

    {{/if}}
</script>

<script id="tempPaymentBasic" type="text/x-handlebars-template">
Chuyển khoản

Quý khách vui lòng chuyển khoản cho chúng tôi theo thông tin sau:

    Tên tài khoản: CÔNG TY CỔ PHẦN MẮT BÃO
    Số TK: 007 100 233 3325
    Ngân hàng: Vietcombank - chi nhánh HCM

    Tên tài khoản: CÔNG TY CỔ PHẦN MẮT BÃO
    Số TK: 21081 48511 89999
    Ngân hàng: Eximbank - PGD Trương Định - TP.HCM

Để đảm bảo quyền lợi khách hàng, khách hàng cần lưu ý

Quý khách vui lòng chuyển khoản qua ngân hàng trong phần "Nội dung thanh toán". Quý
khách ghi rõ mã đơn hàng cần thanh toán và số điện thoại đã dùng đặt hàng (Mã đơn hàng + Số điện thoại).
- Sau khi thanh toán Quý khách vui lòng gởi thông báo vào billing@matbao.com để chúng tôi hoàn tất đơn hàng cho Quý khách.
- Dịch vụ chỉ được đăng ký / gia hạn khi nhận được thanh toán và thông tin chính xác đầy đủ.
</script>

<script id="entryForgotPasswordDone" type="text/x-handlebars-template">
  <div class="modal-signup">
    <div class="modal-content">
      <div class="modal-body p-30 modal-signin text-center t-s-14">
        <h1 class="text-bold text-color1 t-s-21">{{d.l10n.recoveryPasswordSuccess}}</h1>
          <a class="btn bg-color3" href="/<?=$seo_name["page"]["user"]?>?action=login">{{d.l10n.btnLoginToApplyJob}}</a>

      </div>
    </div>
  </div>

</script>

<script id="entryForgotPassword" type="text/x-handlebars-template">
{{#unless u.userinfo}}
    {{#if e.reset}}
    <div class="modal-signup">
      <div class="modal-content">
          <div class="modal-body p-30 modal-signin">
              <div class="title m-b-10">
                  <h2 class="no-margin t-s-21 text-bold text-color1">{{d.l10n.recoveryPassword}}</h2>
              </div>
              <form method="post" class="form-horizontal post-form">
                  <div class="hidden">
                      <input name="password.reset" value="{{e.reset}}">
                  </div>
                  <div class="form-group">
                      <label class="col-sm-12">{{d.l10n.passwordNew}}</label>
                      <div class="col-sm-12">
                          <input type="password"
                              name="password.passwordNew"
                              data-validate
                              data-min-length="6"
                              data-required="{{d.l10n.requirePassword}}"
                              data-pattern-message="{{d.l10n.requirePasswordRule}}"
                              data-compare="#accountPasswordConfirm"
                              placeholder="{{d.l10n.enterNewPasswordHere}}"
                              data-compare-message="Password don't match"
                              id="accountPasswordNew"
                              class="form-control">
                          <span class="error"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-12">{{d.l10n.passwordConfirm}}</label>
                      <div class="col-sm-12">
                          <input type="password"
                              name="password.passwordConfirm"
                              data-validate
                              data-required="{{d.l10n.requirePassword}}"
                              data-compare="#accountPasswordNew"
                              placeholder="{{d.l10n.RenterNewPasswordHere}}"
                              data-compare-message="Password don't match"
                              id="accountPasswordConfirm"
                              class="form-control">
                          <span class="error"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-12 text-center">
                          <button type="submit"
                            class="btn bg-color3"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTFORGOTPASSWORD?>"
                            data-show-success=".alert-footer.alert"
                            data-show-errors=".alert-footer.alert-error"
                            data-redirect="/"
                            value="{{d.l10n.btnUpdate}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
                      </div>
                  </div>
                  <div class="alert" data-fade="2000"><div class="sms-content"></div></div>
              </form>
          </div>
      </div>



    </div>
    {{else}}

    {{#if e.st}}
    <div class="modal-signup">
      <div class="modal-content">
        <div class="modal-body p-30 modal-signin text-center t-s-14">
          <h1 class="text-bold text-color1 t-s-21">{{d.l10n.recoveryPassword}}</h1>
          <p>{{d.l10n.forgotPasswordDoneLine1}}</p>
          <p class="text-color2 text-bold">{{e.em}}</p>
          <p>{{d.l10n.forgotPasswordDoneLine2}}</p><br>
        </div>
      </div>
    </div>
    {{else}}
    <form class="post-form">

          <div class="u-signup in modal-forgot-password text-center">

                <div class="modal-signup">
                    <div class="modal-content">
                        <div class="modal-body p-30 modal-signin">

                            <div class="form-group">
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="title m-b-5">
                                    <h3 class="text-color1 no-margin text-uppercase t-s-21">{{d.l10n.forgotPassword}} </h3>
                                    <p>{{d.l10n.forgotPasswordContent}}</p>
                                  </div>
                                  <div class="ct">
                                    <div class="error login-failed"><div class="sms-content"></div></div>
                                    <div class="form-group">

                                        <input type="text"
                                               name="your-email"
                                               class="form-control"
                                               data-validate
                                               data-required="Please input"
                                               data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                                               data-pattern-message="Email don't validate"
                                               placeholder="{{d.l10n.requireEmail}}"
                                               size="40">
                                    </div>
                                    <div class="form-group">
                                        <button
                                           data-button-magic
                                           data-params-form=".post-form"
                                           data-format-json="true"
                                           data-show-success=".alert-footer.alert"
                                           data-show-errors=".alert-footer.alert-error"
                                           data-redirects="/"
                                           data-ajax-url="<?=APIPOSTFORGOTPASSWORD?>"
                                           class="btn bg-color3">{{d.l10n.send}}</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    {{/if}}

    {{/if}}
{{/unless}}
</script>

<script id="entrySigninPopup" type="text/x-handlebars-template">
    <div class="modal-dialog modal-signup">
        <div class="modal-content">
            <div class="modal-body p-30 modal-signin">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12">
                      <span class="position-right"
                        data-closet-toggle-class="in"
                        data-object=".modal"
                        data-empty-object="{{#if e.hideObj}}{{e.hideObj}}{{else}}[data-quick-view-item]{{/if}}"><i class="fa fa-times-circle"></i></span>
                      <div class="title">
                        <h3 class="text-color1 no-margin text-uppercase t-s-21">{{d.l10n.signInHeader}}</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="title">
                        <p class="m-b-10 hidden">{{d.l10n.signinContent}}</p>
                      </div>
                    </div>
                    <div class="col-sm-6 t-s-14">
                      <div class="text-facebook hidden"signinpop onclick="loginFB();" data-show-index="0"><i class="fa fa-facebook-square t-s-16"></i>&nbsp;Sign in with Facebook</div>
                    </div>
                  </div>
                </div>

                <form autocomplete="off" class="post-form">
                    <div class="login-error login-failed" data-fade="4500">
                      <div class="sms-content"></div>
                    </div>
                    <div class="form-group">
                        <input type="text"
                               name="email"
                               class="form-control"
                               data-validate
                               
                               {{d.l10n.requireTitle}}
                               data-required="{{d.l10n.require}}"
                               data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                               data-pattern-message="{{d.l10n.requireEmailRule}}"
                               placeholder="{{d.l10n.email}}">
                        <span class="error"></span>
                    </div>
                    <div class="form-group m-b-5" >
                        <input type="password"
                               name="password"
                               autocomplete="off"
                               class="form-control"
                               data-validate data-min-length="6"
                               data-required="{{d.l10n.require}}"
                               data-pattern-message="{{d.l10n.requirePasswordRule}}"
                               placeholder="{{d.l10n.password}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group m-t-15">
                        <div class="row">
                            <div class="col-xs-12">

                                 {{#if e.homeRedirect }}
                                     <input type="hidden" name="direct" value="1">
                                  {{/if}}

                                  <button type="submit"
                                       data-button-magic
                                       data-params-form=".post-form"
                                       data-format-json="true"


                                       data-ajax-url="<?=APIPOSTUSERSIGNIN?>&direct=1"

                                       {{#if e.missingSession}}
                                       data-show-hide=",{{e.hideObj}}"

                                       {{else}}
                                          {{#if e.urlRedirect}}
                                            data-redirect="{{e.urlRedirect}}"
                                           {{else}}
                                           data-redirect="."
                                           {{/if}}
                                       {{/if}}

                                       data-elm-data='{
                                            "missingSession":"true",
                                            "hideObj":"[data-quick-view-item1]"
                                       }'
                                       data-show-hide=",[data-modal-quick-view]"
                                       data-show-success=".alert-footer.alert"
                                       data-show-errors=".login-error"

                                       class="btn btn-block bg-color2 text-uppercase"
                                       value="{{d.l10n.signin}}">
                                       <i class="fa fa-sign-in fa-fw"></i> <span>{{d.l10n.signin}}</span>
                                       </button>

                                 <a class="btn btn-block text-uppercase facebook-color" onclick="loginFB();">
                                      <i class="fa fa-facebook-square"></i>&nbsp;Sign in with facebook
                                 </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row t-s-12">
                            <div class="col-xs-6">
                                <label class="checkbox checkbox-left">
                                    <input name="rememberlogin"
                                           type="checkbox"
                                           value="1">
                                    <span class="checkbox-style"></span>
                                    {{d.l10n.rememberLogin}}
                                </label>
                            </div>
                            <div class="col-xs-6 text-right">
                            <a href="/pw"
                                 data-button-magics
                                 data-view-template-local="true"
                                 data-view-template="[data-quick-apply-job]"
                                 data-template-id="entryFormForgotPassword">{{d.l10n.forgotPassword}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="row t-s-11 m-b-15">
                        <div class="col-sm-12"><hr></div>
                    </div>

                    <div class="link-group register-text">
                        <div class="user-menu text-center">
                        <a href="/rg" class="text-bold " data-show-index="0">{{d.l10n.createAccount}}</a>
                        </div>
                    </div>

                    <div class="row m-b-10 hidden">
                        <div class="col-sm-6">
                          <button href="#" class="btn bg-color1 btn-facebook text-bold pull-right"><i class="fa fa-facebook-square"></i>&nbsp;FACEBOOK</button>
                        </div>
                        <div class="col-sm-6">
                          <button href="#" class="btn bg-color3 btn-google text-bold"><i class="fa fa-google-plus-square"></i>&nbsp;GOOGLE</button>
                        </div>
                    </div>

                    <div class="row hidden">
                        <div class="col-sm-12 text-center text-italic">{{d.l10n.signinPromise}}</div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</script>


<script id="viewItemBlogFB" type="text/x-handlebars-template">
   <div class="item i-blog">
    <div class="row">
        <div class="col-sm-1 col-xs-2">
          <div class="p-img-s" style="background:url('/<?=FOLDERIMAGECOMPANY?>{{e.cmpim}}') no-repeat;-webkit-background-size: cover;
              -o-background-size: cover;
          background-size: cover;background-position:center center"></div>
        </div>
        <div class="col-sm-10 col-xs-9">
          <div class="i-b-t">
              <a href="#"><strong>{{e.cmpname}}</strong></a>
          </div>
          <div class="i-b-d">
           {{{formatDateFB i.created_time '%d-%M-%Y at %H:%m'}}}
          </div>
        </div>
    </div>

    <div class="sortcontent">
        <p class="textarea-content">{{{i.message}}}</p>
        <div class="fb-img image-load" style="background:url({{i.full_picture}}) no-repeat;-webkit-background-size: cover;-o-background-size: cover;background-size: cover;background-position:center center">
          <div class="action text-left">
           <span>{{i.likes.summary.total_count}} {{#xif ' this.i.likes.summary.total_count>1 '}} {{d.l10n.likes}} {{else}} {{d.l10n.like}} {{/xif}}</span>
           <span>{{i.comments.summary.total_count}} {{#xif ' this.i.comments.summary.total_count>1 '}} {{d.l10n.comments}} {{else}} {{d.l10n.comment}} {{/xif}}</span>
           <span>{{#if i.shares.count}} {{i.shares.count}} {{else}} 0 {{/if}} {{#xif ' this.i.shares.count>1 '}} {{d.l10n.shares}} {{else}} {{d.l10n.share}} {{/xif}}</span>
          </div>  
        </div>
        
    </div>


</div>
</script>

<script id="viewItemBlog" type="text/x-handlebars-template">
   <div class="item i-blog">
    <div class="row">
        <div class="col-sm-1 col-xs-2">
          <div class="p-img-s" style="background:url('/<?=FOLDERIMAGECOMPANY?>{{e.cmpim}}') no-repeat;-webkit-background-size: cover;
              -o-background-size: cover;
          background-size: cover;"></div>
        </div>
        <div class="col-sm-10 col-xs-9">
          <div class="i-b-t">
              <a href="#"><strong>{{e.cmpname}}</strong></a>
          </div>
          <div class="i-b-d">{{{formatDate i.cr '%d-%M-%Y at %H:%m'}}}</div>
        </div>

        <div class="col-sm-1">

            {{#if e.myblog}}

            <div class="otooltip blog-function text-center">
                <span class="text-center"><i class="fa fa-chevron-down"></i></span>
                <div class="otooltip-content otooltip-r text-left">

                  <div
                      class="btn"
                      title="Edit id {{i.id}}"
                      data-button-magic
                      data-method="get"
                      data-ajax-url="<?=APIGETBLOG?>/{{i.id}}"
                      data-view-template="[data-quick-view-item]"
                      data-template-id="entryBlogEditBasic"><i class="fa fa-pencil"></i> {{d.l10n.btnEdit}}</div>

                  <div
                      class="btn"
                      title="Delete"
                      data-button-magic
                      data-confirm="true"
                      data-method="post"
                      data-format-json="true"
                      data-params='{"db":{"id":"{{i.id}}", "ui":"{{u.userinfo.db.id}}"}, "updateNode":"del"}'
                      data-ajax-url="<?=APIPOSTBLOG?>"
                      data-refress-list=".item-view-more"><i class="fa fa-trash-o"></i> {{d.l10n.btnDelete}}</div>

                </div>
            </div>

            {{/if}}

        </div>

    </div>

    <div class="sortcontent">
        <p>{{i.nf}}</p>
    </div>


</div>
</script>

<!---PAYMENT-->
<script type="text/x-handlebars-template" id="entryPaymentTableCount">


    <div class="bg-color4 p-10">
            <div class="ct-pm">
                <header class="text-bold text-color1 m-b-10">
                    {{#if u.optionService.promo_code}}
                        <strong class="">{{d.l10n.promoCode}}: {{u.optionService.promo_code}}</strong>
                    {{else}}
                        
                        
                    {{/if}}
                </header>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-bold bg-gr-n-b">
                            <tr>
                                <th>{{d.l10n.name}}</th>
                                <th class="text-right">{{d.l10n.servicePackage}}</th>
                                <th class="text-right">{{d.l10n.fee}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-sm-4 text-bold">
                                    {{{textFromDropdownLocal u.optionService.category 'serviceCategory' 'id' 'ti'}}}
                                </td>
                                <td class="text-right">
                                    {{#if e.step1}}
                                    <select name="service"
                                        class="form-control"
                                        type="select"
                                        data-validate
                                        data-required
                                        data-dropdown
                                        data-str-key="id"
                                        data-str-value="title"
                                        data-params="category={{u.optionService.category}}"
                                        data-index-value="{{u.optionService.id}}"
                                        data-option-local-json="service">
                                    </select>
                                    <div class="hidden">
                                        <span class="btn-update-cart"
                                            data-button-magic
                                            data-ajax-url="/api/post/optionservice"
                                            data-params='{"id":"{{u.optionService.id}}"}'
                                            data-method="POST"
                                            data-format-json="true"
                                            data-redirect="<?=$seo_name["page"]["payment"]?>?step=1"></span>
                                    </div>
                                    {{else}}
                                        {{u.optionService.title}}
                                    {{/if}}
                                </td>
                                <td class="text-right">
                                    {{{formatCurrency u.optionService.price 2 " VND"}}}
                                </td>
                            </tr>
                           
                            <tr>
                                <td>&nbsp;</td>
                                <td class="text-right">VAT:</td>
                                <td class="text-right">
                                    {{{formatCurrency u.optionService.price 2 " VND"}}}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class="text-right text-bold">Total:</td>
                                <td class="text-right text-bold text-color3">
                                    {{{formatCurrency u.optionService.price 2 " VND"}}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</script>
<script id="entrySignupWithPromoCode" type="text/x-handlebars-template">
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
            <input type="hidden" name="urlregister" value="1">
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit"
                data-button-magic
                data-params-form=".post-form"
                data-format-json="true"
                data-ajax-url="<?=APIPOSTPROMOAPPLIED?>"
                data-show-success=".alert-footer.alert"
                data-show-errors=".alert-footer.alert-error"
                data-redirect="/pm?step=1"
                class="btn bg-color3 m-t-10 form-control text-bold text-uppercase"
                value="{{d.l10n.btnSubmitCode}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnSubmit}}</span></button>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12 text-center m-t-5">
                {{{d.l10n.requireActivationCode}}}
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
<script id="entrySignupWithPromoCodeNoBox" type="text/x-handlebars-template">
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
            <div class="form-group">
              <div class="col-sm-12 text-center m-t-5">
                {{{d.l10n.requireActivationCode}}}
              </div>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>


</script>



<script id="entryPaymentOptionEmpty" type="text/x-handlebars-template">
</script>

<script id="entryCashOnDeliveryInput" type="text/x-handlebars-template">
    <div class="form-group">
        <label class="col-sm-3 control-label">{{d.l10n.yourName}}<span class="text-danger">*</span></label>
        <div class="col-sm-9">
            <input type="text"
               name="cod.na"
               class="form-control"
               data-validate
               data-required="Please input"
               size="40">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{d.l10n.yourEmail}}<span class="text-danger">*</span></label>
        <div class="col-sm-9">
            <input type="text"
               name="cod.em"
               class="form-control"
               data-validate
               data-required="Please input"
               data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
               data-pattern-message="Email don't validate"
               size="40">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{d.l10n.yourNumber}}<span class="text-danger">*</span></label>
        <div class="col-sm-9">
            <input type="text"
               name="cod.nu"
               class="form-control"
               data-validate
               data-pattern="^[0-9-+\s()]*$" data-min-length="9" data-max-length="30"
               data-required="Please input"
               size="40">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{d.l10n.address}} <span class="text-danger">*</span></label>
        <div class="col-sm-9">
            <input type="text"
               name="cod.ad"
               size="40"
               data-validate
               data-required="Please input"
               class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{d.l10n.content}} <span class="text-danger">*</span></label>
        <div class="col-sm-9">
            <textarea name="cod.co"
               size="40"
               data-validate
               data-required="Please input" class="form-control"></textarea>
        </div>
    </div>

</script>
<script id="entryPopupPaymentCashOnDelivery" type="text/x-handlebars-template">
    <div class="modal-dialog modal-contact-phone">
        <div class="modal-content">
            <div class="modal-body">
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"></span>
               
                
                {{#xif ' this.u.optionService.id && this.u.userinfo.db.id '}}

                <h3 class="m-b-10">Please input your info with Cash on delivery</h3>
                <form class="post-form form-horizontal">
                    <div class="hidden">
                        <input name="db.si" type="hidden" value="{{u.optionService.id}}">
                        <input name="db.ui" type="hidden" value="{{u.userinfo.db.id}}">
                        <input name="db.am" type="hidden" value="{{u.optionService.price}}">
                        <input name="db.ps" type="hidden" value="1">
                        <input name="db.pm" type="hidden" value="{{e.pm}}">
                    </div>
                    <div class="delivery-input"
                      data-copy-template
                      data-view-template=".modal-body .delivery-input"
                      data-template-id="entryCashOnDeliveryInput"></div>
                    <div class="row">
                        <div class="col-sm-offset-6 col-sm-3">
                            <a href="/pm?step=1" class="btn bg-color3 text-bold btn-block">{{d.l10n.btnPrev}}</a>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn bg-color3 text-bold btn-block"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-show-errors=".alert-footer.alert-error"
                                data-show-success=".alert-footer.alert"
                                data-ajax-url="<?=APIPOSTPAYMENT?>">
                                {{d.l10n.btnNext}}
                            </button>
                        </div>
                   </div>
                </form>
                {{/xif}}
            </div>
        </div>
    </div>
</script>


<script id="viewItemNews" type="text/x-handlebars-template">
    <a class="j-title text-color1" href="/<?=$seo_name["page"]["news"]?>/{{urlFriendly i.ti i.id}}">
       {{i.ti}}
    </a>
</script>


<script id="viewItemUserReceiveEmail" type="text/x-handlebars-template">
    <div class="item item-history item-user-email">
        <div class="row">
            <div class="col-xs-9">
                <p>
                {{#xif ' this.i.status == 2 '}}
                <i class="fa fa-check text-color1"></i>
                {{else}}
                <i class="fa fa-times text-color3"></i>
                {{/xif}}

                <span>{{i.email}}</span> - <span class="text-color2">{{{textFromDropdownLocal i.company_id 'yourCompany' 'id' 'name'}}}</span></p>
            </div>

            <div class="col-xs-3">
                <div class="text-right text-color4">
                 {{#unless e.onlyView}}

                    <span class="btn edit_location"
                        data-button-magic
                        data-method="get"
                        data-ajax-url="<?=APIGETEMAIL?>/{{u.userinfo.db.id}}/{{i.id}}"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="entryUserFormAddReceiveEmail"><i class="fa fa-pencil"></i> <span> {{d.l10n.btnEdit}}</span> </span>
                    
                    <span class="btn"
                        data-button-magic
                        data-method="post"
                        data-format-json="true"
                        data-ajax-url="<?=APIPOSTUSEREDIT?>"
                        data-params='{"db":{"id":"{{u.userinfo.db.id}}"} , "updateNode":"email", "email":{"del":"{{i.id}}","user_id":"{{i.user_id}}"} }'
                        data-refress-list=".item-view-receive-email"><i class="fa fa-trash-o"></i> <span> {{d.l10n.btnDelete}}</span> </span>
               
                {{/unless}}
                </div>
            </div>
        </div>
    </div>
</script>
<script id="entryUserFormAddReceiveEmail" type="text/x-handlebars-template">
    <form class="post-form user-manage-feature form-horizontal modal-dialog popup-history popup-location-company">
        <div class="modal-content">
            <div class="modal-header">
                <div class="hidden">
                    <input type="text" name="updateNode" value="email">
                    <input type="text" name="db.id" value="{{u.userinfo.db.id}}">
                    <input type="text" name="email.ui" value="{{u.userinfo.db.id}}">
                    <input type="text" name="email.id" value="{{i.id}}">
                </div>
                <div class="title">
                    <h3 class="text-color2">{{d.l10n.email}}</h3>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"></span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.email}} <span class="require">*<span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text"
                            data-validate
                            name="email.email"
                            data-validate
                            data-server="<?=APIPOSTEMAIL?>"
                            data-required="{{d.l10n.require}}"
                            {{#if i.id}}
                            data-params='{"uid":"{{u.userinfo.db.id}}","email_id":"{{i.id}}"}'
                            {{else}}
                            data-params='{"uid":"{{u.userinfo.db.id}}"}'
                            {{/if}}
                            data-key="email"
                            data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                            value="{{i.email}}"
                            class="form-control">
                        <span class="error">{{d.l10n.require}}</span>    
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.name}}
                    </label>
                    <div class="col-sm-9">
                        <input type="text"
                            data-validate
                            name="email.name"
                            value="{{i.name}}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3">
                    {{d.l10n.company}}
                  </label>
                  <div class="col-sm-9">
                    <div class="select-wrapper">
                      <select name="email.company_id"
                          data-compare="in"
                          data-key="{{i.company_id}}"
                          data-dropdown
                          data-str-key="id"
                          data-str-value="name"
                          data-index-value="{{i.company_id}}"
                          data-option-local-json="yourCompany"
                          data-object-init='{"id":"", "name":"{{d.l10n.company}}"}'
                          class="form-control">
                      </select>
                    </div>  
                  </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3">
                        {{d.l10n.status}}
                    </label>
                    <div class="col-sm-9">
                        <span class="select-wrapper">
                          <select  type="select"
                              name="email.status"
                              data-dropdown
                              placeholder="2"
                              data-index-value="{{#if i.status}}{{i.status}}{{else}}2{{/if}}"
                              data-option-local-json="jobStatus"
                              data-object-init='{"id":"", "ti":""}'
                              class="form-control">
                          </select>
                        </span>
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
                      data-refress-list=".item-view-receive-email"
                      value="{{d.l10n.btnSave}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnSave}}</span></button>

                    <span data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]"
                            class="btn bg-color5 text-uppercase">{{d.l10n.btnCancel}}</span>

            </div>
        </div>
    </form>
</script>

<script id="entryUserApplyPopupWithoutLogin" type="text/x-handlebars-template">
<div class="modal-dialog apply-signin-popup">
  <div class="modal-signup">

    <div class="modal-content">
      <div class="modal-body modal-signin no-padding">
        <span class="position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]">
          <i class="fa fa-times-circle"></i>
        </span>
        <div  data-ui-tabs
              data-ignore-hash="false"
              data-tab-class="ui-tabs apply-tabs"
              data-mobile-title="tab-title">
         
          <div class="product-des p-30">
              
              <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">{{d.l10n.registerandapply}}</h3>
                <div class="tab-content no-padding">
                 
                  <form method="post" data-upload-image="[name='db.im']" enctype="multipart/form-data" class="post-form post-form-apply">
                    
                    <div class="hidden">
                      <input type="radio" name="db.type" value="2" checked>
                     
                      <input type="text"
                              name="updateNode"
                              value="db">
                      <input type="text"
                              name="job.jo"
                              value="{{e.job.jo}}">  
                      <input type="text"
                              name="job.ei"
                              value="{{e.job.ei}}">  
                      <input type="text"
                              name="job.company_id"
                              value="{{e.job.company_id}}">                        


                    </div>
                    <header class="t-s-18 text-color1 text-bold m-b-5 text-capitalize">
                      {{d.l10n.formApplyHeaderTitle}}
                    </header>
                    <div class="cmp-more no-m-top">
                     
                      <div class="form-group">
                          <label>
                              {{d.l10n.questionOne}}
                          </label>
                           <textarea type="text"
                                 name="job.ti"
                                 class="form-control more"
                                 data-validate
                                 data-required="{{d.l10n.require}}"> </textarea>
                          <span class="error"></span>
                      </div>
                    </div>  

                    <header class="t-s-18 text-color1 text-bold m-b-5 text-capitalize">
                      {{d.l10n.personalInfo}} 
                      <a  onclick="applyjobwithfacebook();"
                          class="btn btn-xs btn-apply btn-apply-without-signin bg-color3 text-uppercase facebook-color pull-right">
                            <i class="fa fa-facebook-square"></i> {{d.l10n.signupwithfacebook}}
                      </a>
                    </header>

                    <div class="cmp-more no-m-top facebook-fill-personal-profile">
                     
                      <div class="error login-failed">
                        <div class="sms-content">&nbsp;</div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">{{d.l10n.avatar}}</label>
                          <div class="col-sm-9">
                            
                            <div class="image-preview transition b-r-4 c-center">
                                <div id="imagePreview" class="img-with-css b-cover transition" style="background:url(<?=UDATAIMAGE?>style/user-profile.png) no-repeat"></div>
                            </div>
                            <span class="message t-s-11 text-color3">{{d.l10n.oversizeimage}}</span>

                            <input id="ImageName" class="hidden" name="db.im" value="">
                            <input img-upload-size class="hidden" name="db.imsize" value="">
                            <input id="ImageBrowse" class="hidden" data-file-image type="file" name="db.im" size="30"/>
                            <div btn-upload-photo class="btn btn-xs bg-color7 m-t-5">{{d.l10n.btnUpload}}</div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">{{d.l10n.fullname}} <span class="require">*</span></label>
                          <div class="col-sm-9">
                            <input type="text"
                            name="db.name"
                            data-validate
                            class="form-control input-sm"
                            data-required="{{d.l10n.require}}"
                            value="">
                            <span class="error"></span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">{{d.l10n.email}} <span class="require">*</span></label>
                          <div class="col-sm-9">
                            <input  type="text"
                            name="db.email"
                            class="form-control input-sm"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                            data-pattern-message="{{d.l10n.requireEmailRule}}">
                            <span class="error"></span>
                          </div>
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">{{d.l10n.password}} <span class="require">*</span></label>
                          <div class="col-sm-9">
                            <input  type="password"
                            name="db.password"
                            class="form-control input-sm"
                            data-validate data-min-length="6"
                            data-required="{{d.l10n.require}}"
                            data-pattern-message="{{d.l10n.requirePasswordRule}}">
                            <span class="error"></span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">{{d.l10n.phone}} <span class="require">*</span></label>
                          <div class="col-sm-9">
                            <input type="text"
                            class="form-control input-sm"
                            name="db.phone"
                            value=""
                            data-validate
                            data-min-length="2"
                            data-required="{{d.l10n.require}}"
                            data-pattern="^[0-9-+\s()]*$" data-min-length="9" data-max-length="20"
                            data-pattern-message="{{d.l10n.requirePhoneRule}}">
                            <span class="error"></span>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <!-- END MORE -->
                    
                    <!-- JOB INFO -->
                    <header class="t-s-18 text-color1 text-bold m-b-5">
                      {{d.l10n.cvInformation}}
                    </header>

                    <div class="cmp-more no-m-top">
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.jobTitle}} <span class="require">*</span>
                          </label>
                          <div class="col-sm-9">
                            <input type="text"
                            class="form-control job-title input-sm"
                            data-validate
                            data-required="{{d.l10n.require}}"
                            placeholder="{{d.l10n.typeYourPositionYouLookingFor}}"
                            name="user_cv.db.title"
                            value="">
                            <span class="error"></span>
                            <span class="t-s-12">{{d.l10n.exJobTitle}}</span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.yearOfExperience}} <span class="require">*</span>
                          </label>
                          <div class="col-sm-9">
                            <div data-radio class="edit-show">
                              {{#each dropdown.yearOfExperience}}
                              <label>
                                <input
                                type="radio"
                                value="{{this.id}}"
                                name="user_cv.db.experience"
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
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.jobCategoriesWantToJoin}} <span class="require">*</span>
                          </label>
                          <div class="col-sm-9">
                            <div data-checkbox-validate class="edit-show">
                              {{#each dropdown.menuStructure}}
                              {{#xif ' this.opp == 3 '}}
                              <div class="checkbox btn-checkbox b-r-4">
                                <input class="b-r-4"
                                name="user_cv.db.category.{{this.id}}"
                                type="checkbox"
                                data-key-name="user_cv.db.category"
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
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.jobType}} <span class="require">*</span>
                          </label>
                          <div data-checkbox-validate class="col-sm-9">
                            {{#each dropdown.jobTime}}
                            <div class="checkbox btn-checkbox b-r-4">
                              <input class="b-r-4"
                              name="user_cv.db.type.{{this.id}}"
                              type="checkbox"
                              data-key-name="user_cv.db.type"
                              value="{{this.id}}">
                              <span class="checkbox-style"></span>
                              <span class="tx">{{this.ti}}</span>
                            </div>
                            {{/each}}
                            <span class="error">{{d.l10n.require}}</span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.jobLevel}} <span class="require">*</span>
                          </label>
                          <div data-checkbox-validate class="col-sm-9">
                            {{#each dropdown.jobLevel}}
                            <div class="checkbox btn-checkbox b-r-4">
                              <input  class="b-r-4"
                                      name="user_cv.db.level.{{this.id}}"
                                      type="checkbox"
                                      data-key-name="user_cv.db.level"
                                      value="{{this.id}}">
                              <span class="checkbox-style"></span>
                              <span class="tx">{{this.ti}}</span>
                            </div>
                            {{/each}}
                            <span class="error">{{d.l10n.require}}</span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.languages}}
                          </label>
                          <div data-checkbox-validate class="col-sm-9">
                            {{#each dropdown.languageOption}}
                            <div class="checkbox btn-checkbox b-r-4">
                              <input class="b-r-4"
                              name="user_cv.db.lang.{{this.id}}"
                              type="checkbox"
                              data-key-name="user_cv.db.lang"
                              value="{{this.id}}">
                              <span class="checkbox-style"></span>
                              <span class="tx">{{this.ti}}</span>
                            </div>
                            {{/each}}
                            <span class="error">{{d.l10n.require}}</span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3">
                            {{d.l10n.keySkills}}
                          </label>
                          <div class="col-sm-9">
                            <textarea
                            name="user_cv.db.skill"
                            data-required="{{d.l10n.require}}"
                            class="form-control more">{{u.user_cv.db.skill}}</textarea>
                            <span class="error"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="form-group">
                     <input type="checkbox"
                        name="captcha"
                        value="1"
                        data-validate
                        class="form-control boxcaptcha"
                        data-required="{{d.l10n.require}}">
                     <div class="g-recaptcha-outer b-r-4" data-required="{{d.l10n.requireEmail}}">
                         <div class="g-recaptcha-inner">
                             <div id="captcha" class="g-recaptcha" data-sitekey="<?=SITEKEYCAPTCHA?>"></div>
                         </div>
                     </div>
                     <span class="error">{{d.l10n.require}}</span>
                   </div>
                    <div class="form-group p-10">
                      <div class="row">
                        <div class="col-sm-12 text-right">
                          <span data-closet-toggle-class="in"
                            data-object=".modal"
                            data-empty-object="[data-quick-view-item1]"
                            class="btn bg-color5 text-uppercase"><i class="fa fa-times"></i>
                            <span>{{d.l10n.btnCancel}}</span>
                          </span>
                          <button type="submit"
                                  id="applywithoutsignin"
                                  data-button-magic
                                  data-params-form=".post-form-apply"
                                  data-format-json="true"
                                  data-ajax-url="<?=APIPOSTAPPLYSIGNUP?>"
                                  data-redirect="."
                                  
                                  data-show-success=".alert-footer.alert"
                                  data-show-errors=".alert-footer.alert-error"

                                  data-special="showInfoPost"
                                  data-element-value-input="[data-value-input]"
                                  data-show-hide=".signup-info-review,[data-hidden-info-from-ajax]"
                                  class="btn bg-color3 text-uppercase"
                                  value="{{d.l10n.signup}}">
                                  <i class="fa fa-file-text-o"></i> <span>{{d.l10n.btnApply}}</span>
                          </button>
                        </div>
                      </div>

                    </div>

                  </form>
                </div>
              </div>

              <div class="item-content">
                <h3 class="icon tab-title hidden-sm hidden-md hidden-lg">
                  {{d.l10n.signin}} 
                </h3>
                <div class="tab-content">
                  <form method="post" class="post-form post-form-signin">
                    <div class="login-error login-failed" data-fade="4500">
                      <div class="sms-content"></div>
                    </div>

                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <input  type="text"
                                  name="email"
                                  class="form-control"
                                  data-validate
                                  {{d.l10n.requireTitle}}
                                  data-required="{{d.l10n.require}}"
                                  data-pattern="^[\w._%+-]{2,}@[\w.-]{1,}\.[\w]{2,}$"
                                  data-pattern-message="{{d.l10n.requireEmailRule}}"
                                  placeholder="{{d.l10n.email}}">
                                  <span class="error"></span>
                        </div>
                      </div>
                      <div class="col-sm-4 hidden-xs">
                         <button type="submit"
                                  data-button-magic
                                  data-params-form=".post-form-signin"
                                  data-format-json="true"
                                  data-ajax-url="<?=APIPOSTUSERSIGNIN?>"
                                  data-redirect="."
                                  data-elm-data='{
                                  "missingSession":"true",
                                  "hideObj":"[data-quick-view-item1]"
                                  }'
                                  data-show-hide="[data-modal-quick-view]"
                                  data-show-success=".alert-footer.alert"
                                  data-show-errors=".login-error"
                                  class="btn btn-block bg-color2 text-uppercase form-control"
                                  value="{{d.l10n.signin}}">
                                  <i class="fa fa-sign-in fa-fw"></i> 
                                  <span>{{d.l10n.signin}}</span>
                          </button>
                         
                      </div>  
                    </div>

                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group m-b-5" >
                          <input  type="password"
                                  name="password"
                                  class="form-control"
                                  data-validate data-min-length="6"
                                  data-required="{{d.l10n.require}}"
                                  data-pattern-message="{{d.l10n.requirePasswordRule}}"
                                  placeholder="{{d.l10n.password}}">
                                  <span class="error"></span>
                        </div>

                        <div class="form-group">
                          <div class="row t-s-12">
                            <div class="col-xs-6">
                              <span class="checkbox checkbox-left">
                                <input name="rememberlogin"
                                type="checkbox"
                                value="1">
                                <span class="checkbox-style"></span>
                                {{d.l10n.rememberLogin}}
                              </span>
                            </div>
                            <div class="col-xs-6 text-right">
                              <a href="/pw"
                                data-button-magics
                                data-view-template-local="true"
                                data-view-template="[data-quick-apply-job]"
                              data-template-id="entryFormForgotPassword">{{d.l10n.forgotPassword}}</a>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-sm-4">
                        <button type="submit"
                                 data-button-magic
                                 data-params-form=".post-form-signin"
                                 data-format-json="true"
                                 data-ajax-url="<?=APIPOSTUSERSIGNIN?>"
                                 data-redirect="."
                                 data-elm-data='{
                                 "missingSession":"true",
                                 "hideObj":"[data-quick-view-item1]"
                                 }'
                                 data-show-hide="[data-modal-quick-view]"
                                 data-show-success=".alert-footer.alert"
                                 data-show-errors=".login-error"
                                 class="btn btn-block bg-color2 text-uppercase form-control hidden-lg hidden-sm hidden-md"
                                 value="{{d.l10n.signin}}">
                                 <i class="fa fa-sign-in fa-fw"></i> 
                                 <span>{{d.l10n.signin}}</span>
                         </button>

                        <a class="btn btn-block text-uppercase facebook-color" onclick="loginFB();">
                          <i class="fa fa-facebook-square"></i>&nbsp;Sign in with facebook
                        </a>
                      </div>  
                    </div>

                    
                  </form>

                </div>
              </div>

            </div>
            
          
      </div>
    </div>
  </div>
</div>
</div>   
</script>
<script id="popupWhatIsPage" type="text/x-handlebars-template">
<div class="modal-dialog what-is-page">
  <div class="modal-signup">
    <div class="modal-content">
      <div class="modal-body modal-signin no-padding">
      <span class="position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]">
        <i class="fa fa-times-circle"></i>
      </span>
      <img class="img-responsive" src="/media/images/style/thue-page-small.gif">
      </div>
    </div>
  </div>
</div>      
</script>
<script id="popupHowtoCreateAPage" type="text/x-handlebars-template">
<div class="modal-dialog how-create-page">
  <div class="modal-signup">
    <div class="modal-content">
      <div class="modal-body modal-signin no-padding">
      <span class="position-right" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item1]">
        <i class="fa fa-times-circle"></i>
      </span>
      <iframe width="560" 
              height="315" 
              src="https://www.youtube.com/embed/{{e.youtube}}?vq=hd1080&autoplay=1" 
              frameborder="0" 
              allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>  
</script>