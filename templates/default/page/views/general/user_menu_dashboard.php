<?php if($sessionUserId):?>

<?php $extra_elm_data = isset($strFeature) ? ',"userapply" : '."1" : '';?>

<div class="user-menu-action m-t-15"
        data-elm-data='{"profile":"1" <?=$extra_elm_data?>}'
        data-copy-template
        data-view-template=".user-menu-action"
        data-template-id="entryUserMenuSetting"></div>
<?php endif;?>