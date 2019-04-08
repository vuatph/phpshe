<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=link&act=add">增加链接</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt" width="50">排序</td>
			<td class="bgtt" width="250">链接名称</td>
			<td class="bgtt">链接地址</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['link_id'] ?><input type="hidden" name="link_id[]" value="<?php echo $v['link_id'] ?>" /></td>
			<td><input type="text" name="link_order[<?php echo $v['link_id'] ?>]" value="<?php echo $v['link_order'] ?>" class="inputtext input40" /></td>
			<td><?php echo $v['link_name'] ?></td>
			<td><a href="<?php echo $v['link_url'] ?>" target="_blank"><?php echo $v['link_url'] ?></a></td>
			<td>
				<a href="admin.php?mod=link&act=edit&id=<?php echo $v['link_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=link&act=del&id=<?php echo $v['link_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt aleft" colspan="5">
				<span class="fl"><button href="admin.php?mod=link&act=order" onclick="pe_doall(this,'form')">批量排序</button></span>
				<span class="fenye"><?php echo $db->page->html ?></span>
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>