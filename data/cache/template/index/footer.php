<div class="clear"></div>
<?php if($mod=='index' && is_array($cache_ad['index_footer'])):?>
<?php foreach($cache_ad['index_footer'] as $v):?>
<div class="ad980">
<?php if($v['ad_url']):?>
<a href="<?php echo $v['ad_url'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['ad_logo']) ?>" /></a>
<?php else:?>
<img src="<?php echo pe_thumb($v['ad_logo']) ?>" />
<?php endif;?>
</div>
<?php endforeach;?>
<?php endif;?>
<?php if(is_array($cache_ad['footer'])):?>
<?php foreach($cache_ad['footer'] as $v):?>
<div class="ad980">
<?php if($v['ad_url']):?>
<a href="<?php echo $v['ad_url'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['ad_logo']) ?>" /></a>
<?php else:?>
<img src="<?php echo pe_thumb($v['ad_logo']) ?>" />
<?php endif;?>
</div>
<?php endforeach;?>
<?php endif;?>
<div class="foot">
	<div class="bottom_link">
		<div class="border_link">
			<div class="item_1 fl">
				<h3>用户指南</h3>
				<ul class="mat5">
					<li><a href="<?php echo pe_url('page-1') ?>" title="<?php echo $cache_page[1]['page_name'] ?>"><?php echo $cache_page[1]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-2') ?>" title="<?php echo $cache_page[2]['page_name'] ?>"><?php echo $cache_page[2]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-3') ?>" title="<?php echo $cache_page[3]['page_name'] ?>"><?php echo $cache_page[3]['page_name'] ?></a></li>
				</ul>
			</div>
			<div class="bottom_libg fl"></div>
			<div class="item_1 fl">
				<h3>配送方式</h3>
				<ul class="mat5">
					<li><a href="<?php echo pe_url('page-4') ?>" title="<?php echo $cache_page[4]['page_name'] ?>"><?php echo $cache_page[4]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-5') ?>" title="<?php echo $cache_page[5]['page_name'] ?>"><?php echo $cache_page[5]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-6') ?>" title="<?php echo $cache_page[6]['page_name'] ?>"><?php echo $cache_page[6]['page_name'] ?></a></li>
				</ul>
			</div>
			<div class="bottom_libg fl"></div>
			<div class="item_1 fl">
				<h3>售后服务</h3>
				<ul class="mat5">
					<li><a href="<?php echo pe_url('page-7') ?>" title="<?php echo $cache_page[7]['page_name'] ?>"><?php echo $cache_page[7]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-8') ?>" title="<?php echo $cache_page[8]['page_name'] ?>"><?php echo $cache_page[8]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-9') ?>" title="<?php echo $cache_page[9]['page_name'] ?>"><?php echo $cache_page[9]['page_name'] ?></a></li>
				</ul>
			</div>
			<div class="bottom_libg fl"></div>
			<div class="item_1 fl">
				<h3>关于我们</h3>
				<ul class="mat5">
					<li><a href="<?php echo pe_url('page-10') ?>" title="<?php echo $cache_page[10]['page_name'] ?>"><?php echo $cache_page[10]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-11') ?>" title="<?php echo $cache_page[11]['page_name'] ?>"><?php echo $cache_page[11]['page_name'] ?></a></li>
					<li><a href="<?php echo pe_url('page-12') ?>" title="<?php echo $cache_page[12]['page_name'] ?>"><?php echo $cache_page[12]['page_name'] ?></a></li>
				</ul>
			</div>
			<div class="bottom_libg fl"></div>
			<div class="foot_tel fl">
				<h3 class="c666"><?php echo $cache_setting['web_title']['setting_value'] ?></h3>
				<p class="mat10">
					<?php foreach($web_qq as $v):?>
					<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $v ?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
					<?php endforeach;?>
				</p>
				<p class="tel_num"><?php echo $cache_setting['web_phone']['setting_value'] ?></p>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="flink">
		<span class="strong">友情链接：</span>
		<?php foreach($cache_link as $v):?>
		<a href="<?php echo $v['link_url'] ?>" title="<?php echo $v['link_name'] ?>" target="_blank"><?php echo $v['link_name'] ?></a>
		<?php endforeach;?>
	</div>
	<div class="subnav">
		<p>Copyright <span class="num">©</span> <?php echo $cache_setting['web_copyright']['setting_value'] ?> All Rights Reserved <?php echo $cache_setting['web_icp']['setting_value'] ?> <?php echo $cache_setting['web_tongji']['setting_value'] ?></p>
		<p>Powered by <a href="http://www.phpshe.com" target="_blank" title="PHPSHE商城系统" class="cgreen">phpshe1.1</a></p>
	</div>
</div>
</body>
</html>
