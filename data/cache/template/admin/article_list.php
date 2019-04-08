<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=article&act=add">发布文章</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<div class="fr searbox">
				<form method="get">
					<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
					文章名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext inputtext_200" />
					<select name="class_id" class="inputselect">
					<option value="" href="<?php echo pe_updateurl('class_id', '') ?>">全部分类</option>

					<option value="0" disabled>=====@资讯中心@=====</option>
					<?php foreach($cache_class_arr['news'] as $v):?>
					<option value="<?php echo $v['class_id'] ?>" href="<?php echo pe_updateurl('class_id', $v['class_id']) ?>" <?php if($_g_class_id==$v['class_id']):?>selected="selected"<?php endif;?>><?php echo $v['class_name'] ?></option>
					<?php endforeach;?>
					<option value="0" disabled>=====@帮助中心@=====</option>
					<?php foreach($cache_class_arr['help'] as $v):?>
					<option value="<?php echo $v['class_id'] ?>" href="<?php echo pe_updateurl('class_id', $v['class_id']) ?>" <?php if($_g_class_id==$v['class_id']):?>selected="selected"<?php endif;?>><?php echo $v['class_name'] ?></option>
					<?php endforeach;?>
					</select>
					<input type="submit" value="搜索" class="input2" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'article_id')" /></td>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt">文章名称</td>
			<td class="bgtt" width="120">文章分类</td>
			<td class="bgtt" width="100">发布日期</td>
			<td class="bgtt" width="80">浏览量</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="article_id[]" value="<?php echo $v['article_id'] ?>"></td>
			<td><?php echo $v['article_id'] ?></td>
			<td class="aleft"><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" target="_blank"><?php echo $v['article_name'] ?></a></td>
			<td><?php echo $cache_class[$v['class_id']]['class_name'] ?></td>
			<td><?php echo pe_date($v['article_atime'], 'Y-m-d') ?></td>
			<td><?php echo $v['article_clicknum'] ?></td>
			<td>
				<a href="admin.php?mod=article&act=edit&id=<?php echo $v['article_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=article&act=del&id=<?php echo $v['article_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'article_id')" /></td>
			<td class="bgtt aleft" colspan="6">
				<span class="fl"><button href="admin.php?mod=article&act=del" onclick="return pe_cfall(this, 'article_id', 'form', '批量删除')">批量删除</button></span>
				<span class="fenye"><?php echo $db->page->html ?></span>
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("select").change(function(){
		window.location.href = 'admin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>