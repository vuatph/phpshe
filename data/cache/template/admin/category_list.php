<?php include(pe_tpl('header.html'));?>
<div class="right fr">
	<div class="now">
		<div class="fl now1"></div>
		<div class="fl now2">
			<span class="fl"><?php if($_g_type=='article'):?>文章分类<?php else:?>商品分类<?php endif;?></span>
			<span class="fr fabu mat8"><a href="admin.php?mod=category&act=add&type=<?php echo $_g_type ?>">增加分类</a></span>
		</div>
		<div class="fl now3"></div>
		<div class="clear"></div>
	</div>
	<form method="post" id="form">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list mat5">
	<tr>
		<td class="bgtt" align="center" width="40">ID号</td>
		<td class="bgtt" align="center" width="50">排序</td>
		<td class="bgtt" align="center">分类名称</td>
		<td class="bgtt" align="center" width="70">操作</td>
	</tr>
	<?php foreach($info_list as $v):?>
	<tr>
		<td align="center"><?php echo $v['category_id'] ?></td>
		<td align="center"><input type="text" name="category_order[<?php echo $v['category_id'] ?>]" value="<?php echo $v['category_order'] ?>" class="inputtext inputtext_50" /></td>
		<td><?php echo $v['category_showname'] ?></td>
		<td align="center">
			<a href="admin.php?mod=category&act=edit&id=<?php echo $v['category_id'] ?>" class="admin_edit">修改</a>
			<a href="admin.php?mod=category&act=delsql&id=<?php echo $v['category_id'] ?>" class="admin_del" onclick="return pe_cfone('删除')">删除</a>
		</td>
	</tr>
	<?php endforeach;?>
	<tr>
		<td class="bgtt" colspan="4"><button href="admin.php?mod=category&act=ordersql" onclick="pe_doall(this,'form')">批量排序</button></td>
	</tr>
	</table>
	</form>
</div>
<?php include(pe_tpl('footer.html'));?>