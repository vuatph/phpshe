<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=article&act=add">发布文章</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td class="bg_f8" align="right" width="110">文章名称：</td>
			<td><input type="text" name="info[article_name]" value="<?php echo $info['article_name'] ?>" class="inputall input600" /></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">文章分类：</td>
			<td>
				<select name="info[class_id]" class="inputselect">
				<option value="0" disabled>=====@资讯中心@=====</option>
				<?php foreach($cache_class_arr['news'] as $v):?>
				<option value="<?php echo $v['class_id'] ?>" <?php if($v['class_id']==$info['class_id']):?>selected="selected"<?php endif;?>><?php echo $v['class_name'] ?></option>
				<?php endforeach;?>
				<option value="0" disabled>=====@帮助中心@=====</option>
				<?php foreach($cache_class_arr['help'] as $v):?>
				<option value="<?php echo $v['class_id'] ?>" <?php if($v['class_id']==$info['class_id']):?>selected="selected"<?php endif;?>><?php echo $v['class_name'] ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">发布日期：</td>
			<td><input type="text" name="info[article_atime]" value="<?php echo pe_date($info['article_atime'] ? $info['article_atime'] : time()) ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" class="Wdate" /></td>
		</tr>
		</table>
		<div class="mat5"><textarea name="info[article_text]" id="editortext" style="width:99.8%;height:550px"><?php echo htmlspecialchars($info['article_text']) ?></textarea></div>
		<div class="mat10 center"><input type="submit" name="pesubmit" value="提 交" class="tjbtn" /></div>
		</form>
	</div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/plugin/my97/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/plugin/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/plugin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" charset="utf-8">
var editor;
KindEditor.ready(function(K) {
	editor = K.create('#editortext', {
		allowFlashUpload :false
	});
});
</script>
<?php include(pe_tpl('footer.html'));?>