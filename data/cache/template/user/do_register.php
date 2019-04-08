<?php include(pe_tpl('do_header.html'));?>
<div class="login_bg1">
<div style="width:1000px; margin:0 auto; position:relative">
	<div class="login_r" style="height:430px; width:300px; position:absolute; right:0; top:-45px;">
		<div class="zctt">用户注册</div>
		<form method="post" id="form">
		<div class="zc_input1">
			用&nbsp;&nbsp;户 名：<input type="text" name="user_name" class="login_input1" placeholder="由5-15位字符组成（字母/数字/汉字）" />
		</div>
		<div class="zc_input1 mat10">
			登录密码：<input type="password" name="user_pw" class="login_input1" placeholder="密码由6-20个字符组成" />
		</div>
		<div class="zc_input1 mat10">
			确认密码：<input type="password" name="user_pw1" class="login_input1" placeholder="请再次输入登录密码" />
		</div>
		<div class="zc_input1 mat10">
			常用邮箱：<input type="text" name="user_email" class="login_input1" placeholder="请填写您的电子邮箱" />
		</div>
		<div class="zc_input1 mat10" style="border-bottom:1px #e2e2e2 solid; padding-right:0; width:290px">
			<span class="fl">验&nbsp;&nbsp;证 码：</span>
			<input type="text" name="authcode" class="login_input1 fl" style="width:90px" />
			<img src="<?php echo $pe['host_root'] ?>include/class/authcode.class.php?w=110&h=40" onclick="pe_yzm(this)" class="fr mal5" style="cursor:pointer; border:0; height:40px;" />
			<div class="clear"></div>
		</div>
		<div class="mat25">
			<input type="hidden" name="pesubmit" />
			<input type="button" class="loginbtn1" value="点击注册" />
		</div>
		</form>
		<div class="login_other mat20" style="text-align:right">
			已有注册账号？请直接 <a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login" title="登录"><span class="corg">登录</span></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$(":button").click(function(){
		if ($(":input[name='user_name']").val() == '') {
			pe_tip('请填写用户名...');
			return false;
		}
		if ($(":input[name='user_pw']").val() == '') {
			pe_tip('请填写登录密码...');
			return false;
		}
		if ($(":input[name='user_pw1']").val() == '') {
			pe_tip('请填写确认密码...');
			return false;
		}
		if ($(":input[name='user_pw']").val() != $(":input[name='user_pw1']").val()) {
			pe_tip('登录密码与确认密码不一致');
			return false;
		}
		if ($(":input[name='user_email']").val() == '') {
			pe_tip('请填写常用邮箱...');
			return false;
		}
		if ($(":input[name='authcode']").val() == '') {
			pe_tip('请填写验证码...');
			return false;
		}
		$(this).val('提交中...');
		pe_submit('user.php?mod=do&act=register', function(json){
			if (json.result) {
				if ('<?php echo $_g_fromto ?>' != '') {
					pe_open('back', 1000);
				}
				else {
					pe_open('user.php', 1000);				
				}
			}
			else {
	    		$(":button").val('注 册');			
			}
		})
	})
})
</script>
<?php include(pe_tpl('do_footer.html'));?>