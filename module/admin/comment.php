<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'comment';
pe_lead('hook/product.hook.php');
switch ($act) {
	//#####################@ 评价修改 @#####################//
	case 'edit':
		$comment_id = intval($_g_id);
		$sql = "select * from `".dbpre."comment` a,`".dbpre."product` b where a.`product_id` = b.`product_id` and a.`comment_id` = '{$comment_id}'";
		$info = $db->sql_select($sql);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('comment', array('comment_id'=>$comment_id), pe_dbhold($_p_info))) {
				product_num('commentnum', $info['product_id']);
				pe_success('评价修改成功!', 'admin.php?mod=comment');
			}
			else {
				pe_error('评价修改失败...');
			}
		}
		$seo = pe_seo($menutitle='修改评价', '', '', 'admin');
		include(pe_tpl('comment_add.html'));
	break;
	//#####################@ 评价删除 @#####################//
	case 'del':
		pe_token_match();
		$comment_id = is_array($_p_comment_id) ? $_p_comment_id : $_g_id;
		$info_list = $db->pe_selectall('comment', array('comment_id'=>$comment_id));
		if ($db->pe_delete('comment', array('comment_id'=>$comment_id))) {
			foreach ($info_list as $v) {
				product_num('commentnum', $v['product_id']);
			}			
			pe_success('评价删除成功!');
		}
		else {
			pe_error('评价删除失败...');
		}
	break;
	//#####################@ 评价列表 @#####################//
	default :
		$star_arr = array('hao'=>'4,5', 'zhong'=>'3', 'cha'=>'1,2');		
		$_g_star && $sqlwhere .= " and a.`comment_star` in ({$star_arr[$_g_star]})";
		$_g_name && $sqlwhere .= " and b.`product_name` like '%{$_g_name}%'";
		$_g_text && $sqlwhere .= " and a.`comment_text` like '%{$_g_text}%'";
		$_g_user_name && $sqlwhere .= " and a.`user_name` like '%{$_g_user_name}%'";
		$sql = "select * from `".dbpre."comment` a left join `".dbpre."product` b on a.`product_id` = b.`product_id` where 1 {$sqlwhere} order by a.`comment_id` desc";
		$info_list = $db->sql_selectall($sql, array(20, $_g_page));

		$num = $db->index('comment_star')->pe_selectall('comment', array('group by'=>'comment_star'), 'count(1) as num, `comment_star`');
		$tongji['all'] = intval($num[1]['num'] + $num[2]['num'] + $num[3]['num'] + $num[4]['num'] + $num[5]['num']);
		$tongji['hao'] = intval($num[4]['num'] + $num[5]['num']);
		$tongji['zhong'] = intval($num[3]['num']);
		$tongji['cha'] = intval($num[1]['num'] + $num[2]['num']);

		$seo = pe_seo($menutitle='评价管理', '', '', 'admin');
		include(pe_tpl('comment_list.html'));
	break;
}
?>