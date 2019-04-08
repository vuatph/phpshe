<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<div class="fl qiehuan">
				<a href="admin.php?mod=ask" <?php if(!$_g_state):?>class="sel"<?php endif;?>>待回复咨询</a>
				| <a href="admin.php?mod=ask&state=1" <?php if($_g_state==='1'):?>class="sel"<?php endif;?>>已回复咨询</a>
			</div>
			<div class="fr searbox">
				<form method="get">
					<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
					<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
					商品名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext inputtext_150" />
					咨询详情：<input type="text" name="text" value="<?php echo $_g_text ?>" class="inputtext inputtext_150" />
					用户名：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext inputtext_100" />
					<input type="submit" value="搜索" class="input2" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'ask_id')" /></td>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt">咨询详情</td>
			<td class="bgtt" width="150">用户名</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="ask_id[]" value="<?php echo $v['ask_id'] ?>" /></td>
			<td><?php echo $v['ask_id'] ?></td>
			<td class="aleft">
				<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="fl mat3" style="border:1px solid #f2f2f2"><img src="<?php echo pe_thumb($v['product_logo'], 45, 45) ?>" width="45" height="45"></a>
				<div class="fl" style="width:530px;margin-left:15px; display:inline;">
					<p><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="cblue font13"><?php echo $v['product_name'] ?></a></p>
					<p class="c333 mat5 font13">[<?php echo pe_date($v['ask_atime'],'Y-m-d') ?>]咨询：<?php echo $v['ask_text'] ?></p>
					<?php if($v['ask_replytext']):?><p class="cred mat5 font13">[<?php echo pe_date($v['ask_replytime'],'Y-m-d') ?>]回复：<?php echo $v['ask_replytext'] ?></p><?php endif;?>
				</div>
			</td>
			<td><a href="http://www.ip138.com/ips.asp?ip=<?php echo $v['user_ip'] ?>" target="_blank"><?php echo $v['user_name'] ?></a></td>
			<td>
				<a href="admin.php?mod=ask&act=edit&id=<?php echo $v['ask_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar5">回复</a>
				<a href="admin.php?mod=ask&act=del&id=<?php echo $v['ask_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt" align="center"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'ask_id')" /></td>
			<td class="bgtt" colspan="4">
				<span class="fl"><button href="admin.php?mod=ask&act=del" onclick="return pe_cfall(this, 'ask_id', 'form', '批量删除')">批量删除</button></span>
				<span class="fenye"><?php echo $db->page->html ?></span>
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>