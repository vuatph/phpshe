<?php include(pe_tpl('header.html'));?>
<div class="content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_table" style="margin-top:0">
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
					<p class="cred font13">等待卖家发货</p>
					<?php elseif($v['order_state']=='send'):?>
					<p class="cgreen font13">卖家已经发货</p>
					<p class="cred font13">等待买家付款</p>
					<?php elseif($v['order_state']=='success'):?>
					<p class="cgreen font13">交易成功</p>
					<?php endif;?>
				<!--先款后货-->
				<?php else:?>
					<?php if($v['order_state']=='notpay'):?>
					<p class="cgreen font13">订单创建成功</p>
					<p><a class="pay_btn" href="index.php?mod=order&act=pay&id=<?php echo $v['order_id'] ?>" target="_blank">付款</a></p>
					<?php elseif($v['order_state']=='paid'):?>
					<p class="cgreen font13">买家付款成功</p>
					<p class="cred font13">等待卖家发货</p>
					<?php elseif($v['order_state']=='send'):?>
					<p class="cgreen font13">卖家已经发货</p>
					<p><a class="shouhuo_btn" href="https://lab.alipay.com/consume/queryTradeDetail.htm?tradeNo=<?php echo $v['order_outid'] ?>" target="_blank">去确认收货</a></p>
					<?php elseif($v['order_state']=='success'):?>
					<p class="cgreen font13">交易成功</p>
					<?php endif;?>
				<?php endif;?>
				<p class="c888 font12 mat3"><?php echo $ini_payway[$v['order_payway']] ?></p>
				</td>
				<td width="100">
					<a href="index.php?mod=user&act=orderview&id=<?php echo $v['order_id'] ?>" target="_blank" class="font13">订单详情</a>
					<?php if($v['order_state']=='notpay'):?>
					<p class="mat3"><a href="index.php?mod=user&act=orderdel&id=<?php echo $v['order_id'] ?>" onclick="return pe_cfone(this, '删除订单')" class="cblue font12">删除订单</a></p>
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
	<div class="clear"></div>
</div>
<script charset="utf-8" src="<?php echo $phpshe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=chrome"></script>
<script charset="utf-8" src="<?php echo $phpshe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
<?php include(pe_tpl('footer.html'));?>