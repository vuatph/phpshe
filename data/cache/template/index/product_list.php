<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="now"><?php echo $nowpath ?></div>
	<div class="remai fl">
		<h3>商品分类</h3>
		<div class="hotlist spfl">
			<?php foreach((array)$cache_category_arr[0] as $k=>$v):?>
			<div class="zhulei"><a href="<?php echo pe_url('product-list-'.$k) ?>" <?php if($category_id==$k):?>class="sel"<?php endif;?>><?php echo $v['category_name'] ?></a></div>
			<div class="clear"></div>
			<?php if(is_array($cache_category_arr[$v['category_id']])):?>
			<div class="zilei">
				<?php foreach($cache_category_arr[$v['category_id']] as $kk=>$vv):?>
				<a href="<?php echo pe_url('product-list-'.$kk) ?>" <?php if($category_id==$kk):?>class="sel"<?php endif;?>><?php echo $vv['category_name'] ?></a>
				<?php endforeach;?>
				<div class="clear"></div>
			</div>
			<?php endif;?>
			<?php endforeach;?>
		</div>
		<h3 class="mat10">热销排行</h3>
		<ul class="hotlist">
			<?php foreach((array)$product_hotlist as $v):?>
			<li>
				<span class="fl hotimg"><img src="<?php echo $pe['host_root'] ?>include/image/load.gif" data-original="<?php echo pe_thumb($v['product_logo'], 60, 60) ?>" title="<?php echo $v['product_name'] ?>" /></span>
				<span class="fl hotname">
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><?php echo $v['product_name'] ?></a>
					<span class="cred num strong lh20">¥<?php echo $v['product_money'] ?></span>
				</span>
				<div class="clear"></div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="fr xiangqing" style="margin-top:0">
		<div class="caidan">
			<h3 class="fl">商品列表</h3>
			<ul class="fr">
				<li class="prolist_px"><a href="<?php echo pe_updateurl('orderby', '') ?>">默认排序</a></li>
				<li class="prolist_px">
					<?php if($_g_orderby=='clicknum_asc'):?>
					<a href="<?php echo pe_updateurl('orderby', 'clicknum_desc') ?>"><i class="i2"></i>按人气</a>
					<?php elseif($_g_orderby=='clicknum_desc'):?>
					<a href="<?php echo pe_updateurl('orderby', 'clicknum_asc') ?>"><i class="i1"></i>按人气</a>
					<?php else:?>
					<a href="<?php echo pe_updateurl('orderby', 'clicknum_desc') ?>">按人气</a>
					<?php endif;?>
				</li>
				<li class="prolist_px">
					<?php if($_g_orderby=='sellnum_asc'):?>
					<a href="<?php echo pe_updateurl('orderby', 'sellnum_desc') ?>"><i class="i2"></i>按销量</a>
					<?php elseif($_g_orderby=='sellnum_desc'):?>
					<a href="<?php echo pe_updateurl('orderby', 'sellnum_asc') ?>"><i class="i1"></i>按销量</a>
					<?php else:?>
					<a href="<?php echo pe_updateurl('orderby', 'sellnum_desc') ?>">按销量</a>
					<?php endif;?>
				</li>
				<li class="prolist_px">
					<?php if($_g_orderby=='money_asc'):?>
					<a href="<?php echo pe_updateurl('orderby', 'money_desc') ?>"><i class="i2"></i>按价格</a>
					<?php elseif($_g_orderby=='money_desc'):?>
					<a href="<?php echo pe_updateurl('orderby', 'money_asc') ?>"><i class="i1"></i>按价格</a>
					<?php else:?>
					<a href="<?php echo pe_updateurl('orderby', 'money_desc') ?>">按价格</a>
					<?php endif;?>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="prolist">
			<?php foreach((array)$info_list as $v):?>
			<div class="prolist_1 prolist_border">
				<p class="prolist_img prolist_img1"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><img src="<?php echo $pe['host_root'] ?>include/image/load.gif" data-original="<?php echo pe_thumb($v['product_logo'], 150, 150) ?>"  title="<?php echo $v['product_name'] ?>" style="display:block" /></a></p>
				<p class="prolist_name"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><?php echo $v['product_name'] ?></a></p>
				<p><span class="money1">¥<?php echo $v['product_money'] ?></span> <s class="num c888">¥ <?php echo $v['product_money'] ?></s></p>
			</div>
			<?php endforeach;?>
		</div>
		<div class="clear"></div>
		<div class="fenye mat15"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
$(function(){
	$("img").lazyload({
		effect:"fadeIn",
		container:$("body")
	});
})
</script>
<?php include(pe_tpl('footer.html'));?>