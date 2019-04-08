<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="width960">
		<div class="jdt fl">
			<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.slide.js"></script>
			<script type="text/javascript">
			$(function(){
				$("#jdtslide").KinSlideshow({
					moveStyle:"left",
					intervalTime:3,
					mouseEvent:"mouseover",
					titleBar:{"titleBar_bgColor":""},
					titleFont:{TitleFont_size:14,TitleFont_color:"#ffffff"}
				});
			})
			</script>
			<div id="jdtslide" style="visibility:hidden;">
				<?php foreach($jdt_list as $v):?>
				<a href="<?php echo $v['ad_url'] ?>"><img src="<?php echo pe_thumb($v['ad_logo']) ?>" alt="" width="700" height="300" /></a>
				<?php endforeach;?>
			</div>
		</div>
		<div class="fr action_list">
			<div class="action_tt"><h3>网站公告</h3></div>
			<ul class="mat5">
				<?php foreach($article_noticelist as $v):?>
				<li><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>" target="_blank"><span class="c888">[<?php echo pe_date($v['article_atime'], 'm-d') ?>]</span><?php echo $v['article_name'] ?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="index_main">
		<div class="pro_tuijian">
			<div class="mal10"><img src="<?php echo $pe['host_tpl'] ?>images/pro_tuijian.gif" /></div>
			<div>
				<?php foreach($product_tuijian as $k => $v):?>
				<div class="prolist_1">
					<p class="prolist_img"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 165, 165) ?>" title="<?php echo $v['product_name'] ?>" /></a></p>
					<p class="prolist_name"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><?php echo $v['product_name'] ?></a></p>
					<p class="c888">市场价：<s class="num">¥ <?php echo $v['product_mmoney'] ?></s></p>
					<p class="cred">商城价：<strong class="num">¥ <?php echo $v['product_smoney'] ?></strong></p>
				</div>
				<?php endforeach;?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="pro_tuijian mat8">
			<div class="mal10"><img src="<?php echo $pe['host_tpl'] ?>images/pro_cuxiao.gif" /></div>
			<div>
				<?php foreach($product_cuxiao as $k => $v):?>
				<div class="prolist_1">
					<p class="prolist_img"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 165, 165) ?>" title="<?php echo $v['product_name'] ?>" /></a></p>
					<p class="prolist_name"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><?php echo $v['product_name'] ?></a></p>
					<p class="c888">市场价：<s class="num">¥ <?php echo $v['product_mmoney'] ?></s></p>
					<p class="cred">商城价：<strong class="num">¥ <?php echo $v['product_smoney'] ?></strong></p>
				</div>
				<?php endforeach;?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		<!--分类1 Start-->
		<?php foreach((array)$category_indexlist as $k => $v):?>
		<div class="index_fenlei mat10">
			<div class="index_fenlei_tt">
				<h3 class="fl font16"><span class="num"><?php echo $k+1 ?>F </span><?php echo $v['category_name'] ?></h3>
				<span class="fr mat5"><a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>" title="<?php echo $v['category_name'] ?>" target="_blank">更多>></a></span>
			</div>
			<div class="prolist">
				<div class="fl prolist_left">
					<?php foreach($v['product_newlist'] as $vv):?>
					<div class="prolist_1">
						<p class="prolist_img"><a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank"><img src="<?php echo pe_thumb($vv['product_logo'], 165, 165) ?>" title="<?php echo $vv['product_name'] ?>" /></a></p>
						<p class="prolist_name"><a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank"><?php echo $vv['product_name'] ?></a></p>
						<p class="c888">市场价：<s class="num">¥ <?php echo $vv['product_mmoney'] ?></s></p>
						<p class="cred">商城价：<strong class="num">¥ <?php echo $vv['product_smoney'] ?></strong></p>
					</div>
					<?php endforeach;?>
				</div>
				<div class="fr prolist_right">
					<h3>【<?php echo $v['category_name'] ?>】热销排行</h3>
					<ul class="hotlist index_hot">
					<?php foreach($v['product_selllist'] as $vv):?>
					<li>
						<span class="fl hotimg">
							<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank"><img src="<?php echo pe_thumb($vv['product_logo'], 70, 70) ?>" title="<?php echo $vv['product_name'] ?>" /></a>
						</span>
						<span class="fl hotname hotname_index">
							<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank"><?php echo $vv['product_name'] ?></a>
							<span class="cred num">¥ <strong><?php echo $vv['product_smoney'] ?></strong></span>
						</span>
						<div class="clear"></div>
					</li>
					<?php endforeach;?>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php endforeach;?>
		<!--分类1 End-->
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>