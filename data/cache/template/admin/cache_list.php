<?php include(pe_tpl('header.html'));?>
<div class="right fr">
	<div class="now">
		<div class="fl now1"></div>
		<div class="fl now2">缓存管理</div>
		<div class="fl now3"></div>
		<div class="clear"></div>
	</div>
	<div class="tixing"><span class="cgreen">温馨提示：</span>当您网站上的数据显示异常，或是网页不能显示时请执行更新缓存操作。</div>
	<form method="post" id="form">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list mat5">
	<tr>
		<td class="bgtt" align="center" width="100">缓存名称</td>
		<td class="bgtt" align="center">缓存说明</td>
		<td class="bgtt" align="center" width="100">大小（KB）</td>
		<td class="bgtt" align="center" width="30">操作</td>
	</tr>
	<?php foreach($info_list as $k => $v):?>
	<tr>
		<td align="center"><?php echo $v['cache_name'] ?></td>
		<td><?php echo $v['cache_text'] ?></td>
		<td align="center"><?php echo $v['cache_size'] ?></td>
		<td align="center"><a href="admin.php?mod=cache&act=updatesql&cache=<?php echo $k ?>" class="admin_edit">更新</a></td>
	</tr>
	<?php endforeach;?>
	<tr>
		<td class="bgtt" colspan="4"><button href="admin.php?mod=cache&act=updatesql" onclick="return pe_doall(this, 'form')">一键更新缓存</button></td>
	</tr>
	</table>
	</form>
</div>
<?php include(pe_tpl('footer.html'));?>