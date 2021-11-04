<?php
/**
 * Plugin Name:     Hetas Hotjar Custom
 * Plugin URI:      https://hetas.co.uk
 * Description:     A small plugin to monitor specific pages with hotjar
 * Author:          Elliott Richmond
 * Author URI:      https://squareone.software
 * Text Domain:     hetas-hotjar-custom
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Hetas_Hotjar_Custom
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('wp_head', 'add_hotjar_to_specific_pages');
function add_hotjar_to_specific_pages() {
	global $wp;
	$url = add_query_arg( $wp->query_vars, home_url() );
	$pages = array(
		'hetas-copy-certificate-search',
		'hetas-copy-certificate-results',
		'hetas-copy-certificate-notification-details',
		'hetas-copy-certificate-notification-purchase',
		'hetas-copy-certificate-notification-payment-success'
	);
	foreach($pages as $page) {
		$pos = stripos( $url,$page );
		if($pos !== false) {
			error_log('COC Log: url found ' . $url . ' setting hotjar recording.');
			echo "<!-- Hotjar Tracking Code for https://hetas.co.uk -->
				<script>
					(function(h,o,t,j,a,r){
						h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
						h._hjSettings={hjid:2602011,hjsv:6};
						a=o.getElementsByTagName('head')[0];
						r=o.createElement('script');r.async=1;
						r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
						a.appendChild(r);
					})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
				</script>";
		}
	}

}
