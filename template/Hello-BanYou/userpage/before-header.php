<!doctype html>
<html>
<?php
if (!empty($userid)) {
	$userimg="https://a.ppy.sh/{$userid}_{$userlastvisit}.jpg";
	$config['icon']=$userimg;
}
$otherthings='';
$otherthings.='		<link rel="preload" href="https://static.'.$config['domain'].'/userpage/css/userpage.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" />'."\n";
if (!empty($pp) && ($mode == 3 || ($mode < 2 && $mode >= 0))) {
	$otherthings.='		<script defer="defer" src="https://cdn.bootcss.com/Chart.js/2.7.0/Chart.min.js"></script>'."\n";
}
if (empty($userid)) {
	$otherthings.='		<meta name="robots" content="noindex, nofollow" />'."\n";
}
if (!empty($csslink)) {
	$otherthings.="		<link rel=\"preload\" href=\"{$csslink}\" as=\"style\" onload=\"this.onload=null;this.rel='stylesheet'\" />\n";
}
?>
