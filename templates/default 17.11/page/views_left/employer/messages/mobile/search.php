<div class="filter-list">
    <form class="post-form form-filter no-padding">
        <div class="filter filter-list">
            <div class="row">
                <div class="col-sm-9">
                    <input name="ti"
                        data-compare="text in"
                        data-key="ti"
                        placeholder="<?=$language['searchMessageInboxEmployer']?>"
                        class="form-control m-b-10">
                </div>
                <div class="col-sm-3 form-group">
                    <div class="select-wrapper">
                        <select name="company_id"
                            data-compare="in"
                            data-key="company_id"
                            data-dropdown
                            data-str-key="id"
                            data-str-value="name"
                            data-option-local-json="yourCompany"
                            data-object-init='{"id":"", "name":"<?=$language['company']?>"}'
                            class="form-control">
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>