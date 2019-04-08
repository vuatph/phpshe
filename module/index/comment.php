<?php
pe_lead('hook/product.hook.php');
switch ($act) {
	//#####################@ 新增评价 @#####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			$info['product_id'] = intval($_g_id);
			$info['comment_star'] = intval($_p_comment_star);
			$info['comment_text'] = $_p_comment_text;
			$info['comment_atime'] = time();
			$info['user_id'] = $_s_user_id;
			$info['user_name'] = $_s_user_name;
			$info['user_ip'] = pe_ip();
			if ($db->pe_insert('comment', pe_dbhold($info))) {
				product_num("commentnum", $info['product_id']);
				$result = true;
$comment_atime = pe_date($info['comment_atime'], 'Y-m-d');
$comment_star = comment_star($info['comment_star']);
$html .= <<<html
<ul class="plmain_ul">
	<li class="fl cblue">{$info['user_name']}</li>
	<li class="fl mal10 c888">{$comment_atime}</li>
	<li class="fr mat3">{$comment_star}</li>
</ul>
<div class="pingjia font14">{$info['comment_text']}</div>
html;
			}
			else {
				$result = false;
			}
			echo json_encode(array('result'=>$result, 'html'=>$html));
		}
	break;
	//#####################@ 评价列表 @#####################//
	default:
		$star_arr = array(1=>'1', 2=>array(2,3), 3=>array(4,5));	
		if (array_key_exists($_g_star, $star_arr)) $sql_where['comment_star'] = $star_arr[$_g_star];
		$sql_where['product_id'] = intval($_g_product_id);
		$sql_where['order by'] = "`comment_id` desc";		
		$info_list = $db->pe_selectall('comment', $sql_where, '*', array('10', $_g_page));
		foreach ($info_list as $v) {
$comment_atime = pe_date($v['comment_atime'], 'Y-m-d');
$comment_star = comment_star($v['comment_star']);
$html .= <<<html
<ul class="plmain_ul">
	<li class="fl cblue">{$v['user_name']}</li>
	<li class="fl mal10 c888">{$comment_atime}</li>
	<li class="fr mat3">{$comment_star}</li>
</ul>
<div class="pingjia font14">{$v['comment_text']}</div>
html;
		}

		echo json_encode(array('html'=>$html, 'page'=>$db->page->ajax('comment_page')));
	break;
}
?>