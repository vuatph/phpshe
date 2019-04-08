<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */

//网站公告
$notice_list = $db->pe_selectall('article', array('class_id'=>1,'order by'=>'`article_atime` desc'), '*', array(5));
//新品推荐
$product_newlist = product_newlist();

$category_indexlist = array();
foreach((array)$cache_category_arr[0] as $k=>$v) {
	$v['product_list'] = $db->pe_selectall('product', array('category_id'=>category_cidarr($v['category_id']), 'product_state'=>1, 'order by'=>'product_order asc, product_id desc'), '*', array(8));
	$v['ad'] = $db->pe_select('ad', array('ad_position'=>'index_category', 'category_id'=>$v['category_id'], 'ad_state'=>1, 'order by'=>'ad_order asc, ad_id desc'));
	$category_indexlist[] = $v;
}

$seo = pe_seo();
include(pe_tpl('index.html'));
?>