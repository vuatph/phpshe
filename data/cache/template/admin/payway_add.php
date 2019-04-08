<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td width="110" class="bg_f8" align="right">支付名称：</td>
			<td><?php echo $info['payway_name'] ?></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">支付描述：</td>
			<td><input type="text" name="info[payway_text]" value="<?php echo $info['payway_text'] ?>" class="inputall input600" /></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">是否启用：</td>
			<td>
				<select name="info[payway_state]" class="inputselect">
				<?php foreach(array('1'=>'启用', '0'=>'停用') as $k=>$v):?>
				<option value="<?php echo $k ?>" <?php if($k==$info['payway_state']):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<?php foreach($info['payway_model'] as $k=>$v):?>
		<tr>
			<td class="bg_f8" align="right"><?php echo $v['name'] ?>：</td>
			<td>
				<?php if($v['form_type']=='select'):?>
				<select name="config[<?php echo $k ?>]" class="inputselect">
				<?php foreach($v['form_value'] as $kk=>$vv):?>
				<option value="<?php echo $kk ?>" <?php if($kk==$info['payway_config'][$k]):?>selected="selected"<?php endif;?>><?php echo $vv ?></option>
				<?php endforeach;?>
				</select>
				<?php elseif($v['form_type']=='textarea'):?>
				<textarea name="config[<?php echo $k ?>]" style="width:600px;height:150px;"><?php echo $info['payway_config'][$k] ?></textarea>
				<?php else:?>
				<input type="text" name="config[<?php echo $k ?>]" value="<?php echo $info['payway_config'][$k] ?>" class="inputall input300" />
				<?php endif;?>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bg_f8">&nbsp;</td>
			<td><input type="submit" name="pesubmit" value="提 交" class="tjbtn"></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>