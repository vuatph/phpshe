<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<a href="admin.php?mod=cache" class="sel"><?php echo $menutitle ?></a>
		<div class="clear"></div>
	</div>
	<div class="tixing"><span class="cgreen">温馨提示：</span>当您网站上的数据或网页显示异常时请执行更新缓存操作。</div>
	<form method="post" id="form">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr>
		<th class="bgtt" width="150">缓存名称</th>
		<th class="bgtt aleft">缓存说明</th>
		<th class="bgtt" width="150">大小(KB)</th>
		<th class="bgtt" width="50">操作</th>
	</tr>
	<?php foreach($info_list as $k => $v):?>
	<tr>
		<td><?php echo $v['cache_name'] ?></td>
		<td class="aleft"><?php echo $v['cache_text'] ?></td>
		<td class="num"><?php echo $v['cache_size'] ?></td>
		<td><a href="admin.php?mod=cache&act=update&cache=<?php echo $k ?>&token=<?php echo $pe_token ?>" class="admin_edit">更新</a></td>
	</tr>
	<?php endforeach;?>
	<tr>
		<td class="bgtt" colspan="4"><button href="admin.php?mod=cache&act=update&cache=all&token=<?php echo $pe_token ?>" onclick="return pe_doall(this, 'form')">一键更新缓存</button></td>
	</tr>
	</table>
	</form>
</div>
<?php include(pe_tpl('footer.html'));?>