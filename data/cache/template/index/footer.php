<div class="clear"></div>
<div class="foot">
	<div class="bottom_img"><img src="<?php echo $pe['host_tpl'] ?>images/bottom_img.jpg"></div>
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
				<div class="kfdh">客服电话</div>
				<p><?php echo $cache_setting['web_phone'] ?></p>
				<span class="font12 c888">周一至周五8:30-18:00</span>
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