<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=product&act=add">发布商品</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<div class="fl qiehuan">
				<a href="admin.php?mod=product&state=1" <?php if($_g_state==1):?>class="sel"<?php endif;?>>出售中商品</a>
				| <a href="admin.php?mod=product&state=2" <?php if($_g_state==2):?>class="sel"<?php endif;?>>下架的商品</a>
			</div>
			<div class="fr searbox">
				<form method="get">
					<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
					<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
					商品名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext" />
					<select name="category_id" class="inputselect">
					<option value="" href="<?php echo pe_updateurl('category_id', '') ?>">全部分类</option>
					<?php foreach($category_treelist as $v):?>
					<option value="<?php echo $v['category_id'] ?>" href="<?php echo pe_updateurl('category_id', $v['category_id']) ?>" <?php if($_g_category_id==$v['category_id']):?>selected="selected"<?php endif;?>><?php echo $v['category_showname'] ?></option>
					<?php endforeach;?>
					</select>
					<select name="filter" class="inputselect">
					<option value="" href="<?php echo pe_updateurl('filter', '') ?>">全部商品</option>
					<?php foreach($filter_arr as $k=>$v):?>
					<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('filter', $k) ?>" <?php if($_g_filter==$k):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
					<?php endforeach;?>
					</select>
					<select name="orderby" class="inputselect">
					<option value="" href="<?php echo pe_updateurl('orderby', '') ?>">默认排序</option>
					<?php foreach($orderby_arr as $k=>$v):?>
					<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('orderby', $k) ?>" <?php if($_g_orderby==$k):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
					<?php endforeach;?>
					</select>
					<input type="submit" value="搜索" class="input2" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<form method="post" id="form">
		<table border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'product_id')" /></td>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt" width="">商品名称</td>
			<td class="bgtt" width="100">商品分类</td>
			<td class="bgtt" width="100">单价(元)</td>
			<td class="bgtt" width="50">库存</td>
			<td class="bgtt" width="50">浏览</td>
			<td class="bgtt" width="115">数据营销</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="product_id[]" value="<?php echo $v['product_id'] ?>" /></td>
			<td><?php echo $v['product_id'] ?></td>
			<td class="aleft">
				<span class="fl mar5" style="border:1px solid #f2f2f2"><img src="<?php echo pe_thumb($v['product_logo'], 60, 60) ?>" width="45" height="45"></span>
				<a class="cblue" href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank"><?php echo $v['product_name'] ?></a><?php if($v['product_istuijian']):?><span class="cred">[荐]</span><?php endif;?>
			</td>
			<td class="font13"><?php echo $cache_category[$v['category_id']]['category_name'] ?></td>
			<td><span class="num font16 cred strong"><?php echo $v['product_money'] ?></span></td>
			<td><span <?php if(!$v['product_num']):?>class="font14 corg num strong"<?php endif;?>><?php echo $v['product_num'] ?></span></td>
			<td><?php echo $v['product_clicknum'] ?></td>
			<td style="padding:0">
				<a href="admin.php?mod=product&act=ask&id=<?php echo $v['product_id'] ?>" class="fabu_btnbig fl mar5" onclick="return pe_dialog(this, '增加咨询')">咨询<br/><strong><?php echo $v['product_asknum'] ?></strong></a>
				<a href="admin.php?mod=product&act=comment&id=<?php echo $v['product_id'] ?>" class="fabu_btnbig fl mar5" onclick="return pe_dialog(this, '增加评价')">评价<br/><strong><?php echo $v['product_commentnum'] ?></strong></a>
				<a href="admin.php?mod=product&act=sell&id=<?php echo $v['product_id'] ?>&<?php echo pe_fromto() ?>" class="fabu_btnbig fl" onclick="return pe_dialog(this, '设置销量')">销量<br/><strong><?php echo $v['product_sellnum'] ?></strong></a>
			</td>
			<td>
				<a href="admin.php?mod=product&act=edit&id=<?php echo $v['product_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=product&act=del&id=<?php echo $v['product_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'product_id')" /></td>
			<td class="bgtt" colspan="9">
				<span class="fl mat3">
					<button href="admin.php?mod=product&act=del" onclick="return pe_cfall(this, 'product_id', 'form', '批量删除')">批量删除</button>
					<button href="admin.php?mod=product&act=state&state=1" onclick="return pe_cfall(this, 'product_id', 'form', '批量上架')">批量上架</button>
					<button href="admin.php?mod=product&act=state&state=2" onclick="return pe_cfall(this, 'product_id', 'form', '批量下架')">批量下架</button>
					<button href="admin.php?mod=product&act=tuijian&tuijian=1" onclick="return pe_cfall(this, 'product_id', 'form', '批量推荐')">批量推荐</button>
					<button href="admin.php?mod=product&act=tuijian&tuijian=0" onclick="return pe_cfall(this, 'product_id', 'form', '取消推荐')">取消推荐</button>
					<input type="button" onclick="product_move()" value="批量转移商品" />
				</span>
				<span class="fenye"><?php echo $db->page->html ?></span>
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=chrome"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
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
	art.dialog.open("<?php echo $pe['host_root'] ?>admin.php?mod=product&act=move&id="+product_id, {title:'批量转移商品'});
}
$(function(){
	$("select").change(function(){
		window.location.href = 'admin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>