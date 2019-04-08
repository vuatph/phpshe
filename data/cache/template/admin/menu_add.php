<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=menu&act=add">增加导航</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td class="bg_f8" align="right" width="110">导航类型：</td>
			<td>
				<?php foreach(array('sys'=>'内置栏目', 'diy'=>'自定义导航') as $k=>$v):?>
				<?php $checked = ((!$info['menu_type'] && $k=='sys') or ($info['menu_type'] && $k==$info['menu_type'])) ? 'checked="checked"' : ''?>
				<label><input type="radio" name="info[menu_type]" value="<?php echo $k ?>" <?php echo $checked ?> /> <?php echo $v ?>&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<?php endforeach;?>
			</td>
		</tr>
		<tr class="menu_sys">
			<td class="bg_f8" align="right">导航名称：</td>
			<td>
				<select name="menu_name" class="inputselect">
				<?php foreach($menu_sys_arr as $k=>$v):?>
				<?php if(in_array($k, array('category', 'class', 'page', 'brand'))):?>	
				<option disabled><?php echo $v ?></option>
				<?php else:?>
				<option value="<?php echo $v ?>" <?php if($v==$info['menu_name'].'|'.$info['menu_url']):?>selected="selected"<?php endif;?>><?php echo $k ?></option>			
				<?php endif;?>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr class="menu_diy">
			<td class="bg_f8" align="right">导航名称：</td>
			<td><input type="text" name="info[menu_name]" value="<?php echo $info['menu_type']=='diy' ? $info['menu_name'] : '' ?>" class="inputall input200" /> <span class="c888">（如：简好科技）</span></td>
		</tr>
		<tr class="menu_diy">
			<td class="bg_f8" align="right">链接地址：</td>
			<td><input type="text" name="info[menu_url]" value="<?php echo $info['menu_type']=='diy' ? $info['menu_url'] : '' ?>" class="inputall input500" /> <span class="c888">（如：http://www.phpshe.com）</span></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">导航排序：</td>
			<td><input type="text" name="info[menu_order]" value="<?php echo $info['menu_order'] ?>" class="inputall input80" /></td>
		</tr>
		<tr>
			<td class="bg_f8">&nbsp;</td>
			<td><input type="submit" name="pesubmit" value="提 交" class="tjbtn" /></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
$(function(){
	menu_html();
	$(":input[name='info[menu_type]']").change(function(){
		menu_html();
	})
})
function menu_html() {
	if ($(":input[name='info[menu_type]']:checked").val() == 'diy') {
		$(".menu_sys").hide().find(":input").attr("disabled", "disabled");
		$(".menu_diy").show().find(":input").removeAttr("disabled");
	}
	else {

		$(".menu_diy").hide().find(":input").attr("disabled", "disabled");
		$(".menu_sys").show().find(":input").removeAttr("disabled");		
	}
}
</script>
<?php include(pe_tpl('footer.html'));?>