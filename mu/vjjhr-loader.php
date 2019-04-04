<?php
/*
Plugin Name: VJMedia: JavascriptHTTPSRedirect
Description: Redirec to HTTPS using Javascript instead of Cloudflare for preserv sub-sub-domain usability
Version: 1.0
Author: <a href="http://www.vjmedia.com.hk">技術組</a>
GitHub Plugin URI: https://github.com/VJMedia/vj-jhr
*/

defined('WPINC') || (header("location: /") && die());

define('VJJHR_PATH','vj-jhr/vj-jhr.php');

if ( ! function_exists( 'vjjhr_dummy' ) && ! in_array(VJJHR_PATH,get_option('active_plugins')) ) {
        require trailingslashit( WP_PLUGIN_DIR ) . VJJHR_PATH;
}else{
	$vjjhr_needdeactivate=true;
}

function vjjhr_deactivate( $plugin, $network_wide ) {
        if ( VJJHR_PATH === $plugin ) {
                deactivate_plugins( VJJHR_PATH );
        }
} add_action( 'activated_plugin', 'vjjhr_deactivate', 10, 2 );

function vjjhr_mu_plugin_active( $actions ) {
        if ( isset( $actions['activate'] ) ) {
                unset( $actions['activate'] );
        }
        if ( isset( $actions['delete'] ) ) {
                unset( $actions['delete'] );
        }
        if ( isset( $actions['deactivate'] ) ) {
                unset( $actions['deactivate'] );
        }

        return array_merge( array( 'mu-plugin' => esc_html__( 'Activated as mu-plugin', 'vj-jhr' ) ), $actions );
}
add_filter( 'network_admin_plugin_action_links_' . VJJHR_PATH, 'vjjhr_mu_plugin_active' );
add_filter( 'plugin_action_links_' . VJJHR_PATH, 'vjjhr_mu_plugin_active' );

add_action( 'after_plugin_row_' . VJJHR_PATH,
	function () {
		print( '<script>jQuery(".inactive[data-plugin=\'vj-jhr/vj-jhr.php\']").attr("class", "active");</script><script>jQuery(".active[data-plugin=\'vj-jhr/vj-jhr.php\'] .check-column input").remove();</script>' );
		print( '<script>jQuery("tr[data-plugin=\'vj-jhr/vj-jhr.php\']").hide();</script>');
	}
);


