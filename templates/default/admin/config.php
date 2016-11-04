<?php

$about = isset($informationConfig["config"]["about"])? $informationConfig["config"]["about"] : null;
$seo = isset($informationConfig["config"]["seo"])? $informationConfig["config"]["seo"]: null;
$order = isset($informationConfig["config"]["order"])? $informationConfig["config"]["order"] : null;
$account = isset($informationConfig["config"]["account"])? $informationConfig["config"]["account"] : null;
$social = isset($informationConfig["config"]["social"])? $informationConfig["config"]["social"] : null;


$strDescription = isset($about["description"]) && count($about["description"]) ? $about["description"] : "";
$deliveryText = isset($about["delivery"]) && count($about["delivery"]) ? $about["delivery"] : "";
$pageNotfound = isset($about["pageNotfound"]) && count($about["pageNotfound"]) ? $about["pageNotfound"] : "";

$seoTitle = isset($seo["title"]) && count($seo["title"]) ? $seo["title"] : "";
$seoKeyword = isset($seo["keyword"]) && count($seo["keyword"]) ? $seo["keyword"] : "";
$seoDescription = isset($seo["description"]) && count($seo["description"]) ? $seo["description"] : "";
$googleAnalyticsCode = isset($seo["googleAnalyticsCode"]) && count($seo["googleAnalyticsCode"]) ? $seo["googleAnalyticsCode"] : "";

$orderNote = isset($order["note"]) && count($order["note"]) ? $order["note"] : "";
$orderSuccess = isset($order["success"]) && count($order["success"]) ? $order["success"] : "";

$accountUsername = isset($account["username"]) && count($account["username"]) ? $account["username"] : "phpvnn";

$socialSkype = isset($social["skype"]) && count($social["skype"]) ? $social["skype"] : "";
$socialFacebook = isset($social["facebook"]) && count($social["facebook"]) ? $social["facebook"] : "";
$socialHotline = isset($social["hotline"]) && count($social["hotline"]) ? $social["hotline"] : "";

?>
<div class="admin-title">
    <h2><?=$language["configWeb"]?></h2>
</div>
<div class="config-page">
    <div data-ui-tabs data-tab-class="ui-tabs" data-mobile-title="tab-title">
        <div class="product-des">
            <div class="item-content">
                <h3 class="icon tab-title"><?=$language["aboutUs"]?></h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form post-form-about edit-disabled">
                        <span data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"
                        class="icon-edit-cancel icon-lg1 position-right"></span>
                        <input type="hidden" name="config.type" value="about">
                        <div class="form-group">
                            <label><?=$language["description"]?></label>
                            <div class="form-control-static"><?=$strDescription?></div>
                            <div class="edit-show">
                                <textarea name="about.description"
                                    class="form-control mce-editor"><?=$strDescription?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?=$language["pageNotfound"]?></label>
                            <div class="form-control-static"><?=$pageNotfound?></div>
                            <div class="edit-show">
                                <textarea name="about.pageNotfound"
                                    class="form-control mce-editor"><?=$pageNotfound?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?=$language["deliveryText"]?></label>
                            <div class="form-control-static"><?=$deliveryText?></div>
                            <div class="edit-show">
                                <textarea name="about.delivery"
                                    class="form-control mce-editor"><?=$deliveryText?></textarea>
                            </div>
                        </div>
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
                                value="<?=$language["update"]?>">
                            <button
                                onclick="location.reload();"
                                class="btn btn-second"><?=$language["reset"]?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title"><?=$language["orderPage"]?></h3>
                <div class="tab-content">
                    <form method="post"
                        class="edit-add-item post-form edit-disabled">
                        <span data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"
                        class="icon-edit-cancel icon-lg1 position-right"></span>
                        <input type="hidden" name="config.type" value="order">
                        <div class="fieldset">
                            <div class="form-group">
                                <label><?=$language["orderSuccess"]?></label>
                                <div class="form-control-static"><?=$orderSuccess?></div>
                                <div class="edit-show">
                                    <textarea name="order.success"
                                        class="form-control mce-editor"><?=$orderSuccess?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="fieldset">
                            <div class="form-group">
                                <label><?=$language["orderNote"]?></label>
                                <div class="form-control-static"><?=$orderNote?></div>
                                <div class="edit-show">
                                    <textarea name="order.note"
                                        class="form-control"><?=$orderNote?></textarea>
                                </div>
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
                                    value="<?=$language["update"]?>">
                                <button
                                    onclick="location.reload();"
                                    class="btn btn-second"><?=$language["reset"]?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title"><?=$language["seo"]?></h3>
                <div class="tab-content" >
                    <form method="post"
                        class="post-form post-form-about edit-add-item edit-disabled">
                        <span data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"
                        class="icon-edit-cancel icon-lg1 position-right"></span>
                        <input type="hidden" name="config.type" value="seo">
                        <div class="form-group">
                            <label>Google Analytics Code</label>
                            <div class="form-control-static"><?=$googleAnalyticsCode?></div>
                            <input name="seo.googleAnalyticsCode" class="form-control" value="<?=$googleAnalyticsCode?>" />
                        </div>
                        <div class="form-group">
                            <label><?=$language["title"]?></label>
                            <div class="form-control-static"><?=$seoTitle?></div>
                            <textarea name="seo.title"
                                    class="form-control"><?=$seoTitle?></textarea>
                        </div>
                        <div class="form-group">
                            <label><?=$language["description"]?></label>
                            <div class="form-control-static"><?=$seoDescription?></div>
                            <textarea name="seo.description"
                                    class="form-control"><?=$seoDescription?></textarea>
                        </div>
                        <div class="form-group">
                            <label><?=$language["keyword"]?></label>
                            <div class="form-control-static"><?=$seoKeyword?></div>
                            <textarea name="seo.keyword"
                                    class="form-control"><?=$seoKeyword?></textarea>
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
                                    value="<?=$language["update"]?>">
                                <button
                                    onclick="location.reload();"
                                    class="btn btn-second"><?=$language["reset"]?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title"><?=$language["account"]?></h3>
                <div class="tab-content" >
                    <form method="post"
                        class="post-form post-form-about edit-add-item edit-disabled">
                        <span data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"
                        class="icon-edit-cancel icon-lg1 position-right"></span>
                        <input type="hidden" name="config.type" value="account">
                        <div class="form-group">
                            <label><?=$language["username"]?></label>
                            <div class="form-control-static"><?=$accountUsername?></div>
                            <input type="text"
                                    name="account.username"
                                    class="form-control"
                                    data-validate
                                    data-required="<?=$language["requireTitle"];?>"
                                    value="<?=$accountUsername?>">
                        </div>
                        <div class="form-group">
                            <label><?=$language["passwordCurrent"]?></label>
                            <div class="form-control-static">******</div>
                            <input type="password"
                                    name="account.passwordOld"
                                    data-validate data-min-length="6"
                                    data-required="<?=$language["requirePassword"];?>"
                                    data-pattern-message="<?=$language["requirePasswordRule"];?>"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                        <div class="row edit-show">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label><?=$language["passwordNew"]?></label>
                                    <input type="password"
                                            name="account.passwordNew"
                                            data-validate
                                            data-min-length="6"
                                            data-required="<?=$language["requirePassword"];?>"
                                            data-pattern-message="<?=$language["requirePasswordRule"];?>"
                                            data-compare="#accountPasswordConfirm"
                                            data-compare-message="Password don't match"
                                            id="accountPasswordNew"
                                            class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label><?=$language["passwordConfirm"]?></label>
                                    <input type="password"
                                            name="account.passwordConfirm"
                                            data-validate
                                            data-required="<?=$language["requirePassword"];?>"
                                            data-compare="#accountPasswordNew"
                                            data-compare-message="Password don't match"
                                            id="accountPasswordConfirm"
                                            class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="fieldset">
                            <div class="edit-show form-group">
                                <input type="submit"
                                    data-button-magic
                                    data-params-form=".post-form"
                                    data-format-json="true"
                                    data-ajax-url="<?=APIPOSTCONFIGPAGE?>"
                                    data-redirects="."
                                    data-show-success=".alert"
                                    data-show-errors=".alert .sms-content"
                                    class="btn btn-primary"
                                    value="<?=$language["update"]?>">
                                <button
                                    onclick="location.reload();"
                                    class="btn btn-second"><?=$language["reset"]?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-content">
                <h3 class="icon tab-title"><?=$language["social"]?></h3>
                <div class="tab-content" >
                    <form method="post"
                        class="post-form post-form-about edit-add-item edit-disabled">
                        <span data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"
                        class="icon-edit-cancel icon-lg1 position-right"></span>
                        <input type="hidden" name="config.type" value="social">
                        <div class="form-group">
                            <label>Skype</label>
                            <div class="form-control-static"><?=$socialSkype?></div>
                            <input type="text" name="social.skype" class="form-control" value="<?=$socialSkype?>">
                        </div>
                        <div class="form-group">
                            <label>Facebook link</label>
                            <div class="form-control-static"><?=$socialFacebook?></div>
                            <input type="text" name="social.facebook" class="form-control" value="<?=$socialFacebook?>">
                        </div>
                        <div class="form-group">
                            <label>Hotline</label>
                            <div class="form-control-static"><?=$socialHotline?></div>
                            <input type="text" name="social.hotline" class="form-control" value="<?=$socialHotline?>">
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
                                    value="<?=$language["update"]?>">
                                <button
                                    onclick="location.reload();"
                                    class="btn btn-second"><?=$language["reset"]?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="alert text-left" data-fade="2000"> <div class="sms-content"><?=$language["updateSuccess"]?></div> </div>
</div>
