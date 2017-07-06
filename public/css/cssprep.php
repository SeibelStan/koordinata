<?php

header('Content-type: text/css');

$styles = [
	'app.css',
	'fontello.css'
];
$mixedstyle = 'mixed.min.css';

$mixinsreg = '/@mixins\s*\{([\s\S]+?)\}/';
$mixed = '';
$mixins = [];
foreach($styles as $style) {
	$content = file_get_contents($style);
	preg_match($mixinsreg, $content, $matches);
	if(isset($matches[1])) {
		array_push($mixins, trim($matches[1]));
	}
	$mixed .= $content;
}

foreach($mixins as $mixin) {
	$mixin = explode(";", $mixin);
	foreach($mixin as $part) {
		$part = explode(':', trim($part));
		$mixed = preg_replace('/' . $part[0] . '/', $part[1], $mixed);
	}
}

$mixed = trim(preg_replace($mixinsreg, '', $mixed));

if(isset($_GET['min'])) {
	$mixed = preg_replace("/[\n\t]/", '', $mixed);
	$mixed = preg_replace("/\s+/", ' ', $mixed);
	$mixed = preg_replace('/\s*:\s*/', ':', $mixed);
	$mixed = preg_replace('/\s{/', '{', $mixed);
}
if(isset($_GET['build'])) {
	file_put_contents($mixedstyle, $mixed);
	chmod($mixedstyle, 0777);
}
echo $mixed;