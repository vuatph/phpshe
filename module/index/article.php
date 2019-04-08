<?php
$cache_category_articlearr = cache::get('category_articlearr');
switch ($act) {
	//#####################@ 文章列表 @#####################//
	case 'list':
		$category_id = intval($_g_urlarg[1]);
		$info_list = $db->pe_selectall('article', array('category_id'=>$category_id, 'order by'=>'`article_id` desc'), '*', array(20, $_g_page));
		
		$seo = pe_seo($cache_category_articlearr[0][$category_id]['category_name']);
		include(pe_tpl('article_list.html'));
	break;
	//#####################@ 文章内容 @#####################//
	default:
		$article_id = intval($act);
		$info = $db->pe_select('article', array('article_id'=>$article_id));
		
		$db->pe_update('article', array('article_id'=>$article_id), array('article_clicknum'=>$info['article_clicknum']+1));

		$seo = pe_seo($info['article_name']);
		include(pe_tpl('article_view.html'));
	break;
}
?>