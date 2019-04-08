<?php
include('common.php');

$cache_category = cache::get('category');
$cache_category_arr = cache::get('category_arr');
$cache_class = cache::get('class');
$cache_class_arr = cache::get('class_arr');
$cache_menu = cache::get('menu');
$cache_link = cache::get('link');
$cache_ad = cache::get('ad');
pe_lead('hook/ad.hook.php');
pe_lead('hook/user.hook.php');
$web_qq = $cache_setting['web_qq'] ? explode(',', $cache_setting['web_qq']) : array();

if (!$db->pe_num('iplog', array('iplog_ip'=>pe_dbhold(pe_ip()), 'iplog_adate'=>date('Y-m-d')))) {
	$db->pe_insert('iplog', array('iplog_ip'=>pe_dbhold(pe_ip()), 'iplog_adate'=>date('Y-m-d'), 'iplog_atime'=>time()));
}

//检测活动信息
$db->pe_update('product', " and `product_hd_etime` > 0 and `product_hd_etime` <= '".time()."'", "product_money = product_smoney, product_hd_tag = '', product_hd_stime =0, product_hd_etime = 0");
$table_huodong = "(select * from (select * from `".dbpre."huodongdata` where `huodong_stime` <= '".time()."' and `huodong_etime` > '".time()."' order by `huodong_stime` asc) aa group by `product_id`)";
$sql = "update `".dbpre."product` a, {$table_huodong} b set a.`product_money` = b.`huodong_money`, a.`product_hd_tag` = b.`huodong_tag`, a.`product_hd_stime` = b.`huodong_stime`, a.`product_hd_etime` = b.`huodong_etime` where a.`product_id` = b.`product_id`";
$db->sql_update($sql);
/*$info_list = $db->pe_selectall('huodongdata', " and `huodongdata_id` in(select `huodongdata_id` from `".dbpre."huodongdata` where `huodong_stime` <= '".time()."' and `huodong_etime` > '".time()."' order by `huodong_stime` asc) group by `product_id`");
foreach ($info_list as $v) {
	$db->pe_update('product', array('product_id'=>$v['product_id']), array('product_money'=>$v['product_money'], 'product_hd_tag'=>$v['huodong_tag'], 'product_hd_stime'=>$v['huodong_stime'], 'product_hd_etime'=>$v['huodong_etime']));
}*/

if (in_array("{$mod}.php", pe_dirlist("{$pe['path_root']}module/{$module}/*.php"))) {
	include("{$pe['path_root']}module/{$module}/{$mod}.php");
}
pe_result();
?>