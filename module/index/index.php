<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */

//网站公告
$notice_list = $db->pe_selectall('article', array('class_id'=>1,'order by'=>'`article_atime` desc'), '*', array(8));
//新品推荐
$product_newlist = product_newlist(5);

$category_indexlist = array();
foreach((array)$cache_category_arr[0] as $k=>$v) {
	$v['product_list'] = $db->pe_selectall('product', array('category_id'=>category_cidarr($v['category_id']), 'product_state'=>1, 'order by'=>'product_order asc, product_id desc'), '*', array(8));
	$category_indexlist[] = $v;
}

$seo = pe_seo();
include(pe_tpl('index.html'));
?>