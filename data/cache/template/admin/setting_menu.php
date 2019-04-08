<div class="now">
	<a href="admin.php?mod=setting&act=base" <?php if($mod=='setting' && $act=='base'):?>class="sel"<?php endif;?>>网站设置</a>
	<a href="admin.php?mod=setting&act=user" <?php if($mod=='setting' && $act=='user'):?>class="sel"<?php endif;?>>会员设置</a>
	<a href="admin.php?mod=setting&act=point" <?php if($mod=='setting' && $act=='point'):?>class="sel"<?php endif;?>>积分设置</a>
	<a href="admin.php?mod=setting&act=sms" <?php if($mod=='setting' && $act=='sms'):?>class="sel"<?php endif;?>>短信/邮箱设置</a>
	<a href="admin.php?mod=setting&act=email" <?php if($mod=='setting' && $act=='email'):?>class="sel"<?php endif;?> style="display:none">邮箱设置</a>
	<a href="admin.php?mod=notice" <?php if($mod=='notice'):?>class="sel"<?php endif;?>>订单通知设置</a>
	<a href="admin.php?mod=setting&act=kuaidi" <?php if($mod=='setting' && $act=='kuaidi'):?>class="sel"<?php endif;?>>快递设置</a>
	<a href="admin.php?mod=express" <?php if($mod=='express'):?>class="sel"<?php endif;?>>运单模板</a>
	<?php if($mod=='express'):?><a href="admin.php?mod=express&act=add" id="fabu">添加模板</a><?php endif;?>
	<div class="clear"></div>
</div>
