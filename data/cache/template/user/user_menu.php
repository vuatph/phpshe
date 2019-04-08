<div class="huiyuan_left">
	<a href="user.php"><h3 class="hy_tb6"><s></s>个人中心</h3></a>
	<h3 class="hy_tb2"><s></s>交易管理</h3>
	<ul>
		<li><a href="user.php?mod=order" <?php if($menumark=='order'):?>class="sel"<?php endif;?>>我的订单</a></li>
		<li><a href="user.php?mod=comment" <?php if($menumark=='comment'):?>class="sel"<?php endif;?>>我的评价</a></li>
		<li><a href="user.php?mod=collect" <?php if($menumark=='collect'):?>class="sel"<?php endif;?>>我的收藏</a></li>
	</ul>
	<div class="xuxian"></div>
	<h3 class="hy_tb4"><s></s>财务中心</h3>
	<ul>
		<li><a href="user.php?mod=quan" <?php if($menumark=='quan'):?>class="sel"<?php endif;?>>我的优惠券</a></li>
		<li><a href="user.php?mod=moneylog" <?php if($menumark=='moneylog'):?>class="sel"<?php endif;?>>资金明细</a></li>
		<li><a href="user.php?mod=pointlog" <?php if($menumark=='pointlog'):?>class="sel"<?php endif;?>>积分明细</a></li>
		<li><a href="user.php?mod=pay" <?php if(in_array($mod, array('pay', 'cashout'))):?>class="sel"<?php endif;?>>充值/提现</a></li>
	</ul>
	<div class="xuxian"></div>
	<h3 class="hy_tb3"><s></s>用户设置</h3>
	<ul>
		<li><a href="user.php?mod=setting&act=base" <?php if($menumark=='setting_base'):?>class="sel"<?php endif;?>>个人信息</a></li>
		<li><a href="user.php?mod=setting&act=pw" <?php if($menumark=='setting_pw'):?>class="sel"<?php endif;?>>修改密码</a></li>
		<li><a href="user.php?mod=userbank" <?php if($menumark=='userbank'):?>class="sel"<?php endif;?>>收款账户</a></li>
		<li><a href="user.php?mod=useraddr" <?php if($menumark=='useraddr'):?>class="sel"<?php endif;?>>收货地址</a></li>
	</ul>
	<?php if($cache_setting['tg_state']):?>
	<div class="xuxian"></div>
	<h3 class="hy_tb5"><s></s>分销中心</h3>
	<ul>
		<li><a href="user.php?mod=tg" <?php if($menumark=='tg_index'):?>class="sel"<?php endif;?>>我要推广</a></li>
		<li style="padding-bottom:20px"><a href="user.php?mod=tg&act=list" <?php if($menumark=='tg_list'):?>class="sel"<?php endif;?>>我的收益</a></li>
	</ul>
	<?php endif;?>
</div>