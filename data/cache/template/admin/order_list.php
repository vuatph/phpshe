<?php include(pe_tpl('header.html'));?>
<div class="right fr">
	<div class="now">
		<div class="fl now1"></div>
		<div class="fl now2">订单列表</div>
		<div class="fl now3"></div>
		<div class="clear"></div>
	</div>
	<div class="tixing">
		<span class="cgreen">温馨提示：</span>为了方便商户快速与支付宝签约，PHPSHE(PE)目前只集成了常用的 <u>支付宝双功能收款（即时到帐+担保交易）接口</u>。
		<!--<p><span class="cblue">即时到帐流程</span>：买家 -> 付款给卖家 　-> 卖家到系统后台发货 -> 交易成功</p>
		<p><span class="cblue">担保交易流程</span>：买家 -> 付款给支付宝 -> 卖家到系统后台发货 -> 买家确认收货 -> 交易资金自动转入卖家 -> 交易成功</p>-->
	</div>
	<div class="spqh mat8">
		<div class="fl qiehuan">
			<a href="admin.php?mod=order&act=list" <?php if(!$_g_state):?>class="sel"<?php endif;?>>全部订单</a>
			| <a href="admin.php?mod=order&act=list&state=paid" <?php if($_g_state=='paid'):?>class="sel"<?php endif;?>>待发货订单</a>
			| <a href="admin.php?mod=order&act=list&state=notpay" <?php if($_g_state=='notpay'):?>class="sel"<?php endif;?>>未付款订单</a>
		</div>
		<div class="fr searbox mat3">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="act" value="<?php echo $_g_act ?>" />
				<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
				<input type="text" name="id" value="<?php echo $_g_id ?>" class="inputtext inputtext_100" />
				<input type="submit" value="搜索" class="input2" />
			</form>
		</div>
		<div class="clear"></div>
	</div>
	<form method="post" id="form">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list mat5">
	<tr>
		<td class="bgtt" align="center" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'order_id')" /></td>
		<td class="bgtt" align="center" width="40">ID号</td>
		<td class="bgtt" align="center">订单名称</td>
		<td class="bgtt" align="center" width="80">单价(×数量)</td>
		<td class="bgtt" align="center" width="100">实付(元)</td>
		<td class="bgtt" align="center" width="150">订单状态</td>
		<td class="bgtt" align="center" width="70">操作</td>
	</tr>
	<?php foreach($info_list as $v):?>
	<tr>
		<td align="center"><input type="checkbox" name="order_id[]" value="<?php echo $v['order_id'] ?>"></td>
		<td align="center"><?php echo $v['order_id'] ?></td>
		<td>
			<?php foreach($v['product_list'] as $vv):?>
			<p><a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank" class="cblue"><?php echo $vv['product_name'] ?></a></p>
			<?php endforeach;?>
		</td>
		<td align="center">
			<?php foreach($v['product_list'] as $vv):?>
			<p><?php echo $vv['product_smoney'] ?>(×<?php echo $vv['product_num'] ?>)</p>
			<?php endforeach;?>
		</td>
		<td align="center">
			<p class="strong"><?php echo $v['order_money'] ?></p>
			<p class="c666"><?php if($v['order_wlmoney'] == 0):?>(卖家包邮)<?php else:?>(含<?php echo $v['order_wlmoney'] ?>元邮费)<?php endif;?></p>
		</td>
		<td align="center">
			<p class="cgreen">已下单[<?php echo pe_date($v['order_atime']) ?>]</p>
			<?php if($v['order_state'] == 'notpay'):?>
			<p class="cred">等待买家付款<button href="admin.php?mod=order&act=state&state=paidsql&id=<?php echo $v['order_id'] ?>" onclick="return pe_cfone_button(this, '付款')">付款</button></p>
			<?php elseif($v['order_state'] == 'paid'):?>
			<p class="cgreen">已付款[<?php echo pe_date($v['order_ptime']) ?>]</p>
			<p class="cred">等待卖家发货<button href="admin.php?mod=order&act=state&state=send&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '填写物流信息', 400, 140)">发货</button></p>
			<?php elseif($v['order_state'] == 'send'):?>
			<p class="cgreen">已付款[<?php echo pe_date($v['order_ptime']) ?>]</p>
			<p class="cgreen">已发货[<?php echo pe_date($v['order_stime']) ?>]</p>
			<p class="cred">等待买家确认</p>			
			<?php elseif($v['order_state'] == 'success'):?>
			<p class="cgreen">已付款[<?php echo pe_date($v['order_ptime']) ?>]</p>
			<p class="cgreen">已发货[<?php echo pe_date($v['order_stime']) ?>]</p>
			<p class="cgreen">交易成功</p>
			<?php endif;?>
			# <?php echo $ini_paytype[$v['order_paytype']] ?> #
		</td>
		<td align="center">
			<?php if($v['order_state'] == 'success'):?>
			<a href="admin.php?mod=order&act=edit&id=<?php echo $v['order_id'] ?>" class="cblue">详情</a>
			<?php else:?>
			<a href="admin.php?mod=order&act=edit&id=<?php echo $v['order_id'] ?>" class="admin_edit">修改</a>
			<a href="admin.php?mod=order&act=delsql&id=<?php echo $v['order_id'] ?>" class="admin_del" onclick="return pe_cfone('删除')">删除</a>
			<?php endif;?>
		</td>	
	</tr>
	<?php endforeach;?>
	<tr>
		<td class="bgtt"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'order_id')" /></td>
		<td class="bgtt" colspan="6">
			<span class="fl"><button href="admin.php?mod=order&act=delsql" onclick="return pe_cfall(this, 'order_id', 'form', '批量删除')">批量删除</button></span>
			<span class="fenye"><?php echo $db->page->html ?></span>
		</td>
	</tr>
	</table>
	</form>
</div>
<script charset="utf-8" src="<?php echo $phpshe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=chrome"></script>
<script charset="utf-8" src="<?php echo $phpshe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
<?php include(pe_tpl('footer.html'));?>