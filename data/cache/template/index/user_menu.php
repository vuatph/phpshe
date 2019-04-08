<div class="now">您现在的位置：<a href="<?php echo $pe['host_root'] ?>">首页</a> > 会员中心 > <?php echo $menutitle ?></div>
<div class="danye_left">
	<div class="danye_help">
		<div class="danye_tt"><s></s>会员中心</div>
		<div class="danye_list">
			<h3 class="fl_tb3"><s></s>交易管理</h3>
			<ul>
				<li class="fl_tb1"><a href="index.php?mod=user&act=order" <?php if(in_array($act, array('order', 'orderview'))):?>class="sel"<?php endif;?>>我的订单</a></li>
			</ul>
			<h3 class="fl_tb5"><s></s>信息管理</h3>
			<ul>
				<li><a href="index.php?mod=user&act=collect" <?php if($act=='collect'):?>class="sel"<?php endif;?>>我的收藏</a></li>
				<li><a href="index.php?mod=user&act=ask" <?php if($act=='ask'):?>class="sel"<?php endif;?>>我的咨询</a></li>
				<li><a href="index.php?mod=user&act=comment" <?php if($act=='comment'):?>class="sel"<?php endif;?>>我的评价</a></li>
			</ul>
			<h3 class="fl_tb4"><s></s>个人信息</h3>
			<ul>
				<li class="fl_tb1"><a href="index.php?mod=user&act=base" <?php if($act=='base'):?>class="sel"<?php endif;?>>基本资料</a></li>
				<li class="fl_tb1"><a href="index.php?mod=user&act=pw" <?php if($act=='pw'):?>class="sel"<?php endif;?>>修改密码</a></li>
			</ul>
		</div>
	</div>
</div>