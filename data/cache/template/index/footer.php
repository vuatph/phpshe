<div class="clear"></div>
<div class="width980">
<?php echo ad_show('footer') ?>
<?php if($mod=='index'):?><?php echo ad_show('index_footer') ?><?php endif;?>
</div>
<div class="foot">
	<?php if($mod=='index'):?>
	<div class="flink">
		<span class="strong">友情链接：</span>
		<?php foreach($cache_link as $v):?>
		<a href="<?php echo $v['link_url'] ?>" title="<?php echo $v['link_name'] ?>" target="_blank"><?php echo $v['link_name'] ?></a>
		<?php endforeach;?>
	</div>
	<?php endif;?>
	<div class="bottom_link mat10">
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
			<div class="clear"></div>
		</div>
	</div>
	<div class="bottom_img"><img src="<?php echo $pe['host_tpl'] ?>images/bottom_img.jpg"></div>
	<div class="subnav">
		Copyright <span class="num">©</span> <?php echo $cache_setting['web_copyright'] ?> All Rights Reserved　<?php echo $cache_setting['web_icp'] ?>
		<p>咨询热线：<?php echo $cache_setting['web_phone'] ?>　咨询QQ：<?php echo $cache_setting['web_qq'] ?>　<?php echo $cache_setting['web_tongji'] ?></p>
		<p>Powered by <a href="http://www.phpshe.com" target="_blank" title="PHPSHE商城系统" class="cgreen">phpshe<?php echo $ini['phpshe']['version'] ?></a></p>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>/kefu/css/style.css">
<div class="newkefu">
	<div class="newkefu_bar"></div>
	<div class="newkefu_header"></div>
	<div class="newkefu_shouqian">
        <ul>
		<?php foreach($web_qq as $v):?>
		<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v ?>&site=qq&menu=yes"><img border="0" src="<?php echo $pe['host_tpl'] ?>images/qq.png" alt="在线客服" title="在线客服"></a></li>
		<?php endforeach;?>
        </ul>
	</div>
	<div class="newkefu_middle"></div>
	<div class="newkefu_shouhou">
		<p class="c666">24小时客服热线<p>
		<p class="mat10 font16 num corg strong"><?php echo $cache_setting['web_phone'] ?></p>
    </div>
    <div class="newkefu_footer"></div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.scrollLoading.js"></script>
<script type=text/javascript>
$(function(){
	$("img.js_imgload").scrollLoading();
	$(".newkefu_bar").toggle(
		function(){
			$(".newkefu").animate({right:0});
			$(".newkefu_bar").addClass("newkefu_bar_sel");
		},
		function(){
			$(".newkefu").animate({right:"-140px"});
			$(".newkefu_bar").removeClass("newkefu_bar_sel");
		}
	);
	$(".fenlei_li").hover(
		function(){	
			$(".fenlei_li").find(".fenlei_h3 a").removeClass("sel");	
			$(this).find(".fenlei_h3 a").addClass("sel");
			$(".fenlei_li").find(".js_right").hide();	
			$(this).find(".js_right").show();
		},
		function(){
			$(".fenlei_li").find(".fenlei_h3 a").removeClass("sel");
			$(".fenlei_li").find(".js_right").hide();	
		}
	)
	<?php if($mod=='index'):?>
		$("#menu_html").show();
	<?php else:?>
		$("#menu_nav").hover(function(){
			$("#menu_html").show();
		}, function(){
			$("#menu_html").hide();	
		})
	<?php endif;?>
});
pe_loadscript("<?php echo $pe['host_root'] ?>index.php?mod=notice");
</script>
</body>
</html>