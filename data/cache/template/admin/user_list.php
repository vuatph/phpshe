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
					用户名：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext inputtext_150" />
					联系电话：<input type="text" name="phone" value="<?php echo $_g_phone ?>" class="inputtext inputtext_150" />
					常用邮箱：<input type="text" name="email" value="<?php echo $_g_email ?>" class="inputtext inputtext_150" />
					<select name="orderby" class="inputselect">
					<option value="" href="<?php echo pe_updateurl('orderby', '') ?>">默认排序</option>
					<?php foreach(array('ltime'=>'最近登录') as $k=>$v):?>
					<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('orderby', $k) ?>" <?php if($_g_orderby==$k):?>selected="selected"<?php endif;?>><?php echo $v ?></option>
					<?php endforeach;?>
					</select>
					<input type="submit" value="搜索" class="input2" />
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<td class="bgtt" width="10"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'user_id')" /></td>
			<td class="bgtt" width="60">ID号</td>
			<td class="bgtt">用户名</td>
			<td class="bgtt" width="150">联系电话</td>
			<td class="bgtt" width="200">常用邮箱</td>
			<td class="bgtt" width="120">注册日期</td>
			<td class="bgtt" width="120">上次登录</td>
			<td class="bgtt" width="90">操作</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="user_id[]" value="<?php echo $v['user_id'] ?>"></td>
			<td><?php echo $v['user_id'] ?></td>
			<td><?php echo $v['user_name'] ?></td>
			<td><?php echo $v['user_phone'] ?></td>
			<td><?php echo $v['user_email'] ?></td>
			<td><span <?php if(pe_date($v['user_atime'], 'Y-m-d') == date('Y-m-d')):?>class="cred"<?php endif;?>><?php echo pe_date($v['user_atime'], 'Y-m-d') ?></span></td>
			<td><span <?php if(pe_date($v['user_ltime'], 'Y-m-d') == date('Y-m-d')):?>class="cred"<?php endif;?>><?php echo pe_dayago($v['user_ltime']) ?></span></td>
			<td>
				<a href="admin.php?mod=user&act=edit&id=<?php echo $v['user_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar5">修改</a>
				<a href="admin.php?mod=user&act=del&id=<?php echo $v['user_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td class="bgtt"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'user_id')" /></td>
			<td class="bgtt aleft" colspan="7">
				<span class="fl"><button href="admin.php?mod=user&act=del" onclick="return pe_cfall(this, 'user_id', 'form', '批量删除')">批量删除</button></span>
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