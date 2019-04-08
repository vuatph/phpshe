<?php include(pe_tpl('header.html'));?>
<div class="right fr">
	<div class="now">
		<div class="fl now1"></div>
		<div class="fl now2">
			<span class="fl">商品列表</span>
			<span class="fr fabu mat8"><a href="admin.php?mod=product&act=add">发布商品</a></span>
		</div>
		<div class="fl now3"></div>
		<div class="clear"></div>
	</div>
	<div class="spqh mat8">
		<div class="fl qiehuan">
			<a href="admin.php?mod=product&act=list" <?php if(!$_g_state):?>class="sel"<?php endif;?>>全部商品</a>
			| <a href="admin.php?mod=product&act=list&state=1" <?php if($_g_state==1):?>class="sel"<?php endif;?>>上架中商品</a>
			| <a href="admin.php?mod=product&act=list&state=2" <?php if($_g_state==2):?>class="sel"<?php endif;?>>下架的商品</a>
		</div>
		<div class="fr searbox mat3">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="act" value="<?php echo $_g_act ?>" />
				<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
				<input type="text" name="keyword" value="<?php echo $_g_keyword ?>" class="inputtext inputtext_200 fl" />
				<select name="category_id" class="inputselect fl mal5 mar5">
					<option value="">所有分类</option>
					<?php foreach($category_treelist as $v):?>
					<option value="<?php echo $v['category_id'] ?>" <?php if($v['category_id']==$_g_category_id):?>selected="selected"<?php endif;?>><?php echo $v['category_showname'] ?></option>
					<?php endforeach;?>
				</select>
				<input type="submit" value="搜索" class="input2" />
			</form>
		</div>
		<div class="clear"></div>
	</div>
	<form method="post" id="form">
	<table border="0" cellspacing="0" cellpadding="0" class="list mat5">
	<tr>
		<td class="bgtt" align="center" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'product_id')" /></td>
		<td class="bgtt" align="center" width="40">ID号</td>
		<td class="bgtt" align="center">商品名称</td>
		<td class="bgtt" align="center" width="100">商品分类</td>
		<td class="bgtt" align="center" width="50">价格(元)</td>
		<td class="bgtt" align="center" width="60">发布时间</td>
		<td class="bgtt" align="center" width="70">操作</td>
	</tr>
	<?php foreach($info_list as $v):?>
	<tr>
		<td align="center"><input type="checkbox" name="product_id[]" value="<?php echo $v['product_id'] ?>"></td>
		<td align="center"><?php echo $v['product_id'] ?></td>
		<td><?php if($v['product_logo']):?><span class="cred">[图]</span><?php endif;?><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank"><?php echo $v['product_name'] ?></a></td>
		<td align="center"><?php echo $cache_category[$v['category_id']]['category_name'] ?></td>
		<td align="center"><?php echo $v['product_smoney'] ?></td>
		<td align="center"><?php echo pe_date($v['product_atime'], 'Y-m-d') ?></td>
		<td align="center">
			<a href="admin.php?mod=product&act=edit&id=<?php echo $v['product_id'] ?>" class="admin_edit">修改</a>
			<a href="admin.php?mod=product&act=delsql&id=<?php echo $v['product_id'] ?>" class="admin_del" onclick="return pe_cfone('删除')">删除</a>
		</td>
	</tr>
	<?php endforeach;?>
	<tr>
		<td class="bgtt"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'product_id')" /></td>
		<td class="bgtt" colspan="6">
			<span class="fl">
				<button href="admin.php?mod=product&act=delsql" onclick="return pe_cfall(this, 'product_id', 'form', '批量删除')">批量删除</button>
				<button href="admin.php?mod=product&act=statesql&state=1" onclick="return pe_cfall(this, 'product_id', 'form', '批量上架')">批量上架</button>
				<button href="admin.php?mod=product&act=statesql&state=2" onclick="return pe_cfall(this, 'product_id', 'form', '批量下架')">批量下架</button>
			</span>
			<span class="fenye"><?php echo $db->page->html ?></span>
		</td>
	</tr>
	</table>
	</form>
</div>
<?php include(pe_tpl('footer.html'));?>