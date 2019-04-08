<?php
switch ($act) {
	//#####################@ 评价列表 @#####################//
	default:
		$star_arr = array('hao'=>array(4,5), 'zhong'=>3, 'cha'=>array(1,2));	
		if (array_key_exists($_g_star, $star_arr)) $sql_where['comment_star'] = $star_arr[$_g_star];
		$sql_where['product_id'] = intval($_g_id);
		$sql_where['order by'] = "`comment_id` desc";	
		$info_list = $db->pe_selectall('comment', $sql_where, 'user_name,comment_atime,comment_star,comment_text', array('20', $_g_page));
		foreach ($info_list as $k=>$v) {
			$info_list[$k]['comment_atime'] = pe_date($v['comment_atime'], 'Y-m-d');
			$info_list[$k]['comment_star'] = pe_comment($v['comment_star']);
		}
		pe_jsonshow(array('list'=>$info_list, 'page'=>$db->page->ajax('comment_page')));
	break;
}
?>