<?php
switch ($act) {
	//#####################@ 商品咨询sql @#####################//
	case 'askaddsql':
		$info['product_id'] = intval($_g_product_id);
		$info['ask_text'] = pe_texthtml(pe_dbhold($_g_ask_text));
		$info['ask_atime'] = time();
		$info['user_id'] = $_s_user_id;
		$info['user_name'] = $_s_user_name;
		$info['user_ip'] = pe_ip();

		if ($db->pe_insert('ask', $info)) {
			pe_hook('product');
			product_num('asknum', $info['product_id']);
			$result = true;
			$info['ask_atime'] = pe_date($info['ask_atime']);
			$info['ask_text'] = htmlspecialchars($_g_ask_text);
$html = <<<html
<ul>
	<li class="fl">会员：{$info['user_name']}</li>
	<li class="fr">咨询日期：{$info['ask_atime']}</li>
</ul>
<div class="padb10 mal10">
	<div class="mat5">{$info['ask_text']}</div>
</div>
html;
		}
		else {
			$result = false;
		}
		echo json_encode(array('result'=>$result, 'html'=>$html));
	break;
	//#####################@ 商品评价sql @#####################//
	case 'commentaddsql':
		$info['product_id'] = intval($_g_product_id);
		$info['comment_text'] = pe_texthtml(pe_dbhold($_g_comment_text));
		$info['comment_atime'] = time();
		$info['user_id'] = $_s_user_id;
		$info['user_name'] = $_s_user_name;
		$info['user_ip'] = pe_ip();

		if ($db->pe_insert('comment', $info)) {
			pe_hook('product');
			product_num("commentnum", $info['product_id']);
			$result = true;
			$info['comment_atime'] = pe_date($info['comment_atime']);
			$info['comment_text'] = htmlspecialchars($_g_comment_text);
$html = <<<html
<ul>
	<li class="fl">会员：{$info['user_name']}</li>
	<li class="fr">评价日期：{$info['comment_atime']}</li>
</ul>
<div class="pingjia">{$info['comment_text']}</div>
html;
		}
		else {
			$result = false;
		}
		echo json_encode(array('result'=>$result, 'html'=>$html));
	break;
	//#####################@ 商品收藏sql @#####################//
	case 'collectaddsql':
		$info['product_id'] = intval($_g_product_id);
		$info['user_id'] = $_s_user_id;
		if ($db->pe_num('collect', $info)) {
			$show = '您已经收藏过该商品了，请不要重复收藏噢！';
		}
		else {
			$info['collect_atime'] = time();
			if ($db->pe_insert('collect', $info)) {
				pe_hook('product');
				product_num('collectnum', $info['product_id']);
				$show = '商品收藏成功！';
			}
			else {
				$show = '商品收藏失败...';
			}
		}
		echo json_encode(array('show'=>$show));
	break;
	//#####################@ 商品列表 @#####################//
	case 'list':
		$category_id = intval($_g_urlarg[1]);
		$info = $db->pe_select('category', array('category_id'=>$category_id));

		//搜索标签
		$sqlwhere_arr['orderby'][1] = '`product_sellnum` desc';
		$sqlwhere_arr['orderby'][2] = '`product_smoney` asc';
		$sqlwhere_arr['orderby'][3] = '`product_commentnum` desc';
		$sqlwhere_arr['orderby'][4] = '`product_atime` desc';

		//搜索
		$sqlwhere = " and `product_state` = 1";
		$category_id && $sqlwhere .= " and `category_id` = '{$category_id}'";
		$_g_keyword && $sqlwhere .= " and `product_name` like '%{$_g_keyword}%'";
		$sqlwhere_arr['orderby'][$_g_orderby] && $sqlwhere .= " order by {$sqlwhere_arr['orderby'][$_g_orderby]}";

		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(16,$_g_page));

		//热卖排行
		pe_hook('product');
		$product_hotlist = product_hotlist();
		//当前路径
		pe_hook('category');
		$nowpath = category_path($category_id);
		//seo
		$seo = pe_seo($info['category_name']);

		include(pe_tpl('product_list.html'));
	break;
	//#####################@ 商品内容 @#####################//
	default:
		$product_id = intval($act);
		$info = $db->pe_select('product', array('product_id'=>$product_id));

		//咨询列表
		$ask_list = $db->pe_selectall('ask', array('product_id'=>$product_id, 'order by'=>'ask_atime desc'));
		//评价列表
		$comment_list = $db->pe_selectall('comment', array('product_id'=>$product_id, 'order by'=>'comment_atime desc'));
		//售后服务
		$page = $db->pe_select('page', array('page_id'=>7));

		//热卖排行
		pe_hook('product');
		$product_hotlist = product_hotlist();
		//更新点击
		product_num('clicknum', $product_id);
		//当前路径
		pe_hook('category');
		$nowpath = category_path($info['category_id'], $info['product_name']);
		//seo
		$seo = pe_seo($info['product_name']);

		include(pe_tpl('product_view.html'));
	break;
}
pe_result();
?>