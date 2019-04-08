<?php
pe_lead('hook/product.hook.php');
switch ($act) {
	//#####################@ 新增咨询 @#####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			$info['product_id'] = intval($_g_id);
			$info['ask_text'] = $_p_ask_text;
			$info['ask_atime'] = time();
			$info['user_id'] = $_s_user_id;
			$info['user_name'] = $_s_user_name;
			$info['user_ip'] = pe_ip();
			if ($db->pe_insert('ask', pe_dbhold($info))) {
				product_num('asknum', $info['product_id']);
				$result = true;
				$info['ask_atime'] = pe_date($info['ask_atime'], 'Y-m-d');
				$info['ask_text'] = pe_dbhold($_p_ask_text);
$html = <<<html
<div class="ask_main"><i>Q</i><p><span class="cblue">{$info['user_name']}：</span>{$info['ask_text']}</p><span class="fr c888 font12">{$info['ask_atime']}</span><div class="clear"></div></div>
<div class="rep_main"><i>A</i><p>{$info['ask_replytext']}</p><div class="clear"></div></div>
html;
			}
			else {
				$result = false;
			}
			echo json_encode(array('result'=>$result, 'html'=>$html));
		}
	break;
	//#####################@ 资讯列表 @#####################//
	default:
		$sql_where['product_id'] = intval($_g_product_id);
		$sql_where['order by'] = "`ask_id` desc";
		$info_list = $db->pe_selectall('ask', $sql_where, '*', array('10', $_g_page));
		foreach ($info_list as $v) {
$ask_atime = pe_date($v['ask_atime'], 'Y-m-d');
$html .= <<<html
<div class="ask_main"><i>Q</i><p><span class="cblue">{$v['user_name']}：</span>{$v['ask_text']}</p><span class="fr c888 font12">{$ask_atime}</span><div class="clear"></div></div>
<div class="rep_main"><i>A</i><p>{$v['ask_replytext']}</p><div class="clear"></div></div>
html;
		}
		echo json_encode(array('html'=>$html, 'page'=>$db->page->ajax('ask_page')));
	break;
}
?>