			<div id="modeselector">
				<ul class="nav nav-tabs">
<?php
	$modeSelector=returnmodeselector($mode,$useuid,$username);
	foreach ($modeSelector as $value) {
		echo "					{$value}";
	}
?>
				</ul>
			</div>
			<div id="user">
				<div id="avatar">
<?php
if (!empty($additionals)) {
	foreach ($additionals as $key => $value) {
		echo "					<img class=\"additional additional-type-{$key}\" src=\"{$value}\" />\n";
	}
}
?>
					<img src="<?php echo $userimg; ?>" />
				</div>
				<div id="userinfo">
<?php
echo "					<h2>
						<a rel=\"nofollow\" href=\"$userpage\">$username</a>
						$country
					</h2>";
if (count($badgelist) > 0) {
	echo "\n					<div id=\"badges\">\n";
}
foreach ($badgelist as $value) {
	echo "						<img width=\"225\" src=\"$value\" />\n";
}
echo "					";
if (count($badgelist) > 0) {
	echo "</div>";
}
echo "\n".((!empty($pp)) ? "					<p>lv.{$level[0]} <svg viewBox=\"0 0 100 1\" preserveAspectRatio=\"none\" style=\"display:block;width:50em;max-width:100%;max-height:10px;\"><path d=\"M 0,0.5 L 100,0.5\" stroke=\"#1E90FF\" stroke-width=\"1\" fill-opacity=\"0\" style=\"stroke-dasharray:100,100;stroke-dashoffset:".(100-$level[1]).";\"></path></svg></p>\n" : "")."					<p>".((!empty($pp)) ? "$callpp / {$lang['accuracy']}{$lang['colon']}$accuracy% / {$lang['maxcombo']}{$lang['colon']}$maxcombo / {$lang['playcount']}{$lang['colon']}$playcount" : $lang['never_play_this_mode'])." / {$lang['regdate']}{$lang['colon']}$regdate / {$lang['lastlogin']}{$lang['colon']}$userlastvisittext</p>\n";
?>
				</div>
			</div>
<?php
if (!empty($pp) && ($mode == 3 || ($mode < 2 && $mode >= 0))) {
	echo <<<html
			<div id="chart">
				<canvas id="rankchart" height="100"></canvas>
				<script>ppdata=$ppdata;datedata=$datedata;</script>
				<script defer="defer" src="https://static.{$config['domain']}/userpage/js/chart.js"></script>
			</div>\n
html;
}
if (isset($bplist)) {
	$callpp=($mode == 3 || ($mode < 2 && $mode >= 0)) ? $lang['performance'] : $lang['score'];
	echo <<<html
			<div id="bestscore" class="panel panel-default">
				<table class="table">
					<caption class="panel-heading">{$lang['bplist']}</caption>
					<thead>
						<tr>
							<th>#</th>
							<th>Rank</th>
							<th>{$lang['beatmap']}</th>
							<th>{$callpp}</th>
							<th>{$lang['date']}</th>
						</tr>
					</thead>
					<tbody>\n
html;
	$i=0;
	foreach ($bplist as $value) {
		$i++;
		if ($mode == 3 || ($mode < 2 && $mode >= 0)) {
			$pp=sprintf('%.2f',$value[1]);
			$realpp=sprintf('%.2f',$value[2]);
		} else {
			$pp=$value[7];
		}
		$beatmapid=$value[0];
		$rank=$value[3];
		$score_id=$value[5];
		$date=TranTime(strtotime($value[6]));
		$mods=intval($value[4]);
		$modsmsg='';
		if ($mods !== 0) {
			$modsmsg=" <b>+".getShortModString($mods,1)."</b>";
		}
		$callpp = ($mode == 3 || ($mode < 2 && $mode >= 0)) ? "{$realpp}pp({$pp}pp)" : $pp;
		$title=$conn->queryOne("SELECT CONCAT(IF(artist != '',CONCAT(artist,' - ',title),title),' [',version,']') FROM osu_beatmaps WHERE beatmap_id = $beatmapid LIMIT 1");
		$replayText=(file_exists("../../osu-score/replays/$userid/replay-{$mode}_{$score_id}.osr") ? "<a href=\"http://replay.{$config['domain']}/{$score_id}".(($mode > 0 && $mode <= 3) ? "?m={$mode}" : "")."\">{$i}</a>" : $i);
		echo <<<html
						<tr id="score_{$score_id}">
							<th scope="row">$replayText</th>
							<th><img src="https://s.ppy.sh/images/{$rank}_small.png" /></th>
							<td><a rel="nofollow" href="https://osu.ppy.sh/b/{$beatmapid}">{$title}</a>{$modsmsg}</td>
							<td>{$callpp}</td>
							<td>{$date}</td>
						</tr>\n
html;
	}
	echo "					</tbody>
				</table>
			</div>\n";
}
?>
