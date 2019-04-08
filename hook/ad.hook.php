<?php
function ad_show($ad_position)
{
	global $db, $mod;	
	if ($mod=='user') return;
	$cache_ad = cache::get('ad');
	$html = '';
	if (is_array($cache_ad[$ad_position])) {
		foreach($cache_ad[$ad_position] as $v) {
			$v['ad_logo'] = pe_thumb($v['ad_logo']);
			$html .= $v['ad_url'] ? "<p class='mat5'><a href='{$v['ad_url']}' target='_blank'><img src='{$v['ad_logo']}' /></a></p>" : "<p class='mat5'><img src='{$v['ad_logo']}' /></p>";		
		}
	}
	return $html;
}
?>