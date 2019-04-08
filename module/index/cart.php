<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
pe_lead('hook/order.hook.php');
$user_id = pe_login('user') ? $_s_user_id : pe_user_id();
switch ($act) {
	//#####################@ 购物车添加 @#####################//
	case 'add':
		if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
		if (!in_array($_g_type, array('cart', 'buy'))) pe_jsonshow(array('result'=>false, 'show'=>'参数错误'));
		$cart_type = $_g_type;
		$product_id = intval($_g_id);
		$product_num = intval($_g_num);
		$prorule_key = pe_dbhold($_g_rule);
		$product_guid = md5("{$product_id},{$prorule_key}");
		//检测库存
		$product = $db->pe_select('product', array('product_id'=>$product_id), '`product_num`, `product_rule`');
		if ($product['product_rule']) {
			$prorule = $db->pe_select('prorule', array('product_id'=>$product_id, 'prorule_key'=>$prorule_key), '`product_num`');
			$product['product_num'] = $prorule['product_num'];
		}
		if ($product['product_num'] < $product_num) pe_jsonshow(array('result'=>false, 'show'=>'库存不足'));
		$cart = $db->pe_select('cart', array('cart_type'=>$cart_type, 'user_id'=>$user_id, 'product_guid'=>$product_guid));
		if ($cart_type == 'cart' && $cart['cart_id']) {
			$sql_set['product_num'] = $cart['product_num'] + $product_num;			
			$result = $db->pe_update('cart', array('cart_id'=>$cart['cart_id']), $sql_set) ? true : false;
		}
		else {
			$sql_set['cart_type'] = $cart_type;
			$sql_set['cart_atime'] = time();
			$sql_set['product_id'] = $product_id;
			$sql_set['product_guid'] = $product_guid;
			$sql_set['product_num'] = $product_num;
			$sql_set['prorule_key'] = $prorule_key;
			$sql_set['user_id'] = $user_id;
			$cart['cart_id'] = $db->pe_insert('cart', $sql_set);
			$result = $cart['cart_id'] ? true : false;		
		}
		if (!$result) pe_jsonshow(array('result'=>false, 'show'=>'异常请重新操作'));
		pe_jsonshow(array('result'=>true, 'cart_num'=>user_cartnum(), 'cart_id'=>$cart['cart_id']));
	break;
	//#####################@ 购物车修改(为零就删除吧) @#####################//
	case 'edit':
		if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
		$product_num = intval($_g_num);
		$sql_where['cart_id'] = intval($_g_id);
		$sql_where['cart_type'] = 'cart';
		$sql_where['user_id'] = $user_id;
		if ($product_num) {
			$result = $db->pe_update('cart', $sql_where, array('product_num'=>$product_num)) ? true : false;
		}
		else {
			$result = $db->pe_delete('cart', $sql_where) ? true : false;			
		}
		$cart_list = cart_list('cart');
		echo json_encode(array('result'=>$result, 'cart_num'=>user_cartnum(), 'money'=>$cart_list['money']));
	break;
	//#####################@ 购物车列表 @#####################//
	default :
		$cart_list = cart_list('cart');
		$info_list = $cart_list['list'];
		$money = $cart_list['money'];
		
		$seo = pe_seo($menutitle='我的购物车');
		include(pe_tpl('cart_list.html'));
	break;
}
?>