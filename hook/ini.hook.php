<?php
$ini['phpshe'] = array('version'=>'1.6', 'type'=>'0');
//$ini['payway'] = array('alipay'=>'支付宝', 'alipay_js'=>'支付宝', 'alipay_db'=>'支付宝-担保交易', 'bank'=>'线下转账/汇款', 'cod'=>'货到付款', 'ebank'=>'网银在线');	
$ini['userbank_type'] = array('alipay'=>'支付宝', 'tenpay'=>'财付通', 'ICBCB2C'=>'工商银行', 'ABC'=>'农业银行', 'CCB'=>'建设银行', 'CMB'=>'招商银行', 'POSTGC'=>'邮政储蓄', 'GDB'=>'广发银行', 'CIB'=>'兴业银行', 'COMM'=>'交通银行', 'BOCB2C'=>'中国银行', 'SPDB'=>'浦发银行', 'CMBC'=>'民生银行', 'CEBBANK'=>'光大银行', 'CITIC'=>'中信银行', 'SPABANK'=>'平安银行');
$ini['moneylog_type'] = array('recharge'=>'账户充值', 'add'=>'系统充值', 'back'=>'交易退款', 'tg'=>'推荐收益', 'order_pay'=>'订单支付', 'cashout'=>'余额提现', 'del'=>'系统扣除');
$ini['pointlog_type'] = array('give'=>'系统赠送', 'add'=>'系统充值', 'back'=>'交易退还', 'order_pay'=>'抵现扣除', 'del'=>'系统扣除');
$ini['huodong_tag'] = array('团购', '特价', '店庆', '限时促销', '新品上市', '品牌特卖');
$ini['quan_type'] = array('online'=>'线上领取', 'offline'=>'线下发放');
$ini['quanlog_state'] = array(0=>'未使用', 1=>'已使用', 2=>'已过期');
$ini['notice_tpl'] = array('order_id'=>'订单号', 'order_money'=>'付款金额', 'order_wl_name'=>'快递公司', 'order_wl_id'=>'快递单号', 'order_closetext'=>'订单关闭原因', 'user_name'=>'用户名', 'user_tname'=>'收件人', 'user_phone'=>'联系电话', 'user_address'=>'收货地址');
$ini['class_type'] = array('news'=>'资讯中心', 'help'=>'帮助中心');
$ini['tg_level'] = array('1'=>'一', 2=>'二', 3=>'三');
$ini['express_tag'] = array('user_tname'=>'收货人', 'user_phone'=>'收货人电话', 'user_address'=>'收货地址', 'order_id'=>'订单号', 'order_text'=>'订单备注', 'duigou'=>'√');
$ini['ad_position']['index_jdt'] = array('name'=>'首页焦点图', 'size'=>'(700*300)');
//$ini['ad_position']['index_category'] = array('name'=>'首页分类广告', 'size'=>'(252*502)');
$ini['ad_position']['index_header'] = array('name'=>'首页顶部广告', 'size'=>'(1200*80)');
$ini['ad_position']['index_footer'] = array('name'=>'首页底部广告', 'size'=>'(1200*80)');
$ini['ad_position']['header'] = array('name'=>'整站顶部广告', 'size'=>'(1200*80)');
$ini['ad_position']['footer'] = array('name'=>'整站底部广告', 'size'=>'(1200*80)');
?>