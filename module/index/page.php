<?php
$cache_category_articlearr = cache::get('category_articlearr');

$page_id = intval($act);
$info = $db->pe_select('page', array('page_id'=>$page_id));

//seo
$seo = pe_seo($info['page_name']);
include(pe_tpl('article_view.html'));
?>