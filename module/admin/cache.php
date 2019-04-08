<?php
$menumark = 'cache_list';
switch ($act) {
	//#####################@ 缓存更新sql @#####################//
	case 'updatesql':
		pe_lead('hook/cache.hook.php');
		cache_write($_g_cache);
		pe_success('缓存更新成功!');
	break;
	//#####################@ 缓存列表 @#####################//
	default:
		//数据库缓存
		$info_list['category']['cache_name'] = '分类信息';
		$info_list['category']['cache_text'] = '网站【商品分类】或【文章分类】显示错乱或不显示时，可尝试更新此项解决。';
		$category_size = filesize("{$pe['path_root']}data/cache/category_product.cache.php");
		$category_size += filesize("{$pe['path_root']}data/cache/category_productarr.cache.php");
		$category_size += filesize("{$pe['path_root']}data/cache/category_article.cache.php");
		$category_size += filesize("{$pe['path_root']}data/cache/category_articlearr.cache.php");
		$info_list['category']['cache_size'] = round($category_size/1024, 1);

		$info_list['setting']['cache_name'] = '网站信息';
		$info_list['setting']['cache_text'] = '网站【基本信息】显示错乱或不显示时，可尝试更新此项解决。';
		$info_list['setting']['cache_size'] = round(filesize("{$pe['path_root']}data/cache/setting.cache.php")/1024, 1);

		$info_list['link']['cache_name'] = '友链信息';
		$info_list['link']['cache_text'] = '网站【友情链接】显示错乱或不显示时，可尝试更新此项解决。';
		$info_list['link']['cache_size'] = round(filesize("{$pe['path_root']}data/cache/link.cache.php")/1024, 1);
		
		$info_list['page']['cache_name'] = '单页信息';
		$info_list['page']['cache_text'] = '网站单页名称显示错乱或不显示时，可尝试更新此项解决。';
		$info_list['page']['cache_size'] = round(filesize("{$pe['path_root']}data/cache/page.cache.php")/1024, 1);

		//数据缓存
		$info_list['template']['cache_name'] = '模板信息';
		$info_list['template']['cache_text'] = '网站页面显示错乱或不显示时，可尝试更新此项解决。';
		$info_list['template']['cache_size'] = round(pe_dirsize("{$pe['path_root']}data/cache/template")/1024, 1);

		$info_list['attachment']['cache_name'] = '附件信息';
		$info_list['attachment']['cache_text'] = '只要有附件缓存存在，就可以更新此项。';
		$info_list['attachment']['cache_size'] = round(pe_dirsize("{$pe['path_root']}data/cache/attachment")/1024, 1);

		$info_list['thumb']['cache_name'] = '缩略图信息';
		$info_list['thumb']['cache_text'] = '只要有缩略图缓存存在，就可以更新此项。';
		$info_list['thumb']['cache_size'] = round(pe_dirsize("{$pe['path_root']}data/cache/thumb")/1024, 1);

		$seo = pe_seo('缓存管理', '', '', 'admin');
		include(pe_tpl('cache_list.html'));
	break;
}
pe_result();
?>