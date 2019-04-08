<?php
//侧栏商品列表
function product_hotlist($num=5) {
	global $pe,$db;
	return $db->pe_selectall('product', array('order by'=>'`product_clicknum` desc'), '*', array($num));
}
//侧栏商品列表
function product_selllist($num = 5) {
	global $pe,$db;
	return $db->pe_selectall('product', array('order by'=>'`product_sellnum` desc'), '*', array($num));
}
//商品评价显示
function comment_star($num) {
	global $pe;
	$star_arr = array(1=>'差评', 2=>'中评', 3=>'中评', 4=>'好评', 5=>'好评');
	for ($i=1; $i<=5; $i++) {
		if ($i <= $num) {
			$html .= "<img src='{$pe['host_root']}include/plugin/raty/images/star-on.png' title='{$star_arr[$num]}' />";
		}
		else {
			$html .= "<img src='{$pe['host_root']}include/plugin/raty/images/star-off.png' title='{$star_arr[$num]}' />";	
		}
	}
	return $html;
}
//商品统计更新
function product_num($type, $id) {
	global $db;
	switch ($type) {
		case 'addnum':
		case 'delnum':
			$orderdata_list = $db->pe_selectall('orderdata', array('order_id'=>pe_dbhold($id)));
			if ($type == 'addnum') {
				foreach ($orderdata_list as $v) {
					if ($v['prorule_id']) {
						if ($db->pe_num('prorule', array('product_id'=>$v['product_id'], 'prorule_id'=>$v['prorule_id']))) {
							$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`+{$v['product_num']}");
							$db->pe_update('prorule', array('product_id'=>$v['product_id'], 'prorule_id'=>$v['prorule_id']), "`product_num`=`product_num`+{$v['product_num']}");
						}
					}
					else {
						$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`+{$v['product_num']}");
					}
				}
			}
			else {
				foreach ($orderdata_list as $v) {
					if ($v['prorule_id']) {
						if ($db->pe_num('prorule', array('product_id'=>$v['product_id'], 'prorule_id'=>$v['prorule_id']))) {
							$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`-{$v['product_num']}");
							$db->pe_update('prorule', array('product_id'=>$v['product_id'], 'prorule_id'=>$v['prorule_id']), "`product_num`=`product_num`-{$v['product_num']}");
						}
					}
					else {
						$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`-{$v['product_num']}");
					}
				}
			}
		break;
		case 'sellnum':
			$orderdata_list = $db->pe_selectall('orderdata', array('order_id'=>pe_dbhold($id)));
			foreach ($orderdata_list as $v) {
				$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_sellnum` = `product_sellnum` + {$v['product_num']}");
			}
		break;
		case 'clicknum':
			$db->pe_update('product', array('product_id'=>intval($id)), "`product_clicknum` = `product_clicknum` + ".rand(3, 5)."");
		break;
		default:
			$product_id = intval($id);

			if (in_array($type, array('collectnum', 'asknum'))) {
				$num = $db->pe_num(substr($type, 0, -3), array('product_id'=>$product_id));
				return $db->pe_update('product', array('product_id'=>$product_id), array("product_{$type}"=>$num));
			}
			else if($type == 'commentnum') {
				$num3 = $db->pe_num('comment', array('product_id'=>$product_id, 'comment_star'=>array(4,5)));
				$num2 = $db->pe_num('comment', array('product_id'=>$product_id, 'comment_star'=>array(2,3)));
				$num1 = $db->pe_num('comment', array('product_id'=>$product_id, 'comment_star'=>1));
				$info = $db->pe_select('comment', array('product_id'=>$product_id), "sum(comment_star) as comment_star");
				$sql_comment['product_commentnum'] = $num3 + $num2 + $num1;
				$sql_comment['product_commentrate'] = "{$num3},{$num2},{$num1}";
				$sql_comment['product_commentstar'] = $info['comment_star'];
				return $db->pe_update('product', array('product_id'=>$product_id), $sql_comment);
			}
		break;
	}
}
?>