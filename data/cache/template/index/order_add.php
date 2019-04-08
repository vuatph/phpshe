<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="liucheng">我的购物车</div>
	<div class="mat10">
		<div class="gouwuche">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gwc_tb">
			<tr>
				<th width="100">商品图片</th>
				<th>商品名称</th>
				<th width="160">商品单价(元)</th>
				<th width="110">购买数量</th>
				<th width="100">操作</th>
			</tr>
			<?php foreach($info_list as $k=>$v):?>
			<tr id="<?php echo $k ?>" class="product_id">
				<td class="hotimg"><img src="<?php echo pe_thumb($v['product_logo'], 60, 60) ?>" /></td>
				<td style="text-align:left">
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank" class="cblue font14"><?php echo $v['product_name'] ?></a>
					<?php if($v['prorule_name']):?>
					<p class="c666"><?php foreach(unserialize($v['prorule_name']) as $vv):?>[<?php echo $vv['name'] ?>：<?php echo $vv['value'] ?>]&nbsp;&nbsp;<?php endforeach;?></p>
					<?php endif;?>
				</td>
				<td class="strong num font14"><?php echo $v['product_money'] ?></td>
				<td class="shuliang" style="padding-left:10px;">
					<span class="img1" onclick="pe_numchange('product_num[<?php echo $k ?>]', '-', 1);cart_num('<?php echo $k ?>', 'product_num[<?php echo $k ?>]')">-</span>
					<div class="shuliang_box"><input type="text" name="product_num[<?php echo $k ?>]" value="<?php echo $v['product_num'] ?>" readonly /></div>
					<span class="img2" onclick="pe_numchange('product_num[<?php echo $k ?>]', '+', <?php echo $v['product_maxnum'] ?>);cart_num('<?php echo $k ?>', 'product_num[<?php echo $k ?>]')">+</span>
				</td>
				<td><a href="javascript:cart_del('<?php echo $k ?>');">删除</a></td>
			</tr>
			<?php endforeach;?>
			</table>
		</div>
		<div class="fukuan font13">
			<strong>应付总额：</strong><span class="strong num1 font16 cred" id="order_money"><?php echo $money['order_money'] ?></span>(元)
			＝ <span class="strong num1 font14 cred" id="order_productmoney"><?php echo $money['order_productmoney'] ?></span>(商品总额)
			＋ <span class="strong num1 font14 cred" id="order_wlmoney"><?php echo $money['order_wlmoney'] ?></span>(运费)
		</div>
		<form method="post" id="form">
		<div style="border:1px #ddd solid; padding:10px 20px; margin-top:10px;">
			<h3 class="shxx_tt">付款方式</h3>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shxx mat10">
			<?php foreach($cache_payway as $k=>$v):?>
			<?php if(!$v['payway_state'])continue?>
			<?php $ii++;?>
			<tr>
				<td width="60" align="right"><input type="radio" name="order_payway" id="<?php echo $k ?>" value="<?php echo $k ?>" <?php if($ii==1):?>checked="checked"<?php endif;?> /></td>
				<td width="190"><label for="<?php echo $k ?>">&nbsp;<?php echo $v['payway_name'] ?></label></td>
				<td class="c666"><label for="<?php echo $k ?>"><?php echo $v['payway_text'] ?></label></td>
			</tr>
			<?php endforeach;?>
			</table>
			<h3 class="shxx_tt mat10">收货信息</h3>
			<div class="shxx mat10">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="120" style="text-align:right;"><span class="cred1">*</span> 配送区域：</td>
					<td style="text-align:left;">
						<select name="province" id="province" class="inputselect"></select>
						<select name="city" id="city" class="inputselect"></select>
						<span id="province_show"></span> <span id="city_show"></span>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><span class="cred1">*</span> 收货地址： </td>
					<td style="text-align:left;"><input type="text" name="user_address" value="<?php echo $info['user_address'] ?>" class="inputall input400"> <span id="user_address_show"></span></td>
				</tr>
				<tr>
					<td style="text-align:right;"><span class="cred1">*</span> 收货姓名： </td>
					<td style="text-align:left;"><input type="text" name="user_tname" value="<?php echo $info['user_tname'] ?>" class="inputall input150"> <span id="user_tname_show"></span></td>
				</tr>
				<tr>
					<td style="text-align:right;"><span class="cred1">*</span> 联系电话： </td>
					<td style="text-align:left;"><input type="text" name="user_phone" value="<?php echo $info['user_phone'] ?>" class="inputall input150"> <span id="user_phone_show"></span></td>
				</tr>
				<tr>
					<td style="text-align:right;">用户留言： </td>
					<td style="text-align:left;"><textarea class="inputtext" name="order_text" style="width:400px;height:80px"></textarea></td>
				</tr>
				<tr>
					<td style="text-align:right;"></td>
					<td style="text-align:left;"><input type="hidden" name="pesubmit" />
				<input type="button" class="btn_05" value="提交订单" style="margin:0"></td>
				</tr>
				</table>
			</div>
		</div>
		</form>
	</div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/formcheck.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/shengshi.js"></script>
<script type="text/javascript">
$(function(){
	$("input[name='order_payway']").click(function(){
		$(this).parents("table").find("tr").removeClass('sel');
		$(this).parents("tr").addClass('sel');
	})
	$("input[name='order_payway']").each(function(){
		if ($(this).is(":checked")) $(this).parents("tr").addClass('sel');
	})
})
function cart_num(product_id,name) {
	$.getJSON("<?php echo $pe['host_root'] ?>index.php", {"mod":"order","act":"cartnum","product_id":product_id,"product_num":$(":input[name='"+name+"']").val()}, function(json){
		if (json.result) {
			$("#order_productmoney").html(json.money.order_productmoney);
			$("#order_wlmoney").html(json.money.order_wlmoney);
			$("#order_money").html(json.money.order_money);
		}
	})
}
function cart_del(product_id) {
	if (confirm('您确认要删除该商品吗?') == false) {
		return;
	}
	$.getJSON("<?php echo $pe['host_root'] ?>index.php", {"mod":"order","act":"cartnum","product_id":product_id,"product_num":0}, function(json){
		if (json.result) {
			$("#"+product_id).remove();
			$("#order_productmoney").html(json.money.order_productmoney);
			$("#order_wlmoney").html(json.money.order_wlmoney);
			$("#order_money").html(json.money.order_money);
		}
	})
}
function order_add() {
	if (<?php echo count($info_list) ?>) {
		window.location.href="index.php?mod=order&act=add";
	}
	else {
		alert('您的购物车里还没有商品哦！');
	}
}
shengshi_init({"pval":"河南省","cval":"郑州市"});
var form_info = [
	{"name":"province", "mod":"str", "act":"change", "arg":"", "show_id":"province_show","show_error":"省份必须选择"},
	{"name":"city", "mod":"str", "act":"change", "arg":"", "show_id":"city_show","show_error":"城市必须选择"},
	{"name":"user_address", "mod":"str", "act":"blur", "arg":"", "show_id":"user_address_show","show_error":"地址必须填写"},
	{"name":"user_tname", "mod":"match", "act":"blur", "arg":"zh", "show_id":"user_tname_show","show_error":"姓名必须为汉字"},
	{"name":"user_phone", "mod":"match", "act":"blur", "arg":"phone", "show_id":"user_phone_show","show_error":"电话格式错误"}
]
$(":button").pe_submit(form_info, 'form');
</script>
<?php include(pe_tpl('footer.html'));?>