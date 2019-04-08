<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="50">排序</td>
			<td class="bgtt" width="120">图标</td>
			<td class="bgtt" width="130">支付名称</td>
			<td class="bgtt">支付描述</td>
			<td class="bgtt" width="90">启用状态</td>
			<td class="bgtt" width="45">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="text" name="payway_order[<?php echo $v['payway_id'] ?>]" value="<?php echo $v['payway_order'] ?>" class="inputtext input40" /></td>
			<td><img src="<?php echo $pe['host_root'] ?>include/plugin/payway/<?php echo $v['payway_mark'] ?>/logo.gif" style="height:60px" /></td>
			<td><?php echo $v['payway_name'] ?></td>
			<td class="aleft"><?php echo $v['payway_text'] ?></td>
			<td><?php if($v['payway_state']):?><img src="<?php echo $pe['host_tpl'] ?>images/dui.png" /><?php else:?><span class="cred">停用</span><?php endif;?></td>
			<td><a href="admin.php?mod=payway&act=edit&id=<?php echo $v['payway_id'] ?>" class="admin_edit">修改</a></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt aleft" colspan="6">
				<span class="fl"><button href="admin.php?mod=payway&act=order" onclick="pe_doall(this,'form')">批量排序</button></span>
				<span class="fenye"><?php echo $db->page->html ?></span>
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>