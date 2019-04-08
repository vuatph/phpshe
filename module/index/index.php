<?php
//焦点图
$jdt_list = $db->pe_selectall('ad', array('order by'=>'ad_order asc'), '*', array(5));
//网站公告
$article_noticelist = $db->pe_selectall('article', array('category_id'=>1,'order by'=>'article_atime desc'), '*', array(10));

//商品推荐
$sql = "select * from `".dbpre."tag` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`tag_name` = 'tuijian' order by a.`product_id` desc limit 5";
$product_tuijian = $db->sql_selectall($sql);

//商品促销
$sql = "select * from `".dbpre."tag` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`tag_name` = 'cuxiao' order by a.`product_id` desc limit 5";
$product_cuxiao = $db->sql_selectall($sql);

foreach((array)$category_productarr[0] as $k=>$v) {
	$v['product_newlist'] = $db->pe_selectall('product', array('category_id'=>$v['category_id'],'order by'=>'product_id desc'), '*', array(8));
	$v['product_selllist'] = $db->pe_selectall('product', array('category_id'=>$v['category_id'],'order by'=>'product_sellnum desc'), '*', array(5));
	$category_indexlist[] = $v;
}
//seo
$seo = pe_seo();

include(pe_tpl('index.html'));
pe_result();
?>