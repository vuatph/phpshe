<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$class_type_arr = array('news'=>'资讯中心', 'help'=>'帮助中心');
switch ($act) {
	//#####################@ 文章列表 @#####################//
	case 'list':
		$class_id = intval($id);
		$info_list = $db->pe_selectall('article', array('class_id'=>$class_id, 'order by'=>'`article_atime` desc'), '*', array(15, $_g_page));

		$nowpath = " > {$class_type_arr[$cache_class[$class_id]['class_type']]} > <a href='".pe_url("article-list-{$class_id}")."'>{$cache_class[$class_id]['class_name']}</a>";
		$menutitle = $cache_class[$class_id]['class_name'];
		$seo = pe_seo($menutitle);
		include(pe_tpl('article_view.html'));
	break;
	//#####################@ 文章内容 @#####################//
	default:
		$article_id = intval($act);
		$db->pe_update('article', array('article_id'=>$article_id), '`article_clicknum`=`article_clicknum`+'.rand(2,5));
		$info = $db->pe_select('article', array('article_id'=>$article_id));
		$class_id = $info['class_id'];
		
		$nowpath = " > {$class_type_arr[$cache_class[$class_id]['class_type']]}> <a href='".pe_url("article-list-{$class_id}")."'>{$cache_class[$class_id]['class_name']}</a>  > <a href='".pe_url("article-{$article_id}")."'>{$info['article_name']}</a>";
		$menutitle = $cache_class[$class_id]['class_name'];
		$seo = pe_seo($info['article_name']);
		include(pe_tpl('article_view.html'));
	break;
}
?>