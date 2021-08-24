			<div id="rank" class="panel panel-default">
				<table class="table">
					<caption class="panel-heading"><?php echo $title; ?></caption>
					<thead>
						<tr>
							<th>Rank</th>
							<th><?php echo $lang['playername']; ?></th>
							<th><?php echo $lang['accuracy']; ?></th>
							<th><?php echo $lang['playcount']; ?></th>
							<th><?php echo $callpp; ?></th>
						</tr>
					</thead>
					<tbody>
<?php
$i=0;
foreach ($ranklist as $value) {
	$i++;
	$username=$value['username'];
	$accuracy=$value['accuracy']*100;
	$accuracy=sprintf('%.2f',$accuracy);
	$playcount=$value['playcount'];
	$class=array();
	if ($value['osu_subscriber'] && ($value['osu_subscriptionexpiry'] === NULL || time() < $value['osu_subscriptionexpiry'])) {
		$supportplayer=(($value['osu_supportplayer']) ? 1 : 0);
		$class[]='Support'.($supportplayer ? 'Play' : '').'er';
	}
	if ($value['user_lastvisit'] < (time()-604800) && !isset($supportplayer)) {
		$class[]='inactive-player';
		#$userlink=$username;
	}# else {
		$userlink="<a href=\"https://user.{$config['domain']}/{$username}".($mode !== 0 ? "?m=$mode" : "")."\">{$username}</a>";
	#}
	$classstr=implode(' ',$class);
	if (!empty($classstr)) {
		$classstr=" class=\"$classstr\"";
	}
	$pp=($mode == 3 || ($mode < 2 && $mode >= 0)) ? sprintf('%.2f',$value['rank_score'])."pp" : $value['ranked_score'];
	echo "						<tr>
							<th scope=\"row\">#$i</th>
							<td{$classstr}>$userlink</td>
							<td>$accuracy%</td>
							<td>$playcount</td>
							<td>$pp</td>
						</tr>\n";
	unset($userlink,$supportplayer);
}
?>
					</tbody>
				</table>
			</div>
