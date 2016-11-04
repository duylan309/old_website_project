<script id="entryUserManageBlog" type="text/x-handlebars-template">
    <div class="item-view-more admin-list"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-url="<?=APIGETBLOG;?>"
        data-params="uid={{u.userinfo.db.id}}"
        data-method="get"
        data-show-page="10"
        data-show-item="20"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-object-reverse="true"
        data-template-id="entryBlogItem" >
        <div class="row admin-title">
            <div class="col-xs-9">
                <h2>{{d.l10n.blogManage}}</h2>
            </div>
            <div class="col-xs-3 text-right">
                <button class="btn btn-warning form-add btn-add-a-item"
                data-button-magic
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entryBlogAdd">{{d.l10n.btnAdd}} + </button>
            </div>
        </div>
        <div class="head-title">
            <div class="row">
                <div class="col-xs-4"><label>{{d.l10n.title}}</label></div>
                <div class="col-xs-5"><label>{{d.l10n.content}}</label></div>
                <div class="col-xs-2"><label>{{d.l10n.status}}</label></div>
                <div class="col-xs-1 text-right"><label>&nbsp;</label></div>
            </div>
        </div>
        <div class="content-filter">
            <form class="form-filter">
                <div class="row">
                    <div class="col-xs-4">
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
                    <div class="col-xs-5">
                        <div class="form-group">
                            <input type="text"
                                name="fn"
                                data-compare="text in"
                                placeholder="{{d.l10n.content}}"
                                class="form-control">
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
                data-template-id="entryBlogAdd">{{d.l10n.btnAdd}} + </button>
            </div>
        </div>
    </div>
</script>
<script id="entryBlogItem" type="text/x-handlebars-template">
    <div class="item item-blog item-status-{{i.st}}">
        <div class="row">
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-xs-3">{{i.id}}</div>
                    <div class="col-xs-9">
                        {{i.ti}}

                    </div>
                </div>
            </div>
            <div class="col-xs-5">
                <span>{{i.nf}}</span>
            </div>
            <div class="col-xs-2">
                {{#if i.st}}
                <span>{{{textFromDropdownLocal i.st 'blogStatus' 'id' 'ti'}}}</span>
                {{/if}}
            </div>
            <div class="col-xs-1 btn-control text-right">
                <span
                    class="icon-pencil icon-lg"
                    title="Edit id {{i.id}}"
                    data-button-magic
                    data-method="get"
                    data-ajax-url="<?=APIGETBLOG?>/{{i.id}}"
                    data-view-template="[data-quick-view-item]"
                    data-template-id="entryBlogEdit"></span>
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
            </div>
        </div>
    </div>
</script>

<script id="entryBlogAdd" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.blogManage}} :: {{d.l10n.btnAdd}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item]"></span>
            </div>
            <div class="modal-body">
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
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.title}}
                        </label>
                        <div class="col-sm-10">
                            <input  type="text" name="db.ti"
                                    data-validate
                                    data-required="{{d.l10n.requireTitle}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="form-group hidden">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.category}}
                        </label>
                        <div class="col-sm-10">
                            <select name="menulist"
                                    class="form-control"
                                    data-multiselect-box
                                    data-multi-selected="{{i.db.me}}"
                                    data-key-name="db.me"
                                    data-validate
                                    data-requireds="{{d.l10n.requireContent}}"
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

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            <?=$language["content"]?>
                        </label>
                        <div class="col-sm-10">
                            <textarea name="db.nf"
                                    class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTBLOG?>"
                                data-show-success=".modal-footer .alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-redirect="."
                                class="btn btn-primary"
                                value="{{d.l10n.btnAdd}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnAdd}}</span></button>
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

<script id="entryFormBlogAdd" type="text/x-handlebars-template">
    <div class="i-blog p-5">
        <form method="post"
            class="post-form">
            <div class="hidden">
                <input type="text"
                    class="form-control"
                    name="db.ui"
                    value="{{u.userinfo.db.id}}">
                {{#if e.cid}}
                <input type="text"
                    class="form-control"
                    name="db.ci"
                    value="{{e.cid}}">
                {{/if}}
                <input type="text"
                    class="form-control"
                    name="updateNode"
                    value="db">
            </div>

            <div class="form-group hidden">
                <input  type="text" name="db.ti"
                    data-required="{{d.l10n.requireTitle}}"
                    class="form-control"
                    placeholder="{{d.l10n.title}}">
            </div>

            <div class="form-group">
                <textarea name="db.nf"
                    class="form-control no-border no-shadow no-p"
                    data-validate
                    data-required="{{d.l10n.requireContent}}"
                    placeholder="{{d.l10n.whatnews}}"></textarea>
                <span class="error"></span>
            </div>
            <hr class="no-margin m-b-10">
            <div class="form-group no-m-bottom m-t-10">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8 col-sm-3 col-sm-offset-9">
                        <button type="submit"
                            data-button-magic
                            data-params-form=".post-form"
                            data-format-json="true"
                            data-ajax-url="<?=APIPOSTBLOG?>"
                            data-show-success=".modal-footer .alert"
                            data-show-errors=".modal.signin-missing-session"
                            data-redirect="."
                            class="btn bg-color1 text-uppercase btn-nf pull-right"><i class="fa fa-check"></i> <span>{{d.l10n.btnPost}}</span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</script>

<script id="entryBlogEditBasic" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit blog-update">
        <div class="modal-content">

            <div class="modal-body">
                    <div class="product-des">
                        <div class="item-content">
                            <div class="tab-content">
                                <div class="update-item-image"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"/api/post/image/blog",
                                    "urlPostDel":"/api/post/imagedelete",
                                    "imgName":"{{i.db.im}}",
                                    "maxSize":"100000",
                                    "imgPath":"<?=FOLDERIMAGEBLOG?>",
                                    "module":"blog",
                                    "ui":"{{u.userinfo.db.id}}",
                                    "disabledDelete":"1",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-item-image"
                                    data-template-id="entryItemImage">
                                </div>
                                <form method="post"
                                    class="form-horizontal post-form">
                                    <div class="hidden">
                                        <input  type="text"
                                                    name="db.id"
                                                    value="{{i.db.id}}">
                                        <input  type="text"
                                                    name="db.ui"
                                                    value="{{i.db.ui}}">
                                        <input type="text"
                                                name="updateNode"
                                                value="db">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.content}}
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="db.nf"
                                                    class="form-control">{{i.db.nf}}</textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status" value="2" />
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTBLOG?>"
                                                data-show-success=".blog-update .alert-footer.alert"
                                                data-show-errors=".blog-update .alert-footer.alert-error"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn bg-color3"
                                                value="{{d.l10n.btnUpdate}}"><i class="fa fa-check"></i> {{d.l10n.btnUpdate}}</button>

                                               <span class="btn btn-default" data-closet-toggle-class="in" data-object=".modal" data-empty-object="[data-quick-view-item]"><i class="fa fa-times"></i> {{d.l10n.btnClose}}</span>

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>


                </div>
            </div>

        </div>
    </div>

</script>

<script id="entryBlogEdit" type="text/x-handlebars-template">
    <div class="modal-dialog modal-menu-edit">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.btnUpdate}}: {{i.db.ti}}</h2>
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
                                    data-elm-data='{"urlPost":"/api/post/image/blog",
                                    "urlPostDel":"/api/post/imagedelete",
                                    "imgName":"{{i.db.im}}",
                                    "maxSize":"100000",
                                    "imgPath":"<?=FOLDERIMAGEBLOG?>",
                                    "module":"blog",
                                    "ui":"{{u.userinfo.db.id}}",
                                    "disabledDelete":"1",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-item-image"
                                    data-template-id="entryItemImage">
                                </div>
                                <form method="post"
                                    class="form-horizontal post-form">
                                    <div class="hidden">
                                        <input  type="text"
                                                    name="db.id"
                                                    value="{{i.db.id}}">
                                        <input  type="text"
                                                    name="db.ui"
                                                    value="{{i.db.ui}}">
                                        <input type="text"
                                                name="updateNode"
                                                value="db">
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
                                    <div class="form-group hidden">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.category}}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="categorylist"
                                                    class="form-control"
                                                    data-multiselect-box
                                                    data-multi-selected="{{i.db.me}}"
                                                    data-key-name="db.me"
                                                    data-validate
                                                    data-requireds="{{d.l10n.requireContent}}"
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
                                    <?php if(isset($templatesView["tagBlog"]) && $templatesView["tagBlog"] ) {
                                        echo $templatesView["tagBlog"];
                                    } ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{d.l10n.content}}
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="db.nf"
                                                    class="form-control">{{i.db.nf}}</textarea>
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
                                                data-index-value="{{i.db.st}}"
                                                class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTBLOG?>"
                                                data-show-success=".modal-footer .alert"
                                                data-show-errors=".modal.signin-missing-session"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
                                        </div>
                                    </div>
                                </form>
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
                                            <?=$language["description"]?>
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="more.description"
                                                    data-validate
                                                    data-required="{{d.l10n.requireContent}}"
                                                    class="form-control mce-editor">{{i.more.description}}</textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit"
                                                data-button-magic
                                                data-params-form=".post-form"
                                                data-format-json="true"
                                                data-ajax-url="<?=APIPOSTBLOG?>"
                                                data-show-success=".modal-footer .alert"
                                                data-show-errors=".modal.signin-missing-session"
                                                data-show-hide=".btn-add-a-item,.edit-add-item"
                                                data-refress-list=".item-view-more"
                                                class="btn btn-primary"
                                                value="{{d.l10n.btnUpdate}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php if(isset($templatesView["moreDetailBlog"]) && $templatesView["moreDetailBlog"]) {?>
                        <div class="item-content"
                                    data-remove-view-list="data-view-list-by-handlebar-in-tab"
                                    data-view-list="[data-view-list-by-handlebar-in-tab]">
                            <h3 class="icon tab-title">{{d.l10n.moreDetail}}</h3>
                            <div class="tab-content">
                                <div class="item-view-more admin-list"
                                    data-view-list-by-handlebar-in-tab
                                    data-ignore-hash="true"
                                    data-init-button-magic=".item-menu-detail [data-button-magic]"
                                    data-url="<?=APIGETBLOG?>/{{i.db.id}}?detail"
                                    data-method="get"
                                    data-show-page="10"
                                    data-show-item="10"
                                    data-show-all="false"
                                    data-scroll-view="false"
                                    data-template-id="entryBlogItemDetail" >
                                    <div class="view-items" data-content><div class="style-loadding">...</div></div>
                                    <div data-footer></div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-default form-add btn-add-a-item"
                                    data-toggle-class="hidden, hidden"
                                    data-reset-form-id="[data-form-edit-add-item]"
                                    data-toggle-class-object=".edit-add-item, .btn-add-a-item"
                                    data-show-hide=".edit-add-item .form-add,.edit-add-item .form-edit">{{d.l10n.btnAdd}} + </button>
                                </div>
                                <div class="hidden relative edit-add-item form-edit">
                                    <span class="icon-cancel-circle icon-lg1 position-right"
                                        data-toggle-class="hidden, hidden"
                                        data-toggle-class-object=".edit-add-item, .btn-add-a-item"></span>
                                    <form class="form-horizontal post-form" data-form-edit-add-item>
                                        <div class="hidden">
                                            <input  type="text"
                                                    name="db.id"
                                                    value="{{i.db.id}}">
                                            <input  type="text"
                                                        name="db.user_id"
                                                        value="{{i.db.user_id}}">
                                            <input type="text"
                                                    name="nodeUpdateMore"
                                                    value="detail">
                                        </div>
                                        <?= $templatesView["moreDetailBlog"] ?>
                                        <div class="form-group form-add">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit"
                                                    data-button-magic
                                                    data-params-form=".post-form"
                                                    data-format-json="true"
                                                    data-ajax-url="<?=APIPOSTBLOG?>"
                                                    data-show-success=".modal-footer .alert"
                                                    data-show-errors=".modal.signin-missing-session"
                                                    data-show-hide=".btn-add-a-item,.edit-add-item"
                                                    data-refress-list=".modal .item-view-more"
                                                    class="btn btn-primary"
                                                    value="{{d.l10n.btnAdd}}"><i class="fa fa-check"></i> <span>{{d.l10n.btnAdd}}</span></button>
                                            </div>
                                        </div>
                                        <div class="hidden form-group form-edit">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <input type="submit"
                                                    data-button-magic
                                                    data-params-form=".post-form"
                                                    data-format-json="true"
                                                    data-ajax-url="<?=APIPOSTBLOG?>"
                                                    data-show-success=".modal-footer .alert"
                                                    data-show-errors=".modal.signin-missing-session"
                                                    data-show-hide=".btn-add-a-item,.edit-add-item"
                                                    data-refress-list=".modal .item-view-more"
                                                    class="btn btn-primary"
                                                    value="{{d.l10n.btnUpdate}}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if(isset($templatesView["seoBlog"]) && $templatesView["seoBlog"]) {?>

                        <div class="item-content">
                            <h3 class="icon tab-title">{{d.l10n.seo}}</h3>
                            <div class="tab-content">
                                <div class="update-seo-item"
                                    data-copy-template
                                    data-elm-data='{"urlPost":"<?=APIPOSTBLOG?>",
                                    "title":"{{i.meta.title}}",
                                    "keyword":"{{i.meta.keyword}}",
                                    "desc":"{{i.meta.desc}}",
                                    "ui":"{{u.userinfo.db.id}}",
                                    "itemId":"{{i.db.id}}"}'
                                    data-view-template=".update-seo-item"
                                    data-template-id="entrySeoItem">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
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

<script id="entryBlogItemDetail" type="text/x-handlebars-template">
    <div class="item item-menu-detail">
        <div class="row">
            <div class="col-xs-9">{{i.title}}</div>
            <div class="col-xs-1">{{i.so}}</div>
            <div class="col-xs-2 text-right">
                <span
                    class="icon-pencil icon-lg"
                    title="Edit"
                    data-button-magic
                    data-method="get"
                    data-ajax-url="<?=APIGETBLOG?>/{{i.blogid}}?detailId={{i.id}}"
                    data-special="updateInput"
                    data-element-input-update=".edit-add-item [data-update-value-input]"
                    data-scroll-to ="#form-edit-add-item"
                    data-show-hide=".form-edit, .form-add"></span>
                <span
                    class="icon-bin icon-lg"
                    title="Delete"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    data-params='{ "db":{ "id":"{{i.menuid}}", "type":"detail", "delId":"{{i.id}}"} }'
                    data-ajax-url="<?=APIPOSTBLOGMORE?>"
                    data-refress-list=".modal .item-view-more"
                    data-scroll-to ="#form-edit-add-item"> </span>
            </div>
        </div>
    </div>
</script>
