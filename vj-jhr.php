<?php
/*
Plugin Name: VJMedia: JSHTTPSRedirect
Description: Redirec to HTTPS using Javascript instead of Cloudflare for preserv sub-sub-domain usability
Version: 1.0
Author: <a href="http://www.vjmedia.com.hk">技術組</a>
GitHub Plugin URI: https://github.com/VJMedia/vj-jshttpsredirect
*/

defined('WPINC') || (header("location: /") && die());


function vjjhr_hook() { ?>
<script>
if (location.protocol != 'https:'){
	location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}
</script>
<?php } add_action('wp_head', 'vjjhr_hook'); ?>
