<div class="row">
    <div class="col-xs-6">
        <form method="post" class="post-form" data-hidden-info-from-ajax>
            <div class="error login-failed"><div class="sms-content"></div></div>
            <div class="form-group">
                <input type="text"
                       name="username"
                       class="form-control"
                       data-validate
                       data-required="<?=$language["requireContent"];?>"
                       placeholder="<?=$language["username"]?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <input type="password"
                       name="password"
                       class="form-control"
                       data-validate data-min-length="6"
                       data-required="<?=$language["requirePassword"];?>"
                       data-pattern-message="<?=$language["requirePasswordRule"];?>"
                       placeholder="<?=$language["password"]?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <input type="submit"
                               data-button-magic
                               data-params-form=".post-form"
                               data-format-json="true"
                               data-ajax-url="<?=APIPOSTADMINSIGNIN?>"
                               data-redirect="<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:"/admincp?fun=config"?>"
                               data-show-errors=".login-failed"
                               class="btn btn-primary"
                               value="<?=$language["signin"]?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
