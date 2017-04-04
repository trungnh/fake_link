<?php
include('./Mobile_Detect.php');
$detect = new Mobile_Detect();
if($detect->isMobile() || $detect->isTablet()){
	
	include('./Ipapi.php');
	$ipapi = new Ipapi();
	$ip = $ipapi->getRealIpAddr();
	$query = $ipapi->query($ip);

	if($query->country == 'Vietnam'){
		include('./mobile.html');
		flush();               // - Make sure all buffers are flushed
		ob_flush();            // - Make sure all buffers are flushed
		exit;
	}else{

	}

}else{
	$url = "https://vine.co/v/57BUDjLKWgr";
	// redirect command
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	header('Location:'.$url, true, 301);
	echo "<html></html>";  // - Tell the browser there the page is done
	flush();               // - Make sure all buffers are flushed
	ob_flush();            // - Make sure all buffers are flushed
	exit;
}
?>