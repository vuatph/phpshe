<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2011-0501 koyshe <koyshe@gmail.com>
 */
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('PRC');
header('Content-Type: text/html; charset=utf-8');

//#################=====关闭register_globals=====#################//
if (@ini_get('register_globals')) {
	foreach ($_REQUEST as $name => $value) unset($$name);
}

//#################=====定义根路径=====#################//
$pe['host_root'] = 'http://'.str_ireplace(rtrim(str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']), '/'), $_SERVER['HTTP_HOST'], str_replace('\\', '/', dirname(__FILE__))).'/';
$pe['path_root'] = str_replace('\\','/',dirname(__FILE__)).'/';

//#################=====包含常用类-函数文件=====#################//
include($pe['path_root'].'config.php');
include($pe['path_root'].'hook/ini.hook.php');
include($pe['path_root'].'include/class/db.class.php');
include($pe['path_root'].'include/class/page.class.php');
include($pe['path_root'].'include/class/cache.class.php');
include($pe['path_root'].'include/function/global.func.php');
include($pe['path_root'].'include/function/license.func.php');
//#################=====URL路由配置=====#################//
pe_urlroute();

//#################=====定义模板路径=====#################//
$cache_setting = cache::get('setting');
$module_tpl = $cache_setting['web_tpl'];
if (!is_dir("{$pe['path_root']}template/{$module_tpl}/{$module}/")) {
	$module_tpl = 'default';
}
$pe['host_tpl'] = "{$pe['host_root']}template/{$module_tpl}/{$module}/";
$pe['path_tpl'] = "{$pe['path_root']}template/{$module_tpl}/{$module}/";

//#################=====重新定义GPC=====#################//
if (get_magic_quotes_gpc()) {
	!empty($_GET) && extract(pe_trim(pe_stripslashes($_GET)), EXTR_PREFIX_ALL, '_g');
	!empty($_POST) && extract(pe_trim(pe_stripslashes($_POST)), EXTR_PREFIX_ALL, '_p');
}
else {
	!empty($_GET) && extract(pe_trim($_GET),EXTR_PREFIX_ALL,'_g');
	!empty($_POST) && extract(pe_trim($_POST),EXTR_PREFIX_ALL,'_p');
}
session_start();
!empty($_SESSION) && extract(pe_trim($_SESSION),EXTR_PREFIX_ALL,'_s');
!empty($_COOKIE) && extract(pe_trim(pe_stripslashes($_COOKIE)),EXTR_PREFIX_ALL,'_c');
$pe_token = $_s_pe_token;

//#################=====连接数据库开始吧=====#################//
$db = new db($pe['db_host'], $pe['db_user'], $pe['db_pw'], $pe['db_name'], $pe['db_coding']);
?>