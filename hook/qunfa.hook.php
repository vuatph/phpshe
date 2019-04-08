<?php
function qunfa_emaildiy($info ,$user_id = '')
{
	global $db, $pe;
	$setting = cache::get('setting');
	pe_lead('include/class/mail/mail.class.php');
	$mail = new PHPMailer();                                   //创建PHPMailer实例  
	$mail->IsSMTP();                                           //设置SMTP模式
	$mail->IsHTML(true);
	$mail->Host     = $setting['email_smtp']['setting_value']; //SMTP服务器地址  
	$mail->Port     = $setting['email_port']['setting_value']; //SMTP服务器端口  
	$mail->SMTPAuth = true;                                    //SMTP认证  
	$mail->Username = $setting['email_name']['setting_value']; //认证用户名  
	$mail->Password = $setting['email_pw']['setting_value'];   //认证密码  
	$mail->Subject  = $info['qunfa_name'];                     //邮件标题  
	$mail->Body     = $info['qunfa_text'];
	$mail->CharSet = 'utf-8';                                  // 这里指定字符集！
	$mail->Encoding = 'base64';
	$mail->SetFrom($setting['email_name']['setting_value'], $setting['email_nname']['setting_value']);        //设置发件人
	//提取可用的用户email信息，
	$sqlwhere = " and `user_email` != '' and `user_id` in({$user_id})";
	$user_list = $db->pe_selectall('user', $sqlwhere);
	foreach ($user_list as $v) {
		$mail->AddAddress($v['user_email'], $v['user_name']);  //添加收件人  
		$mail->Send();
		$mail->ClearAddresses();
	}
}
?>