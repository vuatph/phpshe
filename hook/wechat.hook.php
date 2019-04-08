<?php
//微信绑定服务器
function wechat_bind() {
	global $cache_setting;
	$token = $cache_setting['wechat_token'];
	$timestamp = $_GET["timestamp"];
	$nonce = $_GET["nonce"];
	$signature = $_GET["signature"];
	if ($timestamp && $nonce && $signature) {
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = sha1(implode( $tmpArr ));
		if ($tmpStr == $signature) {
			echo $_GET["echostr"];
		}
		die();
	}
}

//接收微信xml数据
function wechat_getxml() {
	$xml = file_get_contents("php://input");
	return $xml = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
}

//发送微信xml数据
function wechat_sendxml($arr, $url = '') {
	$xml = "<xml>";
	foreach ($arr as $k => $v) {
		if (is_numeric($v)) {
			$xml .= "<{$k}>{$v}</{$k}>";
		}
		else{
			$xml .= "<{$k}><![CDATA[{$v}]]></{$k}>";
		}
    }
    $xml .= "</xml>";
    if ($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode(json_encode(simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
    else {
    	return $xml;
    }
}

//生成微信参数签名
function wechat_sign($arr, $key) {
	//签名步骤一：按字典序排序参数
	ksort($arr);
	$sign = "";
	foreach ($arr as $k => $v) {
		if ($k != "sign" && $v != "" && !is_array($v)){
			$sign .= "{$k}={$v}&";
		}
	}
	$sign = trim($sign, "&");
	//签名步骤二：在string后加入KEY
	$sign = "{$sign}&key={$key}";
	//签名步骤三：MD5加密
	$sign = md5($sign);
	//签名步骤四：所有字符转为大写
	$result = strtoupper($sign);
	return $result;
}

//获取微信基础access_token
function wechat_access_token($appid = null, $appsecret = null) {
	global $db;
	$cache_setting = cache::get('setting');
	!$appid && $appid = $cache_setting['wechat_appid'];
	!$appsecret && $appsecret = $cache_setting['wechat_appsecret'];	
	$json = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}");
	$json = json_decode($json, true);
	if ($json['access_token']) {
		$db->pe_update('setting', array('setting_key'=>'wechat_access_token'), array('setting_value'=>$json['access_token']));
		pe_lead('hook/cache.hook.php');
		cache_write('setting');
		return $json['access_token'];
	}
	return false;
}

//设置微信自定义菜单
function wechat_setmenu($json = '') {
	global $db;
	$cache_setting = cache::get('setting');	
	$access_token = wechat_access_token();
	//$access_token = $cache_setting['wechat_access_token'];
	if ($json) {
		$json = preg_replace_callback("|(http://[^(\"\|')]+)|", "wechat_menuurl", $json);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);	
	}
}

//自定义菜单拼接url
function wechat_menuurl($match) {
	global $pe, $cache_setting;
	if (stripos($match[1], trim($pe['host_root'], '/')) === false) {
		return $match[1];
	}
	else {
		return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$cache_setting['wechat_appid']}&redirect_uri=".urlencode($match[1])."&response_type=code&scope=snsapi_userinfo&state=phpshe_wechat#wechat_redirect";
	}
}

//运行微信并获取openid
function wechat_run() {
	global $db, $pe, $cache_setting;
	if (stripos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") && !pe_login('user')) {
		if ($_GET['code'] && $_GET['state'] == 'phpshe_wechat') {
			$json = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid={$cache_setting['wechat_appid']}&secret={$cache_setting['wechat_appsecret']}&code={$_GET['code']}&grant_type=authorization_code");
			$json = json_decode($json, true);		
			if ($json['openid']) {
				pe_lead('hook/user.hook.php');
				//检测是否注册
				$info = $db->pe_select('user', array('user_wx_openid'=>pe_dbhold($json['openid'])));
				if ($info['user_id']) {
					$db->pe_update('user', array('user_id'=>$info['user_id']), array('user_ltime'=>time()));
					$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
					$_SESSION['user_id'] = $info['user_id'];
					$_SESSION['user_name'] = $info['user_name'];
					$_SESSION['user_ltime'] = $info['user_ltime'];
					$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
					if (!$db->pe_num('pointlog', " and `user_id` = '{$info['user_id']}' and `pointlog_type` = 'give' and `pointlog_text` = '每日登录' and `pointlog_atime` >= '".strtotime(date('Y-m-d'))."'")) {
						add_pointlog($info['user_id'], 'give', $cache_setting['point_login'], '每日登录');				
					}
				}
				else {
					$json = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token={$json['access_token']}&openid={$json['openid']}&lang=zh_CN ");
					$json = json_decode($json, true);
					$sql_set['user_name'] = 'wx'.time().rand(0,9);
					$sql_set['user_pw'] = '';
					$sql_set['user_ip'] = pe_ip();
					$sql_set['user_atime'] = $sql_set['user_ltime'] = time();
					$sql_set['user_wx_openid'] = $json['openid'];
					if ($json['headimgurl']) {
						$user_logo = "data/avatar/".date('Y-m')."/";
						if (@is_dir("{$pe['path_root']}{$user_logo}") === false) mkdir("{$pe['path_root']}{$user_logo}", 0777, true);
						$sql_set['user_logo'] = "{$user_logo}".date('YmdHis').rand(0, 100).'.jpg';
						//file_put_contents("{$pe['path_root']}{$sql_set['user_logo']}", file_get_contents(substr($json['headimgurl'], 0, -1).'132'));
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, substr($json['headimgurl'], 0, -1).'132');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						file_put_contents("{$pe['path_root']}{$sql_set['user_logo']}", curl_exec($ch));
						curl_close($ch);
					}
					if ($user_id = $db->pe_insert('user', pe_dbhold($sql_set))) {
						$info = $db->pe_select('user', array('user_id'=>$user_id));
						$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
						$_SESSION['user_id'] = $info['user_id'];
						$_SESSION['user_name'] = $info['user_name'];
						$_SESSION['user_ltime'] = time();
						$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
						add_pointlog($user_id, 'give', $cache_setting['point_reg'], '新用户注册');
					}
				}
				pe_goto(pe_nowurl());
			}
		}
		else {
			$nowurl = urlencode(pe_nowurl());
			pe_goto("https://open.weixin.qq.com/connect/oauth2/authorize?appid={$cache_setting['wechat_appid']}&redirect_uri={$nowurl}&response_type=code&scope=snsapi_userinfo&state=phpshe_wechat#wechat_redirect");
		}
	}
}

//微信支付（pc扫码）
function wechat_webpay($order_id) {
	global $db, $pe;
	$cache_payway = cache::get('payway');
	$payway = $cache_payway['wechat']['payway_config'];
	//微信支付基础设置
	$wechat_config['appid'] = $payway['wechat_appid'];
	$wechat_config['mchid'] = $payway['wechat_mchid'];
	$wechat_config['key'] = $payway['wechat_key'];
	$wechat_config['notify_url'] = "{$pe['host_root']}include/plugin/payway/wechat/notify_url.php";
	$order = $db->pe_select(order_table($order_id), array('order_id'=>pe_dbhold($order_id)));
	if ($order['order_state'] != 'wpay') {
		return array('result'=>false, 'show'=>'请勿重复支付');		
	}
	//统一下单接口
	$xml_arr['appid'] = $wechat_config['appid'];
	$xml_arr['mch_id'] = $wechat_config['mchid'];
	$xml_arr['device_info'] = 'WEB';
	$xml_arr['nonce_str'] = md5(microtime(true).pe_ip().'koyshe+andrea');
	$xml_arr['body'] = pe_cut($order['order_name'], 13, '...');
	$xml_arr['out_trade_no'] = "{$order['order_id']}_".rand(100,999);
	$xml_arr['total_fee'] = $order['order_money']*100;
	$xml_arr['spbill_create_ip'] = pe_ip();
	$xml_arr['notify_url'] = $wechat_config['notify_url'];
	$xml_arr['trade_type'] = 'NATIVE';
	$xml_arr['sign'] = wechat_sign($xml_arr, $wechat_config['key']);
	//发送xml下单请求
	$json = wechat_sendxml($xml_arr, 'https://api.mch.weixin.qq.com/pay/unifiedorder');
	if ($json['return_code'] == 'SUCCESS' && $json['result_code'] == 'SUCCESS') {
		pe_lead('include/class/phpqrcode.class.php');
		QRcode::png($json['code_url'], "{$pe['path_root']}data/wechat_qrcode/{$order_id}.png", 'QR_ECLEVEL_L', 9);	
		return array('result'=>true, 'qrcode'=>"{$pe['host_root']}data/wechat_qrcode/{$order_id}.png");
	}
	else {
		return array('result'=>false, 'show'=>"{$json['return_msg']}");
	}
}

//微信支付（公众号）
function wechat_jspay($order_id) {
	global $db, $pe;
	$cache_payway = cache::get('payway');
	$payway = $cache_payway['wechat']['payway_config'];
	//微信支付基础设置
	$wechat_config['appid'] = $payway['wechat_appid'];
	$wechat_config['mchid'] = $payway['wechat_mchid'];
	$wechat_config['key'] = $payway['wechat_key'];
	$wechat_config['notify_url'] = "{$pe['host_root']}include/plugin/payway/wechat/notify_url.php";
	$order = $db->pe_select(order_table($order_id), array('order_id'=>pe_dbhold($order_id)));
	$user = $db->pe_select('user', array('user_id'=>$order['user_id']), 'user_wx_openid');
	if ($order['order_state'] != 'wpay') {
		return array('result'=>false, 'show'=>'请勿重复支付');		
	}
	//统一下单接口
	$xml_arr['appid'] = $wechat_config['appid'];
	$xml_arr['mch_id'] = $wechat_config['mchid'];
	$xml_arr['device_info'] = 'WEB';
	$xml_arr['nonce_str'] = md5(microtime(true).pe_ip().'koyshe+andrea');
	$xml_arr['body'] = pe_cut($order['order_name'], 13, '...');
	$xml_arr['out_trade_no'] = "{$order['order_id']}_".rand(100,999);
	$xml_arr['total_fee'] = $order['order_money']*100;
	$xml_arr['spbill_create_ip'] = pe_ip();
	$xml_arr['notify_url'] = $wechat_config['notify_url'];
	$xml_arr['trade_type'] = 'JSAPI';
	$xml_arr['openid'] = $user['user_wx_openid'];
	$xml_arr['sign'] = wechat_sign($xml_arr, $wechat_config['key']);
	//发送xml下单请求
	$json = wechat_sendxml($xml_arr, 'https://api.mch.weixin.qq.com/pay/unifiedorder');
	if ($json['return_code'] == 'SUCCESS' && $json['result_code'] == 'SUCCESS') {
		$info_arr['appId'] = $wechat_config['appid'];
		$info_arr['timeStamp'] = strval(time());
		$info_arr['nonceStr'] = md5(microtime(true).pe_ip().'koyshe+andrea');
		$info_arr['package'] = "prepay_id={$json['prepay_id']}";
		$info_arr['signType'] = 'MD5';
		$info_arr['paySign'] = wechat_sign($info_arr, $wechat_config['key']);
		$url_arr = order_pay_goto($order_id, 0);
		$url = $url_arr['url'];
		return array('result'=>true, 'info'=>$info_arr, 'url'=>$url);
	}
	else {
		return array('result'=>false, 'show'=>"{$json['return_msg']}");
	}
}
?>