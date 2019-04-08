<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'index';
switch ($act) {
	//#####################@ phpinfo信息 @#####################//
	case 'phpinfo':
		phpinfo();
	break;
	//#####################@ 后台首页 @#####################//
	default:
		$time1 = strtotime(date('Y-m-d'));
		$time2 = strtotime('-1 day');
		$tongji['iplog_today'] = $db->pe_num('iplog', array('iplog_adate'=>date('Y-m-d')));
		$tongji['iplog_lastday'] = $db->pe_num('iplog', array('iplog_adate'=>date('Y-m-d', time()-86400)));
		$tongji['iplog_all'] = $db->pe_num('iplog');

		$tongji['user_today'] = $db->pe_num('user', " and `user_atime` >= '{$time1}'");
		$tongji['user_lastday'] = $db->pe_num('user', " and `user_atime` >= '{$time2}' and `user_atime` < '{$time1}'");
		$tongji['user_all'] = $db->pe_num('user'); 

		$tongji['order_today'] = $db->pe_num('order', " and `order_atime` >= '{$time1}'");
		$tongji['order_lastday'] = $db->pe_num('order', " and `order_atime` >= '{$time2}' and `order_atime` < '{$time1}'");
		$tongji['order_all'] = $db->pe_num('order'); 

		$tongji['product_num'] = $db->pe_num('product');
		$tongji['ask_num'] = $db->pe_num('ask');
		$tongji['comment_num'] = $db->pe_num('comment');

		$tongji['order_notpay'] = $db->pe_num('order', " and `order_state` = 'notpay' and `order_payway` != 'cod'");
		$tongji['order_waitsend'] = $db->pe_num('order', " and (`order_state` = 'paid' or (`order_state` = 'notpay' and `order_payway` = 'cod'))");
		$tongji['order_waitsure'] = $db->pe_num('order', array('order_state'=>'send'));
		$tongji['ask_waitreply'] = $db->pe_num('ask', array('ask_state'=>0));

		$php_os = PHP_OS;
		$php_version = PHP_VERSION;
		$php_mysql = 'MySQL '.mysql_get_server_info();
		if (stripos($_SERVER["SERVER_SOFTWARE"], 'iis') !== false) {
			$iis_arr = explode('/', $_SERVER["SERVER_SOFTWARE"]);
			$php_apache = "IIS/{$iis_arr[1]}";
		}
		else {
			$apache_arr = explode(' ', $_SERVER["SERVER_SOFTWARE"]);
			$php_apache = $apache_arr[0];	
		}
		$seo = pe_seo($menutitle='后台首页', '', '', 'admin');
		include(pe_tpl('index.html'));
	break;
}
?>