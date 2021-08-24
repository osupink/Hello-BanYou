<?php
require_once('C:/osu!/osu-score/include.getconfig.php');
$config['title']='BanYou';
$config['template']='Hello-BanYou';
$config['domain']='b.osu.pink';
$config['icon']="https://static.{$config['domain']}/favicon.ico";
$config['navurl']="https://{$config['domain']}";
$config['navtitle']='BanYou';
$config['teamurl']="https://team.osu.pink";
$config['teamtitle']='osu!pink Team';
$config['webkey']=getconfig('BanYouWebKey');
$config['webexpirytime']=86400;
if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
	$clientlang=strtolower(substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2));
}
if (!isset($clientlang) || !is_file("../translate/$clientlang.php")) {
	$clientlang='en';
}
require_once("translate/$clientlang.php");
$menu=array($config['navurl']=>$lang['homepage'],"https://install.{$config['domain']}"=>$lang['install'],"https://rank.{$config['domain']}"=>$lang['ranking'],'mailto:support@osu.pink'=>$lang['support']);
function displaytitle($maintitle,$rewrite) {
	if ($maintitle !== 0) {
		$maintitle=htmlspecialchars($maintitle);
	}
	if ($rewrite) {
		echo $maintitle;
	} else {
		global $config;
		if ($maintitle !== 0) {
			echo $maintitle.' - ';
		}
		echo $config['title'];
	}
}
function currentpage($here) {
	global $menu;
	$i=0;
	foreach ($menu as $key => $value) {
		$i++;
		echo '						<li';
		if ($i === $here) {
			echo ' class="active"';
			$key='./';
		}
		echo "><a href=\"$key\">$value</a></li>\n";
	}
}
function returnmodeselector($mode,$useuid=0,$qs=0) {
	$str=[];
	for ($i=0;$i<=3;$i++) {
		list($modename,$scoretable,$highscoretable,$userstatstable)=getmodeinfo($i);
		$str[]='<li'.(($mode === $i) ? ' class="active"' : '')."><a href=\"".(($useuid || $i !== 0) ? ("?".($useuid ? "p=0&" : "").($i !== 0 ? "m=$i" : "")) : (($qs) ? $qs : "./"))."\">$modename</a></li>\n";
	}
	return $str;
}
function yonbot($ie=0) {
	$ua=strtolower($_SERVER['HTTP_USER_AGENT']);
	if ($ie) {
		if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0') || strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0') || strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0') || strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0')) {
			return true;
		} else {
			return false;
		}
	} else {
		$bots=array('bot','spider');
		if (empty($ua)) {
			return true;
		} else {
			$orbot=(strpos($ua,'bot') || strpos($ua,'spider')) ? true : false;
			$andbot=(strpos($ua,'bot') && strpos($ua,'spider')) ? true : false;
			if ($orbot || $andbot) {
				return true;
			} else {
				return false;
			}
		}
	}
	unset($ua,$bots,$orbot,$andbot);
}
?>
