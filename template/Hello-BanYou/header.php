	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover" />
		<meta name="keywords" content="osu,osu!,osupink,osu.pink,osu!pink,BanYou,osu! BanYou,╟Есм">
		<link rel="icon" href="<?php echo $config['icon']; ?>">
		<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="preload" href="https://static.<?php echo $config['domain']; ?>/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
		<!--[if lte IE 8]>
			<script src="https://fuckie.acgn.xyz/ie8.js"></script>
		<![endif]-->
<?php
if (!(isset($nojquery) && $nojquery)) {
	echo "		<script defer=\"defer\" src=\"https://cdn.bootcss.com/jquery/3.2.0/jquery.min.js\"></script>\n";
}
if (isset($otherthings)) { echo $otherthings; }
?>
		<title><?php if (!isset($rewrite)) { $rewrite=0; } displaytitle($title,$rewrite); ?></title>
	</head>
	<body>
		<nav class="navbar navbar-inverse" id="topbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo $config['navurl'] ?>"><?php echo $config['navtitle']; ?></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false">
						<span class="sr-only"><?php echo $lang['fold_or_unfold']; ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="nav-menu">
					<ul class="nav navbar-nav navbar-left">
<?php currentpage($active); ?>
					</ul>
				</div>
			</div>
		</nav>
