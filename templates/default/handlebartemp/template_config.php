<?php
$templatesView["advertise"] = <<<HTML
    <div class="hidden">
        <input  type="text"
                    name="db.id"
                    value="{{i.db.id}}"
                    class="form-control">
        <input  type="text"
                    name="db.type"
                    value="advertise"
                    class="form-control">
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.advertiseLeft}}</label>
        <div class="col-sm-10">
            <textarea name="advertise.left"
                    class="form-control mce-editor">{{i.advertise.left}}</textarea>
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.advertiseRight}}
        </label>
        <div class="col-sm-10">
            <textarea name="advertise.right"
                    class="form-control mce-editor">{{i.advertise.right}}</textarea>
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.advertiseTop}}
        </label>
        <div class="col-sm-10">
            <textarea name="advertise.top"
                    class="form-control mce-editor">{{i.advertise.top}}</textarea>
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.advertiseBottom}}
       </label>
        <div class="col-sm-10">
            <textarea name="advertise.bottom"
                    class="form-control mce-editor">{{i.advertise.bottom}}</textarea>
            <span class="error"></span>
        </div>
    </div>
HTML;

$templatesView["sidebar"] = <<<HTML
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.title}}</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="sidebar.ti"
                    {{#if i.ti}} value="{{i.ti}}" {{/if}}
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.description}}</label>
        <div class="col-sm-10">
            <textarea name="sidebar.de"
                    type="rich-text"
                    data-validate
                    data-required="{$language["requireContent"]}"
                    class="form-control mce-editor">{{#if i.de}}{{i.de}}{{/if}}</textarea>
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.customClass}}</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="sidebar.cls"
                    {{#if i.cls}} value="{{i.cls}}" {{/if}}
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.htmlAttribute}}</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="sidebar.attr"
                    {{#if i.ti}} value="{{i.attr}}" {{/if}}
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.order}}</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="sidebar.so"
                    {{#if i.so}} value="{{i.so}}" {{/if}}
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.displayLeft}}</label>
        <div class="col-sm-10">
            <label class="checkbox">
                <input name="sidebar.isl" type="checkbox" value="1" {{#if i.isl}} checked {{/if}}>
                <span class="checkbox-style"></span>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{d.l10n.displayRight}}</label>
        <div class="col-sm-10">
            <label class="checkbox">
                <input name="sidebar.isr" type="checkbox" value="1" {{#if i.isr}} checked {{/if}}>
                <span class="checkbox-style"></span>
            </label>
        </div>
    </div>
HTML;

$templatesView["configColumn"] = <<<HTML
    <div class="hidden">
        <input  type="text"
                    name="db.id"
                    value="{{i.db.id}}"
                    class="form-control">
        <input  type="text"
                    name="db.type"
                    value="column"
                    class="form-control">
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Class column left</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="column.left"
                    value="{{i.column.left}}"
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Class column main</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="column.main"
                    value="{{i.column.main}}"
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Class column right</label>
        <div class="col-sm-10">
            <input  type="text"
                    name="column.right"
                    value="{{i.column.right}}"
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
HTML;

$templatesView["seo"] = true;
$templatesView["moreDetail"] = true;
$templatesView["tagProduct"] = <<<HTML
    <div class="form-group">
        <label class="col-sm-2 control-label">
            {{d.l10n.tag}}
        </label>
        <div class="col-sm-10">
            <input  type="text"
                    name="db.ta"
                    value="{{i.db.ta}}"
                    class="form-control">
            <span class="error"></span>
        </div>
    </div>
HTML;

$templatesView["hiddenInputMore"] = <<<HTML
    <div class="hidden">
        <input  type="hidden"
                    name="db.id"
                    value="{{i.db.id}}"
                    class="form-control">
        <input  type="hidden"
                    name="db.type"
                    value="more"
                    class="form-control">
    </div>
HTML;

$templatesView["seoBlog"] = $templatesView["seo"];
$templatesView["slide"] = true;
$templatesView["slideProduct"] = true;
$templatesView["advertise"] = false;
$templatesView["slideBlog"] = true;
//$templatesView["advertiseProduct"] = $templatesView["advertise"];
//$templatesView["advertiseBlog"] = $templatesView["advertise"];
$templatesView["moreDetailProduct"] = $templatesView["moreDetail"];
//$templatesView["moreDetailBlog"] = $templatesView["moreDetail"];
$templatesView["tagBlog"] = $templatesView["tagProduct"];
?>

<script id="entryItemMoreDetail" type="text/x-handlebars-template">
    <div class="item item-menu-detail">
        <div class="row">
            <div class="col-xs-9">{{i.title}}</div>
            <div class="col-xs-1">{{i.so}}</div>
            <div class="col-xs-2 text-right">
                <span class="icon-pencil icon-lg"
                data-button-magic
                title="Edit #{{i.id}}"
                data-method="get"
                data-ajax-url="{{e.urlGet}}/{{e.itemId}}?detailId={{i.id}}"
                data-elm-data='{"urlGet":"<?=APIGETCATEGORY?>", "urlPost":"<?=APIPOSTCATEGORY?>", "itemId":"{{e.itemId}}"}'
                data-view-template="[data-quick-view-item1]"
                data-template-id="entryItemMoreDetailForm"></span>
                <span
                    class="icon-bin icon-lg"
                    title="Delete"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    data-params='{ "id":"{{e.itemId}}", "delId":"{{i.id}}", "updateNode":"detail"}'
                    data-ajax-url="{{e.urlPost}}"
                    data-refress-list=".modal .item-view-more"
                    data-scroll-to ="#form-edit-add-item"> </span>
            </div>
        </div>
    </div>
</script>

<script id="entryItemImageSetting" type="text/x-handlebars-template">
    <form method="post"
        enctype="multipart/form-data"
        data-upload-image="[name='db.im']"
        data-message = "[data-view-message-upload]"
        data-url="{{e.urlPost}}"
        class="form-horizontal post-form no-border p-10">
        <div class="hidden">
            {{#if e.ui}}
            <input  type="text"
                    name="ui"
                    value="{{e.ui}}"
                    class="form-control">
            {{/if}}
            <input  type="text"
                        name="db.id"
                        value="{{e.itemId}}"
                        class="form-control">
            <input  type="text"
                        name="db.size"
                        value="{{e.maxSize}}"
                        class="form-control">
        </div>
        
        <div data-view-message-upload>
            <div class="alert-footer alert" data-fade="4500">
                <div  class="sms-content"></div>
            </div>
        </div>

        <div class="form-group no-margin">
            <div class="row">
                <div class="col-sm-12">

                    <div class="image-preview transition b-r-4 b-cover v-center {{#xif ' this.e.module == "banner" '}}banner-setting{{/xif}}">
                        <label for="fileImgUploadModal-{{e.module}}" class="fa fa-camera transition">
                            <div class="txt-in transition">{{d.l10n.uploadImg}}</div>
                        </label>
                        {{#if e.imgName}}
                            {{#if e.disabledDelete}}
                            <!-- Do nothing -->
                            {{else}}
                            <label class="edit-img delete-img"
                                data-image-delete-hidden
                                data-button-magic
                                data-format-json="true"
                                data-ajax-url="{{e.urlPostDel}}"
                                data-method="POST"
                                data-show-success=".modal-body .alert"
                                data-show-hide=".modal-body .alert,[data-image-delete-hidden]"
                                data-params='{"id":"{{e.itemId}}", "m":"{{e.module}}", "name":"{{e.imgName}}"}'
                                >delete img</label>

                            {{/if}}
                        {{/if}}

                            <img data-image-review
                                data-image-delete-hidden
                                {{#if e.imgName}}
                                src="/{{e.imgPath}}{{e.imgName}}"
                                data-image-init="/{{e.imgPath}}{{e.imgName}}"
                                {{else}}
                                    {{#xif ' this.e.module == "banner" '}}
                                        src="/media/images/style/cover-default.jpg"
                                    {{else}}
                                        src="/media/images/style/user.png"
                                    {{/xif}}
                                {{/if}}
                                >

                            {{#if e.maxSize}}
                            <p class="text-warning">Size < {{{formatCurrency e.maxSize "2" " KB"}}}</p>
                            {{/if}}

                            <!-- Note check element for style with background-->
                                <div class="img-with-css transition b-r-4 b-cover v-center" style="background:url(
                                    {{#if e.imgName}}
                                        /{{e.imgPath}}{{e.imgName}}
                                    {{else}}
                                        {{#xif ' this.e.module == "banner" '}}
                                           /media/images/style/cover-default.jpg
                                        {{else}}
                                            /media/images/style/user.png
                                        {{/xif}}
                                    {{/if}}
                                    )"></div>
                    </div>

                </div>

                <div class="col-sm-12 p-r-0 text-left m-t-10">

                    <label for="fileImgUploadModal-{{e.module}}" class="transition hidden">
                            <div class="txt-in transition btn bg-color7">{{d.l10n.uploadImg}}</div>
                        </label>

                    <div class="btn-update-image hidden">
                        <input type="file"
                                name="file"
                                id="fileImgUploadModal-{{e.module}}"
                                class="hidden"
                                data-file-image
                                data-preview-img="[data-image-review]"
                                data-message="[data-show-message-upload]" />

                        <button type="submit" value="Upload" class="btn bg-color1"> <i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span> </button>
                        <span class="btn bg-color5" data-image-reset><i class="fa fa-times"></i> {{d.l10n.btnCancel}}</span>
                    </div>

                </div>
            </div>


        </div>
    </form>
</script>

<script id="entryItemImage" type="text/x-handlebars-template">
    <form method="post"
        enctype="multipart/form-data"
        data-upload-image="[name='db.im']"
        data-message = "[data-view-message-upload]"
        data-url="{{e.urlPost}}"
        class="form-horizontal post-form">
        <div class="hidden">
            {{#if e.ui}}
            <input  type="text"
                    name="ui"
                    value="{{e.ui}}"
                    class="form-control">
            {{/if}}
            <input  type="text"
                        name="db.id"
                        value="{{e.itemId}}"
                        class="form-control">
            <input  type="text"
                        name="db.size"
                        value="{{e.maxSize}}"
                        class="form-control">
        </div>
        <div  class="alert-footer alert" data-view-message-upload data-fade="4500">
            <div  class="sms-content"></div>
        </div>
        <div class="form-group no-margin">

            <label class="{{#if e.nocol}}hidden{{else}}
                    {{#if e.stylecol3}}col-sm-3 {{else}} col-sm-2 control-label{{/if}}{{/if}}">
                {{d.l10n.image}}
            </label>

            <div class="{{#if e.nocol}}nocol col-xs-12{{else}} {{#if e.stylecol3}}col-sm-9 {{else}} col-sm-10{{/if}}{{/if}}">
                <div class="image-preview transition b-r-4 b-cover v-center">
                    <label for="fileImgUploadModal-{{e.module}}" class="fa fa-camera transition">
                        <div class="txt-in transition">{{d.l10n.uploadImg}}</div>
                    </label>
                    {{#if e.imgName}}
                        {{#if e.disabledDelete}}
                        <!-- Do nothing -->
                        {{else}}
                        <label class="edit-img delete-img"
                            data-image-delete-hidden
                            data-button-magic
                            data-format-json="true"
                            data-ajax-url="{{e.urlPostDel}}"
                            data-method="POST"
                            data-show-success=".modal-body .alert"
                            data-show-hide=".modal-body .alert,[data-image-delete-hidden]"
                            data-params='{"id":"{{e.itemId}}", "m":"{{e.module}}", "name":"{{e.imgName}}"}'
                            >delete img</label>

                        {{/if}}
                    {{/if}}
                        <img data-image-review
                            data-image-delete-hidden
                            {{#if e.imgName}}
                            src="/{{e.imgPath}}{{e.imgName}}"
                            data-image-init="/{{e.imgPath}}{{e.imgName}}"
                            {{else}}
                                {{#xif ' this.e.module == "banner" '}}
                                    src="/media/images/style/cover-default.jpg"
                                {{else}}
                                    src="/media/images/style/user.png"
                                {{/xif}}
                            {{/if}}
                            >

                        {{#if e.maxSize}}
                        <p class="text-warning">Size < {{{formatCurrency e.maxSize "2" " KB"}}}</p>
                        {{/if}}

                    <!-- Note check element for style with background-->
                        <div class="img-with-css transition b-r-4 b-cover v-center" style="background:url(
                            {{#if e.imgName}}
                                /{{e.imgPath}}{{e.imgName}}
                            {{else}}
                                {{#xif ' this.e.module == "banner" '}}
                                   /media/images/style/cover-default.jpg
                                {{else}}
                                    /media/images/style/user.png
                                {{/xif}}
                            {{/if}}
                            )"></div>
                </div>
                <div class="btn-update-image hidden">
                    <input type="file"
                            name="file"
                            id="fileImgUploadModal-{{e.module}}"
                            class="hidden"
                            data-file-image
                            data-preview-img="[data-image-review]"
                            data-message="[data-show-message-upload]" />
                    <button type="submit" value="Upload" class="btn btn-default"> <i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
                    <span class="btn btn-default" data-image-reset>{{d.l10n.btnCancel}}</span>
                </div>
            </div>

        </div>
    </form>
</script>

<script id="entryItemMoreDetailForm" type="text/x-handlebars-template">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="admin-title">
                    <h2>{{d.l10n.menuManage}} :: {{d.l10n.btnAdd}}</h2>
                </div>
                <span class="icon-cancel-circle icon-lg1 position-right"
                      data-closet-toggle-class="in"
                      data-object=".modal"
                      data-empty-object="[data-quick-view-item1]"></span>
            </div>
            <div class="modal-body">
                <form class="form-horizontal post-form" data-form-edit-add-item>
                    <div class="hidden">
                        <input  type="text"
                                    name="db.id"
                                    value="{{e.itemId}}"
                                    class="form-control">
                        <input  type="text"
                                    name="db.type"
                                    value="detail"
                                    class="form-control">
                        <input  type="text"
                                    name="detail.id"
                                    value="{{i.detail.id}}"
                                    class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.title}}
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="detail.title"
                                    data-validate
                                    data-required="{$language["requireTitle"]}"
                                    value="{{i.detail.title}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.description}}
                        </label>
                        <div class="col-sm-10">
                            <textarea name="detail.description"
                                    type="rich-text"
                                    data-validate
                                    data-required="{$language["requireContent"]}"
                                    class="form-control mce-editor">{{i.detail.description}}</textarea>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{d.l10n.order}}
                        </label>
                        <div class="col-sm-10">
                            <input  type="text"
                                    name="detail.so"
                                    value="{{i.detail.so}}"
                                    class="form-control">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            {{#if i.detail.id}}
                            <button type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCATEGORY?>"
                                data-show-success=".modal-footer .alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-show-hide=".btn-add-a-item,[data-quick-view-item1]"
                                data-empty-object="[data-quick-view-item1]"
                                data-refress-list=".modal .item-view-more"
                                class="btn btn-primary"
                                value="{{d.l10n.update}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
                            {{else}}
                            <button type="submit"
                                data-button-magic
                                data-params-form=".post-form"
                                data-format-json="true"
                                data-ajax-url="<?=APIPOSTCATEGORY?>"
                                data-show-success=".modal-footer .alert"
                                data-show-errors=".modal.signin-missing-session"
                                data-show-hide=".btn-add-a-item,[data-quick-view-item1]"
                                data-empty-object="[data-quick-view-item1]"
                                data-refress-list=".modal .item-view-more"
                                class="btn btn-primary"
                                value="{{d.l10n.btnAdd}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnAdd}}</span></button>
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
                        <span class="btn btn-default"
                            data-closet-toggle-class="in"
                            data-object=".modal"
                            data-empty-object="[data-quick-view-item1]">Close</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="entrySlideItem" type="text/x-handlebars-template">
    <div class="item img-detail">
        <div class="row">
            <div class="col-xs-2"><img src="/{{i.file}}" class="img"></div>
            <div class="col-xs-7"><label>{{i.name}}</label></div>
            <div class="col-xs-1"><label>{{i.size}}</label></div>
            <div class="col-xs-2 text-right">
                <span class="btn btn-warning"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"
                    {{#if e.ui}}
                    data-params='{"file":"{{i.file}}","name":"{{i.name}}","ui":"{{e.ui}}"}'
                    {{else}}
                    data-params='{"file":"{{i.file}}","name":"{{i.name}}"}'
                    {{/if}}
                    data-ajax-url="/api/post/filedelete"
                    data-refress-list=".item-view-slide-image"
                    ><span class="icon-bin"></span> {{d.l10n.btnDelete}}</span>
            </div>
        </div>
    </div>
</script>

<script id="entrySlideItemTwo" type="text/x-handlebars-template">
      <a href="/{{i.file}}" data-button-magic data-lightbox data-title="" class="col-sm-3 img-b p-2 c-center">
      {{#if u.userinfo}}  
      {{#xif ' this.e.uid  == this.u.userinfo.db.id '}}
      <span class="fa fa-plus"
                    data-button-magic
                    data-confirm="true"
                    data-method="post"
                    data-format-json="true"

                    {{#if e.uid}}
                    data-params='{"file":"{{i.file}}","name":"{{i.name}}","ui":"{{e.uid}}"}'
                    {{else}}
                    data-params='{"file":"{{i.file}}","name":"{{i.name}}"}'
                    {{/if}}

                    data-ajax-url="/api/post/filedelete"
                    data-refress-list=".item-view-slide-image"
                    ></span>

      {{/xif}}
      {{/if}}
            <span class="img" style="background:url(/{{i.file}}) no-repeat;background-size:cover;background-position:center center"></span>

        </a>
</script>

<script id="entrySeoItem" type="text/x-handlebars-template">
    <form class="form-horizontal post-form">
        <div class="hidden">
            {{#if e.ui}}
            <input  type="text"
                    name="db.ui"
                    value="{{e.ui}}">
            {{/if}}
            <input  type="text"
                        name="db.id"
                        value="{{e.itemId}}"
                        class="form-control">
            <input  type="text"
                        name="db.type"
                        value="meta"
                        class="form-control">
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.metaTitle}} VI
            </label>
            <div class="col-sm-10">
                <input name="meta.title.vi"
                    value="{{e.title.vi}}"
                        class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.metaTitle}} EN
            </label>
            <div class="col-sm-10">
                <input name="meta.title.en"
                    value="{{e.title.en}}"
                        class="form-control">
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.metaDesc}} VI
            </label>
            <div class="col-sm-10">
                <textarea name="meta.desc.vi"
                        class="form-control">{{e.desc.vi}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.metaDesc}} EN
            </label>
            <div class="col-sm-10">
                <textarea name="meta.desc.en"
                        class="form-control">{{e.desc.en}}</textarea>
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.metaKeyword}} VI
            </label>
            <div class="col-sm-10">
                <textarea name="meta.keyword.vi"
                        class="form-control">{{e.keyword.vi}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{d.l10n.metaKeyword}} EN
            </label>
            <div class="col-sm-10">
                <textarea name="meta.keyword.en"
                        class="form-control">{{e.keyword.en}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <button type="submit"
                    data-button-magic
                    data-params-form=".post-form"
                    data-format-json="true"
                    data-ajax-url="{{e.urlPost}}"
                    data-show-success=".alert-footer.alert"
                    data-show-errors=".alert-footer.alert-error"
                    data-show-hide=".btn-add-a-item,.edit-add-item"
                    class="btn btn-primary"
                    value="{{d.l10n.btnUpdate}}"> <i class="fa fa-check"></i> <span>{{d.l10n.btnUpdate}}</span></button>
            </div>
        </div>
    </form>
</script>

<script id="entrySlideImage" type="text/x-handlebars-template">
    <form method="post"
        data-upload-image
        data-message = "[data-view-message-upload]"
        data-url="{{e.urlPost}}"
        data-multi-file="true"
        data-preview-layout = "[data-review-multi-image-layout]"
        data-preview-image = "[data-review-multi-image]"
        {{#if e.refressList}}
        data-refress-list = "{{e.refressList}}"
        {{/if}}
        class="form-horizontal post-form">
        <div class="hidden">
            {{#if e.folder}}
            <input  type="text"
                    name="folder"
                    value="{{e.path}}"
                    class="form-control">
            {{else}}
            <input  type="text"
                        name="id"
                        value="{{e.itemId}}"
                        class="form-control">
            {{/if}}
            {{#if e.ui}}
            <input  type="text"
                    name="ui"
                    value="{{e.ui}}"
                    class="form-control">
            {{/if}}
            {{#if e.company_id}}
            <input  type="text"
                    name="company_id"
                    value="{{e.company_id}}"
                    class="form-control">
            {{/if}}
            <input  type="text"
                        name="db.size"
                        value="{{e.maxSize}}"
                        class="form-control">
            <input  type="text"
                        name="filesoptioned"
                        class="form-control">

        </div>
        <div data-view-message-upload class="text-danger"></div>

          <div class="btn-upload ">
            <label for="multiFileImgUploadModal-{{e.module}}" class="btn bg-color1"><i class="fa fa-plus"></i> {{d.l10n.addPhoto}}</label>
            <button type="submit" value="Upload" data-button-upload class="btn bg-color3 hidden" disabled><i class="fa fa-save"></i> <span>{{d.l10n.btnSave}}</span> </button>
            {{#unless e.hidCancel}}
                  <button class="btn btn-primary" disabled data-image-reset>{{d.l10n.btnCancel}}</button>
            {{/unless}}
        </div>

        <div class="hidden-section">

            <div data-review-multi-image-layout class="hidden">
                    <!-- <div class="row">
                <div class="img-detail">
                        <div class="col-xs-2"><img src="{0}" class="img"></div>
                       <div class="col-xs-6"><label>{1}</label></div>
                        <div class="col-xs-2"><label>{2}KB</label></div>
                        <div class="col-xs-2 text-right">
                            <span data-file-cancel
                                class="btn btn-warning" data-image-name="{1}">{{d.l10n.btnCancel}}</span>
                        </div>
                    </div>


                </div>-->


                <div class="col-sm-2 photo-review p-2">
                    <div class="pt" style="background:url('{0}') no-repeat;-webkit-background-size: cover;-o-background-size: cover;background-size: cover;background-position: center center;">
                         <i class="fa fa-plus" data-file-cancel data-image-name="{1}"></i>
                    </div>
                </div>

            </div>


            <div class="add-photo-popup c-center">
                <div class="container add-photo-content block">
                    <div class="row block-title bg-color5">
                        <div class="col-sm-8 text-left">{{d.l10n.uploadImg}}</div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" value="Upload" data-button-upload class="btn bg-color3" disabled><i class="fa fa-save"></i> <span>{{d.l10n.btnSave}}</span> </button>
                            <button class="btn bg-color2" disabled data-image-reset>{{d.l10n.btnCancel}}</button>
                        </div>
                    </div>
                    <div class="row block-content">
                        <div data-review-multi-image></div>
                    </div>
                </div>
            </div>

            <div class="btn-update-image hidden">
                <input type="file"
                        name="file[]"
                        id="multiFileImgUploadModal-{{e.module}}"
                        class="hidden"
                        data-file-image multiple/>
            </div>
        </div>


    </form>
</script>
