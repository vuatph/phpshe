<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="now">您现在的位置：<a href="<?php echo $pe['host_root'] ?>">首页</a> <?php echo $nowpath ?></div>
	<div class="danye_left">
		<div class="danye_help">
			<div class="danye_list">
				<h3 class="fl_tb1"><s></s>资讯中心</h3>
				<ul>
				<?php foreach((array)$cache_class_arr['news'] as $v):?>
				<li><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($menumark=='article_'.$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="danye_help mat8">
			<div class="danye_list">
				<h3 class="fl_tb2"><s></s>帮助中心</h3>
				<ul>
				<?php foreach((array)$cache_class_arr['help'] as $v):?>
				<li><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($menumark=='article_'.$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
	<div class="danye_right">
		<?php if($act=='list'):?>
		<div class="page_tt"><?php echo $menutitle ?></div>
		<ul class="wenzhang_list">
			<?php foreach($info_list as $k=>$v):?>
			<li <?php if($k+1==count($info_list)):?>style="border-bottom:0"<?php endif?>><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>" target="_blank"><?php echo $v['article_name'] ?></a><span class="fr c888"><?php echo pe_date($v['article_atime'], 'Y-m-d') ?></span><div class="clear"></div></li>
			<?php endforeach;?>
		</ul>
		<div class="fenye mat8"><?php echo $db->page->html ?></div>
		<?php else:?>
		<div class="page_tt"><?php echo $menutitle ?></div>
		<h3 class="mat20 font16" style="text-align:center;"><?php echo $info['article_name'] ?></h3>
		<p class="c888 mat10 mab20" style="text-align:center;">发布日期：<?php echo pe_date($info['article_atime']) ?>　浏览量：<?php echo $info['article_clicknum'] ?></p>
		<div class="danye_main"><?php echo $info['article_text'] ?></div>
		<?php endif;?>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>