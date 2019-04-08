<?php
function qunfa_emaildiy($info ,$obj_id, $obj_type= 'value')
{
	global $db, $pe;
	$setting = cache::get('setting');
	pe_lead('include/class/mail/mail.class.php');
	$mail = new PHPMailer();                                   //创建PHPMailer实例  
	$mail->IsSMTP();                                           //设置SMTP模式
	$mail->IsHTML(true);
	$mail->Host     = $setting['email_smtp']; //SMTP服务器地址  
	$mail->Port     = $setting['email_port']; //SMTP服务器端口  
	$mail->SMTPAuth = true;                                    //SMTP认证  
	$mail->Username = $setting['email_name']; //认证用户名
	$mail->Password = $setting['email_pw'];   //认证密码  
	$mail->Subject  = $info['qunfa_name'];                     //邮件标题  
	$mail->Body     = $info['qunfa_text'];
	$mail->CharSet = 'utf-8';                                  // 这里指定字符集！
	$mail->Encoding = 'base64';
	$mail->SetFrom($setting['email_name'], $setting['email_nname']);        //设置发件人
	if ($obj_type == 'value') {
		$obj_idarr = explode(',', $obj_id);
		foreach ($obj_idarr as $k=>$v) {
			$user_list[$k]['user_email'] = $v;
		}
	}
	else {
		$user_list = $db->pe_selectall('user', " and `user_email` != '' and `user_id` in({$obj_id})");	
	}
	foreach ($user_list as $v) {
		if (preg_match("/^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[a-z]{2,3}$/", $v['user_email'])) {
			$mail->AddAddress($v['user_email']);  //添加收件人  
			$mail->Send();
			$mail->ClearAddresses();		
		}
	}
}

function qunfa_sms($text, $phone) {
	$result = file_get_contents("http://api.phpshe.com/sms.php?phone={$phone}&text={$text}");
	return json_decode($result);
}

//邮件-短信通知
function notice_add($type, $order_id = null) {
	global $db, $ini;
	$setting = cache::get('setting');
	$cache_notice = cache::get('notice');
	$notice = $cache_notice[$type];
	$info = $db->pe_select('order', array('order_id'=>pe_dbhold($order_id)));
	$user = $db->pe_select('user', array('user_id'=>$_SESSION['user_id']));
	foreach ($ini["notice_{$type}"] as $k=>$v) {
		if ($type == 'reg') $info[$k] = $user['user_name'];
		$notice['user']['notice_emailname'] = str_ireplace("{order_id}", $info[$k], $notice['user']['notice_emailname']);
		$notice['user']['notice_emailtext'] = str_ireplace("{{$k}}", $info[$k], $notice['user']['notice_emailtext']);
		$notice['admin']['notice_emailname'] = str_ireplace("{{$k}}", $info[$k], $notice['admin']['notice_emailname']);
		$notice['admin']['notice_emailtext'] = str_ireplace("{{$k}}", $info[$k], $notice['admin']['notice_emailtext']);
	}
	/*if ($cache_notice[$type]['user']['notice_state']) {
		$_SESSION['notice'][] = array('type'=>'sms', 'user'=>$info['user_phone'], 'text'=>$notice['smstpl_user']);		
	}
	if ($cache_notice[$type]['admin']['notice_state']) {
		$_SESSION['notice'][] = array('type'=>'sms', 'user'=>$setting['sms_admin'], 'text'=>$notice['smstpl_admin']);		
	}*/
	if ($notice['user']['notice_state'] && $user['user_email']) {
		$noticelog_list[0]['noticelog_user'] = pe_dbhold($user['user_email']);
		$noticelog_list[0]['noticelog_name'] = pe_dbhold($notice['user']['notice_emailname']);
		$noticelog_list[0]['noticelog_text'] = $notice['user']['notice_emailtext'];
		$noticelog_list[0]['noticelog_atime'] = time();
	}
	if ($notice['admin']['notice_state'] && $setting['email_admin']) {
		foreach (explode(',', $setting['email_admin']) as $k=>$v) {
			$noticelog_list[$k+1]['noticelog_user'] = pe_dbhold($v);
			$noticelog_list[$k+1]['noticelog_name'] = pe_dbhold($notice['admin']['notice_emailname']);
			$noticelog_list[$k+1]['noticelog_text'] = $notice['admin']['notice_emailtext'];
			$noticelog_list[$k+1]['noticelog_atime'] = time();		
		}		
	}
	$db->pe_insert('noticelog', $noticelog_list);
}
?>