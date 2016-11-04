<?php
$numberItem = isset($_GET["item"])? $_GET["item"]:10;
$strLinkPage = '?fun=blog';
$strOptionItem = null;
foreach ($language["itemNumberOption"] as $key=>$value) {
    $strOptionItem .='<li><a href="'.$strLinkPage.'&item='.$key.'">'.$value.'</a></li>';
}
?>
<div class="item-view-more admin-list"
    data-view-list-by-handlebar
    data-init-button-magic=".item [data-button-magic]"
    data-url="<?=APIGETBLOG;?>"
    data-method="get"
    data-show-page="10"
    data-show-item="<?=$numberItem?>"
    data-show-all="false"
    data-scroll-view="false"
    data-form-filter=".form-filter"
    data-object-reverse="true"
    data-template-id="entryBlogItem" >
    <div class="admin-title">
        <div class="row">
            <div class="col-xs-5">
                <h2><?=$language["blogManage"]?></h2>
            </div>
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
                data-template-id="entryBlogAdd"><?=$language["add"];?> + </button>
            </div>
        </div>
    </div>
    <div class="head-title">
        <div class="row">
            <div class="col-xs-5"><label><?=$language["title"]?></label></div>
            <div class="col-xs-3"><label><?=$language["category"]?></label></div>
            <div class="col-xs-2"><label><?=$language["status"]?></label></div>
            <div class="col-xs-1"><label><?=$language["order"]?></label></div>
            <div class="col-xs-1 text-right"><label><?=$language["update"]?></label></div>
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
                                    placeholder="<?=$language["id"]?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="form-group">
                                <input type="text"
                                    name="ti"
                                    data-compare="text in"
                                    placeholder="<?=$language["title"]?>"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="form-group">
                        <select name="cat"
                            data-dropdown
                            data-object-init='{"id":"", "ti":"<?=$language["viewAll"]?>"}'
                            data-option-local-json="menuStructure"
                            data-params="opp=2"
                            data-compare="in"
                            data-option-base-on-url="cat"
                            class="form-control">
                            <option value=""><?=$language["viewAll"]?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <select name="st"
                            data-dropdown
                            data-object-init='{"id":"", "ti":"<?=$language["viewAll"]?>"}'
                            data-option-local-json="blogStatus"
                            data-compare="equal"
                            data-option-base-on-url="st"
                            class="form-control">
                            <option value=""><?=$language["viewAll"]?></option>
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
            <button class="btn btn-default form-add btn-add-a-item"
            data-button-magic
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
            data-template-id="entryBlogAdd"><?=$language["add"];?> + </button>
        </div>
    </div>
</div>
