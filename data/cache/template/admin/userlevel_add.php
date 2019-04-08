<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<a href="javascript:;" class="sel"><?php echo $menutitle ?></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20">
		<tr>
			<td align="right" width="150">会员等级：</td>
			<td><input type="text" name="info[userlevel_name]" value="<?php echo $info['userlevel_name'] ?>" class="inputall input200" /></td>
		</tr>
		<tr>
			<td align="right">自动升级：</td>
			<td>
				<?php foreach(array(1=>'是', 0=>'否') as $k=>$v):?>
				<label class="mar30"><input type="radio" name="info[userlevel_up]" value="<?php echo $k ?>" <?php if($k==$info['userlevel_up']):?>checked="checked"<?php endif;?> <?php if($act=='edit'):?>disabled="disabled"<?php endif;?> /> <?php echo $v ?></label>
				<?php endforeach;?>
				<span class="cbbb mal2">（是否可以随消费额自动升级）</span>
			</td>
		</tr>
		<tr>
			<td align="right">消费额满：</td>
			<td><input type="text" name="info[userlevel_value]" value="<?php echo $info['userlevel_value'] ?>" class="inputall input100" <?php if($act=='edit' && !$info['userlevel_up']):?>disabled="disabled"<?php endif;?> /> 元</td>
		</tr>
		<tr>
			<td align="right">折&nbsp;&nbsp;扣 率：</td>
			<td><input type="text" name="info[userlevel_zhe]" value="<?php echo $info['userlevel_zhe']*100 ?>" class="inputall input100" /> % <span class="cbbb">（打9折，请填90%）</span></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
				<input type="submit" name="pesubmit" value="提 交" class="tjbtn" />
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(":input[name='info[userlevel_up]']").click(function(){
		if ($("input:checked").val() == 0) {
			$(":input[name='info[userlevel_value]']").attr("disabled", "disabled");
		}
		else {
			$(":input[name='info[userlevel_value]']").removeAttr("disabled");		
		}
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>