<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=category&act=add">增加分类</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt" width="80">排序</td>
			<td class="bgtt">分类名称</td>
			<td class="bgtt" width="170">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['category_id'] ?></td>
			<td><input type="text" name="category_order[<?php echo $v['category_id'] ?>]" value="<?php echo $v['category_order'] ?>" class="inputtext input40" /></td>
			<td class="aleft"><a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>" target="_blank"><?php echo $v['category_showname'] ?></a></td>
			<td>
				<a href="admin.php?mod=category&act=edit&id=<?php echo $v['category_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=category&act=del&id=<?php echo $v['category_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
				<a href="admin.php?mod=product&act=move&category_id=<?php echo $v['category_id'] ?>" class="fabu_btn fl mal10" onclick="return pe_dialog(this, '批量转移商品')">转移商品</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt aleft" colspan="5"><button href="admin.php?mod=category&act=order" onclick="pe_doall(this,'form')">批量排序</button></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=chrome"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
<?php include(pe_tpl('footer.html'));?>