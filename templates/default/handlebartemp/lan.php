<script id="viewBreadCrumbJob" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-12">
        <ul>
            <li>
                <a href="<?="/{$seo_name["page"]["user"]}?manage=jobs"?>"><i class="fa fa-home"></i> {{d.l10n.jobs}} <strong>({{this.u.totalJob.total}})</strong></a>
            </li>

            {{#if this.e.jobtitle }}
            <li>
                <a href="/{{this.e.currenturl}}">{{this.e.jobtitle}} (<strong>{{this.e.applied}}</strong>)</a>
            </li>
            {{/if}}

            {{#if this.e.username }}
            <li>
                <a href="#">{{this.e.username}}</a>
            </li>
            {{/if}}

        </ul>
    </div>
</div>
</script>

<script id="viewBreadCrumbEmployee" type="text/x-handlebars-template">
<div class="row">
    <div class="col-sm-12">
        <ul>
            <li>
                <a href="<?="/{$seo_name["page"]["user"]}?manage=userapply"?>"><i class="fa fa-home"></i> {{d.l10n.applications}} <strong>( {{this.e.totalNumber}} )</strong></a>
            </li>

            {{#if this.e.jobtitle }}
            <li>
                <a href="/{{this.e.currenturl}}">{{this.e.jobtitle}} (<strong>{{this.e.total}}</strong>)</a>
            </li>
            {{/if}}

            {{#if this.e.username }}
            <li>
                <a href="#">{{this.e.username}}</a>
            </li>
            {{/if}}

        </ul>
    </div>
</div>
</script>

<script id="entryUserHeaderEmployer" type="text/x-handlebars-template">
    {{#if u.userinfo}}
        <div class="welcome">
        {{#if u.userinfo.db.name}}
            {{#if u.userinfo.db.username}}
            <a href="<?="/{$seo_name["page"]["user"]}?manage=postjob";?>"
                class="btn bg-color3 form-add btn-add-a-item text-uppercase text-bold"
                data-button-magics
                data-elm-data='{"urlRedirect":"/{{u.userinfo.db.username}}"}'
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="jobsAdd"><span class="icon-file-text2"></span> <span class="hidden-sm">{{d.l10n.btnPostJob}}</span></a>

            <a href="#">{{d.l10n.employmentPage}}</a>
            {{else}}

            {{/if}}
            <a href="<?="/{$seo_name["page"]["user"]}";?>">{{#if u.userinfo.db.im}}<span class="icon-avatar"><img src="/<?=FOLDERIMAGEUSER?>{{u.userinfo.db.im}}"></span> {{/if}}<span>{{u.userinfo.db.name}}</span></a>
        {{else}}
            <a href="<?="/{$seo_name["page"]["user"]}";?>">{{d.l10n.pleaseUpdateInfomation}}</a>
        {{/if}}
        </div>
    {{else}}
        <div class="welcome">
        <a href="/emp" class="btn bg-color3 form-add btn-add-a-item text-uppercase text-bold">
            <span class="icon-file-text2"></span> <span class="hidden-sm">{{d.l10n.btnPostJob}}</span>
        </a>
        <a href="/"
            class="btn bg-color6">{{d.l10n.seekerperson}}</a>

        <a href="/user?manage=company#group-view=2"
                class="btn bg-color6"
                data-button-magic
                data-elm-data='{"urlRedirect":"."}'
                data-view-template-local="true"
                data-view-template="[data-quick-view-item]"
                data-template-id="entrySigninPopup"><i class="fa fa-lock"></i> {{d.l10n.signin}}</a>
        </div>
    {{/if}}

</script>

<script id="viewItemJobClient" type="text/x-handlebars-template">
<div class="item i-blog i-search u-i-search">
    <div class="j-search">
        <div class="j-title transition">
            <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}">
               <div class="j-level text-color2 no-margin">{{{textFromDropdownLocal i.db.ty 'jobTime' 'id' 'ti'}}}</div>
               <div class="j-name transition short-text">{{i.db.ti}}</div>
            </a>
        </div>
       <strong class="text-color3 short-text">
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
        <p class="text-postby short-text"><span class="text-color4">{{d.l10n.postby}} </span><span class="text-color2 j-level">{{i.cmp.name}}</span></p>
        <p class="text-address short-text">{{{textFromDropdownLocal i.db.lo 'location' 'id' 'ti'}}}</p>
    </div>
    <a href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}" class="btn btn-block bg-color1 text-uppercase btn-save transition hidden">{{d.l10n.viewMore}}</a>

</div>
</script>

<script id="viewItemJobClientBigBox" type="text/x-handlebars-template">
<div class="item item-cv u-s-j">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="j-level text-color2 t-s-12">
                {{{textFromDropdownLocal i.db.le 'jobLevel' 'id' 'ti'}}}<span class="t-s-12 text-color4">
                {{#xif ' this.i.db.ex > 0 '}}
                    - {{{textFromDropdownLocal i.db.ex 'yearOfExperience' 'id' 'ti'}}}
                {{else}}
                    - {{d.l10n.yearOfExperienceNone}}
                {{/xif}}
                 </span>
            </div>
            <a class="j-title text-color1 t-s-12" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}?view=1">
               {{i.db.ti}}
            </a>
            <p class="t-s-11">{{i.address}}, {{{textFromDropdownLocal i.lo 'location' 'id' 'ti'}}}</p>
            
            <strong class="text-color3 t-s-12">
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

            <div class="i-info-detail" >
                <p class="hidden-more">{{{shortenText i.more.description 200}}}</p>
           <div class="bg-g-white btn-more-white" data-closet-toggle-class="active" data-object=".item-cv"></div>

                <div class="view-more" data-closet-toggle-class="active" data-object=".item-cv">
                    <div class="more-detail">
                        <h3 class="text-color2">{{d.l10n.jobDescription}}</h3>
                        <p class="textarea-content">{{{i.more.description}}}</p>
                    </div>
                    <div class="more-detail">
                        <h3 class="text-color2">{{d.l10n.jobSkill}}</h3>
                        <p class="textarea-content">{{shortenText i.more.requirement 350}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-more">
                <a href="/<?=$seo_name["page"]["job"]?>/{{{urlFriendly i.db.ti i.db.id}}}?view=1" class="btn view-less text-uppercase"><strong>+ {{d.l10n.viewMore}}</strong></a>
            </div>

        </div>

    </div>
</div>
</script>

<script id="viewItemJobClientRight" type="text/x-handlebars-template">
<div class="item i-blog no-m-top i-search">
    <div class="j-search m-b-10">
        <div class="t-s-11 text-color4 no-margin c-list">{{{textFromDropdownLocal i.db.ty 'jobTimeOption' '' ''}}}</div>

        <div class="j-title transition">
           <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}} {{#if e.userManageJobInSide}}?statistics=1{{/if}}">
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
        <p class="text-salary hidden">{{{textFromDropdownLocal i.db.ex 'yearOfExperience' 'id' 'ti'}}}</p>
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

<script id="viewItemJobListRight" type="text/x-handlebars-template">
<li>
    <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/{{urlFriendly i.db.ti i.db.id}}{{#if e.userManageJobInSide}}?statistics=1{{/if}}">
        <div class="j-name transition no-margin">{{i.db.ti}}</div>
    </a>
</li>
</script>

<script id="viewFilter" type="text/x-handlebars-template">
<div class="filter bg-color4">
    <div class="header-tab p-10 j-stitle bg-color3 b-ra-t-r-l">{{d.l10n.btnSearchMore}}</div>
    <div class="form-group p-10 p-b-0">
        <input class="form-control"
        name="title" value=""
        placeholder="{{#if e.searchSeeker}}{{d.l10n.placeholderSearchCv}}{{else}}{{d.l10n.placeholderSearchJob}}{{/if}}" >
        <select name="loc"
            class="form-control"
            type="select"
            data-validate
            data-required="{{d.l10n.optCity}}"
            data-object-init='{"id":"", "ti":"{{d.l10n.city}}"}'
            data-dropdown
            data-index-value="{{i.db.ci}}"
            data-option-local-json="location"
            data-option-from-json="<?=APIGETLOCATION;?>">
            <option value="">{{d.l10n.optCity}}</option>
        </select>
        <select name="categorylist"
            class="form-control"
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
        <select name="salaryStandard"
            class="form-control"
            type="select"
            data-validate
            data-required=""
            data-object-init='{"id":"", "ti":"{{d.l10n.jobSalary}}"}'
            data-dropdown
            data-index-value="{{i.db.ci}}"
            data-option-local-json="salary"
            <option value="">{{d.l10n.jobSalary}}</option>
        </select>
    </div>
    <!--TIME WORKING-->
    <div class="head-title-bar p-10">{{d.l10n.timeWork}}</div>
    <div class="form-group p-10">
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Toàn thời gian</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Bán thời gian</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Theo ca</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Thực tập</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Học nghề</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> 1 ngày</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> 2 ngày</span>

    </div>
    <!--YEAR EPERIENCED-->
    <div class="head-title-bar p-10">{{d.l10n.yearOfExperience}}</div>
    <div class="form-group p-10">
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Không cần kinh nghiệm</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> 1 - 2 năm</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> 2 - 4 năm</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> 4 - 6 năm</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> > 6 năm</span>

    </div>
    <!--COMPANY-->
    <div class="head-title-bar p-10">{{d.l10n.company}}</div>
    <div class="form-group p-10">
        <input class="form-control"
        name="title" value=""
        placeholder="{{#if e.searchSeeker}}{{d.l10n.companyName}}{{else}}{{d.l10n.companyName}}{{/if}}" >
    </div>
    <!--LANGUAGE-->
    <div class="head-title-bar p-10">{{d.l10n.language}}</div>
    <div class="form-group p-10">
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Tiếng Anh</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Tiếng Việt</span>
        <span class="checkbox checkbox-left"> <input name="rememberlogin" type="checkbox" value="1"> Tiếng Nhật</span>

    </div>
</div>
</script>

<script id="viewBannerHome" type="text/x-handlebars-template">
<div class="banner-left v-center ct-b-h">
    <div class="t-t">
            {{{d.l10n.homeBannerContent}}}
        <div class="l-tt hidden">Most affordable job platform in the market.</div>
        <form class="form-inline s-b-form"
            {{#if e.searchSeeker}}
            action="/<?=$seo_name["page"]["searchcv"]?>"
            {{else}}
            action="/<?=$seo_name["page"]["search"]?>"
            {{/if}}
            >
            <div class="form-group">
                <input type="hidden" name="distinct" value="1">
                <input type="hidden" name="random" value="1">
                <input class="form-control i-p-t"
                name="title" value=""
                placeholder="{{#if e.searchSeeker}}{{d.l10n.placeholderSearchCv}}{{else}}{{d.l10n.placeholderSearchJob}}{{/if}}" >
                <span class="select-wrapper">
                    <select name="loc"
                        class="form-control "
                        type="select"
                        data-validate
                        data-required="{{d.l10n.optCity}}"
                        data-object-init='{"id":"", "ti":"{{d.l10n.locationSearch}}"}'
                        data-dropdown
                        data-index-value="{{#if i.db.ci}}{{i.db.ci}}{{else}}30{{/if}}"
                        data-option-local-json="location"
                        data-option-from-json="<?=APIGETLOCATION;?>">
                        <option value="">{{d.l10n.optCity}}</option>
                    </select>
                </span>
            </div>
            <div class="form-group">
                <button class="btn bg-color3 text-uppercase"><span class="icon-search icon-search1 hidden-xs"> </span> <span class=" hidden-sm hidden-lg">{{d.l10n.btnSearch}}</span></button>
            </div>

            <div class="social-i-banner v-center hidden">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="clearfix"></div>
            <div class="form-group m-t-10 w-100">
                <a class="btn bg-color6 text-uppercase b-r-4 btn-block btn-search-map" 
                    href="/<?=$seo_name["page"]["search"]?>?map=view">
                   <i class="fa fa-map-marker"></i> {{d.l10n.searchByMap}}
                </a>
            </div>
        </form>
    </div>
</div>
</script>

<script id="viewBannerHomeHori" type="text/x-handlebars-template">
<div class="banner-left ct-b-h v-center"
     data-fixed-closet="#main .hidden"
     data-fixed-stop=".banner-left-fixed,#footer"
     data-fixed-class="filter-fixed"
     data-fixed="#main .hidden">
    <div class="t-t">
        <div class="b-tt">
            <span class="pc hidden-xs">
            FIND JOBS IN
            <span id="changingText" class="text-color2">RESTAURANTS</span>
            <span>TODAY</span>
            </span>

            <span class="hidden-sm hidden-lg hidden-md">
            FIND JOBS IN <br>
            <span id="changingText" class="text-color2">RESTAURANTS</span><br>
            <span >TODAY</span>
            </span>

        </div>
        <div class="l-tt hidden">Most affordable job platform in the market.</div>
        <form class="form-inline s-b-form"
            {{#if e.searchSeeker}}
            action="/<?=$seo_name["page"]["searchcv"]?>"
            {{else}}
            action="/<?=$seo_name["page"]["search"]?>"
            {{/if}}
            >
            <div class="form-group ">
                <input type="hidden" name="distinct" value="1">
                <input class="form-control i-p-t"
                name="title" value=""
                placeholder="{{#if e.searchSeeker}}{{d.l10n.placeholderSearchCv}}{{else}}{{d.l10n.placeholderSearchJob}}{{/if}}" >
                <span class="select-wrapper">
                    <select name="loc"
                        class="form-control "
                        type="select"
                        data-validate
                        data-required="{{d.l10n.optCity}}"
                        data-object-init='{"id":"", "ti":"{{d.l10n.locationSearch}}"}'
                        data-dropdown
                        data-index-value="{{i.db.ci}}"
                        data-option-local-json="location"
                        data-option-from-json="<?=APIGETLOCATION;?>">
                        <option value="">{{d.l10n.optCity}}</option>
                    </select>
                </span>
            </div>
            <div class="form-group">
                <button class="btn bg-color3 text-uppercase"><span class="icon-search icon-search1"> </span> <span class="hidden-xs hidden-sm hidden">{{d.l10n.btnSearch}}</span></button>
            </div>
            <div class="social-i-banner">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
        </form>
    </div>

</div>
</script>

<!---NEWFEED-->
<script id="viewItemBlog" type="text/x-handlebars-template">
<div class="item i-blog">
    <div class="row">
        <div class="col-sm-1"><div class="p-img-s" style="background:url('/<?=FOLDERIMAGEUSER?>{{i.im}}') no-repeat;-webkit-background-size: cover;
            -o-background-size: cover;
        background-size: cover;"></div></div>
        <div class="col-sm-11">
        <div class="i-b-t">
            <a href="#"><strong>{{i.ti}}</strong></a>
        </div>
        <div class="i-b-d">{{{formatDate i.cr '%d-%M-%Y at %H:%m'}}}</div>
        </div>
    </div>

    <div class="sortcontent">
        <p>{{i.nf}}</p>
    </div>

    <div class="row">

    </div>
</div>
</script>

<script type="text/x-handlebars-template" id="reportJobDetail"></script>


