<?php

require_once '../ajax/ajax_search_content.php';

require_once '../ajax/ajax_response.php';

$ajaxResponse = new AjaxResponse($_POST['furl']);

$ajaxResponse->getAllInfo();

$jsonResult['count_links_int'] = $ajaxResponse->countsLinkInt;
$jsonResult['count_links_ext'] = $ajaxResponse->countsLinkExt;
$jsonResult['list_links_int'] = $ajaxResponse->listLinksInt;
$jsonResult['list_links_ext'] = $ajaxResponse->listLinksExt;
$jsonResult['count_links_all'] = $ajaxResponse->countsAllLinks;
$jsonResult['title_page'] = $ajaxResponse->titlePage;

print json_encode($jsonResult);

?>