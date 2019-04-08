<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<a href="admin.php?mod=ad" <?php if(!$_g_position):?>class="sel"<?php endif;?>>广告列表（<?php echo $tongji['all'] ?>）</a>
		<?php foreach($ini['ad_position'] as $k=>$v):?>
		<a href="admin.php?mod=ad&position=<?php echo $k ?>" <?php if($_g_position==$k):?>class="sel"<?php endif;?>><?php echo $v['name'] ?>（<?php echo $tongji[$k] ?>）</a>
		<?php endforeach;?>
		<a href="admin.php?mod=ad&act=add" id="fabu">添加广告</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'ad_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="40">排序</th>
			<th class="bgtt" width="230">广告图片</th>
			<th class="bgtt" width="200">广告位置</th>
			<th class="bgtt">广告链接</th>
			<th class="bgtt" width="60">显示</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr height="60">
			<td><input type="checkbox" name="ad_id[]" value="<?php echo $v['ad_id'] ?>" /></td>
			<td><?php echo $v['ad_id'] ?></td>
			<td><input type="text" name="ad_order[<?php echo $v['ad_id'] ?>]" value="<?php echo $v['ad_order'] ?>" class="inputtext input30 center" /></td>
			<td><a href="<?php echo $v['ad_url'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['ad_logo']) ?>" style="width:160px; height:55px; border:1px solid #F2F2F2" /></a></td>
			<td><?php echo $ini['ad_position'][$v['ad_position']]['name'] ?><p><?php echo $cache_category[$v['category_id']]['category_name'] ?></p></td>
			<td class="aleft"><a href="<?php echo $v['ad_url'] ?>" target="_blank"><?php echo $v['ad_url'] ?></a></td>
			<td>
				<?php if($v['ad_state']==1):?>
				<a href="admin.php?mod=ad&act=state&state=0&id=<?php echo $v['ad_id'] ?>&token=<?php echo $pe_token ?>"><img src="<?php echo $pe['host_tpl'] ?>images/dui.png" /></a>
				<?php else:?>
				<a href="admin.php?mod=ad&act=state&state=1&id=<?php echo $v['ad_id'] ?>&token=<?php echo $pe_token ?>"><img src="<?php echo $pe['host_tpl'] ?>images/cuo.png" /></a>
				<?php endif;?>
			</td>
			<td>
				<a href="admin.php?mod=ad&act=edit&id=<?php echo $v['ad_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar3">修改</a>
				<a href="admin.php?mod=ad&act=del&id=<?php echo $v['ad_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'ad_id')" />
			<button href="admin.php?mod=ad&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'ad_id', 'form', '批量删除')">批量删除</button>
			<button href="admin.php?mod=ad&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">更新排序</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>