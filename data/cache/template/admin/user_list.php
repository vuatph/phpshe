<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<a href="admin.php?mod=user" <?php if(!$_g_userlevel_id):?>class="sel"<?php endif;?>>会员列表（<?php echo $tongji['all'] ?>）</a>
		<?php foreach($cache_userlevel as $k=>$v):?>
		<a href="admin.php?mod=user&userlevel_id=<?php echo $k ?>" <?php if($_g_userlevel_id==$k):?>class="sel"<?php endif;?>><?php echo $v['userlevel_name'] ?>（<?php echo $tongji[$k] ?>）</a>		
		<?php endforeach;?>
		<a href="admin.php?mod=userbank" <?php if($mod=='userbank'):?>class="sel"<?php endif;?> style="display:none">收款账户（<?php echo $tongji['userbank'] ?>）</a>
		<a href="admin.php?mod=useraddr" <?php if($mod=='useraddr'):?>class="sel"<?php endif;?> style="display:none">收货地址（<?php echo $tongji['userbank'] ?>）</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
			<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
			<input type="hidden" name="userlevel_id" value="<?php echo $_g_userlevel_id ?>" />
			用户名：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext input100 mar5"/>
			联系电话：<input type="text" name="phone" value="<?php echo $_g_phone ?>" class="inputtext input100 mar5" />
			常用邮箱：<input type="text" name="email" value="<?php echo $_g_email ?>" class="inputtext input150" />
			<select name="orderby" class="selectmini">
			<option value="" href="<?php echo pe_updateurl('orderby', '') ?>">= 默认排序 =</option>
			<?php $selnum=1;?>
			<?php foreach(array('ltime|desc'=>'最近登录', 'point|desc'=>'最多积分', 'ordernum|desc'=>'最多订单') as $k=>$v):?>
			<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('orderby', $k) ?>" <?php if($_g_orderby==$k):?>selected="selected"<?php endif;?>><?php echo $selnum++ ?>)<?php echo $v ?></option>
			<?php endforeach;?>
			</select>
			<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'user_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt">用户名</th>
			<th class="bgtt" width="100">等级</td>
			<th class="bgtt" width="60">余额</td>
			<th class="bgtt" width="60">积分</th>
			<th class="bgtt" width="60">订单数</td>
			<th class="bgtt" width="80">联系电话</th>
			<!--<th class="bgtt" width="160">常用邮箱</th>-->
			<th class="bgtt" width="130">推荐人</th>
			<th class="bgtt" width="70">注册日期</th>
			<th class="bgtt" width="195">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="user_id[]" value="<?php echo $v['user_id'] ?>"></td>
			<td class="num"><?php echo $v['user_id'] ?></td>
			<td><?php echo $v['user_name'] ?></td>
			<td><?php echo $cache_userlevel[$v['userlevel_id']]['userlevel_name'] ?></td>
			<td><span class="num corg"><?php echo $v['user_money'] ?></span></td>
			<td class="num"><?php echo $v['user_point'] ?></td>
			<td class="num"><a href="admin.php?mod=order&user_id=<?php echo $v['user_id'] ?>" class="cblue" target="_blank"><?php echo $v['user_ordernum'] ?></a></td>
			<td class="num"><?php echo $v['user_phone'] ?></td>
			<!--<td class="num"><?php echo $v['user_email'] ?></td>-->
			<td><?php echo $v['tguser_id']?$v['tguser_name']:'-' ?></td>
			<td class="num"><span <?php if(pe_date($v['user_atime'], 'Y-m-d') == date('Y-m-d')):?>class="cred"<?php endif;?>><?php echo pe_date($v['user_atime'], 'Y-m-d') ?></span></td>
			<td>
				<a href="admin.php?mod=user&act=edit&id=<?php echo $v['user_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar3">修改</a>
				<a href="admin.php?mod=user&act=del&id=<?php echo $v['user_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del mar3" onclick="return pe_cfone(this, '删除')">删除</a>
				<a href="admin.php?mod=userbank&user_id=<?php echo $v['user_id'] ?>" class="admin_btn mar3" target="_blank">账户</a>
				<a href="admin.php?mod=useraddr&user_id=<?php echo $v['user_id'] ?>" class="admin_btn" target="_blank">地址</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'user_id')" />
			<button href="admin.php?mod=user&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'user_id', 'form', '批量删除')">批量删除</button>
			<!--<input type="button" value="批量发送邮件" id="sendemail" />-->
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	var ips = new Array();
	$(".ipname").each(function(){
		ips.push($(this).attr("ip"));
	})
	$.getJSON("http://www.phpshe.com/index.php?mod=api&act=ipname&ips="+ips.join(",")+"&callback=?", function(json){
		$(".ipname").each(function(index){
			$(this).find("a").html(json.ipname[index]);
		})
	})
	$("#sendemail").click(function(){
		if ($("input[name='user_id[]']:checked").length == 0) {
			alert('请勾选需要发送的用户!');
			return false;
		}
		var user_id = new Array();
		$("input[name='user_id[]']:checked").each(function(){
			user_id.push($(this).val());
		})
		url = 'admin.php?mod=user&act=email&id='+user_id.join(",");
		art.dialog.open(url, {title:'发送邮件', width: 730, height: 470, id: 'sendemail'});
	})
	$("select").change(function(){
		window.location.href = 'admin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>