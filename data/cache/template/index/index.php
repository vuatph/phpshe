<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="fr action_list">
		<div class="action_tt"><h3><?php echo $cache_class[1]['class_name'] ?></h3></div>
		<ul>
			<?php foreach($notice_list as $k=>$v):?>
			<li <?php if($k>=7):?>style="border-bottom:0"<?php endif;?>><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>" target="_blank"><?php echo $v['article_name'] ?></a></li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="jdt fr">
		<div id="jdtslide" style="visibility:hidden;">
		<?php if(is_array($cache_ad['index_jdt'])):?>
		<?php foreach($cache_ad['index_jdt'] as $v):?>
		<a href="<?php echo $v['ad_url'] ?>"><img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['ad_logo']) ?>" alt="" width="700" height="300" class="js_imgload" /></a>
		<?php endforeach;?>
		<?php endif;?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="pro_tuijian mat10">
		<div class="index_tuijian">
			<h3>本店推荐</h3>
		</div>
		<div class="tuijian_list">
			<?php foreach($product_tuijian as $k=>$v):?>
			<div class="prolist_1" <?php if(($k+1)%5==0):?>style="margin-right:0"<?php endif?>>
				<p class="prolist_img"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 220, 220) ?>" title="<?php echo $v['product_name'] ?>" width="220" height="220" class="js_imgload" /></a></p>
				<?php if($v['product_hd_tag']):?><div class="<?php echo huodong_tag($v['product_hd_tag']) ?>"><?php echo $v['product_hd_tag'] ?></div><?php endif;?>
				<div style="padding:10px 10px 0">
					<p><span class="money1 fl"><span class="num mar3">¥</span><?php echo $v['product_money'] ?></span> <s class="num c888 fr">¥ <?php echo $v['product_mmoney'] ?></s></p>
					<div class="clear"></div>
					<p class="prolist_name"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><?php echo $v['product_name'] ?></a></p>
				</div>
			</div>
			<?php endforeach;?>
			<div class="clear"></div>
		</div>
	</div>
	<!--分类1 Start-->
	<?php foreach((array)$category_indexlist as $k=>$v):?>
	<div class="pro_tuijian mat10">
		<div class="index_fenlei_tt1">
			<h3 class="fl"><span><?php echo $k+1 ?>F</span>　<?php echo $v['category_name'] ?></h3>
			<span class="fr"><a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>" title="<?php echo $v['category_name'] ?>" target="_blank">更多>></a></span>
			<?php if(is_array($cache_category_arr[$v['category_id']])):?>
			<?php foreach($cache_category_arr[$v['category_id']] as $kk=>$vv):?>
			<span class="fr mal10 mar10">|</span>
			<span class="fr"><a href="<?php echo pe_url('product-list-'.$kk) ?>" title="<?php echo $vv['category_name'] ?>" target="_blank"><?php echo $vv['category_name'] ?></a></span>
			<?php endforeach;?>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<div class="tuijian_list">
			<?php foreach($v['product_newlist'] as $kk=>$vv):?>
			<div class="prolist_1" <?php if(($kk+1)%5==0):?>style="margin-right:0"<?php endif;?>>
				<p class="prolist_img"><a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank"><img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($vv['product_logo'], 220, 220) ?>" title="<?php echo $vv['product_name'] ?>" width="220" height="220" class="js_imgload" /></a></p>
				<?php if($vv['product_hd_tag']):?><div class="<?php echo huodong_tag($vv['product_hd_tag']) ?>"><?php echo $vv['product_hd_tag'] ?></div><?php endif;?>
				<div style="padding:10px 10px 0">
					<p class="mat5"><span class="money1 fl"><span class="num mar3">¥</span><?php echo $vv['product_money'] ?></span> <s class="num c888 fr">¥ <?php echo $vv['product_mmoney'] ?></s></p>
					<div class="clear"></div>
					<p class="prolist_name"><a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank"><?php echo $vv['product_name'] ?></a></p>
				</div>
			</div>
			<?php endforeach;?>
			<div class="clear"></div>
		</div>
	</div>
	<?php endforeach;?>
	<!--分类1 End-->
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.slide.js"></script>
<script type="text/javascript">
$(function(){
	$("#jdtslide").KinSlideshow({
		moveStyle:"left",
		intervalTime:5,
		mouseEvent:"mouseover",
		titleBar:{"titleBar_bgColor":""},
		titleFont:{TitleFont_size:14,TitleFont_color:"#ffffff"}
	});
})
</script>
<?php include(pe_tpl('footer.html'));?>