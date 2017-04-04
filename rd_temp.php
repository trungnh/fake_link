<?php
include REDIRECT_DIR .'Mobile_Detect.php';

$detect = new Mobile_Detect();
if($detect->isMobile() || $detect->isTablet()){

	include REDIRECT_DIR . 'Ipapi.php';
	$ipapi = new Ipapi();
	$ip = $ipapi->getRealIpAddr();
	$query = $ipapi->query($ip);

	if($query->country == 'Vietnam'){
		?>
		<html>
		<head>
			<style>
				img {
					width:100%;
					height: auto;
				}
			</style>
			<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" data-cfasync="true"></script>
		</head>
		<body>
			<script>
	          jQuery(document).ready( function() {
	            setTimeout(function(){ window.location = "<?php echo $mobile_url; ?>"; }, 300);
	          });
			</script>
		</body>
		</html>
		<?php
		flush();               // - Make sure all buffers are flushed
		ob_flush();            // - Make sure all buffers are flushed
		exit;
	}else{

	}

}else{
	// redirect command
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	header('Location:' . $pc_url, true, 301);
	echo "<html></html>";  // - Tell the browser there the page is done
	flush();               // - Make sure all buffers are flushed
	ob_flush();            // - Make sure all buffers are flushed
	exit;
}
?>