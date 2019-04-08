<?php
include('common.php');

$category_product = cache::get('category_product');
$category_article = cache::get('category_article');
$category_productarr = cache::get('category_productarr');
$category_articlearr = cache::get('category_articlearr');

$cache_link = cache::get('link');
$cache_page = cache::get('page');

$cart_num = $_s_user_id_key ? $db->pe_num('cart', array('user_id'=>$_s_user_id)) : 0;

include("{$pe['path_root']}module/{$module}/{$mod}.php");
?>