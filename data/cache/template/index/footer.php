<div class="clear"></div>
<div class="foot">
	<div class="foot_sm">

			<ul>
			<li>
				<i class="i_1"></i>
				<h3>自营保正品</h3>
				<p>现货自营 正品保证</p>
			</li>
			<li>
				<i class="i_2"></i>
				<h3>全场免运费</h3>
				<p>不限品类 满99免邮</p>
			</li>
			<li>
				<i class="i_3"></i>
				<h3>发货如闪电</h3>
				<p>极速发货 航空直达</p>
			</li>
			<li>
				<i class="i_4"></i>
				<h3>退货有保障</h3>
				<p>开箱验货 30天退换</p>
			</li>
			</ul>
			<div class="clear"></div>

		
	</div>
	<div class="bottom_link">
		<div class="border_link">
			<?php foreach($cache_class_arr['help'] as $v):?>
			<?php if(++$help_index>5)break;?>
			<?php $info_list = $db->pe_selectall('article', array('class_id'=>$v['class_id']))?>
			<div class="item_1 fl">
				<h3><?php echo $v['class_name'] ?></h3>
				<ul>
					<?php foreach($info_list as $vv):?>
					<li><a href="<?php echo pe_url('article-'.$vv['article_id']) ?>" title="<?php echo $vv['article_name'] ?>"><?php echo $vv['article_name'] ?></a></li>
					<?php endforeach;?>
				</ul>
			</div>
			<?php endforeach;?>
			<div class="foot_telnum">
				<p><span><?php echo $cache_setting['web_phone'] ?></span></p>
				<span class="font14 cfen">周一 至 周五　8:30-18:00</span>
				<div class="mat10">
				<img class="fl" src="<?php echo pe_thumb($cache_setting['web_qrcode']) ?>">
				<div class="x_sm_text">扫扫有惊喜</div>
				<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="subnav">
		Copyright <span class="num">©</span> <?php echo $cache_setting['web_copyright'] ?> All Rights Reserved <?php echo $cache_setting['web_icp'] ?> <?php echo $cache_setting['web_tongji'] ?>&nbsp;
		Powered by <a href="http://www.phpshe.com" target="_blank" title="PHPSHE商城系统">phpshe<?php echo $ini['phpshe']['version'] ?></a>
	</div>
</div>
<div id="top">
	<div id="izl_rmenu" class="izl-rmenu">
		<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $cache_setting['web_qq'] ?>&site=qq&menu=yes" target="_blank" class="btn btn-qq"></a>
		<div class="btn btn-wx"><img class="pic" src="<?php echo pe_thumb($cache_setting['web_qrcode']) ?>" /></div>
		<div class="btn btn-phone"><div class="phone"><?php echo $cache_setting['web_phone'] ?></div></div>
		<div class="btn btn-top"></div>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>kefu/css/style.css">
<script type="text/javascript" src="<?php echo $pe['host_tpl'] ?>kefu/js/index.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.scrollLoading.js"></script>
<script type="text/javascript">
$(function(){
	$("img.js_imgload").scrollLoading();
	$(".fenlei_li").hover(
		function(){	
			$(".fenlei_li").find(".fenlei_h3 a").removeClass("sel");	
			$(".fenlei_li").removeClass("fenlei_li_sel");
			$(this).find(".fenlei_h3 a").addClass("sel");
			$(this).addClass("fenlei_li_sel");
			$(".fenlei_li").find(".js_right").hide();
			var _top = $(this).index() * 35;
			$(this).find(".js_right").css("top", "-"+_top+"px").show();
		},
		function(){
			$(".fenlei_li").find(".fenlei_h3 a").removeClass("sel");
			$(".fenlei_li").removeClass("fenlei_li_sel");
			$(".fenlei_li").find(".js_right").hide();	
		}
	)
	var hoverTimer;
	$("#menu_nav").hover(function(){
        clearTimeout(hoverTimer);
        $("#menu_html").add(".fenlei_li_more").show();
	}, function(){
        clearTimeout(hoverTimer);
        hoverTimer = setTimeout(function(){
			<?php if($mod!='index'):?>$("#menu_html").hide();<?php endif;?>
			$(".fenlei_li_more").hide();
        }, 100);
	})
});
pe_loadscript("<?php echo $pe['host_root'] ?>index.php?mod=notice");
</script>
</body>
</html>