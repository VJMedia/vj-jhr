<?php
/*
Plugin Name: VJMedia: JSHTTPSRedirect
Description: Redirec to HTTPS using Javascript instead of Cloudflare for preserv sub-sub-domain usability
Version: 1.0
Author: <a href="http://www.vjmedia.com.hk">技術組</a>
*/


//GitHub vj-jshttpsredirect

defined('WPINC') || (header("location: /") && die());


function vjjhr_hook() { ?>
<script>
if (location.protocol != 'https:'){
	window.stop();
	location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}
</script>
<?php } add_action('wp_head', 'vjjhr_hook'); ?>
