<p class="hidden">
	<script type="text/javascript" src="<?=$script?>"></script>
</p>
<div class="message-inbox">
	<div class="item-view-contact-list admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        data-init-object="loadMessages"
        data-method="get"
        data-show-page="6"
        data-elm-data='{"imagefolder":"<?=FOLDERIMAGECOMPANY?>thumbnail/","type":"<?=$_SESSION["userlog"]["type"]?>","action":"favorite"}'
        data-show-item="30"
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-elm-data='{"adminList":1}'
        data-template-id="entryLoadMessage"> 
        <div class="row admin-title">
            <div class="col-sm-12">
                <h2 class="pull-left text-color1 no-margin"><?=$language["importantmessages"]?></h2>
            </div>
        </div>
        <?php require dirname(__FILE__) . "/search.php";?>
        <div data-user-action-message class="row m-b-15">
            <div class="col-sm-12">
                <div class="btn bg-color7">
                    <label data-check-all class="checkbox">
                        <input name="do[]" type="checkbox" value="1">
                        <span class="checkbox-style"></span>
                    </label>
                </div>
                <button class="btn bg-color7"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        <table table-message-inbox class="table table-bordered">
            <colgroup>
                <col size-action class="col-sm-1">
                <col size-action class="col-sm-1">
                <col class="col-sm-3">
                <col class="col-sm-5">
                <col class="col-sm-2">
            </colgroup>
            <thead>
            	<tr class="b-b">
                    <th size-action class="col-sm-1"></th>
					<th size-action class="col-sm-1"></th>
					<th class="col-sm-3"><?=$language["company"]?></th>
					<th class="col-sm-5"><?=$language["message"]?></th>
					<th class="col-sm-2"><?=$language["date"]?></th>
            	</tr>
            </thead>
            <tbody class="view-items" data-content>
            	
            </tbody>
        </table>    
        <div data-footer></div>
	</div>
</div>