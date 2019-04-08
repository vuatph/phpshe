<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=admin&act=add">增加管理</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt">管理帐号</td>
			<td class="bgtt" width="150">上次登录</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['admin_id'] ?></td>
			<td><?php echo $v['admin_name'] ?></td>
			<td><?php echo pe_date($v['admin_ltime']) ?></td>
			<td>
				<a href="admin.php?mod=admin&act=edit&id=<?php echo $v['admin_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=admin&act=del&id=<?php echo $v['admin_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt" colspan="4">&nbsp;<span class="fenye"><?php echo $db->page->html ?></span></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>