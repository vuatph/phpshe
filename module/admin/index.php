<?php
/**
 * @copyright   2008-2014 简好技术 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'index';

$tongji['product_up'] = $db->pe_num('product', array('product_state'=>1));
$tongji['product_down'] = $db->pe_num('product', array('product_state'=>2));
$tongji['product_empty'] = $db->pe_num('product', array('product_num'=>0));
$tongji['product_tuijian'] = $db->pe_num('product', array('product_istuijian'=>1));


$tongji['order_today'] = $db->pe_num('order', " and `order_atime` >= '".strtotime(date('Y-m-d'))."'");
$tongji['order_lastday'] = $db->pe_num('order', " and `order_atime` < '".strtotime(date('Y-m-d'))."' and `order_atime` >= '".strtotime('-1 day')."'");
$tongji['order_all'] = $db->pe_num('order'); 
$tongji['order_success'] = $db->pe_num('order', array('order_state'=>'success')); 



$tongji['money_today'] = $db->pe_select('order', " and `order_atime` >= '".strtotime(date('Y-m-d'))."'", "sum(`order_money`) as `money`");
$tongji['money_lastday'] = $db->pe_select('order', " and `order_atime` < '".strtotime(date('Y-m-d'))."' and `order_atime` >= '".strtotime('-1 day')."'", "sum(`order_money`) as `money`");
$tongji['money_all'] = $db->pe_select('order', "", "sum(`order_money`) as `money`"); 
$tongji['order_success'] = $db->pe_num('order', array('order_state'=>'success'));

$tongji['money_today'] = $tongji['money_today']['money'] ? $tongji['money_today']['money'] : '0.0';
$tongji['money_lastday'] = $tongji['money_lastday']['money'] ? $tongji['money_lastday']['money'] : '0.0';
$tongji['money_all'] = $tongji['money_all']['money'] ? $tongji['money_all']['money'] : '0.0';
//$tongji['money_today'] = $tongji['money_today']['money'] ? $tongji['money_today']['money'] : 0.0;

$tongji['iplog_today'] = $db->pe_num('iplog', array('iplog_adate'=>date('Y-m-d')));
$tongji['iplog_lastday'] = $db->pe_num('iplog', array('iplog_adate'=>date('Y-m-d', time()-86400)));
$tongji['iplog_all'] = $db->pe_num('iplog');
$tongji['iplog_user'] = $db->pe_num('user');

$iplog_list = $db->pe_selectall('iplog', array('order by'=>'`iplog_atime` desc'), '*', array(20));


$seo = pe_seo($menutitle='后台首页', '', '', 'admin');
include(pe_tpl('index.html'));
?>