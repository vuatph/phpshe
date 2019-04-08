<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<div class="now_l"></div>
		<div class="now_m"><?php echo $menutitle ?></div>
		<div class="now_r"></div>
		<div class="clear"></div>
	</div>
	<!--<div class="tixing">
		<span class="cgreen">温馨提示：</span>为了方便商户快速与支付宝签约，PHPSHE(PE)目前只集成了常用的 <u>支付宝双功能收款（即时到帐+担保交易）接口</u>。
		<p><span class="cblue">即时到帐流程</span>：买家 -> 付款给卖家 　-> 卖家到系统后台发货 -> 交易成功</p>
		<p><span class="cblue">担保交易流程</span>：买家 -> 付款给支付宝 -> 卖家到系统后台发货 -> 买家确认收货 -> 交易资金自动转入卖家 -> 交易成功</p>
	</div>-->
	<div class="search">
		<div class="fl qiehuan">
			<a href="admin.php?mod=order" <?php if(!$_g_state):?>class="sel"<?php endif;?>>全部订单</a>
			| <a href="admin.php?mod=order&state=notpay" <?php if($_g_state=='notpay'):?>class="sel"<?php endif;?>>未付款</a>
			| <a href="admin.php?mod=order&state=paid" <?php if($_g_state=='paid'):?>class="sel"<?php endif;?>>待发货</a>
			| <a href="admin.php?mod=order&state=send" <?php if($_g_state=='send'):?>class="sel"<?php endif;?>>已发货</a>
			| <a href="admin.php?mod=order&state=success" <?php if($_g_state=='success'):?>class="sel"<?php endif;?>>成功订单</a>
		</div>
		<div class="fr searbox">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				订单编号：<input type="text" name="id" value="<?php echo $_g_id ?>" class="inputtext input100" />
				收货姓名：<input type="text" name="user_tname" value="<?php echo $_g_user_tname ?>" class="inputtext input100" />
				联系方式：<input type="text" name="user_phone" value="<?php echo $_g_user_phone ?>" class="inputtext input100" />
				<input type="submit" value="搜索" class="input2" />
			</form>
		</div>
		<div class="clear"></div>
	</div>
	<div class="hy_table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_tb_tt">
		<tr>
			<td class="bg_f8" width="">商品详情</td>
			<td class="bg_f8" width="120">实付款(元)</td>
			<td class="bg_f8" width="120">交易操作</td>
			<td class="bg_f8" width="120" style="border-right:0;">订单详情</td>
		</tr>
		</table>
		<?php foreach($info_list as $v):?>
		<div class="hy_table_order c666">
			<span class="fl">订单编号：<?php echo $v['order_id'] ?></span>
			<span class="fr">下单时间：<?php echo pe_date($v['order_atime']) ?></span>
			<div class="clear"></div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #D4E7FF;">
		<tr>
			<td style="text-align:left;">
				<?php foreach($v['product_list'] as $kk => $vv):?>
				<div class="dingdan_list" <?php if($kk==0):?>style="padding-top:0"<?php endif;?>>
					<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" class="fl mar5"><img src="<?php echo pe_thumb($vv['product_logo'], 60, 60) ?>" width="45" height="45"></a>
					<div class="fl font12">
						<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank" class="cblue dd_name"><?php echo $vv['product_name'] ?></a>
						<?php if($vv['prorule_name']):?>
						<p class="c888 mat5"><?php foreach(unserialize($vv['prorule_name']) as $vvv):?>[<?php echo $vvv['name'] ?>：<?php echo $vvv['value'] ?>]&nbsp;&nbsp;<?php endforeach;?></p>
						<?php endif;?>
						</div>
					<span class="fr font12"><span class="num">¥<?php echo $vv['product_money'] ?></span>(×<?php echo $vv['product_num'] ?>)</span>
					<div class="clear"></div>
				</div>
				<?php endforeach;?>
			</td>
			<td width="100">
				<p class="cred num font14 strong"><?php echo $v['order_money'] ?></p>
				<p class="c888 font12"><?php if($v['order_wlmoney']==0):?>(卖家包邮)<?php else:?>(含运费<?php echo $v['order_wlmoney'] ?>元)<?php endif;?></p>
			</td>
			<td width="100">
			<!--货到付款-->
			<?php if($v['order_payway']=='cod'):?>
				<?php if($v['order_state']=='notpay'):?>
				<p class="cgreen font13">订单创建成功</p>
				<p><a class="shouhuo_btn" href="admin.php?mod=order&act=state&state=send&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '填写快递信息')">发货</a></p>
				<?php elseif($v['order_state']=='send'):?>
				<p class="cgreen font13">卖家已经发货</p>
				<p><a class="pay_btn" href="admin.php?mod=order&act=state&state=send&id=<?php echo $v['order_id'] ?>" onclick="return pe_cfone(this, '付款')">付款</a></p>
				<?php elseif($v['order_state']=='success'):?>
				<p class="cgreen font13">交易成功</p>
				<?php endif;?>
			<!--先款后货-->
			<?php else:?>
				<?php if($v['order_state']=='notpay'):?>
				<p class="cgreen font13">订单创建成功</p>
				<p><a class="pay_btn" href="admin.php?mod=order&act=state&state=paid&id=<?php echo $v['order_id'] ?>" onclick="return pe_cfone(this, '付款')">付款</a></p>
				<?php elseif($v['order_state']=='paid'):?>
				<p class="cgreen font13">买家付款成功</p>
				<p><a class="shouhuo_btn" href="admin.php?mod=order&act=state&state=send&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '填写快递信息')">发货</a></p>
				<?php elseif($v['order_state']=='send'):?>
				<p class="cgreen font13">卖家已经发货</p>
				<p class="cred font13">支付宝还未确认</p>
				<?php elseif($v['order_state']=='success'):?>
				<p class="cgreen font13">交易成功</p>
				<?php endif;?>
			<?php endif;?>
				<p class="c888 font12 mat3"><?php echo $ini_payway[$v['order_payway']] ?></p>
			</td>
			<td width="100">
				<a href="admin.php?mod=order&act=edit&id=<?php echo $v['order_id'] ?>" target="_blank" class="font13">订单详情</a>
				<?php if($v['order_state']=='notpay'):?>
				<p class="mat3"><a href="admin.php?mod=order&act=del&id=<?php echo $v['order_id'] ?>" onclick="return pe_cfone(this, '删除订单')" class="cblue font12">删除订单</a></p>
				<?php endif;?>
			</td>
		</tr>
		</table>
		<?php endforeach;?>
		<div class="hy_pay">
			<div class="fenye"><?php echo $db->page->html ?></div>
		</div>
	</div>
</div>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=chrome"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
<?php include(pe_tpl('footer.html'));?>