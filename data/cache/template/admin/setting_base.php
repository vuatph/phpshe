<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<div class="now_l"></div>
		<div class="now_m"><?php echo $menutitle ?></div>
		<div class="now_r"></div>
		<div class="clear"></div>
	</div>
	<form method="post" enctype="multipart/form-data">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
	<tr>
		<td class="bg_f8" align="right" width="100">网站标题：</td>
		<td><input type="text" name="info[web_title]" value="<?php echo $info['web_title']['setting_value'] ?>" class="inputall input500" /></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">关 键 词：</td>
		<td><input type="text" name="info[web_keywords]" value="<?php echo $info['web_keywords']['setting_value'] ?>" class="inputall input500" /></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">网站描述：</td>
		<td><textarea name="info[web_description]" style="width:500px;height:100px;"><?php echo $info['web_description']['setting_value'] ?></textarea></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">网站LOGO：</td>
		<td>
			<?php if($info['web_logo']['setting_value']):?>
			<p class="mab5"><img src="<?php echo pe_thumb($info['web_logo']['setting_value']) ?>" height="60" style="border:1px solid #ddd" /></p>
			<?php endif?>
			<p><input type="file" name="web_logo" /></p>
		</td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">网站模板：</td>
		<td>
			<select name="info[web_tpl]" class="inputselect">
			<?php foreach($tpl_arr as $v):?>
			<option value="<?php echo $v ?>" <?php if($info['web_tpl']['setting_value']==$v):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
			<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">咨询热线：</td>
		<td><input type="text" name="info[web_phone]" value="<?php echo $info['web_phone']['setting_value'] ?>" class="inputall input500" /></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">咨询 Q Q：</td>
		<td><input type="text" name="info[web_qq]" value="<?php echo $info['web_qq']['setting_value'] ?>" class="inputall input500" /><span class="c888">（多个请用“,”隔开）</span></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">版权所有：</td>
		<td><input type="text" name="info[web_copyright]" value="<?php echo $info['web_copyright']['setting_value'] ?>" class="inputall input500" /></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">备 案 号：</td>
		<td><input type="text" name="info[web_icp]" value="<?php echo $info['web_icp']['setting_value'] ?>" class="inputall input500" /></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">微博地址：</td>
		<td><input type="text" name="info[web_weibo]" value="<?php echo $info['web_weibo']['setting_value'] ?>" class="inputall input500" /></td>
	</tr>
	<tr>
		<td class="bg_f8" align="right">统计代码：</td>
		<td><textarea name="info[web_tongji]" style="width:500px;height:150px;"><?php echo $info['web_tongji']['setting_value'] ?></textarea></td>
	</tr>
	<tr>
		<td class="bg_f8">&nbsp;</td>
		<td><input type="submit" name="pesubmit" value="提 交" class="tjbtn"></td>
	</tr>
	</table>
	</form>
</div>
<?php include(pe_tpl('footer.html'));?>