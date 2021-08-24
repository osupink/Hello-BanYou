<!doctype html>
<html>
<?php
$otherthings=<<<html
		<link rel="preload" href="https://static.{$config['domain']}/index/css/index.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
        <script defer="defer" src="https://static.{$config['domain']}/index/js/show.js"></script>\n
html;
?>
