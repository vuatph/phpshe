<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<!--<div class="tixing">
			<span class="cgreen">温馨提示：</span>为了方便商户快速与支付宝签约，PHPSHE(PE)目前只集成了常用的 <u>支付宝双功能收款（即时到帐+担保交易）接口</u>。
			<p><span class="cblue">即时到帐流程</span>：买家 -> 付款给卖家 　-> 卖家到系统后台发货 -> 交易成功</p>
			<p><span class="cblue">担保交易流程</span>：买家 -> 付款给支付宝 -> 卖家到系统后台发货 -> 买家确认收货 -> 交易资金自动转入卖家 -> 交易成功</p>
		</div>-->
		<div class="search">
			<div class="fl qiehuan">
				<a href="admin.php?mod=moban" <?php if($act!='shop'):?>class="sel"<?php endif;?>>本地模板</a>
				| <a href="admin.php?mod=moban&act=shop" <?php if($act=='shop'):?>class="sel"<?php endif;?>>模板商店</a>
			</div>
			<div class="clear"></div>
		</div>
		<div class="tip mab5" id="jindu_load" style="display:none"><img src="<?php echo $pe['host_root'] ?>include/image/load_mini.gif" class="fl" /><span class="fl strong font16 corg mat10 mal10">模板正在安装中，请稍后...</span><div class="clear"></div></div>
		<div class="tip mab5" id="jindu_dui" style="display:none"><img src="<?php echo $pe['host_root'] ?>include/image/tip_dui.png" class="fl" /><span class="fl strong font16 cgreen mat10 mal10">恭喜，模板安装成功！</span><div class="clear"></div></div>
		<div class="tip mab5" id="jindu_cuo" style="display:none"><img src="<?php echo $pe['host_root'] ?>include/image/tip_cuo.png" class="fl" /><span class="fl strong font16 cred mat10 mal10">模板安装失败...<span id="jindu_cuo_text" class="mal5"></span></span><div class="clear"></div></div>
		<?php if($act=='shop'):?>
		<div class="admin_t_info">
			<h3>模板商店</h3>
			<div class="banben">
				<iframe width="100%" height="755px" frameborder="0" src="http://www.phpshe.com/shop"></iframe>
			</div>
		</div>
		<?php else:?>
		<div class="admin_t_info">
			<h3>本地模板</h3>
			<div class="banben">
				<div style="margin-left:30px;">
				<?php foreach($moban_list as $k=>$v):?>
				<?php $moban_config = moban_config($v)?>
				<div class="fl mb_list">
					<img src="<?php echo pe_thumb('template/'.$v.'/index/preview.jpg') ?>" style="width:160px;height:175px" />
					<div style="color:#0099CC; height:20px; overflow:hidden; width:162px;text-align:center;margin-top:5px"><?php echo $moban_config['moban_name'] ?></div>
					<div class="mat5"><input type="text" value="template/<?php echo $v ?>" readonly="readonly" style="background:#f1f1f1;height:20px" class="inputtext input150 mab5"></div>
					<?php if($cache_setting['web_tpl']['setting_value'] == $v):?>
					<div style="position:absolute;top:1px;left:1px;"><img src="<?php echo $pe['host_tpl'] ?>images/moban_sel.png" style="border:0;" /></div>
					<!--<a href="javascript:;" class="fabu_btn fl" style="margin-right:50px">使用中</a>-->
					<?php else:?>
					<a href="admin.php?mod=moban&act=setting&tpl=<?php echo $v ?>" class="admin_edit" style="width:60px;margin-right:60px" onclick="return pe_cfone(this, '使用模板')">使用模板</a>			
					<?php endif;?>
					<?php if(!in_array($v, array('default', $cache_setting['web_tpl']['setting_value']))):?>
					<a href="admin.php?mod=moban&act=del&tpl=<?php echo $v ?>" class="admin_del" onclick="return pe_cfone(this, '模板删除')">删除</a>
					<?php endif;?>
				</div>
				<?php endforeach;?>
				<div class="clear"></div>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>
</div>
<script type="text/javascript">
$(function(){
$.getJSON("http://www.phpshe.com/index.php?mod=api&act=moban_url&callback=?", function(json){
	alert(json.html);
})
if ("<?php echo $act ?>" == 'install') {

	$("#jindu_load").show();
	$.ajaxSettings.async = false;
	$.getJSON("<?php echo $pe['host_root'] ?>admin.php", {"mod":"moban", "act":"down", "id":"<?php echo $_g_id ?>"}, function(json){
		$("#jindu_load").hide();
		if (json.result) {
			$("#jindu_dui").show();
		}
		else {
			$("#jindu_cuo").show();
			$("#jindu_cuo_text").html(json.show);	
		}
		setTimeout(function(){
			window.location.href = "admin.php?mod=moban";
		}, 3000)
	})
}
})
</script>
<?php include(pe_tpl('footer.html'));?>