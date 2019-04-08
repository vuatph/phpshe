<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $seo['title'] ?></title>
<meta name="keywords" content="<?php echo $seo['keywords'] ?>" />
<meta name="description" content="<?php echo $seo['description'] ?>" />
<link rel="shortcut icon" type="image/ico" href="<?php echo $pe['host_root'] ?>/favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>css/style.css" />
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/global.js"></script>
<style type="text/css">
body{background:#3C7DBE; font-family:'Microsoft Yahei','Simsun',"宋体"}
.login_tt{font-size:24px; line-height:30px; color:#fff; width:462px; margin:0 auto; margin-top:150px; text-align:center}
.login{background:url(<?php echo $pe['host_tpl'] ?>images/login_bg.png) no-repeat; width:462px; height:244px; margin:0 auto; margin-top:15px; padding-top:40px;}
.input1{margin:0px 0 0 65px; font-size:14px; color:#888;}
.input1 input{width:140px; height:28px; border:0; line-height:28px; margin-left:5px;}
.input2{margin:23px 0 0 60px; font-size:14px; color:#888;}
.input2 input{width:140px; height:28px; border:0; line-height:28px; margin-left:5px;}
.input3_box{background:#fff url(<?php echo $pe['host_tpl'] ?>images/login_bg.png) no-repeat -36px -87px; border:1px #bbb solid; border-radius:5px; height:35px; line-height:32px;width:182px; padding-left:30px; color:#666; float:left;}
.input3{margin:20px 0 0 33px;}
.input3_box input{width:53px; height:28px; border:0; line-height:28px; margin-left:5px; margin-top:2px;}
.input3 img{margin-left:3px; width:80px; height:32px; border:0; float:left; display:inline; margin-top:2px;}
.login_btn{margin:25px 0 0 33px;}
.login_btn input{background:url(<?php echo $pe['host_tpl'] ?>images/login_btn.gif) no-repeat; width:216px; height:43px; border:0; cursor:pointer;}
.copyright{text-align:center; color:#BECAD6;}
.copyright a,.copyright a:hover{color:#BECAD6;}
.login .input_name{float:left; margin-top:3px; display:block;}
</style>
</head>
<body>
<div class="login_tt"><!--<span class="num">PHPSHE</span>商城管理系统--><img src="<?php echo $pe['host_tpl'] ?>images/admin_logo.png"></div>
<form method="post">
<div class="login">	
	<div class="input1"><span class="input_name">账 号:</span><input type="text" name="admin_name" /><div class="clear"></div></div>
	<div class="input2"><span class="input_name">密 码:</span><input type="password" name="admin_pw"  /><div class="clear"></div></div>
	<div class="input3">
		<div class="input3_box" style="position:relative;">
			<span class="fl">验证码:</span>
			<input class="fl" type="text" name="authcode" />
			<div class="clear"></div>
			<img src="<?php echo $pe['host_root'] ?>include/class/authcode.class.php?w=80&h=32" onclick="pe_yzm(this)" style="cursor:pointer; position:absolute; left:128px; top:0" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="login_btn"><input type="submit" name="pesubmit" value=" " /></div>
</div>
</form>
<div class="copyright">Copyright <span class="num">©</span> 2008-2015 <a href="http://www.phpshe.com" target="_blank">灵宝简好网络科技有限公司</a> 版权所有</div>
</body>
<script type="text/javascript">
$(function(){
$(":submit").click(function(){
	if ($(":input[name='info[admin_name]']").val() == '') {
		alert('帐号不能为空！')
		return false;
	}
	if ($(":input[name='info[admin_pw]']").val() == '') {
		alert('密码不能为空！')
		return false;
	}
	return true;
})
})
</script>
</html>