<?php include(pe_tpl('header.html'));?>
<div class="right">
	<div class="now">
		<span class="fl c888">管理中心 > <?php echo $menutitle ?></span>
		<span class="fr fabu"><a href="admin.php?mod=product&act=add">发布商品</a></span>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
		<tr>
			<td width="110" class="bg_f8" align="right">商品名称：</td>
			<td colspan="3"><input type="text" name="info[product_name]" value="<?php echo $info['product_name'] ?>" class="inputall input600" maxlength="36" /></td>
			<td rowspan="6" valign="top" width="80">
				<img src="<?php echo pe_thumb($info['product_logo']) ?>" width="160" height="170" style="border:1px solid #f4f4f4; display:block;" />
				<p class="mat5"><input type="file" name="product_logo" size="12" style="width:160px;" /></p>
			</td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">商品分类：</td>
			<td colspan="3">
				<select name="info[category_id]" class="inputselect">
				<?php foreach($category_treelist as $v):?>
				<option value="<?php echo $v['category_id'] ?>" <?php if($v['category_id']==$info['category_id']):?>selected="selected"<?php endif;?>><?php echo $v['category_showname'] ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">本店价格：</td>
			<td width="275"><input type="text" name="info[product_money]" value="<?php echo $info['product_money'] ?>" class="inputall input100" /> <span class="c888">元</span></td>
			<td width="110" class="bg_f8" align="right">运　　费：</td>
			<td><input type="text" name="info[product_wlmoney]" value="<?php echo $info['product_wlmoney'] ?>" class="inputall input100" /> <span class="c888">元（注：0元为卖家包邮）</span></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">市场售价：</td>
			<td colspan="3"><input type="text" name="info[product_smoney]" value="<?php echo $info['product_smoney'] ?>" class="inputall input100" /> <span class="c888">元</span></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">库存总量：</td>
			<td><input type="text" name="info[product_num]" value="<?php echo $info['product_num'] ?>" class="inputall input100" /></td>
			<td class="bg_f8" align="right">商品货号：</td>
			<td><input type="text" name="info[product_mark]" value="<?php echo $info['product_mark'] ?>" class="inputall input100" /></td>
		</tr>
		<tr>
			<td class="bg_f8" align="right">发布日期：</td>
			<td colspan="3"><input type="text" name="info[product_atime]" value="<?php echo pe_date($info['product_atime'] ? $info['product_atime'] : time()) ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" class="Wdate" /></td>
		</tr>
		</table>
		<div class="mat5"><textarea name="info[product_text]" id="editortext" style="width:99.8%;height:500px"><?php echo htmlspecialchars($info['product_text']) ?></textarea></div>
		<div class="mat10 center">
			<input type="hidden" name="pesubmit" />
			<input type="button" value="提 交" class="tjbtn" />
		</div>
		</form>
	</div>
</div>
<style type="text/css">
a.js_add{display:block; float:left; width:120px; height:30px; line-height:30px; text-align:center;background:#5CB85C; color:#f5f5f5; border-radius:2px; font-family:'宋体'; font-size:14px; font-weight:bold}
a:hover.js_add,a:hover.js_del{background-color:#cccc00;}
a.js_del{width:42px; padding:5px 10px; text-align:center;background:#FF6600; color:#f5f5f5; border-radius:3px; font-family:'宋体'; font-size:12px;}
</style>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/plugin/my97/WdatePicker.js"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/editor/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" charset="utf-8">
var editor;
KindEditor.ready(function(K) {
	editor = K.create('#editortext', {
		allowFlashUpload :false,
		afterBlur: function(){
			this.sync();
		}
	});
});
$("label").click(function(){
	if ($(this).find(":input").is(":checked")) {
		$(this).css("background","#faf18f");
	}
	else {
		$(this).css("background","#fff")
	}
	prorule_html_show();
})
$(":checkbox").each(function(){
	if ($(this).is(":checked")) {
		$(this).parent("label").css("background","#faf18f");
	}
})
function prorule_html_show() {
	var i = 0;
	$(".rule_id").each(function(){
		var rule_id = $(this).attr("rule_id");
		if ($(this).find(":input").is(":checked")) {
			i++;
			$("#"+rule_id).show().find("input").removeAttr("disabled");
			$(":input[name='"+rule_id+"[]']").parent("td").show().find("input").removeAttr("disabled");
		}
		else {
			$("#"+rule_id).hide().find("input").attr("disabled", "disabled");
			$(":input[name='"+rule_id+"[]']").parent("td").hide().find("input").attr("disabled", "disabled");
		}
	})
	if (i > 0) {
		$(".table_td").show();
	}
	else {
		$(".table_td").hide();
	}
}
$(".js_add").click(function(){
	//alert($(this).parents("tr").html());
	var tr_clone = $("#prorule_html tr:last").clone(false);
	tr_clone.show();
	$("#prorule_html").append(tr_clone);
})
$(".js_del").live("click", function(){
	$(this).parent().parent("tr").remove();
})
$(function(){
	prorule_html_show();
	$(":button").click(function(){
		var kong_num = rule_num = 0;
		if ($(":input[name='rule_idarr[]']:checked").length > 0) {
			$("#prorule_html").find(":input").each(function(){
				if ($(this).attr("disabled") == "disabled" || $(this).is(":hidden")) return true;
				if ($(this).val() == '') {
					kong_num++;
				}
				else {
					rule_num++;
				}
			})
			if (rule_num == 0) {
				alert('您勾选的规格名称，但未增加规格属性...');
				return;
			}
			if (kong_num > 0) {
				alert('规格属性尚未填写完全');
				return;
			}
		}
		$("form").submit();
	})
})
function move_left(obj) {
    var current = $(obj).parent();
    var prev = current.prevAll(":visible").first();
	var current_other = $(":input[name='"+current.attr("id")+"[]']").parent();
   	var prev_other;
	if (current.index()>0) {
		current.insertBefore(prev);
		current_other.each(function(){
			prev_other = $(this).prevAll(":visible").first();
			$(this).insertBefore(prev_other);
		})
	}
}  
function move_right(obj) {
    var current = $(obj).parent();
    var next = current.nextAll(":visible").first();
	var current_other = $(":input[name='"+current.attr("id")+"[]']").parent();
    var prev_other;
	var num = $(obj).parent().parent().find("td").length;
    if (current.index()<num-4) {
		current.insertAfter(next);
		current_other.each(function(){
			prev_other = $(this).nextAll(":visible").first();
			$(this).insertAfter(prev_other);
		})
	}
}
</script>
<?php include(pe_tpl('footer.html'));?>