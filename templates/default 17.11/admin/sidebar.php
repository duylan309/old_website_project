<?php
$column = isset($informationConfig["config"]["column"])? $informationConfig["config"]["column"] : null;
$strColumnLeft = isset($column["left"]) && count($column["left"]) ? $column["left"] : null;
$strColumnMain = isset($column["main"]) && count($column["main"]) ? $column["main"] : null;
$strColumnRight = isset($column["right"]) && count($column["right"]) ? $column["right"] : null;

$numberItem = isset($_GET["item"])? $_GET["item"]:10;
$strLinkPage = '?fun=sidebar';
$strOptionItem = null;
foreach ($language["itemNumberOption"] as $key=>$value) {
    $strOptionItem .='<li><a href="'.$strLinkPage.'&item='.$key.'">'.$value.'</a></li>';
}
?>
<div class="layout-page">
    <div data-ui-tabs data-tab-class="ui-tabs" data-mobile-title="tab-title">
        <div class="product-des">
            <div class="item-content"
                data-remove-view-list="data-view-list-by-handlebar-in-tab"
                data-view-list="[data-view-list-by-handlebar-in-tab]">
                <h3 class="icon tab-title"><?=$language["sidebar"]?></h3>
                <div class="tab-content" >
                    <div class="item-view-more item-view-sidebar admin-list"
                        data-view-list-by-handlebar-in-tab
                        data-init-button-magic=".item [data-button-magic]"
                        data-url="<?=APIGETCONFIGSIDEBAR;?>"
                        data-method="get"
                        data-show-page="10"
                        data-show-item="<?=$numberItem?>"
                        data-show-all="false"
                        data-scroll-view="false"
                        data-form-filter=".form-filter"
                        data-object-reverse="true"
                        data-template-id="entrySidebarItem" >
                        <div class="admin-title">
                            <div class="row">
                                <div class="col-xs-5">
                                    <?php if (isset($language["itemNumberOption"][$numberItem]) ) {?>
                                    <div class="item-of-page">
                                        <label data-object=".item-of-page"
                                                data-closet-toggle-class="active"><?=$language["itemNumberOption"][$numberItem]?></label>
                                        <?php echo '<ul>'.$strOptionItem.'</ul>';?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <button class="btn btn-default form-add btn-add-a-item"
                                    data-button-magic
                                    data-view-template-local="true"
                                    data-view-template="[data-quick-view-item]"
                                    data-template-id="entrySidebarUpdate"><?=$language["add"];?> + </button>
                                </div>
                            </div>
                        </div>
                        <div class="view-items" data-content><div class="style-loadding">...</div></div>
                        <div class="row">
                            <div class="col-xs-10">
                                <div data-footer></div>
                            </div>
                            <div class="col-xs-2 text-right">
                                <button class="btn btn-default form-add btn-add-a-item"
                                data-button-magic
                                data-view-template-local="true"
                                data-view-template="[data-quick-view-item]"
                                data-template-id="entrySidebarUpdate"><?=$language["add"];?> + </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-content"
                data-remove-view-list="data-view-list-by-handlebar-in-tab"
                data-view-list="[data-view-list-by-handlebar-in-tab]">
                <h3 class="icon tab-title"><?=$language["configColumn"]?></h3>
                <div class="tab-content" >
                    <form method="post"
                        class="post-form post-form-about edit-add-item edit-disabled">
                        <span data-closet-toggle-class="edit-enabled"
                        data-object=".edit-disabled"
                        class="icon-edit-cancel icon-lg1 position-right"></span>
                        <input type="hidden" name="config.type" value="column">
                        <div class="form-group">
                            <label>Custom class column left</label>
                            <div class="form-control-static"><?=$strColumnLeft?></div>
                            <input name="column.left" class="form-control" value="<?=$strColumnLeft?>" />
                        </div>
                        <div class="form-group">
                            <label>Custom class column main</label>
                            <div class="form-control-static"><?=$strColumnMain?></div>
                            <input name="column.main" class="form-control" value="<?=$strColumnMain?>" />
                        </div>
                        <div class="form-group">
                            <label>Custom class column right</label>
                            <div class="form-control-static"><?=$strColumnRight?></div>
                            <input name="column.right" class="form-control" value="<?=$strColumnRight?>" />
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
            <!-- Tab 2-->
        </div>
    </div>
    <div class="alert text-left" data-fade="2000"> <div class="sms-content"><?=$language["updateSuccess"]?></div> </div>
</div>
