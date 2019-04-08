<div class="clear"></div>
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
			<div class="item_1 fl">
				<h3>售后服务电话</h3>
				<p class="mat8"><img src="<?php echo $pe['host_tpl'] ?>images/tel_bottom.gif" /></p>
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
		<p>Powered by <a href="http://www.phpshe.com" target="_blank" title="phpshe(PE)以良好的服务为小企业提供B2C电子商务解决方案" class="cgreen">phpshe 1.0(2012-07-07)</a></p>
	</div>
</div>
</body>
</html>
