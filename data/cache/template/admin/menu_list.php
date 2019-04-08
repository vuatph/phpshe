<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=menu&act=add">增加导航</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="60">排序</td>
			<td class="bgtt" width="160">导航名称</td>
			<td class="bgtt" width="60">类型</td>
			<td class="bgtt aleft" style="padding-left:50px">链接地址</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<tr>
			<td><input type="text" name="menu_order[<?php echo $v['menu_id'] ?>]" value="0" class="inputtext input40" /></td>
			<td>首页</td>
			<td><span class="cred font12">内置</span></td>
			<td class="aleft" style="padding-left:50px"><?php echo $pe['host_root'] ?></td>
			<td>
				<a href="javascript:alert('首页不能修改');" class="admin_edit mar5">修改</a>
				<a href="javascript:alert('首页不能删除');" class="admin_del">删除</a>
			</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="text" name="menu_order[<?php echo $v['menu_id'] ?>]" value="<?php echo $v['menu_order'] ?>" class="inputtext input40" /></td>
			<td><?php echo $v['menu_name'] ?></td>
			<?php if($v['menu_type'] == 'sys'):?>
			<td><span class="cred font12">内置</span></td>
			<td class="aleft" style="padding-left:50px"><a href="<?php echo pe_url($v['menu_url']) ?>" target="_blank"><?php echo pe_url($v['menu_url']) ?></a></td>
			<?php else:?>
			<td><span class="cgreen font12">自定</span></td>
			<td class="aleft" style="padding-left:50px"><a href="<?php echo $v['menu_url'] ?>" target="_blank"><?php echo $v['menu_url'] ?></a></td>
			<?php endif;?>
			<td>
				<a href="admin.php?mod=menu&act=edit&id=<?php echo $v['menu_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=menu&act=del&id=<?php echo $v['menu_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt aleft" colspan="5"><button href="admin.php?mod=menu&act=order" onclick="pe_doall(this,'form')">批量排序</button></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>