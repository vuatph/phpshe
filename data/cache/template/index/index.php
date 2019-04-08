<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="jdt_banner">
		<ul class="banList">
			<?php $index_jdt = 1;?>
			<?php foreach($cache_ad['index_jdt'] as $k=>$v):?>
			<li <?php if($index_jdt++==1):?>class="active1"<?php endif;?>><a href="<?php echo $v['ad_url'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['ad_logo']) ?>"/></a></li>
			<?php endforeach;?>
		</ul>
		<div style="position:relative; width:710px; margin:0 auto; z-index:100">
		<div class="fomW">
			<div class="jsNav">
				<?php $index_jdt = 1;?>
				<?php foreach($cache_ad['index_jdt'] as $v):?>
				<a href="javascript:;" class="trigger <?php if($index_jdt++==1):?>current<?php endif;?>"></a>
				<?php endforeach;?>
			</div>
		</div>
		</div>
	</div>
	<div class="fr action_list">
		<div class="action_tt">
			<h3 class="fl"><?php echo $cache_class[1]['class_name'] ?></h3>
			<a class="fr" href="<?php echo pe_url('article-list-1') ?>">更多 ></a>
			<div class="clear"></div>
		</div>
		<ul>
			<?php foreach($notice_list as $k=>$v):?>
			<li <?php if($k>=7):?>style="border-bottom:0"<?php endif;?>><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>" target="_blank"><?php echo $v['article_name'] ?></a><?php echo pe_date($v['article_atime'], 'm-d') ?></li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="clear"></div>
	<!--商品推荐 Start-->
	<div class="i_tj_tt1">新品推荐　<span class="font14 num">NEW PRODUCTS</span></div>
	<div class="i_tjsp_r">
		<?php foreach($product_newlist as $k=>$v):?>
		<div class="i_prolist_1" <?php if(($k+1)%5==0):?>style="padding-right:0; border-right:0"<?php endif?>>
			<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank">
			<p class="i_prolist_img"><img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 195, 195) ?>" title="<?php echo $v['product_name'] ?>" width="195" height="195" class="js_imgload" /></p>
			<?php if($v['product_hd_tag']):?><div class="<?php echo huodong_tag($v['product_hd_tag']) ?>"><?php echo $v['product_hd_tag'] ?></div><?php endif;?>
			<div style="padding:5px 0 0">
				<p class="prolist_name"><?php echo $v['product_name'] ?></p>
				<p class="mat8"><span class="money1 fl"><span class="num mar3">¥</span><?php echo $v['product_money'] ?></span> <s class="num c888 fr">¥ <?php echo $v['product_mmoney'] ?></s></p>	
				<div class="clear"></div>
			</div>
			</a>
		</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<!--商品推荐 End-->
	<!--分类1 Start-->
	<?php foreach($category_indexlist as $k=>$v):?>
	<div class="pro_tuijian mat20">
		<div class="xuqiu_tt">
			<div class="fl">
				<h3><?php echo $v['category_name'] ?></h3>
			</div>
			<a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>" title="<?php echo $v['category_name'] ?>" target="_blank" class="c888 fr mat10 font14">更多 ></a>
			<?php if(is_array($cache_category_arr[$v['category_id']])):?>
			<div class="xuqiu_tt_r">
				热门分类：
				<span style="overflow:hidden; height:16px;">
				<?php foreach($cache_category_arr[$v['category_id']] as $kk=>$vv):?>
				<a href="<?php echo pe_url('product-list-'.$kk) ?>" title="<?php echo $vv['category_name'] ?>" target="_blank"><?php echo $vv['category_name'] ?></a>
				<span class="mal10 mar10 xian"></span>
				<?php endforeach;?>
				</span>
			</div>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<div style="background:#fff;">
			<div class="index_ad"><a href="<?php echo pe_url($v['ad']['ad_url']) ?>"><img src="<?php echo pe_thumb($v['ad']['ad_logo']) ?>"></a></div>
			<div class="tuijian_list" style="float:left; width:948px; background:#fff;">
				<?php foreach($v['product_list'] as $kk=>$vv):?>
				<div class="prolist_r" <?php if(($kk+1)%4==0):?>style="margin-right:0"<?php endif;?>>
					<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank">
					<p class="prolist_r_img"><img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($vv['product_logo'], 180, 180) ?>" title="<?php echo $vv['product_name'] ?>" width="180" height="180" class="js_imgload" /></p>
					<?php if($vv['product_hd_tag']):?><div class="<?php echo huodong_tag($vv['product_hd_tag']) ?>"><?php echo $vv['product_hd_tag'] ?></div><?php endif;?>
					<div style="padding:5px 0 0">
						<p class="prolist_name"><?php echo $vv['product_name'] ?></p>
						<p class="mat8"><span class="money1 fl"><span class="num mar3">¥</span><?php echo $vv['product_money'] ?></span> <s class="num c888 fr">¥ <?php echo $vv['product_mmoney'] ?></s></p>
						<div class="clear"></div>
					</div>
					</a>
				</div>
				<?php endforeach;?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php endforeach;?>
	<!--分类1 End-->
</div>
<script type="text/javascript" src="<?php echo $pe['host_tpl'] ?>js/jquery.banner.js"></script>
<script type="text/javascript">
$(function(){
	$(".jdt_banner").swBanner();
})
</script>
<style type="text/css">
body{background:#fafafa;}
</style>
<?php include(pe_tpl('footer.html'));?>