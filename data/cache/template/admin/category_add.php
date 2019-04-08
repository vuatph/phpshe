<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=category&act=add">增加分类</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td class="bg_f8" align="right" width="110">分类名称：</td>
			<td><input type="text" name="info[category_name]" value="<?php echo $info['category_name'] ?>" class="inputall input200" /></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">上级分类：</td>
			<td>
				<select name="info[category_pid]" class="inputselect">
				<option value="0">===顶级分类===</option>
				<?php foreach($category_treelist as $v):?>
				<option value="<?php echo $v['category_id'] ?>" <?php if($v['category_id']==$info['category_pid']):?>selected="selected"<?php endif;?> <?php if(in_array($v['category_id'], (array)$category_noid)):?>disabled="disabled"<?php endif;?>><?php echo $v['category_showname'] ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">分类排序：</td>
			<td><input type="text" name="info[category_order]" value="<?php echo $info['category_order'] ?>" class="inputall input80" /></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">导航显示：</td>
			<td>
				<?php foreach($cache_menu as $v):?>
				<?php if($v['menu_url']=='product-list-'.$info['category_id'])$checked = 1?>
				<?php endforeach;?>
				<?php foreach(array(1=>'显示', 0=>'不显示') as $k=>$v):?>
				<label class="mar10"><input type="radio" name="menutype" value="<?php echo $k ?>" <?php if($k==$checked):?>checked="checked"<?php endif;?> /> <?php echo $v ?></label>
				<?php endforeach;?>
			</td>
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