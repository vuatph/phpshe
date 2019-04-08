<div class="clear"></div>
<div class="foot">
	<div class="subnav">
		Copyright <span class="num">©</span> <?php echo $cache_setting['web_copyright'] ?> All Rights Reserved <?php echo $cache_setting['web_icp'] ?> <?php echo $cache_setting['web_tongji'] ?>&nbsp;
		Powered by <a href="http://www.phpshe.com" target="_blank" title="PHPSHE商城系统">phpshe<?php echo $ini['phpshe']['version'] ?></a>
	</div>
</div>
<div id="top">
	<div id="izl_rmenu" class="izl-rmenu">
		<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $cache_setting['web_qq'] ?>&site=qq&menu=yes" target="_blank" class="btn btn-qq"></a>
		<div class="btn btn-wx"><img class="pic" src="<?php echo pe_thumb($cache_setting['web_qrcode']) ?>" /></div>
		<div class="btn btn-phone"><div class="phone"><?php echo $cache_setting['web_phone'] ?></div></div>
		<div class="btn btn-top"></div>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>kefu/css/style.css">
<script type="text/javascript" src="<?php echo $pe['host_tpl'] ?>kefu/js/index.js"></script>
<script type="text/javascript">
pe_loadscript("<?php echo $pe['host_root'] ?>index.php?mod=notice");
</script>
</body>
</html>