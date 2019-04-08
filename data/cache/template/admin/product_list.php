<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<a href="admin.php?mod=product" <?php if($act=='index' && !$_g_filter):?>class="sel"<?php endif;?>>商品列表（<?php echo $tongji['all'] ?>）</a>
		<a href="admin.php?mod=product&filter=state|2" <?php if($act=='index' && $_g_filter=='state|2'):?>class="sel"<?php endif;?>>下架商品（<?php echo $tongji['xiajia'] ?>）</a>
		<a href="admin.php?mod=product&filter=num|0" <?php if($act=='index' && $_g_filter=='num|0'):?>class="sel"<?php endif;?>>缺货商品（<?php echo $tongji['quehuo'] ?>）</a>
		<a href="admin.php?mod=product&filter=wlmoney|0" <?php if($act=='index' && $_g_filter=='wlmoney|0'):?>class="sel"<?php endif;?>>包邮商品（<?php echo $tongji['baoyou'] ?>）</a>
		<a href="admin.php?mod=product&filter=istuijian|1" <?php if($act=='index' && $_g_filter=='istuijian|1'):?>class="sel"<?php endif;?>>推荐商品（<?php echo $tongji['tuijian'] ?>）</a>
		<a href="admin.php?mod=product&act=add" style="float:right" id="fabu">添加商品</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
			<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
			<input type="hidden" name="filter" value="<?php echo $_g_filter ?>" />
			商品名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext input200" />
			<select name="category_id" class="selectmini">
			<option value="" href="<?php echo pe_updateurl('category_id', '') ?>">全部分类</option>
			<?php foreach($category_treelist as $v):?>
			<option value="<?php echo $v['category_id'] ?>" href="<?php echo pe_updateurl('category_id', $v['category_id']) ?>" <?php if($_g_category_id==$v['category_id']):?>selected="selected"<?php endif;?>><?php echo $v['category_showname'] ?></option>
			<?php endforeach;?>
			</select>
			<select name="brand_id" class="selectmini">
			<option value="" href="<?php echo pe_updateurl('brand_id', '') ?>">全部品牌</option>
			<?php foreach($cache_brand as $v):?>
			<option value="<?php echo $v['brand_id'] ?>" href="<?php echo pe_updateurl('brand_id', $v['brand_id']) ?>" <?php if($_g_brand_id==$v['brand_id']):?>selected="selected"<?php endif;?>>[<?php echo $v['brand_word'] ?>] <?php echo $v['brand_name'] ?></option>
			<?php endforeach;?>
			</select>
			<select name="orderby" class="selectmini">
			<option value="" href="<?php echo pe_updateurl('orderby', '') ?>">默认排序</option>
			<?php foreach($orderby_arr as $k=>$v):?>
			<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('orderby', $k) ?>" <?php if($_g_orderby==$k):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
			<?php endforeach;?>
			</select>
			<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
		<table border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'product_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="50">排序</th>
			<th class="bgtt" colspan="2"></th>
			<th class="bgtt" width="90">商品分类</th>
			<th class="bgtt" width="90">品牌名称</th>
			<th class="bgtt" width="60">单价</th>
			<th class="bgtt" width="50">库存</th>
			<!--<th class="bgtt" width="50">浏览</td>-->
			<th class="bgtt" width="50">上架</th>
			<th class="bgtt" width="80">销量/评价</th>
			<th class="bgtt" width="100">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="product_id[]" value="<?php echo $v['product_id'] ?>" /></td>
			<td><?php echo $v['product_id'] ?></td>
			<td><input type="text" name="product_order[<?php echo $v['product_id'] ?>]" value="<?php echo $v['product_order'] ?>" class="inputtext input30 center" /></td>
			<td width="40"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" width="40" height="40" class="imgbg" /></a></td>
			<td class="aleft" style="padding-left:0"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="cblue"><?php echo $v['product_name'] ?></a><?php if($v['product_istuijian']):?><span class="corg mal5">[荐]</span><?php endif;?></td>
			<td><?php echo $cache_category[$v['category_id']]['category_name'] ?></td>
			<td><?php echo $cache_brand[$v['brand_id']]['brand_name'] ?></td>
			<td><span class="num corg"><?php echo $v['product_smoney'] ?></span></td>
			<td class="num"><span <?php if(!$v['product_num']):?>class="cred strong"<?php endif;?>><?php echo $v['product_num'] ?></span></td>
			<!--<td class="num"><?php echo $v['product_clicknum'] ?></td>-->
			<td>
				<?php if($v['product_state']==1):?>
				<a href="admin.php?mod=product&act=state&state=2&id=<?php echo $v['product_id'] ?>&token=<?php echo $pe_token ?>"><img src="<?php echo $pe['host_tpl'] ?>images/dui.png" /></a>
				<?php else:?>
				<a href="admin.php?mod=product&act=state&state=1&id=<?php echo $v['product_id'] ?>&token=<?php echo $pe_token ?>"><img src="<?php echo $pe['host_tpl'] ?>images/cuo.png" /></a>
				<?php endif;?>
			</td>
			<td>
				<a href="admin.php?mod=product&act=sell&id=<?php echo $v['product_id'] ?>&<?php echo pe_fromto() ?>" onclick="return pe_dialog(this, '设置销量', 400, 210, 'product_sell')"><?php echo $v['product_sellnum'] ?></a>
				<span class="c999">/</span>
				<a href="admin.php?mod=product&act=comment&id=<?php echo $v['product_id'] ?>" onclick="return pe_dialog(this, '添加评价', 920, 510, 'product_comment')"><?php echo $v['product_commentnum'] ?></a>
			</td>
			<td>
				<a href="admin.php?mod=product&act=edit&id=<?php echo $v['product_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar3">修改</a>
				<a href="admin.php?mod=product&act=del&id=<?php echo $v['product_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'product_id')" />
			<button href="admin.php?mod=product&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'product_id', 'form', '批量删除')">批量删除</button>
			<button href="admin.php?mod=product&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">更新排序</button>
			<button href="admin.php?mod=product&act=state&state=1&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'product_id', 'form', '批量上架')">批量上架</button>
			<button href="admin.php?mod=product&act=state&state=2&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'product_id', 'form', '批量下架')">批量下架</button>
			<button href="admin.php?mod=product&act=tuijian&tuijian=1&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'product_id', 'form', '批量推荐')">批量推荐</button>
			<button href="admin.php?mod=product&act=tuijian&tuijian=0&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'product_id', 'form', '取消推荐')">取消推荐</button>
			<button type="button" onclick="product_move()">批量转移商品</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
function product_move() {
	var product_id = new Array();
	if ($("input[name='product_id[]']").filter(":checked").length == 0) {
		alert('请先勾选需要转移的商品!');
		return false;
	}
	$("input[name='product_id[]']").filter(":checked").each(function(i){
		product_id[i] = $(this).val();
	})
	product_id = product_id.join(',');
	var layer_index = layer.open({
		type: 2,
		title: '批量转移商品',
		area: ['400px', '220px'],
		fixed: false, //不固定
		shadeClose: true,
		shade: 0.5,
		content: "<?php echo $pe['host_root'] ?>admin.php?mod=product&act=move&id="+product_id //iframe的url
	});
}
$(function(){
	$("select").change(function(){
		window.location.href = 'admin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>