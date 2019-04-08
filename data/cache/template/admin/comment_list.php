<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<div class="fr searbox">
				<form method="get">
					<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
					商品名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext inputtext_150" />
					评价详情：<input type="text" name="text" value="<?php echo $_g_text ?>" class="inputtext inputtext_150" />
					<select name="class_id" class="inputselect">
					<option value="" href="<?php echo pe_updateurl('star', '') ?>">☆ 星级 ☆</option>
					<?php foreach(array(3=>'√ 好评 √', 2=>'＝ 中评 ＝', 1=>'× 差评 ×') as $k=>$v):?>
					<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('star', $k) ?>" <?php if($_g_star==$k):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
					<?php endforeach;?>
					</select>
					用户名：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext inputtext_100" />
					<input type="submit" value="搜索" class="input2" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'comment_id')" /></td>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt">评价详情</td>
			<td class="bgtt" width="100">评价星级</td>
			<td class="bgtt" width="150">用户名</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="comment_id[]" value="<?php echo $v['comment_id'] ?>" /></td>
			<td><?php echo $v['comment_id'] ?></td>
			<td class="aleft">
				<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="fl mat3" style="border:1px solid #f2f2f2"><img src="<?php echo pe_thumb($v['product_logo'], 45, 45) ?>" width="45" height="45"></a>
				<div class="fl" style="width:440px;margin-left:15px; display:inline;">
					<p><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="cblue font14"><?php echo $v['product_name'] ?></a></p>
					<p class="mat5 corg font13"><?php if($v['comment_text']):?>[<?php echo pe_date($v['comment_atime'],'Y-m-d') ?>]评价<?php endif;?>：<?php echo $v['comment_text'] ?></p>
				</div>
			</td>
			<td><?php echo comment_star($v['comment_star']) ?></td>
			<td><a href="http://www.ip138.com/ips.asp?ip=<?php echo $v['user_ip'] ?>" target="_blank"><?php echo $v['user_name'] ?></a></td>
			<td>
				<a href="admin.php?mod=comment&act=edit&id=<?php echo $v['comment_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=comment&act=del&id=<?php echo $v['comment_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt" align="center"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'comment_id')" /></td>
			<td class="bgtt" colspan="5">
				<span class="fl"><button href="admin.php?mod=comment&act=del" onclick="return pe_cfall(this, 'comment_id', 'form', '批量删除')">批量删除</button></span>
				<span class="fenye"><?php echo $db->page->html ?></span>
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("select").change(function(){
		window.location.href = 'admin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>