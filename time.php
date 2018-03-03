<?php 
	$raw = "Sum Mar 23 06:39:16 +0000 2008";
	$xplod = explode(' ', $raw);
	print_r($xplod);
	$string = "$xplod[5]-$xplod[1]-$xplod[2] $xplod[3]";
	echo "<br /> $string";
	$date = date("Y-m-d H:i:s", strtotime($string));
	echo "<br />$date";
?>