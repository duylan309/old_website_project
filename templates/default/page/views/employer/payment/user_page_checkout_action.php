<h2>Thankyou page</h2>
<?php //echo isset($rowUpdatePayment["content"]) ? $rowUpdatePayment["content"] : ''?>
<div class="admin-management"
    data-get-url="<?=APIGETCHECKOUT."/".$rowUpdatePayment["id"]?>"
    data-elm-data='{"referer":"<?="/{$seo_name["page"]["user"]}?manage=checkout"?>"}'
    data-copy-template
    data-view-template=".admin-management"
    data-template-id="entryViewCheckoutDetail"></div>