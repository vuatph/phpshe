<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<a href="admin.php?mod=db" class="sel">数据库备份</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td align="right" width="100">是否分卷：</td>
			<td>
				<label><input type="radio" name="backup_cut" value="0" checked="checked" /> 不分卷</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="backup_cut" value="1" /> 分卷
				<input type="text" name="backup_cutsize" class="inputtext input50" /> KB/卷
				<input type="hidden" name="act" value="backup" />
				<input type="hidden" name="backup_where" value="server" />
				<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
				<input type="submit" name="pesubmit" value="备 份" class="tjbtn mal10" />
			</td>
		</tr>
		<!--<tr>
			<td align="right" width="150">是否分卷：</td>
			<td>
				<label><input type="radio" name="backup_cut" value="0" checked="checked" /> 不分卷</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label><input type="radio" name="backup_cut" value="1" /> 分卷备份
				<input type="text" name="backup_cutsize" class="inputtext input50" /> KB/卷</label>
			</td>
		</tr>
		<tr>
			<td align="right">备份位置：</td>
			<td>
				<label><input type="radio" name="backup_where" value="server" checked="checked" /> 服务器</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label><input type="radio" name="backup_where" value="down" /> 本地下载</label>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="pebackup" value="备 份" class="tjbtn"></td>
		</tr>-->
		</table>
		</form>
	</div>
	<div class="right_main mat15" style="border-top:1px solid #eee">
		<div class="now2">
			<p>数据库恢复</p>
		</div>
		<form method="post" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="180">备份日期</th>
			<th class="bgtt"></th>
			<th class="bgtt" width="300" class="num">存储路径</th>
			<th class="bgtt" width="150" class="num" >文件大小</th>
			<th class="bgtt" width="100">操作</th>
		</tr>
		<?php foreach($backup_list as $v):?>
		<?php $db_name = str_ireplace('@', '', $v)?>
		<tr>
			<td class="num"><?php echo pe_date(strtotime($db_name), 'Y年m月d日 H时i分') ?></td>
			<td></td>
			<td class="num">data/dbbackup/<?php echo $v ?>/</td>
			<td class="num"><?php echo round(pe_dirsize($pe['path_root'].'data/dbbackup/'.$v)/1024/1024, 2) ?> MB</td>
			<td>
				<a href="admin.php?mod=db&act=import&dbname=<?php echo $v ?>&token=<?php echo $pe_token ?>" class="admin_edit mar3" onclick="return pe_cfone(this, '导入<?php echo pe_date(strtotime($db_name), 'Y年m月d日 H时i分') ?>备份的数据')">恢复</a>
				<a href="admin.php?mod=db&act=del&dbname=<?php echo $v ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(":input[name='backup_cutsize']").click(function(){
		$(":input[name='backup_cut']").eq(1).attr("checked", "checked");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>