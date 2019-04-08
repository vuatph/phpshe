<?php
function cache_write($cache_type = 'all') {
	global $db,$pe;
	switch ($cache_type) {
		case 'category':
			cache::write('category', $category_list = $db->index('category_id')->pe_selectall('category', array('order by'=>'`category_order` asc, `category_id` asc')));
			cache::write('category_arr', $db->index('category_pid|category_id')->pe_selectall('category', array('order by'=>'`category_order` asc, `category_id` asc')));
			pe_lead('hook/category.hook.php');
			foreach ($category_list as $v) {
				$category_cidarr = category_cidarr($v['category_id']);
				$category_ids = is_array($category_cidarr) ? implode(",", category_cidarr($v['category_id'])) : $category_cidarr;				
				$sql = "select distinct(a.brand_id), b.brand_name from `".dbpre."product` a, `".dbpre."brand` b where a.`brand_id` = b.`brand_id` and a.`category_id` in({$category_ids}) order by b.`brand_order` asc, b.`brand_id` asc";
				$category_brand[$v['category_id']] = $db->index('brand_id')->sql_selectall($sql);
			}
			cache::write('category_brand', $category_brand);
		break;
		case 'class':
			cache::write('class', $db->index('class_id')->pe_selectall('class', array('order by'=>'`class_order` asc, `class_id` asc')));
			cache::write('class_arr', $db->index('class_type|class_id')->pe_selectall('class', array('order by'=>'`class_order` asc, `class_id` asc')));
		break;
		case 'brand':
			cache::write('brand', $db->index('brand_id')->pe_selectall('brand', array('order by'=>'`brand_word` asc, `brand_order` asc, `brand_id` asc')));
		break;
		case 'rule':
			$rule_list = $db->index('rule_id')->pe_selectall('rule');
			$ruledata_list = $db->index('rule_id|ruledata_id')->pe_selectall('ruledata', array('order by'=>'ruledata_order asc'));
			foreach ($rule_list as $k=>$v) {
				$rule_list[$k]['list'] = $ruledata_list[$k];
			}
			cache::write('rule', $rule_list);
		break;
		case 'setting':
			cache::write('setting', 'setting_key');
		break;
		case 'menu':
			cache::write('menu', $db->pe_selectall('menu', array('order by'=>'`menu_order` asc, `menu_id` asc')));
		break;
		case 'payway':
			cache::write('payway', $db->index('payway_mark')->pe_selectall('payway', array('order by'=>'`payway_order` asc, `payway_id` asc')));
		break;
		case 'link':
			cache::write('link', $db->pe_selectall('link', array('order by'=>'`link_order` asc, `link_id` asc')));
		break;
		case 'page':
			cache::write('page', $db->index('page_id')->pe_selectall('page', '', '`page_id`, `page_name`'));
		break;
		case 'ad':
			cache::write('ad', $db->index('ad_position|ad_id')->pe_selectall('ad', array('order by'=>'`ad_order` asc, `ad_id` asc')));
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
			cache::write('category', $db->index('category_id')->pe_selectall('category', array('order by'=>'`category_order` asc, `category_id` asc')));
			cache::write('category_arr', $db->index('category_pid|category_id')->pe_selectall('category', array('order by'=>'`category_order` asc, `category_id` asc')));
			pe_lead('hook/category.hook.php');
			$category_list = $db->pe_selectall('category');
			foreach ($category_list as $v) {
				$category_cidarr = category_cidarr($v['category_id']);
				$category_ids = is_array($category_cidarr) ? implode(",", category_cidarr($v['category_id'])) : $category_cidarr;				
				$sql = "select distinct(a.brand_id), b.brand_name from `".dbpre."product` a, `".dbpre."brand` b where a.`brand_id` = b.`brand_id` and a.`category_id` in({$category_ids}) order by b.`brand_order` asc, b.`brand_id` asc";
				$category_brand[$v['category_id']] = $db->index('brand_id')->sql_selectall($sql);
			}
			cache::write('category_brand', $category_brand);
			cache::write('class', $db->index('class_id')->pe_selectall('class', array('order by'=>'`class_order` asc, `class_id` asc')));
			cache::write('class_arr', $db->index('class_type|class_id')->pe_selectall('class', array('order by'=>'`class_order` asc, `class_id` asc')));
			cache::write('brand', $db->index('brand_id')->pe_selectall('brand', array('order by'=>'`brand_word` asc, `brand_order` asc, `brand_id` asc')));
			$rule_list = $db->index('rule_id')->pe_selectall('rule');
			$ruledata_list = $db->index('rule_id|ruledata_id')->pe_selectall('ruledata', array('order by'=>'ruledata_order asc'));
			foreach ($rule_list as $k=>$v) {
				$rule_list[$k]['list'] = $ruledata_list[$k];
			}
			cache::write('rule', $rule_list);
			cache::write('setting', 'setting_key');
			cache::write('menu', $db->pe_selectall('menu', array('order by'=>'`menu_order` asc, `menu_id` asc')));
			cache::write('payway', $db->index('payway_mark')->pe_selectall('payway', array('order by'=>'`payway_order` asc, `payway_id` asc')));
			cache::write('link', $db->pe_selectall('link', array('order by'=>'link_order asc')));
			cache::write('page', $db->index('page_id')->pe_selectall('page', '', '`page_id`, `page_name`'));
			cache::write('ad', $db->index('ad_position|ad_id')->pe_selectall('ad', array('order by'=>'`ad_order` asc, `ad_id` asc')));
			pe_dirdel("{$pe['path_root']}data/cache/template");
			pe_dirdel("{$pe['path_root']}data/cache/attachment");
			pe_dirdel("{$pe['path_root']}data/cache/thumb");
		break;
	}
}
?>