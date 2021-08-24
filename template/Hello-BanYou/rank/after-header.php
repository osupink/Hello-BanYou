		<div class="container" id="main-content">
			<div id="modeselector">
				<ul class="nav nav-tabs">
<?php
$modeSelector=returnmodeselector($mode);
foreach ($modeSelector as $value) {
	echo "					{$value}";
}
?>
				</ul>
			</div>