<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="now">当前位置：<a href="<?php echo $pe['host_root'] ?>">首页</a> <?php echo $nowpath ?></div>
	<div class="danye_left">
		<div class="danye_help">
			<div class="danye_list">
				<h3 class="fl_tb1"><s></s>资讯中心</h3>
				<ul>
				<?php foreach((array)$cache_class_arr['news'] as $v):?>
				<li><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($class_id==$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="danye_help mat10">
			<div class="danye_list">
				<h3 class="fl_tb2"><s></s>帮助中心</h3>
				<ul>
				<?php foreach((array)$cache_class_arr['help'] as $v):?>
				<li><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($class_id==$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
	<div class="danye_right">
		<div class="page_tt"><?php echo $menutitle ?></div>
		<h3 class="mat20 center font16"><?php echo $info['article_name'] ?></h3>
		<p class="mat10 center mab20 c888">发布日期：<?php echo pe_date($info['article_atime']) ?>　浏览量：<?php echo $info['article_clicknum'] ?></p>
		<div class="danye_main"><?php echo $info['article_text'] ?></div>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>