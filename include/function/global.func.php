<?php
/**
 * @copyright   2008-2012 简好技术 <http://www.phpshe.com>
 * @creatdate   2011-0501 koyshe <koyshe@gmail.com>
 */
//#####################@ 系统核心函数 @#####################//
//模板函数
function pe_tpl($tplname, $tplpath = '')
{
	global $pe, $module;
	$tplnamearr = explode('.', $tplname);
	$tplpathcache = "{$pe['path_root']}data/cache/template/{$module}/";

	$tplpathcache_name = "{$tplpathcache}{$tplnamearr[0]}.php";
	$tplpath_name = $pe['path_tpl'] . $tplname;
	!is_dir($tplpathcache) && mkdir($tplpathcache, 0777, true);
	if (!is_file($tplpathcache_name) or @filemtime($tplpath_name) > @filemtime($tplpathcache_name)) {
		if (!is_file($tplpath_name)) {
			pe_bug("模板文件丢失,路径：./template/default/{$module}/{$tplname}", __LINE__);			
		}
		$html = file_get_contents($tplpath_name);
		$html = preg_replace('/<\!\-\-\{/', '<?php ', $html);
		$html = preg_replace('/\}\-\->/', '?>', $html);
		$html = preg_replace('/\{\$([^\}]*)\}/', '<?php echo \$\1 ?>', $html);
		$html = preg_replace('/\{(\w+\([^\}]*\))\}/', '<?php echo \1 ?>', $html);
		file_put_contents($tplpathcache_name, $html);
	}
	return $tplpathcache_name;
}
//数据库安全
function pe_dbhold($str, $exc=array())
{
	if (is_array($str)) {
		foreach($str as $k => $v) {
			$str[$k] = in_array($k, $exc) ? pe_dbhold($v, 'all') : pe_dbhold($v);
		}
	}
	else {
		$str = $exc == 'all' ? mysql_real_escape_string($str) : mysql_real_escape_string(htmlspecialchars($str));
	}
	return $str;
}
//导入hook
function pe_lead($leadname)
{
	global $pe;
	include_once($pe['path_root'].$leadname);
}
//前台url
function pe_url($modact, $argstr=null)
{
	global $pe;
	$modact = explode('-', $modact);
	switch ($pe['url_model']) {
		case 'php':
			$url = "{$pe['host_root']}index.php";
			$modact[0] && $url .= "?mod={$modact[0]}";
			$modact[1] && $url .= "&act={$modact[1]}";
			$modact[2] && $url .= "&id={$modact[2]}";
			//$modact[3] && $url .= "&urlarg[2]={$modact[3]}";
			//$modact[4] && $url .= "&urlarg[3]={$modact[4]}";
			$argstr && $url = "{$url}&{$argstr}";
		break;
		default:
			$url = $pe['url_model'] == 'pathinfo_safe' ? "{$pe['host_root']}index.php/" : $pe['host_root'];
			$modact[0] && $url .= $modact[0];
			$modact[1] && $url .= "/{$modact[1]}";
			$modact[2] && $url .= "-{$modact[2]}";
			$modact[3] && $url .= "-{$modact[3]}";
			$modact[4] && $url .= "-{$modact[4]}";
			$argstr && $url .= "?{$argstr}";
		break;
	}
	return $url;
}
//获取当前网址为下个地址的fromto
function pe_fromto()
{
	$host = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	stripos($host, 'fromto') !== false && $host = substr($host, 0, stripos($host, 'fromto')-1);
	return 'fromto='.urlencode($host);
	//return 'fromto='.urlencode(basename($_SERVER['SCRIPT_FILENAME'])."?{$_SERVER['QUERY_STRING']}");
}
//图片缩略图
function pe_thumb($img = '', $w = null, $h = null, $thumbtype = null)
{
	global $pe;
	static $sington = false;
//	$img = str_ireplace($pe['host_root'], $pe['path_root'], $img);
	//$img = $pe['path_root'] . strstr($img, 'data/attachment/');
	$img = "{$pe['path_root']}$img";
	switch ($thumbtype) {
		case 'avatar':
			$img_new = is_file($img) ? $img : "{$pe['path_root']}include/image/noavatar.gif";		
		break;
		default :
			$img_new = is_file($img) ? $img : "{$pe['path_root']}include/image/nopic.gif";	
		break;
	}
	if ($w or $h) {
		$img_thumb = "{$pe['path_root']}data/cache/thumb/".date('Y-m')."/thumb_{$w}x{$h}_".pe_filename($img_new);
		if (!is_file($img_thumb)) {
			if ($sington == false) {
				include_once("{$pe['path_root']}include/class/thumb.class.php");
			}
			new thumb($img_new, $img_thumb, $w, $h);
		}
		return str_ireplace($pe['path_root'], $pe['host_root'], $img_thumb);
	}
	return str_ireplace($pe['path_root'], $pe['host_root'], $img_new);
}
//seo信息
function pe_seo($title='', $keywords='', $description='', $type = 'index')
{
	if ($type == 'admin') {
		$seo['title'] = $title ? "{$title} - 欢迎使用PHPSHE商城系统": '欢迎使用PHPSHE商城系统';
	}
	else {
		$setting = cache::get('setting');
		$seo['title'] = $title ? "{$title} - {$setting['web_title']['setting_value']} - Powered by phpshe" : "{$setting['web_title']['setting_value']} - Powered by phpshe";
		$seo['keywords'] = $keywords ? $keywords : $setting['web_keywords']['setting_value'];
		$seo['description'] = $description ? $description : $setting['web_description']['setting_value'];
	}
	return $seo;
}
//#####################@ 处理结果展示 @#####################//
function pe_success($msg, $url=null, $type=null)
{
	$_SESSION['msg_show'] = $msg;
	$_SESSION['msg_result'] = 'success';
	pe_goto($url, $type);
}
function pe_error($msg, $url=null, $type=null) {
	$_SESSION['msg_show'] = $msg;
	$_SESSION['msg_result'] = 'error';	
	pe_goto($url, $type);
}
function pe_result() {
	global $pe;
	if (isset($_SESSION['msg_show']) && $_SESSION['msg_show']) {
		isset($_SESSION['msg_show']) && $show = $_SESSION['msg_show'];
		unset($_SESSION['msg_show']);
		if ($_SESSION['msg_result'] == 'success') {
print<<<html
	<style type="text/css">
	#msgshow{top:220px; left:45%; position:absolute;font-family:'Arial'}
	#msgshow_l{background:url({$pe['host_root']}include/image/dui_l.gif) no-repeat; width:38px; height:50px; float:left;}
	#msgshow_r{background:url({$pe['host_root']}include/image/dui_r.gif) no-repeat; width:7px; height:50px; float:left;}
	#msgshow_m{background:url({$pe['host_root']}include/image/dui_m.gif) repeat-x; height:34px; float:left; padding:16px 10px 0 10px; font-size:14px; font-weight:bold; color:#598f13; display:inline-block; min-width:130px; _width:130px;}
	</style>
html;
		}
		else {
print<<<html
	<style type="text/css">
	#msgshow{top:220px; left:45%; position:absolute;font-family:'Arial'}
	#msgshow_l{background:url({$pe['host_root']}include/image/cuo_l.gif) no-repeat; width:38px; height:50px; float:left;}
	#msgshow_r{background:url({$pe['host_root']}include/image/cuo_r.gif) no-repeat; width:7px; height:50px; float:left;}
	#msgshow_m{background:url({$pe['host_root']}include/image/cuo_m.gif) repeat-x; height:34px; float:left; padding:16px 10px 0 10px; font-size:14px; font-weight:bold; color:#b62c23; display:inline-block; min-width:130px; _width:130px;}
	</style>
html;
		}
print<<<html
	<script type="text/javascript">
		$("#msgshow").remove();
		$("body").append('<div id="msgshow"><div id="msgshow_l"></div><div id="msgshow_m">{$show}</div><div id="msgshow_r"></div><div class="clear"></div></div>');
		$("#msgshow").show();
		setTimeout(function(){ $("#msgshow").fadeOut(2000) }, 2000);
	</script>
html;
	}
}
//跳转函数	
function pe_goto($url = '', $type = 'default')
{
	global $pe;
	if ($type == 'dialog') {
		$url = $url ? "top.location.href = '{$url}'" : "top.location.reload()";	
	}
	else {
		$url = $url ? $url : (stripos($_SERVER['HTTP_REFERER'], $pe['host_root']) === false ? $pe['host_root'] : $_SERVER['HTTP_REFERER']);
		$url = "window.location.href='{$url}'";
	}
	echo "<script type='text/javascript'>{$url}</script>";
	die();
}
//#####################@ 文件相关函数 @#####################//
//文件夹大小
function pe_dirsize($dir_path)
{
	$size = 0;
	if (is_file($dir_path)) {
		$size = filesize($dir_path);
	}
	else {
		$dir_arr = glob(trim($dir_path).'/*');
		if (is_array($dir_arr)) {
			foreach ($dir_arr as $k => $v) {
				$size += pe_dirsize($v);
			}
		}
	}
	return $size;
}
//删除文件夹
function pe_dirdel($dir_path)
{
	if (is_file($dir_path)) {
		unlink($dir_path);
	}
	else {
		$dir_arr = glob(trim($dir_path).'/*');
		if (is_array($dir_arr)) {
			foreach ($dir_arr as $k => $v) {
				pe_dirdel($v, $type);
			}	
		}
		@rmdir($dir_path);
	}
}
//文件夹列表
function pe_dirlist($dir_path) {
	$dir_arr = glob($dir_path);
	if (is_array($dir_arr)) {
		foreach ($dir_arr as $k => $v) {
			$tpl_arr[$k] = trim(strrchr(trim($v, '/'), '/'), '/');
		}
		return $tpl_arr;
	}
	else {
		return array();
	}
}
//获取文件名
function pe_filename($path, $type = '')
{
	$patharr = explode('/', $path);
	$pathkey = count($patharr) - 1;
	$filename = $patharr[$pathkey];
	switch ($type) {
		case 'name':
			$arr = explode('.', $filename);
			return $arr[0];
		break;
		case 'ext':
			$arr = explode('.', $filename);
			return $arr[1];
		break;			
		default:
			return $filename;
		break;
	}
}

//#####################@ 杂项函数 @#####################//
function pe_bug($notice, $line = null)
{
	$html = "<p style='width:800px;margin:100px auto;padding:50px 10px;background:#f8f8f8'>错误提示：{$notice}<br/>错误定位：{$_SERVER[SCRIPT_FILENAME]}(第{$line}行)</p>";
	die($html);
}
//获取text
function pe_text($str)
{
	$str = str_ireplace(array('\t','\r','\n','\rn','&nbsp;',' '), '', strip_tags($str));
	return trim($str);
}
//针对文本保留html显示格式
function pe_texthtml($str)
{
	return nl2br(str_replace(' ', '&nbsp;', $str));
}
//获取适合js输出的html
function pe_jshtml($str, $isshow = 1) {
	$str = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $str));
	return $isshow ? 'document.write("'.$str.'");' : $str;
}
//截取字符串
function pe_cut($str, $len, $tail = '')
{
	$str_len = strlen($str);//字符串总偏移量
	$i = 0;//截取汉字时字符偏移量
	$l = 0;//已截取了的汉字长度
	while (true) {
		if (ord(substr($str, $i, 1)) > 0xa0) {//中文
			$cnstr .= substr($str, $i, 3);
			$i += 3;
			$l++;
		}
		else {//字母，字符，数字
			$cnstr .= substr($str, $i, 1);
			$i++;
			$l += 0.5;
		}
		if ($l == $len or ($l+0.5) == $len) {
			return $str_len <= $i ? $cnstr : $cnstr . $tail;
		}
	}
}
//js弹框
function pe_alert($msg)
{
	echo "<script type='text/javascript'>alert('{$msg}')</script>";
	pe_goto();
}
//增加反斜杠
function pe_addslashes($arr)
{
    if (empty($arr)) {
        return $arr;
    }
	else {
        return is_array($arr) ? array_map('pe_addslashes', $arr) : addslashes($arr);
    }
}
//移除反斜杠
function pe_stripslashes($arr)
{
    if (empty($arr)) {
        return $arr;
    }
	else {
        return is_array($arr) ? array_map('pe_stripslashes', $arr) : stripslashes($arr);
    }
}
//移除字符串左右空格
function pe_trim($str)
{
	if (is_array($str)) {
		foreach($str as $k => $v) {
			$str[$k] = pe_trim($v);
		}
	}
	else {
		$str = trim($str);
	}
	return $str;	
}
//获取ip
function pe_ip()
{
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}
//转换日期
function pe_date($time, $type = 'Y-m-d H:i')
{
	return $time ? date($type, $time) : '';
}
//多久以前
function pe_dayago($dmtime) {
	if (!$dmtime) return '≠';
	if ((time()-$dmtime) > 86400) {
		return intval((time()-$dmtime)/86400).'天前';
	}
	elseif ((time()-$dmtime) > 3600) {
		return intval((time()-$dmtime)/3600).'小时前';
	}
	elseif ((time()-$dmtime) > 60) {
		return intval((time()-$dmtime)/60).'分钟前';
	}
	elseif ((time()-$dmtime) > 0) {
		return (time()-$dmtime).'秒前';
	}
}
//url处理函数
function pe_updateurl($k, $v='')
{
	$querystr = $_SERVER['QUERY_STRING'];
	$url = $v === ''
		? preg_replace('/'.$k.'=[^&]*/', '', $querystr)
		: ((stripos($querystr, "&{$k}=") === false && stripos($querystr, "{$k}=") === false) ? "{$querystr}&{$k}={$v}" : preg_replace('/'.$k.'=[^&]*/', "$k=$v", $querystr));
	$url = trim($url, '&');
	return $url ? "?{$url}" : '?';
}
//url批量处理函数
function pe_updateurl_arr($arr)
{
	$querystr = $_SERVER['QUERY_STRING'];
	foreach ($arr as $val) {
		$k = $val[0];
		$v = $val[1];
		$querystr = $v === ''
			? preg_replace('/'.$k.'=[^&]*/', "", $querystr)
			: (stripos($querystr, $k.'=') === false ? "{$querystr}&{$k}={$v}" : preg_replace('/'.$k.'=[^&]*/', "$k=$v", $querystr));
		$querystr = trim($querystr, '&');
	}
	return $querystr ? '?'.$querystr : '';
}
//sql段函数。如时间段，但必须符合money=50-100的格式
function pe_sqlrange($fieldname, $rangeval, $misc = '-')
{
	if (stripos($rangeval, $misc) === false) {
		$sqlwhere = "{$fieldname} = '$rangeval'";
	}
	else {
		$rangarr = explode($misc, $rangeval);
		if ($rangarr[0] == 0 or !$rangarr[0]) {
			$sqlwhere = "{$fieldname} <= '$rangarr[1]'";
		}
		elseif ($rangarr[1] == 0 or !$rangarr[1]) {
			$sqlwhere = "{$fieldname} >= '$rangarr[0]'";
		}
		else {
			$sqlwhere = "{$fieldname} >= '$rangarr[0]' and {$fieldname} <= '$rangarr[1]'";		
		}
	}
	return $sqlwhere;
}
//#####################@ 安全函数 @#####################//
function pe_csrf_set() {
	$csrf_token = md5("{$_SERVER['REMOTE_ADDR']}koyshe+andrea=phpshe".time().rand(1,100));
	setcookie("csrf_token", $csrf_token);
	return "<input type='hidden' name='csrf_token' value='{$csrf_token}' />";
}
function pe_csrf_match() {
	global $pe;
	$referer = parse_url($_SERVER['HTTP_REFERER']);
	if (@stripos($pe['host_root'], $referer['host']) === false or $_POST['csrf_token'] != $_COOKIE['csrf_token'] or $_POST['csrf_token'] == '' or $_COOKIE['csrf_token'] == '') {
		unset($_COOKIE['csrf_token'], $_POST['csrf_token']);
		pe_error('请勿csrf或重复提交数据');
	}
	unset($_COOKIE['csrf_token'], $_POST['csrf_token']);
}

function pe_token_set() {
	$pe_token = md5("{$_SERVER['REMOTE_ADDR']}koyshe+andrea=phpshe".time().rand(1,100));
	setcookie("pe_token", $pe_token);
	if ($type == 'html') {
		return "<input type='hidden' name='pe_token' value='{$pe_token}' />";
	}
	else {
		return $pe_token;	
	}
}
function pe_token_match() {
	global $pe;
	$referer = parse_url($_SERVER['HTTP_REFERER']);
	if (@stripos($pe['host_root'], $referer['host']) === false or $_REQUEST['pe_token'] != $_COOKIE['pe_token'] or $_REQUEST['pe_token'] == '' or $_COOKIE['pe_token'] == '') {
		unset($_COOKIE['pe_token'], $_REQUEST['pe_token']);
		pe_error('请勿csrf或重复提交数据');
	}
	unset($_COOKIE['pe_token'], $_REQUEST['pe_token']);
}


function pe_dbxss($val) {
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=@avascript:alert('XSS')>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
      // @ @ search for the hex values
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // @ @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }

   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);

   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
               $pattern .= '|';
               $pattern .= '|(&#0{0,8}([9|10|13]);)';
               $pattern .= ')*';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'@phpshe@'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
}
//#####################@ 用户权限函数 @#####################//
function pe_login($utype){
	global $pe;
	return (md5($_SESSION["{$utype}_id"].$pe['host_root']) == $_SESSION["{$utype}_idtoken"]) ? 1 : 0;
}
?>