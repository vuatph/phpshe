<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=class&act=add">增加分类</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="80">排序</td>
			<td class="bgtt">分类名称</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach(array('news'=>'资讯中心', 'help'=>'帮助中心') as $k=>$v):?>
		<tr>
			<td></td>
			<td class="aleft"><?php echo $v ?></td>
			<td></td>
		</tr>
		<?php foreach((array)$class_list[$k] as $kk=>$vv):?>
		<tr>
			<td><input type="text" name="class_order[<?php echo $vv['class_id'] ?>]" value="<?php echo $vv['class_order'] ?>" class="inputtext input40" /></td>
			<td class="aleft">&nbsp;&nbsp;&nbsp;&nbsp;┝ <a href="<?php echo pe_url('article-list-'.$vv['class_id']) ?>" target="_blank"><?php echo $vv['class_name'] ?></a></td>
			<td>
				<a href="admin.php?mod=class&act=edit&id=<?php echo $vv['class_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=class&act=del&id=<?php echo $vv['class_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endforeach;?>
		<tr>
			<td class="bgtt aleft" colspan="4"><button href="admin.php?mod=class&act=order" onclick="pe_doall(this,'form')">批量排序</button></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>