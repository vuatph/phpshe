<?php
function cache_write($cache_type = 'all') {
	global $db, $pe;
	if (in_array($cache_type, array('category', 'all', 'data'))) {
		cache::write('category', $category_list = $db->index('category_id')->pe_selectall('category', array('order by'=>'`category_order` asc, `category_id` asc')));
		cache::write('category_arr', $db->index('category_pid|category_id')->pe_selectall('category', array('order by'=>'`category_order` asc, `category_id` asc')));
		pe_lead('hook/category.hook.php');
		$category_brand = array();
		foreach ($category_list as $v) {
			$category_cidarr = category_cidarr($v['category_id']);
			$category_ids = is_array($category_cidarr) ? implode(",", category_cidarr($v['category_id'])) : $category_cidarr;				
			$sql = "select distinct(a.brand_id), b.brand_name from `".dbpre."product` a, `".dbpre."brand` b where a.`brand_id` = b.`brand_id` and a.`category_id` in({$category_ids}) order by b.`brand_order` asc, b.`brand_id` asc";
			$category_brand[$v['category_id']] = $db->index('brand_id')->sql_selectall($sql);
		}
		cache::write('category_brand', $category_brand);
	}
	if (in_array($cache_type, array('brand', 'all', 'data'))) {
		cache::write('brand', $db->index('brand_id')->pe_selectall('brand', array('order by'=>'`brand_word` asc, `brand_order` asc, `brand_id` asc')));
	}	
	if (in_array($cache_type, array('rule', 'all', 'data'))) {
		$rule_list = $db->index('rule_id')->pe_selectall('rule');
		$ruledata_list = $db->index('rule_id|ruledata_id')->pe_selectall('ruledata', array('order by'=>'ruledata_order asc'));
		foreach ($rule_list as $k=>$v) {
			$rule_list[$k]['list'] = $ruledata_list[$k];
		}
		cache::write('rule', $rule_list);
		cache::write('ruledata', $db->index('ruledata_id')->pe_selectall('ruledata', array('order by'=>'ruledata_order asc')));
	}	
	if (in_array($cache_type, array('class', 'all', 'data'))) {
		cache::write('class', $db->index('class_id')->pe_selectall('class', array('order by'=>'`class_order` asc, `class_id` asc')));
		cache::write('class_arr', $db->index('class_type|class_id')->pe_selectall('class', array('order by'=>'`class_order` asc, `class_id` asc')));
	}
	if (in_array($cache_type, array('adminlevel', 'all', 'data'))) {
		cache::write('adminlevel', $db->index('adminlevel_id')->pe_selectall('adminlevel'));
	}
	if (in_array($cache_type, array('setting', 'all', 'data'))) {
		$info_list = $db->index('setting_key')->pe_selectall('setting');
		foreach ($info_list as $v) {
			$info_list[$v['setting_key']] = $v['setting_value'];
		}
		cache::write('setting', $info_list);
	}
	if (in_array($cache_type, array('payway', 'all', 'data'))) {
		cache::write('payway', $db->index('payway_mark')->pe_selectall('payway', array('order by'=>'`payway_order` asc, `payway_id` asc')));
	}
	if (in_array($cache_type, array('notice', 'all', 'data'))) {
		cache::write('notice', $db->index('notice_mark|notice_obj')->pe_selectall('notice'));
	}
	if (in_array($cache_type, array('menu', 'all', 'data'))) {
		$info_list = $db->pe_selectall('menu', array('order by'=>'`menu_order` asc, `menu_id` asc'));
		foreach ($info_list as &$v) {
			if ($v['menu_type'] == 'sys') {
				$v['menu_url'] = pe_url($v['menu_url']);
			}
			else {
				$v['target'] = 'target="blank"';
			}
		}
		cache::write('menu', $info_list);
	}
	if (in_array($cache_type, array('link', 'all', 'data'))) {
		cache::write('link', $db->pe_selectall('link', array('order by'=>'`link_order` asc, `link_id` asc')));
	}
	if (in_array($cache_type, array('ad', 'all', 'data'))) {
		cache::write('ad', $db->index('ad_position|ad_id')->pe_selectall('ad', array('ad_state'=>1, 'order by'=>'`ad_order` asc, `ad_id` asc')));
	}
	if (in_array($cache_type, array('template', 'all'))) {
		pe_dirdel("{$pe['path_root']}data/cache/template");
	}
	if (in_array($cache_type, array('attachment', 'all'))) {
		pe_dirdel("{$pe['path_root']}data/cache/attachment");
	}
	if (in_array($cache_type, array('thumb', 'all'))) {
		pe_dirdel("{$pe['path_root']}data/cache/thumb");
	}
}
?>