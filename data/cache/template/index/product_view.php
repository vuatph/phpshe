<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="now"><?php echo $nowpath ?></div>
	<div class="fl proimg"><img src="<?php echo $pe['host_root'] ?>include/image/load.gif" data-original="<?php echo pe_thumb($info['product_logo'], 400, 400) ?>" /></div>
	<div class="fl proinfo">
		<h3><?php echo $info['product_name'] ?></h3>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr style="background:#d83228; background:url(<?php echo $pe['host_tpl'] ?>images/jg_bg.gif) repeat;">
			<td style="color:#fff; height:50px;" valign="top" width="60"><p class="mat5">价 格</p></td>
			<td style="color:#fff; height:50px;">
			<span class="jg_price">¥ <span id="product_money"><?php echo $info['product_money'] ?></span></span>
			<p>市场价 <s class="num">¥ <?php echo $info['product_smoney'] ?></s>　　运费：<?php if($info['product_wlmoney'] == 0):?>卖家包邮<?php else:?><span class="num">¥ <?php echo $info['product_wlmoney'] ?></span><?php endif;?></p>
			</td>
		</tr>
		<tr>
			<td style="color:#666">销 量</td>
			<td>共售出 <span class="cred num strong"><?php echo $info['product_sellnum'] ?></span> 件 <a href="javascript:find_comment();" class="cblue">(已有<?php echo $info['product_commentnum'] ?>人评价)</a></td>
		</tr>
		<tr>
			<td style="color:#666">数 量</td>
			<td class="shuliang">
				<input type="hidden" name="prorule_id" />
				<span class="img1" onclick="pe_numchange('product_num', '-', 1);">-</span>
				<div class="shuliang_box"><input type="text" name="product_num" value="1" readonly /></div>
				<span class="img2" onclick="pe_numchange('product_num', '+', <?php echo $info['product_num'] ?>);">+</span>
				<span class="fl c888 mal5 mat2">　库存<span id="product_num"><?php echo $info['product_num'] ?></span>件</span>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><?php if($info['product_state']==2):?>
			<img src="<?php echo $pe['host_tpl'] ?>images/selldown.gif" class="fl" />
			<?php elseif($info['product_state']==1 && $info['product_num']==0):?>
			<img src="<?php echo $pe['host_tpl'] ?>images/sellout.gif" class="fl" />
			<?php else:?>
			<a href="javascript:;" onclick="return cart_add('<?php echo $info['product_id'] ?>');" class="fl"><img src="<?php echo $pe['host_tpl'] ?>images/buy.gif" /></a>
			<?php endif;?>
			<a href="javascript:collect_add('<?php echo $info['product_id'] ?>');" class="sctj fl">添加到收藏夹</a></td>
		</tr>
		</table>
		<p style="margin:10px 20px; border-top:1px #ddd dotted; padding-top:5px;">上架时间：<?php echo pe_date($info['product_atime']) ?>　　浏览次数：<?php echo $info['product_clicknum'] ?>　　收藏人数：<?php echo $info['product_collectnum'] ?></p>
		<div class="mat5" style="height:25px; overflow:hidden; margin-left:20px;">
			<!-- Baidu Button BEGIN -->
			<div id="bdshare" class="bdshare_b" style="line-height:12px;"><img src="http://bdimg.share.baidu.com/static/images/type-button-1.jpg" />
				<a class="shareCount"></a>
			</div>
			<script type="text/javascript" id="bdshare_js" data="type=button&amp;uid=456179" ></script>
			<script type="text/javascript" id="bdshell_js"></script>
			<script type="text/javascript">
				document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?t=" + new Date().getHours();
			</script>
			<!-- Baidu Button END -->
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="remai fl mat10">
		<h3>商品分类</h3>
		<div class="hotlist spfl">
			<?php foreach((array)$cache_category_arr[0] as $k=>$v):?>
			<div class="zhulei"><a href="<?php echo pe_url('product-list-'.$k) ?>" <?php if($category_id==$k):?>class="sel"<?php endif;?>><?php echo $v['category_name'] ?></a></div>
			<div class="clear"></div>
			<?php if(is_array($cache_category_arr[$v['category_id']])):?>
			<div class="zilei">
				<?php foreach($cache_category_arr[$v['category_id']] as $kk=>$vv):?>
				<a href="<?php echo pe_url('product-list-'.$kk) ?>" <?php if($category_id==$kk):?>class="sel"<?php endif;?>><?php echo $vv['category_name'] ?></a>
				<?php endforeach;?>
				<div class="clear"></div>
			</div>
			<?php endif;?>
			<?php endforeach;?>
		</div>
		<h3 class="mat10">热销排行</h3>
		<ul class="hotlist">
			<?php foreach((array)$product_hotlist as $v):?>
			<li>
				<span class="fl hotimg"><img src="<?php echo $pe['host_root'] ?>include/image/load.gif" data-original="<?php echo pe_thumb($v['product_logo'], 60, 60) ?>" title="<?php echo $v['product_name'] ?>" /></span>
				<span class="fl hotname">
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"><?php echo $v['product_name'] ?></a>
					<span class="cred num strong lh20">¥<?php echo $v['product_money'] ?></span>
				</span>
				<div class="clear"></div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="fr xiangqing">
		<div class="caidan1">
			<ul class="fl" id="js_menu">
				<li class="sel"><a href="javascript:;">商品展示</a></li>
				<li><a href="javascript:;">售前咨询(<?php echo $info['product_asknum'] ?>)</a></li>
				<li><a href="javascript:;">顾客评价(<?php echo $info['product_commentnum'] ?>)</a></li>
				<li><a href="javascript:;">售后服务</a></li>
			</ul>
			<div class="fr c666 mat10 mar10">商品货号：<?php echo $info['product_mark'] ?></div>
		</div>
		<div class="promain js_menuhtml"><?php echo $info['product_text'] ?></div>
		<!--咨询 Start-->
		<div class="promain js_menuhtml" style="display:none">
			<div class="plmain" id="js_askhtml">
				<?php foreach($ask_list as $v):?>
				<ul class="mat5">
					<li class="fl">会员：<?php echo $v['user_name'] ?></li>
					<li class="fr">咨询日期：<?php echo pe_date($v['ask_atime']) ?></li>
				</ul>
				<div class="padb10 mal10 lh18">
					<div class="mat10 font14"><?php echo $v['ask_text'] ?></div>
					<?php if($v['ask_replytext']):?>
					<div class="mat10 huifu">
						<strong class="corg">卖家回复：</strong><br />
						<div class="mat5"><?php echo $v['ask_replytext'] ?></div>
					</div>
					<?php endif;?>
				</div>
				<?php endforeach;?>
				<div class="xuxian1"></div>
				<div class="zixunbox">
					<div class="fl pl_l"></div>
					<div class="fl pl_m">请在这里发表您的问题</div>
					<div class="fl pl_r"></div>
					<div class="clear"></div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top">用户名称：</td>
						<td><?php if(pe_login('user')):?><?php echo $_s_user_name ?><?php else:?>游客<?php endif;?></td>
					</tr>
					<tr>
						<td valign="top">咨询内容：</td>
						<td><textarea name="ask_text" style="width:550px;height:120px;resize:none;"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="button" value="提交" class="tj_btn"></td>
					</tr>
					</table>
				</div>
			</div>
		</div>
		<!--咨询 End-->
		<!--评论 Start-->
		<div class="promain js_menuhtml" style="display:none">
			<div class="plmain" id="js_commenthtml">
				<?php foreach($comment_list as $v):?>
				<ul class="mat5">
					<li class="fl">会员：<?php echo $v['user_name'] ?></li>
					<li class="fr">评价日期：<?php echo pe_date($v['comment_atime']) ?></li>
				</ul>
				<div class="pingjia font14"><?php echo $v['comment_text'] ?></div>
				<?php endforeach;?>
				<div class="xuxian1"></div>
				<div class="zixunbox">
					<div class="fl pl_l"></div>
					<div class="fl pl_m">请在这里发表您的评论</div>
					<div class="fl pl_r"></div>
					<div class="clear"></div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top">用户名称：</td>
						<td><?php if(pe_login('user')):?><?php echo $_s_user_name ?><?php else:?>游客<?php endif;?></td>
					</tr>
					<tr>
						<td valign="top">评价内容：</td>
						<td><textarea name="comment_text" style="width:550px;height:120px;resize:none;"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="button" value="提交" class="tj_btn"></td>
					</tr>
					</table>
				</div>
			</div>
		</div>
		<!--评论 End-->
		<div class="promain js_menuhtml" style="display:none"><?php echo $page['page_text'] ?></div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.lazyload.min.js"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=simple"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
<script type="text/javascript">
function find_comment() {
	$("#js_menu").find("li").eq(2).click();
	window.location.href = "#js_menu";
}
$(function(){
//标签切换
$("#js_menu").find("li").click(function(){
	$("#js_menu").find("li").removeClass("sel");
	$(this).addClass("sel");
	$(".js_menuhtml").hide();
	$(".js_menuhtml").eq($("#js_menu").find("li").index($(this))).show();
})
//咨询发表
$("#js_askhtml").find(":button").click(function(){
	if (!<?php echo pe_login('user') ?>) {alert('抱歉：只有登录用户才能发表咨询！请先登录...');return;}
	var ask_text = $(":input[name='ask_text']").val();
	if (ask_text == '') {alert('咨询内容必须填写');return;}
	$.post("<?php echo $pe['host_root'] ?>index.php?mod=product&act=askadd&id=<?php echo $info['product_id'] ?>", {"ask_text":ask_text, "pesubmit":true}, function(json){
		if (json.result) {
			$("#js_askhtml").prepend(json.html);
			$(":input[name='ask_text']").val('');
			alert('咨询提交成功！管理员会尽快答复...');
		}
		else {
			alert('抱歉，咨询提交失败，请重新提交...')			
		}
	}, "json")
})
//评价发表
$("#js_commenthtml").find(":button").click(function(){
	if (!<?php echo pe_login('user') ?>) {alert('抱歉：只有登录用户才能发表评价！请先登录...');return;}
	var comment_text = $(":input[name='comment_text']").val();
	if (comment_text == '') {alert('评价内容必须填写');return;}
	$.post("<?php echo $pe['host_root'] ?>index.php?mod=product&act=commentadd&id=<?php echo $info['product_id'] ?>", {"comment_text":comment_text,"pesubmit":true}, function(json){
		if (json.result) {
			$("#js_commenthtml").prepend(json.html);
			$(":input[name='comment_text']").val('');
			alert('感谢您的支持，评价提交成功！');
		}
		else {
			alert('抱歉，评价提交失败，请重新提交...')			
		}
	}, "json")
})
})
//加入购物车
function cart_add(id) {
	if ("<?php echo $info['rule_id'] ?>" != '' && $(":input[name='prorule_id']").val() == '') {
		alert('请选择商品规格');
		return false;
	}
	$.getJSON("<?php echo $pe['host_root'] ?>index.php", {"mod":"order","act":"cartadd","product_id":id,"product_num":$(":input[name='product_num']").val(),"prorule_id":$(":input[name='prorule_id']").val()},function(json){
		if (json.result == true) {
			art.dialog({
				id: 'cart_add',
				lock: true,
			    content: '<div class="gw"><p>商品已成功加入购物车！</p><a class="gw2" href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=add"></a><a class="gw1" href="javascript:dialog_close();"></a></div>'
			});
		}
		else if (json.result == -1) {
			alert('商品库存不足...')
		}
		else {
			alert('抱歉，加入购物车失败，请重新加入...')
		}
	})
}
function dialog_close(){
	art.dialog.list['cart_add'].close();
}
function collect_add(id) {
	if (!<?php echo pe_login('user') ?>) {alert('抱歉：只有登录用户才能收藏商品！请先登录...');return;}
	$.getJSON("<?php echo $pe['host_root'] ?>index.php", {"mod":"product","act":"collectadd","id":id},function(json){
		alert(json.show);
	})
}
$(function(){
	$(".prorule_span").click(function(){
		if ($(this).hasClass("prorule_lock")) return;
		if ($(this).hasClass("prorule_sel")) {
			$(this).removeClass("prorule_sel");
		}
		else {
			$(this).parent().find("span").removeClass("prorule_sel");
			$(this).addClass("prorule_sel");
		}
		prorule_lock();
	})
	$("img").lazyload({
		effect:"fadeIn",
		container:$("body")
	});
})
</script>
<?php include(pe_tpl('footer.html'));?>