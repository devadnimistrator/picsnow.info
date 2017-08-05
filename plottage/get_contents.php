<?php
$resource_site = "https://p.w3layouts.com/demos/may-2016/10-05-2016/plottage/web";
$local_site = "/test/templates/w3layouts.com/realestate/plottage";

$request_url = $_SERVER['REQUEST_URI'];
$file_info = pathinfo($request_url);

$dirname = str_replace($local_site, "", $file_info['dirname']);
$basename = $file_info['basename']; 

$filenamme = parse_url($basename, PHP_URL_PATH);
$base_info = pathinfo($filenamme);

if (isset($base_info['extension']) && $base_info['extension'] && strlen($base_info['extension']) > 1) {
	$down_dir = dirname(__FILE__) . $dirname;	
	//$filenamme = parse_url($basename, PHP_URL_PATH);
} else {
	$down_dir = dirname(__FILE__) . $dirname . "/" . $basename;
	$filenamme = "index.html";
}

@mkdir($down_dir, "777", true);
$f_log = fopen("down.log", "a");
$html_contents = @file_get_contents($resource_site . $dirname . "/" . $basename);
if ($html_contents) {
	$html_contents = str_replace($resource_site, $local_site, $html_contents);
	
	file_put_contents($down_dir . "/" . $filenamme, $html_contents);
	
	//fwrite($f_log, "Completed: " . $request_url . "\n");
} else {
	fwrite($f_log, "Failed: " . ($resource_site . $dirname . "/" . $basename) . "\n");
}
fclose ($f_log);

if ($html_contents) {
	die($html_contents);
} else {
	die('');
}