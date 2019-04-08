<?php
//热销商品
function product_hotlist($num = 5) {
	global $db;
	return $db->pe_selectall('product', array('order by'=>'`product_sellnum` desc'), '*', array($num));
}

//新品推荐
function product_newlist($num = 5) {
	global $db;
	return $db->pe_selectall('product', array('product_istuijian'=>1, 'product_state'=>1, 'order by'=>'product_order asc, product_id desc'), '*', array($num));
}

//商品数量更新
function product_num($id, $type) {
	global $db;
	switch ($type) {
		case 'addnum':
		case 'delnum':
			$order_id = pe_dbhold($id);
			$orderdata_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
			if ($type == 'addnum') {
				foreach ($orderdata_list as $v) {
					$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`+{$v['product_num']}");
					if ($v['prorule_key'] && $db->pe_num('prorule', array('product_id'=>$v['product_id'], 'prorule_key'=>$v['prorule_key']))) {
						$db->pe_update('prorule', array('product_id'=>$v['product_id'], 'prorule_key'=>$v['prorule_key']), "`product_num`=`product_num`+{$v['product_num']}");
					}
				}
			}
			else {
				foreach ($orderdata_list as $v) {
					$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`-{$v['product_num']}");
					if ($v['prorule_key'] && $db->pe_num('prorule', array('product_id'=>$v['product_id'], 'prorule_key'=>$v['prorule_key']))) {
						$db->pe_update('prorule', array('product_id'=>$v['product_id'], 'prorule_key'=>$v['prorule_key']), "`product_num`=`product_num`-{$v['product_num']}");
					}
				}
			}
		break;
		case 'sellnum':
			$order_id = pe_dbhold($id);
			$orderdata_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
			foreach ($orderdata_list as $v) {
				$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_sellnum` = `product_sellnum` + {$v['product_num']}");
			}
		break;
		case 'clicknum':
			$product_id = intval($id);
			$db->pe_update('product', array('product_id'=>$product_id), "`product_clicknum` = `product_clicknum` + ".rand(3, 5)."");
		break;
		default:
			$product_id = intval($id);
			if (in_array($type, array('collectnum', 'asknum'))) {
				$num = $db->pe_num(substr($type, 0, -3), array('product_id'=>$product_id));
				$db->pe_update('product', array('product_id'=>$product_id), array("product_{$type}"=>$num));
			}
			else if($type == 'commentnum') {
				$num_hao = $db->pe_num('comment', array('product_id'=>$product_id, 'comment_star'=>array(4,5)));
				$num_zhong = $db->pe_num('comment', array('product_id'=>$product_id, 'comment_star'=>3));
				$num_cha = $db->pe_num('comment', array('product_id'=>$product_id, 'comment_star'=>array(1,2)));
				$comment = $db->pe_select('comment', array('product_id'=>$product_id), "sum(comment_star) as comment_star");
				$sql_comment['product_commentnum'] = $num_hao + $num_zhong + $num_cha;
				$sql_comment['product_commentrate'] = "{$num_hao},{$num_zhong},{$num_cha}";
				$sql_comment['product_commentstar'] = $comment['comment_star'];
				$db->pe_update('product', array('product_id'=>$product_id), $sql_comment);
			}
		break;
	}
}

//计算商品活动价
function huodong_money($huodong_money, $money, $type, $value) {
	if ($huodong_money) return $huodong_money;
	if ($type == 'zhe') {
		$money = round($money * $value, 1);
	} 
	else {
		$money = round($money - $value, 1);	
	}
	return $money;
}

//活动标签
function huodong_tag($text) {
	return 'huodong_tag'.intval(strlen($text)/3);
}
?>