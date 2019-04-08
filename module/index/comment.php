<?php
pe_lead('hook/product.hook.php');
switch ($act) {
	//#####################@ 评价列表 @#####################//
	default:
		$star_arr = array('hao'=>array(4,5), 'zhong'=>3, 'cha'=>array(1,2));	
		if (array_key_exists($_g_star, $star_arr)) $sql_where['comment_star'] = $star_arr[$_g_star];
		$sql_where['product_id'] = intval($_g_product_id);
		$sql_where['order by'] = "`comment_id` desc";		
		$info_list = $db->pe_selectall('comment', $sql_where, '*', array('10', $_g_page));
		foreach ($info_list as $v) {
$comment_atime = pe_date($v['comment_atime']);
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