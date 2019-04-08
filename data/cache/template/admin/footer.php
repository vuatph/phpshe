		<div class="clear"></div>
	</div>
	<div class="foot">Copyright <span class="num">©</span> 2008-2014 <a target="_blank" href="http://www.phpshe.com">灵宝简好网络科技有限公司</a> 版权所有</div>
</div>
<script type="text/javascript">
$(function(){
	$(".list").find("tr").hover(
		function(){
			if ($(this).find("td").hasClass("bgtt")) return;
			$(this).find("td").css("background-color", "#ffffdd");
		},
		function(){
			if ($(this).find("td").hasClass("bgtt")) return;
			$(this).find("td").css("background-color", "#fff");
		}
	)
})
</script>
</body>
</html>