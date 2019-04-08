<?php
$nowpath = "<a href='{$pe['host_root']}'>首页</a> > 会员中心";
if ($_s_user_id_key && in_array($act, array('login', 'loginsql', 'register', 'registersql'))) {
	pe_goto("{$pe['host_root']}index.php?mod=user&act=orderlist");
}
if (!$_s_user_id_key && !in_array($act, array('login', 'loginsql', 'register', 'registersql'))) {
	pe_goto(pe_url('user-login'));
}
include("{$pe['path_root']}include/ini/paytype.ini.php");
switch($act) {
	//#####################@ 用户登录 @#####################//
	case 'login':
		$seo = pe_seo('用户登录');
		$action = "{$pe['host_root']}index.php?mod=user&act=loginsql";
		$action = $_g_from ? "{$action}&from=".urlencode(urldecode($_g_from)) : "{$action}&from=".urlencode($_SERVER['HTTP_REFERER']);
 		include(pe_tpl('user_login.html'));
	break;
	//#####################@ 用户登录sql @#####################//
	case 'loginsql':
		$_p_info['user_pw'] = md5($_p_info['user_pw']);
		if ($info = $db->pe_select('user', $_p_info)) {
			$db->pe_update('user', array('user_id'=>$info['user_id']), array('user_ltime'=>time()));
			$_SESSION['user_id_key'] = md5($pe['host_root'].time());
			$_SESSION['user_id'] = $info['user_id'];
			$_SESSION['user_name'] = $info['user_name'];
			$_SESSION['user_ltime'] = pe_date($info['user_ltime']);
			//未登录时的购物车列表入库
			if (is_array($cart_list = unserialize($_c_cart_list))) {
				$cart_rows = $db->index('product_id')->pe_selectall('cart', array('user_id'=>$info['user_id']));
				foreach ($cart_list as $k => $v) {
					if (array_key_exists($k, $cart_rows)) {
						$db->pe_update('cart', array('cart_id'=>$cart_rows[$k]['cart_id']), array('product_num'=>$cart_rows[$k]['product_num']+$cart_list[$k]['product_num']));
					}
					else {
						$cart_info['cart_atime'] = time();
						$cart_info['product_id'] = $k;
						$cart_info['product_num'] = $v['product_num'];
						$cart_info['user_id'] = $info['user_id'];
						$db->pe_insert('cart', $cart_info);
					}
				}
				setcookie('cart_list', '', time()-3600);
			}
			$db->pe_update('user', array('user_id'=>$info['user_id']), array('user_ltime'=>time()));
			pe_success('用户登录成功！', $_g_from ? urldecode($_g_from) : $pe['host_root']);
		}
		else {
			pe_error('用户名或密码错误...');
		}
	break;
	//#####################@ 用户退出 @#####################//
	case 'logout':
		unset($_SESSION['user_id_key'], $_SESSION['user_id'], $_SESSION['user_name']);
		pe_success('用户退出成功！', $pe['host_root']);
	break;
	//#####################@ 用户注册 @#####################//
	case 'register':
		$seo = pe_seo('用户注册');
		$action = "{$pe['host_root']}index.php?mod=user&act=registersql";
 		include(pe_tpl('user_register.html'));
	break;
	//#####################@ 用户注册sql @#####################//
	case 'registersql':
		if ($_g_type == 'checkname') {
			$result = $db->pe_num('user', array('user_name'=>pe_dbhold($_g_user_name))) > 0 ? false : true;
			echo json_encode(array('result'=>$result));
		}
		else {
			$_p_info['user_pw'] = md5($_p_info['user_pw']);
			$_p_info['user_atime'] = $info['user_ltime'] = time();
			if ($user_id = $db->pe_insert('user', $_p_info)) {
				$info = $db->pe_select('user', array('user_id'=>$user_id));
				$_SESSION['user_id_key'] = md5($pe['host_root'].time());
				$_SESSION['user_id'] = $info['user_id'];
				$_SESSION['user_name'] = $info['user_name'];
				$_SESSION['user_ltime'] = pe_date($info['user_ltime']);
				pe_success('用户注册成功！', $pe['host_root']);
			}
			else {
				pe_error('用户注册失败...');
			}
		}

	break;
	//#####################@ 订单列表 @#####################//
	case 'orderlist':
		$info_list = $db->pe_selectall('order', array('user_id'=>$_s_user_id, 'order by'=>'order_id desc'), '*', array(10, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}
		$nowpath = "{$nowpath} > 我的订单";
		$seo = pe_seo('我的订单');
		include(pe_tpl('user_orderlist.html'));
	break;
	//#####################@ 订单收货信息 @#####################//
	case 'ordersh':
		$info = $db->pe_select('order', array('order_id'=>$_g_id, 'user_id'=>$_s_user_id, 'order by'=>'order_id desc'));
		include(pe_tpl('user_ordersh.html'));
	break;
	//#####################@ 订单删除sql @#####################//
	case 'orderdelsql':
		$rows = $db->pe_select('order', array('user_id'=>$_s_user_id, 'order_id'=>$_g_id, 'order_state'=>'notpay'));
		if ($rows['order_id']) {
			if ($db->pe_delete('order', array('order_id'=>$rows['order_id']))) {
				//更新商品库存数
				pe_lead('hook/product.hook.php');
				product_num('num', $rows['order_id'], 'add');
				//删除订单子表数据
				$db->pe_delete('orderdata', array('order_id'=>$rows['order_id']));
				pe_success('订单删除成功！');
			}
			else {
				pe_error('订单删除失败...');
			}
		}
		else {
			pe_error('抱歉，已付款订单不能删除...');
		}
	break;
	//#####################@ 收藏列表 @#####################//
	case 'collectlist':
		$sql = "select * from `".dbpre."collect` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}' order by a.`collect_id` desc";
		$info_list = $db->sql_selectall($sql, array(10, $_g_page));
		
		$nowpath = "{$nowpath} > 我的收藏";
		$seo = pe_seo('我的收藏');
		include(pe_tpl('user_collectlist.html'));
	break;
	//#####################@ 收藏删除sql @#####################//
	case 'collectdel':
		if ($db->pe_delete('collect', array('collect_id'=>intval($_g_id), 'user_id'=>$_s_user_id))) {
			pe_hook('product');
			product_num('collect', $_g_product_id);
			pe_success('商品收藏删除成功！');
		}
		else {
			pe_error('商品收藏删除失败...');
		}
	break;
	//#####################@ 咨询列表 @#####################//
	case 'asklist':
		$sql = "select * from `".dbpre."ask` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}' order by a.`ask_id` desc";
		$info_list = $db->sql_selectall($sql, array(10, $_g_page));
		
		$nowpath = "{$nowpath} > 我的咨询";
		$seo = pe_seo('我的咨询');
		include(pe_tpl('user_asklist.html'));
	break;
	//#####################@ 评价列表 @#####################//
	case 'commentlist':
		$sql = "select * from `".dbpre."comment` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}' order by a.`comment_id` desc";
		$info_list = $db->sql_selectall($sql, array(10, $_g_page));
		
		$nowpath = "{$nowpath} > 我的评价";
		$seo = pe_seo('我的评价');
		include(pe_tpl('user_commentlist.html'));
	break;
	//#####################@ 基本信息 @#####################//
	case 'base':
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));

		$nowpath = "{$nowpath} > 基本信息";

		$seo = pe_seo('基本信息');
		$action = "index.php?mod=user&act=basesql";
		include(pe_tpl('user_base.html'));
	break;
	//#####################@ 基本信息sql @#####################//
	case 'basesql':
		if ($db->pe_update('user', array('user_id'=>$_s_user_id), $_p_info)) {
			pe_success('基本信息修改成功！');
		}
		else {
			pe_error('基本信息修改失败...');
		}
	break;
	//#####################@ 密码修改  @#####################//
	case 'pw':
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
	
		$nowpath = "{$nowpath} > 修改密码";

		$seo = pe_seo('修改密码');
		$action = "index.php?mod=user&act=pwsql";
		include(pe_tpl('user_pw.html'));
	break;
	//#####################@ 密码修改sql @#####################//
	case 'pwsql':
		if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_pw'=>md5($_p_info['user_pw'])))) {
			pe_success('密码修改成功！');
		}
		else {
			pe_error('密码修改失败...');
		}
	break;
}
pe_result();
?>