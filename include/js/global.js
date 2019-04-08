/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2010-1001 koyshe <koyshe@gmail.com>
 */
//$.ajaxSettings.async = false;
//常用正则规则
var rule_phone = /^((1[0-9]{10})|(029[0-9]{8}))$/;
var rule_qq = /^[0-9]{5,10}$/;
var rule_email = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[a-z]{2,3}$/;
var rule_zh = /^[\u4e00-\u9fa5]+$/;

/* ====================== jq全局操作函数 ====================== */
//全选操作(修正版) by koyshe 2012-03-09
function pe_checkall(_this, inputname) {
	var checkname = $(_this).attr("name");
	if ($(_this).is(":checked")) {
		$("input[name='"+inputname+"[]']").add("input[name='"+checkname+"']").attr("checked","checked");
	}
	else {
		$("input[name='"+inputname+"[]']").add("input[name='"+checkname+"']").removeAttr("checked");
	}
} 
//带提醒批量操作(修正版) by koyshe 2012-03-09
function pe_cfall(_this, inputname, formid, show) {
	if ($("input[name='"+inputname+"[]']").filter(":checked").length == 0) {
		alert('请先勾选需要'+show+'的信息!');
		return false;
	}
	else if (confirm('您确认'+show+'吗?')) {
		$("#"+formid).attr("action", $(_this).attr("href")).submit();
	}
	return false;
}
//带提醒单个操作(修正版) by koyshe 2012-11-29
function pe_cfone(_this, show) {
	var _text = arguments[2] ? show : '您确认'+show+'吗?';
	if (confirm(_text)) {
		if ($(_this).is("a")) {
			return true;
		}
		else {
			if ($(_this).attr("target") == "_blank") {
				window.open($(_this).attr("href"));
				return false;
			}
			if (document.all) {  
				var referer_url = document.createElement('a');  
				referer_url.href = $(_this).attr("href");  
				document.body.appendChild(referer_url);  
				referer_url.click();  
			}
			else {
				window.location.href = $(_this).attr("href");
			}
		}
	}
	return false;
};
//批量操作 by koyshe 2012-03-09
function pe_doall(_this, formid) {
	$("#"+formid).attr("action", $(_this).attr("href")).submit();
}
//dialog函数 by koyshe 2011-11-12
function pe_dialog(_this, title, width, height, id, lock) {
	art.dialog.open($(_this).attr("href"), {title:title, width: width, height: height, id: id, lock: lock});
	return false;
}
function pe_yzm(_this) {
	var yzm_url = $(_this).attr("src");
	var yzm_time = new Date().getTime();
	if (yzm_url.indexOf("time") >= 0) {
		yzm_url = yzm_url.replace(/time=\d+/, 'time=' + yzm_time);
	}
	else {
		yzm_url += (yzm_url.indexOf("?") >= 0 ? '&' : '?') + 'time=' + yzm_time;
	}
	$(_this).attr("src", yzm_url);
}
//商品购买数量
function pe_numchange(inputname, type, limit) 
{
	var _input = $(":input[name='"+inputname+"']");
	var _input_val = parseInt(_input.val());
	var limit = parseInt(limit);
	if (type == '+') {
		if (_input_val < limit) _input.val(_input_val + 1)
	}
	else {
		if (_input_val > limit) _input.val(_input_val - 1)
	}
}
function pe_inputdefault(name, text) {
	var _this = $(":input[name='"+name+"']");
	if (_this.val() == '') _this.val(text);
	_this.focus(function(){
		if ($(this).val() == text) {
			$(this).val('');
		}
	})
	_this.blur(function(){
		if ($(this).val() == '') {
			$(this).val(text)
		}
	})
	_this.parent("form").submit(function(){
		if (_this.val() == text) {
			_this.val('');
		}
	})
}

function pe_countdown(id, etime) {
	setInterval(function(){
	    var obj = $("#" + id);
	    var endTime = new Date(parseInt(etime) * 1000);
	    var nowTime = new Date();
	    var nMS=endTime.getTime() - nowTime.getTime();
	    var myD=Math.floor(nMS/(1000 * 60 * 60 * 24));
	    var myH=Math.floor(nMS/(1000*60*60)) % 24;
	    var myM=Math.floor(nMS/(1000*60)) % 60;
	    var myS=Math.floor(nMS/1000) % 60;
	    var myMS=Math.floor(nMS/100) % 10;
	    if(myD>= 0){
			var str = myD+"天"+myH+"小时"+myM+"分"+myS+"."+myMS+"秒";
	    }else{
			var str = "0天0小时0分0秒";
		}
		obj.html(str);
	}, 100);
}

function pe_loadscript (url){
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = url;
    document.body.appendChild(script);
}