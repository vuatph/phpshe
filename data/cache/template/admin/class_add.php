<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=class&act=add">增加分类</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td class="bg_f8" align="right" width="110">分类名称：</td>
			<td><input type="text" name="info[class_name]" value="<?php echo $info['class_name'] ?>" class="inputall input200" /></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">上级分类：</td>
			<td>
				<select name="info[class_type]" class="inputselect">
				<?php foreach(array('news'=>'资讯中心', 'help'=>'帮助中心') as $k=>$v):?>
				<option value="<?php echo $k ?>" <?php if($k==$info['class_type']):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">分类排序：</td>
			<td><input type="text" name="info[class_order]" value="<?php echo $info['class_order'] ?>" class="inputall input80" /></td>
		</tr>
		<tr>
			<td class="bg_f8">&nbsp;</td>
			<td><input type="submit" name="pesubmit" value="提 交" class="tjbtn" /></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>