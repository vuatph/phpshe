<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'wechat';
pe_lead('hook/wechat.hook.php');
switch ($act) {
	//#####################@ 获取微信消息 @#####################//
	case 'getinfo':
		$info = wechat_getxml();
		$wechat_name = $info['ToUserName'];
		$user_name = $info['FromUserName'];
		switch ($info['MsgType']) {
			case 'event'://关注
				if ($info['Event'] == 'subscribe') {
					$xml_arr['ToUserName'] = $user_name;
					$xml_arr['FromUserName'] = $wechat_name;
					$xml_arr['CreateTime'] = time();
					$xml_arr['MsgType'] = 'text';
					$xml_arr['Content'] = $cache_setting['wechat_rssadd'];
					echo wechat_sendxml($xml_arr);
					die();
				}
			break;
		}
		wechat_bind();
	break;
	//#####################@ 微信入口页面 @#####################//
	case 'getcode':
		if ($_g_code)
		$json = json_decode(file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code"), true);
		if ($json['openid']) {
			$info = $db->pe_select('user', array('user_wx_openid'=>pe_dbhold($json['openid'])));
			if ($info['user_id']) {
				$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
				$_SESSION['user_id'] = $info['user_id'];
				$_SESSION['user_name'] = $info['user_name'];
				$_SESSION['user_wx_openid'] = $info['user_wx_openid'];
				$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
			}
		}
		pe_goto($pe['host_root']);
	break;
	default:
		$wechat_codeurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri=".urlencode(pe_url('wechat'))."&response_type=code&scope=snsapi_base&state=webchat#wechat_redirect";
		pe_goto($wechat_codeurl);
	break;
}
?>