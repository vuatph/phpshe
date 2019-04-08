<?php
function cache_write($cache_type = 'all') {
	global $db;
	switch ($cache_type) {
		case 'category':
			cache::write('category_product', $db->index('category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_article', $db->index('category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('category_productarr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_articlearr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
		break;
		case 'setting':
			cache::write('setting', 'setting_key');
		break;
		case 'link':
			cache::write('link', $db->pe_selectall('link', array('order by'=>'link_order asc')));
		break;
		case 'page':
			cache::write('page', $db->index('page_id')->pe_selectall('page', '', '`page_id`, `page_name`'));
		break;
		case 'template':
			pe_dirdel("{$pe['path_root']}data/cache/template");
		break;
		case 'attachment':
			pe_dirdel("{$pe['path_root']}data/cache/attachment");
		break;
		case 'thumb':
			pe_dirdel("{$pe['path_root']}data/cache/thumb");
		break;
		default:
			cache::write('category_product', $db->index('category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_article', $db->index('category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('category_productarr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_articlearr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('setting', 'setting_key');
			cache::write('link', $db->pe_selectall('link', array('order by'=>'link_order asc')));
			cache::write('page', $db->index('page_id')->pe_selectall('page', '', '`page_id`, `page_name`'));
			pe_dirdel("{$pe['path_root']}data/cache/template");
			pe_dirdel("{$pe['path_root']}data/cache/attachment");
			pe_dirdel("{$pe['path_root']}data/cache/thumb");
		break;
	}
}
?>